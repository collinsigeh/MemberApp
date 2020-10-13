<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		        
        if($this->session->user_type !== 'Admin')
        {
            redirect(base_url().'dashboard/');
        }
        
        $this->load->model('user_model');
        $this->load->model('payment_model');
        
        $this->load->library('pagination');
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

	public function index($id=0)
	{
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
        
        $offset = $id;
        $limit = 50;
        
        $payments = $this->payment_model->paginate($limit, $offset);
        $total = count($this->payment_model->get());
        
        $config['base_url'] = base_url().'payments/index/';
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);
        
		$data = array(
            'page_title'    => 'Payments',
            'payments'     => $payments,
            'total'         => $total,
            'start'         => $offset + 1,
            'end'           => $offset + count($payments)
		);

		$this->load->view('templates/header', $data);
		$this->load->view('payments/index_view');
		$this->load->view('templates/footer');
    }
}