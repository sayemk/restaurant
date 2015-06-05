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
		print_r($data);
		exit();
		$this->load->library('pagination');
		$this->pagination->initialize($config);


		$head['title'] = 'Order List';

		$this->load->view('partials/head',$head);

		$this->load->view('orders/index',$data);
	}

}

/* End of file Order.php */
/* Location: ./application/controllers/admin/Order.php */ 