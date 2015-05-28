<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*Author@Abu Sayem
*Email@sayem@asteriskbd.com
*Model for Meal Category functionalities.
*/
class Meal_category_model extends CI_Model {

	private $table = 'meal_categories';
	
	public function create($data=array())
	{
		if($this->db->insert($this->table, $data))
		{
			return TRUE;
		}else {
			return FALSE;
		}
	}

}

/* End of file Meal_category_model.php */
/* Location: ./application/models/Meal_category_model.php */ ?>