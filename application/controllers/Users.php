<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		        
        if($this->session->user_type !== 'Admin')
        {
            redirect(base_url().'dashboard/');
        }

		$this->load->model('user_model');
        $this->load->model('setting_model');
        $this->load->model('member_subscription_model');
        $this->load->model('student_info_model');
        $this->load->model('professional_info_model');
        $this->load->model('authorization_detail_model');
        $this->load->model('product_model');
        
        $this->load->library('pagination');
		$this->load->library('form_validation');
        $this->load->library('email');
		
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
        
        $users = $this->user_model->paginate($limit, $offset);
        if(empty($users))
        {
            $this->session->action_error_message = 'Unavailable resource selection.';
            redirect(base_url().'dashboard');
        }
        $total = count($this->user_model->get());
        
        $config['base_url'] = base_url().'users/index/';
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);
        
		$data = array(
            'page_title'    => 'Users',
            'users'         => $users,
            'total'         => $total,
            'start'         => $offset + 1,
            'end'           => $offset + count($users)
		);

		$this->load->view('templates/header', $data);
		$this->load->view('users/index_view');
		$this->load->view('templates/footer');
    }

    /*
    * Details of the user with id of $id
    */
    public function account($id=0)
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
        
        $user = $this->user_model->find($id);

        if(!isset($user))
        {
            $this->session->action_error_message = 'Invalid resource selection.';
            redirect(base_url().'dashboard');
        }

        $now = time();
        $db_check = array(
            'user_id'=> $id
        );
        $subscriptions = $this->member_subscription_model->get_where($db_check);
        $no_subscriptions = count($subscriptions);

		$data = array(
            'page_title'       => 'User detail',
            'user'             => $user,
            'no_subscriptions' => $no_subscriptions,
            'subscriptions'    => $subscriptions,
            'now'              => time()
        );
        
        if($user->membership == 'Student')
        {
            $db_check = array(
                'user_id' => $id
            );
            $result = $this->student_info_model->get_where($db_check);
            if(count($result) > 0)
            {
                $data['student_info'] = $result[0];
            }
        }
        else
        {
            $db_check = array(
                'user_id' => $id
            );
            $result = $this->professional_info_model->get_where($db_check);
            if(count($result) > 0)
            {
                $data['professional_info'] = $result[0];
            }
        }

        if($user->use_status == 'Operator' OR $user->use_status == 'Recreational')
        {
            $db_check = array(
                'user_id' => $id
            );
            $result = $this->authorization_detail_model->get_where($db_check);
            if(count($result) > 0)
            {
                $data['authorization_detail'] = $result[0];
            }
        }

        if($user->membership == 'Individual')
        {
            $db_check = array(
                'type' => 'Subscription',
                'status' => 'Available',
                'for_individual' => 1
            );
        }
        elseif($user->membership == 'Corporate')
        {
            $db_check = array(
                'type' => 'Subscription',
                'status' => 'Available',
                'for_corporate' => 1
            );
        }
        elseif($user->membership == 'Student')
        {
            $db_check = array(
                'type' => 'Subscription',
                'status' => 'Available',
                'for_student' => 1
            );
        }
        else
        {
            $this->session->action_error_message = 'Invalid user membership.';
            redirect(base_url().'dashboard');
        }
        $data['subscription_products'] = $this->product_model->get_where($db_check);

		$this->load->view('templates/header', $data);
		$this->load->view('users/account_view');
		$this->load->view('templates/footer');
    }

    /*
    * Update the details of the user with id of $id
    */
    public function update_account($id=0)
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
        
        $user = $this->user_model->find($id);

        if(!isset($user))
        {
            $this->session->action_error_message = 'Invalid resource selection.';
            redirect(base_url().'dashboard');
        }

		$this->form_validation->set_rules('user_type', 'User type', 'trim|required');
		$this->form_validation->set_rules('status', 'Account status', 'trim|required');

        if($this->form_validation->run() == FALSE)
        {
            $this->session->action_error_message = validation_errors();
            redirect(base_url().'users/account/'.$id);
        }
        
        if($this->session->user_id == $id && $this->input->post('status') == 'Suspended')
        {
            $this->session->action_error_message = 'Attempt to suspend own account.';
            redirect(base_url().'users/account/'.$id);
        }

        $now = time();

        $db_data = array(
            'user_type'     => $this->input->post('user_type'),
            'status'        => $this->input->post('status'),
            'updated_at'    => $now
        );
        $this->user_model->update($db_data, $id);

        $this->session->action_success_message = 'Update saved!';
        if($id == $this->session->user_id)
        {
            redirect(base_url().'dashboard/logout/');
        }
        redirect(base_url().'users/account/'.$id);
    }

    /*
    * Update ID for specific user with id $id
    */
	public function update_id($id=0)
	{
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
        
        $user = $this->user_model->find($id);

        if(!isset($user))
        {
            $this->session->action_error_message = 'Invalid resource selection.';
            redirect(base_url().'dashboard');
        }
		
		$config['upload_path'] 		= './assets/img/valid_ids/';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png';
		$config['max_size']     	= '2048';
		$config['file_name']		= time().'-'.$id;

		$this->load->library('upload', $config);

		if(!$this->upload->do_upload('userfile'))
        {
			$this->session->action_error_message = $this->upload->display_errors();
			redirect(base_url().'users/account/'.$id);
		}
		
		$upload_data = $this->upload->data();

		$db_data = array(
			'valid_id' => $upload_data['file_name']
		);
		$this->user_model->update($db_data, $id);
		
		$this->session->action_success_message = 'ID saved';
		redirect(base_url().'users/account/'.$id);
	}

	/*
	* display admin account creation form
	*/
	public function create_admin()
	{
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }

        $data = array(
            'page_title'        => 'New admin'
        );
        
		$this->load->view('templates/header', $data);
		$this->load->view('users/create_view');
		$this->load->view('templates/footer');
    }

	/*
	* save new admin details
    */
    public function save_admin()
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
        
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|in_list[Male,Female]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');

        $this->session->user_password     = trim($this->input->post('password'));

        $db_data['user_type']   = 'Admin';
        $db_data['membership']  = 'Individual';
        $db_data['password']    = password_hash($this->session->user_password, PASSWORD_DEFAULT);
        $db_data['status']      = 'Active';
        $db_data['title']       = $this->session->user_title        = trim($this->input->post('title'));
        $db_data['firstname']   = $this->session->user_first_name   = trim($this->input->post('firstname'));
        $db_data['lastname']    = $this->session->user_last_name    = trim($this->input->post('lastname'));
        $db_data['email']       = $this->session->user_email        = trim($this->input->post('email'));
        $db_data['phone']       = $this->session->user_phone        = trim($this->input->post('phone'));
        $db_data['gender']      = $this->session->user_gender       = trim($this->input->post('gender'));
        $db_data['use_status']  = 'Others';
        $db_data['photo']       = 'profile_default.png';
        $db_data['created_at']  = time();
        
        $this->session->user_confirm_password = trim($this->input->post('user_confirm_password'));

        if($this->form_validation->run() == FALSE)
        {
            $this->session->action_error_message = validation_errors();
            redirect(base_url().'users/create_admin/');
        }

        $this->user_model->save($db_data);

        $this->session->unset_userdata('user_title');
        $this->session->unset_userdata('user_first_name');
        $this->session->unset_userdata('user_last_name');
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('user_phone');
        $this->session->unset_userdata('user_gender');
        $this->session->unset_userdata('user_password');
        $this->session->unset_userdata('user_confirm_password');

        $this->session->action_success_message = 'Admin account created.';
        redirect(base_url().'users/create_admin/');
    }

    /*
    * displays a list of accounts that are pending approval
    */
	public function pending_accounts($id=0)
	{
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
        
        $offset = $id;
        $limit = 50;
        $db_check = array(
            'status' => 'Pending Approval'
        );

        $users = $this->user_model->paginate_where($db_check, $limit, $offset);
        if(empty($users))
        {
            $this->session->action_error_message = 'Unavailable resource selection.';
            redirect(base_url().'dashboard');
        }
        $total = count($this->user_model->get_where($db_check));
        
        $config['base_url'] = base_url().'users/index/';
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);
        
		$data = array(
            'page_title'    => 'Users',
            'users'         => $users,
            'total'         => $total,
            'start'         => $offset + 1,
            'end'           => $offset + count($users)
		);

		$this->load->view('templates/header', $data);
		$this->load->view('users/pending_accounts_view');
		$this->load->view('templates/footer');
    }
}