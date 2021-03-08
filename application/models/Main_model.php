<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class Main_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function add($post, $table)
	{
		if ($this->db->insert($table, $post)) {
			$id = $this->db->insert_id();
			return ($id) ? $id : true;
		}else
			return false;
	}

	public function get($table, $select, $where)
	{
		return $this->db->select($select)
						->from($table)
						->where($where)
						->get()
						->row_array();
	}

	public function getall($table, $select, $where, $order_by = '', $limit = '')
	{
		$this->db->select($select)
					->from($table)
					->where($where);

		if ($order_by != '') 
			$this->db->order_by($order_by);
		
		if ($limit != '') 
			$this->db->limit($limit);
		
		return  $this->db->get()
						->result_array();
	}

	public function check($table, $where, $select)
	{
		$check = $this->db->select($select)
						->from($table)
						->where($where)
						->get()
						->row_array();
		if ($check) 
			return $check[$select];
		else
			return false;
	}

	public function update($where, $post, $table)
	{
		return $this->db->where($where)->update($table, $post);
	}

	public function delete($table, $where)
	{
		return $this->db->delete($table, $where);
	}

	public function count($table, $where, $group = "", $joins = "")
	{
		if ($group != '') {
			$this->db->group_by($group);
		}
		if ($joins != '') {
			foreach ($joins as $k => $v) {
				$this->db->join($v, $v.'.id = '.$table.'.'.$k, 'left');
			}
		}
		return $this->db->get_where($table, $where)->num_rows();
	}

	public function totalIncome()
	{
		$total = $this->db->select('SUM(o_total) total')->from('orders')->get()->row_array();

		return ($total['total']) ? $total['total'] : 0; 
	}

	public function import_excel($data, $table)
	{
	  return $this->db->insert_batch($table, $data);
	}
}