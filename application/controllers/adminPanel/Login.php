<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->auth) return redirect(admin());
	}

	protected $table = 'admins';
	
    protected $login = [
        [
            'field' => 'mobile',
            'label' => 'Mobile No.',
            'rules' => 'required|numeric|exact_length[10]',
            'errors' => [
                'required' => "%s is Required",
                'numeric' => "%s is Invalid",
                'exact_length' => "%s is Invalid",
            ],
        ],
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ],
        ]
    ];

	public function index()
    {
    	$data['title'] = 'login';
    	$this->form_validation->set_rules($this->login);
    	if ($this->form_validation->run() == FALSE) {
    		return $this->template->load(admin('auth/template'), admin('auth/login'), $data);
    	}else{

    		$post = [
    			'mobile'   	 => $this->input->post('mobile'),
    			'password'   => my_crypt($this->input->post('password'))
    		];

    		$user = $this->main->get($this->table, 'id auth, UCASE(name) name, mobile, email', $post);
            
            if ($user) {
    			$this->session->set_userdata($user);
    			return redirect(admin());
    		}else{
    			$this->session->set_flashdata('notify', 'error message');
                $this->session->set_flashdata('message', 'Invalid credentials.');
    			return redirect(admin('login'));
    		}
    	}
    }
}
