<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
*@author: Abu Sayem
*@email: sayem@asteriskbd.com
*
*Model for Users 
*/
class User_model extends CI_Model {

	public function create($data=array(), $reset_token)
	{
		$required = array('fullname', 'username','password','email','phone','status','salt','api_key','type');
		
		if( ! array_keys_check($required, $data)) {
			exit('fail');
		}else {
			try {
				$this->db->trans_start();
				$this->db->insert('users', $data);
				$insert_id=$this->db->insert_id();
				$this->db->insert('reset_tokens', array('user_id'=>$insert_id,
														'token'=>$reset_token,
														'used'=>'0',
								));
				$this->db->trans_complete();
				return true;
			} catch (Exception $e) {
				log_message('error', $e->getMessage());
				return false;
			}

		}
	}

	public function find($id)
	{
		$query = $this->db->get_where('users', array('id' => $id), 1);
		if ($query->num_rows()==1) {
			return $query->result();
		} else {
			return 0;
		}
		
	}

	public function get_where($where)
	{
		$query = $this->db->get_where('users', $where, 1);
		if ($query->num_rows()==1) {
			return $query->result();
		} else {
			return 0;
		}
	}


}