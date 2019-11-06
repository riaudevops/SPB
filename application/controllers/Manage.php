<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller {

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
        $this->load->view('templates/header');
        $this->load->view('404_message');
        $this->load->view('templates/footer');
    }

    public function book()
    {
        $config['per_page'] = 10;  //show record per halaman
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = $this->mng->getAllBook($config["per_page"], $data['page']);           
        self::showBook($data);
    }

    public function getBookById()
    {
        $id = $this->input->post('id');
        $data = $this->mng->getBookById($id);
        echo json_encode($data);
    }

    public function addBook()
    {
        $this->form_validation->set_rules('judul', 'judul', 'trim|required');
        $this->form_validation->set_rules('penulis', 'penulis', 'trim|required');
        $this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
        $this->form_validation->set_rules('penerbit', 'penerbit', 'trim|required');
        $this->form_validation->set_rules('kota_terbit', 'kota_terbit', 'trim|required');
        $this->form_validation->set_rules('sub_judul', 'sub_judul', 'trim|required');
        $this->form_validation->set_rules('jumlah_halaman', 'jumlah_halaman', 'trim|required');
        $this->form_validation->set_rules('letak_buku', 'letak_buku', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger role="alert">Gagal menambah data buku, semua field harus diisi</div>');
            redirect('manage/book');
        } else {
            $data = [
                'judul' => htmlspecialchars($this->input->post('judul')),
                'penulis' => htmlspecialchars($this->input->post('penulis')),
                'tahun' => htmlspecialchars($this->input->post('tahun')),
                'penerbit' => htmlspecialchars($this->input->post('penerbit')),
                'kota_terbit' => htmlspecialchars($this->input->post('kota_terbit')),
                'sub_judul' => htmlspecialchars($this->input->post('sub_judul')),
                'jumlah_halaman' => htmlspecialchars($this->input->post('jumlah_halaman')),
                'letak_buku' =>$this->input->post('letak_buku'),
                'jumlah' => htmlspecialchars($this->input->post('jumlah')),
            ];

            $data2 = $this->mng->getBooks();
            $berbeda = true;
            foreach ($data2 as $buku) {
                unset($buku['id']);
                if ($data == $buku) {
                    $berbeda = false;
                }
            }

            if ($berbeda) {
                if($this->mng->addBook($data)){
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menyimpan data buku</div>');
                    redirect('manage/book');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terjadi kesalahan, gagal menyimpan data buku</div>');
                    redirect('manage/book');
                }   
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan, buku dengan data yang sama sudah tersimpan</div>');
                redirect('manage/book');
            }
        }
    }

    public function editBook()
    {
        $this->form_validation->set_rules('judul', 'judul', 'trim|required');
        $this->form_validation->set_rules('penulis', 'penulis', 'trim|required');
        $this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
        $this->form_validation->set_rules('penerbit', 'penerbit', 'trim|required');
        $this->form_validation->set_rules('kota_terbit', 'kota_terbit', 'trim|required');
        $this->form_validation->set_rules('sub_judul', 'sub_judul', 'trim|required');
        $this->form_validation->set_rules('jumlah_halaman', 'jumlah_halaman', 'trim|required');
        $this->form_validation->set_rules('letak_buku', 'letak_buku', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger role="alert">Gagal mengubah data buku, semua field harus diisi</div>');
            redirect('manage/book');
        } else {
            $data = [
                'id' => htmlspecialchars($this->input->post('id')),
                'judul' => htmlspecialchars($this->input->post('judul')),
                'penulis' => htmlspecialchars($this->input->post('penulis')),
                'tahun' => htmlspecialchars($this->input->post('tahun')),
                'penerbit' => htmlspecialchars($this->input->post('penerbit')),
                'kota_terbit' => htmlspecialchars($this->input->post('kota_terbit')),
                'sub_judul' => htmlspecialchars($this->input->post('sub_judul')),
                'jumlah_halaman' => htmlspecialchars($this->input->post('jumlah_halaman')),
                'letak_buku' =>$this->input->post('letak_buku'),
                'jumlah' => htmlspecialchars($this->input->post('jumlah')),
            ];

            if($this->mng->editBook($data)){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengubah data buku</div>');
                redirect('manage/book');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terjadi kesalahan, gagal mengubah data buku</div>');
                redirect('manage/book');
            }
        }
    }

    public function deleteBook()
    {
        $id = $this->input->post('id');
        if($this->mng->deleteBook($id)){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus data buku</div>');
            redirect('manage/book');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terjadi kesalahan, gagal menghapus data buku</div>');
            redirect('manage/book');
        }
    }

    public function searchBook()
    {
        $this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
        $this->form_validation->set_rules('keyword', 'keyword', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger role="alert">Terjadi kesalahan mencari buku</div>');
            redirect('manage/book');
        } else {
            $kategori = $this->input->post('kategori');
            $keyword = htmlspecialchars($this->input->post('keyword'));
            $datas = $this->mng->searchBook($kategori, $keyword);

            if($datas){
                self::showBook($datas);
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kata kunci dalam kategori tersebut tidak ditemukan</div>');
                redirect('manage/book');
            }
        }
    }

    public function showBook($datas)
    {
        //konfigurasi pagination
        $config['base_url'] = site_url('manage/book'); //site url
        $config['total_rows'] = $this->db->count_all('buku'); //total row
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
        $data['buku'] = $datas;           
        $data['pagination'] = $this->pagination->create_links();
        $data['title'] = "Manajemen Buku";
        $data['index'] = 2;

        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar');
        $this->load->view('manage/book',$data);
        $this->load->view('templates/footer');
    }

    public function user()
    {
        $data['title'] = "Manajemen User";
        $data['index'] = 3;
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar');
        $this->load->view('manage/user');
        $this->load->view('templates/footer');
    }
}