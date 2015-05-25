<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access 
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();

        $this->ci->load->library('session');

        if(! $this->ci->session->username && ! $this->ci->session->type) {

        	redirect('admin/access/',301);
    	}else {

    		$this->lastActivity();
    	}
    	
	}

	private function lastActivity()
	{
		//$this->ci->load->library('database');

		$this->ci->db->where('username', $this->ci->session->username);
		$this->ci->db->update('users', array('last_activity'=>time()));
		
	}

	

}

/* End of file MY_Session.php */
/* Location: ./application/libraries/MY_Session.php */
 ?>