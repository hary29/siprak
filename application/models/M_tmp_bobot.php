<?php
class M_tmp_bobot extends CI_Model {

	public function __construct()	{
		$this->load->database();

	}
	
  // Fungsi pagination
	public function ambildata($perPage, $uri, $data_cari) {
		$this->db->select('*');
    	$this->db->from('tmp_bobot');
		if (!empty($data_cari)) {
			$this->db->like('nama_penyakit', $data_cari);
			$this->db->or_like('gejala', $data_cari);
		}
		$this->db->order_by('id_tmp','asc');
		$getData = $this->db->get('', $perPage, $uri);

		if ($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}

	// Fungsi menampilkan semua data
	public function daftar_bobot($num,$offset) {
    	$this->db->select('tmp_bobot.id_tmp,tb_penyakit.nama_penyakit,tb_gejala.gejala,tmp_bobot.bobot');
    	$this->db->from('tmp_bobot','tb_penyakit','tb_gejala');
      	$this->db->join('tb_penyakit', 'tmp_bobot.id_penyakit = tb_penyakit.id_penyakit','Left');
      	$this->db->join('tb_gejala', 'tmp_bobot.id_gejala = tb_gejala.id_gejala','Left');
    	$this->db->order_by('id_tmp','asc');
      	$query = $this->db->get('',$num,$offset);
    	
        return $query->result_array();
    	
	}

	public function daftar_bobot_tmp() {
    	$this->db->select('*');
    	$this->db->from('tmp_bobot','tb_penyakit','tb_gejala');
      	$this->db->join('tb_penyakit', 'tmp_bobot.id_penyakit = tb_penyakit.id_penyakit','Left');
      	$this->db->join('tb_gejala', 'tmp_bobot.id_gejala = tb_gejala.id_gejala','Left');
    	$this->db->order_by('id_tmp','asc');
      	$query = $this->db->get('');
    	
        return $query->result_array();
    	
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

	public function get_cari_sama($data_bobot) {
   		$this->db->select('*');
    	$this->db->from('tmp_bobot');
      	$this->db->where('id_penyakit', $data_bobot['id_penyakit']);
      	$this->db->where('id_gejala', $data_bobot['id_gejala']);
      $query = $this->db->get();
    	return $query->num_rows();
	}
	
	// Fungsi tambah data
	public function tambah($data_bobot) {
		$this->db->insert('tmp_bobot', $data_bobot);
	}
	
	// Fungsi hapus data
	public function delete($id) {
		$this->db->where('id_tmp',$id);
		return $this->db->delete('tmp_bobot');
	}

	// Fungsi mengambil data id dari database
	public function get_id ($id){
		$query = $this->db->get_where('tmp_bobot', array('id_tmp' => $id));
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
    $this->db->select('*, COUNT(tmp_bobot.id_penyakit) as total');
    //$this->db->from('tb_diagnosa','tb_penyakit');
    $this->db->join('tb_penyakit', 'tmp_bobot.id_penyakit = tb_penyakit.id_penyakit','Left');
    $this->db->group_by('tmp_bobot.id_penyakit'); 
    $this->db->order_by('total', 'desc');
    $query=$this->db->get('tmp_bobot'); 
    return $query->result_array();
  }
  function hapustmp()
  {
    return $this->db->empty_table('tmp_bobot');
  }

}