<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		        
        if($this->session->user_type !== 'Admin')
        {
            redirect(base_url().'dashboard/');
        }

		$this->load->model('user_model');
		$this->load->model('setting_model');
		$this->load->model('payment_processor_model');
		$this->load->model('professional_info_model');
		$this->load->model('student_info_model');
		$this->load->model('automated_email_model');

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
			'page_title' => 'Settings'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('settings/index_view');
		$this->load->view('templates/footer');
    }
    
    /*
    * For viewing the application settings
    */
	public function application()
	{
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }

		$data = array(
            'page_title'    => 'Settings',
            'settings'      => $this->setting_model->get(),
            'payment_processors'    => $this->payment_processor_model->get()
		);

		$this->load->view('templates/header', $data);
		$this->load->view('settings/application_view');
		$this->load->view('templates/footer');
	}
    
}