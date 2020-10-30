<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_guide extends CI_Controller {

    public function index()
    {

        $data = array(
            'page_title' => 'User guide'
        );

		$this->load->view('templates/header', $data);
		$this->load->view('user_guide/index_view');
		$this->load->view('templates/footer');
    }

}