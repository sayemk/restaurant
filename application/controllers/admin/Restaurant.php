<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant extends CI_Controller {

	public function index()
	{
		
	}
	public function create()
	{
		$head['title']='Add New Restaurant';

    	$this->load->view('partials/head',$head);

		$this->load->view('restaurants/create');
	}

}

/* End of file Restaurant.php */
/* Location: ./application/controllers/admin/Restaurant.php */ 