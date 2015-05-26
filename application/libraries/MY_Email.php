<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
*@author: Abu Sayem
*@email: sayem@asteriskbd.com
*
*Library for Email
*/
class MY_Email extends CI_Email{


	public function __construct()
	{
		parent::__construct();
	}

	public function sendRegistration($to = array(), $message)
	{
		$this->from('Restaurant@gmail.com', 'Restaurant');
		
		$this->to($to);

		$this->subject('Account Activation in Restaurant');
		$message='Please active your account in Restaurant to Login by clicking this link'. base_url().'users/activate/'.$message;
		$this->message($message);

		if($this->send()) return TRUE;
		else return FALSE;
	}
}