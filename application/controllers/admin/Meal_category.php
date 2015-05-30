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
		$head['title'] = 'Add New Meal Category';

		$data['categories'] = $this->meal_category_model->get();

    	$this->load->view('partials/head',$head);
    	$this->load->view('meal_categories/index',$data);
			
	}

	public function create()
	{
		$head['title'] = 'Add New Meal Category';

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
        		
        		$message = ' <strong>Success!</strong> Meal Category <b>'.$data['name'].'</b> saved successfully ';
			    
             	$this->session->set_flashdata('userFlashData', custom_message('success',$message));

             	redirect('admin/info/',301);

        	} else {

        		$message = ' <strong>Fail!</strong> Meal Category <b>'.$data['name'].'</b> didn\'t save';
			    
             	$this->session->set_flashdata('userFlashData', custom_message('info',$message));

             	redirect('admin/info/',301);
        	}
        	

        }
    }

    public function edit($id)
    {
    	 $this->session->set_flashdata('cat_id',$id);

    	 $data['category'] = $this->meal_category_model->find($id);
    	 $head['title'] = 'Edit Meal Category';
    	 $this->load->view('partials/head',$head);
    	 $this->load->view('meal_categories/edit', $data);

    }

    public function update()
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
             
             $id = $this->session->flashdata('cat_id');

             $this->session->set_flashdata('cat_id',$id);

             $data['category'] = $this->meal_category_model->find($id);
	    	 $head['title'] = 'Edit Meal Category';
	    	 $this->load->view('partials/head',$head);
	    	 $this->load->view('meal_categories/edit', $data);

        }else {

        	$data['name'] = $this->input->post('name');
        	$data['description'] = $this->input->post('description');
        	$id = $this->session->flashdata('cat_id');

        	if ($this->meal_category_model->update($data, $id)) {
        		
        		$message = ' <strong>Success!</strong>  Meal Category <b>'.$data['name'].'</b> Updated successfully ';
			    
             	$this->session->set_flashdata('userFlashData', custom_message('success',$message));

             	redirect('admin/meal_category/edit/'.$id,301);

        	} else {

        		$message = ' <strong>Fail!</strong> Meal Category <b>'.$data['name'].'</b> didn\'t Updated';
			    
             	$this->session->set_flashdata('userFlashData', custom_message('info',$message));

             	redirect('admin/meal_category/edit/'.$id,301);
        	}	
            

        }
    }

    public function delete($id)
	{
		if ($this->meal_category_model->delete($id)) {
    		$message = ' <strong>Success!</strong> Meal Category deleted';
			    
	     	$this->session->set_flashdata('userFlashData', custom_message('success',$message));

	     	redirect('admin/info/',301);
    	} else {
    		$message = ' <strong>Fail!</strong> Unable to delete Meal Category. Please try again later!';
			    
	     	$this->session->set_flashdata('userFlashData', custom_message('info',$message));

	     	redirect('admin/info/',301);
    	}
		
	}
   
}

/* End of file Meal_category.php */
/* Location: ./application/controllers/admin/Meal_category.php */ 