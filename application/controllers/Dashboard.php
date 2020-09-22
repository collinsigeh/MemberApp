<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('user_model');

		$this->load->library('form_validation');
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

		$data = array(
			'page_title' => 'New registration'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('register_view');
		$this->load->view('templates/footer');
	}

	public function registering_user()
	{
		if($this->session->userlogged_in == '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/');
		}

		if($this->input->post('form_page') == 'reg_page1')
		{// submission from 1st reg. page
			
			//validate form enteries

			$this->form_validation->set_rules('membership', 'Membership type', 'trim|required');
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('use_status', 'Member Status (Best description of your work with unmanned systems)', 'trim|required');

			if($this->form_validation->run() == FALSE)
			{
				$this->session->action_error_message = validation_errors();
				redirect(base_url().'dashboard/register/');
			}

			// create necessary session variables

			// load reg. page 2

			$data = array(
				'page_title' => 'New registration - Page 2'
			);

			$this->load->view('templates/header', $data);
			$this->load->view('register_page2_view');
			$this->load->view('templates/footer');
		}
		elseif($this->input->post('form_page') == 'reg_page2.2')
		{// submission from 2nd reg. page

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
		$result = $this->user_model->get($db_check);
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
		// reset all generic session variables to log out user_error

		$this->session->user_id = 0;
		$this->session->user_type = '';
		$this->session->membership = '';
		$this->session->email = '';
		$this->session->status = '';
		$this->session->title = '';
		$this->session->firstname = '';
		$this->session->lastname = '';
		$this->session->phone = '';
		$this->session->gender = '';
		$this->session->use_status = '';

		$this->session->userlogged_in = '';

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
