<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_resources extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		        
        if($this->session->user_type !== 'Admin')
        {
            redirect(base_url().'dashboard/');
        }
        
        $this->load->model('member_resource_model');
        
        $this->load->library('pagination');
		$this->load->library('form_validation');
    }

	public function index($id=0)
	{
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
        
        $offset = $id;
        $limit = 50;
        
        $resources = $this->member_resource_model->paginate($limit, $offset);
        $total = count($this->member_resource_model->get());
        
        $config['base_url'] = base_url().'member_resources/index/';
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);
        
		$data = array(
            'page_title'    => 'Resources',
            'resources'     => $resources,
            'total'         => $total,
            'start'         => $offset + 1,
            'end'           => $offset + count($resources)
		);

		$this->load->view('templates/header', $data);
		$this->load->view('member_resources/index_view');
		$this->load->view('templates/footer');
    }
}