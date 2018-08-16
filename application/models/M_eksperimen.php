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
}