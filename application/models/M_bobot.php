<?php
class M_bobot extends CI_Model {

	public function __construct()	{
		$this->load->database();

	}
	
  // Fungsi pagination
	public function ambildata($perPage, $uri, $data_cari) {
		$this->db->select('*');
    	$this->db->from('tb_bobot');
		if (!empty($data_cari)) {
			$this->db->like('nama_penyakit', $data_cari);
			$this->db->or_like('gejala', $data_cari);
		}
		$this->db->order_by('id_bobot','asc');
		$getData = $this->db->get('', $perPage, $uri);

		if ($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}

	// Fungsi menampilkan semua data
	public function daftar_bobot($num,$offset) {
    	$this->db->select('tb_bobot.id_bobot,tb_penyakit.nama_penyakit,tb_gejala.gejala,tb_bobot.bobot');
    	$this->db->from('tb_bobot','tb_penyakit','tb_gejala');
      	$this->db->join('tb_penyakit', 'tb_bobot.id_penyakit = tb_penyakit.id_penyakit','Left');
      	$this->db->join('tb_gejala', 'tb_bobot.id_gejala = tb_gejala.id_gejala','Left');
    	$this->db->order_by('id_bobot','asc');
      	$query = $this->db->get('',$num,$offset);
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
	public function tambah($data_bobot) {
		$this->db->insert('tb_bobot', $data_bobot);
	}
	
	// Fungsi edit data
	public function edit($data_bobot) {
		$this->db->where('id_bobot', $data_bobot['id_bobot']);
		$this->db->update('tb_bobot', $data_bobot);
	}
	
	// Fungsi hapus data
	public function delete($id) {
		$this->db->where('id_bobot',$id);
		return $this->db->delete('tb_bobot');
	}

	// Fungsi mengambil data id dari database
	public function get_id ($id){
		$query = $this->db->get_where('tb_bobot', array('id_bobot' => $id));
		return $query->result_array();
    }

    public function get_pny() {
  	$query = $this->db->get('tb_penyakit');
  	return $query->result();
 	}

 	public function get_gj() {
  	$query = $this->db->get('tb_gejala');
  	return $query->result();
 	}
	 public function hitung_bobot_perpenyakit()
  {
    $this->db->select('*, COUNT(tb_bobot.id_penyakit) as total');
    //$this->db->from('tb_diagnosa','tb_penyakit');
    $this->db->join('tb_penyakit', 'tb_bobot.id_penyakit = tb_penyakit.id_penyakit','Left');
    $this->db->group_by('tb_bobot.id_penyakit'); 
    $this->db->order_by('total', 'desc');
    $query=$this->db->get('tb_bobot'); 
    return $query->result_array();
  }

  public function get_cari_sama($data_bobot) {
   		$this->db->select('*');
    	$this->db->from('tb_bobot');
      	$this->db->where('id_penyakit', $data_bobot['id_penyakit']);
      	$this->db->where('id_gejala', $data_bobot['id_gejala']);
      $query = $this->db->get();
    	return $query->num_rows();
	}

}