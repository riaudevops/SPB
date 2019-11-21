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

	public function getBookByIdArray($id)
	{
		$query = $this->db->get_where('buku', array('id' => $id));
		return $query->result_array();
	}

	public function getBookIdByName($judul)
	{
		$this->db->select('id');
		$this->db->from('buku');
		$this->db->where('judul', $judul);
		$query = $this->db->get();
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
		} else {
			$this->db->LIKE('penulis', $keyword);
		}
		$data = $this->db->get();
		return $data->result_array();
	}

	public function searchBukuAjax($searchText)
	{
		$this->db->select('*');
		$this->db->from('buku');
		$this->db->LIKE('buku.judul', $searchText);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getAllUser($limit, $start)
	{
		// $this->db->SELECT('*');
		// $this->db->FROM('buku');

		$this->db->order_by('name', 'ASC');
		$data = $this->db->get_where('user', array('hak_akses' => '0'), $limit, $start);
		return $data->result_array();
	}

	public function getUsers()
	{
		$data = $this->db->get('user');
		return $data->result_array();
	}

	public function addUser($data)
	{
		$this->db->insert('user', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function deleteUser($id)
	{
		$this->db->delete('user', array('id' => $id));
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function getUserById($id)
	{
		$this->db->select('id');
		$this->db->select('name');
		$this->db->select('username');
		$this->db->from('user');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getUserIdByName($name)
	{
		$this->db->select('id');
		$this->db->from('user');
		$this->db->where('name', $name);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function editUser($data)
	{
		$id = $data['id'];
		$this->db->where('id', $id);
		$this->db->update('user', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function searchUser($keyword)
	{
		$this->db->SELECT('*');
		$this->db->FROM('user');
		$this->db->LIKE('name', $keyword);
		$this->db->WHERE('hak_akses', '0');
		$data = $this->db->get();
		return $data->result_array();
	}

	public function searchUserAjax($searchText)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('hak_akses', 0);
		$this->db->LIKE('user.name', $searchText);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getAllPeminjaman()
	{
		$query = $this->db->get_where('data_peminjaman_pengembalian', array('status' => 0));
		return $query->result_array();
	}

	public function getAllPeminjamanBuku()
	{
		// $query = $this->db->get_where('data_peminjaman_pengembalian', array('status' => 0));

		$this->db->select('*');
		$this->db->from('peminjaman_pengembalian');
		$this->db->join('buku', 'peminjaman_pengembalian.id_buku = buku.id', 'left');
		$this->db->join('user', 'peminjaman_pengembalian.id_user = user.id', 'left');
		$this->db->order_by('tanggal_peminjaman', 'DESC');
		$this->db->where('status', 0);

		$query = $this->db->get();

		return $query->result_array();
	}

	public function getAllIdPeminjamanBuku()
	{
		$query = $this->db->get('peminjaman_pengembalian');
		return $query->result_array();
	}

	public function getAllDataPeminjaman()
	{
		$query = $this->db->get('buku_yang_dipinjam');
		return $query->result_array();
	}

	public function getDataPeminjaman($id)
	{
		$query = $this->db->get_where('buku_yang_dipinjam', array('id_user' => $id));
		return $query->result_array();
	}

	public function getDataPeminjamanByIdUser($id)
	{
		$this->db->select('*');
		$this->db->from('peminjaman_pengembalian');
		$this->db->where('id_user', $id);
		$this->db->where('status', 0);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function addPeminjaman($data)
	{
		$this->db->insert('peminjaman_pengembalian', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function getBukuDipinjam($id)
	{
		$query = $this->db->get_where('buku', array('id' => $id));
		return $query->result_array();
	}

	public function getUserPeminjam($id)
	{
		$query = $this->db->get_where('user', array('id' => $id));
		return $query->result_array();
	}

	public function getAllBukuDipinjam()
	{
		$query = $this->db->get('buku');
		return $query->result_array();
	}

	public function getAllUserPeminjam()
	{
		$query = $this->db->get_where('user', array('hak_akses' => 0));
		return $query->result_array();
	}

	public function jumlahBukuDipinjam($id)
	{
		$query = $this->db->get_where('peminjaman_pengembalian', array('status' => 0, 'id_buku' => $id));
		return $query->result_array();
	}

	public function jumlahBukuDipinjamSingle($id) ///////////////////////////////////////////////////////////
	{
		$query = $this->db->get_where('peminjaman_pengembalian', array('status' => 0, 'id_buku' => $id));
		return $query->row_array();
	}

	public function searchPeminjam($keyword)
	{
		$this->db->select('*');
		$this->db->from('peminjaman_pengembalian');
		$this->db->join('user', 'peminjaman_pengembalian.id_user = user.id');
		$this->db->join('buku', 'peminjaman_pengembalian.id_buku = buku.id');
		$this->db->order_by('tanggal_peminjaman', 'DESC');
		$this->db->LIKE('user.name', $keyword);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function pengembalianPeminjaman($data)
	{
		$id = $data['id'];
		$this->db->where('id', $id);
		$this->db->update('peminjaman_pengembalian', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
}
