<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		        
        if($this->session->user_type !== 'Admin')
        {
            redirect(base_url().'dashboard/');
        }
        
        $this->load->model('setting_model');
        $this->load->model('product_model');
        
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
        
        $products = $this->product_model->paginate($limit, $offset);
        $total = count($products);
        
        $config['base_url'] = base_url().'products/index/';
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);
        
		$data = array(
            'page_title'    => 'Products',
            'products'     => $products,
            'total'         => $total,
            'start'         => $offset + 1,
            'end'           => $offset + count($products)
		);

		$this->load->view('templates/header', $data);
		$this->load->view('products/index_view');
		$this->load->view('templates/footer');
    }

	public function create()
	{
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }

        $this->form_validation->set_rules('product_type', 'Product type', 'trim|required');

        if($this->form_validation->run() == FALSE)
        {
            if(isset($this->session->product_type) && strlen($this->session->product_type) > 1)
            {
                $product_type = $this->session->product_type;
            }
            else
            {
                $this->session->action_error_message = validation_errors();
                redirect(base_url().'products/');
            }
        }
        else
        {
            $product_type = $this->session->product_type = $this->input->post('product_type');
        }

        if($product_type != 'Non-subscription' && $product_type != 'Subscription')
        {
            $this->session->action_error_message = 'Invalid product type selection';
            redirect(base_url().'products/');
        }

        $data = array(
            'page_title'   => 'New product',
            'product_type' => $product_type
        );
        
		$this->load->view('templates/header', $data);
		$this->load->view('products/create_view');
		$this->load->view('templates/footer');
    }
}