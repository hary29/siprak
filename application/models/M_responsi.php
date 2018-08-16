<?php
class M_responsi extends CI_Model {
	// public $table = 'tb_';
 //    public $kd = 'kode_anjing';
 //    public $order = 'DESC';

	public function __construct()	{
		$this->load->database();
	}

	public function get_id ($id){
		$query = $this->db->get_where('tb_responsi', array('id_nilai_prak' => $id));
		return $query->result_array();
    }
	
	// Menampilkan data kelompok
	public function daftar_responsi($num,$offset) {
		$this->db->select('*');
  		$this->db->from('tb_responsi','tb_user','tb_mahasiswa','tb_kurikulum');
  		$this->db->join('tb_user','tb_responsi.id_user = tb_user.id_user','left');
  		$this->db->join('tb_mahasiswa','tb_responsi.nim = tb_mahasiswa.nim','left');
  		$this->db->join('tb_kurikulum','tb_responsi.id_kurikulum = tb_kurikulum.id_kurikulum','left');
  		$this->db->order_by('id_responsi','asc');
  		$query = $this->db->get('',$num,$offset);
        return $query->result_array();
	}

	// Model untuk menambah data kelompok
	public function tambah($data_responsi) {
		$this->db->insert('tb_responsi', $data_responsi);
	}
	
	// Update data kelompok
	public function edit($data_responsi) {
		$this->db->where('id_responsi', $data_responsi['id_responsi']);
		return $this->db->update('tb_responsi', $data_responsi);
	}
	
	// Hapus data kelompok
	public function delete($id) {
		$this->db->where('id_responsi',$id);
		return $this->db->delete('tb_responsi');
	}

	public function get_cari_nilai($id) {
    $this->db->select('*');
    $this->db->where('id_responsi', $id);
    $query = $this->db->get('tb_responsi'); 
    	return $query->result_array();
	}

	public function get_user() {
   		$query = $this->db->get_where('tb_user', array('id_level' => '2'));
		return $query->result_array();
	}

	public function get_mahasiswa() {
   		$query = $this->db->get('tb_mahasiswa');
		return $query->result_array();
	}

	public function get_perm2() {
   		$query = $this->db->get('tb_atr_perm2');
		return $query->result_array();
	}

	public function get_kurikulum() {
   		$query = $this->db->get('tb_kurikulum');
		return $query->result_array();
	}

	public function get_cari_sama($data_responsi) 
	{
   		$this->db->select('*');
   		$this->db->where('nim', $data_responsi['nim']);
      	$this->db->where('id_kurikulum', $data_responsi['id_kurikulum']);
      	$query = $this->db->get('tb_responsi');
    	return $query->num_rows();
	}
}