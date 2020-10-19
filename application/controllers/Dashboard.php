<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('user_model');
		$this->load->model('setting_model');
		$this->load->model('professional_info_model');
		$this->load->model('student_info_model');
		$this->load->model('automated_email_model');
		$this->load->model('member_subscription_model');
		$this->load->model('order_model');
		$this->load->model('product_model');
        $this->load->model('subscription_product_model');
        $this->load->model('non_subscription_product_model');
        $this->load->model('member_resource_model');
		$this->load->model('payment_processor_model');
		$this->load->model('payment_model');
		$this->load->model('authorization_detail_model');
		
		$this->load->library('form_validation');
		$this->load->library('email');
        $this->load->library('pagination');
	}

	public function index()
	{
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
		}

		$db_check = array(
			'user_id'	=> $this->session->user_id,
			'cancel !=' => 1
		);
		$subscriptions = $this->member_subscription_model->get_where($db_check);

		$db_check = array(
			'user_id' => $this->session->user_id,
			'status' => 'Unpaid'
		);
		$no_unpaid_orders = count($this->order_model->get_where($db_check));


		$data = array(
			'page_title' 	   => 'Dashboard',
			'subscriptions'    => $subscriptions,
			'now'			   => time(),
			'no_unpaid_orders' => $no_unpaid_orders
		);

		$this->load->view('templates/header', $data);
		$this->load->view('dashboard_view');
		$this->load->view('templates/footer');
	}

	/*
	* display registration page 1
	*/
	public function register()
	{
		if($this->session->userlogged_in == '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/');
		}
		
		// set when registration process will expire after 60 minutes
		$this->session->reg_expire_at	= time() + 3600;


		// load registration form
		$data = array(
			'page_title' => 'New registration'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('register_view');
		$this->load->view('templates/footer');
	}

	/*
	* display registration page 2
	*/
	public function register_page2()
	{
		if($this->session->userlogged_in == '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/');
		}

		if(time() >= $this->session->reg_expire_at)
		{// when form 1 hour session expires
			
			$this->session->action_error_message = 'Your registration session of 60 minutes has expired. Please start again';
			redirect(base_url().'dashboard/register/');
		}

		if($this->session->reg_page1_successful !== '*##Yes!')
		{// check that page 1 is filled out successfully.
			redirect(base_url().'dashboard/register');
		}

		// load registration form
		$data = array(
			'page_title' => 'New registration - Page 2'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('register_page2_view');
		$this->load->view('templates/footer');
	}

	/*
	* process registration details
	*/
	public function registering_user()
	{
		
		if($this->session->userlogged_in == '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/');
		}

		if(time() >= $this->session->reg_expire_at)
		{// when form 1 hour session expires
			
			$this->session->action_error_message = 'Your registration session of 60 minutes has expired. Please start again';
			redirect(base_url().'dashboard/register/');
		}
		
		if($this->input->post('form_page') == 'reg_page1')
		{// submission from 1st reg. page

			// create necessary session variables for form interaction
			
			$this->session->membership	= trim($this->input->post('membership'));
			$this->session->title		= trim($this->input->post('title'));
			$this->session->firstname	= ucfirst(trim($this->input->post('firstname')));
			$this->session->lastname	= ucfirst(trim($this->input->post('lastname')));
			$this->session->email		= strtolower(trim($this->input->post('email')));
			$this->session->phone		= trim($this->input->post('phone'));
			$this->session->gender		= trim($this->input->post('gender'));
			$this->session->use_status	= trim($this->input->post('use_status'));
			$this->session->form_page	= $this->input->post('form_page');
			
			//validate form enteries

			$this->form_validation->set_rules('membership', 'Membership type', 'trim|required');
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]', array('is_unique' => 'The email provided is already in use.'));
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('use_status', 'Member Status (Best description of your work with unmanned systems)', 'trim|required');			

			if($this->form_validation->run() == FALSE)
			{
				$this->session->action_error_message = validation_errors();
				$this->session->reg_page1_successful = 'No';
				redirect(base_url().'dashboard/register/');
			}

			// hint that page 1 is filled successfully and redirect to reg. page 2
			$this->session->reg_page1_successful = '*##Yes!';
			redirect(base_url().'dashboard/register_page2/');
		}
		elseif($this->input->post('form_page') == 'reg_page2.2')
		{// submission from 2nd reg. page

			// create necessary session variables, validate and clean entries entries (as is applicable)
			$this->session->password = trim($this->input->post('password'));
			$this->session->confirm_password = trim($this->input->post('confirm_password'));
			$this->session->form_page = $this->input->post('form_page');

			if($this->session->membership == 'Student')
			{// - if registrant is a student
				
				$this->session->institution		= strtoupper(trim($this->input->post('institution')));
				$this->session->course_of_study	= strtoupper(trim($this->input->post('course_of_study')));
				$this->session->degree			= trim($this->input->post('degree'));
				$this->session->graduation_year	= trim($this->input->post('graduation_year'));

				$this->form_validation->set_rules('institution', 'Name of Institution', 'trim|required');
				$this->form_validation->set_rules('course_of_study', 'Course of Study', 'trim|required');
				$this->form_validation->set_rules('degree', 'Degree', 'trim|required');
				$this->form_validation->set_rules('graduation_year', 'Possible Year of Graduation', 'trim|required');
			}
			else
			{// - registrant is a professional

				$this->session->organisation				= strtoupper(trim($this->input->post('organisation')));
				$this->session->industry					= trim($this->input->post('industry'));
				$this->session->organisation_description	= trim($this->input->post('organisation_description'));
				$this->session->office_address				= strtoupper(trim($this->input->post('office_address')));
				$this->session->designation					= strtoupper(trim($this->input->post('designation')));

				$this->form_validation->set_rules('organisation', 'Name of Organisation', 'trim|required');
				$this->form_validation->set_rules('industry', 'Industry', 'trim|required');
				$this->form_validation->set_rules('organisation_description', 'Describe your Organisation', 'trim|required');
				$this->form_validation->set_rules('office_address', 'Office Address', 'trim|required');
				$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
			}			

			// - if registrant has authorization details
			if($this->session->use_status == 'Operator')
			{
				$this->session->ncaa_roc_number 	= strtoupper(trim($this->input->post('ncaa_roc_number')));
				$this->session->vlos				= $this->input->post('vlos');
				$this->session->bvlos				= $this->input->post('bvlos');
				$this->session->approved_operation	= $this->input->post('approved_operation');

				$this->form_validation->set_rules('ncaa_roc_number', 'NCAA ROC Number', 'trim|required');
				$this->form_validation->set_rules('approved_operation', 'Approved Operations', 'trim|required');
			}
			elseif($this->session->use_status == 'Recreational')
			{
				$this->session->home_address	= strtoupper(trim($this->input->post('home_address')));
				//$this->session->ncaa_roc_number	= strtoupper(trim($this->input->post('ncaa_roc_number')));

				$this->form_validation->set_rules('home_address', 'Home Address', 'trim|required');
				//$this->form_validation->set_rules('ncaa_roc_number', 'NCAA Registration Number', 'trim|required');
			}
			
			// member access and agreement details confirmation
			$this->session->code_of_conduct			= $this->input->post('code_of_conduct');
			$this->session->terms_and_conditions	= $this->input->post('terms_and_conditions');
			
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
			$this->form_validation->set_rules('code_of_conduct', 'NUSA Code of Conduct', 'trim|required');
			$this->form_validation->set_rules('terms_and_conditions', 'Terms and Conditions', 'required');

			if($this->form_validation->run() == FALSE)
			{
				$this->session->action_error_message = validation_errors();
				redirect(base_url().'dashboard/register_page2/');
			}

			// register details (as is applicable)

			// - register user account and get user_id

			$status 	= 'Active';
			if($this->setting_model->require_approval() == 1)
			{
				$status = 'Pending Approval';
			}

			$db_data = array(
				'membership'	=> $this->session->membership,
				'email' 		=> $this->session->email,
				'password' 		=> password_hash($this->session->password, PASSWORD_DEFAULT),
				'status' 		=> $status,
				'title' 		=> $this->session->title,
				'firstname' 	=> $this->session->firstname,
				'lastname' 		=> $this->session->lastname,
				'phone' 		=> $this->session->phone,
				'gender' 		=> $this->session->gender,
				'use_status' 	=> $this->session->use_status,
				'photo'			=> 'profile_default.png',
				'created_at' 	=> time()
			);
			
			$this->user_model->save($db_data);
			$result = $this->user_model->get_where($db_data);
			$user_id = $result[0]['id'];

			
			if($this->session->membership == 'Student')
			{// - if student, then register student info
				
				$db_data = array(
					'user_id'	=> $user_id,
					'institution' 		=> $this->session->institution,
					'course_of_study'	=> $this->session->course_of_study,
					'degree'			=> $this->session->degree,
					'graduation_year'	=> $this->session->graduation_year
				);

				$this->student_info_model->save($db_data);
			}
			else
			{// - or register professional info
				
				$db_data = array(
					'user_id'					=> $user_id,
					'industry'					=> $this->session->industry,
					'organisation'				=> $this->session->organisation,
					'organisation_description'	=> $this->session->organisation_description,
					'office_address'			=> $this->session->office_address,
					'designation'				=> $this->session->designation
				);

				$this->professional_info_model->save($db_data);
			}

			if($this->session->use_status == 'Operator')
			{// - if operator, then register appropriate authorization details
				
				$db_data = array(
					'user_id'					=> $user_id,
					'ncaa_roc_number ' 			=> $this->session->ncaa_roc_number,
					'vlos_class_of_operation'	=> $this->session->vlos,
					'bvlos_class_of_operation'	=> $this->session->bvlos,
					'approved_operation'		=> $this->session->approved_operation
				);

				$this->authorization_detail_model->save($db_data);
			}
			elseif($this->session->use_status == 'Recreational')
			{// - or if recreational, then register appropriate additional contact and authorization details
				
				$db_data = array(
					'user_id'				=> $user_id,
					'home_address'			=> $this->session->home_address,
					//'ncaa_roc_number ' 		=> $this->session->ncaa_roc_number,
					'approved_operation'	=> 'N/A'
				);

				$this->authorization_detail_model->save($db_data);
			}

			// send new account message to user

			$db_check = array(
				'item' => 'New User Account Email'
			);
			$result	= $this->automated_email_model->get_where($db_check);
			$from_email		= $result[0]['sender_email'];
			$from_name		= $result[0]['sender_name'];
			$reply_to		= $result[0]['reply_to_email'];
			$reply_to_name	= $result[0]['sender_name'];
			$email_to 		= $this->session->email;
			$subject_to_user 		= $result[0]['user_subject_line'];
			$message_to_user 		= $result[0]['message_to_user'];
			$subject_to_admin 		= $result[0]['admin_subject_line'];
			$message_to_admin 		= $result[0]['message_to_user'];

			if(strlen($message_to_user) > 1)
			{
				$message = $this->automated_email_model->message_cleanup($message_to_user, $user_id);

				$this->send_email($from_email, $from_name, $reply_to_email, $reply_to_name, $to, $subject_to_user, $message_to_user);
			}

			// conditionally send notification to admin

			$result  = $this->setting_model->get();
			$to = $admin_email = $result->main_admin_email;
			$send_admin_email = $result->send_admin_email_on_new_reg;
			$manual_approval_required = $result->require_manual_approval_on_new_reg;
			if(strlen($admin_email) > 5 && $send_admin_email == 1)
			{
				if(strlen($message_to_admin) > 1)
				{
					$message = $this->automated_email_model->message_cleanup($message_to_admin, $user_id);
	
					$this->send_email($from_email, $from_name, $reply_to_email, $reply_to_name, $to, $subject_to_admin, $message_to_admin);
				}
			}

			// get appropriate registration staus message and redirect user

			if($manual_approval_required == 1)
			{
				$registration_message = 'Your registration has been submitted successfully. Pending review and approval.';
			}
			else
			{
				$registration_message = 'Your registration was successful.';
			}

			$this->session->action_success_message = $registration_message;
			redirect(base_url().'dashboard/registration_completed/');
		}
		else
		{// fall back page (redirection)
			
			redirect(base_url().'dashboard/register/');
		}
	}

	/*
	* display registration completed page
	*/
	public function registration_completed()
	{
		if($this->session->userlogged_in == '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/');
		}

		$data = array(
			'page_title' => 'Registration Completed'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('registration_completed_view');
		$this->load->view('templates/footer');

		session_destroy();
	}

	/*
	* display login page for the public
	*/
	public function login()
	{
		if($this->session->userlogged_in == '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/');
		}

		$data = array(
			'page_title' => 'Login'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('login_view');
		$this->load->view('templates/footer');
	}

	public function loging_in()
	{
		// validate form inputs

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->action_error_message = validation_errors();
			redirect(base_url().'dashboard/login/');
		}

		$this->session->email = strtolower(trim($this->input->post('email')));
		$password = trim($this->input->post('password'));
		
		$db_check = array(
			'email' => $this->session->email
		);
		$result = $this->user_model->get_where($db_check);
		if(empty($result))
		{
			$this->session->action_error_message = 'Invalid login details.';
			redirect(base_url().'dashboard/login/');
		}
		if (!password_verify($password, $result[0]['password'])) {
			$this->session->action_error_message = 'Invalid login details.';
			redirect(base_url().'dashboard/login/');
		}

		$user = $result[0];

		// set generic session verialbes for logged in users

		$this->session->user_id = $user['id'];
		$this->session->user_type = $user['user_type'];
		$this->session->membership = $user['membership'];
		$this->session->email = $user['email'];
		$this->session->status = $user['status'];
		$this->session->title = $user['title'];
		$this->session->firstname = $user['firstname'];
		$this->session->lastname = $user['lastname'];
		$this->session->phone = $user['phone'];
		$this->session->gender = $user['gender'];
		$this->session->use_status = $user['use_status'];
		$this->session->photo = $user['photo'];

		$this->session->userlogged_in = '*#loggedin@Yes';

		// redirect to appropriate dashboard

		redirect(base_url().'dashboard/');
	}

	public function logout()
	{
		// destroy all session variables

		session_destroy();

		// redirect to login page

		redirect(base_url().'dashboard/login/');
	}

	/*
	* update password for logged-in users
	*/
	public function update_password()
	{
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->action_error_message = validation_errors();
			redirect(base_url().'dashboard/profile/');
		}

		$db_data = array(
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
		);
		$this->user_model->update($db_data, $this->session->user_id);

		$this->session->action_success_message = 'Password updated';
		redirect(base_url().'dashboard/profile/');
	}

	/*
	* display reset_password page for the public
	*/
	public function reset_password()
	{
		$data = array(
			'page_title' => 'Reset password'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('reset_password_view');
		$this->load->view('templates/footer');
	}

	/*
	* resets password for the public
	*/
	public function requesting_password_reset()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if($this->form_validation->run() == FALSE)
        {
            $this->session->action_error_message = validation_errors();
            redirect(base_url().'dashboard/reset_password/');
		}

		$email = strtolower($this->input->post('email'));
		
		$db_check = array(
			'email' => $email
		);
		$user = $this->user_model->get_where($db_check);
		if(count($user) < 1)
		{
			$this->session->action_error_message = 'Email is NOT recognized.';
			redirect(base_url().'dashboard/reset_password/');
		}

		$new_password = $this->user_model->generate_new_password();

		$db_data = array(
			'password' 		=> password_hash($new_password, PASSWORD_DEFAULT)
		);
		$this->user_model->update_where($db_data, $db_check);

		$from_email = 'account-settings@nusa.ng';
		$from_name = 'NUSA';
		$reply_to_email = 'no-reply@nusa.ng';
		$reply_to_name = 'NUSA';
		$to = $email;
		$subject_to_user = 'Password reset';
		$message_to_user = '<p>Dear '.$user->firstname.',</p><p>The password on your account has been reset successfully.</p>
			<p><b>New password: </b>'.$new_password.'</p>
			<p><b>Important</b><br />Please change the password to one of your choice from you account profile page.</p>
			<p>Warm regards<br />NUSA</p>';

		$message = $this->automated_email_model->message_cleanup($message_to_user, $user_id);
		$this->send_email($from_email, $from_name, $reply_to_email, $reply_to_name, $to, $subject_to_user, $message_to_user);

        $this->session->action_success_message = 'Password reset and details has been sent to your email';
        redirect(base_url().'dashboard/reset_password/');
	}

    /*
    * Display own profile for logged in user
    */
	public function update_photo()
	{
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
		}
		
		$config['upload_path'] 		= './assets/img/profile_images/';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png';
		$config['max_size']     	= '2048';
		$config['file_name']		= time().'-'.$this->session->user_id;

		$this->load->library('upload', $config);

		if(!$this->upload->do_upload('userfile'))
        {
			$this->session->action_error_message = $this->upload->display_errors();
			redirect(base_url().'dashboard/profile/');
		}
		
		$upload_data = $this->upload->data();

		$db_data = array(
			'photo' => $upload_data['file_name']
		);
		$this->user_model->update($db_data, $this->session->user_id);
		
		$this->session->action_success_message = 'Profile photo saved';
		redirect(base_url().'dashboard/profile/');
	}

    /*
    * Display own profile for logged in user
    */
	public function upload_id()
	{
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
		}
		
		$config['upload_path'] 		= './assets/img/valid_ids/';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png';
		$config['max_size']     	= '2048';
		$config['file_name']		= time().'-'.$this->session->user_id;

		$this->load->library('upload', $config);

		if(!$this->upload->do_upload('userfile'))
        {
			$this->session->action_error_message = $this->upload->display_errors();
			redirect(base_url().'dashboard/profile/');
		}
		
		$upload_data = $this->upload->data();

		$db_data = array(
			'valid_id' => $upload_data['file_name']
		);
		$this->user_model->update($db_data, $this->session->user_id);
		
		$this->session->action_success_message = 'ID saved';
		redirect(base_url().'dashboard/profile/');
	}

    /*
    * Display own profile for logged in user
    */
    public function profile()
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
		}
        
        $user = $this->user_model->find($this->session->user_id);

        if(!isset($user))
        {
            $this->session->action_error_message = 'Invalid resource selection.';
            redirect(base_url().'dashboard');
        }

        $now = time();
        $db_check = array(
            'user_id'=> $this->session->user_id
        );
        $subscriptions = $this->member_subscription_model->get_where($db_check);
        $no_subscriptions = count($subscriptions);

		$data = array(
            'page_title'       => 'My profile',
            'user'             => $user,
            'no_subscriptions' => $no_subscriptions,
            'subscriptions'    => $subscriptions,
            'now'              => time()
        );
        
        if($user->membership == 'Student')
        {
            $db_check = array(
                'user_id' => $this->session->user_id
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
                'user_id' => $this->session->user_id
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
                'user_id' => $this->session->user_id
            );
            $result = $this->authorization_detail_model->get_where($db_check);
            if(count($result) > 0)
            {
                $data['authorization_detail'] = $result[0];
            }
        }

		$this->load->view('templates/header', $data);
		$this->load->view('profile_view');
		$this->load->view('templates/footer');
    }

    /*
    * Display subscriptions for logged in member
    */
    public function subscriptions($id=0)
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
		}
		        
        if($this->session->user_type !== 'Member')
        {
            redirect(base_url().'dashboard/');
        }
		
		// check for suspended account
		$user_current_details = $this->user_model->find($this->session->user_id);
        if($user_current_details->status == 'Suspended')
        {
			$this->session->status = 'Suspended';
            redirect(base_url().'dashboard/');
		}
		// end check for suspended account

        $now = time();
        $db_check = array(
            'user_id'=> $this->session->user_id
        );
        $offset = $id;
        $limit = 50;
		$subscriptions = $this->member_subscription_model->paginate($db_check, $limit, $offset);
		$total = count($this->member_subscription_model->get_where($db_check));
        
        $config['base_url'] = base_url().'dashboard/subscriptions/';
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

		$data = array(
            'page_title'	=> 'My subscriptions',
            'now'           => $now,
            'subscriptions' => $subscriptions,
            'total'         => $total,
            'start'         => $offset + 1,
            'end'           => $offset + count($subscriptions)
        );

		$this->load->view('templates/header', $data);
		$this->load->view('subscriptions_view');
		$this->load->view('templates/footer');
    }

    /*
    * Displays products available for purchase to the logged in member
    */
	public function shop($id=0)
	{
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
		        
        if($this->session->user_type !== 'Member')
        {
            redirect(base_url().'dashboard/');
        }
		
		// check for suspended account
		$user_current_details = $this->user_model->find($this->session->user_id);
        if($user_current_details->status == 'Suspended')
        {
			$this->session->status = 'Suspended';
            redirect(base_url().'dashboard/');
		}
		// end check for suspended account
        
        $offset = $id;
		$limit = 50;
		$db_check = array(
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
        
        $products = $this->product_model->paginate_where($db_check, $limit, $offset);
        $total = count($products);
        
        $config['base_url'] = base_url().'dashboard/shop/';
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);
        
		$data = array(
            'page_title'    => 'Shop',
            'products'     	=> $products,
            'total'         => $total,
            'start'         => $offset + 1,
            'end'           => $offset + count($products)
		);

		$this->load->view('templates/header', $data);
		$this->load->view('shop_view');
		$this->load->view('templates/footer');
    }

    /*
    * displays the details of a specific shop item for order confirmation
    */
    public function shop_item($id=0)
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
		        
        if($this->session->user_type !== 'Member')
        {
            redirect(base_url().'dashboard/');
		}
		
		// check for suspended account
		$user_current_details = $this->user_model->find($this->session->user_id);
        if($user_current_details->status == 'Suspended')
        {
			$this->session->status = 'Suspended';
            redirect(base_url().'dashboard/');
		}
		// end check for suspended account
		
		$db_check = array(
			'id'	 => $id,
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
            $this->session->action_error_message = 'Invalid item selection.';
            redirect(base_url().'dashboard/shop/');
		}

        $db_check = array(
            'product_id' => $product[0]->id
        );

        if($product[0]->type == 'Subscription')
        {
            $product_detail = $this->subscription_product_model->get_where($db_check);
        }
        elseif($product[0]->type == 'Non-subscription')
        {
            $product_detail = $this->non_subscription_product_model->get_where($db_check);
        }
        
		$data = array(
            'page_title'	=> 'Shop item - '.$product[0]->name,
            'product'		=> $product[0]
        );
        if(isset($product_detail[0]))
        {
            $data['item_detail'] = $product_detail[0];
        }

		$this->load->view('templates/header', $data);
		$this->load->view('shop_item_view');
		$this->load->view('templates/footer');
    }

    /*
    * confirms availability and suitability of items before sumbiting the order
    */
    public function submit_order($product_id=0)
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
		        
        if($this->session->user_type !== 'Member')
        {
            redirect(base_url().'dashboard/');
		}
		
		// check for suspended account
		$user_current_details = $this->user_model->find($this->session->user_id);
        if($user_current_details->status == 'Suspended')
        {
			$this->session->status = 'Suspended';
            redirect(base_url().'dashboard/');
		}
		// end check for suspended account

		$this->form_validation->set_rules('submit', 'Submit order button', 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$this->session->action_error_message = validation_errors();
			redirect(base_url().'dashboard/shop/');
		}
		
		$db_check = array(
			'id'	 => $product_id,
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
            $this->session->action_error_message = 'Invalid item selection.';
            redirect(base_url().'dashboard/shop/');
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

    /*
    * Display orders for logged in member
    */
    public function orders($id=0)
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
		}
		        
        if($this->session->user_type !== 'Member')
        {
            redirect(base_url().'dashboard/');
		}
		
		// check for suspended account
		$user_current_details = $this->user_model->find($this->session->user_id);
        if($user_current_details->status == 'Suspended')
        {
			$this->session->status = 'Suspended';
            redirect(base_url().'dashboard/');
		}
		// end check for suspended account
		
        $db_check = array(
            'user_id'=> $this->session->user_id
        );
        $offset = $id;
        $limit = 50;
		$orders = $this->order_model->paginate_where($db_check, $limit, $offset);
		$total = count($this->order_model->get_where($db_check));
        
        $config['base_url'] = base_url().'dashboard/orders/';
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

		$data = array(
            'page_title'	=> 'My orders',
            'orders'		=> $orders,
            'total'         => $total,
            'start'         => $offset + 1,
            'end'           => $offset + count($orders)
        );

		$this->load->view('templates/header', $data);
		$this->load->view('orders_view');
		$this->load->view('templates/footer');
    }

    /*
    * displays the details of a specific order item
    */
    public function order_item($id=0)
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
		        
        if($this->session->user_type !== 'Member')
        {
            redirect(base_url().'dashboard/');
		}
		
		// check for suspended account
		$user_current_details = $this->user_model->find($this->session->user_id);
        if($user_current_details->status == 'Suspended')
        {
			$this->session->status = 'Suspended';
            redirect(base_url().'dashboard/');
		}
		// end check for suspended account
        
        $order = $this->order_model->find($id);
        if(empty($order))
        {
            $this->session->action_error_message = 'Invalid item selection.';
            redirect(base_url().'dashboard/orders/');
		}

        $db_check = array(
            'id' => $order->product_id
		);
		$product = $this->product_model->get_where($db_check);
        if(empty($product))
        {
            $this->session->action_error_message = 'Faulty order selection.';
            redirect(base_url().'dashboard/orders/');
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
		
		$setting = $this->setting_model->get();
		$payment_processor = $this->payment_processor_model->find($setting->payment_processor_id);

        $db_check = array(
            'order_id' => $order->id
        );
        $payments = $this->payment_model->get_where($db_check);
        
		$data = array(
			'page_title'	=> 'Order item - '.$order->description,
			'order'			=> $order,
			'product'		=> $product[0],
			'payments'		=> $payments,
			'payment_processor'	=> $payment_processor
        );
        if(isset($product_detail[0]))
        {
            $data['item_detail'] = $product_detail[0];
		}

		$this->load->view('templates/header', $data);
		$this->load->view('order_item_view');
		$this->load->view('templates/footer');
    }

    /*
    * Display free resources available to the logged in member
    */
    public function resources($id=0)
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
		}
		        
        if($this->session->user_type !== 'Member')
        {
            redirect(base_url().'dashboard/');
		}
		
		// check for suspended account
		$user_current_details = $this->user_model->find($this->session->user_id);
        if($user_current_details->status == 'Suspended')
        {
			$this->session->status = 'Suspended';
            redirect(base_url().'dashboard/');
		}
		// end check for suspended account

		if($this->session->membership == 'Individual')
		{
			$db_check = array(
				'for_individual'=> 1
			);
		}
		elseif($this->session->membership == 'Corporate')
		{
			$db_check = array(
				'for_corporate'=> 1
			);
		}
		elseif($this->session->membership == 'Student')
		{
			$db_check = array(
				'for_student'=> 1
			);
		}
		
        $offset = $id;
        $limit = 50;
		$resources = $this->member_resource_model->paginate_where($db_check, $limit, $offset);
		$total = count($this->member_resource_model->get_where($db_check));
        
        $config['base_url'] = base_url().'dashboard/resources/';
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

		$data = array(
            'page_title'	=> 'My resources',
            'resources'		=> $resources,
            'total'         => $total,
            'start'         => $offset + 1,
            'end'           => $offset + count($resources)
        );

		$this->load->view('templates/header', $data);
		$this->load->view('resources_view');
		$this->load->view('templates/footer');
    }

    /*
    * displays the details of a specific resource item
    */
    public function resource_item($id=0)
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
		        
        if($this->session->user_type !== 'Member')
        {
            redirect(base_url().'dashboard/');
		}
		
		// check for suspended account
		$user_current_details = $this->user_model->find($this->session->user_id);
        if($user_current_details->status == 'Suspended')
        {
			$this->session->status = 'Suspended';
            redirect(base_url().'dashboard/');
		}
		// end check for suspended account
        
        $resource = $this->member_resource_model->find($id);
        if(empty($resource))
        {
            $this->session->action_error_message = 'Invalid item selection.';
            redirect(base_url().'dashboard/resources/');
		}

		if($this->session->membership == 'Individual')
		{
			if($resource->for_individual != 1)
			{
				$this->session->action_error_message = 'Wrong item selection.';
				redirect(base_url().'dashboard/resources/');
			}
		}
		elseif($this->session->membership == 'Corporate')
		{
			if($resource->for_corporate != 1)
			{
				$this->session->action_error_message = 'Wrong item selection.';
				redirect(base_url().'dashboard/resources/');
			}
		}
		elseif($this->session->membership == 'Student')
		{
			if($resource->for_student != 1)
			{
				$this->session->action_error_message = 'Wrong item selection.';
				redirect(base_url().'dashboard/resources/');
			}
		}

		$data = array(
            'page_title'	=> 'Resource item',
            'resource'		=> $resource
        );

		$this->load->view('templates/header', $data);
		$this->load->view('resource_item_view');
		$this->load->view('templates/footer');
    }

	/*
	* push out emails with provided parameters
	*/
	public function send_email($from_email, $from_name, $reply_to_email, $reply_to_name, $to, $subject, $message)
	{		
		$this->email->from($from_email, $from_name);
		$this->email->reply_to($reply_to_email, $reply_to_name);
		$this->email->to($to);

		$this->email->subject($subject);
		$this->email->message($message);

		$this->email->send();

	}

	public function email_template()
	{
		$this->load->view('templates/email');
	}

    public function paystack_payment($order_id=0)
    {
        
		$order = $this->order_model->find($order_id);
		if(empty($order))
		{
			$this->session->action_error_message = 'Invalid item selection.';
			redirect(base_url().'dashboard/orders/');
		}
		$db_check = array(
			'name' => 'Paystack'
		);
		$payment_processor = $this->payment_processor_model->get_where($db_check);
		
		$curl = curl_init();

		$email = $this->session->email;
		$amount = $order->amount * 100;  //the amount in kobo. This value is actually NGN 300
		$reference = $order->id.'-'.time();
		$metadata = array(
			'custom_fields' => array(
				'order_number' => $order->id
			)
		);
		

		// url to go to after payment
		$callback_url = base_url().'verifypaystack_transaction/';

		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode([
			'amount'=>$amount,
			'email'=>$email,
			'reference'=> $reference,
			'callback_url' => $callback_url,
			'metadata' => $metadata
		]),
		CURLOPT_HTTPHEADER => [
			"authorization: Bearer ".$payment_processor->secret_key, //replace this with your own test key
			"content-type: application/json",
			"cache-control: no-cache"
		],
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		if($err){
		// there was an error contacting the Paystack API
			die('Curl returned error: ' . $err.'<div style="margin: 80px auto;"><a href="'.base_url().'dashboard/orders/"><< Back to Order history</a></div>');
		}

		$tranx = json_decode($response, true);

		if(!$tranx['status']){
		// there was an error from the API
			print_r('API returned error: ' . $tranx['message']);
			die('<div style="margin: 80px auto;"><a href="'.base_url().'dashboard/orders/"><< Back to Order history</a></div>');
		}

		// comment out this line if you want to redirect the user to the payment page
		// print_r($tranx);
		// redirect to page so User can pay
		// uncomment this line to allow the user redirect to the payment page
		header('Location: ' . $tranx['data']['authorization_url']);
    }
}
