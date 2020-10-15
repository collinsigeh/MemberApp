<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		        
        if($this->session->user_type !== 'Admin')
        {
            redirect(base_url().'dashboard/');
        }
        
        $this->load->model('user_model');
        $this->load->model('order_model');
        $this->load->model('product_model');
        $this->load->model('subscription_product_model');
        $this->load->model('non_subscription_product_model');
        $this->load->model('payment_model');
        
        $this->load->library('pagination');
		$this->load->library('form_validation');
		
		// check for suspended account
		$user_current_details = $this->user_model->find($this->session->user_id);
        if($user_current_details->status == 'Suspended')
        {
			$this->session->status = 'Suspended';
            redirect(base_url().'dashboard/');
		}
		// end check for suspended account
    }

	public function index($id=0)
	{
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
        
        $offset = $id;
        $limit = 50;
        
        $orders = $this->order_model->paginate($limit, $offset);
        $total = count($this->order_model->get());
        
        $config['base_url'] = base_url().'orders/index/';
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);
        
		$data = array(
            'page_title'    => 'Order requests',
            'orders'        => $orders,
            'total'         => $total,
            'start'         => $offset + 1,
            'end'           => $offset + count($orders)
		);

		$this->load->view('templates/header', $data);
		$this->load->view('orders/index_view');
		$this->load->view('templates/footer');
    }

    /*
    * displays the details of a specific order item
    */
    public function item($id=0)
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
        
        $order = $this->order_model->find($id);
        if(empty($order))
        {
            $this->session->action_success_message = 'Invalid item selection.';
            redirect(base_url().'orders/');
		}

        $db_check = array(
            'id' => $order->product_id
		);
		$product = $this->product_model->get_where($db_check);
        if(empty($product))
        {
            $this->session->action_success_message = 'Faulty order selection.';
            redirect(base_url().'orders/');
		}

        $db_check = array(
            'product_id' => $order->product_id
		);
        if($product[0]->type == 'Subscription')
        {
            $product_detail = $this->subscription_product_model->get_where($db_check);
        }
        elseif($product[0]->type == 'Non-subscription')
        {
            $product_detail = $this->non_subscription_product_model->get_where($db_check);
        }

        $db_check = array(
            'order_id' => $order->id
        );
        $payments = $this->payment_model->get_where($db_check);
        
		$data = array(
			'page_title'	=> 'Order detail',
			'order'			=> $order,
            'product'		=> $product[0],
            'payments'      => $payments
        );
        if(isset($product_detail[0]))
        {
            $data['item_detail'] = $product_detail[0];
        }

		$this->load->view('templates/header', $data);
		$this->load->view('orders/item_view');
		$this->load->view('templates/footer');
    }
}