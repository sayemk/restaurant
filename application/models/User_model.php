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
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get($limit=20, $offset=0, $conditions=array())
	{
		$this->db->where($conditions);
		$query = $this->db->get('users', $limit, $offset);
		return $query->result();
	}

	public function count($conditions=array())
	{
		$this->db->where($conditions);
		return $this->db->count_all_results('users');
		
	}

	public function getWithAddress($id)
	{
		$user = $this->find($id);

		if($user){

			$this->db->select('a.*,ad.id ad_id, ad.is_member_add');
			$this->db->from('user_address ad');
			$this->db->join('addresses a', 'a.id = ad.address_id', 'left');
			$this->db->where('ad.user_id', $id);

			$query = $this->db->get();

			$data['user'] = $user[0];
			$data['addresses'] = $query->result();

			return $data;

							
		} else {
			return 0;
		}

	}

	public function delete($id)
	{
		$this->load->model('address_model');
		try {
				$addresses = $this->getAddressID($id);			
				
				$this->db->trans_start();
				foreach ($addresses as $address) {

					$this->address_model->delete($address->address_id);

					$this->db->where('id',$address->id);
					$this->db->delete('user_address');
				}

				$this->db->where('id',$id);
				$this->db->delete('users');

				$this->db->trans_complete();
				
				return true;

			} catch (Exception $e) {
				log_message('error', $e->getMessage());
				return false;
			}
	}

	public function getAddressID($user_id)
	{
		$query = $this->db->get_where('user_address', array('user_id' =>$user_id));

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
}//End of class