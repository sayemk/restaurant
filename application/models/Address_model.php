<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address_model extends CI_Model {

	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('addresses');
	}

}

/* End of file Address_model.php */
/* Location: ./application/models/Address_model.php */ ?>