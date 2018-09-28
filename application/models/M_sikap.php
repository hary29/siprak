<?php
class M_sikap extends CI_Model {
	// public $table = 'tb_';
 //    public $kd = 'kode_anjing';
 //    public $order = 'DESC';

	public function __construct()	{
		$this->load->database();
	}

	public function get_id ($id){
		$query = $this->db->get_where('tb_sikap', array('id_sikap' => $id));
		return $query->result_array();
    }
	
	// Menampilkan data kelompok
	public function daftar_nilai_sikap($num,$offset) {
		$this->db->select('*');
  		$this->db->from('tb_sikap','tb_user','tb_mahasiswa','tb_pelajaran');
  		$this->db->join('tb_user','tb_sikap.id_user = tb_user.id_user','left');
  		$this->db->join('tb_mahasiswa','tb_sikap.nim = tb_mahasiswa.nim','left');
  		$this->db->join('tb_pelajaran','tb_sikap.id_pelajaran = tb_pelajaran.id_pelajaran','left');
  		$this->db->order_by('id_sikap','asc');
  		$query = $this->db->get('',$num,$offset);
        return $query->result_array();
	}

	/*public function daftar_responsi1($num,$offset,$id_user) {
		$this->db->select('*');
  		$this->db->from('tb_sikap','tb_user','tb_mahasiswa','tb_kurikulum');
  		$this->db->join('tb_user','tb_sikap.id_user = tb_user.id_user','left');
  		$this->db->join('tb_mahasiswa','tb_sikap.nim = tb_mahasiswa.nim','left');
  		$this->db->join('tb_kurikulum','tb_sikap.id_kurikulum = tb_kurikulum.id_kurikulum','left');
  		$this->db->where('tb_user.id_user', $id_user);
  		$this->db->order_by('id_sikap','asc');
  		$query = $this->db->get('',$num,$offset);
        return $query->result_array();
	}*/

	// Model untuk menambah data kelompok
	public function tambah($data_sikap) {
		$this->db->insert('tb_sikap', $data_sikap);
		return $this->db->insert_id();
	}
	
	// Update data kelompok
	public function edit($data_sikap) {
		$this->db->where('id_sikap', $data_sikap['id_sikap']);
		return $this->db->update('tb_sikap', $data_sikap);
	}
	
	// Hapus data kelompok
	public function delete($id) {
		$this->db->where('id_sikap',$id);
		return $this->db->delete('tb_sikap');
	}

	public function get_pelajaran() {
   		$query = $this->db->get('tb_pelajaran');
		return $query->result_array();
	}

	public function get_cari_nilai($id) {
    $this->db->select('*');
    $this->db->where('id_sikap', $id);
    $query = $this->db->get('tb_sikap'); 
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

	public function cek_sikap($data_eksperimen,$data_mhs) 
	{
		//print_r($data_mhs);exit;
   		$this->db->select('*');
   		$this->db->where('nim', $data_mhs);
      	$this->db->where('id_pelajaran', $data_eksperimen);
      	$query = $this->db->get('tb_sikap');
    	return $query->num_rows();
	}
	public function cek_nilai_sikap($data_eksperimen,$data_mhs) 
	{
   		$this->db->select('*');
  		$this->db->from('tb_sikap');
      	$this->db->where('tb_sikap.id_pelajaran', $data_eksperimen);
      	$this->db->where('tb_sikap.nim', $data_mhs);
      	$query = $this->db->get('');
    	return $query->result();
	}
}