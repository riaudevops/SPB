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
            $config['per_page'] = 10;  //show record per halaman
            $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $username = $this->session->userdata('username');
            $data['title'] = "Riwayat Peminjaman";
            $data['index'] = 2;
            $data_user = $this->history->getUserByUsername($username);
            $data['peminjaman'] = $this->history->getDataPeminjaman($data_user['id'], $config["per_page"], $data['page']);

            $this->showPeminjaman($data);
        } else {
            $config['per_page'] = 10;  //show record per halaman
            $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data['title'] = "Riwayat Peminjaman";
            $data['index'] = 5;
            $data['peminjaman'] = $this->history->getAllDataPeminjaman($config["per_page"], $data['page']);

            $this->showPeminjaman($data);
        }
    }

    public function showPeminjaman($datas)
    {
        $config['base_url'] = site_url('history/index'); //site url
        $config['total_rows'] = $this->db->count_all('peminjaman_pengembalian'); //total row
        // $config['total_rows'] = count($datas['peminjaman']);
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = '&raquo;';
        $config['prev_link']        = '&laquo;';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['pagination'] = $this->pagination->create_links();

        if ($this->session->userdata('hak_akses') == 0) {

            $data['title'] = $datas['title'];
            $data['index'] = $datas['index'];
            $data['peminjaman'] = $datas['peminjaman'];

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar');
            $this->load->view('history/user_dashboard', $data);
            $this->load->view('templates/footer');
        } else {

            $data['title'] = $datas['title'];
            $data['index'] = $datas['index'];
            $data['peminjaman'] = $datas['peminjaman'];

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar');
            $this->load->view('history/dashboard', $data);
            $this->load->view('templates/footer');
        }
    }

    public function cetakLaporan()
    {
        $data['peminjaman'] = $this->history->getAllDataPeminjamanReport();

        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "Laporan Peminjaman Buku_" . date('dmY') . " .pdf";
        $this->pdf->load_view('history/laporan', $data);
    }
}
