<?php
class M_gejala extends CI_Model {

	public function __construct()	{
		$this->load->database();

	}

	//Fungsi membuat id otomatis
	function buat_kode()   {    
  		$this->db->select('RIGHT(tb_gejala.kode_gejala,3) as kode', FALSE);
  		$this->db->order_by('id_gejala','DESC');    
  		$this->db->limit(1);     
  		$query = $this->db->get('tb_gejala');      //cek dulu apakah ada sudah ada kode di tabel.    
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
  		$kodejadi = "G".$kodemax;     
  		return $kodejadi;  
 	}
	
  // Fungsi pagination
	public function ambildata($perPage, $uri, $data_cari) {
		$this->db->select('*');
    	$this->db->from('tb_gejala');
		if (!empty($data_cari)) {
			$this->db->like('id_gejala', $data_cari);
			$this->db->or_like('nm_gejala', $data_cari);
		}
		$this->db->order_by('id_gejala','asc');
		$getData = $this->db->get('', $perPage, $uri);

		if ($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}

	// Fungsi menampilkan semua data
	public function daftar_gejala($num,$offset) {
    	$query = $this->db->get('tb_gejala',$num,$offset);
      if($query->num_rows() > 0) {
        $results = $query->result_array();
      }
      return $results;
	}

  // Fungsi pencarian
 	public function get_cari($data_cari) {
   		$this->db->select('*');
      $this->db->from('tb_gejala');
      $this->db->like('nm_gejala', $data_cari);
      $this->db->or_like('id_gejala', $data_cari);
      $query = $this->db->get();
      return $query->result_array();
  }
	
	// Fungsi tambah data
	public function tambah($data_gejala) {
		$this->db->insert('tb_gejala', $data_gejala);
	}
	
	// Fungsi edit data
	public function edit($data_gejala) {
		$this->db->where('id_gejala', $data_gejala['id_gejala']);
		$this->db->update('tb_gejala', $data_gejala);
	}
	
	// Fungsi hapus data
	public function delete($id) {
		$this->db->where('id_gejala',$id);
		return $this->db->delete('tb_gejala');
	}

	// Fungsi mengambil data id dari database
	public function get_id ($id){
		$query = $this->db->get_where('tb_gejala', array('id_gejala' => $id));
		return $query->result_array();
  }
  public function jumlah_gejala()
	{
		$this->db->select('*');
		$query = $this->db->get('tb_gejala'); 
		return $query->num_rows();
	}
	

}