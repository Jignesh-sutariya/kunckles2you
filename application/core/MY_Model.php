<?php 
/**
 * 
 */
class MY_Model extends CI_Model
{
	public function make_datatables()
	{  
	   $this->make_query();  
	   if($_POST["length"] != -1)  
	   {  
	        $this->db->limit($_POST['length'], $_POST['start']);
	   }  
	   $query = $this->db->get();
	   return $query->result();
	}  

	public function get_filtered_data(){  
	   $this->make_query();  
	   $query = $this->db->get();  

	   return $query->num_rows();
	}
}