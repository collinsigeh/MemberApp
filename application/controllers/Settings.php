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
		$this->load->model('automated_email_model');

		$this->load->library('form_validation');
		
		// check for suspended account
		$user_current_details = $this->user_model->find($this->session->user_id);
        if($user_current_details->status == 'Suspended')
        {
			$this->session->status = 'Suspended';
            redirect(base_url().'dashboard/');
		}
		// end check for suspended account
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
    
    /*
    * For a list of automated emails
    */
    public function automated_emails()
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }

		$data = array(
            'page_title'        => 'Settings - Automated emails',
            'automated_emails'  => $this->automated_email_model->get()
		);

		$this->load->view('templates/header', $data);
		$this->load->view('settings/automated_emails_view');
		$this->load->view('templates/footer');
    }
    
    /*
    * For viewing the details of an automated email
    */
    public function automated_email($id=0)
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
        
        $automated_email = $this->automated_email_model->find($id);

        if(!isset($automated_email))
        {
            $this->session->action_error_message = 'Invalid resource selection.';
            redirect(base_url().'dashboard');
        }

		$data = array(
            'page_title'        => 'Settings - Automated email',
            'automated_email'  => $automated_email
		);

		$this->load->view('templates/header', $data);
		$this->load->view('settings/automated_email_view');
		$this->load->view('templates/footer');
    }
    
    /*
    * For saving updates to automated emails
    */
    public function update_automated_email($id=0)
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
        
        $automated_email = $this->automated_email_model->find($id);

        if(!isset($automated_email))
        {
            $this->session->action_error_message = 'Invalid resource selection.';
            redirect(base_url().'dashboard');
        }
        
        // verify form inputs
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('user_subject_line', 'User subject line', 'trim|required');
		$this->form_validation->set_rules('message_to_user', 'Message to user', 'trim|required');
		$this->form_validation->set_rules('sender_name', 'Sender name', 'trim|required');
		$this->form_validation->set_rules('sender_email', 'Sender email', 'trim|required|valid_email');
		$this->form_validation->set_rules('admin_subject_line', 'Admin subject line', 'trim|required');
		$this->form_validation->set_rules('message_to_admin', 'Message to admin', 'trim|required');

        if($this->form_validation->run() == FALSE)
        {
            $this->session->action_error_message = validation_errors();
            redirect(base_url().'settings/automated_email/'.$id);
        }

        // update db
        $db_data = array(
            'description' => trim($this->input->post('description')),
            'user_subject_line' => trim($this->input->post('user_subject_line')),
            'message_to_user' => trim($this->input->post('message_to_user')),
            'sender_name' => trim($this->input->post('sender_name')),
            'sender_email' => strtolower(trim($this->input->post('sender_email'))),
            'admin_subject_line' => trim($this->input->post('admin_subject_line')),
            'message_to_admin' => trim($this->input->post('message_to_admin'))
        );
        $this->automated_email_model->update($db_data, $id);
        $this->session->action_success_message = 'Update saved.';
        redirect(base_url().'settings/automated_email/'.$id);
    }
    
    /*
    * For a list of payment processors
    */
    public function payment_processors()
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }

		$data = array(
            'page_title'        => 'Settings - Payment processorss',
            'payment_processors'  => $this->payment_processor_model->get()
		);

		$this->load->view('templates/header', $data);
		$this->load->view('settings/payment_processors_view');
		$this->load->view('templates/footer');
    }
    
    /*
    * For viewing the details of a payment processor
    */
    public function payment_processor($id=0)
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
        
        $payment_processor = $this->payment_processor_model->find($id);

        if(!isset($payment_processor))
        {
            $this->session->action_error_message = 'Invalid resource selection.';
            redirect(base_url().'dashboard');
        }

		$data = array(
            'page_title'        => 'Settings - Payment processor',
            'payment_processor'  => $payment_processor
		);

		$this->load->view('templates/header', $data);
		$this->load->view('settings/payment_processor_view');
		$this->load->view('templates/footer');
    }
    
}