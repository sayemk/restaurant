<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	$config['meal'] = array(
				array(
		                'field' => 'name',
		                'label' => 'Name',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'price',
		                'label' => 'Price',
		                'rules' => 'required|numeric',
		                'errors' => array(
		                        'required' => 'You must provide a %s.',
		                ),
		        ),
		        array(
		                'field' => 'category',
		                'label' => 'Meal Category ',
		                'rules' => 'required|numeric'
		        )
			);
 
 ?>