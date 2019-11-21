<?php

class History_model extends CI_Model
{
    public function getDataPeminjaman($id)
    {
        $this->db->select('*');
        $this->db->from('peminjaman_pengembalian');
        $this->db->join('buku', 'peminjaman_pengembalian.id_buku = buku.id', 'left');
        $this->db->join('user', 'peminjaman_pengembalian.id_user = user.id', 'left');
        $this->db->order_by('tanggal_peminjaman', 'DESC');
        $this->db->where('id_user', $id);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function getAllDataPeminjaman()
    {
        $this->db->select('*');
        $this->db->from('peminjaman_pengembalian');
        $this->db->join('buku', 'peminjaman_pengembalian.id_buku = buku.id', 'left');
        $this->db->join('user', 'peminjaman_pengembalian.id_user = user.id', 'left');
        $this->db->order_by('tanggal_peminjaman', 'DESC');
        $this->db->where('status', 1);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function getUserByUsername($username)
    {
        $this->db->select('id');
        $this->db->select('name');
        $this->db->select('username');
        $this->db->from('user');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row_array();
    }
}
