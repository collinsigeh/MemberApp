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

    /*
    * Add a new subscription user to a subscription by the subcription manager
    */
    public function add_subscription_user($id=0)
    {
		        
        if($this->session->user_type !== 'Member')
        {
            redirect(base_url().'dashboard/');
        }
		
        // check for suspended member account
        $user_current_details = $this->user_model->find($this->session->user_id);
        if($user_current_details->status == 'Suspended')
        {
            $this->session->status = 'Suspended';
            redirect(base_url().'dashboard/');
        }
        // end check for suspended member account

        $subscription = $this->member_subscription_model->find($id);
        if(empty($subscription))
        {
            $this->session->action_error_message = 'Invalid item selection';
            redirect(base_url().'dashboard/subscriptions/');
        }
        if($subscription->cancel ==  1)
        {
            $this->session->action_error_message = 'The subscription has been canceled';
            redirect(base_url().'dashboard/subscriptions/'.$id);
        }

        $db_check = array(
            'subscription_code' => $subscription->subscription_code
        );
        $subscription_users = $this->member_subscription_model->get_where($db_check);
        if(count($subscription_users) >= $subscription->user_limit)
        {
            $this->session->action_error_message = 'User limit reached!';
            redirect(base_url().'dashboard/subscriptions/'.$id);
        }
        
        $this->form_validation->set_rules('email', 'Email of User to add', 'trim|required|valid_email');
        $this->form_validation->set_rules('confirm', 'Confirm action', 'trim|required|in_list[ADD]');

        if($this->form_validation->run() == FALSE)
        {
            $this->session->action_error_message = validation_errors();
            redirect(base_url().'dashboard/subscription_item/'.$id);
        }

        $db_check = array(
            'email' => strtolower(trim($this->input->post('email')))
        );
        $result = $this->user_model->get_where($db_check);
        if(empty($result))
        {
            $this->session->action_error_message = 'The email you supplied is NOT recognised.';
            redirect(base_url().'dashboard/subscription_item/'.$id);
        }
        $user = $result[0];
        
        $db_check = array(
            'id' => $user['id'],
            'subscription_code' => $subscription->subscription_code
        );
        $duplicate = $this->member_subscription_model->get_where($db_check);
        if(!empty($duplicate))
        {
            $this->session->action_error_message = 'An attempt of duplicate member addition.';
            redirect(base_url().'dashboard/subscription_item/'.$id);
        }

        if($user['user_type'] != 'Member')
        {
            $this->session->action_error_message = 'The email you supplied is NOT for a member.';
            redirect(base_url().'dashboard/subscription_item/'.$id);
        }
        if($user['status'] != 'Active')
        {
            $this->session->action_error_message = 'The member account is NOT active.';
            redirect(base_url().'dashboard/subscription_item/'.$id);
        }
        if($user['membership'] != $this->session->membership)
        {
            $this->session->action_error_message = 'The member account is NOT in your membership category.';
            redirect(base_url().'dashboard/subscription_item/'.$id);
        }
        
        $db_data = array(
          'manager_email' => $this->session->email,
          'user_id' => $user['id'],
          'product_id' => $subscription->product_id,
          'product_name' => $subscription->product_name,
          'subscription_code' => $subscription->subscription_code,
          'user_limit' => $subscription->user_limit,
          'subscription_start' => $subscription->subscription_start,
          'subscription_end' => $subscription->subscription_end,
          'cancel' => $subscription->cancel
        );
        $this->member_subscription_model->save($db_data);

        $this->session->action_success_message = $user['firstname'].' '.$user['lastname'].' has been added';
        redirect(base_url().'dashboard/subscription_item/'.$id);
    }

    /*
    * Add a new subscription user to a subscription by the subcription manager
    */
    public function delete_subscription_user($id=0)
    {
		        
        if($this->session->user_type !== 'Member')
        {
            redirect(base_url().'dashboard/');
        }
		
        // check for suspended member account
        $user_current_details = $this->user_model->find($this->session->user_id);
        if($user_current_details->status == 'Suspended')
        {
            $this->session->status = 'Suspended';
            redirect(base_url().'dashboard/');
        }
        // end check for suspended member account

        $user = $this->user_model->find($id);
        if(empty($user))
        {
            $this->session->action_error_message = 'Invalid member selection';
            redirect(base_url().'dashboard/subscriptions/');
        }
        
        $this->form_validation->set_rules('subscription_code', 'Subscription code', 'trim|required');
        $this->form_validation->set_rules('confirm', 'Confirm action', 'trim|required|in_list[DELETE]');

        if($this->form_validation->run() == FALSE)
        {
            $this->session->action_error_message = validation_errors();
            redirect(base_url().'dashboard/subscriptions/');
        }

        $db_check = array(
            'manager_email' => $this->session->email,
            'subscription_code' => trim($this->input->post('subscription_code'))
        );
        $result = $this->member_subscription_model->get_where($db_check);
        if(empty($result))
        {
            $this->session->action_error_message = 'You are NOT the subscription manager.';
            redirect(base_url().'dashboard/subscriptions/');
        }
        $master_subscription = $result[0];
        
        $db_check = array(
            'user_id' => $user->id,
            'subscription_code' => trim($this->input->post('subscription_code'))
        );
        $this->member_subscription_model->delete_where($db_check);

        $this->session->action_success_message = $user->firstname.' '.$user->lastname.' has been removed';
        redirect(base_url().'dashboard/subscription_item/'.$master_subscription->id);
    }

    /*
    * confirms availability and suitability of items before sumbiting the order
    */
    public function renew_subscription($id=0)
    {
		        
        if($this->session->user_type !== 'Member')
        {
            redirect(base_url().'dashboard/');
        }
		
        // check for suspended member account
        $user_current_details = $this->user_model->find($this->session->user_id);
        if($user_current_details->status == 'Suspended')
        {
            $this->session->status = 'Suspended';
            redirect(base_url().'dashboard/');
        }
        // end check for suspended member account

        $subscription = $this->member_subscription_model->find($id);
        if(empty($subscription))
        {
            $this->session->action_error_message = 'Invalid item selection';
            redirect(base_url().'dashboard/subscriptions/');
        }
        if($subscription->cancel ==  1)
        {
            $this->session->action_error_message = 'The subscription has been canceled';
            redirect(base_url().'dashboard/subscriptions/'.$id);
        }
		
		$db_check = array(
			'id'	 => $subscription->product_id,
			'status' => 'Available'
		);
		if($this->session->membership == 'Individual')
		{
			$db_check['for_individual'] = 1;
		}
		elseif($this->session->membership == 'Corporate')
		{
			$db_check['for_corporate'] = 1;
		}
		elseif($this->session->membership == 'Student')
		{
			$db_check['for_student'] = 1;
		}
        
        $product = $this->product_model->get_where($db_check);
        if(empty($product))
        {
            $this->session->action_error_message = 'Invalid item - product modified.';
            redirect(base_url().'dashboard/subscriptions/'.$id);
		}
		$item = $product[0];
		$order_description = $item->name;

        $db_check = array(
            'product_id' => $item->id
        );

        if($item->type == 'Subscription')
        {
			$product_detail = $this->subscription_product_model->get_where($db_check);
        }
        elseif($item->type == 'Non-subscription')
        {
            $product_detail = $this->non_subscription_product_model->get_where($db_check);
		}
		$item_detail = $product_detail[0];

		$db_data = array(
			'product_id' => $item->id,
			'description' => $order_description,
			'currency_symbol' => $item->currency_symbol,
			'amount' => $item->amount,
			'status' => 'Unpaid',
			'user_id' => $this->session->user_id,
			'created_at' => time()
		);
		$this->order_model->save($db_data);

		$result = $this->order_model->get_where($db_data);
		if(empty($result))
		{
			$this->session->action_error_message = '<p>An unexpected error has occured!</p>Please try again.';
			redirect(base_url().'dashboard/shop/');
		}
		$order = $result[0];

		$this->session->action_success_message = 'Order saved. Make payment!';
		redirect(base_url().'dashboard/order_item/'.$order->id);
	}
}