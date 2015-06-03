<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image_model extends CI_Model {

	private $table = 'images';

	public function save($data=array())
	{
		$this->db->insert($this->table, $data);
		$insert_id=$this->db->insert_id();
		if ($insert_id) {
			return $insert_id;
		} else {
			return FALSE;
		}
	}

	public function update($data=array(), $conditions=array())
	{
		try {
			$this->db->where($conditions);
			$this->db->update($this->table, $data);
			return TRUE;
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			return false;
		}
	}

	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete($this->table);
	}

}

/* End of file Image_model.php */
/* Location: ./application/models/Image_model.php */ 