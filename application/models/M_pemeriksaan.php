<?php if (! defined ('BASEPATH')) exit('No direct script access allowed');

class M_pemeriksaan extends CI_Model{
	public function __construct() 
    {
		$this->load->database();
	}
	
	public function liatgejala()
  {
    return $this->db->get('tb_gejala');
  }

  public function get_dog() 
  {
    return $this->db->get('tb_anjing');
  }

  public function get_dog_user($id) 
  {
    $this->db->select('*');
    $this->db->where('id_user',$id);
    return $this->db->get('tb_anjing');
  }

  function ambilgejala($id_gejala)
  {
  	$this->db->select('*');
  	$this->db->from('tb_bobot a');
  	$this->db->join('tb_penyakit b','b.id_penyakit=a.id_penyakit','left');
  	$this->db->join('tb_gejala c','c.id_gejala=a.id_gejala','left');
  	$this->db->where('a.id_gejala',$id_gejala);
  	return $this->db->get();
  }
  function simpantmp($datatmp)
  {
  	$this->db->insert('tmp',$datatmp);
  }
  function ambilpenyakit()
  {
    return $this->db->select('id_penyakit')->distinct()->get('tmp');
  }

  function ambil_penyakit()
  {
    return $this->db->get('tmp');
  }

  function ambilgejalapenyakit($id_penyakit)
  {
  	$this->db->where('id_penyakit',$id_penyakit);
  	return $this->db->get('tmp');
  }
  function ambilnamapenyakit($id_penyakit)
  {
  		$this->db->where('id_penyakit',$id_penyakit);
  		return $this->db->get('tb_penyakit');
  }
  function ambilsemuagejala($id_penyakit)
  {
  		$this->db->select('*');
  		$this->db->from('tb_bobot a');
  		$this->db->join('tb_gejala b','b.id_gejala=a.id_gejala','left');
  		$this->db->where('a.id_penyakit',$id_penyakit);
  		return $this->db->get();
  }
  function ambilnilaibayes()
  {
  	return $this->db->get('tb_bayes');
  }
  /*function hapustmp($id_penyakit)
  {
  	$this->db->where ('id_penyakit',$id_penyakit);
  	$this->db->delete('tmp');
  	
  }*/
  function hapustmp()
  {
    return $this->db->empty_table('tmp');
  }

  function pindahdata()
  {
    $this->db->select('*');
    $this->db->from('tb_bobot a');
    $this->db->join('tb_gejala b','b.id_gejala=a.id_gejala','left');
    $this->db->join('tb_penyakit c','c.id_penyakit=a.id_penyakit','left');
    return $this->db->get();
  }

  function updatetmp($id_bobot,$datatmp)
  {
    $this->db->where('id_bobot',$id_bobot);
    $this->db->update('tmp',$datatmp);
  }
  function ambilobat($id_penyakit)
  {
    $this->db->where('id_penyakit',$id_penyakit);
    return $this->db->get('tb_penyakit');
  }
  function cariiddiagnosa()
  {
    $this->db->select("*");
    $this->db->from("tb_diagnosa");
    $this->db->limit(1);
    $this->db->order_by('id_diagnosa',"DESC");
    return $this->db->get();
    
  }
  function simpangejala($datagejala)
  {
    $this->db->insert('tb_gejala_diagnosa',$datagejala);
  }
   function simpanhasil($tmp)
  {
    $this->db->insert('tmp_hasil',$tmp);
  }

  public function simpan_diagnosa($dt)
  {
    $this->db->insert('tb_diagnosa',$dt);
  }

  public function get_lastid()
  {
    $this->db->select("*");
    $this->db->from("tb_diagnosa");
    $this->db->limit(1);
    $this->db->order_by('id_diagnosa',"DESC");
    $query = $this->db->get();
    return $query->result();
  }
  
  public function update_hasildiagnosa($id_diagnosa,$diagnosa)
  {
    $this->db->where('id_diagnosa',$id_diagnosa);
    $this->db->update('tb_diagnosa',$diagnosa);
  }

  function hapushasil()
  {
    //$this->db->where ('id_penyakit',$id_penyakit);
    $this->db->empty_table('tmp_hasil');
    
  }
  
  function carimax()
  {
    $this->db->select_max('hasil');
    $query = $this->db->get('tmp_hasil');
    return $query->result();
  }
  function caripenyakitmax($id_pmax)
  {
    $this->db->select('*');
    $this->db->from('tmp_hasil');
    $this->db->where('hasil',$id_pmax);
    $query=$this->db->get('');
     if($query->num_rows() > 0) {
        $results = $query->result();
     return $results;}
     
  }

  function simpan_pemeriksaan($data)
  {
    //if($this->check_pemeriksaan($data['id_gejala']) == FALSE) {
      return $this->db->insert('tb_pemeriksaan', $data);
    //}
  }

  function check_pemeriksaan($id_gejala) {
    $result = $this->db->select('id_pemeriksaan')->where('id_gejala', $id_gejala)->get('tb_pemeriksaan')->num_rows();
    if($result) {
      return TRUE;
    }else{
      return FALSE;
    }
  }

  function get_ceked_gejala()
  {
    return $this->db->select('id_gejala')->distinct()->where('ceked', 1)->get('tmp')->result();
  }

  function diagnosa_v($id)
  {
   $this->db->select('*');
     $this->db->from('tb_diagnosa','tb_user','tb_penyakit','tb_bayes','tb_anjing');
     $this->db->join('tb_user', 'tb_diagnosa.id_user = tb_user.id_user','Left');
     $this->db->join('tb_penyakit', 'tb_diagnosa.id_penyakit = tb_penyakit.id_penyakit','Left');
     $this->db->join('tb_bayes', 'tb_diagnosa.id_bayes = tb_bayes.id_bayes','Left');
     $this->db->join('tb_anjing', 'tb_diagnosa.id_anjing = tb_anjing.id_anjing','Left');
     $this->db->where('tb_diagnosa.id_diagnosa',$id);
     $query = $this->db->get();

      if($query->num_rows() > 0) {
        $results = $query->result();
     return $results;}
     

  }
  function diagnosa_v1($id)
  {
   $this->db->select('*');
     $this->db->from('tb_diagnosa','tb_user','tb_penyakit','tb_bayes','tb_anjing');
     $this->db->join('tb_user', 'tb_diagnosa.id_user = tb_user.id_user','Left');
     $this->db->join('tb_penyakit', 'tb_diagnosa.id_penyakit = tb_penyakit.id_penyakit','Left');
     $this->db->join('tb_bayes', 'tb_diagnosa.id_bayes = tb_bayes.id_bayes','Left');
     $this->db->join('tb_anjing', 'tb_diagnosa.id_anjing = tb_anjing.id_anjing','Left');
     $this->db->where('tb_diagnosa.id_diagnosa',$id);
     $query = $this->db->get();

      if($query->num_rows() > 0) {
        $results = $query->result_array();
     return $results;}
     

  }
   public function pemeriksaan_v($id)
  {
    $this->db->select('tb_gejala.gejala');
    $this->db->from('tb_pemeriksaan','tb_gejala');
    $this->db->join('tb_gejala', 'tb_pemeriksaan.id_gejala = tb_gejala.id_gejala','Left');
    $this->db->where('tb_pemeriksaan.id_diagnosa',$id);
    $query = $this->db->get();

      if($query->num_rows() > 0) {
        $results = $query->result();
     return $results;}
     

  }

  public function get_hasil($num,$offset)
  {
   $this->db->select('tb_diagnosa.id_diagnosa,tb_diagnosa.id_penyakit,tb_anjing.nama_anjing,tb_user.nama,tb_penyakit.nama_penyakit,tb_penyakit.definisi,tb_diagnosa.tgl_diagnosa,tb_diagnosa.hasil,tb_bayes.teorema_bayes');
     $this->db->from('tb_diagnosa','tb_user','tb_penyakit','tb_bayes','tb_anjing');
     $this->db->join('tb_user', 'tb_diagnosa.id_user = tb_user.id_user','Left');
     $this->db->join('tb_penyakit', 'tb_diagnosa.id_penyakit = tb_penyakit.id_penyakit','Left');
     $this->db->join('tb_bayes', 'tb_diagnosa.id_bayes = tb_bayes.id_bayes','Left');
     $this->db->join('tb_anjing', 'tb_diagnosa.id_anjing = tb_anjing.id_anjing','Left');
     $this->db->order_by('id_diagnosa','desc');
     $query = $this->db->get('',$num,$offset);
    return $query->result_array();
  }

  public function get_pny() {
  $query = $this->db->get('tb_penyakit');
  return $query->result();
  }

  public function get_u() {
  $query = $this->db->get('tb_user');
  return $query->result();
  }

  public function get_a() {
  $query = $this->db->get('tb_anjing');
  return $query->result();
  }

  public function get_b() {
  $query = $this->db->get('tb_bayes');
  return $query->result();
  }

 public function hasil_user($id)
  {
    $this->db->select('*');
    $this->db->where('id_user',$id);
    $query = $this->db->get('tb_diagnosa');
    return $query->num_rows();
  }
  public function get_hasil_user($num,$offset,$id)
  {
    //print_r($id);exit;
   $this->db->select('*');
     $this->db->from('tb_diagnosa','tb_user','tb_penyakit','tb_bayes','tb_anjing');
     $this->db->join('tb_user', 'tb_diagnosa.id_user = tb_user.id_user','Left');
     $this->db->join('tb_penyakit', 'tb_diagnosa.id_penyakit = tb_penyakit.id_penyakit','Left');
     $this->db->join('tb_bayes', 'tb_diagnosa.id_bayes = tb_bayes.id_bayes','Left');
     $this->db->join('tb_anjing', 'tb_diagnosa.id_anjing = tb_anjing.id_anjing','Left');
     $this->db->where('tb_diagnosa.id_user',$id);
     //$this->db->where('tb_diagnosa.id_bayes',$id);
     $this->db->order_by('id_diagnosa','asc');
     $query = $this->db->get('',$num,$offset);
    return $query->result_array();
  }
  public function jumlah_diagnosa()
  {
    $this->db->select('*');
    $query = $this->db->get('tb_diagnosa'); 
    return $query->num_rows();
  }
  public function hitung_perpenyakit()
  {
    $this->db->select('*, COUNT(tb_diagnosa.id_penyakit) as total');
    //$this->db->from('tb_diagnosa','tb_penyakit');
    $this->db->join('tb_penyakit', 'tb_diagnosa.id_penyakit = tb_penyakit.id_penyakit','Left');
    $this->db->group_by('tb_diagnosa.id_penyakit'); 
    $this->db->order_by('total', 'desc');
    $query=$this->db->get('tb_diagnosa'); 
    return $query->result_array();
  }
   public function hitung_perpenyakit_user($id)
  {
    $this->db->where('tb_diagnosa.id_user',$id);
    $this->db->select('*, COUNT(tb_diagnosa.id_penyakit) as total');
    //$this->db->from('tb_diagnosa','tb_penyakit');
    $this->db->join('tb_penyakit', 'tb_diagnosa.id_penyakit = tb_penyakit.id_penyakit','Left');

    $this->db->group_by('tb_diagnosa.id_penyakit'); 
    $this->db->order_by('total', 'desc');
    $query=$this->db->get('tb_diagnosa'); 
    return $query->result_array();
  }
  public function jumlah_diagnosa_user($id)
  {
    $this->db->select('*');
    $this->db->where('tb_diagnosa.id_user',$id);
    $query = $this->db->get('tb_diagnosa'); 
    return $query->num_rows();
  }
  public function get_cari($data_cari) {
     $this->db->select('tb_diagnosa.id_diagnosa,tb_diagnosa.id_penyakit,tb_anjing.nama_anjing,tb_user.username,tb_penyakit.nama_penyakit,tb_penyakit.definisi,tb_diagnosa.tgl_diagnosa,tb_diagnosa.hasil,tb_bayes.teorema_bayes');
     $this->db->from('tb_diagnosa','tb_user','tb_penyakit','tb_bayes','tb_anjing');
     $this->db->join('tb_user', 'tb_diagnosa.id_user = tb_user.id_user','Left');
     $this->db->join('tb_penyakit', 'tb_diagnosa.id_penyakit = tb_penyakit.id_penyakit','Left');
     $this->db->join('tb_bayes', 'tb_diagnosa.id_bayes = tb_bayes.id_bayes','Left');
     $this->db->join('tb_anjing', 'tb_diagnosa.id_anjing = tb_anjing.id_anjing','Left');
     $this->db->like('username', $data_cari);
     $this->db->or_like('nama_anjing', $data_cari);
     $this->db->or_like('nama_penyakit', $data_cari);
     //$this->db->where('tb_diagnosa.id_diagnosa',$id);
     $query = $this->db->get();
     return $query->result_array();
  }

   public function get_cari_user($data_cari,$id) {
     $this->db->select('tb_diagnosa.id_diagnosa,tb_diagnosa.id_penyakit,tb_anjing.nama_anjing,tb_user.username,tb_penyakit.nama_penyakit,tb_penyakit.definisi,tb_diagnosa.tgl_diagnosa,tb_diagnosa.hasil,tb_bayes.teorema_bayes');
     $this->db->from('tb_diagnosa','tb_user','tb_penyakit','tb_bayes','tb_anjing');
     $this->db->join('tb_user', 'tb_diagnosa.id_user = tb_user.id_user','Left');
     $this->db->join('tb_penyakit', 'tb_diagnosa.id_penyakit = tb_penyakit.id_penyakit','Left');
     $this->db->join('tb_bayes', 'tb_diagnosa.id_bayes = tb_bayes.id_bayes','Left');
     $this->db->join('tb_anjing', 'tb_diagnosa.id_anjing = tb_anjing.id_anjing','Left');
     $this->db->like('nama_anjing', $data_cari);
     $this->db->or_like('nama_penyakit', $data_cari);
     $this->db->where('tb_diagnosa.id_user',$id);
     $query = $this->db->get();
     return $query->result_array();
  }
  public function get_date1($id) {
    $this->db->select('*');
    $this->db->where('id_diagnosa', $id);
    //$this->db->get();
    $query = $this->db->get('tb_diagnosa'); //simpan database yang udah di get alias ambil ke query
      return $query->result_array();
  }
  public function edit_usia($data_usia) {
    $this->db->where('id_diagnosa', $data_usia['id_diagnosa']);
    $this->db->update('tb_diagnosa', $data_usia);
  }

}


