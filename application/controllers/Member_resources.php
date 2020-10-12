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

	/*
	* display resource creation form
	*/
	public function create()
	{
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }

        $data = array(
            'page_title'        => 'New resource'
        );
        
		$this->load->view('templates/header', $data);
		$this->load->view('member_resources/create_view');
		$this->load->view('templates/footer');
    }

	/*
	* save resource details
    */
    public function save()
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
        
        $this->form_validation->set_rules('name', 'Item name', 'trim|required|is_unique[member_resources.name]');
        $this->form_validation->set_rules('description', 'Item description', 'trim|required');
        $this->form_validation->set_rules('type', 'Nature of item', 'trim|required|in_list[Non-downloadable,Downloadable]');

        $db_data['name']           = $this->session->item_name              = trim($this->input->post('name'));
        $db_data['for_individual'] = $this->session->item_for_individual    = $this->input->post('for_individual');
        $db_data['for_corporate']  = $this->session->item_for_corporate     = $this->input->post('for_corporate');
        $db_data['for_student']    = $this->session->item_for_student       = $this->input->post('for_student');
        $db_data['description']    = $this->session->item_description       = $this->input->post('description');
        $db_data['type']           = $this->session->item_type              = $this->input->post('type');
        $db_data['download_link']  = $this->session->item_download_link     = $this->input->post('download_link');
        $db_data['created_at']     = time();

        if($db_data['type'] == 'Downloadable')
        {
            $this->form_validation->set_rules('download_link', 'Download_link', 'trim|required|valid_url');
        }

        if($this->form_validation->run() == FALSE)
        {
            $this->session->action_error_message = validation_errors();
            redirect(base_url().'member_resources/create/');
        }

        $this->member_resource_model->save($db_data);

        $this->session->unset_userdata('item_name');
        $this->session->unset_userdata('item_for_individual');
        $this->session->unset_userdata('item_for_corporate');
        $this->session->unset_userdata('item_for_student');
        $this->session->unset_userdata('item_description');
        $this->session->unset_userdata('item_type');
        $this->session->unset_userdata('item_download_link');

        $this->session->action_success_message = 'Item saved.';
        redirect(base_url().'member_resources/');
    }
}