<?php
class M_kelompok extends CI_Model {
	// public $table = 'tb_';
 //    public $kd = 'kode_anjing';
 //    public $order = 'DESC';

	public function __construct()	{
		$this->load->database();
	}

	public function get_id ($id){
		$query = $this->db->get_where('tb_kelompok', array('id_kelompok' => $id));
		return $query->result_array();
    }
	
	// Menampilkan data kelompok
	public function daftar_kelompok($num,$offset) {
		$this->db->select('*');
  		$this->db->from('tb_kelompok','tb_user');
  		$this->db->join('tb_user','tb_kelompok.id_user = tb_user.id_user','left');
  		$this->db->order_by('id_kelompok','asc');
  		$query = $this->db->get('',$num,$offset);
        return $query->result_array();
	}

	// Model untuk menambah data kelompok
	public function tambah($data_kelompok) {
		$this->db->insert('tb_kelompok', $data_kelompok);
	}
	
	// Update data kelompok
	public function edit($data_kelompok) {
		$this->db->where('id_kelompok', $data_kelompok['id_kelompok']);
		return $this->db->update('tb_kelompok', $data_kelompok);
	}
	
	// Hapus data kelompok
	public function delete($id) {
		$this->db->where('id_kelompok',$id);
		return $this->db->delete('tb_kelompok');
	}

	public function get_cari_kelompok($id) {
    $this->db->select('*');
    $this->db->where('id_kelompok', $id);
    $query = $this->db->get('tb_kelompok'); 
    	return $query->result_array();
	}

	public function get_user() {
   		$query = $this->db->get_where('tb_user', array('id_level' => '4'));
		return $query->result_array();
	}

	public function jumlah_kelompok()
	{
		$this->db->select('*');
		$query = $this->db->get('tb_kelompok'); 
		return $query->num_rows();
	}

	public function daftar_kelompok2() {
		$this->db->select('*');
  		$this->db->from('tb_kelompok','tb_user','tb_mahasiswa');
  		$this->db->join('tb_user','tb_kelompok.id_user = tb_user.id_user','left');
  		$this->db->join('tb_mahasiswa','tb_kelompok.id_kelompok = tb_mahasiswa.id_kelompok','right');
  		$this->db->order_by('nim','asc');
  		$query = $this->db->get('');
        return $query->result_array();
	}

	public function get_cari_sama($data_kelompok) 
	{
   		$this->db->select('*');
      	$this->db->where('nm_kelompok', $data_kelompok['nm_kelompok']);
      	$query = $this->db->get('tb_kelompok');
    	return $query->num_rows();
	}
}