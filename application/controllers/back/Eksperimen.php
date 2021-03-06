<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eksperimen extends CI_Controller {
	public function __construct()	{
		parent::__construct();
		$this->load->library('session');
		$this->simple_login->cek_login();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('M_user');
		$this->load->model('M_mahasiswa');
		$this->load->model('M_eksperimen');
		$this->load->model('M_responsi');
		$this->load->model('M_nilai_prak');
		$this->load->model('M_atr');
	}

	public function index($offset=0)
	{
		$jml = $this->db->get('tb_pelajaran');

			//pengaturan pagination
			 $config['base_url'] = base_url().'back/eksperimen/index';
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
			$data['data_eksperimen'] = $this->M_eksperimen->daftar_eksperimen($config['per_page'], $offset);

			//print_r($data);exit;
			$this->load->view('layout/back/header');
			$this->load->view('layout/back/sidebar');
			$this->load->view('back/eksperimen/semua_eksperimen',$data);
			$this->load->view('layout/back/footer');
	}

	public function tambah() {
		$data['kurikulum'] = $this->M_eksperimen->get_kurikulum();
		$data['user'] = $this->M_responsi->get_user();
		$data['asisten'] = $this->M_nilai_prak->get_user();

		$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/eksperimen/tambah_data_eksperimen',$data);
		$this->load->view('layout/back/footer',$data);
	
	}

	public function tambah_aksi(){

		$this->form_validation->set_rules('nama_pelajaran','nama_pelajaran','required');
		$this->form_validation->set_rules('id_kurikulum','id_kurikulum','required');
		$this->form_validation->set_rules('sesi','sesi','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Gagal menambah data</div>");
			redirect('back/Eksperimen');
		}
		$data_eksperimen = array(
			'nama_pelajaran' => $this->input->post('nama_pelajaran'),
			'id_kurikulum' => $this->input->post('id_kurikulum'),
			'sesi' => $this->input->post('sesi')
			);

			//print_r($data_bobot);exit;
			//cek kesamaan data jika sama maka tidak di simpan
			$cek=$this->M_eksperimen->get_cari_sama($data_eksperimen);
			//print_r($cek);exit;
			if ($cek==0) {
		$tambah = $this->M_eksperimen->tambah($data_eksperimen);
		//------------insert sub----------------------------
		$nama = $this->input->post('nama_sub_pelajaran');
		$asisten = $this->input->post('id_user_asisten');
		//print_r($nama);echo '<br/>';
		$i = 0;
		foreach($nama as $key=>$val)
		{
			$data[$i]['id_pelajaran'] = $tambah;
		    $data[$i]['nama_sub_pelajaran'] = $val;
		    $data[$i]['id_user'] = $asisten[$key];
		    $i++;
		}//print_r($data);echo '<br/>';
		$insert= $this->M_eksperimen->tambah_sub($data);
		//print_r($insert);
		
		//---------------cek aturan--------------------------
			$sesi = $this->input->post('sesi');
			//cek sesi di atr 
			$cek_sesi = $this->M_atr->cek_atr($sesi);
			//print_r($cek_sesi);exit;
			if($cek_sesi == 0){
				//jika tidak buat atr baru
				//atr baru
				// ambil nilai max dari pretest dan laporan yaitu 1 dan 10
				$nmax = 11;
				//sesi di kali nilai max
				$hasil = $sesi*$nmax;
				 //atr2
				 //ambil nilai max responsi * sesi untuk tertinggi
				$resMax = 10;
				 //tentukan total
				$totalResp = $resMax*$sesi;
				 //print_r($totalResp);
				//print_r($hasil);echo '<br/>';
				for($i=1; $i<=3; $i++){
					//print_r($i);exit;
				//tentukan batas bawah dan atas di atr1
				 	if($i=== 3){
				 		$awal = 0;
				 		$nama = 'Rendah';
				 		$akhir = $hasil/$i;
				 		$akhir = $akhir-1;
				 	}
				else{
						$bagi = $i+1;
						$awal = $hasil/$bagi;
				 	}
				 	//selesksi nama
					if($i===2){
				 		$nama = 'Sedang';
				 		$akhir = $hasil/$i;
				 		$akhir = $akhir-1;
				 	}
					if($i===1){
				 		$nama = 'Tinggi';
						$bagi = $i+1;
						$awal = $hasil/$bagi;
						$akhir = $hasil/$i;
						
				 	}

				 	$data_atr1 = array(
					'batas_bawah' => $awal,
					'batas_atas' => $akhir,
					'class' => $nama,
					'sesi' => $sesi
					);
					/*print_r($data_atr1);
					echo '<br/>';*/
					$this->M_atr->tambah($data_atr1);
					//simpan di atr 1
				}
			}
			//------------------cek sudah ada aturan2 atau belum-------------------------
			$cek_aturan2 = $this->M_atr->cek_aturan2();
			//jika kosong buat aturan baru
			if(empty($cek_aturan2)){
				for($i=1; $i<=3; $i++){
					//print_r($i);exit;
				//tentukan batas bawah dan atas di atr2
				 	if($i=== 3){
				 		$awalResp = 0;
				 		$nama = 'Rendah';
				 		$akhirResp = $totalResp/$i;
				 		$akhirResp = $akhirResp-1;
				 	}
				else{
						//responsi
						$bagiResp = $i+1;
						$awalResp = $totalResp/$bagiResp;
				 	}
				 	//selesksi nama
					if($i===2){
				 		$nama = 'Sedang';
				 		$akhirResp = $totalResp/$i;
				 		$akhirResp = $akhirResp-1;
				 	}
					if($i===1){
				 		$nama = 'Tinggi';
						$bagi = $i+1;
						$awalResp = $totalResp/$bagiResp;
						$akhirResp = $totalResp/$i;
				 	}
				 	$data_atr2 = array(
					'batas_bawah' => $awalResp,
					'batas_atas' => $akhirResp,
					'class' => $nama,
					);
					//print_r($data_atr2);
					//echo '<br/>';
					$this->M_atr->tambah2($data_atr2);
					//simpan di atr2
				}
			}
			
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Berhasil menambah data</div>");
		redirect('back/eksperimen');}
		else {
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Data sudah ada</div>");
			redirect('back/eksperimen/tambah');
		}
	}

	public function edit($id) 
	{	
         $data['eksperimen'] = $this->M_eksperimen->get_cari_eksperimen($id);
         $data['kurikulum'] = $this->M_eksperimen->get_kurikulum();

        $this->load->view('layout/back/header');
		$this->load->view('layout/back/sidebar');
		$this->load->view('back/eksperimen/edit_eksperimen',$data);
		$this->load->view('layout/back/footer');
	
        }

    public function edit_aksi()
	{
		//print_r($_POST);exit;
		$level= $this->session->userdata('level'); 
                                if($level==1){
		$this->form_validation->set_rules('id_kurikulum','id_kurikulum','required');
		$this->form_validation->set_rules('nama_pelajaran','nama_pelajaran','required');
		$this->form_validation->set_rules('sesi','sesi','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Gagal merubah data kelompok</div>");
	redirect('back/eksperimen');
		}else{
	$data_eksperimen = array(
			'id_pelajaran' => $this->input->post('id_pelajaran'),
			'id_kurikulum' => $this->input->post('id_kurikulum'),
			'nama_pelajaran' => $this->input->post('nama_pelajaran'),
			'sesi' => $this->input->post('sesi')
			);
//print_r($data_user);exit;
	$this->M_eksperimen->edit($data_eksperimen);

			$sesi = $this->input->post('sesi');
			//cek sesi di atr 
			$cek_sesi = $this->M_atr->cek_atr($sesi);
			//print_r($cek_sesi);exit;
			if($cek_sesi == 0){
				//jika tidak buat atr baru
				//atr baru
				// ambil nilai max dari pretest dan laporan yaitu 1 dan 10
				$nmax = 11;
				//sesi di kali nilai max
				$hasil = $sesi*$nmax;
				 //atr2
				 //ambil nilai max responsi * sesi untuk tertinggi
				$resMax = 10;
				 //tentukan total
				$totalResp = $resMax*$sesi;
				 //print_r($totalResp);
				//print_r($hasil);echo '<br/>';
				for($i=1; $i<=3; $i++){
					//print_r($i);exit;
				//tentukan batas bawah dan atas di atr1
				 	if($i=== 3){
				 		$awal = 0;
				 		$awalResp = 0;
				 		$nama = 'Rendah';
				 		$akhir = $hasil/$i;
				 		$akhir = $akhir-1;
				 		$akhirResp = $totalResp/$i;
				 		$akhirResp = $akhirResp-1;
				 	}
				else{
						$bagi = $i+1;
						$awal = $hasil/$bagi;
						//responsi
						$bagiResp = $i+1;
						$awalResp = $totalResp/$bagiResp;
				 	}
				 	//selesksi nama
					if($i===2){
				 		$nama = 'Sedang';
				 		$akhir = $hasil/$i;
				 		$akhir = $akhir-1;
				 		$akhirResp = $totalResp/$i;
				 		$akhirResp = $akhirResp-1;
				 	}
					if($i===1){
				 		$nama = 'Tinggi';
						$bagi = $i+1;
						$awal = $hasil/$bagi;
						$akhir = $hasil/$i;
						$awalResp = $totalResp/$bagiResp;
						$akhirResp = $totalResp/$i;
				 	}

				 	$data_atr1 = array(
					'batas_bawah' => $awal,
					'batas_atas' => $akhir,
					'class' => $nama,
					'sesi' => $sesi
					);
					/*print_r($data_atr1);
					echo '<br/>';*/
					$this->M_atr->tambah($data_atr1);
					//simpan di atr 1
					$data_atr2 = array(
					'batas_bawah' => $awalResp,
					'batas_atas' => $akhirResp,
					'class' => $nama,
					'sesi' => $sesi
					);
					/*print_r($data_atr2);
					echo '<br/>';*/
					$this->M_atr->tambah2($data_atr2);
					//simpan di atr2
				}
			}
	$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i> Data berhasil diubah</div>");
	redirect('back/eksperimen');}}
	else {
		$this->form_validation->set_rules('nama_pelajaran','nama_pelajaran','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Gagal merubah data kelompok</div>");
	redirect('back/eksperimen/edit');
		}else{
			$id= $this->session->userdata('id'); 
		$data_eksperimen = array(
			'id_pelajaran' => $this->input->post('id_pelajaran'),
			'id_kurikulum' => $this->input->post('id_kurikulum'),
			'nama_pelajaran' => $this->input->post('nama_pelajaran'),
			'sesi' => $this->input->post('sesi')
			);
//print_r($data_user);exit;
	$this->M_eksperimen->edit($data_eksperimen);
	
			$sesi = $this->input->post('sesi');
			//cek sesi di atr 
			$cek_sesi = $this->M_atr->cek_atr($sesi);
			//print_r($cek_sesi);exit;
			if($cek_sesi == 0){
				//jika tidak buat atr baru
				//atr baru
				// ambil nilai max dari pretest dan laporan yaitu 1 dan 10
				$nmax = 11;
				//sesi di kali nilai max
				$hasil = $sesi*$nmax;
				 //atr2
				 //ambil nilai max responsi * sesi untuk tertinggi
				$resMax = 4;
				 //tentukan total
				$totalResp = $resMax*$sesi;
				 //print_r($totalResp);
				//print_r($hasil);echo '<br/>';
				for($i=1; $i<=3; $i++){
					//print_r($i);exit;
				//tentukan batas bawah dan atas di atr1
				 	if($i=== 3){
				 		$awal = 0;
				 		$awalResp = 0;
				 		$nama = 'Rendah';
				 		$akhir = $hasil/$i;
				 		$akhir = $akhir-1;
				 		$akhirResp = $totalResp/$i;
				 		$akhirResp = $akhirResp-1;
				 	}
				else{
						$bagi = $i+1;
						$awal = $hasil/$bagi;
						//responsi
						$bagiResp = $i+1;
						$awalResp = $totalResp/$bagiResp;
				 	}
				 	//selesksi nama
					if($i===2){
				 		$nama = 'Sedang';
				 		$akhir = $hasil/$i;
				 		$akhir = $akhir-1;
				 		$akhirResp = $totalResp/$i;
				 		$akhirResp = $akhirResp-1;
				 	}
					if($i===1){
				 		$nama = 'Tinggi';
						$bagi = $i+1;
						$awal = $hasil/$bagi;
						$akhir = $hasil/$i;
						$awalResp = $totalResp/$bagiResp;
						$akhirResp = $totalResp/$i;
				 	}

				 	$data_atr1 = array(
					'batas_bawah' => $awal,
					'batas_atas' => $akhir,
					'class' => $nama,
					'sesi' => $sesi
					);
					print_r($data_atr1);
					echo '<br/>';
					$this->M_atr->tambah($data_atr1);
					//simpan di atr 1
					$data_atr2 = array(
					'batas_bawah' => $awalResp,
					'batas_atas' => $akhirResp,
					'class' => $nama,
					'sesi' => $sesi
					);
					print_r($data_atr2);
					echo '<br/>';
					$this->M_atr->tambah2($data_atr2);
					//simpan di atr2
				}
			}
	$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i> Data berhasil diubah</div>");
	redirect('back/eksperimen');}
	}
	}

	public function delete($id) {
		
		$this->M_eksperimen->delete($id);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
		redirect('back/eksperimen');
	}

	public function get_input_sub(){
		$data['id']=$this->input->post('id');
		$data['asisten'] = $this->M_nilai_prak->get_user();
		$tampil = $this->load->view('back/eksperimen/sub_pelajaran',$data);
		//print_r($data);exit;
		return $tampil;
		//echo json_encode($data);
	}
}
