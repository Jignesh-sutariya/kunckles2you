<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller {

	protected $name = 'orders';
	protected $title = 'orders';
	protected $table = 'orders';
	protected $redirect = 'orders';

	public function index()
	{
		$data['name'] = $this->name;
		$data['title'] = $this->title;
		$data['url'] = $this->redirect;
		
		return $this->template->load(admin('template'), $this->redirect.'/home', $data);
	}

	public function get()
	{
		$this->load->model(admin('orders_model'), 'data');
		$fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->id;
            $sub_array[] = '$ '.$row->o_total;
            $sub_array[] = date('d-m-Y', strtotime($row->o_date));
            $sub_array[] = date('h:i A', strtotime($row->o_time));
            $sub_array[] = $row->mobile;
            $sub_array[] = $row->email;
            $sub_array[] = '<button class="btn btn-'.(($row->status === 'In process') ? 'pinterest' : 'facebook').' btn-sm btn-round">'.$row->status.'</button>';

            $action = '<div style="display: flex;">';

            /*$action .= form_open($this->redirect.'/delete', 'id="'.e_id($row->id).'"', ['id' => e_id($row->id)]).
                form_button([ 'content' => '<i class="fa fa-times"></i>', 
                    'type'  => 'button',
                    'class' => 'btn btn-danger btn-link btn-icon btn-sm remove', 
                    'onclick' => "script.delete(".e_id($row->id)."); return false;"]).
                form_close();*/
            if ($row->status === 'In process')
                $action .= form_button([ 'content' => '<i class="fa fa-thumbs-up"></i>',
                            'type'  => 'button',
                            'data-toggle'  => 'modal',
                            'data-target'  => '#changeStatus',
                            'class' => 'btn btn-success btn-link btn-icon btn-sm', 
                            'onclick' => "script.changeStatus(".e_id($row->id)."); return false;"
                           ]);
            else
                $action .= form_button([ 'content' => '<i class="fa fa-thumbs-up"></i>',
                            'type'  => 'button',
                            'class' => 'btn btn-danger btn-link btn-icon btn-sm', 
                            'onclick' => "return false;"
                           ]);

            $action .= '</div>';
            $sub_array[] = $action;

            $data[] = $sub_array;  
            $sr++;
        }
        
        $csrf_name = $this->security->get_csrf_token_name();
        $csrf_hash = $this->security->get_csrf_hash();

        if ($this->input->post('status'))
            $where = ['status' => $this->input->post('status')];
        else
            $where = ['id != ' => 0];

        if ($this->input->post('o_date'))
            $where['o_date'] = date('Y-m-d', strtotime($this->input->post('o_date')));

        $output = [
            "draw"              => intval($_POST["draw"]),  
            "recordsTotal"      => $this->main->count($this->table, $where),
            "recordsFiltered"   => $this->data->get_filtered_data(),
            "data"              => $data,
            $csrf_name          => $csrf_hash
        ];
        
        echo json_encode($output);
	}

    public function complete()
    {
        $id = $this->main->update(['id' => d_id($this->input->post('order_id'))], ['status' => "Completed"], $this->table);

        flashMsg($id, "Status changed successfully.", "Status not changed. Try again.", $this->redirect);
    }
}
