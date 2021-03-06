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
        
        $this->load->model('user_model');
        $this->load->model('setting_model');
        $this->load->model('product_model');
        $this->load->model('payment_processor_model');
        $this->load->model('subscription_product_model');
        $this->load->model('non_subscription_product_model');
        
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
        
        $products = $this->product_model->paginate($limit, $offset);
        $total = count($this->product_model->get());
        
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

	/*
	* display product creation form
	*/
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

        $result  = $this->setting_model->get();
        $payment_processor = $this->payment_processor_model->find($result->payment_processor_id);

        $data = array(
            'page_title'        => 'New product',
            'product_type'      => $product_type,
            'currency_symbol'   => $payment_processor->currency_symbol
        );
        
		$this->load->view('templates/header', $data);
		$this->load->view('products/create_view');
		$this->load->view('templates/footer');
    }

	/*
	* save product details
    */
    public function save()
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }

        $result  = $this->setting_model->get();
        $payment_processor = $this->payment_processor_model->find($result->payment_processor_id);

        $this->form_validation->set_rules('product_type', 'Product type', 'trim|required|in_list[Non-subscription,Subscription]');
        $this->form_validation->set_rules('name', 'Product name', 'trim|required|is_unique[products.name]');
        $this->form_validation->set_rules('amount', 'Price ('.$payment_processor->currency_symbol.')', 'trim|required|numeric');
        
        $product_data['type']   = $this->input->post('product_type');

        $product_data['name']           = $this->session->product_name              = trim($this->input->post('name'));
        $product_data['for_individual'] = $this->session->product_for_individual    = $this->input->post('for_individual');
        $product_data['for_corporate']  = $this->session->product_for_corporate     = $this->input->post('for_corporate');
        $product_data['for_student']    = $this->session->product_for_student       = $this->input->post('for_student');
        
        $product_data['amount'] = $this->session->product_price = $this->input->post('amount');

        $result  = $this->setting_model->get();
        $payment_processor = $this->payment_processor_model->find($result->payment_processor_id);

        $product_data['currency_symbol'] = $payment_processor->currency_symbol;

        if($this->session->product_type == 'Subscription')
        {
            $this->form_validation->set_rules('subscription_type', 'Product type', 'trim|required|in_list[Membership,Non-membership]');
            $this->form_validation->set_rules('duration', 'Validity (days)', 'trim|required|integer');
            $this->form_validation->set_rules('user_limit', 'Product type', 'trim|required|integer');

            $subscription_data['type']          = $this->session->product_subscription_type     = $this->input->post('subscription_type');
            $subscription_data['user_limit']    = $this->session->product_user_limit            = $this->input->post('user_limit');
            $subscription_data['duration']      = $this->session->product_subscription_duration = $this->input->post('duration');
        }
        elseif($this->session->product_type == 'Non-subscription')
        {
            $this->form_validation->set_rules('nature', 'Nature of product', 'trim|required|in_list[Downloadable,Non-downloadable]');
            
            $non_subscription_data['nature'] = $this->session->product_nature = $this->input->post('nature');

            if($this->input->post('nature') == 'Downloadable')
            {
                $this->form_validation->set_rules('download_link', 'Download link', 'trim|required|valid_url');
                $non_subscription_data['download_link'] = $this->session->product_download_link = $this->input->post('download_link');
            }
        }

        $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[Available,NOT Available]');

        $product_data['status']     = $this->session->product_status = $this->input->post('status');
        $product_data['created_at'] = time();

        if($this->form_validation->run() == FALSE)
        {
            $this->session->action_error_message = validation_errors();
            redirect(base_url().'products/create/');
        }

        $this->product_model->save($product_data);

        $result     = $this->product_model->get_where($product_data);
        $product    = $result[0];

        if($this->session->product_type == 'Subscription')
        {
            $subscription_data['product_id'] = $product->id;

            $this->subscription_product_model->save($subscription_data);

            $this->session->unset_userdata('product_subscription_type');
            $this->session->unset_userdata('product_user_limit');
            $this->session->unset_userdata('product_subscription_duration');
        }
        elseif($this->session->product_type == 'Non-subscription')
        {
            $non_subscription_data['product_id'] = $product->id;

            $this->non_subscription_product_model->save($subscription_data);

            $this->session->unset_userdata('nature');
            $this->session->unset_userdata('downlaod_link');
        }

        $this->session->unset_userdata('product_name');
        $this->session->unset_userdata('product_for_individual');
        $this->session->unset_userdata('product_for_corporate');
        $this->session->unset_userdata('product_for_student');
        $this->session->unset_userdata('product_price');
        $this->session->unset_userdata('product_status');

        $this->session->action_success_message = 'Product saved.';
        redirect(base_url().'products/');
    }

    /*
    * displays the details of a specific product
    */
    public function item($id=0)
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
        
        $product = $this->product_model->find($id);
        if(empty($product))
        {
            $this->session->action_success_message = 'Invalid item selection.';
            redirect(base_url().'products/');
        }

        $db_check = array(
            'product_id' => $product->id
        );

        if($product->type == 'Subscription')
        {
            $product_detail = $this->subscription_product_model->get_where($db_check);
            /*
            if(empty($product_detail))
            {
                $this->session->action_success_message = 'Invalid item selection.';
                redirect(base_url().'products/');
            }
            */
        }
        elseif($product->type == 'Non-subscription')
        {
            $product_detail = $this->non_subscription_product_model->get_where($db_check);
            /*
            if(empty($product_detail))
            {
                $this->session->action_success_message = 'Invalid item selection.';
                redirect(base_url().'products/');
            }
            */
        }
        
		$data = array(
            'page_title'        => 'Product detail',
            'product'           => $product
        );
        if(isset($product_detail[0]))
        {
            $data['item_detail'] = $product_detail[0];
        }

		$this->load->view('templates/header', $data);
		$this->load->view('products/item_view');
		$this->load->view('templates/footer');
    }

    /*
    * Update the details of the product with id of $id
    */
    public function update($id=0)
    {
		if($this->session->userlogged_in !== '*#loggedin@Yes')
		{
			redirect(base_url().'dashboard/login/');
        }
        
        $product = $this->product_model->find($id);

        if(!isset($product))
        {
            $this->session->action_error_message = 'Invalid resource selection.';
            redirect(base_url().'products/');
        }
        
        $this->form_validation->set_rules('name', 'Product name', 'trim|required');
        $this->form_validation->set_rules('amount', 'Price ('.$product->currency_symbol.')', 'trim|required|numeric');

        $product_data['name']           = trim($this->input->post('name'));
        $product_data['for_individual'] = $this->input->post('for_individual');
        $product_data['for_corporate']  = $this->input->post('for_corporate');
        $product_data['for_student']    = $this->input->post('for_student');
        $product_data['amount']         = $this->input->post('amount');

        if($product->type == 'Subscription')
        {
            $this->form_validation->set_rules('subscription_type', 'Product type', 'trim|required|in_list[Membership,Non-membership]');
            $this->form_validation->set_rules('duration', 'Validity (days)', 'trim|required|integer');
            $this->form_validation->set_rules('user_limit', 'Product type', 'trim|required|integer');

            $subscription_data['type']          = $this->input->post('subscription_type');
            $subscription_data['user_limit']    = $this->input->post('user_limit');
            $subscription_data['duration']      = $this->input->post('duration');
        }
        elseif($this->session->product_type == 'Non-subscription')
        {
            $this->form_validation->set_rules('nature', 'Nature of product', 'trim|required|in_list[Downloadable,Non-downloadable]');
            
            $non_subscription_data['nature'] = $this->input->post('nature');

            if($this->input->post('nature') == 'Downloadable')
            {
                $this->form_validation->set_rules('download_link', 'Download link', 'trim|required|valid_url');
                $non_subscription_data['download_link'] = $this->input->post('download_link');
            }
        }

        $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[Available,NOT Available]');

        $product_data['status']     = $this->input->post('status');
        $product_data['created_at'] = time();

        if($this->form_validation->run() == FALSE)
        {
            $this->session->action_error_message = validation_errors();
            redirect(base_url().'products/item/'.$id);
        }

        //check if product name is already in use
        $db_check = array(
            'name' => $product_data['name'],
            'id !=' => $id
        );
        if(count($this->product_model->get_where($db_check)) > 0)
        {
            $this->session->action_error_message = 'The name - <i>'.$product_data['name'].'</i> - is in use.';
            redirect(base_url().'products/item/'.$id);
        }

        $this->product_model->update($product_data, $id);

        $db_check = array(
            'product_id' => $product->id
        );

        if($product->type == 'Subscription')
        {
            $this->subscription_product_model->update_where($subscription_data, $db_check);
        }
        elseif($product->type == 'Non-subscription')
        {
            $this->non_subscription_product_model->update_where($non_subscription_data, $db_check);
        }

        $this->session->action_success_message = 'Update saved.';
        redirect(base_url().'products/item/'.$id);
    }
}