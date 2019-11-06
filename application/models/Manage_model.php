<?php

class Manage_model extends CI_Model
{
    public function getAllBook($limit, $start)
    {
        // $this->db->SELECT('*');
        // $this->db->FROM('buku');

        $this->db->order_by('judul', 'ASC');
        $data = $this->db->get('buku', $limit, $start);   
        return $data->result_array();
    }

    public function getBooks()
    {
        $data = $this->db->get('buku');
        return $data->result_array();
    }

    public function getBookById($id)
    {
        $query = $this->db->get_where('buku', array('id' => $id));
        return $query->row_array();
    }

    public function addBook($data)
    {
        $this->db->insert('buku', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function editBook($data)
    {
        $id = $data['id'];
        $this->db->where('id', $id);
        $this->db->update('buku', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function deleteBook($id)
    {
        $this->db->delete('buku', array('id' => $id));
        return ($this->db->affected_rows() != 1) ? false : true;
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