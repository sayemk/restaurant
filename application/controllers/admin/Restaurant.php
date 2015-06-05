<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*Author@Abu Sayem
*Email@sayem@asteriskbd.com
*Controller for Users functionalities.
*/
class Restaurant extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('access');
		
		$this->load->helper('form');

		$this->load->model('country_model');

		$this->load->model('restaurant_model');

		$this->load->model('address_model');

	}

	public function index($offset = 0)
	{
		$config['total_rows'] = $this->restaurant_model->count();
		$config['base_url']=base_url().'index.php/admin/restaurant/index/';
		$config['per_page'] = 20;

		$data['restaurants'] = $this->restaurant_model->get($config['per_page'], $offset);
		
		$this->load->library('pagination');
		$this->pagination->initialize($config);


		$head['title'] = 'Add New Restaurant';

		$this->load->view('partials/head',$head);

		$this->load->view('restaurants/index',$data);
	}

	public function create()
	{
		$head['title'] = 'Add New Restaurant';

		$data['countries'] = $this->country_model->get();

    	$this->load->view('partials/head',$head);

		$this->load->view('restaurants/create',$data);
	}

	public function save()
	{
		$this->load->library('form_validation');

		$this->config->load('validations/restaurant');
		
		$this->form_validation->set_rules($this->config->item('restaurant'));

		if ($this->form_validation->run() == FALSE)
        {
            $head['title'] = 'Add New Restaurant';

			$data['countries'] = $this->country_model->get();

	    	$this->load->view('partials/head',$head);

			$this->load->view('restaurants/create',$data);
        }else {

        	$address['address_line_1'] = $this->input->post('address_line');
        	$address['city'] = $this->input->post('city');
        	$address['state'] = $this->input->post('state');
        	$address['zip'] = $this->input->post('zip');
        	$address['country'] = $this->input->post('country');
        	$address['type'] = 'restaurant';

        	$restaurant['name'] = $this->input->post('name');
        	$restaurant['phone'] = $this->input->post('phone');
        	$restaurant['email'] = $this->input->post('email');
        	$restaurant['website'] = $this->input->post('website');
        	$restaurant['service_start'] = $this->input->post('start');
        	$restaurant['service_end'] = $this->input->post('close');
        	$restaurant['latitude'] = $this->input->post('latitude');
        	$restaurant['longitude'] = $this->input->post('longitude');
        	$restaurant['description'] = $this->input->post('description');
        	$restaurant['status'] = 'Active';

        	if ($this->restaurant_model->create($address, $restaurant)) {
        		
        		$message = ' <strong>Success!</strong> Restaurant <b>'.$restaurant['name'].'</b> saved successfully ';
			    
             	$this->session->set_flashdata('userFlashData', custom_message('success',$message));

             	redirect('admin/info/',301);

        	} else {
        		
        		$message = ' <strong>Fail!</strong> Restaurant <b>'.$restaurant['name'].'</b> didn\'t save';
			    
             	$this->session->set_flashdata('userFlashData', custom_message('info',$message));

             	redirect('admin/info/',301);
        	}
        	
        }
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
            $config['total_rows'] = $this->restaurant_model->count();
			$config['base_url']=base_url().'index.php/admin/restaurant/index/';
			$config['per_page'] = 20;

			$data['restaurants'] = $this->restaurant_model->get($config['per_page'], $offset);
			
			$this->load->library('pagination');
			$this->pagination->initialize($config);


			$head['title'] = 'Add New Restaurant';

			$this->load->view('partials/head',$head);

			$this->load->view('restaurants/index',$data);
        } else {

        	$filter = $this->input->get('filter');
        	$value = $this->input->get('data');
        	$conditions=array($filter=>$value);
        	
    		$config['total_rows'] = $this->restaurant_model->count($conditions);
			$config['base_url']=base_url().'index.php/admin/restaurant/index/';
			$config['per_page'] = 10000;
			$data['restaurants'] = $this->restaurant_model->get($config['per_page'], $offset, $conditions);

			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$head['title']='User List';

			$this->load->view('partials/head',$head);

			$this->load->view('restaurants/index', $data);

        } 
	}

	public function show($id)
	{
		$data= $this->restaurant_model->getWithAddress($id);
    	$head['title']='Restaurant Details';

    	$this->load->view('partials/head',$head);

		$this->load->view('restaurants/show', $data);
	}

	public function delete($id)
	{
		if ($this->restaurant_model->delete($id)) {
    		$message = ' <strong>Success!</strong> Restaurant deleted';
			    
	     	$this->session->set_flashdata('userFlashData', custom_message('success',$message));

	     	redirect('admin/info/',301);
    	} else {
    		$message = ' <strong>Fail!</strong> Unable to delete restaurant. Please try again later!';
			    
	     	$this->session->set_flashdata('userFlashData', custom_message('info',$message));

	     	redirect('admin/info/',301);
    	}
		
	}

	public function edit($id)
	{
		$data= $this->restaurant_model->getWithAddress($id);
    	$head['title']='Restaurant Edit';

    	$this->session->set_flashdata('restaurant_id',$id);
    	$this->session->set_flashdata('address_id',$data['addresses']->id);

    	$data['countries'] = $this->country_model->get();

    	$this->load->view('partials/head',$head);

		$this->load->view('restaurants/edit', $data);
	}

	public function update()
	{
		
		$this->load->library('form_validation');

		$this->config->load('validations/restaurant');
		
		$this->form_validation->set_rules($this->config->item('restaurant'));

		if ($this->form_validation->run() == FALSE)
        {
            $data= $this->restaurant_model->getWithAddress($id);
	    	$head['title']='Restaurant Edit';

	    	$data['countries'] = $this->country_model->get();

	    	$this->session->set_flashdata('restaurant_id',$this->session->flashdata('restaurant_id'));
    		$this->session->set_flashdata('address_id',$this->session->flashdata('address_id'));

	    	$this->load->view('partials/head',$head);

			$this->load->view('restaurants/edit', $data);
        }else {

        	$address['address_line_1'] = $this->input->post('address_line');
        	$address['city'] = $this->input->post('city');
        	$address['state'] = $this->input->post('state');
        	$address['zip'] = $this->input->post('zip');
        	$address['country'] = $this->input->post('country');
        	$address['type'] = 'restaurant';

        	$restaurant['name'] = $this->input->post('name');
        	$restaurant['phone'] = $this->input->post('phone');
        	$restaurant['email'] = $this->input->post('email');
        	$restaurant['website'] = $this->input->post('website');
        	$restaurant['service_start'] = $this->input->post('start');
        	$restaurant['service_end'] = $this->input->post('close');
        	$restaurant['latitude'] = $this->input->post('latitude');
        	$restaurant['longitude'] = $this->input->post('longitude');
        	$restaurant['description'] = $this->input->post('description');
        	$restaurant['status'] = 'Active';

        	$restaurant_id = $this->session->flashdata('restaurant_id');

        	$address_id = $this->session->flashdata('address_id');

        	if ($this->restaurant_model->update($address, $restaurant, $address_id, $restaurant_id)) {
        		
        		$message = ' <strong>Success!</strong> Restaurant <b>'.$restaurant['name'].'</b> updated successfully ';
			    
             	$this->session->set_flashdata('userFlashData', custom_message('success',$message));

             	redirect('admin/restaurant/edit/'.$restaurant_id, 301);

        	} else {
        		
        		$message = ' <strong>Fail!</strong> Restaurant <b>'.$restaurant['name'].'</b> didn\'t updated';
			    
             	$this->session->set_flashdata('userFlashData', custom_message('info',$message));

             	redirect('admin/restaurant/edit/'.$restaurant_id, 301);
        	}
        	
        }
	}

	

}

/* End of file Restaurant.php */
/* Location: ./application/controllers/admin/Restaurant.php */ 