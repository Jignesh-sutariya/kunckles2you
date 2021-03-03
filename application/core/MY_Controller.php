<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->auth = $this->session->auth;

		if (!$this->auth) return redirect(admin('login'));

		$this->redirect = admin($this->redirect);
	}

	public function error_404()
	{
		$data['name'] = 'error_404';
		$data['title'] = 'Error 404';
		$data['url'] = $this->redirect;
		
		return $this->template->load(admin('template'), admin('error_404'), $data);
	}
}
