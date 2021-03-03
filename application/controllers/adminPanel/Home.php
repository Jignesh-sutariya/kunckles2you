<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	protected $redirect = '';

	public function index()
	{
		$data['name'] = 'dashboard';
		$data['title'] = 'dashboard';
		$data['url'] = $this->redirect;
		
		return $this->template->load(admin('template'), admin('dashboard'), $data);
	}

    public function logout()
    {
        $this->session->sess_destroy();
        return redirect(admin('login'));
    }
}
