<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('user_model');
		$this->load->model('setting_model');

		$this->load->library('form_validation');
		$this->load->library('email');
	}

	public function index()
	{
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
		}

		$data = array(
			'page_title' => 'Dashboard'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('dashboard_view');
		$this->load->view('templates/footer');
	}

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
			elseif($this->session->use_status == 'Research' OR $this->session->use_status == 'Recreational')
			{
				$this->session->ncaa_roc_number = strtoupper(trim($this->input->post('ncaa_roc_number')));

				$this->form_validation->set_rules('ncaa_roc_number', 'NCAA ROC Number', 'trim|required');
			}
			
			// agreement confirmation
			$this->form_validation->set_rules('code_of_conduct', 'NUSA Code of Conduct', 'required');
			$this->form_validation->set_rules('terms_and_conditions', 'Terms and Conditions', 'required');

			if($this->form_validation->run() == FALSE)
			{
				$this->session->action_error_message = validation_errors();
				redirect(base_url().'dashboard/register_page2/');
			}

			// register details (as is applicable)

			// - register user account and get user_id
			$password 	= $this->user_model->generate_new_password();
			
			$status 	= 'Active';
			if($this->setting_model->require_approval() == 1)
			{
				$status = 'Pending Approval';
			}

			$db_data = array(
				'membership'	=> $this->session->membership,
				'email' 		=> $this->session->email,
				'password' 		=> password_hash($password, PASSWORD_DEFAULT),
				'status' 		=> $status,
				'title' 		=> $this->session->title,
				'firstname' 	=> $this->session->firstname,
				'lastname' 		=> $this->session->lastname,
				'phone' 		=> $this->session->phone,
				'gender' 		=> $this->session->gender,
				'use_status' 	=> $this->session->use_status,
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
					'office_address'			=> $this->session->office_address
				);

				$this->professional_info_model->save($db_data);
			}

			if($this->session->use_status == 'Operator')
			{// - if operator, then register appropriate authorization details
				
				$db_data = array(
					'user_id'	=> $user_id,
					'incaa_roc_number ' 		=> $this->session->institution,
					'vlos_class_of_operation'	=> $this->session->vlos,
					'bvlos_class_of_operation'	=> $this->session->bvlos,
					'approved_operation'		=> $this->session->approved_operation
				);

				$this->authorization_detail_model->save($db_data);
			}
			elseif($this->session->use_status == 'Research' OR $this->session->use_status == 'Recreational')
			{// - if researcher or or recreational, then register appropriate authorization details
				
				$db_data = array(
					'user_id'	=> $user_id,
					'incaa_roc_number ' 		=> $this->session->institution,
					'approved_operation'		=> 'N/A'
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
			$subject 		= $result[0]['user_subject_line'];
			$message 		= $result[0]['message_to_user'];

			$message = $this->automated_email_model->message_cleanup($message, $user_id);

			$this->automated_email_model->send($from_email, $from_name, $reply_to_email, $reply_to_name, $to, $subject, $message);

			// conditionally send notification to admin

			// auto login user with a welcome message (e.g. to purchase a subscription package)
		}
		else
		{// fall back page (redirection)
			
			redirect(base_url().'dashboard/register/');
		}
	}

	public function login()
	{	
		// redirects to dashboard if user is logged-in

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

	public function reset_password()
	{
		$data = array(
			'page_title' => 'Reset password'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('reset_password_view');
		$this->load->view('templates/footer');
	}

	public function requesting_password_reset()
	{
		echo 'i got here processing password reset';
	}
}
