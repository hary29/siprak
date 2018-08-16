<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pemeriksaan extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  
      $this->load->model('m_pemeriksaan');
      $this->load->helper('url'); 
      
 }

public function index()
  {
    $level= $this->session->userdata('level'); 
                                if($level==1){
    $data['priksa']=$this->m_pemeriksaan->liatgejala();
    $data['dog']=$this->m_pemeriksaan->get_dog();

    $this->load->view('layout/back/header',$data);
    $this->load->view('layout/back/sidebar',$data);
    $this->load->view('back/pemeriksaan/data_pemeriksaan',$data);
    $this->load->view('layout/back/footer',$data);
  }
  else{
    $id= $this->session->userdata('id');
    //print_r($id);exit;
    $data['priksa']=$this->m_pemeriksaan->liatgejala();
    $data['dog']=$this->m_pemeriksaan->get_dog_user($id);

    $this->load->view('layout/back/header',$data);
    $this->load->view('layout/back/sidebar',$data);
    $this->load->view('back/pemeriksaan/data_pemeriksaan',$data);
    $this->load->view('layout/back/footer',$data);}
  }

public function diagnosa_user()
   {
     $data['judul']='';
     $data['viewgejalakonsultasi']=$this->m_pemeriksaan->liatgejala();
     $this->tema->pasien('diagnosa_user/diagnosa_v',$data);
	}

	public function simpantmp_user()
  {
  $this->m_pemeriksaan->hapustmp();
  
  $pindahdata= $this->m_pemeriksaan->pindahdata();
  foreach ($pindahdata->result() as $row) {
  	$ceked[$row->id_gejala] = 0;
  	if(in_array($row->id_gejala, $_POST['gejala'])){
  		$ceked[$row->id_gejala] = 1;
  	}

  	$tmp=array(
      'id_penyakit'=>$row->id_penyakit,
      'id_bobot'=>$row->id_bobot,
      'id_gejala'=>$row->id_gejala,
      'nama_penyakit'=>$row->nama_penyakit,
      'gejala'=>$row->gejala,
      'ceked' => $ceked[$row->id_gejala]
      );

    $this->m_pemeriksaan->simpantmp($tmp);

  }
  $data = $this->input->post('gejala');

  $jumlah= count($data);

  for ($sum=0; $sum<$jumlah ; $sum++){
    $id_gejala=$data[$sum];
    //print_r($id_gejala);exit;
    $ambilgejala=$this->m_pemeriksaan->ambilgejala($id_gejala);
    foreach ($ambilgejala->result() as $row ) 
    {

        echo $id_penyakit=$row->id_penyakit;
        echo $id_gejala=$row->id_gejala;
        echo $nama_penyakit=$row->nama_penyakit;
        echo $gejala=$row->gejala;
        echo $bobot=$row->bobot; 
       // echo $ceked=$row->ceked; 
        echo $id_bobot=$row->id_bobot;
        
      $datatmp=array(
      'bobot'=>$bobot
      );
      $this->m_pemeriksaan->updatetmp($id_bobot,$datatmp); 
    }
  }

  $dt=array(
      'id_diagnosa'=>$row->id_diagnosa,
      'id_user'=>$row->id_user,
      'id_anjing'=>$row->id_anjing,
      'tgl_diagnosa'=>$row->tgl_diagnosa
      );

    $this->m_pemeriksaan->simpan_diagnosa($dt);
    
  redirect('pemeriksaan/proseshitung_user');
}

public function proseshitung_user()
{
  $data['judul']='Perhitungan Bayes';
  $this->tema->pasien('diagnosa_user/proses_hitung',$data);
}

public function simpantmp()
{
  //print_r($_POST);exit;
  $anjing=$this->input->post('id_anjing');
  if ($anjing ==  "--Pilih Jenis Anjing--"){
    $this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> silahkan pilih anjing</div>");
  redirect('back/pemeriksaan');
  }
  else{
  $this->m_pemeriksaan->hapustmp();
  
  $pindahdata= $this->m_pemeriksaan->pindahdata();
  foreach ($pindahdata->result() as $row) {
  	$ceked[$row->id_gejala] = 0;
  	if(in_array($row->id_gejala, $_POST['gejala'])){
  		$ceked[$row->id_gejala] = 1;
  	}

  	$tmp=array(
      'id_penyakit'=>$row->id_penyakit,
      'id_bobot'=>$row->id_bobot,
      'id_gejala'=>$row->id_gejala,
      'nama_penyakit'=>$row->nama_penyakit,
      'gejala'=>$row->gejala,
      'ceked' => $ceked[$row->id_gejala]
      );

    $this->m_pemeriksaan->simpantmp($tmp);

  }
  $data = $this->input->post('gejala');

  $jumlah= count($data);

  for ($sum=0; $sum<$jumlah ; $sum++){
    $id_gejala=$data[$sum];
    //print_r($id_gejala);exit;
    $ambilgejala=$this->m_pemeriksaan->ambilgejala($id_gejala);
    foreach ($ambilgejala->result() as $row ) 
    {

        echo $id_penyakit=$row->id_penyakit;
        echo $id_gejala=$row->id_gejala;
        echo $nama_penyakit=$row->nama_penyakit;
        echo $gejala=$row->gejala;
        echo $bobot=$row->bobot; 
       // echo $ceked=$row->ceked; 
        echo $id_bobot=$row->id_bobot;
        
      $datatmp=array(
      'bobot'=>$bobot
      );
      $this->m_pemeriksaan->updatetmp($id_bobot,$datatmp); 
    }
  }}

  $dt=array(
      'id_diagnosa' => $this->input->post('id_diagnosa'),
      'id_user' => $this->input->post('id_user'),
      'id_anjing' => $this->input->post('id_anjing'),
      'tgl_diagnosa' => $this->input->post('tgl_diagnosa'),
      );

    $this->m_pemeriksaan->simpan_diagnosa($dt);
    
  redirect('back/pemeriksaan/proseshitung');
}

  public function proseshitung()
{
  //$data['diag']=$this->m_pemeriksaan->get_diag();

  $this->load->view('layout/back/header');
  $this->load->view('layout/back/sidebar');
  $this->load->view('back/pemeriksaan/proses_hitung');
  $this->load->view('layout/back/footer');
}

  public function tampildiagnosa($id)
{
	
	$data['viewdiagnosa']=$this->m_pemeriksaan->diagnosa_v($id);
  $date=$this->m_pemeriksaan->diagnosa_v1($id);
	$data['viewinput']=$this->m_pemeriksaan->pemeriksaan_v($id);
foreach ($date as $key) {
      $date1 = $key['tanggal_lahir'];
    }
    $lahir = new DateTime($date1);
    $today = new DateTime('today');
    $y = $today->diff($lahir)->y;
    $m = $today->diff($lahir)->m;
    $d = $today->diff($lahir)->d;
    $data['y'] = $y;
    $data['m'] = $m;
    $data['d'] = $d;
    //print_r($d);exit;
   $usia = $y." tahun ".$m." bulan ".$d. " hari";
   $data_usia = array(
        'id_diagnosa' => $id,
        'usia' => $usia
       );
  $this->m_pemeriksaan->edit_usia($data_usia);
	$this->load->view('layout/back/header');
  $this->load->view('layout/back/sidebar');
  $this->load->view('back/pemeriksaan/hasil',$data);
  $this->load->view('layout/back/footer');
}
  public function tampildiagnosa1($id)
{
  
  $data['viewdiagnosa']=$this->m_pemeriksaan->diagnosa_v($id);
  $data['viewinput']=$this->m_pemeriksaan->pemeriksaan_v($id);
//print_r($data);exit;
  $this->load->view('layout/back/header');
  $this->load->view('layout/back/sidebar');
  $this->load->view('back/pemeriksaan/detail_hasil',$data);
  $this->load->view('layout/back/footer');
}

  public function view_hasil($offset=0)
  {
  
      $jml = $this->db->get('tb_diagnosa');

      $config['base_url'] = base_url().'/back/pemeriksaan/view_hasil/';
      $config['total_rows'] = $jml->num_rows();
      $config['per_page'] = 10;
      $config['uri_segment'] = 4;
      $config['full_tag_open'] = '<ul class="pagination pagination-sm" style="position:relative; top:-25px;">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = '&laquo; First';
      $config['first_tag_open'] = '<li class="prev page">';
      $config['first_tag_close'] = '</li>';
      $config['last_link'] = 'Last &raquo;';
      $config['last_tag_open'] = '<li class="next page">';
      $config['last_tag_close'] = '</li>';
      $config['next_link'] = 'Next &rarr;';
      $config['next_tag_open'] = '<li class="next page">';
      $config['next_tag_close'] = '</li>';
      $config['prev_link'] = '&larr; Prev';
      $config['prev_tag_open'] = '<li class="prev page">';
      $config['prev_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li class="page">';
      $config['num_tag_close'] = '</li>';

      $this->pagination->initialize($config);
      $this->uri->segment(4) ? $this->uri->segment(4) : 0;

      $data['halaman'] = $this->pagination->create_links();
      $data['offset'] = $offset;
      $data['vhs'] = $this->m_pemeriksaan->get_hasil($config['per_page'], $offset);
      $data['penyakit'] = $this->m_pemeriksaan->get_pny();
      $data['user'] = $this->m_pemeriksaan->get_u();
      $data['anjing'] = $this->m_pemeriksaan->get_a();
      $data['bayes'] = $this->m_pemeriksaan->get_b();
      //$data['username'] = $this->session->userdata('username');
      //$data['id_user'] = $this->session->userdata('id_user');
  

  $this->load->view('layout/back/header');
  $this->load->view('layout/back/sidebar');
  $this->load->view('back/pemeriksaan/semua_hasil',$data);
  $this->load->view('layout/back/footer');
}
  public function view_hasil_user($offset=0)
  {
      $id = $this->session->userdata('id'); 
      $jml = $this->m_pemeriksaan->hasil_user($id);

      $config['base_url'] = base_url().'/back/pemeriksaan/view_hasil_user/';
      $config['total_rows'] = $jml;
      $config['per_page'] = 10;
      $config['uri_segment'] = 4;
      $config['full_tag_open'] = '<ul class="pagination pagination-sm" style="position:relative; top:-25px;">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = '&laquo; First';
      $config['first_tag_open'] = '<li class="prev page">';
      $config['first_tag_close'] = '</li>';
      $config['last_link'] = 'Last &raquo;';
      $config['last_tag_open'] = '<li class="next page">';
      $config['last_tag_close'] = '</li>';
      $config['next_link'] = 'Next &rarr;';
      $config['next_tag_open'] = '<li class="next page">';
      $config['next_tag_close'] = '</li>';
      $config['prev_link'] = '&larr; Prev';
      $config['prev_tag_open'] = '<li class="prev page">';
      $config['prev_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li class="page">';
      $config['num_tag_close'] = '</li>';

      $this->pagination->initialize($config);
      $this->uri->segment(4) ? $this->uri->segment(4) : 0;

      $data['halaman'] = $this->pagination->create_links();
      $data['offset'] = $offset;
      $data['vhs'] = $this->m_pemeriksaan->get_hasil_user($config['per_page'], $offset, $id);
       //print_r($id);exit;
      $data['penyakit'] = $this->m_pemeriksaan->get_pny();
      $data['user'] = $this->m_pemeriksaan->get_u();
      $data['anjing'] = $this->m_pemeriksaan->get_a();
      $data['bayes'] = $this->m_pemeriksaan->get_b();

     
      //$data['username'] = $this->session->userdata('username');
      //$data['id_user'] = $this->session->userdata('id_user');
  

  $this->load->view('layout/back/header');
  $this->load->view('layout/back/sidebar');
  $this->load->view('back/pemeriksaan/semua_hasil',$data);
  $this->load->view('layout/back/footer');
}

public function view_hasil_pencarian()
{     
    $level= $this->session->userdata('level'); 
    if($level==1){
      $data['penyakit'] = $this->m_pemeriksaan->get_pny();
      $data['user'] = $this->m_pemeriksaan->get_u();
      $data['anjing'] = $this->m_pemeriksaan->get_a();
      $data['bayes'] = $this->m_pemeriksaan->get_b();
      $data_cari = $this->input->post('search');
      $data['cari'] = $this->m_pemeriksaan->get_cari($data_cari);
        
      $this->load->view('layout/back/header');
      $this->load->view('layout/back/sidebar');
      $this->load->view('back/pemeriksaan/hasil_pencarian',$data);
      $this->load->view('layout/back/footer');
    }
    else{
      $id = $this->session->userdata('id'); 
      $jml = $this->m_pemeriksaan->hasil_user($id);
      $data['penyakit'] = $this->m_pemeriksaan->get_pny();
      $data['user'] = $this->m_pemeriksaan->get_u();
      $data['anjing'] = $this->m_pemeriksaan->get_a();
      $data['bayes'] = $this->m_pemeriksaan->get_b();
      $data_cari = $this->input->post('search');
      $data['cari'] = $this->m_pemeriksaan->get_cari_user($data_cari, $id);

      $this->load->view('layout/back/header');
      $this->load->view('layout/back/sidebar');
      $this->load->view('back/pemeriksaan/hasil_pencarian',$data);
      $this->load->view('layout/back/footer');

    }
  }

}