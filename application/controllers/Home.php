<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(web('web_model'), 'web');
	}

	public function index()
	{
		if ($this->input->get('qrscan')) 
			$this->main->add(['ipadd' => $_SERVER['REMOTE_ADDR'], 'create_date' => date('Y-m-d'), 'create_time' => date('H:i:s')], 'scans');
		
		$data['name'] = 'home';
		$data['title'] = 'home';
		$data['banners'] = $this->main->getall('banner', 'CONCAT("images/banners/", banner) banner', ['id != ' => 0]);
		$data['gallery'] = $this->main->getall('gallery', 'CONCAT("images/gallery/", image) image', ['id != ' => 0], '', 8);
		$data['cats'] = $this->main->getall('category', 'id, name', ['is_deleted' => 0]);
		foreach ($data['cats'] as $k => $v)
			$data['cats'][$k]['menu'] = $this->web->getItems($v['id']);

		return $this->template->load(web('template'), web('home'), $data);
	}

	public function gallery()
	{	
		$data['name'] = 'gallery';
		$data['title'] = 'gallery';
		$data['gallery'] = $this->main->getall('gallery', 'CONCAT("images/gallery/", image) image', ['id != ' => 0]);
		$data['cats'] = $this->main->getall('category', 'id, name', ['is_deleted' => 0]);
		foreach ($data['cats'] as $k => $v)
			$data['cats'][$k]['menu'] = $this->web->getItems($v['id']);
		
		return $this->template->load(web('template'), web('gallery'), $data);
	}

	public function about()
	{	
		$data['name'] = 'about';
		$data['title'] = 'about';
		
		return $this->template->load(web('template'), web('about'), $data);
	}

	public function menu()
	{	
		$data['name'] = 'menu';
		$data['title'] = 'menu';
		$data['cats'] = $this->main->getall('category', 'id, name', ['is_deleted' => 0]);
		foreach ($data['cats'] as $k => $v)
			$data['cats'][$k]['menu'] = $this->web->getItems($v['id']);
		
		return $this->template->load(web('template'), web('menu'), $data);
	}

	public function contact()
	{	
		$data['name'] = 'contact';
		$data['title'] = 'contact';
		
		return $this->template->load(web('template'), web('contact'), $data);
	}

	public function contact_post()
	{	
		if (!$this->input->is_ajax_request())
		   return $this->error_404();
		else{
			$post = [
				'name'       => $this->input->post('name'),
				'email'      => $this->input->post('email'),
				'message'    => $this->input->post('message'),
				'created_at' => date('Y-m-d H:i:s')
			];

			if ($this->main->add($post, 'contact'))
				echo "success";
			else
			    echo "error";
		}
	}

	public function error_404()
	{
		return $this->load->view('error_404');
	}
}
