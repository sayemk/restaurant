<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
*@author: Abu Sayem
*@email: sayem@asteriskbd.com
*
*Image configurations
*/

$config['image_library'] 	= 'gd';
$config['create_thumb']		= TRUE;
$config['maintain_ratio'] 	= TRUE;
$config['width']         	= 75;
$config['height']      		= 50;
$config['new_image']		= './uploads/images/thumbs/' 
$config['thumb_marker']  	= '_thumb';
$config['quality']      	= 100; 