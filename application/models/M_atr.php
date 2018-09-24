<?php
class M_atr extends CI_Model {
	public function __construct()	{
		$this->load->database();
	}

	public function cek_atr($sesi)
	{
		$this->db->select('*');
		$this->db->from('tb_atr_perm1');
      	$this->db->where('tb_atr_perm1.sesi', $sesi);
      	$query = $this->db->get('');
    	return $query->num_rows();
	}

	public function cek_aturan2()
	{
		$this->db->select('*');
		$this->db->from('tb_atr_perm2');
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

	public function cek_aturan_perm2($responsi) 
	{
   		$this->db->select('*');
      	$this->db->where('batas_bawah <=', $responsi);
		$this->db->where('batas_atas >=', $responsi);
      	$query = $this->db->get('tb_atr_perm2');
    	return $query->result();
	}

	public function cek_aturan_final($class_prem1,$class_prem2) 
	{
   		$this->db->select('*');
      	$this->db->where('permis1', $class_prem1);
		$this->db->where('permis2', $class_prem2);
      	$query = $this->db->get('tb_aturan');
    	return $query->result();
	}

	public function daftar_aturan_praktikum($num,$offset) {
		$this->db->select('*');
  		$this->db->order_by('id_atr_perm1','asc');
  		$query = $this->db->get('tb_atr_perm1',$num,$offset);
        return $query->result_array();
	}

	public function daftar_aturan_responsi($num,$offset) {
		$this->db->select('*');
  		$this->db->order_by('id_atr_perm2','asc');
  		$query = $this->db->get('tb_atr_perm2',$num,$offset);
        return $query->result_array();
	}

	public function daftar_aturan_akhir($num,$offset) {
		$this->db->select('*');
  		$this->db->order_by('id_aturan','asc');
  		$query = $this->db->get('tb_aturan',$num,$offset);
        return $query->result_array();
	}

	
}