<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant_meal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('access');
		
		$this->load->helper('form');

		$this->load->model('restaurant_model');
		$this->load->model('meal_model');
		$this->load->model('image_model');
		$this->load->model('restaurant_meal_model');
	}


	public function index($offset=0)
	{
		$config['total_rows'] = $this->restaurant_meal_model->count();
		$config['base_url']=base_url().'index.php/admin/restaurant_meal/index/';
		$config['per_page'] = 20;

		$data['meals'] = $this->restaurant_meal_model->get($config['per_page'], $offset);
		
		$this->load->library('pagination');
		$this->pagination->initialize($config);


		$head['title'] = 'View Meals by Restaurant';

		$this->load->view('partials/head',$head);

		$this->load->view('restaurant_meals/index',$data);
	}
	public function add()
	{
		$head['title']='Add Meals to Restaurant';

    	$this->load->view('partials/head',$head);

    	$data['restaurants'] =$this->restaurant_model->getSelect();
    	$data['meals'] =$this->meal_model->getSelect();

    	$this->load->view('restaurant_meals/meal', $data);
	}

	public function save()
	{
		$this->load->library('form_validation');
		$this->config->load('validations/restaurant');
		
		$this->form_validation->set_rules($this->config->item('restaurant_meal'));

    	if ($this->form_validation->run() == FALSE)
        {
        	$head['title']='Add Meals to Restaurant';

	    	$this->load->view('partials/head',$head);

	    	$data['restaurants'] =$this->restaurant_model->getSelect();
	    	$data['meals'] =$this->meal_model->getSelect();

	    	$this->load->view('restaurant_meals/meal', $data);
        }else {
        	
        	$config['upload_path'] = './uploads/images/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size']             =1024;
	        $config['overwrite']			=False;
	        $config['file_name']			=time().'_'.$_FILES["userfile"]['name'];
	        $config['file_ext_tolower']		=TRUE;
			
			$this->load->library('upload', $config);
		
			if ( ! $this->upload->do_upload()){
				$data['errors'] = array('error' => $this->upload->display_errors());
				$head['title']='Add Meals to Restaurant';

		    	$this->load->view('partials/head',$head);

		    	$data['restaurants'] =$this->restaurant_model->getSelect();
		    	$data['meals'] =$this->meal_model->getSelect();

		    	$this->load->view('restaurant_meals/meal', $data);
			}else {

				$file_data =$this->upload->data();

				
				$image['name']=$file_data['file_name'];
				$image['thumbnail']=$file_data['raw_name'].'_thumb'.$file_data['file_ext'];
				
				
				$data['meal_id']=$this->input->post('meal');
				$data['restaurant_id']=$this->input->post('restaurant');
				$data['price']=$this->input->post('price');
				$data['image_id'] = $this->image_model->save($image);

				if ($this->restaurant_meal_model->save($data)) {
					$message = ' <strong>Success!</strong> Meal to Restaurant saved successfully ';
				    
	             	$this->session->set_flashdata('userFlashData', custom_message('success',$message));

	             	redirect('admin/info/',301);

	        	} else {
	        		
	        		$message = ' <strong>Fail!</strong> Meal to Restaurant didn\'t save';
				    
	             	$this->session->set_flashdata('userFlashData', custom_message('info',$message));

	             	redirect('admin/info/',301);
				
				}
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
			                'rules' => 'required|numeric',
			                'errors' => array(
		                        'required' => 'You must provide a value for %s',
		                	),
			        ),
		        );
    	

    	$this->form_validation->set_rules($rules);

    	if ($this->form_validation->run() == FALSE)
        {
            $config['total_rows'] = $this->restaurant_meal_model->count($conditions);
			$config['base_url']=base_url().'index.php/admin/restaurant_meal/index/';
			$config['per_page'] = 20;

			$data['meals'] = $this->restaurant_meal_model->get($config['per_page'], $offset);
			
			$this->load->library('pagination');
			$this->pagination->initialize($config);


			$head['title'] = 'View Meals by Restaurant';

			$this->load->view('partials/head',$head);

			$this->load->view('restaurant_meals/index',$data);
        } else {

        	$filter = $this->input->get('filter');
        	$value = $this->input->get('data');
        	$conditions=array($filter=>$value);
        	
    		$config['total_rows'] = $this->restaurant_meal_model->count($conditions);
			$config['base_url']=base_url().'index.php/admin/restaurant/index/';
			$config['per_page'] = 10000;
			$data['meals'] = $this->restaurant_meal_model->get($config['per_page'], $offset, $conditions);

			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$head['title']='User List';

			$this->load->view('partials/head',$head);

			$this->load->view('restaurant_meals/index', $data);

        } 
	}

	public function edit($id)
	{
		$head['title']='Edit Meals to Restaurant';

		$this->session->set_flashdata('rm_id',$id);

    	$this->load->view('partials/head',$head);

    	$data['restaurants'] =$this->restaurant_model->getSelect();
    	$data['meals'] =$this->meal_model->getSelect();

    	$data['restaurant_meal'] = $this->restaurant_meal_model->get(1,0,array('restaurant_meals.id'=>$id));

    	$this->session->set_flashdata('image_id',$data['restaurant_meal'][0]->image_id);

    	$this->load->view('restaurant_meals/edit', $data);
	}

	public function update()
	{
		$this->load->library('form_validation');
		$this->config->load('validations/restaurant');
		
		$this->form_validation->set_rules($this->config->item('restaurant_meal'));

    	if ($this->form_validation->run() == FALSE)
        {
        	

            $this->session->set_flashdata('rm_id',$this->session->flashdata('rm_id'));
           
            $this->session->set_flashdata('image_id', $this->session->flashdata('image_id'));




        	$head['title']='Add Meals to Restaurant';

	    	$this->load->view('partials/head',$head);

	    	$data['restaurants'] =$this->restaurant_model->getSelect();
	    	$data['meals'] =$this->meal_model->getSelect();

	    	$this->load->view('restaurant_meals/edit', $data);
        }else {

        	if(isset($_FILES['userfile']))
        	{
        		$config['upload_path'] = './uploads/images/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size']             =1024;
		        $config['overwrite']			=False;
		        $config['file_name']			=time().'_'.$_FILES["userfile"]['name'];
		        $config['file_ext_tolower']		=TRUE;
				
				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload()){
					$data['errors'] = array('error' => $this->upload->display_errors());
					$head['title']='Add Meals to Restaurant';

			    	$this->load->view('partials/head',$head);

			    	$data['restaurants'] =$this->restaurant_model->getSelect();
			    	$data['meals'] =$this->meal_model->getSelect();

			    	$id = $this->session->flashdata('rm_id');

		            $this->session->set_flashdata('rm_id',$id);
		           
		            $this->session->set_flashdata('image_id', $this->session->flashdata('image_id'));

			    	$this->load->view('restaurant_meals/edit', $data);

			    }else {

					$file_data = $this->upload->data();
					$conditions = array('id'=>$this->session->flashdata('image_id'));
					$image['name']=$file_data['file_name'];
					$image['thumbnail']=$file_data['raw_name'].'_thumb'.$file_data['file_ext'];
					$this->image_model->update($image, $conditions);
				}

        	}
        			
				
				$rm_data['meal_id']=$this->input->post('meal');
				$rm_data['restaurant_id']=$this->input->post('restaurant');
				$rm_data['price']=$this->input->post('price');
				$rm_data['image_id'] = $this->session->flashdata('image_id');
				$rm_id = $this->session->flashdata('rm_id');

				$conditions = array('id'=>$rm_id);

								
				if ($this->restaurant_meal_model->update($rm_data,$conditions)) {
					$message = ' <strong>Success!</strong> Meal to Restaurant updated successfully ';
				    
	             	$this->session->set_flashdata('userFlashData', custom_message('success',$message));

	             	redirect('admin/restaurant_meal/edit/'.$rm_id,301);

	        	} else {
	        		
	        		$message = ' <strong>Fail!</strong> Meal to Restaurant didn\'t updated';
				    
	             	$this->session->set_flashdata('userFlashData', custom_message('info',$message));

	             	redirect('admin/restaurant_meal/edit/'.$rm_id,301);
				
				}
			}
        }

        public function delete($id)
		{
			if ($this->restaurant_meal_model->delete($id)) {
	    		$message = ' <strong>Success!</strong> Restaurant deleted';
				    
		     	$this->session->set_flashdata('userFlashData', custom_message('success',$message));

		     	redirect('admin/info/',301);
	    	} else {
	    		$message = ' <strong>Fail!</strong> Unable to delete restaurant. Please try again later!';
				    
		     	$this->session->set_flashdata('userFlashData', custom_message('info',$message));

		     	redirect('admin/info/',301);
	    	}
			
		}

}

/* End of file Restaurant_meal.php */
/* Location: ./application/controllers/admin/Restaurant_meal.php */ 