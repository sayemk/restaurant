<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*Author@Abu Sayem
*Email@sayem@asteriskbd.com
*Controller for Admin dashboard.
*/
class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('access');
	}
	public function index()
	{
		$data['title']='Dashboard';

		$this->load->view('partials/head',$data);
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */ ?>