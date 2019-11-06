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
        }else{
            $this->db->LIKE('penulis', $keyword);
        }
        $data = $this->db->get();
        return $data->result_array();
    }
}