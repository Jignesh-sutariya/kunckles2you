<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class Home extends MY_Controller {

	protected $redirect = '';
	protected $table = 'admins';

	public function index()
	{
		$data['name'] = 'dashboard';
		$data['title'] = 'dashboard';
		$data['url'] = $this->redirect;

		return $this->template->load(admin('template'), admin('dashboard'), $data);
	}

	public function profile()
	{
		$this->form_validation->set_rules($this->validate);
        
        if ($this->form_validation->run() == FALSE)
        {
			$data['name'] = 'profile';
			$data['title'] = 'profile';
			$data['url'] = $this->redirect;

			return $this->template->load(admin('template'), admin('profile'), $data);
        }else{
        	$post = [
                'name'        => $this->input->post('name'),
                'mobile'      => $this->input->post('mobile'),
                'email'       => $this->input->post('email')
            ];

            if ($this->input->post('password')) 
                $post['password'] = my_crypt($this->input->post('password'));

        	$id = $this->main->update(['id' => $this->auth], $post, $this->table);
        	
        	if ($id)
            	$this->session->set_userdata($this->main->get($this->table, 'id auth, UCASE(name) name, mobile, email', ['id' => $this->auth]));

			flashMsg($id, "Profile updated successfully.", "Profile not updated. Try again.", $this->redirect.'/profile');
        }
	}

    public function logout()
    {
        $this->session->sess_destroy();
        return redirect(admin('login'));
    }

	public function database()
	{
		// Load the DB utility class
        $this->load->dbutil();
        
        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup();

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download(APP_NAME.'.zip', $backup);

        return redirect(admin());
	}

    public function create_qr()
    {
        $writer = new PngWriter();
        // Create QR code
        $qrCode = QrCode::create(base_url('?qrscan=true'))
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
        $result = $writer->write($qrCode);
        // Directly output the QR code
        header('Content-Type: '.$result->getMimeType());
        $result->saveToFile(strtolower(str_replace(" ", '_', APP_NAME)).'.png');
        $this->session->set_flashdata('success', $this->input->get('message'));
        return redirect(admin('profile'));
    }

    public function mobile_check($str)
    {   
        if ($this->main->check($this->table, ['mobile' => $str, 'id != ' => $this->auth], 'id'))
        {
            $this->form_validation->set_message('mobile_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    public function email_check($str)
    {   
        if ($this->main->check($this->table, ['email' => $str, 'id != ' => $this->auth], 'id'))
        {
            $this->form_validation->set_message('email_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    protected $validate = [
        [
            'field' => 'name',
            'label' => 'User Name',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|callback_email_check',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'mobile',
            'label' => 'Mobile No.',
            'rules' => 'required|exact_length[10]|callback_mobile_check',
            'errors' => [
                'required' => "%s is Required"
            ]
        ]
    ];
}
