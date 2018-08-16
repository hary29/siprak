<?php
class M_jadwal extends CI_Model {
	
	public function __construct()	{
		$this->load->database();
	}

	public function get_id ($id){
		$query = $this->db->get_where('tb_jadwal', array('id_jadwal' => $id));
		return $query->result_array();
    }
	
	// Menampilkan data eksperimen
	public function daftar_jadwal($num,$offset) {
		$this->db->select('*');
  		$this->db->from('tb_jadwal', 'tb_kelompok', 'tb_pelajaran', 'tb_user');
  		$this->db->join('tb_kelompok','tb_kelompok.id_kelompok = tb_jadwal.id_kelompok','left');
  		$this->db->join('tb_pelajaran','tb_pelajaran.id_pelajaran = tb_jadwal.id_pelajaran','left');
  		$this->db->join('tb_user','tb_user.id_user = tb_jadwal.id_user','left');
  		$this->db->order_by('id_jadwal','asc');
  		$query = $this->db->get('',$num,$offset);
        return $query->result_array();
	}

	// Model untuk menambah data kelompok
	public function tambah($data_jadwal) {
		$this->db->insert('tb_jadwal', $data_jadwal);
	}
	
	// Update data kelompok
	public function edit($data_jadwal) {
		$this->db->where('id_jadwal', $data_jadwal['id_jadwal']);
		return $this->db->update('tb_jadwal', $data_jadwal);
	}
	
	// Hapus data kelompok
	public function delete($id) {
		$this->db->where('id_jadwal',$id);
		return $this->db->delete('tb_jadwal');
	}

	public function get_kelompok(){
		$query = $this->db->get('tb_kelompok');
		return $query->result_array();
    }

    public function get_pelajaran(){
		$query = $this->db->get('tb_pelajaran');
		return $query->result_array();
    }

    public function get_user() {
   		$query = $this->db->get_where('tb_user', array('id_level' => '4'));
		return $query->result_array();
	}

	public function get_cari_sama($data_jadwal) 
	{
   		$this->db->select('*');
      	$this->db->where('tgl', $data_jadwal['tgl']);
      	$this->db->where('jam', $data_jadwal['jam']);
      	$this->db->where('id_kelompok', $data_jadwal['id_kelompok']);
      	$this->db->where('id_pelajaran', $data_jadwal['id_pelajaran']);
      	$query = $this->db->get('tb_jadwal');
    	return $query->num_rows();
	}

	public function daftar_jadwal2() {
		$this->db->select('*');
  		$this->db->from('tb_jadwal', 'tb_kelompok', 'tb_pelajaran', 'tb_user');
  		$this->db->join('tb_kelompok','tb_kelompok.id_kelompok = tb_jadwal.id_kelompok','left');
  		$this->db->join('tb_pelajaran','tb_pelajaran.id_pelajaran = tb_jadwal.id_pelajaran','left');
  		$this->db->join('tb_user','tb_user.id_user = tb_jadwal.id_user','left');
  		$this->db->order_by('id_jadwal','asc');
  		$query = $this->db->get('');
        return $query->result_array();
	}
}