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

        	redirect('admin/access/logout',301);

    	}else {
    		
    		if (!$this->ci->session->type=='Admin') {
    			
    			if( ! $this->checkAccess()) {
    				redirect('admin/access/logout',301);
    			}
	
    		}
    		
    		$this->lastActivity();
    	}
    	
	}

	private function lastActivity()
	{
		//$this->ci->load->library('database');

		$this->ci->db->where('username', $this->ci->session->username);
		$this->ci->db->update('users', array('last_activity'=>time()));
		
	}

	private function checkAccess()
	{
		$controller = $this->ci->router->fetch_class();	
		$method = $this->ci->router->fetch_method();

		$this->ci->config->load('acl');
		$user_type = $this->ci->session->type;
		foreach ($this->ci->config->item($user_type) as $accesses) {
			// echo "<pre>";
			// print_r($accesses);
			// exit();
			
			
			if(trim($controller) == trim($accesses['controller'])){
				
				foreach ($accesses['actions'] as $value) {
					if($method == $value)
					{
						return TRUE;
					}
				}
				return FALSE;
			}
			
		}
		return FALSE;
		
	}

	

}

/* End of file MY_Session.php */
/* Location: ./application/libraries/MY_Session.php */
 ?>