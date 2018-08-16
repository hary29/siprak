<?php
class M_mahasiswa extends CI_Model {
	// public $table = 'tb_';
 //    public $kd = 'kode_anjing';
 //    public $order = 'DESC';

	public function __construct()	{
		$this->load->database();
	}

	public function get_id ($id){
		$query = $this->db->get_where('tb_mahasiswa', array('nim' => $id));
		return $query->result_array();
    }
	
	// Menampilkan data mahasiswa
	public function daftar_mahasiswa($num,$offset) {
		$this->db->select('tb_mahasiswa.nim,tb_mahasiswa.nama_mhs,tb_kelompok.nm_kelompok');
  		$this->db->from('tb_mahasiswa','tb_kelompok');
  		$this->db->join('tb_kelompok','tb_mahasiswa.id_kelompok = tb_kelompok.id_kelompok','left');
  		$this->db->order_by('nim','asc');
  		$query = $this->db->get('',$num,$offset);
        return $query->result_array();	
	}

	// Model untuk menambah data kelas
	public function tambah($data_mahasiswa) {
		$this->db->insert('tb_mahasiswa', $data_mahasiswa);
	}
	
	// Update data kelas
	public function edit($data_mahasiswa) {
		$this->db->where('nim', $data_mahasiswa['nim']);
		return $this->db->update('tb_mahasiswa', $data_mahasiswa);
	}
	
	// Hapus data siswa
	public function delete($id) {
		$this->db->where('nim',$id);
		return $this->db->delete('tb_mahasiswa');
	}

	public function get_kelompok()
	{
    	$query = $this->db->get('tb_kelompok'); 
    	return $query->result();
	}

	public function get_anjing_user($id)
	{
		$this->db->where('id_user', $id);
    $query = $this->db->get('tb_anjing'); 
    	return $query-> result() ;
	}

	public function get_cari_mahasiswa($id) {
    $this->db->select('*');
    $this->db->where('nim', $id);
    $query = $this->db->get('tb_mahasiswa'); 
    	return $query->result_array();
	}

	public function get_last_id_anjing()
    {
        $this->db->select_max($this->kd);
        $this->db->order_by($this->kd, $this->order);
        return $this->db->get($this->table)->row();
    }

    public function jumlah_mahasiswa()
	{
		$this->db->select('*');
		$query = $this->db->get('tb_mahasiswa'); 
		return $query->num_rows();
	}

	public function get_cari_sama($data_mahasiswa) 
	{
   		$this->db->select('*');
      	$this->db->where('nim', $data_mahasiswa['nim']);
      	$query = $this->db->get('tb_mahasiswa');
    	return $query->num_rows();
	}
}