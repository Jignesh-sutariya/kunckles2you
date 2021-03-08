<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class Orders_model extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
	}

	public $table = "orders o";
	public $select_column = ['o.id', 'o.o_total', 'o.o_date', 'o.o_time', 'o.mobile', 'o.email', 'o.status'];
	public $search_column = ['o.id', 'o.o_total', 'o.o_date', 'o.o_time', 'o.mobile', 'o.email', 'o.status'];
    public $order_column = [null, 'o.id', 'o.o_total', 'o.o_date', 'o.o_time', 'o.mobile', 'o.email', 'o.status', null];
	public $order = ['o.id' => 'ASC'];

	public function make_query()  
	{  
        $this->db->select($this->select_column)
            	 ->from($this->table);

        if ($this->input->post('status'))
            $this->db->where(['status' => $this->input->post('status')]);
        if ($this->input->post('o_date'))
            $this->db->where(['o_date' => date('Y-m-d', strtotime($this->input->post('o_date')))]);
            
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