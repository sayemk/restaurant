<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter String Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Abu Sayem
 * @email		sayem@asteriskbd.com
 */
if ( ! function_exists('randomString'))
{
	function randomString($length = 16) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}

if ( ! function_exists('array_keys_check'))
{
	function array_keys_check($keys, $search) {

		foreach ($keys as $key) {
			if (!array_key_exists($key, $search)) {
				return false;
			}
		}
		return True;
	   
	}
}

if ( ! function_exists('custom_message'))
{
	function custom_message($type, $message) {
		
		$retString='';
		if($type=='success'){
			$retString .='<div class="alert alert-success alert-dismissible fade in" role="alert">
				      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				      <span aria-hidden="true">&times;</span></button>'.$message.' </div>';
		}

		if($type=='info'){
			$retString .='<div class="alert alert-info alert-dismissible fade in" role="alert">
				      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				      <span aria-hidden="true">&times;</span></button>'.$message.' </div>';
		}

		if($type=='warning'){
			$retString .='<div class="alert alert-warning alert-dismissible fade in" role="alert">
				      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				      <span aria-hidden="true">&times;</span></button>'.$message.' </div>';
		}

		if($type=='danger'){
			$retString .='<div class="alert alert-danger alert-dismissible fade in" role="alert">
				      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				      <span aria-hidden="true">&times;</span></button>'.$message.' </div>';
		}

		return $retString;
	   
	}
}

?>