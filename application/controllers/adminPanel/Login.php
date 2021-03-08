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
    			$this->session->set_flashdata('notify', 'error');
                $this->session->set_flashdata('message', 'Invalid credentials.');
    			return redirect(admin('login'));
    		}
    	}
    }

    public function forgot_password()
    {
        $data['title'] = 'forgot password';
        $forgot = [
                    [
                        'field' => 'mobile',
                        'label' => 'Email OR Mobile No.',
                        'rules' => 'required',
                        'errors' => [
                            'required' => "%s"
                        ],
                    ]
                ];

        $this->form_validation->set_rules($forgot);
        if ($this->form_validation->run() == FALSE) {
            return $this->template->load(admin('auth/template'), admin('auth/forgot_password'), $data);
        }else{

            $mobile = $this->input->post('mobile');
            $user = $this->main->get($this->table, 'id, email', "email = '".$mobile."' OR mobile = '".$mobile."'");
            
            if ($user) {
                $otp = ($_SERVER['HTTP_HOST'] == 'localhost') ? 123456 : rand(100000, 999999);
                
                $this->main->update($user, ['otp' => $otp, 'last_update' => date('Y-m-d H:i:s')], $this->table);

                $this->load->library('email');
                $message = "Yor OTP for password reset - ".$otp;

                $this->email->clear();
                $this->email->set_newline("\r\n");
                $this->email->from($this->main->check($this->table, ['id' => 1], 'email'));
                $this->email->to($user['email']);
                $this->email->subject('Yor OTP for password reset.');
                $this->email->message($message);
                if ($this->email->send()) {
                    $flash = ['notify' => 'success', 'message' => 'Email Sent Successfull to your email address.', 'emailCheck' => $user['email']];
                    $this->session->set_flashdata($flash);
                    return redirect(admin('checkOtp'));
                }else{
                    $flash = ['notify' => 'error', 'message' => 'Email not sent. Please try again.'];
                    $this->session->set_flashdata($flash);
                    return redirect(admin('forgot-password'));
                }
            }else{
                $this->session->set_flashdata('notify', 'error');
                $this->session->set_flashdata('message', 'Email OR Mobile No. not registered.');
                return redirect(admin('forgot-password'));
            }
        }
    }

    public function checkOtp()
    {
        if (empty($this->session->emailCheck)) return redirect (admin('login'));

        if ($_SERVER['HTTP_HOST'] === 'localhost')
            $this->session->set_flashdata('emailCheck', $this->session->emailCheck);

        $data['title'] = 'OTP Verify';

        $this->form_validation->set_rules('otp', 'OTP', 'required', ['required' => "%s is Required"]);
        if ($this->form_validation->run() == FALSE) {
            return $this->template->load(admin('auth/template'), admin('auth/check_otp'), $data);
        }else{
            $post = [
                'email'           => $this->session->emailCheck,
                'otp'             => $this->input->post('otp'),
                'last_update >= ' => date('Y-m-d H:i:s', strtotime('-5 minutes'))
            ];

            $user = $this->main->check($this->table, $post, 'id');
            
            if ($user) {
                $flash = ['notify' => 'success', 'message' => 'OTP match. Change your password.', 'adminId' => $user];
                $this->session->set_flashdata($flash);
                return redirect(admin('changePassword'));
            }else{
                $flash = ['notify' => 'error', 'message' => 'OTP not match. Please try again.', 'emailCheck' => $this->session->emailCheck];
                $this->session->set_flashdata($flash);
                return redirect(admin('checkOtp'));
            }
        }
    }

    public function changePassword()
    {
        if (empty($this->session->adminId)) return redirect (admin('login'));
        if ($_SERVER['HTTP_HOST'] === 'localhost')
            $this->session->set_flashdata('adminId', $this->session->adminId);
        $data['title'] = 'Change Password';

        $this->form_validation->set_rules('password', 'Password', 'required', ['required' => "%s is Required"]);
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]', ['required' => "%s is Required", 'matches' => "%s is Differ than Password"]);

        if ($this->form_validation->run() == FALSE) {
            return $this->template->load(admin('auth/template'), admin('auth/change_password'), $data);
        }else{
            $post = ['password' => my_crypt($this->input->post('password'))];
            $id = $this->main->update(['id' => $this->session->adminId], $post, $this->table);
            
            if ($id) {
                $flash = ['notify' => 'success', 'message' => 'Password changed. Login with new password.'];
                $this->session->set_flashdata($flash);
                return redirect(admin('login'));
            }else{
                $flash = ['notify' => 'error', 'message' => 'Password not changed. Please try again.', 'adminId' => $this->session->adminId];
                $this->session->set_flashdata($flash);
                return redirect(admin('changePassword'));
            }
        }
    }
}
