<?php
class M_bayes extends CI_Model {

	public function __construct()	{
		$this->load->database();

	}

  //Fungsi menampilkan semua data
  public function daftar_aturan() {
      $query = $this->db->get("tb_bayes");
    return $query->result_array();
  }
	
	// Fungsi tambah data
	public function tambah($data_aturan) {
		$this->db->insert('tb_bayes', $data_aturan);
	}
	
	// Fungsi edit data
	public function edit($data_aturan) {
		$this->db->where('id_bayes', $data_aturan['id_bayes']);
		$this->db->update('tb_bayes', $data_aturan);
	}
	
	// Fungsi hapus data
	public function delete($id) {
		$this->db->where('id_bayes',$id);
		return $this->db->delete('tb_bayes');
	}

	// Fungsi mengambil data id dari database
	public function get_id ($id){
		$query = $this->db->get_where('tb_bayes', array('id_bayes' => $id));
		return $query->result_array();
  }
	

}