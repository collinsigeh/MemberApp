<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$data = array(
			'page_title' => 'Dashboard'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('dashboard_view');
		$this->load->view('templates/footer');
	}

	public function register()
	{
		$data = array(
			'page_title' => 'New registration'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('register_view');
		$this->load->view('templates/footer');
	}

	public function registering_user()
	{
		$data = array(
			'page_title' => 'New registration - Page 2'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('register_page2_view');
		$this->load->view('templates/footer');
	}

	public function login()
	{
		$data = array(
			'page_title' => 'Login'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('login_view');
		$this->load->view('templates/footer');
	}

	public function loging_in()
	{
		echo 'i got here processing login';
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
