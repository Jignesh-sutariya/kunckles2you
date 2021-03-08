<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant extends MY_Controller {

	protected $table = 'restaurant';
	protected $redirect = 'restaurant';
	protected $name = 'restaurant';

	public function index()
	{
		$data['name'] = $this->name;
		$data['title'] = 'restaurant';
		$data['url'] = $this->redirect;
		$data['data'] = $this->main->get($this->table, '*', ['id' => 1]);
		
		if (!$data['data']) {
			$this->main->add(['name' => APP_NAME], $this->table);
			$data['data'] = $this->main->get($this->table, '*', ['id' => 1]);
		}

		return $this->template->load(admin('template'), admin('restaurant/restaurant'), $data);
	}

	public function restUpdate()
	{
		$post = [
				'name' 		 => $this->input->post('name'),
				'sub_title'  => $this->input->post('sub_title'),
				'address'    => $this->input->post('address'),
				'contact_no' => $this->input->post('contact_no'),
				'email_id'   => $this->input->post('email_id'),
				'facebook'   => $this->input->post('facebook'),
				'instagram'  => $this->input->post('instagram')
			];

		$id = $this->main->update(['id' => 1], $post, $this->table);
		
		flashMsg($id, "Changes saved.", "Changes not saved.", $this->redirect);
	}

	public function timings()
	{
		$data['name'] = $this->name;
		$data['title'] = 'restaurant timings';
		$data['url'] = $this->redirect;
		return $this->template->load(admin('template'), admin('restaurant/timings'), $data);
	}

	public function get()
	{
		$this->load->model(admin('restaurant_model'), 'data');
		$fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->day;
            $sub_array[] = date('h:i A', strtotime($row->from_time));
            $sub_array[] = date('h:i A', strtotime($row->to_time));
            
            $avail = form_open($this->redirect.'/availability', 'id="avail_'.e_id($row->id).'"', ['id' => e_id($row->id)]);

            if ($row->availability)
                $avail .= form_hidden('availability', 0).form_button([ 'content' => '<i class="fa fa-thumbs-up"></i>', 
                    'type'  => 'button',
                    'class' => 'btn btn-success btn-link btn-icon btn-sm', 
                    'onclick' => "script.availability(".e_id($row->id)."); return false;"]);
            else
                $avail .= form_hidden('availability', 1).form_button([ 'content' => '<i class="fa fa-thumbs-down"></i>', 
                    'type'  => 'button',
                    'class' => 'btn btn-danger btn-link btn-icon btn-sm', 
                    'onclick' => "script.availability(".e_id($row->id)."); return false;"]);
            
            $avail .= form_close();
            $sub_array[] = $avail;
            $sub_array[] = $row->address;

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
            "recordsTotal"      => $this->main->count("timings", ['id != ' => 0]),
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
            $data['title'] = $this->name.' time';
            $data['url'] = $this->redirect;
            $this->load->model(admin('menu_model'), 'menu');
	    	$data['items'] = $this->menu->getItems();

            return $this->template->load(admin('template'), $this->redirect.'/add', $data);
        }
        else
        {
        	$items = $this->input->post('avail_items');
        	
        	foreach ($items as $k => $i)
        		$items[$k] = d_id($i);

            $from_time = $this->input->post('from_time');
        	$to_time = $this->input->post('to_time');
            
            $post = [
                'day' => $this->input->post('day'),
                'address' => $this->input->post('address'),
                'from_time' => date('H:i:s', strtotime($from_time)),
                'to_time' => date('H:i:s', strtotime($to_time)),
                'avail_items' => implode(',', $items)
            ];

            $id = $this->main->add($post, 'timings');

            flashMsg($id, "timing added successfully.", "timing not added. Try again.", $this->redirect.'/timings');
        }
    }

    public function availability()
    {
        $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['availability' => $this->input->post('availability')], 'timings');

        flashMsg($id, "status changed successfully.", "status not changed. Try again.", $this->redirect.'/timings');
    }

    public function update($id)
    {
        $this->form_validation->set_rules($this->validate);
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['name'] = $this->name;
            $data['id'] = $id;
            $data['title'] = $this->name.' time';
            $data['url'] = $this->redirect;
            $data['data'] = $this->main->get('timings', 'day, from_time, to_time, avail_items, availability, address', ['id' => d_id($id)]);
            
            if ($data['data'])
            {
            	$this->load->model(admin('menu_model'), 'menu');
	    		$data['items'] = $this->menu->getItems($data['data']['day']);
                $this->session->set_flashdata('updateId', $id);
                return $this->template->load(admin('template'), $this->redirect.'/update', $data);
            }
            else
                return $this->error_404();
        }
        else
        {
            $updateId = $this->session->updateId;
            $this->session->set_flashdata('updateId', $updateId);
            if (!$updateId) return redirect($this->redirect.'/timings');
            
            $items = $this->input->post('avail_items');

        	foreach ($items as $k => $i)
        		$items[$k] = d_id($i);
        	
        	$from_time = $this->input->post('from_time');
        	$to_time = $this->input->post('to_time');
            
            $post = [
                'day' => $this->input->post('day'),
                'address' => $this->input->post('address'),
                'from_time' => date('H:i:s', strtotime($from_time)),
                'to_time' => date('H:i:s', strtotime($to_time)),
                'avail_items' => implode(',', $items)
            ];
            
            $id = $this->main->update(['id' => d_id($updateId)], $post, 'timings');

            flashMsg($id, ucwords($this->title)." updated successfully.", ucwords($this->title)." not updated. Try again.", $this->redirect.'/timings');
        }
    }

    public function delete()
    {
        $id = $this->main->delete('timings', ['id' => d_id($this->input->post('id'))]);

        flashMsg($id, "Timing deleted successfully.", "Timing not deleted. Try again.", $this->redirect.'/timings');
    }

    /*public function getItems()
    {
    	if (!$this->input->is_ajax_request())
		    return $this->error_404();
		else{
	    	$this->load->model(admin('menu_model'), 'menu');
	    	$items = $this->menu->getItems();
	    	$return = '<option disabled> Multiple Item</option>';
	    	foreach ($items as $item)
	    		$return .= '<option value="'.e_id($item['id']).'">'.$item['title'].'</option>';
	    	echo $return;
		}
    }*/

    protected $validate = [
        [
            'field' => 'address',
            'label' => 'Address',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'from_time',
            'label' => 'From time',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'to_time',
            'label' => 'To time',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'avail_items[]',
            'label' => 'Item availability',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'day',
            'label' => 'Day',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ]
    ];
}
