<?php
class M_nilai_prak extends CI_Model {
	// public $table = 'tb_';
 //    public $kd = 'kode_anjing';
 //    public $order = 'DESC';

	public function __construct()	{
		$this->load->database();
	}

	public function get_id ($id){
		$query = $this->db->get_where('tb_nilai_prak', array('id_nilai_prak' => $id));
		return $query->result_array();
    }
	
	// Menampilkan data kelompok
	public function daftar_nilai($num,$offset) {
		$this->db->select('*');
  		$this->db->from('tb_nilai_prak','tb_user','tb_mahasiswa','tb_pelajaran');
  		$this->db->join('tb_user','tb_nilai_prak.id_user = tb_user.id_user','left');
  		$this->db->join('tb_mahasiswa','tb_nilai_prak.nim = tb_mahasiswa.nim','left');
  		$this->db->join('tb_pelajaran','tb_nilai_prak.id_pelajaran = tb_pelajaran.id_pelajaran','left');
  		$this->db->order_by('id_nilai_prak','asc');
  		$query = $this->db->get('',$num,$offset);
        return $query->result_array();
	}

	// Model untuk menambah data kelompok
	public function tambah($data_nilai_prak) {
		$this->db->insert('tb_nilai_prak', $data_nilai_prak);
	}

	public function tambah_akhir($data_nilai_prak_akhir) {
		$this->db->insert('tb_prak_akhir', $data_nilai_prak_akhir);
		return $this->db->insert_id();
	}
	
	// Update data kelompok
	public function edit($data_nilai_prak) {
		$this->db->where('id_nilai_prak', $data_nilai_prak['id_nilai_prak']);
		return $this->db->update('tb_nilai_prak', $data_nilai_prak);
	}

	public function edit_akhir($data_nilai_prak) {
		$this->db->where('id_prak_akhir', $data_nilai_prak['id_prak_akhir']);
		return $this->db->update('tb_prak_akhir', $data_nilai_prak);
	}
	
	// Hapus data kelompok
	public function delete($id) {
		$this->db->where('id_nilai_prak',$id);
		return $this->db->delete('tb_nilai_prak');
	}

	public function get_cari_nilai($id) {
    $this->db->select('*');
    $this->db->where('id_nilai_prak', $id);
    $query = $this->db->get('tb_nilai_prak'); 
    	return $query->result_array();
	}

	public function get_user() {
   		$query = $this->db->get_where('tb_user', array('id_level' => '4'));
		return $query->result_array();
	}

	public function get_mahasiswa() {
   		$query = $this->db->get('tb_mahasiswa');
		return $query->result_array();
	}

	public function get_pelajaran() {
   		$query = $this->db->get('tb_pelajaran');
		return $query->result_array();
	}

	public function get_cari_sama($data_nilai_prak) 
	{
   		$this->db->select('*');
      	$this->db->where('pertemuan', $data_nilai_prak['pertemuan']);
      	$this->db->where('id_pelajaran', $data_nilai_prak['id_pelajaran']);
      	$this->db->where('nim', $data_nilai_prak['nim']);
      	$query = $this->db->get('tb_nilai_prak');
    	return $query->num_rows();
	}
	public function get_nilai($nim,$idp){
		$this->db->select('*');
		$this->db->from('tb_nilai_prak','tb_pelajaran','tb_mahasiswa');
  		$this->db->join('tb_mahasiswa','tb_nilai_prak.nim = tb_mahasiswa.nim','left');
  		$this->db->join('tb_pelajaran','tb_nilai_prak.id_pelajaran = tb_pelajaran.id_pelajaran','left');
      	$this->db->where('tb_nilai_prak.nim', $nim);
      	$this->db->where('tb_nilai_prak.id_pelajaran', $idp);
      	$query = $this->db->get('');
    	return $query->result_array();
	}
	public function get_sesi($data_eksperimen,$data_mhs) 
	{
   		$this->db->select('*');
      	$this->db->where('id_pelajaran', $data_eksperimen);
      	$this->db->where('nim', $data_mhs);
      	$query = $this->db->get('tb_nilai_prak');
    	return $query->num_rows();
	}

	public function get_nilai_akhir($data_eksperimen,$data_mhs) 
	{
   		$this->db->select('SUM(pretest) as pretest,SUM(laporan) as laporan');
      	$this->db->where('id_pelajaran', $data_eksperimen);
      	$this->db->where('nim', $data_mhs);
      	$query = $this->db->get('tb_nilai_prak');
    	return $query->result();
	}

	public function cek_nilai_akhir($data_eksperimen,$data_mhs) 
	{
   		$this->db->select('*');
      	$this->db->where('id_pelajaran', $data_eksperimen);
      	$this->db->where('nim', $data_mhs);
      	$query = $this->db->get('tb_prak_akhir');
    	return $query->result();
	}
	public function cek_nilai_prak($data_eksperimen,$data_mhs) 
	{
   		$this->db->select('*');
  		$this->db->from('tb_prak_akhir','tb_atr_perm1');
  		$this->db->join('tb_atr_perm1','tb_prak_akhir.id_atr_perm1 = tb_atr_perm1.id_atr_perm1','left');
      	$this->db->where('tb_prak_akhir.id_pelajaran', $data_eksperimen);
      	$this->db->where('tb_prak_akhir.nim', $data_mhs);
      	$query = $this->db->get('');
    	return $query->result();
	}
}