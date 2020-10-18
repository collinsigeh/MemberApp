<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifypaystack_transaction extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('user_model');
		$this->load->model('payment_processor_model');
		$this->load->model('order_model');
		$this->load->model('product_model');
		$this->load->model('subscription_product_model');
		$this->load->model('member_subscription_model');
		$this->load->model('payment_model');

		$this->load->library('form_validation');
		$this->load->library('email');
    }

    /*
    * Verifies a payment transaction
    */
    public function index()
    {
        
        $curl = curl_init();
        $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
        if(!$reference){
			$this->session->action_error_message = 'No payment reference supplied';
			redirect(base_url().'dashboard/orders/');
        }

		$db_check = array(
			'name' => 'Paystack'
		);
		$payment_processor = $this->payment_processor_model->get_where($db_check);

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "accept: application/json",
            "authorization: Bearer ".$payment_processor->secret_key,
            "cache-control: no-cache"
        ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if($err){
            // there was an error contacting the Paystack API
            die('Curl returned error: ' . $err.'<div style="margin: 80px auto;"><a href="'.base_url().'dashboard/"><< Go to dashboard</a></div>');
        }

        $tranx = json_decode($response);

        if(!$tranx->status){
            // there was an error from the API
            die('API returned error: ' . $tranx->message.'<div style="margin: 80px auto;"><a href="'.base_url().'dashboard/"><< Go to dashboard</a></div>');
        }

        if('success' == $tranx->data->status){
            // transaction was successful...
            // please check other things like whether you already gave value for this ref
            // if the email matches the customer who owns the product etc
            // Give value

            $order = $this->order_model->find($tranx->data->metadata->custom_fields->order_number);
            if(!empty($order))
            {
                $ref = $tranx->data->reference;
                $amount = $tranx->data->amount / 100;
                // pre to and actually save payment
                $db_data = array(
                    'ref' => $ref,
                    'currency_symbol' => $tranx->data->currency,
                    'amount' => $amount,
                    'payment_method' => 'Paystack online',
                    'status' => 'Confirmed',
                    'order_id' => $order->id,
                    'created_at' => time()
                );
                $db_check = array(
                    'ref' => $ref,
                    'currency_symbol' => $tranx->data->currency,
                    'amount' => $amount
                );
                if(empty($this->payment_model->get_where($db_check)))
                {
                    $this->payment_model->save($db_data);
                    $this->session->action_success_message = 'Payment received!';
                }

                if($tranx->data->amount >= $order->amount * 100 && $tranx->data->currency == $order->currency_symbol)
                {
                    // prep to and update order - status to paid
                    $db_check = array(
                        'id' => $order->id,
                        'status' => 'Unpaid'
                    );
                    $db_data = array(
                        'status' => 'Paid',
                        'updated_at' => time()
                    );
                    $this->order_model->update_where($db_data, $db_check);

                    // attempt to deliver on order
                    if($order->product_id > 0)
                    {
                        $product = $this->product_model->find($order->product_id);
                        
                        if(!empty($product))
                        {
                            if($product->type == 'Subscription')
                            {
                                $db_check = array(
                                    'product_id' => $product->id
                                );
                                $product_detail = $this->subscription_product_model->get_where($db_check);

                                if(!empty($product_detail))
                                {
                                    $user = $this->user_model->find($order->user_id);
                                    if(!empty($user))
                                    {
                                        $subscription_start = time();

                                        if($order->type == 'Renewal')
                                        {
                                            $ms_to_renew = $this->member_subscription->find($order->ms_id_to_renew);
                                            if(!empty($ms_to_renew))
                                            {
                                                if($ms_to_renew->subscription_end > $subscription_start)
                                                {
                                                    $subscription_start = $ms_to_renew->subcription_end;
                                                }
                                            
                                                //set db_data and updat member subscription
                                                $db_data = array(
                                                    'user_limit' => $product_detail[0]->user_limit,
                                                    'subscription_start' => $subscription_start,
                                                    'subscription_end' => $subscription_start + ($product_detail[0]->duration * 24 * 60 * 60),
                                                    'order_id' => $order->id
                                                );
                                                $this->member_subscription_model->update($db_data, $ms_to_renew->id);

                                                // update order to delivered
                                                $db_check = array(
                                                    'id' => $order->id,
                                                    'status' => 'Paid'
                                                );
                                                $db_data = array(
                                                    'status' => 'Delivered',
                                                    'updated_at' => time()
                                                );
                                                $this->order_model->update_where($db_data, $db_check);
                                            }
                                        }
                                        elseif($order->type == 'Purchase')
                                        {
                                            $db_data = array(
                                                'manager_email' => $user->email,
                                                'user_id' => $user->id,
                                                'product_id' => $product->id,
                                                'product_name' => $product->name,
                                                'subscription_code' => strtoupper(substr($order->description, 0, 4).'-'.$order->id),
                                                'user_limit' => $product_detail[0]->user_limit,
                                                'subscription_start' => $subscription_start,
                                                'subscription_end' => $subscription_start + ($product_detail[0]->duration * 24 * 60 * 60),
                                                'order_id' => $order->id,
                                                'cancel' => 0
                                            );
                                            $this->member_subscription_model->save($db_data);

                                            // update order to delivered
                                            $db_check = array(
                                                'id' => $order->id,
                                                'status' => 'Paid'
                                            );
                                            $db_data = array(
                                                'status' => 'Delivered',
                                                'updated_at' => time()
                                            );
                                            $this->order_model->update_where($db_data, $db_check);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                redirect(base_url().'dashboard/order_item/'.$order->id);
            }
        }

        redirect(base_url().'dashboard/');

    }
}