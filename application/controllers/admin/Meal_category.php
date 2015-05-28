<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*Author@Abu Sayem
*Email@sayem@asteriskbd.com
*Controller for Meal Category functionalities.
*/
class Meal_category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('access');
		
		$this->load->helper('form');

		$this->load->model('meal_category_model');

	}

	public function index()
	{
		
	}

	public function create()
	{
		$head['title'] = 'Add New Restaurant';

    	$this->load->view('partials/head',$head);

		$this->load->view('meal_categories/create');
	}

	public function save()
	{
		$this->load->library('form_validation');

		$config = array(
					array(
			                'field' => 'name',
			                'label' => 'Name',
			                'rules' => 'required'
			        ));
		
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
        {
            $head['title'] = 'Add New Restaurant';

	    	$this->load->view('partials/head',$head);

			$this->load->view('meal_categories/create');

        }else {

        	$data['name'] = $this->input->post('name');
        	$data['description'] = $this->input->post('description');

        	if ($this->meal_category_model->create($data)) {
        		
        		$message = ' <strong>Success!</strong> Category <b>'.$data['name'].'</b> saved successfully ';
			    
             	$this->session->set_flashdata('userFlashData', custom_message('success',$message));

             	redirect('admin/info/',301);

        	} else {

        		$message = ' <strong>Fail!</strong> Category <b>'.$data['name'].'</b> didn\'t save';
			    
             	$this->session->set_flashdata('userFlashData', custom_message('info',$message));

             	redirect('admin/info/',301);
        	}
        	

        }
    }

}

/* End of file Meal_category.php */
/* Location: ./application/controllers/admin/Meal_category.php */ 