<?php 
	$config['restaurant'] = array(
				array(
		                'field' => 'name',
		                'label' => 'Name',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'phone',
		                'label' => 'Phone',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'You must provide a %s.',
		                ),
		        ),
		        array(
		                'field' => 'start',
		                'label' => 'Service Hour Start ',
		                'rules' => 'required'
		        ),		        
		        array(
		                'field' => 'close',
		                'label' => 'Service Hour Close ',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'email',
		                'label' => 'Email',
		                'rules' => 'required|valid_email'
		        ),
		        array(
		                'field' => 'latitude',
		                'label' => 'Latitude',
		                'rules' => 'required',
		        ),
		        array(
		                'field' => 'longitude',
		                'label' => 'Longitude',
		                'rules' => 'required',
		        ),
		        array(
		                'field' => 'latitude',
		                'label' => 'Latitude',
		                'rules' => 'required',
		        ),
		        array(
		                'field' => 'address_line',
		                'label' => 'Address Line',
		                'rules' => 'required',
		        ),
		        array(
		                'field' => 'city',
		                'label' => 'City',
		                'rules' => 'required',
		        ),
		        array(
		                'field' => 'zip',
		                'label' => 'Zip Code',
		                'rules' => 'required|numeric',
		        ),
		        array(
		                'field' => 'country',
		                'label' => 'Country',
		                'rules' => 'required',
		        )
			);

	$config['restaurant_meal'] = array(
				array(
		                'field' => 'restaurant',
		                'label' => 'Restaurant',
		                'rules' => 'required|numeric'
		        ),
		        array(
		                'field' => 'meal',
		                'label' => 'Meals',
		                'rules' => 'required|numeric',
		                'errors' => array(
		                        'required' => 'You must provide a %s.',
		                ),
		        ),
		        array(
		                'field' => 'price',
		                'label' => 'price',
		                'rules' => 'required|numeric',
		                'errors' => array(
		                        'required' => 'You must provide a %s.',
		                ),
		        ),
		        
		        
			);
 ?>