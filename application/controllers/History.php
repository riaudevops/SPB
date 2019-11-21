<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('History_model', 'history');
        $this->load->library('pagination');

        is_logged_in();

        if ($this->session->userdata('hak_akses') == null) {
            redirect('home');
        }
    }

    public function index()
    {
        if ($this->session->userdata('hak_akses') == 0) {
            $username = $this->session->userdata('username');

            $data['title'] = "Riwayat Peminjaman";
            $data['index'] = 2;
            $data_user = $this->history->getUserByUsername($username);
            $data['peminjaman'] = $this->history->getDataPeminjaman($data_user['id']);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar');
            $this->load->view('history/user_dashboard', $data);
            $this->load->view('templates/footer');
        } else {
            $username = $this->session->userdata('username');

            $data['title'] = "Riwayat Peminjaman";
            $data['index'] = 5;
            $data['peminjaman'] = $this->history->getAllDataPeminjaman();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar');
            $this->load->view('history/dashboard', $data);
            $this->load->view('templates/footer');
        }
    }
}
