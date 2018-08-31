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

	public function cek_hasil_akhir($data_eksperimen,$data_mhs) 
	{
   		$this->db->select('*');
      	$this->db->where('id_pelajaran', $data_eksperimen);
      	$this->db->where('nim', $data_mhs);
      	$query = $this->db->get('tb_hasil_akhir');
    	return $query->result();
	}

	public function cek_aturan_perm1($nilai_akhir,$sesi) 
	{
   		$this->db->select('*');
   		$this->db->where('sesi', $sesi);
      	$this->db->where('batas_bawah <=', $nilai_akhir);
		$this->db->Where('batas_atas >=', $nilai_akhir);
      	$query = $this->db->get('tb_atr_perm1');
    	return $query->result();
	}

	public function cek_aturan_perm2($responsi,$sesi) 
	{
   		$this->db->select('*');
   		$this->db->where('sesi', $sesi);
      	$this->db->where('batas_bawah <=', $responsi);
		$this->db->where('batas_atas >=', $responsi);
      	$query = $this->db->get('tb_atr_perm2');
    	return $query->result();
	}

	public function cek_aturan_final($nilai,$responsi) 
	{
   		$this->db->select('*');
      	$this->db->where('permis1', $nilai);
		$this->db->where('permis2', $responsi);
      	$query = $this->db->get('tb_aturan');
    	return $query->result();
	}
	
}