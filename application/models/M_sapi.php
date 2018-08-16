<?php
class M_sapi extends CI_Model {
	public $table = 'tb_sapi';
    public $kd = 'kode_sapi';
    public $order = 'DESC';

	public function __construct()	{
		$this->load->database();
	}

	public function get_id ($id){
		$query = $this->db->get_where('tb_sapi', array('id_sapi' => $id));
		return $query->result_array();
    }
	
	// Menampilkan data kelas
	public function daftar_sapi($num,$offset) {
		//$query = $this->db->query('SELECT * FROM tb_user WHERE id_user');
		//return $query->result_array();

		$this->db->select('*');
    	$this->db->join('tb_user', 'tb_sapi.id_user = tb_user.id_user','Left');
    	$this->db->order_by('nama','asc');
    	//$this->db->where('');
    	$query = $this->db->get('tb_sapi',$num, $offset);
    	if($query->num_rows() > 0) {
        $results = $query->result_array();
        return $results;
    	}
    	//return $results;
	}
	public function daftar_sapi_user($id) {
		
		$this->db->select('*');
		$this->db->where('id_user',$id);
    	$this->db->order_by('id_sapi','asc');
    	
    	$query = $this->db->get('tb_sapi');
    	if($query->num_rows() > 0) {
        $results = $query->result_array();
    	}
    	return $results;
	}
	// Model untuk menambah data kelas
	public function tambah($data_sapi) {
		$data['id_sapi'] = $this->db->insert_id();
		$this->db->insert('tb_sapi', $data_sapi);
	}
	
	// Update data kelas
	public function edit($data_sapi) {
		$this->db->where('id_sapi', $data_sapi['id_sapi']);
		return $this->db->update('tb_sapi', $data_sapi);
	}
	
	// Hapus data siswa
	public function delete($id) {
		$this->db->where('id_sapi',$id);
		return $this->db->delete('tb_sapi');
	}

	public function get_sapi()
	{
    $query = $this->db->get('tb_sapi'); 
    	return $query-> result_array() ;
	}
	public function get_sapi_user($id)
	{
		$this->db->where('id_user', $id);
    $query = $this->db->get('tb_sapi'); 
    	return $query-> result() ;
	}
	public function get_cari_sapi($id) {
    $this->db->select('*');
    $this->db->where('id_sapi', $id);
    $query = $this->db->get('tb_sapi'); 
    	return $query->result_array();
	}
	public function get_last_id_sapi()
    {
        $this->db->select_max($this->kd);
        $this->db->order_by($this->kd, $this->order);
        return $this->db->get($this->table)->row();
    }
    public function jumlah_sapi()
	{
		$this->db->select('*');
		$query = $this->db->get('tb_sapi'); 
		return $query->num_rows();
	}
	public function jumlah_sapi_user($id)
	{
		$this->db->select('*');
		$this->db->where('id_user', $id);
		$query = $this->db->get('tb_sapi'); 
		return $query->num_rows();
	}
}