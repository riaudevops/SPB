<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Manage_model', 'mng');
        $this->load->library('pagination');

        is_logged_in();

        if ($this->session->userdata('hak_akses') != 1) {
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
                'letak_buku' => $this->input->post('letak_buku'),
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
                if ($this->mng->addBook($data)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menyimpan data buku</div>');
                    redirect('manage/book');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terjadi kesalahan, gagal menyimpan data buku</div>');
                    redirect('manage/book');
                }
            } else {
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
                'letak_buku' => $this->input->post('letak_buku'),
                'jumlah' => htmlspecialchars($this->input->post('jumlah')),
            ];

            if ($this->mng->editBook($data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengubah data buku</div>');
                redirect('manage/book');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terjadi kesalahan, gagal mengubah data buku</div>');
                redirect('manage/book');
            }
        }
    }

    public function deleteBook()
    {
        $id = $this->input->post('id');

        if ($this->mng->deleteBook($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus data buku</div>');
            redirect('manage/book');
        } else {
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

            if ($datas) {
                self::showBook($datas);
            } else {
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
        $data['jumlah_dipinjam'] = array();

        //		var_dump($data['buku']);
        //		die;

        for ($i = 0; $i < count($data['buku']); $i++) {
            $jumlah = $this->mng->jumlahBukuDipinjam($data['buku'][$i]['id']);
            array_push($data['jumlah_dipinjam'], $jumlah);
        }

        $data['pagination'] = $this->pagination->create_links();
        $data['title'] = "Manajemen Buku";
        $data['index'] = 2;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('manage/book', $data);
        $this->load->view('templates/footer');
    }

    public function user()
    {
        $config['base_url'] = site_url('manage/user'); //site url
        $config['total_rows'] = $this->db->count_all('user'); //total row
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
        $data['user'] = $this->mng->getAllUser($config["per_page"], $data['page']);
        $data['pagination'] = $this->pagination->create_links();
        $data['title'] = "Manajemen User";
        $data['index'] = 3;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('manage/user');
        $this->load->view('templates/footer');
    }

    public function addUser()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password1', 'password1', 'trim|required');
        $this->form_validation->set_rules('password2', 'password2', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger role="alert">Gagal menambah data user, semua field harus diisi</div>');
            redirect('manage/user');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('nama')),
                'username' => htmlspecialchars($this->input->post('username')),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'hak_akses' => '0'
            ];

            $data2 = $this->mng->getUsers();
            $berbeda = true;
            foreach ($data2 as $user) {
                unset($user['id']);
                if ($data['username'] == $user['username']) {
                    $berbeda = false;
                }
            }

            if ($berbeda) {
                if ($this->mng->addUser($data)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menyimpan data user</div>');
                    redirect('manage/user');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terjadi kesalahan, gagal menyimpan data user</div>');
                    redirect('manage/user');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan, user dengan data yang sama sudah tersimpan</div>');
                redirect('manage/user');
            }
        }
    }

    public function editUser()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger role="alert">Gagal mengubah data user, semua field harus diisi</div>');
            redirect('manage/user');
        } else {
            $data = [
                'id' => htmlspecialchars($this->input->post('idUser')),
                'name' => htmlspecialchars($this->input->post('nama')),
                'username' => htmlspecialchars($this->input->post('username'))
            ];

            if ($this->mng->editUser($data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengubah data user</div>');
                redirect('manage/user');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terjadi kesalahan, gagal mengubah data user</div>');
                redirect('manage/user');
            }
        }
    }

    public function deleteUser()
    {
        $id = $this->input->post('id');

        if ($this->mng->deleteUser($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus data user</div>');
            redirect('manage/book');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terjadi kesalahan, gagal menghapus data user</div>');
            redirect('manage/book');
        }
    }

    public function getUserById()
    {
        $id = $this->input->post('id');
        $data = $this->mng->getUserById($id);
        echo json_encode($data);
    }

    public function searchUser()
    {
        $this->form_validation->set_rules('keywordNama', 'keywordNama', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger role="alert">Terjadi kesalahan mencari user</div>');
            redirect('manage/user');
        } else {
            $keyword = htmlspecialchars($this->input->post('keywordNama'));
            $datas = $this->mng->searchUser($keyword);

            if ($datas) {
                $data['user'] = $datas;
                $data['title'] = "Manajemen User";
                $data['index'] = 3;

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar');
                $this->load->view('manage/user');
                $this->load->view('templates/footer');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kesalahan mencari user</div>');
                redirect('manage/book');
            }
        }
    }

    public function peminjaman()
    {

        $data['title'] = "Manajemen Peminjaman";
        $data['index'] = 4;
        $data['peminjaman'] = $this->mng->getAllPeminjamanBuku();
        $data['id_peminjaman'] = $this->mng->getAllIdPeminjamanBuku();

        /*
		$data['data_peminjaman'] = $this->mng->getAllDataPeminjaman();
		$data['buku_dipinjam'] = $this->mng->getAllBukuDipinjam();
		$data['user_peminjam'] = $this->mng->getAllUserPeminjam();
		*/

        // var_dump($data['peminjaman'][0]['id']);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar');
        $this->load->view('manage/peminjaman', $data);
        $this->load->view('templates/footer');
    }

    public function addPeminjaman()
    {
        $this->form_validation->set_rules('tanggalPeminjaman', 'tanggalPeminjaman', 'trim|required');
        $this->form_validation->set_rules('namaPeminjam', 'namaPeminjam', 'trim|required');
        $this->form_validation->set_rules('bukuDipinjam', 'bukuDipinjam', 'trim|required');

        $tanggal_peminjaman = date('Y-m-d');
        $id_user = $this->mng->getUserIdByName(htmlspecialchars($this->input->post('namaPeminjam')));
        $id_buku = $this->mng->getBookIdByName(htmlspecialchars($this->input->post('bukuDipinjam')));

        $cekPeminjaman = $this->mng->getDataPeminjamanByIdUser($id_user['id']);

        $data['buku'] = $this->mng->getBookByIdArray($id_buku['id']);
        $data['jumlah_dipinjam'] = array();


        $tmp = $this->mng->jumlahBukuDipinjam($data['buku'][0]['id']);
        $jumlah = (int) $data['buku'][0]['jumlah'] - (int) count($tmp);

        // echo $data['buku'][0]['jumlah'];
        // echo count($tmp);
        // echo $jumlah;
        // die;

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger role="alert">Gagal menambah peminjaman, semua field harus diisi</div>');
            redirect('manage/peminjaman');
        } else {

            if ($jumlah > 0) {
                if (count($cekPeminjaman) < 3) {
                    $data = [
                        'id_user' => $id_user['id'],
                        'id_buku' => $id_buku['id'],
                        'tanggal_peminjaman' => $tanggal_peminjaman,
                        'tanggal_pengembalian' => '0000-00-00',
                        'denda' => 0,
                        'status' => 0,
                    ];

                    if ($this->mng->addPeminjaman($data)) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil meminjam buku</div>');
                        redirect('manage/peminjaman');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terjadi kesalahan, gagal melakukan peminjaman buku</div>');
                        redirect('manage/peminjaman');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal melakukan peminjaman, ' . htmlspecialchars($this->input->post('namaPeminjam')) . ' belum mengembalikan 3 buku yang dipinjam</div>');
                    redirect('manage/peminjaman');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal melakukan peminjaman, buku ' . htmlspecialchars($this->input->post('bukuDipinjam')) . ' sudah tidak tersedia untuk dipinjam</div>');
                redirect('manage/peminjaman');
            }
        }
    }

    public function searchPeminjaman()
    {
        $this->form_validation->set_rules('keyword', 'keyword', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger role="alert">Terjadi kesalahan mencari data peminjaman</div>');
            redirect('manage/peminjaman');
        } else {
            $keyword = htmlspecialchars($this->input->post('keyword'));
            $datas = $this->mng->searchPeminjam($keyword);

            if ($datas) {
                $data['peminjaman'] = $datas;
                $data['title'] = "Manajemen Peminjaman";
                $data['index'] = 4;

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar');
                $this->load->view('manage/peminjaman', $data);
                $this->load->view('templates/footer');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kesalahan mencari data peminjaman</div>');
                redirect('manage/peminjaman');
            }
        }
    }

    public function searchUserAjax()
    {
        $searchText = $this->input->post('query');
        $data['isi'] = $this->mng->searchUserAjax($searchText);

        // var_dump($result->result_array());
        // die();

        if (!empty($data['isi'])) {
            foreach ($data['isi'] as $nama) {
                echo "<option value=" . $nama['name'] . ">" . $nama['name'] . "</option>";
            }
            echo '<br/>';
        } else {
            echo "null";
        }
    }
    public function searchBukuAjax()
    {
        $searchText = $this->input->post('query');
        $data['isi'] = $this->mng->searchBukuAjax($searchText);

        if (!empty($data['isi'])) {
            foreach ($data['isi'] as $judul) {
                echo "<option value=" . $judul['judul'] . ">" . $judul['judul'] . "</option>";
            }
            echo '<br/>';
        } else {
            echo "null";
        }
    }

    public function kembalikan()
    {
        $id = $this->input->post('idPeminjaman');

        $data_peminjaman = $this->mng->getDataPeminjamanById($id);

        $tanggal_pengembalian = date('Y-m-d');

        $denda = $this->_hitungDenda($data_peminjaman[0]['tanggal_peminjaman']);

        $data = array(
            'id' => $id,
            'tanggal_pengembalian' => $tanggal_pengembalian,
            'denda' => $denda,
            'status' => 1,
        );

        // var_dump($denda);
        // die;

        if ($this->mng->pengembalianPeminjaman($data)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengembalikan peminjaman buku</div>');
            redirect('manage/peminjaman');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terjadi kesalahan, gagal mengembalikan peminjaman buku</div>');
            redirect('manage/peminjaman');
        }
    }

    private function _hitungDenda($tanggalPeminjaman)
    {
        $date1 = strtotime(date('Y-m-d'));
        $date2 = strtotime(date('Y-m-d', strtotime($tanggalPeminjaman . ' + 7 days')));

        if ($date2 > $date1) {
            $days = 0;
            return 0;
        } else {
            // Formulate the Difference between two dates
            $diff = abs($date1 - $date2);


            // To get the year divide the resultant date into
            // total seconds in a year (365*60*60*24)
            $years = floor($diff / (365 * 60 * 60 * 24));


            // To get the month, subtract it with years and
            // divide the resultant date into
            // total seconds in a month (30*60*60*24)
            $months = floor(($diff - $years * 365 * 60 * 60 * 24)
                / (30 * 60 * 60 * 24));


            // To get the day, subtract it with years and
            // months and divide the resultant date into
            // total seconds in a days (60*60*24)
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 -
                $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

            return (int) $days * 500;
        }
    }
}
