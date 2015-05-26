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

	public function index($offset = 0)
	{

		$config['total_rows'] = $this->user_model->count();
		$config['base_url']=base_url().'index.php/admin/users/index/';
		$config['per_page'] = 20;
		$data['users'] = $this->user_model->get($config['per_page'], $offset);

		$this->load->library('pagination');
		$this->pagination->initialize($config);

		$head['title']='User List';

		$this->load->view('partials/head',$head);

		$this->load->view('users/index', $data);
		
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
		                'rules' => 'required',
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

             	redirect('admin/info/',301);
            
             }else {

             	$message = ' <strong>Fail!</strong> Fail to create user  <b>'.$data['username'].'!</b> Please be patient';
			    
             	$this->session->set_flashdata('userFlashData', custom_message('info',$message));

             	redirect('admin/info/',301);

             }

        }
    }

    public function view($offset=0)
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
            $config['total_rows'] = $this->user_model->count();
			$config['base_url']=base_url().'index.php/admin/users/index/';
			$config['per_page'] = 20;
			$data['users'] = $this->user_model->get($config['per_page'], $offset);

			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$head['title']='User List';

			$this->load->view('partials/head',$head);

			$this->load->view('users/index', $data);
        } else {

        	$filter = $this->input->get('filter');
        	$value = $this->input->get('data');
        	$conditions=array($filter=>$value);
        	
    		$config['total_rows'] = $this->user_model->count($conditions);
			$config['base_url']=base_url().'index.php/admin/users/index/';
			$config['per_page'] = 10000;
			$data['users'] = $this->user_model->get($config['per_page'], $offset, $conditions);

			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$head['title']='User List';

			$this->load->view('partials/head',$head);

			$this->load->view('users/index', $data);

        } 

    	
    }

    public function show($id)
    {
    	$data= $this->user_model->getWithAddress($id);
    	$head['title']='User Details';

    	$this->load->view('partials/head',$head);

		$this->load->view('users/show', $data);
    }

    public function delete($id)
    {
    	if ($this->user_model->delete($id)) {
    		$message = ' <strong>Success!</strong> User deleted';
			    
	     	$this->session->set_flashdata('userFlashData', custom_message('danger',$message));

	     	redirect('admin/info/',301);
    	} else {
    		$message = ' <strong>Fail!</strong> Unable to delete user. Please try again later!';
			    
	     	$this->session->set_flashdata('userFlashData', custom_message('info',$message));

	     	redirect('admin/info/',301);
    	}
    	

    	
    }

} //End of Class