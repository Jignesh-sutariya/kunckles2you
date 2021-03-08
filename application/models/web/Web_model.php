<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class Web_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getItems($c_id)
    {
        return $this->db->select(['id', 'title', 'details', 'price', 'CONCAT("images/menu/", image) image, availability'])
                 ->from('menu')
                 ->where(['is_deleted' => 0, 'c_id' => $c_id])
                 ->group_start()
                 ->like('week_avail', day())
                 ->group_end()
                 ->get()
                 ->result_array();
    }
}