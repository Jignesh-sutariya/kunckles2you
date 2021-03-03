<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class Gallery_model extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
	}

	public $table = "gallery g";
	public $select_column = [];
	public $search_column = ['g.image'];
    public $order_column = [null, 'g.id', null];
	public $order = ['g.id' => 'DESC'];

	public function make_query()  
	{  
		$this->select_column = ['g.id', ' CONCAT("images/gallery/", g.image) image'];
        $this->db->select($this->select_column)
            	 ->from($this->table);

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