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
    
    /*
    * For saving updates to the application settings
    */
    public function update()
    {
        // verify form inputs
		$this->form_validation->set_rules('admin_approval', 'Require Admin Approval for New Accounts', 'trim|required');
		$this->form_validation->set_rules('email', 'Main Admin Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('notify_admin', 'Send Notification to Admin for New Accounts', 'trim|required');
		$this->form_validation->set_rules('payment_processor', 'Active Payment Processor', 'trim|required');

        if($this->form_validation->run() == FALSE)
        {
            $this->session->action_error_message = validation_errors();
            redirect(base_url().'settings/application/');
        }

        // validate admin email
        $valid_email_found = 0;
        $db_check = array(
            'email'     => $this->input->post('email'),
            'user_type' => 'Admin'
        );
        $result = $this->user_model->get_where($db_check);
        if(!empty($result))
        {
            $valid_email_found = count($result);
        }

        if($valid_email_found == 0)
        {
            $this->session->action_error_message = '<b><i>'.$this->input->post('email').'</i></b> is NOT recognized for any admin user.';
            redirect(base_url().'settings/application/');
        }
        
        // payment processor cleanup
        $valid_payment_processor_found = 0;
        $db_check = array(
            'id'     => $this->input->post('payment_processor')
        );
        $result = $this->payment_processor_model->get_where($db_check);
        if(!empty($result))
        {
            $payment_processor = $result[0]['id'];
        }
        else
        {
            $payment_processor = 0;
        }

        // update db
        $db_data = array(
            'require_manual_approval_on_new_reg' => $this->input->post('admin_approval'),
            'main_admin_email' => $this->input->post('email'),
            'send_admin_email_on_new_reg' => $this->input->post('notify_admin'),
            'payment_processor_id' => $payment_processor
        );
        $this->setting_model->update($db_data);
        $this->session->action_success_message = 'Update saved.';
        redirect(base_url().'settings/application/');
    }
    
}