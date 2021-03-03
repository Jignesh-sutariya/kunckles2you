<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class Menu_model extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
	}

	public $table = "menu m";
	public $select_column = ['m.id', 'm.title', 'm.price', 'c.name', 'm.availability', 'm.week_avail'];
	public $search_column = ['m.title', 'm.price', 'c.name', 'm.availability', 'm.week_avail'];
    public $order_column = [null, 'm.title', 'm.price', 'c.name', 'm.availability', null, null];
	public $order = ['m.id' => 'DESC'];

	public function make_query()  
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
            	 ->where(['m.is_deleted' => 0, 'c.is_deleted' => 0])
            	 ->join('category c', 'c.id = m.c_id');
        $i = 0;

        foreach ($this->search_column as $item) 
        {
            if($_POST['search']['value']) 
            {
                if($i===0) 
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->search_column) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
	}
}