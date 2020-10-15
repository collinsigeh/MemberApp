<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members_directory extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        
        $this->load->model('user_model');
        
        $this->load->library('pagination');
    }

    /*
    * Display a directory of registered and active members
    */
	public function index($id=0)
	{
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
        
        $offset = $id;
        $limit = 50;

        $db_check = array(
            'user_type' => 'Member',
            'status'    => 'Active'
        );
        
        $members = $this->user_model->paginate_where($db_check, $limit, $offset);
        $total = count($this->user_model->get_where($db_check));
        
        $config['base_url'] = base_url().'orders/index/';
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);
        
		$data = array(
            'page_title'    => 'Members directory',
            'members'       => $members,
            'total'         => $total,
            'start'         => $offset + 1,
            'end'           => $offset + count($members)
		);

		$this->load->view('templates/header', $data);
		$this->load->view('members_directory/index_view');
		$this->load->view('templates/footer');
    }
}