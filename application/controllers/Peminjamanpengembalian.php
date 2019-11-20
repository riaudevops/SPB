<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjamanpengembalian extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Manage_model','mng');
        $this->load->library('pagination');

        is_logged_in();

        if($this->session->userdata('hak_akses') != 1){
            redirect('home');
        }
    }

    public function index()
    {
        $data['title'] = 'Manajemen Peminjaman dan Pengembalian';
        $data['index'] = 4;
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar');
        $this->load->view('home/dashboard');
        $this->load->view('templates/footer');
    }
}