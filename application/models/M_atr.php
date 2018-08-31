<?php
class M_atr extends CI_Model {
	public function __construct()	{
		$this->load->database();
	}

	public function cek_atr($sesi)
	{
		$this->db->select('*');
		$this->db->from('tb_atr_perm1, tb_atr_perm2');
      	$this->db->where('tb_atr_perm1.sesi', $sesi);
      	$this->db->where('tb_atr_perm2.sesi', $sesi);
      	$query = $this->db->get('');
    	return $query->num_rows();
	}

	// Model untuk menambah perm 1
	public function tambah($data_atr1) {
		$this->db->insert('tb_atr_perm1', $data_atr1);
	}
	public function tambah2($data_atr2) {
		$this->db->insert('tb_atr_perm2', $data_atr2);
	}
	
	// Update data kelompok
	public function edit($data_nilai_prak) {
		$this->db->where('id_hasil_akhir', $data_nilai_prak['id_hasil_akhir']);
		return $this->db->update('tb_hasil_akhir', $data_nilai_prak);
	}
	
	// Hapus data kelompok
	public function delete($id) {
		$this->db->where('id_hasil_akhir',$id);
		return $this->db->delete('tb_hasil_akhir');
	}

	public function cek_hasil_akhir($data_eksperimen,$data_mhs) 
	{
   		$this->db->select('*');
      	$this->db->where('id_pelajaran', $data_eksperimen);
      	$this->db->where('nim', $data_mhs);
      	$query = $this->db->get('tb_hasil_akhir');
    	return $query->result();
	}
}