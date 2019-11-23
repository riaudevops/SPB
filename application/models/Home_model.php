<?php

class Home_model extends CI_Model
{
    public function getAllBook($limit, $start)
    {
        // $this->db->SELECT('*');
        // $this->db->FROM('buku');

        $this->db->order_by('judul', 'ASC');
        $data = $this->db->get('buku', $limit, $start);
        return $data->result_array();
    }

    public function searchBook($kategori, $keyword)
    {
        $query = "SELECT * FROM buku WHERE judul LIKE ";
        $this->db->SELECT('*');
        $this->db->FROM('buku');
        if ($kategori == 'Judul') {
            $this->db->LIKE('Judul', $keyword);
        } else {
            $this->db->LIKE('penulis', $keyword);
        }
        $data = $this->db->get();
        return $data->result_array();
    }

    public function jumlahBukuDipinjam($id)
    {
        $query = $this->db->get_where('peminjaman_pengembalian', array('status' => 0, 'id_buku' => $id));
        return $query->result_array();
    }

    public function getJumlahBuku()
    {
        $query = $this->db->count_all('buku');
        return $query;
    }

    public function getJumlahUser()
    {
        $this->db->like('hak_akses', 0);
        $this->db->from('user');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function getJumlahPeminjaman()
    {
        $this->db->like('status', 0);
        $this->db->from('peminjaman_pengembalian');
        $query = $this->db->count_all_results();
        return $query;
    }

    public function getJumlahPengembalian()
    {
        $this->db->like('status', 1);
        $this->db->from('peminjaman_pengembalian');
        $query = $this->db->count_all_results();
        return $query;
    }
}
