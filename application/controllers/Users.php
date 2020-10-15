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
            $result = $this->authorization_detail_mode->get_where($db_check);
            if(count($result) > 0)
            {
                $data['authorization_detail'] = $result[0];
            }
        }

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
		$this->form_validation->set_rules('membership', 'Membership', 'trim|required');
		$this->form_validation->set_rules('use_status', 'Member status', 'trim|required');
		$this->form_validation->set_rules('status', 'Account status', 'trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');

        if($this->form_validation->run() == FALSE)
        {
            $this->session->action_error_message = validation_errors();
            redirect(base_url().'users/account/'.$id);
        }

        $email = strtolower($this->input->post('email'));

        //check if email is taken by others
        $db_check = array(
            'email' => $email,
            'id !=' => $id
        );
        if(count($this->user_model->get_where($db_check)) > 0)
        {
            $this->session->action_error_message = 'The email - <i>'.$email.'</i> - is in use.';
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
            'membership'    => $this->input->post('membership'),
            'email'         => $email,
            'status'        => $this->input->post('status'),
            'title'         => $this->input->post('title'),
            'firstname'     => $this->input->post('firstname'),
            'lastname'      => $this->input->post('lastname'),
            'phone'         => $this->input->post('phone'),
            'gender'        => $this->input->post('gender'),
            'use_status'    => $this->input->post('use_status'),
            'updated_at'    => $now
        );
        $this->user_model->update($db_data, $id);

        // logic for student info
        $student_info_to_modify = 0;
        if(null !== $this->input->post('institution') && strlen($this->input->post('institution')) > 1)
        {
            $student_data['institution'] =  strtoupper(trim($this->input->post('institution')));
            $student_info_to_modify++;
        }
        if(null !== $this->input->post('course_of_study') && strlen($this->input->post('course_of_study')) > 1)
        {
            $student_data['course_of_study'] =  strtoupper(trim($this->input->post('course_of_study')));
            $student_info_to_modify++;
        }
        if(null !== $this->input->post('degree') && strlen($this->input->post('degree')) > 1)
        {
            $student_data['degree'] =  $this->input->post('degree');
            $student_info_to_modify++;
        }
        if(null !== $this->input->post('graduation_year') && strlen($this->input->post('graduation_year')) > 1)
        {
            $student_data['graduation_year'] =  $this->input->post('graduation_year');
            $student_info_to_modify++;
        }
        if($student_info_to_modify > 0)
        {
            $db_check = array(
                'user_id' => $id
            );
            if(count($this->student_info_model->get_where($db_check)) > 0)
            {
                $this->student_info_model->update_where($student_data, $db_check);
            }
            else
            {
                $student_data['user_id'] = $id;
                $this->student_info_model->save($student_data);
            }
        }

        // logic for professional info
        $professional_info_to_modify = 0;
        if(null !== $this->input->post('industry') && strlen($this->input->post('industry')) > 1)
        {
            $professional_data['industry'] =  $this->input->post('industry');
            $professional_info_to_modify++;
        }
        if(null !== $this->input->post('organisation') && strlen($this->input->post('organisation')) > 1)
        {
            $professional_data['organisation'] =  $this->input->post('organisation');
            $professional_info_to_modify++;
        }
        if(null !== $this->input->post('organisation_description') && strlen($this->input->post('organisation_description')) > 1)
        {
            $professional_data['organisation_description'] =  $this->input->post('organisation_description');
            $professional_info_to_modify++;
        }
        if(null !== $this->input->post('office_address') && strlen($this->input->post('office_address')) > 1)
        {
            $professional_data['office_address'] =  $this->input->post('office_address');
            $professional_info_to_modify++;
        }
        if(null !== $this->input->post('designation') && strlen($this->input->post('designation')) > 1)
        {
            $professional_data['designation'] =  $this->input->post('designation');
            $professional_info_to_modify++;
        }
        if($professional_info_to_modify > 0)
        {
            $db_check = array(
                'user_id' => $id
            );
            if(count($this->professional_info_model->get_where($db_check)) > 0)
            {
                $this->professional_info_model->update_where($professional_data, $db_check);
            }
            else
            {
                $professional_data['user_id'] = $id;
                $this->professional_info_model->save($professional_data);
            }
        }

        // logic for authorization detail
        $authorization_detail_to_modify = 0;
        if(null !== $this->input->post('home_address') && strlen($this->input->post('home_address')) > 1)
        {
            $authorization_data['home_address'] =  $this->input->post('home_address');
            $authorization_detail_to_modify++;
        }
        if(null !== $this->input->post('ncaa_roc_number') && strlen($this->input->post('ncaa_roc_number')) > 1)
        {
            $authorization_data['ncaa_roc_number'] =  $this->input->post('ncaa_roc_number');
            $authorization_detail_to_modify++;
        }
        if(null !== $this->input->post('vlos'))
        {
            $authorization_data['vlos_class_of_operation'] =  $this->input->post('vlos');
            $authorization_detail_to_modify++;
        }
        if(null !== $this->input->post('bvlos'))
        {
            $authorization_data['bvlos_class_of_operation'] =  $this->input->post('bvlos');
            $authorization_detail_to_modify++;
        }
        if(null !== $this->input->post('approved_operation'))
        {
            $authorization_data['approved_operation'] =  $this->input->post('approved_operation');
            $authorization_detail_to_modify++;
        }
        if($authorization_detail_to_modify > 0)
        {
            $db_check = array(
                'user_id' => $id
            );
            if(count($this->authorization_detail_model->get_where($db_check)) > 0)
            {
                $this->authorization_detail_model->update_where($authorization_data, $db_check);
            }
            else
            {
                $authorization_data['user_id'] = $id;
                $this->authorization_detail_model->save($authorization_data);
            }
        }

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
}