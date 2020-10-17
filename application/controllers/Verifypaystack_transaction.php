<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifypaystack_transaction extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('user_model');
		$this->load->model('payment_processor_model');
		$this->load->model('order_model');

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

        print_r($tranx);
        die();

        if('success' == $tranx->data->status){
        // transaction was successful...
        // please check other things like whether you already gave value for this ref
        // if the email matches the customer who owns the product etc
        // Give value
        echo "<h2>Thank you for making a purchase. Your file has bee sent your email.</h2>";
        }

    }
}