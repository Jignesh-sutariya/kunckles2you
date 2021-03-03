<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends MY_Controller {

	protected $name = 'banner';
	protected $title = 'banner';
	protected $table = 'banner';
	protected $redirect = 'banner';

	public function index()
	{
		$data['name'] = $this->name;
		$data['title'] = $this->title;
		$data['url'] = $this->redirect;
		
		return $this->template->load(admin('template'), $this->redirect.'/home', $data);
	}

	public function get()
	{
		$this->load->model(admin('banner_model'), 'data');
		$fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = img(['src' => $row->banner, 'height' => 200, 'width' => 400]);

            $action = '<div style="display: flex;">';

            /*$action .= anchor($this->redirect.'/update/'.e_id($row->id), '<i class="fa fa-edit"></i>', 'class="btn btn-warning btn-link btn-icon btn-sm edit"');*/

            $action .= form_open($this->redirect.'/delete', 'id="'.e_id($row->id).'"', ['id' => e_id($row->id), 'banner' => $row->banner]).
                form_button([ 'content' => '<i class="fa fa-times"></i>', 
                    'type'  => 'button',
                    'class' => 'btn btn-danger btn-link btn-icon btn-sm remove', 
                    'onclick' => "script.delete(".e_id($row->id)."); return false;"]).
                form_close();

            $action .= '</div>';
            $sub_array[] = $action;

            $data[] = $sub_array;  
            $sr++;
        }
        
        $csrf_name = $this->security->get_csrf_token_name();
        $csrf_hash = $this->security->get_csrf_hash();

        $output = [
            "draw"              => intval($_POST["draw"]),  
            "recordsTotal"      => $this->main->count($this->table, ['id != ' => 0]),
            "recordsFiltered"   => $this->data->get_filtered_data(),
            "data"              => $data,
            $csrf_name          => $csrf_hash
        ];
        
        echo json_encode($output);
	}

    public function add()
    {
 		if ($this->input->server('REQUEST_METHOD') === 'GET') {
 			$data['name'] = $this->name;
			$data['title'] = $this->title;
			$data['url'] = $this->redirect;
			
			return $this->template->load(admin('template'), $this->redirect.'/add', $data);
 		}else{
 			$this->load->helper('string');
 			$this->load->library('upload');
            
            $config = [
                'upload_path'      => "images/banners/",
                'allowed_types'    => 'jpg|jpeg|png',
                'file_name'        => random_string('nozero', 5),
                'file_ext_tolower' => TRUE
            ];
            
            $this->upload->initialize($config);
            if (!$this->upload->do_upload("banner")) {
                flashMsg(0, "", strip_tags($this->upload->display_errors()), $this->redirect.'/add');
            }else{
            	$id = $this->main->add(['banner' => $this->upload->data("file_name")], $this->table);
            	
            	if (!$id)
            		unlink($config['upload_path'].$this->upload->data("file_name"));

            	flashMsg($id, ucwords($this->title)." upload successful.", ucwords($this->title)." upload not successful.", $this->redirect);
            }
 		}
    }

    public function delete()
    {
        $id = $this->main->delete($this->table, ['id' => d_id($this->input->post('id'))]);

        if ($id && file_exists($this->input->post('banner')))
            unlink($this->input->post('banner'));

        flashMsg($id, ucwords($this->title)." removed successfully.", ucwords($this->title)." not removed. Try again.", $this->redirect);
    }
}
