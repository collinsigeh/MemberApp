<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriptions extends CI_Controller {

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
        $this->load->model('setting_model');

		$this->load->library('form_validation');
		$this->load->library('email');
    }

    /*
    * Check for due subscriptions and notifies the member
    */
    public function due_for_renewals()
    {

    }

    /*
    * Add a new subscription to a user
    */
    public function add_to_user($id=0)
    {
		$user = $this->user_model->find($id);
		print_r($user);
    }
}