<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model','home');
        $this->load->library('pagination');
	}

    public function index()
    {
        $config['per_page'] = 2;  //show record per halaman
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        // $data['siteUrl'] = site_url();
        // $data['baseUrl'] = base_url();

        // var_dump($data);
        // die();

        $data = $this->home->getAllBook($config["per_page"], $data['page']);           
        self::showBook($data);
    }

    public function showBook($datas)
    {
        //konfigurasi pagination
        $config['base_url'] = base_url('home/index'); //site url
        $config['total_rows'] = $this->db->count_all('buku'); //total row
        $config['per_page'] = 2;  //show record per halaman
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
        $data['buku'] = $datas;           
        $data['pagination'] = $this->pagination->create_links();

        $data['title'] = "Homepage";
        $data['index'] = 1;
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar');

        if($this->session->userdata('username') !== null){
            if ($this->session->userdata('hak_akses') == 1) {
                $this->load->view('home/dashboard');
            }else{
                $this->load->view('home/user_dashboard',$datas);
            }
        }else{
            $this->load->view('home/index');
        }

        $this->load->view('templates/footer');
    }
    
    public function searchBook()
    {
        $this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
        $this->form_validation->set_rules('keyword', 'keyword', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger role="alert">Terjadi kesalahan mencari buku</div>');
            redirect('home');
        } else {
            $kategori = $this->input->post('kategori');
            $keyword = htmlspecialchars($this->input->post('keyword'));
            $datas = $this->home->searchBook($kategori, $keyword);

            if($datas){
                self::showBook($datas);
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kata kunci dalam kategori tersebut tidak ditemukan</div>');
                redirect('home');
            }
        }
    }
}