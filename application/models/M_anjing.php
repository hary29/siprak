<?php
class M_anjing extends CI_Model {
	public $table = 'tb_anjing';
    public $kd = 'kode_anjing';
    public $order = 'DESC';

	public function __construct()	{
		$this->load->database();
	}

	public function get_id ($id){
		$query = $this->db->get_where('tb_anjing', array('id_anjing' => $id));
		return $query->result_array();
    }
	
	// Menampilkan data kelas
	public function daftar_anjing($num,$offset) {
		//$query = $this->db->query('SELECT * FROM tb_user WHERE id_user');
		//return $query->result_array();

		$this->db->select('*');
    	$this->db->join('tb_user', 'tb_anjing.id_user = tb_user.id_user','Left');
    	$this->db->order_by('nama','asc');
    	//$this->db->where('');
    	$query = $this->db->get('tb_anjing',$num, $offset);
    	if($query->num_rows() > 0) {
        $results = $query->result_array();
    	}
    	return $results;
	}
	public function daftar_anjing_user($id) {
		
		$this->db->select('*');
		$this->db->where('id_user',$id);
    	$this->db->order_by('id_anjing','asc');
    	
    	$query = $this->db->get('tb_anjing');
    	if($query->num_rows() > 0) {
        $results = $query->result_array();
    	}
    	return $results;
	}
	// Model untuk menambah data kelas
	public function tambah($data_anjing) {
		$data['id_anjing'] = $this->db->insert_id();
		$this->db->insert('tb_anjing', $data_anjing);
	}
	
	// Update data kelas
	public function edit($data_anjing) {
		$this->db->where('id_anjing', $data_anjing['id_anjing']);
		return $this->db->update('tb_anjing', $data_anjing);
	}
	
	// Hapus data siswa
	public function delete($id) {
		$this->db->where('id_anjing',$id);
		return $this->db->delete('tb_anjing');
	}

	public function get_anjing()
	{
    $query = $this->db->get('tb_anjing'); 
    	return $query-> result_array() ;
	}
	public function get_anjing_user($id)
	{
		$this->db->where('id_user', $id);
    $query = $this->db->get('tb_anjing'); 
    	return $query-> result() ;
	}
	public function get_cari_anjing($id) {
    $this->db->select('*');
    $this->db->where('id_anjing', $id);
    $query = $this->db->get('tb_anjing'); 
    	return $query->result_array();
	}
	public function get_last_id_anjing()
    {
        $this->db->select_max($this->kd);
        $this->db->order_by($this->kd, $this->order);
        return $this->db->get($this->table)->row();
    }
    public function jumlah_anjing()
	{
		$this->db->select('*');
		$query = $this->db->get('tb_anjing'); 
		return $query->num_rows();
	}
	public function jumlah_anjing_user($id)
	{
		$this->db->select('*');
		$this->db->where('id_user', $id);
		$query = $this->db->get('tb_anjing'); 
		return $query->num_rows();
	}
}