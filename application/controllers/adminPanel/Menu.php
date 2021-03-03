<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller {

	protected $name = 'menu';
	protected $title = 'menu';
	protected $table = 'menu';
	protected $redirect = 'menu';

	public function index()
	{
		$data['name'] = $this->name;
		$data['title'] = $this->title;
		$data['url'] = $this->redirect;
		
		return $this->template->load(admin('template'), $this->redirect.'/home', $data);
	}

	public function get()
	{
		$this->load->model(admin('menu_model'), 'data');
		$fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->title;
            $sub_array[] = $row->price;
            $sub_array[] = $row->name;
            $sub_array[] = ($row->availability) ? '<a class="btn btn-success btn-link btn-icon btn-sm"><i class="fa fa-thumbs-up"></i></a>' : '<a class="btn btn-danger btn-link btn-icon btn-sm"><i class="fa fa-thumbs-down"></i></a>';
            $sub_array[] = $row->week_avail;

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
            return $this->add_view();
        }
        else
        {
            $this->load->helper('string');
            $this->load->library('upload');

            $config = [
                'upload_path'      => "images/menu/",
                'allowed_types'    => 'jpg|jpeg|png',
                'file_name'        => random_string('nozero', 5),
                'file_ext_tolower' => TRUE
            ];
            
            $this->upload->initialize($config);
            
            if (!$this->upload->do_upload("image")) {
                $this->session->set_flashdata('error', strip_tags($this->upload->display_errors()));
                
                return $this->add_view();
            }else{
                $post = [
                    'title' => $this->input->post('title'),
                    'details' => $this->input->post('details'),
                    'price' => $this->input->post('price'),
                    'image' => $this->upload->data("file_name"),
                    'availability' => ($this->input->post('availability')) ? 1 : 0,
                    'week_avail' => implode(', ', $this->input->post('week_avail')),
                    'c_id' => d_id($this->input->post('c_id'))
                ];

                $id = $this->main->add($post, $this->table);

                flashMsg($id, ucwords($this->title)." item added successfully.", ucwords($this->title)." item not added. Try again.", $this->redirect);
            }
        }
    }

    public function add_view()
    {
        $data['name'] = $this->name;
        $data['title'] = $this->title;
        $data['url'] = $this->redirect;
        $data['cats'] = $this->main->getall('category', 'id, name', ['is_deleted' => 0]);
        
        return $this->template->load(admin('template'), $this->redirect.'/add', $data);
    }

    public function edit($id)
    {
        $data['name'] = $this->name;
        $data['id'] = $id;
        $data['title'] = $this->title;
        $data['url'] = $this->redirect;
        $data['data'] = $this->main->get($this->table, 'title, details, price, image, availability, week_avail, c_id', ['id' => d_id($id)]);
        
        if ($data['data'])
        {
            $data['cats'] = $this->main->getall('category', 'id, name', ['is_deleted' => 0]);
            $this->session->set_flashdata('updateId', $id);
            return $this->template->load(admin('template'), $this->redirect.'/update', $data);
        }
        else
            return $this->error_404();
    }

    public function update($id)
    {
        $this->form_validation->set_rules($this->validate);
        
        if ($this->form_validation->run() == FALSE)
        {
            return $this->edit($id);
        }
        else
        {
            $updateId = $this->session->updateId;
            $this->session->set_flashdata('updateId', $id);
            
            if (!$updateId) return redirect($this->redirect);
            
            $post = [
                'title' => $this->input->post('title'),
                'details' => $this->input->post('details'),
                'price' => $this->input->post('price'),
                'availability' => ($this->input->post('availability')) ? 1 : 0,
                'week_avail' => implode(', ', $this->input->post('week_avail')),
                'c_id' => d_id($this->input->post('c_id'))
            ];

            if (empty($_FILES['image']['name'])) {

                $id = $this->main->update(['id' => d_id($updateId)], $post, $this->table);

                flashMsg($id, ucwords($this->title)." updated successfully.", ucwords($this->title)." not updated. Try again.", $this->redirect);
            }else{
                $this->load->helper('string');
                $this->load->library('upload');

                $config = [
                    'upload_path'      => "images/menu/",
                    'allowed_types'    => 'jpg|jpeg|png',
                    'file_name'        => random_string('nozero', 5),
                    'file_ext_tolower' => TRUE
                ];
                
                $this->upload->initialize($config);
                
                if (!$this->upload->do_upload("image")) {
                    $this->session->set_flashdata('error', strip_tags($this->upload->display_errors()));
                    
                    return $this->edit($id);
                }else{
                    $post['image'] = $this->upload->data("file_name");

                    $id = $this->main->update(['id' => d_id($updateId)], $post, $this->table);
                    
                    if (!$id)
                        unlink($config['upload_path'].$this->upload->data("file_name"));
                    else
                        unlink($config['upload_path'].$this->input->post("image"));

                    flashMsg($id, ucwords($this->title)." updated successfully.", ucwords($this->title)." not updated. Try again.", $this->redirect);
                }
            }
        }
    }

    public function delete()
    {
        $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_deleted' => 1], $this->table);

        flashMsg($id, ucwords($this->title)." deleted successfully.", ucwords($this->title)." not deleted. Try again.", $this->redirect);
    }

    protected $validate = [
        [
            'field' => 'title',
            'label' => 'Item title',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'details',
            'label' => 'Item detail',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'price',
            'label' => 'Item price',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'week_avail[]',
            'label' => 'Item availability',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'c_id',
            'label' => 'Item category',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ]
    ];
}
