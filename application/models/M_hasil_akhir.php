<?php
class M_hasil_akhir extends CI_Model {
	public function __construct()	{
		$this->load->database();
	}

	public function get_id ($id){
		$query = $this->db->get_where('tb_hasil_akir', array('id_hasil_akhir' => $id));
		return $query->result_array();
    }
	
	// Menampilkan data kelompok
	public function daftar_nilai($num,$offset,$id) {
		$this->db->select('*,tb_hasil_akhir.nim');
  		$this->db->from('tb_hasil_akhir','tb_user','tb_mahasiswa','tb_pelajaran','tb_prak_akhir','tb_responsi','tb_aturan','tb_sikap','tb_penilaian');
  		$this->db->join('tb_user','tb_hasil_akhir.id_user = tb_user.id_user','left');
  		$this->db->join('tb_mahasiswa','tb_hasil_akhir.nim = tb_mahasiswa.nim','left');
  		$this->db->join('tb_pelajaran','tb_hasil_akhir.id_pelajaran = tb_pelajaran.id_pelajaran','left');
  		$this->db->join('tb_prak_akhir','tb_hasil_akhir.id_prak_akhir = tb_prak_akhir.id_prak_akhir','left');
  		$this->db->join('tb_responsi','tb_hasil_akhir.id_responsi = tb_responsi.id_responsi','left');
  		$this->db->join('tb_aturan','tb_hasil_akhir.id_aturan = tb_aturan.id_aturan','left');
  		$this->db->join('tb_sikap','tb_hasil_akhir.id_sikap = tb_sikap.id_sikap','left');
  		$this->db->join('tb_penilaian','tb_hasil_akhir.id_nilai = tb_penilaian.id_nilai','left');
  		$this->db->where('tb_hasil_akhir.id_pelajaran',$id);
  		$this->db->order_by('tb_hasil_akhir.nilai_akhir','desc');
  		$query = $this->db->get('',$num,$offset);
        return $query->result_array();
	}

	// Model untuk menambah data nilai akhir
	public function tambah($data_nilai_akhir) {
		$this->db->insert('tb_hasil_akhir', $data_nilai_akhir);
	}
	
	// Update data kelompok
	public function edit($data_nilai_prak) {
		$this->db->where('id_hasil_akhir', $data_nilai_prak['id_hasil_akhir']);
		return $this->db->update('tb_hasil_akhir', $data_nilai_prak);
	}
	
	// Hapus data kelompok
	public function delete($id) {
		$this->db->where('id_hasil_akhir',$id);
		return $this->db->delete('tb_hasil_akhir');
	}

	public function cek_hasil_akhir($data_eksperimen,$data_mhs) 
	{
   		$this->db->select('*');
      	$this->db->where('id_pelajaran', $data_eksperimen);
      	$this->db->where('nim', $data_mhs);
      	$query = $this->db->get('tb_hasil_akhir');
    	return $query->result();
	}
}