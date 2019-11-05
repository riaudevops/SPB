<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
	}

	public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('home');
		}
		
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // validasinya success
            $this->_login();
        }
	}

	private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        // jika usernya ada
        if ($user) {
			// cek password
			if (password_verify($password, $user['password'])) {
				$data = [
					'username' => $user['username'],
					'hak_akses' => $user['hak_akses']
				];
				$this->session->set_userdata($data);
				redirect('home');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf, password salah</div>');
				redirect('auth');
			}
		} else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf, username tidak terdaftar</div>');
            redirect('auth');
        }
    }

	public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('hak_akses');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil logout</div>');
        redirect('home');
	}
	
	public function registration()
    {
        if ($this->session->userdata('username')) {
            redirect('home');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'This username has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'SPB User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $username = $this->input->post('username', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'username' => htmlspecialchars($username),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'hak_akses' => 0
            ];

			$this->db->insert('user', $data);
			
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat, akun berhasil dibuat</div>');
            redirect('auth');
        }
	}
	
}