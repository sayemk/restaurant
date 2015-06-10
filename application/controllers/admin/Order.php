<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('access');
		
		$this->load->helper('form');

		$this->load->model('order_model');
	}

	public function index($offset =0)
	{
		$config['total_rows'] = $this->order_model->count();
		$config['base_url']=base_url().'index.php/admin/order/index/';
		$config['per_page'] = 20;

		$data['orders'] = $this->order_model->get($config['per_page'], $offset);
		// print_r($data);
		// exit();
		$this->load->library('pagination');
		$this->pagination->initialize($config);


		$head['title'] = 'Order List';

		$this->load->view('partials/head',$head);

		$this->load->view('orders/index',$data);
	}

	public function show($order_id)
	{
		$data = $this->order_model->getDetails($order_id, array('orders.id' =>$order_id));
		$head['title'] = 'Order Detals';
		$this->load->view('partials/head',$head);

		$this->load->view('orders/show',$data);
	}


	public function view($offset = 0)
	{
		$post['filter'] = $this->input->get('filter');
    	$post['data'] = $this->input->get('data');

    	$this->load->library('form_validation');
    	$this->form_validation->set_data($post);

    	$rules = array(
					array(
			                'field' => 'filter',
			                'label' => 'option',
			                'rules' => 'required',
			                'errors' => array(
		                        'required' => 'You must select a %s',
		                	),
			        ),
			        array(
			                'field' => 'data',
			                'label' => 'Data field',
			                'rules' => 'required',
			                'errors' => array(
		                        'required' => 'You must provide a value for %s',
		                	),
			        ),
		        );
    	

    	$this->form_validation->set_rules($rules);

    	if ($this->form_validation->run() == FALSE)
        {
			$config['total_rows'] = $this->order_model->count();
			$config['base_url']=base_url().'index.php/admin/order/index/';
			$config['per_page'] = 20;

			$data['orders'] = $this->order_model->get($config['per_page'], $offset);
			// print_r($data);
			// exit();
			$this->load->library('pagination');
			$this->pagination->initialize($config);


			$head['title'] = 'Order List';

			$this->load->view('partials/head',$head);

			$this->load->view('orders/index',$data);
		} else {

        	$filter = $this->input->get('filter');
        	$value = $this->input->get('data');
        	$conditions=array($filter=>$value);
        	
    		$config['total_rows'] = $this->order_model->count($conditions);
			$config['base_url']=base_url().'index.php/admin/order/index/';
			$config['per_page'] = 10000;

			$data['orders'] = $this->order_model->get($config['per_page'], $offset,$conditions);
			// print_r($data);
			// exit();
			$this->load->library('pagination');
			$this->pagination->initialize($config);


			$head['title'] = 'Order List';

			$this->load->view('partials/head',$head);

			$this->load->view('orders/index',$data);

        } 
	}

	public function edit($order_id)
	{
		$data = $this->order_model->getDetails($order_id, array('orders.id' =>$order_id));
		$head['title'] = 'Order Detals';
		$this->load->view('partials/head',$head);

		$this->session->set_flashdata('order_id',$order_id);

		$this->load->view('orders/edit',$data);
	}

	public function update()
	{
		$rules = array(
					array(
			                'field' => 'status',
			                'label' => 'Status',
			                'rules' => 'required|alpha',
			                'errors' => array(
		                        'required' => 'You must select a %s',
		                	),
			        )
		        );
    	
		$this->load->library('form_validation');
    	
    	$this->form_validation->set_rules($rules);

    	if ($this->form_validation->run() == FALSE)
        {
        	$order_id = $this->session->flashdata('order_id');
        	$data = $this->order_model->getDetails($order_id, array('orders.id' =>$order_id));
			$head['title'] = 'Order Detals';
			$this->load->view('partials/head',$head);

			$this->session->set_flashdata('order_id',$order_id);

			$this->load->view('orders/edit',$data);
        }else {

        	$order_id= $this->session->flashdata('order_id');
        	$data['status'] = $this->input->post('status');
        	

        	if ($this->order_model->update($order_id, $data)) {
        		
        		$message = ' <strong>Success!</strong> Order status has been changed to <b>'.$data['status'].'</b> successfully ';
			    
             	$this->session->set_flashdata('userFlashData', custom_message('success',$message));

             	redirect('admin/order/edit/'.$order_id, 301);

        	} else {
        		
        		$message = ' <strong>Fail!</strong> Order status didn\'t change';
			    
             	$this->session->set_flashdata('userFlashData', custom_message('info',$message));

             	redirect('admin/order/edit/'.$order_id, 301);

          	}

        	
        }
	}

}

/* End of file Order.php */
/* Location: ./application/controllers/admin/Order.php */ 