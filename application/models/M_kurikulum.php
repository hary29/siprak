<?php
class M_kurikulum extends CI_Model {
	
	public function __construct()	{
		$this->load->database();
	}

	public function get_id ($id){
		$query = $this->db->get_where('tb_kurikulum', array('id_kurikulum' => $id));
		return $query->result_array();
    }
	
	// Menampilkan data eksperimen
	public function daftar_kurikulum($num,$offset) {
		$this->db->select('*');
  		$this->db->from('tb_kurikulum');
  		$this->db->order_by('id_kurikulum','asc');
  		$query = $this->db->get('',$num,$offset);
        return $query->result_array();
	}

	// Model untuk menambah data kelompok
	public function tambah($data_kurikulum) {
		$this->db->insert('tb_kurikulum', $data_kurikulum);
	}
	
	// Update data kelompok
	public function edit($data_kurikulum) {
		$this->db->where('id_kurikulum', $data_kurikulum['id_kurikulum']);
		return $this->db->update('tb_kurikulum', $data_kurikulum);
	}
	
	// Hapus data kelompok
	public function delete($id) {
		$this->db->where('id_kurikulum',$id);
		return $this->db->delete('tb_kurikulum');
	}

	public function get_cari_sama($data_kurikulum) 
	{
   		$this->db->select('*');
      	$this->db->where('semester', $data_kurikulum['semester']);
      	$this->db->where('tahun', $data_kurikulum['tahun']);
      	$query = $this->db->get('tb_kurikulum');
    	return $query->num_rows();
	}
}