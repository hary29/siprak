<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sikap extends CI_Controller {
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
		$this->load->model('M_sikap');
		$this->load->model('M_atr');
	}

	public function index($offset=0)
	{
		$jml = $this->db->get('tb_sikap');

			//pengaturan pagination
			 $config['base_url'] = base_url().'back/sikap/index';
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
			
			$data['data_sikap'] = $this->M_sikap->daftar_nilai_sikap($config['per_page'], $offset);

			//print_r($data);exit;
			$this->load->view('layout/back/header');
			$this->load->view('layout/back/sidebar');
			$this->load->view('back/sikap/semua_sikap',$data);
			$this->load->view('layout/back/footer');
	}

	public function tambah() {

		$data['pel'] = $this->M_sikap->get_pelajaran();
		$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/sikap/pilih_experimen',$data);
		$this->load->view('layout/back/footer',$data);
	
	}
	public function pilih_experimen(){
		
		$id = $this->input->post('id_pelajaran');
		$data['responsi']=$this->M_eksperimen->cari_eksperimen($id);
		$data['user'] = $this->M_user->get_user();
		$data['pelajaran'] = $id;
		//print_r($data['prak']);exit;
		$this->load->view('layout/back/header');
		$this->load->view('layout/back/sidebar');
		$this->load->view('back/sikap/tambah_sikap',$data);
		$this->load->view('layout/back/footer');

	}

	public function tambah_aksi(){
		$id= $this->session->userdata('id'); 
		if($id == 3) {
		$data_eksperimen= $this->input->post('id_pelajaran');
		$iduser = $this->session->userdata('id'); 
		$data_mhs = $this->input->post('nim');
		$sikap = $this->input->post('sikap');
				/*print_r($data_eksperimen);
				print_r($data_mhs);*/
				//$sesi = $cari_sesi->sesi;
				//cari class dan id aturan prem1
		$cek_sikap = $this->M_sikap->cek_sikap($data_eksperimen,$data_mhs);
		//print_r($cek_sikap);exit;

		$data_sikap = array(
			'sikap' => $this->input->post('sikap'),
			'nim' => $this->input->post('nim'),
			'id_pelajaran' => $this->input->post('id_pelajaran'),
			'id_user' => $iduser
			);

			if ($cek_sikap==0) {
		$idsikap = $this->M_sikap->tambah($data_sikap);

		//get nilai akhir
		$cek_prak = $this->M_nilai_prak->cek_nilai_prak($data_eksperimen,$data_mhs);
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

		$cek_responsi = $this->M_responsi->cek_nilai_responsi($data_eksperimen,$data_mhs);
		//print_r($cek_responsi);exit;
		if($cek_responsi == null){
			$responsi = 0;
			$id_responsi = '';
			$id_atr_prem2 = '';
			$class_prem2 = '-';
		}else{
			foreach ($cek_responsi as $key) {
				//cek responsi jika kosong maka ubah ke 0
				$responsi = $key->nilai_responsi;
				$id_responsi = $key->id_responsi;
				$id_atr_prem2 = $key->id_atr_perm2;
				$class_prem2 = $key->class;
			}
		}

		 $nilai_final = ($nilai_akhir+$responsi)/2;

		 //buat penilaian di sini
		 $final =  $this->M_atr->cek_penilaian($nilai_final);
		 foreach ($final as $key => $value) {
		 	$id_nilai = isset($value->id_nilai)? $value->id_nilai : '';
		 }

		 $atr_final = $this->M_atr->cek_aturan_final($class_prem1,$class_prem2,$sikap);
		 //print_r($atr_final);exit;
		 foreach ($atr_final as $key => $value_final) {
		 	$id_aturan = isset($value_final->id_aturan)? $value_final->id_aturan : '';
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
					'id_responsi' => $id_responsi,
					'id_prak_akhir' => $id_prak_akhir,
					'id_sikap' => $idsikap,
					'nilai_akhir' => $nilai_final,
					'id_aturan' => $id_aturan,
					'id_nilai' => $id_nilai
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
					'id_aturan' => $id_aturan,
					'id_nilai' => $id_nilai
				);
				$this->M_hasil_akhir->edit($data_nilai_prak);
			}
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Berhasil menambah data</div>");
		redirect('back/sikap');}
		else {
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Data sudah ada</div>");
			redirect('back/sikap/tambah');
			}
		}
	else{
		$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i>anda tidak berhak merubah data</div>");
			redirect('back/home_back');
		}
	}

	public function edit($id) 
	{	
         $data['sikap'] = $this->M_sikap->get_cari_nilai($id);
         $data['user'] = $this->M_sikap->get_user();
         $data['mhs'] = $this->M_sikap->get_mahasiswa();
         //$data['pel'] = $this->M_responsi->get_pelajaran();
         //$data['perm'] = $this->M_responsi->get_perm2();
         //$data['kur'] = $this->M_responsi->get_kurikulum();

        $this->load->view('layout/back/header');
		$this->load->view('layout/back/sidebar');
		$this->load->view('back/sikap/edit_sikap',$data);
		$this->load->view('layout/back/footer');
	
        }

    public function edit_aksi()
	{
		//print_r($_POST);exit;
		$level= $this->session->userdata('level'); 
                                if($level==3){
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
	$sikap = $this->input->post('sikap');
	$idsikap = $this->input->post('id_sikap');
	$responsi = $this->input->post('nilai_responsi');
				//print_r($nilai_akhir);exit;
				//$sesi = $cari_sesi->sesi;
				//cari class dan id aturan prem1
	$data_sikap = array(
			'id_sikap'=> $this->input->post('id_sikap'),
			'sikap' => $this->input->post('sikap'),
			'nim' => $this->input->post('nim'),
			'id_pelajaran' => $this->input->post('id_pelajaran'),
			'id_user' => $iduser
			);
//print_r($data_user);exit;
	$sikap = $this->input->post('id_sikap');
	$this->M_sikap->edit($data_sikap);
	$cek_prak = $this->M_nilai_prak->cek_nilai_prak($data_eksperimen,$data_mhs);
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
	$cek_responsi = $this->M_responsi->cek_nilai_responsi($data_eksperimen,$data_mhs);
		//print_r($cek_responsi);exit;
		if($cek_responsi == null){
			$responsi = 0;
			$id_responsi = '';
			$id_atr_prem2 = '';
			$class_prem2 = '-';
		}else{
			foreach ($cek_responsi as $key) {
				//cek responsi jika kosong maka ubah ke 0
				$responsi = $key->nilai_responsi;
				$id_responsi = $key->id_responsi;
				$id_atr_prem2 = $key->id_atr_perm2;
				$class_prem2 = $key->class;
			}
		}

	$nilai_final = ($nilai_akhir+$responsi)/2;

	$final =  $this->M_atr->cek_penilaian($nilai_final);
		foreach ($final as $key => $value) {
		 	$id_nilai = isset($value->id_nilai)? $value->id_nilai : '';
		}

	$atr_final = $this->M_atr->cek_aturan_final($class_prem1,$class_prem2,$sikap);
		 foreach ($atr_final as $key => $value_final) {
		 	$id_aturan = isset($value_final->id_aturan)? $value_final->id_aturan : '';
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
					'id_responsi' => $id_responsi,
					'id_sikap'=>$idsikap,
					'id_prak_akhir' => $id_prak_akhir,
					'id_nilai' => $id_nilai,
					'id_aturan' => $id_aturan,
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
					'nilai_akhir' => $nilai_final,
					'id_nilai' => $id_nilai,
					'id_aturan' => $id_aturan,
					'id_sikap'=>$idsikap
				);
				$this->M_hasil_akhir->edit($data_nilai_prak);
			}
	$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i> Data berhasil diubah</div>");
	redirect('back/sikap');}}
	else{
		$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i>anda tidak berhak merubah data</div>");
			redirect('back/home_back');
		}
	
	}

	public function delete($id) {
		
		$this->M_sikap->delete($id);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
		redirect('back/sikap');
	}
}
