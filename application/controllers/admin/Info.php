<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*Author@Abu Sayem
*Email@sayem@asteriskbd.com
*Controller for Users functionalities.
*/
class Info extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();

		$this->load->library('access');
		
	}

	public function index()
	{
		$data['info']=$this->session->flashdata('userFlashData');
    	$head['title']='Info Page';

		$this->load->view('partials/head',$head);

		$this->load->view('info',$data);
	}
}