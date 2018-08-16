<?php
class M_user extends CI_Model {
	public $table = 'tb_user';
	public $table2 = 'tb_anjing';
    public $kd = 'kode_pendaftaran';
    public $a = 'kode_anjing';
    public $order = 'DESC';

	public function __construct()	{
		$this->load->database();
	}

	public function get_id ($id){
		$query = $this->db->get_where('tb_user', array('id_user' => $id));
		return $query->result_array();
    }
	
	// Menampilkan data kelas
	public function daftar_user($num,$offset) {
		//$query = $this->db->query('SELECT * FROM tb_user WHERE id_user');
		//return $query->result_array();

		$this->db->select('*');
    	$this->db->join('tb_level', 'tb_user.id_level = tb_level.id_level','Left');
    	$this->db->order_by('id_user','asc');
    	//$this->db->where('');
    	$query = $this->db->get('tb_user',$num, $offset);
    	if($query->num_rows() > 0) {
        $results = $query->result_array();
    	}
    	return $results;
	}
	
	// Model untuk menambah data kelas
	public function tambah($data_user) {
		$data['id_user'] = $this->db->insert_id();
		$this->db->insert('tb_user', $data_user);
	}
	
	// Update data kelas
	public function edit($data_user) {
		$this->db->where('id_user', $data_user['id_user']);
		return $this->db->update('tb_user', $data_user);
	}
	
	// Hapus data siswa
	public function delete($id) {
		$this->db->where('id_user',$id);
		return $this->db->delete('tb_user');
	}

	public function get_level() {
    $this->db->from('tb_level');
    $this->db->order_by("id_level","desc");
	$query = $this->db->get();
	return $query->result();
	}
	function get_last_id()
    {
        $this->db->select_max($this->kd);
        $this->db->order_by($this->kd, $this->order);
        return $this->db->get($this->table)->row();
    }
    public function get_last_id_anjing()
    {
        $this->db->select_max($this->a);
        $this->db->order_by($this->a, $this->order);
        return $this->db->get($this->table2)->row();
    }
    public function get_cari($data_cari) {
    $this->db->select('*');
    $this->db->join('tb_level', 'tb_user.id_level = tb_level.id_level','Left');
    $this->db->like('kode_pendaftaran', $data_cari);
    $this->db->or_like('nama', $data_cari);
    $this->db->or_like('alamat', $data_cari);
    

    
    //$this->db->get();
    $query = $this->db->get('tb_user'); //simpan database yang udah di get alias ambil ke query
     //    if ($query->num_rows() > 0) { //membuat data masuk ke $data kemudian masuk lagi ke array $hasiltransaksi
     //    $results = $query->result_array();
    	// }
    	return $query->result_array();
	}
	public function get_date($rm) {
    $this->db->select('*');
    $this->db->where('kode_pendaftaran', $rm);
    //$this->db->get();
    $query = $this->db->get('tb_user'); //simpan database yang udah di get alias ambil ke query
    	return $query->result_array();
	}

	public function get_date1($user) {
    $this->db->select('*');
    $this->db->where('id_user', $user);
    //$this->db->get();
    $query = $this->db->get('tb_user'); //simpan database yang udah di get alias ambil ke query
    	return $query->result_array();
	}

	public function get_cari_data($data_cari) {
    $this->db->select('*');
    //$this->db->join('tb_level', 'tb_user.id_level = tb_level.id_level','Left');
    $this->db->where('nama', $data_cari['nama']);
    $this->db->where('tgl_lahir', $data_cari['tgl_lahir']);
    $this->db->where('nama_ibu', $data_cari['nama_ibu'] );
    

    
    //$this->db->get();
    $query = $this->db->get('tb_user'); //simpan database yang udah di get alias ambil ke query
     //    if ($query->num_rows() > 0) { //membuat data masuk ke $data kemudian masuk lagi ke array $hasiltransaksi
     //    $results = $query->result_array();
    	// }
    	return $query->num_rows();
	}
	public function get_cari_username($data_cari) {
    $this->db->select('*');
    $this->db->where('username', $data_cari);
    $query = $this->db->get('tb_user'); 
    	return $query->result_array();
	}
	public function get_cari_username1($data_cari) {
    $this->db->select('*');
    $this->db->where('username', $data_cari['username']);
    $query = $this->db->get('tb_user'); 
    	return $query->num_rows();
	}
	public function get_user()
	{
    $query = $this->db->get('tb_user'); 
    	return $query->result();
	}
    
	public function jumlah_user()
	{
		$this->db->select('*');
		$query = $this->db->get('tb_user'); 
		return $query->num_rows();
	}
     public function hitung_perlevel()
  {
    $this->db->select('*, COUNT(tb_user.id_level) as total');
    //$this->db->from('tb_diagnosa','tb_penyakit');
    $this->db->join('tb_level', 'tb_user.id_level = tb_level.id_level','Left');
    $this->db->group_by('tb_user.id_level'); 
    $this->db->order_by('total', 'desc');
    $query=$this->db->get('tb_user'); 
    return $query->result_array();
  }
}