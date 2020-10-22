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

        $this->load->helper('date');
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
		        
        if($this->session->user_type !== 'Admin')
        {
            redirect(base_url().'dashboard/');
        }
		
        // check for suspended admin account
        $user_current_details = $this->user_model->find($this->session->user_id);
        if($user_current_details->status == 'Suspended')
        {
            $this->session->status = 'Suspended';
            redirect(base_url().'dashboard/');
        }
        // end check for suspended admin account

        $user = $this->user_model->find($id);
        if(empty($user))
        {
            $this->session->action_error_message = 'Invalid user selection';
            redirect(base_url().'users/');
        }

        $this->form_validation->set_rules('subscription_product_id', 'Select subscription to add', 'trim|required');
        $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
        $this->form_validation->set_rules('end_date', 'End date', 'trim|required');
        $this->form_validation->set_rules('confirm', 'Confirm action', 'trim|required|in_list[ADD]');

        if($this->form_validation->run() == FALSE)
        {
            $this->session->action_error_message = validation_errors();
            redirect(base_url().'users/account/'.$id);
        }

        $subscription_start = strtotime($this->input->post('start_date'));
        $subscription_end = strtotime($this->input->post('end_date'));
        if($subscription_start >= $subscription_end)
        {
            $this->session->action_error_message = 'The subscription End date should be further than the subscription Start date.';
            redirect(base_url().'users/account/'.$id);
        }
        if($subscription_end <= time())
        {
            $this->session->action_error_message = 'The subscription End date should be further today.';
            redirect(base_url().'users/account/'.$id);
        }

        $product_id = $this->input->post('subscription_product_id');

        if($user->membership == 'Individual')
        {
            $db_check = array(
                'id' => $product_id,
                'type' => 'Subscription',
                'status' => 'Available',
                'for_individual' => 1
            );
        }
        elseif($user->membership == 'Corporate')
        {
            $db_check = array(
                'id' => $product_id,
                'type' => 'Subscription',
                'status' => 'Available',
                'for_corporate' => 1
            );
        }
        elseif($user->membership == 'student')
        {
            $db_check = array(
                'id' => $product_id,
                'type' => 'Subscription',
                'status' => 'Available',
                'for_student' => 1
            );
        }
        $result = $this->product_model->get_where($db_check);
        if(count($result) != 1)
        {
            $this->session->action_error_message = 'Invalid resource selection';
            redirect(base_url().'users/account/'.$id);
        }
        $product = $result[0];

        $db_check = array(
          'product_id' => $product->id
        );
        $result = $this->subscription_product_model->get_where($db_check);
        if(count($result) < 1)
        {
            $this->session->action_error_message = 'Invalid resource selection';
            redirect(base_url().'users/account/'.$id);
        }
        $product_detail = $result[0];
        
        $db_data = array(
          'manager_email' => $user->email,
          'user_id' => $user->id,
          'product_id' => $product->id,
          'product_name' => $product->name,
          'subscription_code' => strtoupper(substr($product->name, 0, 4)).'-'.$this->session->user_id.'-'.time(),
          'user_limit' => $product_detail->user_limit,
          'subscription_start' => $subscription_start,
          'subscription_end' => $subscription_end,
          'cancel' => 0
        );
        $this->member_subscription_model->save($db_data);

        $this->session->action_success_message = 'Subscription added for '.$user->firstname.' '.$user->lastname;
        redirect(base_url().'users/account/'.$id);
    }
}