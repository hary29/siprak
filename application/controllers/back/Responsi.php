<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Responsi extends CI_Controller {
	public function __construct()	{
		parent::__construct();
		$this->load->library('session');
		$this->simple_login->cek_login();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('M_user');
		$this->load->model('M_responsi');
		$this->load->model('M_nilai_prak');
		$this->load->model('M_eksperimen');
		$this->load->model('M_hasil_akhir');
		$this->load->model('M_atr');
	}

	public function index($offset=0)
	{
		$jml = $this->db->get('tb_responsi');

			//pengaturan pagination
			 $config['base_url'] = base_url().'back/responsi/index';
			 $config['total_rows'] = $jml->num_rows();
			 $config['per_page'] = '5';
			 $config['first_page'] = 'Awal';
			 $config['last_page'] = 'Akhir';
			 $config['next_page'] = '&laquo;';
			 $config['prev_page'] = '&raquo;';
			 $config['full_tag_open'] = "<ul class='pagination pagination-sm' style='position:relative; top:-25px;'>";
			 $config['full_tag_close'] ="</ul>";
			 $config['num_tag_open'] = '<li>';
			 $config['num_tag_close'] = '</li>';
			 $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
			 $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			 $config['next_tag_open'] = "<li>";
			 $config['next_tagl_close'] = "</li>";
			 $config['prev_tag_open'] = "<li>";
			 $config['prev_tagl_close'] = "</li>";
			 $config['first_tag_open'] = "<li>";
			 $config['first_tagl_close'] = "</li>";
			 $config['last_tag_open'] = "<li>";
			 $config['last_tagl_close'] = "</li>";

			 $this->pagination->initialize($config);
			 $this->uri->segment(3) ? $this->uri->segment(3) : 0;

			//inisialisasi config
			 $this->pagination->initialize($config);

			//buat pagination
			 $data['halaman'] = $this->pagination->create_links();

			//tamplikan data
			 
			$data['offset'] = $offset;
			
			$level= $this->session->userdata('level'); 
			if($level==1)
			{
				$data['data_responsi'] = $this->M_responsi->daftar_responsi($config['per_page'], $offset);
			}
			if($level==2)
			{
				$id_user= $this->session->userdata('id'); 
				$data['data_responsi'] = $this->M_responsi->daftar_responsi1($config['per_page'], $offset,$id_user);
			}

			//print_r($data);exit;
			$this->load->view('layout/back/header');
			$this->load->view('layout/back/sidebar');
			$this->load->view('back/responsi/semua_responsi',$data);
			$this->load->view('layout/back/footer');
	}

	public function tambah() {
		$level= $this->session->userdata('level'); 
		if($level==1)
		{
			$data['pel'] = $this->M_nilai_prak->get_pelajaran();
		}
		if($level==2)
		{
			$id_user= $this->session->userdata('id'); 
			$data['pel'] = $this->M_nilai_prak->get_pelajaran1($id_user);
		}

		$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/responsi/pilih_experimen',$data);
		$this->load->view('layout/back/footer',$data);
	
	}
	public function pilih_experimen(){
		
		$id = $this->input->post('id_pelajaran');
		$data['responsi']=$this->M_eksperimen->cari_eksperimen($id);
		$data['user'] = $this->M_responsi->get_user();
		$data['kurikulum'] = $this->M_eksperimen->get_kurikulum();
		$data['pelajaran'] = $id;
		//print_r($data['prak']);exit;
		$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/responsi/tambah_responsi',$data);
		$this->load->view('layout/back/footer',$data);

	}

	public function tambah_aksi(){

		$data_eksperimen = $this->input->post('id_pelajaran');
		
		$responsi = $this->input->post('nilai_responsi');
				//print_r($nilai_akhir);exit;
				//$sesi = $cari_sesi->sesi;
				//cari class dan id aturan prem1
		$clustering = $this->M_atr->cek_aturan_perm2($responsi);
		foreach ($clustering as $key => $value) {
			$class = $value->class;
			$id_prem2 = $value->id_atr_perm2;
		}

		$data_responsi = array(
			'id_responsi' => $this->input->post('id_responsi'),
			'nilai_responsi' => $this->input->post('nilai_responsi'),
			'nim' => $this->input->post('nim'),
			'id_atr_perm2' => $this->input->post('id_atr_perm2'),
			'id_kurikulum' => $this->input->post('id_kurikulum'),
			'id_user' => $this->input->post('id_user'),
			'id_atr_perm2' => $id_prem2
			);
		
			//print_r($data_bobot);exit;
			//cek kesamaan data jika sama maka tidak di simpan
			$cek=$this->M_responsi->get_cari_sama($data_responsi);

			$data_eksperimen = $this->input->post('id_pelajaran');
			$data_mhs = $this->input->post('nim');
			//print_r($cek);exit;
			if ($cek==0) {
		$resp = $this->M_responsi->tambah($data_responsi);

		//get nilai akhir
		$cek_prak = $this->M_nilai_prak->cek_nilai_prak($data_eksperimen,$data_mhs);
		$responsi = $this->input->post('nilai_responsi');
		//print_r($cek_responsi);exit;
		if($cek_prak == null){
			$nilai_akhir = 0;
			$id_prak_akhir = '';
			$id_atr_perm1 = '';
			$class_prem1 = '-';
		}else{
			foreach ($cek_prak as $key) {
				//cek nilai prak jika kosong maka ubah ke 0
				$nilai_akhir = isset($key->nilai)? $key->nilai: '0';
				$id_prak_akhir = isset($key->id_prak_akhir)? $key->id_prak_akhir : '';
				$id_atr_perm1 = isset($key->id_atr_perm1)? $key->id_atr_perm1 : '';
				$class_prem1 = isset($key->class)? $key->class : '-';
			}
		}

		 $nilai_final = ($nilai_akhir+$responsi)/2;

		 $atr_final = $this->M_atr->cek_aturan_final($class_prem1,$class_prem2);
		 foreach ($atr_final as $key => $value_final) {
		 	$id_aturan = isset($key->id_aturan)? $key->id_aturan : '';
		 }
		 //print_r($responsi);exit;
		//print_r($cek_hasil_akhir);exit;
			//jika cek nilai kosong maka buat baru
			$cek_hasil_akhir =$this->M_hasil_akhir->cek_hasil_akhir($data_eksperimen,$data_mhs);
			if (empty($cek_hasil_akhir)){

				//get responsi
				//get nilai akhir
				//(responsi+nilai akhir)/2
				//insert nilai akhir
				//$id_prak = $this->M_nilai_prak->tambah_akhir($data_nilai_prak);
				$data_nilai_akhir = array(
					'id_pelajaran' => $this->input->post('id_pelajaran'),
					'nim' => $this->input->post('nim'),
					'id_responsi' => $resp,
					'id_prak_akhir' => $id_prak_akhir,
					'nilai_akhir' => $nilai_final,
					'id_aturan' => $id_aturan
				);
				$this->M_hasil_akhir->tambah($data_nilai_akhir);


			}else{
				//jika ada update yang sudah ada
				foreach ($cek_hasil_akhir as $key) {
					$id_akhir = $key->id_hasil_akhir;
				}
				//print_r($id_akhir);exit;
				$data_nilai_prak = array(
					'id_hasil_akhir' => $id_akhir,
					'id_prak_akhir' => $id_prak_akhir,
					'nilai_akhir' => $nilai_final,
					'id_aturan' => $id_aturan
				);
				$this->M_hasil_akhir->edit($data_nilai_prak);
			}
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Berhasil menambah data</div>");
		redirect('back/responsi');}
		else {
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Data sudah ada</div>");
			redirect('back/responsi/tambah');
		}
	}

	public function edit($id) 
	{	
         $data['responsi'] = $this->M_responsi->get_cari_nilai($id);
         $data['user'] = $this->M_responsi->get_user();
         $data['mhs'] = $this->M_responsi->get_mahasiswa();
         //$data['pel'] = $this->M_responsi->get_pelajaran();
         $data['perm'] = $this->M_responsi->get_perm2();
         $data['kur'] = $this->M_responsi->get_kurikulum();

        $this->load->view('layout/back/header');
		$this->load->view('layout/back/sidebar');
		$this->load->view('back/responsi/edit_responsi',$data);
		$this->load->view('layout/back/footer');
	
        }

    public function edit_aksi()
	{
		//print_r($_POST);exit;
		$level= $this->session->userdata('level'); 
                                if($level==1){
        $this->form_validation->set_rules('id_responsi','id_responsi','required');
		$this->form_validation->set_rules('nilai_responsi','nilai_responsi','required');
		$this->form_validation->set_rules('nim','nim','required');
		$this->form_validation->set_rules('id_atr_perm2','id_atr_perm2','required');
		//$this->form_validation->set_rules('id_pelajaran','id_pelajaran','required');
		$this->form_validation->set_rules('id_kurikulum','id_kurikulum','required');
		$this->form_validation->set_rules('id_user','id_user','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Gagal merubah</div>");
	redirect('back/responsi');
		}else{

	$data_eksperimen = $this->input->post('id_pelajaran');
		
		$responsi = $this->input->post('nilai_responsi');
				//print_r($nilai_akhir);exit;
				//$sesi = $cari_sesi->sesi;
				//cari class dan id aturan prem1
		$clustering = $this->M_atr->cek_aturan_perm2($responsi);
		foreach ($clustering as $key => $value) {
			$class = $value->class;
			$id_prem2 = $value->id_atr_perm2;
		}

	$data_responsi = array(
			'id_responsi' => $this->input->post('id_responsi'),
			'nilai_responsi' => $this->input->post('nilai_responsi'),
			'nim' => $this->input->post('nim'),
			'id_atr_perm2' => $this->input->post('id_atr_perm2'),
			'id_kurikulum' => $this->input->post('id_kurikulum'),
			'id_user' => $this->input->post('id_user'),
			'id_atr_perm2' => $id_prem2
			);
//print_r($data_user);exit;
	$resp = $this->input->post('id_responsi');
	$this->M_responsi->edit($data_responsi);
	$cek_prak = $this->M_nilai_prak->cek_nilai_prak($data_eksperimen,$data_mhs);
		$responsi = $this->input->post('nilai_responsi');
		//print_r($cek_responsi);exit;
		if($cek_prak == null){
			$nilai_akhir = 0;
			$id_prak_akhir = '';
			$id_atr_perm1 = '';
			$class_prem1 = '';
		}else{
			foreach ($cek_prak as $key) {
				//cek nilai prak jika kosong maka ubah ke 0
				$nilai_akhir = isset($key->nilai)? $key->nilai: '0';
				$id_prak_akhir = isset($key->id_prak_akhir)? $key->id_prak_akhir : '';
				$id_atr_perm1 = isset($key->id_atr_perm1)? $key->id_atr_perm1 : '';
				$class_prem1 = isset($key->class)? $key->class : '';
			}
		}

		 $nilai_final = ($nilai_akhir+$responsi)/2;

		 $atr_final = $this->M_atr->cek_aturan_final($class_prem1,$class_prem2);
		 foreach ($atr_final as $key => $value_final) {
		 	$id_aturan = isset($key->id_aturan)? $key->id_aturan : '';
		 }
		 //print_r($responsi);exit;
		//print_r($cek_hasil_akhir);exit;
			//jika cek nilai kosong maka buat baru
			$cek_hasil_akhir =$this->M_hasil_akhir->cek_hasil_akhir($data_eksperimen,$data_mhs);
			if (empty($cek_hasil_akhir)){

				//get responsi
				//get nilai akhir
				//(responsi+nilai akhir)/2
				//insert nilai akhir
				//$id_prak = $this->M_nilai_prak->tambah_akhir($data_nilai_prak);
				$data_nilai_akhir = array(
					'id_pelajaran' => $this->input->post('id_pelajaran'),
					'nim' => $this->input->post('nim'),
					'id_responsi' => $resp,
					'id_prak_akhir' => $id_prak_akhir,
					'nilai_akhir' => $nilai_final
				);
				$this->M_hasil_akhir->tambah($data_nilai_akhir);


			}else{
				//jika ada update yang sudah ada
				foreach ($cek_hasil_akhir as $key) {
					$id_akhir = $key->id_hasil_akhir;
				}
				//print_r($id_akhir);exit;
				$data_nilai_prak = array(
					'id_hasil_akhir' => $id_akhir,
					'id_prak_akhir' => $id_prak_akhir,
					'nilai_akhir' => $nilai_final
				);
				$this->M_hasil_akhir->edit($data_nilai_prak);
			}
	$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i> Data berhasil diubah</div>");
	redirect('back/responsi');}}
	else {
		//$this->form_validation->set_rules('id_responsi','id_responsi','required');
		$this->form_validation->set_rules('nilai_responsi','pertemuan','required');
		//$this->form_validation->set_rules('nim','nim','required');
		$this->form_validation->set_rules('id_atr_perm2','id_atr_perm2','required');
		//$this->form_validation->set_rules('id_pelajaran','id_pelajaran','required');
		$this->form_validation->set_rules('id_kurikulum','id_kurikulum','required');
		$this->form_validation->set_rules('id_user','id_user','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Gagal merubah data</div>");
	redirect('back/responsi/edit');
		}else{
			$id= $this->session->userdata('id'); 
		$data_responsi = array(
			'id_responsi' => $this->input->post('id_responsi'),
			'nilai_responsi' => $this->input->post('nilai_responsi'),
			'nim' => $this->input->post('nim'),
			'id_atr_perm2' => $this->input->post('id_atr_perm2'),
			'id_kurikulum' => $this->input->post('id_kurikulum'),
			'id_user' => $this->input->post('id_user')
			);
//print_r($data_user);exit;
	$this->M_responsi->edit($data_responsi);
	$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i> Data berhasil diubah </div>");
	redirect('back/responsi');}
	}
	}

	public function delete($id) {
		
		$this->M_responsi->delete($id);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
		redirect('back/responsi');
	}
}
