<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {

	protected $name = 'category';
	protected $title = 'category';
	protected $table = 'category';
	protected $redirect = 'category';

	public function index()
	{
		$data['name'] = $this->name;
		$data['title'] = $this->title;
		$data['url'] = $this->redirect;
		
		return $this->template->load(admin('template'), $this->redirect.'/home', $data);
	}

	public function get()
	{
		$this->load->model(admin('category_model'), 'data');
		$fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->name;

            $action = '<div style="display: flex;">';

            $action .= anchor($this->redirect.'/update/'.e_id($row->id), '<i class="fa fa-edit"></i>', 'class="btn btn-warning btn-link btn-icon btn-sm edit"');

            $action .= form_open($this->redirect.'/delete', 'id="'.e_id($row->id).'"', ['id' => e_id($row->id)]).
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
            "recordsTotal"      => $this->main->count($this->table, ['is_deleted' => 0]),
            "recordsFiltered"   => $this->data->get_filtered_data(),
            "data"              => $data,
            $csrf_name          => $csrf_hash
        ];
        
        echo json_encode($output);
	}

    public function add()
    {
        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE)
        {
            $data['name'] = $this->name;
            $data['title'] = $this->title;
            $data['url'] = $this->redirect;
            
            return $this->template->load(admin('template'), $this->redirect.'/add', $data);
        }
        else
        {
            $post = [
                'name' => $this->input->post('name')
            ];

            $id = $this->main->add($post, $this->table);

            flashMsg($id, ucwords($this->title)." added successfully.", ucwords($this->title)." not added. Try again.", $this->redirect);
        }
    }

    public function update($id)
    {
        $this->form_validation->set_rules($this->validate);
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['name'] = $this->name;
            $data['id'] = $id;
            $data['title'] = $this->title;
            $data['url'] = $this->redirect;
            $data['data'] = $this->main->get($this->table, 'name', ['id' => d_id($id)]);
            
            if ($data['data']) 
            {
                $this->session->set_flashdata('updateId', $id);
                return $this->template->load(admin('template'), $this->redirect.'/update', $data);
            }
            else
                return $this->error_404();
        }
        else
        {
            $updateId = $this->session->updateId;
            if (!$updateId) return redirect($this->redirect);
            
            $post = [
                'name' => $this->input->post('name')
            ];

            $id = $this->main->update(['id' => d_id($updateId)], $post, $this->table);

            flashMsg($id, ucwords($this->title)." updated successfully.", ucwords($this->title)." not updated. Try again.", $this->redirect);
        }
    }

    public function delete()
    {
        $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_deleted' => 1], $this->table);

        flashMsg($id, ucwords($this->title)." deleted successfully.", ucwords($this->title)." not deleted. Try again.", $this->redirect);
    }

    protected $validate = [
        [
            'field' => 'name',
            'label' => 'Category Name',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ]
    ];
}
