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

	public function index()
	{
		
	}

}

/* End of file Order.php */
/* Location: ./application/controllers/admin/Order.php */ 