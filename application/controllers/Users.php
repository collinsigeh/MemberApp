<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		        
        if($this->session->user_type !== 'Admin')
        {
            redirect(base_url().'dashboard/');
        }

		$this->load->model('user_model');
        $this->load->model('setting_model');
        $this->load->model('member_subscription_model');
        $this->load->model('student_info_model');
        $this->load->model('professional_info_model');
        
        $this->load->library('pagination');
		$this->load->library('form_validation');
        $this->load->library('email');
    }

	public function index($id=0)
	{
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
        
        $offset = $id;
        $limit = 50;
        
        $users = $this->user_model->paginate($limit, $offset);
        if(empty($users))
        {
            $this->session->action_error_message = 'Unavailable resource selection.';
            redirect(base_url().'dashboard');
        }
        $total = count($this->user_model->get());
        
        $config['base_url'] = base_url().'users/index/';
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);
        
		$data = array(
            'page_title'    => 'Users',
            'users'         => $users,
            'total'         => $total,
            'start'         => $offset + 1,
            'end'           => $offset + count($users)
		);

		$this->load->view('templates/header', $data);
		$this->load->view('users/index_view');
		$this->load->view('templates/footer');
    }

    /*
    * Details of the user with id of $id
    */
    public function account($id=0)
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
        
        $user = $this->user_model->find($id);

        if(!isset($user))
        {
            $this->session->action_error_message = 'Invalid resource selection.';
            redirect(base_url().'dashboard');
        }

        $now = time();
        $db_check = array(
            'user_id'=> $id
        );
        $no_subscriptions = count($this->member_subscription_model->get_where($db_check));

		$data = array(
            'page_title'       => 'User detail',
            'user'             => $user,
            'no_subscriptions' => $no_subscriptions
        );
        
        if($user->membership == 'Student')
        {
            $db_check = array(
                'user_id' => $id
            );
            $result = $this->student_info_model->get_where($db_check);
            if(count($result) > 0)
            {
                $data['student_info'] = $result[0];
            }
        }
        else
        {
            $db_check = array(
                'user_id' => $id
            );
            $result = $this->professional_info_model->get_where($db_check);
            if(count($result) > 0)
            {
                $data['professional_info'] = $result[0];
            }
        }

        if($user->use_status == 'Operator' OR $user->use_status == 'Recreational')
        {
            $db_check = array(
                'user_id' => $id
            );
            $result = $this->authorization_detail_mode->get_where($db_check);
            if(count($result) > 0)
            {
                $data['authorization_detail'] = $result[0];
            }
        }

		$this->load->view('templates/header', $data);
		$this->load->view('users/account_view');
		$this->load->view('templates/footer');
    }

    /*
    * List of subscriptions for the user with id of $id
    */
    public function subscriptions($id=0)
    {

    }
}