<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meal extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('access');
		
		$this->load->helper('form');

		$this->load->model('meal_model');
		$this->load->model('meal_category_model');
	}

	public function index($offset = 0)
	{
		$config['total_rows'] = $this->meal_model->count();
		$config['base_url']=base_url().'index.php/admin/meal/index/';
		$config['per_page'] = 20;

		$data['meals'] = $this->meal_model->get($config['per_page'], $offset);
		
		$this->load->library('pagination');
		$this->pagination->initialize($config);


		$head['title'] = 'View All Meals';

		$this->load->view('partials/head',$head);

		$this->load->view('meals/index',$data);
	}

	public function create()
	{
		$head['title'] = 'Add New Meal';

		$data['categories'] = $this->meal_category_model->get();

    	$this->load->view('partials/head',$head);

		$this->load->view('meals/create',$data);
	}

	public function save()
	{
		
		$this->load->library('form_validation');

		$this->config->load('validations/meal');
		
		$this->form_validation->set_rules($this->config->item('meal'));

		if ($this->form_validation->run() == FALSE)
        {
           	$head['title'] = 'Add New Meal';

			$data['categories'] = $this->meal_category_model->get();

	    	$this->load->view('partials/head',$head);

			$this->load->view('meals/create',$data);

        }else {

        	$meal['name'] = $this->input->post('name');
        	$meal['category_id'] = $this->input->post('category');
        	$meal['price'] = $this->input->post('price');
        	$meal['description'] = $this->input->post('description');

        	$meal['slug'] = create_slug($meal['name']);

        	        	
        	if ($this->meal_model->create($meal)) {
        		
        		$message = ' <strong>Success!</strong> Meal <b>'.$meal['name'].'</b> saved successfully ';
			    
             	$this->session->set_flashdata('userFlashData', custom_message('success',$message));

             	redirect('admin/info/',301);

        	} else {
        		
        		$message = ' <strong>Fail!</strong> Meal <b>'.$meal['name'].'</b> didn\'t save';
			    
             	$this->session->set_flashdata('userFlashData', custom_message('info',$message));

             	redirect('admin/info/',301);
        	}

        }
	}

}

/* End of file Meal.php */
/* Location: ./application/controllers/admin/Meal.php */ 