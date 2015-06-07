<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*Author@Abu Sayem
*Email@sayem@asteriskbd.com
*Controller for Users login, logout and access controll.
*/

class Access extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');

		$this->load->model('user_model');
	}
	public function index()
	{
		$this->load->view('users/login');
	}

	public function login()
	{
		
		$this->load->library('form_validation');

		$config = array(
				array(
		                'field' => 'username',
		                'label' => 'Username',
		                'rules' => 'required|min_length[5]|max_length[30]|callback_username_check'
		        ),
		        array(
		                'field' => 'password',
		                'label' => 'Password',
		                'rules' => 'required|callback_password_check',
		                'errors' => array(
		                        'required' => 'You must provide a %s.',
		                )
		        )
		    );
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('users/login');

        }else  {
        	$username = $this->input->post('username');

        	$userData = $this->user_model->get_where(array('username'=>$username, 'status'=>'1'));

        	$sessionData['username'] = $userData[0]->username;
        	$sessionData['type'] = $userData[0]->type;
        	$sessionData['id'] = $userData[0]->id;
        	$this->session->set_userdata($sessionData);

        	redirect('admin/dashboard/',301);
        }
	}

	public function username_check($username)
	{
		if($this->user_model->get_where(array('username'=>$username, 'status'=>'1')))
		{
			return TRUE;
		}else {
			
			$this->form_validation->set_message('username_check', 'Username does not exits!');
            return FALSE;
		}
	}

	public function password_check($password)
	{
		//Load encrypt library
        $this->load->library('encrypt');

        $username = $this->input->post('username');

        $userData = $this->user_model->get_where(array('username'=>$username, 'status'=>'1'));

        $encryptPassword = $this->encrypt->decode($userData[0]->password, $userData[0]->salt);
        
		if(trim($encryptPassword)==trim($password))
		{
			return TRUE;
		}else {
			
			$this->form_validation->set_message('password_check', 'Password does not match with the username!');
            return FALSE;
		}
	}

	public function logout()
	{
		
		$this->session->unset_userdata( array('username', 'type'));
		$this->session->sess_destroy();

		redirect('admin/access/',301);
	}

}

/* End of file Access.php */
/* Location: ./application/controllers/admin/Access.php */