<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	$config['Restaurant'] = array(
				array(
		                'controller' => 'dashboard',
		                'actions' =>array('index'),
		        ),
				array(
		                'controller' => 'restaurant',
		                'actions' =>array('index','create','show','edit','update','delete','view','save'),
		        ),
		      	array(
		                'controller' => 'order',
		                'actions' =>array('index','create','show','edit','update','delete','view','save'),
		        ),
		        array(
		                'controller' => 'restaurant_meal',
		                'actions' =>array('index','create','show','edit','update','delete','view','save'),
		        ),
		        array(
		                'controller' => 'info',
		                'actions' =>array('index','create','show','edit','update','delete','view','save'),
		        ),
			);
 
 ?>