<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*Author@Abu Sayem
*Email@sayem@asteriskbd.com
*Controller for Users functionalities.
*/
class Users extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		
	}

	public function login()
	{
		$this->load->helper('form');
		
		$this->load->view('users/login');
	}

	public function loggedIn()
	{
		
	}

	public function add()
	{
		$data['title']='Add New User';

		$this->load->view('partials/head',$data);

		$this->load->view('users/add');
	}

	public function create()
	{
		$this->load->library('form_validation');

		$config = array(
				array(
		                'field' => 'username',
		                'label' => 'Username',
		                'rules' => 'required|min_length[5]|max_length[30]|is_unique[users.username]'
		        ),
		        array(
		                'field' => 'password',
		                'label' => 'Password',
		                'rules' => 'required|matches[conf_password]',
		                'errors' => array(
		                        'required' => 'You must provide a %s.',
		                ),
		        ),
		        array(
		                'field' => 'conf_password',
		                'label' => 'Confirm Password ',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'email',
		                'label' => 'Email',
		                'rules' => 'required|valid_email|is_unique[users.email]'
		        ),
		        array(
		                'field' => 'phone',
		                'label' => 'Phonr',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'group',
		                'label' => 'User Group',
		                'rules' => 'required|numeric',
		                 'errors' => array(
		                        'numeric' => 'Don\'t temper data',
		                ),
		        )
			);
			
			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == FALSE)
            {
                   $data['title']='Add New User';

				   $this->load->view('partials/head',$data);

				   $this->load->view('users/add');
            }
            else
            {
                    $this->load->view('formsuccess');
            }
}




}