<?php
class M_penyakit extends CI_Model {

	public function __construct()	{
		$this->load->database();

	}

	//Fungsi membuat id otomatis
	function buat_kode()   {    
  		$this->db->select('RIGHT(tb_penyakit.kode_penyakit,3) as kode', FALSE);
  		$this->db->order_by('id_penyakit','DESC');    
  		$this->db->limit(1);     
  		$query = $this->db->get('tb_penyakit');      //cek dulu apakah ada sudah ada kode di tabel.    
  		if($query->num_rows() <> 0){       
   		//jika kode ternyata sudah ada.      
   			$data = $query->row();      
   			$kode = intval($data->kode) + 1;     
  		}
  		else{       
   		//jika kode belum ada      
   			$kode = 1;     
  		}
  		$kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);    
  		$kodejadi = "P".$kodemax;     
  		return $kodejadi;  
 	}
	
  // Fungsi pagination
	public function ambildata($perPage, $uri, $data_cari) {
		$this->db->select('*');
    	$this->db->from('tb_penyakit');
		if (!empty($data_cari)) {
			$this->db->like('id_penyakit', $data_cari);
			$this->db->or_like('nm_penyakit', $data_cari);
		}
		$this->db->order_by('id_penyakit','asc');
		$getData = $this->db->get('', $perPage, $uri);

		if ($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}

	// Fungsi menampilkan semua data
	public function daftar_penyakit($num,$offset) {
    	$query = $this->db->get('tb_penyakit',$num,$offset);
    	if($query->num_rows() > 0) {
        $results = $query->result_array();
    	}
    	return $results;
	}
	public function daftar_penyakit1() {
    	$query = $this->db->get('tb_penyakit');
    	if($query->num_rows() > 0) {
        $results = $query->result_array();
    	}
    	return $results;
	}

  // Fungsi pencarian
 	public function get_cari($data_cari) {
   		$this->db->select('*');
    	$this->db->from('tb_penyakit');
      $this->db->like('nm_penyakit', $data_cari);
      $this->db->or_like('id_penyakit', $data_cari);
      $query = $this->db->get();
    	return $query->result_array();
	}
	
	// Fungsi tambah data
	public function tambah($data_penyakit) {
		$this->db->insert('tb_penyakit', $data_penyakit);
	}
	
	// Fungsi edit data
	public function edit($data_penyakit) {
		$this->db->where('id_penyakit', $data_penyakit['id_penyakit']);
		$this->db->update('tb_penyakit', $data_penyakit);
	}
	
	// Fungsi hapus data
	public function delete($id) {
		$this->db->where('id_penyakit',$id);
		return $this->db->delete('tb_penyakit');
	}

	// Fungsi mengambil data id dari database
	public function get_id ($id){
		$query = $this->db->get_where('tb_penyakit', array('id_penyakit' => $id));
		return $query->result_array();
    }
	public function jumlah_penyakit()
	{
		$this->db->select('*');
		$query = $this->db->get('tb_penyakit'); 
		return $query->num_rows();
	}

}