<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifypaystack_transaction extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('user_model');
		$this->load->model('payment_processor_model');
		$this->load->model('order_model');

		$this->load->library('form_validation');
		$this->load->library('email');
    }

    /*
    * Verifies a payment transaction
    */
    public function index()
    {

        $db_check = array(
            'name' => 'Paystack'
        );
        $payment_processor = $this->payment_processor_model->get_where($db_check);
        
        if(!empty($payment_processor))
        {            

            $curl = curl_init();
    
      
    
            curl_setopt_array($curl, array(
          
              CURLOPT_URL => "https://api.paystack.co/transaction/verify/:".$this->input->get('reference'),
          
              CURLOPT_RETURNTRANSFER => true,
          
              CURLOPT_ENCODING => "",
          
              CURLOPT_MAXREDIRS => 10,
          
              CURLOPT_TIMEOUT => 30,
          
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          
              CURLOPT_CUSTOMREQUEST => "GET",
          
              CURLOPT_HTTPHEADER => array(
          
                "Authorization: ".$payment_processor->secret_key,
          
                "Cache-Control: no-cache",
          
              ),
          
            ));
          
            
          
            $response = curl_exec($curl);
          
            $err = curl_error($curl);
          
            curl_close($curl);
          
            
          
            if ($err) {
          
              //$this->session->action_error_message =  "cURL Error #:" . $err;
              echo "cURL Error #:" . $err;
          
            } else {
          
              echo $response;
          
            }
        }
        else
        {
            // $this->session->action_error_message = 'No Paystack processor details';
            echo 'No Paystack processor details';
        }
        
        // redirect(base_url().'dashboard/order_item/'.$this->input->get('reference'));
    }
}