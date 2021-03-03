<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant extends MY_Controller {

	protected $table = 'restaurant';
	protected $redirect = 'restaurant';

	public function index()
	{
		if ($this->input->server('REQUEST_METHOD') === 'GET') {
			$data['name'] = 'restaurant';
			$data['title'] = 'restaurant';
			$data['url'] = $this->redirect;
			$data['data'] = $this->main->get($this->table, '*', ['id' => 1]);
			
			if (!$data['data']) {
				$this->main->add(['name' => APP_NAME], $this->table);
				$data['data'] = $this->main->get($this->table, '*', ['id' => 1]);
			}

			return $this->template->load(admin('template'), admin('restaurant/restaurant'), $data);
		}else{
			$post = [
				'name' 		  => $this->input->post('name'),
				'sub_title'   => $this->input->post('sub_title'),
				'description' => $this->input->post('description'),
				'contact_no'  => $this->input->post('contact_no'),
				'email_id'    => $this->input->post('email_id'),
				'facebook'    => $this->input->post('facebook'),
				'instagram'   => $this->input->post('instagram')
			];

			$id = $this->main->update(['id' => 1], $post, $this->table);
			
			flashMsg($id, "Changes saved.", "Changes not saved.", $this->redirect);
		}
	}
}
