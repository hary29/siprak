<?php
class M_eksperimen extends CI_Model {
	
	public function __construct()	{
		$this->load->database();
	}

	public function get_id ($id){
		$query = $this->db->get_where('tb_nilai_prak', array('id_nilai_prak' => $id));
		return $query->result_array();
    }
	
	// Menampilkan data eksperimen
	public function daftar_eksperimen($num,$offset) {
		$this->db->select('*');
  		$this->db->from('tb_pelajaran','tb_kurikulum');
  		$this->db->join('tb_kurikulum','tb_pelajaran.id_kurikulum = tb_kurikulum.id_kurikulum','left');
  		$this->db->order_by('id_pelajaran','asc');
  		$query = $this->db->get('',$num,$offset);
        return $query->result_array();
	}

	// Model untuk menambah data kelompok
	public function tambah($data_eksperimen) {
		$this->db->insert('tb_pelajaran', $data_eksperimen);
		return $this->db->insert_id();
	}
	
	// Update data kelompok
	public function edit($data_eksperimen) {
		$this->db->where('id_pelajaran', $data_eksperimen['id_pelajaran']);
		return $this->db->update('tb_pelajaran', $data_eksperimen);
	}
	
	// Hapus data kelompok
	public function delete($id) {
		$this->db->where('id_pelajaran',$id);
		return $this->db->delete('tb_pelajaran');
	}

	public function get_cari_eksperimen($id) {
    $this->db->select('*');
    $this->db->where('id_pelajaran', $id);
    $query = $this->db->get('tb_pelajaran'); 
    	return $query->result_array();
	}

	public function get_kurikulum() {
   	$query = $this->db->get_where('tb_kurikulum', array('flag' => '1'));
		return $query->result_array();
	}

	public function jumlah_eksperimen()
	{
		$this->db->select('*');
		$query = $this->db->get('tb_pelajaran'); 
		return $query->num_rows();
	}

	public function get_cari_sama($data_eksperimen) 
	{
   		$this->db->select('*');
      	$this->db->where('nama_pelajaran', $data_eksperimen['nama_pelajaran']);
      	$query = $this->db->get('tb_pelajaran');
    	return $query->num_rows();
	}
	public function get_cari_sesi($data_eksperimen) 
	{
   		$this->db->select('*');
      	$this->db->where('id_pelajaran', $data_eksperimen);
      	$query = $this->db->get('tb_pelajaran');
    	return $query->row();
	}
	public function cari_eksperimen($id)
	{
		$this->db->select('*');
		$this->db->from('tb_pelajaran','tb_mahasiswa','tb_kelompok');
  		$this->db->join('tb_mahasiswa','tb_pelajaran.id_pelajaran = tb_mahasiswa.id_pelajaran','left');
  		$this->db->join('tb_kelompok','tb_mahasiswa.id_kelompok = tb_kelompok.id_kelompok','left');
      	$this->db->where('tb_pelajaran.id_pelajaran', $id);
      	$query = $this->db->get('');
    	return $query->result_array();
	}

	public function cari_eksperimen1($id,$id_user)
	{
		$this->db->select('*');
		$this->db->from('tb_pelajaran','tb_mahasiswa','tb_kelompok','tb_sub_pelajaran');
  		$this->db->join('tb_mahasiswa','tb_pelajaran.id_pelajaran = tb_mahasiswa.id_pelajaran','left');
  		$this->db->join('tb_kelompok','tb_mahasiswa.id_kelompok = tb_kelompok.id_kelompok','left');
  		$this->db->join('tb_sub_pelajaran','tb_pelajaran.id_pelajaran = tb_sub_pelajaran.id_pelajaran','left');
      	$this->db->where('tb_pelajaran.id_pelajaran', $id);
      	$this->db->where('tb_sub_pelajaran.id_user', $id_user);
      	$query = $this->db->get('');
    	return $query->result_array();
	}

	public function tambah_sub($data)
	{
		$this->db->insert_batch('tb_sub_pelajaran', $data);
	}

	public function get_sub($id) {
   		$query = $this->db->get_where('tb_sub_pelajaran', array('id_pelajaran' => $id));
		return $query->result_array();
	}
	
	public function get_sub_list() {
   		$query = $this->db->get('tb_sub_pelajaran');
		return $query->result_array();
	}

	public function daftar_sub($num,$offset) {
		$this->db->select('*');
  		$this->db->from('tb_sub_pelajaran','tb_pelajaran');
  		$this->db->join('tb_pelajaran','tb_sub_pelajaran.id_pelajaran = tb_pelajaran.id_pelajaran','left');
  		$this->db->order_by('tb_pelajaran.id_pelajaran','asc');
  		$query = $this->db->get('',$num,$offset);
        return $query->result_array();
	}

	public function tambah_sub2($data_sub) {
		$this->db->insert('tb_sub_pelajaran', $data_sub);
		return $this->db->insert_id();
	}
	
	// Update data kelompok
	public function edit_sub($data_sub) {
		$this->db->where('id_sub', $data_sub['id_sub']);
		return $this->db->update('tb_sub_pelajaran', $data_sub);
	}
	
	// Hapus data kelompok
	public function delete_sub($id) {
		$this->db->where('id_sub',$id);
		return $this->db->delete('tb_sub_pelajaran');
	}

	public function get_id_sub ($id){
		$this->db->select('*');
  		$this->db->from('tb_sub_pelajaran','tb_pelajaran');
  		$this->db->join('tb_pelajaran','tb_sub_pelajaran.id_pelajaran = tb_pelajaran.id_pelajaran','left');
		$this->db->where('tb_sub_pelajaran.id_sub', $id);
		$query = $this->db->get('');
		return $query->result_array();
    }

    public function get_cari_sama_sub($data_sub) 
	{
   		$this->db->select('*');
      	$this->db->where('id_pelajaran', $data_sub['id_pelajaran']);
      	$this->db->where('nama_sub_pelajaran', $data_sub['nama_sub_pelajaran']);
      	$query = $this->db->get('tb_sub_pelajaran');
    	return $query->num_rows();
	}

}