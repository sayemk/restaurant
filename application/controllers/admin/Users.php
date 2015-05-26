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

		$this->load->library('access');
		
		$this->load->helper('form');
		$this->load->model('user_model');
		
	}

	public function index($page = 0)
	{
		$this->load->library('pagination');
		
		if ($page>0) {
			
		} else {
			# code...
		}
		
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
		                'label' => 'Phone',
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
             
             $data['type'] = $this->input->post('group');

             $data['username'] = $this->input->post('username');

             $data['phone'] = $this->input->post('phone');
             $data['email'] = $this->input->post('email');
             $data['fullname'] = $this->input->post('name');
             //Load encrypt library
             $this->load->library('encrypt');

             $data['salt'] = randomString(16);

             $data['password'] = $this->encrypt->encode($this->input->post('password'), $data['salt']);

             $data['api_key'] = randomString(32);

             $data['status'] = '0';

             $reset_token = $api_key = randomString(32);

             if ($this->user_model->create($data, $reset_token)) {

             	$this->load->library('email');

             	$this->email->sendRegistration(array($data['email']), $reset_token);

             	$message = ' <strong>Success!</strong> User <b>'.$data['username'].'</b> created and an activation email is send';
			    
             	$this->session->set_flashdata('userFlashData', custom_message('success',$message));

             	redirect('admin/users/info/',301);
            
             }else {

             	$message = ' <strong>Fail!</strong> Fail to create user  <b>'.$data['username'].'!</b> Please be patient';
			    
             	$this->session->set_flashdata('userFlashData', custom_message('info',$message));

             	redirect('admin/users/info/',301);

             }

        }
    }

	public function info()
    {
    	$data['info']=$this->session->flashdata('userFlashData');
    	$head['title']='Info Page';

		$this->load->view('partials/head',$head);

		$this->load->view('info',$data);
    }

} //End of Class