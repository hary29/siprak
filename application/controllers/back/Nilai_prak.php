<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nilai_prak extends CI_Controller {
	public function __construct()	{
		parent::__construct();
		$this->load->library('session');
		$this->simple_login->cek_login();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('M_user');
		$this->load->model('M_kelompok');
		$this->load->model('M_nilai_prak');
		$this->load->model('M_eksperimen');
		$this->load->model('M_responsi');
		$this->load->model('M_hasil_akhir');
		$this->load->model('M_atr');
	}

	public function index($offset=0)
	{
		$jml = $this->db->get('tb_nilai_prak');

			//pengaturan pagination
			 $config['base_url'] = base_url().'back/nilai_prak/index';
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
			$data['data_niprak'] = $this->M_nilai_prak->daftar_nilai($config['per_page'], $offset);

			//print_r($data);exit;
			$this->load->view('layout/back/header');
			$this->load->view('layout/back/sidebar');
			$this->load->view('back/nilai_prak/semua_nilai_prak',$data);
			$this->load->view('layout/back/footer');
	}

	public function tambah() {
		
		$data['user'] = $this->M_nilai_prak->get_user();
		$data['mhs'] = $this->M_nilai_prak->get_mahasiswa();
		$data['pel'] = $this->M_nilai_prak->get_pelajaran();


		$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/nilai_prak/pilih_experimen',$data);
		$this->load->view('layout/back/footer',$data);
	
	}

	public function pilih_experimen(){

		if(empty($_GET['id']))
		{
			$id = $this->input->post('id_pelajaran');
		}
	else{
		$id = isset($_GET['id'])?$_GET['id'] : '';
		}
		//print_r($id);exit;
		
		$data['prak']=$this->M_eksperimen->cari_eksperimen($id);
		$data['user'] = $this->M_nilai_prak->get_user();
		$data['pelajaran'] = $id;
		//print_r($data['prak']);exit;
		$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/nilai_prak/tambah_nilai_prak',$data);
		$this->load->view('layout/back/footer',$data);

	}
	public function tambah_aksi(){
		//print_r($_POST);exit;
		$data_nilai_prak = array(
			'id_nilai_prak' => $this->input->post('id_nilai_prak'),
			'pertemuan' => $this->input->post('pertemuan'),
			'id_pelajaran' => $this->input->post('id_pelajaran'),
			'pretest' => $this->input->post('pretest'),
			'laporan' => $this->input->post('laporan'),
			'nim' => $this->input->post('nim'),
			'id_user' => $this->input->post('id_user')
			);

			//print_r($data_bobot);exit;
			//cek kesamaan data jika sama maka tidak di simpan
			$data_eksperimen = $this->input->post('id_pelajaran');
			$data_mhs = $this->input->post('nim');
			//print_r($data_eksperimen);
			//cek sesi dari id_pelajaran
			$get=$this->M_nilai_prak->get_sesi($data_eksperimen,$data_mhs);
			
			$cari_sesi=$this->M_eksperimen->get_cari_sesi($data_eksperimen);
			//$this->M_nilai_prak->tambah($data_nilai_prak);
			//print_r($data_eksperimen);
			//print_r($get);
			//print_r($cari_sesi->sesi);
			//exit;
			
			//jika sesi == 0
			if($get >= $cari_sesi->sesi){
				$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> data pertemuan sudah terisi penuh</div>");
			redirect('back/nilai_prak');
			}
			$cek=$this->M_nilai_prak->get_cari_sama($data_nilai_prak);
			//print_r($cek);exit;
			if ($cek==0) {
				$this->M_nilai_prak->tambah($data_nilai_prak);
			//input nilai akhir
				$cek1 =$this->M_nilai_prak->get_nilai_akhir($data_eksperimen,$data_mhs);
				foreach ($cek1 as $key) {
					$pretest = $key->pretest;
					$laporan = $key->laporan;
				}
				//cari nilai akhir
				$sesi = $cari_sesi->sesi;
				$nilai_akhir = ($pretest+$laporan)/$sesi;
				//print_r($nilai_akhir);exit;
				//$sesi = $cari_sesi->sesi;
				//cari class dan id aturan prem1
				$clustering = $this->M_atr->cek_aturan_perm1($nilai_akhir,$sesi);
				foreach ($clustering as $key => $value) {
					$class_prem1 = $value->class;
					$id_prem1 = $value->id_atr_perm1;
				}
				
				$data_nilai_prak_akhir = array(
				'id_pelajaran' => $this->input->post('id_pelajaran'),
				'nim' => $this->input->post('nim'),
				'nilai' => $nilai_akhir,
				'id_atr_perm1' => $id_prem1
				);
				$cek_nilai =$this->M_nilai_prak->cek_nilai_akhir($data_eksperimen,$data_mhs);
				
					//jika cek nilai kosong maka buat baru
					if (empty($cek_nilai)){
						$id_p = $this->M_nilai_prak->tambah_akhir($data_nilai_prak_akhir);
						//print_r($input);exit;
						//tambah ke hasil akhir
						
						//get responsi
						$cek_responsi = $this->M_responsi->cek_nilai_responsi($data_eksperimen,$data_mhs);
						//print_r($cek_responsi);exit;
						if($cek_responsi == null){
							$responsi = 0;
							$id_responsi = '';
							$id_atr_prem2 = '';
							$class_prem2 = '';
						}else{
							foreach ($cek_responsi as $key) {
								//cek responsi jika kosong maka ubah ke 0
								$responsi = isset($key->nilai_responsi)? $key->nilai_responsi : '0';
								$id_responsi = isset($key->id_responsi)? $key->id_responsi : '';
								$id_atr_prem2 = isset($key->id_atr_perm2)? $key->id_atr_perm2 : '';
								$class_prem2 = isset($key->class)? $key->class : '';
							}
						}

						 $nilai_final = ($nilai_akhir+$responsi)/2;
						 //cari class dari nilai final
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
									'id_responsi' => $id_responsi,
									'id_prak_akhir' => $id_p,
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
									'id_responsi' => $id_responsi,
									'nilai_akhir' => $nilai_final,
									'id_aturan' => $id_aturan
								);
								$this->M_hasil_akhir->edit($data_nilai_prak);
							}
					}else{
						//jika ada update yang sudah ada
						foreach ($cek_nilai as $key) {
							$id = $key->id_prak_akhir;
						}
						$data_nilai_prak = array(
						'id_pelajaran' => $this->input->post('id_pelajaran'),
						'nim' => $this->input->post('nim'),
						'nilai' => $nilai_akhir,
						'id_prak_akhir' => $id,
						'id_atr_perm1' => $id_prem1
						);
						$this->M_nilai_prak->edit_akhir($data_nilai_prak);
												
						//get responsi
						$cek_responsi = $this->M_responsi->cek_nilai_responsi($data_eksperimen,$data_mhs);
						//print_r($cek_responsi);exit;
						if($cek_responsi == null){
							$responsi = 0;
							$id_responsi = '';
							$id_atr_prem2 = '';
							$class_prem2 = '';
						}else{
							foreach ($cek_responsi as $key) {
								//cek responsi jika kosong maka ubah ke 0
								$responsi = isset($key->nilai_responsi)? $key->nilai_responsi : '0';
								$id_responsi = isset($key->id_responsi)? $key->id_responsi : '';
								$id_atr_prem2 = isset($key->id_atr_prem2)? $key->id_atr_prem2 : '';
								$class_prem2 = isset($key->class)? $key->class : '';
							}
						}

						 $nilai_final = ($nilai_akhir+$responsi)/2;
						 //cari class dari nilai final
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
									'id_responsi' => $id_responsi,
									'id_prak_akhir' => $id,
									'nilai_akhir' => $nilai_final,
									'id_aturan'=>$id_aturan
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
									'id_responsi' => $id_responsi,
									'nilai_akhir' => $nilai_final,
									'id_aturan' => $id_aturan
								);
								$this->M_hasil_akhir->edit($data_nilai_prak);
							}
						}

				$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Berhasil menambah data</div>");
				redirect('back/nilai_prak/pilih_experimen?id='.$data_eksperimen);
			}
		else{
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Data sudah ada</div>");
			redirect('back/nilai_prak/pilih_experimen?id='.$data_eksperimen);
		}
	}

	public function edit($id) 
	{	
         $data['nilai_prak'] = $this->M_nilai_prak->get_cari_nilai($id);
         $data['user'] = $this->M_kelompok->get_user();
         $data['mhs'] = $this->M_nilai_prak->get_mahasiswa();
         $data['pel'] = $this->M_nilai_prak->get_pelajaran();

        $this->load->view('layout/back/header');
		$this->load->view('layout/back/sidebar');
		$this->load->view('back/nilai_prak/edit_nilai_prak',$data);
		$this->load->view('layout/back/footer');
	
        }

    public function edit_aksi()
	{
		//print_r($_POST);exit;
		$level= $this->session->userdata('level'); 
        if($level==1)
        {
	        $this->form_validation->set_rules('id_nilai_prak','id_nilai_prak','required');
			$this->form_validation->set_rules('pertemuan','pertemuan','required');
			$this->form_validation->set_rules('id_pelajaran','id_pelajaran','required');
			$this->form_validation->set_rules('pretest','pretest','required');
			$this->form_validation->set_rules('laporan','laporan','required');
			$this->form_validation->set_rules('nim','nim','required');
			$this->form_validation->set_rules('id_user','id_user','required');
			if($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Gagal merubah data</div>");
				redirect('back/nilai_prak');
			}
		else{
				$data_nilai_prak = array(
					'id_nilai_prak' => $this->input->post('id_nilai_prak'),
					'pertemuan' => $this->input->post('pertemuan'),
					'id_pelajaran' => $this->input->post('id_pelajaran'),
					'pretest' => $this->input->post('pretest'),
					'laporan' => $this->input->post('laporan'),
					'nim' => $this->input->post('nim'),
					'id_user' => $this->input->post('id_user')
					);
		//print_r($data_user);exit;
				$this->M_nilai_prak->edit($data_nilai_prak);
				$data_eksperimen = $this->input->post('id_pelajaran');
				$data_mhs = $this->input->post('nim');
				$cek_nilai =$this->M_nilai_prak->cek_nilai_akhir($data_eksperimen,$data_mhs);

				$cek1 =$this->M_nilai_prak->get_nilai_akhir($data_eksperimen,$data_mhs);
				foreach ($cek1 as $key) {
					$pretest = $key->pretest;
					$laporan = $key->laporan;
				}
				//cari nilai akhir
				$sesi = $cari_sesi->sesi;
				$nilai_akhir = ($pretest+$laporan)/$sesi;
				//print_r($nilai_akhir);exit;
				//$sesi = $cari_sesi->sesi;
				//cari class dan id aturan prem1
				$clustering = $this->M_atr->cek_aturan_perm1($nilai_akhir,$sesi);
				foreach ($clustering as $key => $value) {
					$class_prem1 = $value->class;
					$id_prem1 = $value->id_atr_perm1;
				}

				$data_nilai_prak_akhir = array(
					'id_pelajaran' => $this->input->post('id_pelajaran'),
					'nim' => $this->input->post('nim'),
					'id_user' => $this->input->post('id_user'),
					'nilai' => $nilai_akhir,
					'id_perm1' =>$id_prem1
					);
			//jika cek nilai kosong maka buat baru
				if (empty($cek_nilai)){
					$id_p = $this->M_nilai_prak->tambah_akhir($data_nilai_prak_akhir);
					//print_r($input);exit;
					//tambah ke hasil akhir
					$cek_hasil_akhir =$this->M_hasil_akhir->cek_hasil_akhir($data_eksperimen,$data_mhs);
					//get responsi
					$cek_responsi = $this->M_responsi->cek_nilai_responsi($data_eksperimen,$data_mhs);
					//print_r($cek_responsi);exit;
						if($cek_responsi == null){
							$responsi = 0;
							$id_responsi = '';
							$id_atr_prem2 = '';
							$class_prem2 = '';
						}else{
							foreach ($cek_responsi as $key) {
								//cek responsi jika kosong maka ubah ke 0
								$responsi = isset($key->nilai_responsi)? $key->nilai_responsi : '0';
								$id_responsi = isset($key->id_responsi)? $key->id_responsi : '';
								$id_atr_prem2 = isset($key->id_atr_prem2)? $key->id_atr_prem2 : '';
								$class_prem2 = isset($key->class)? $key->class : '';
							}
						}

					 $nilai_final = ($nilai_akhir+$responsi)/2;
						 //cari class dari nilai final
						 $atr_final = $this->M_atr->cek_aturan_final($class_prem1,$class_prem2);
						 foreach ($atr_final as $key => $value_final) {
						 	$id_aturan = isset($key->id_aturan)? $key->id_aturan : '';
						 }
					 //print_r($responsi);exit;
					//print_r($cek_hasil_akhir);exit;
						//jika cek nilai kosong maka buat baru
					if (empty($cek_hasil_akhir)){

						//get responsi
						//get nilai akhir
						//$this->db->insert_id();//get last id
						//(responsi+nilai akhir)/2
						//insert nilai akhir
						//$id_prak = $this->M_nilai_prak->tambah_akhir($data_nilai_prak);
						$data_nilai_akhir = array(
							'id_pelajaran' => $this->input->post('id_pelajaran'),
							'nim' => $this->input->post('nim'),
							'id_responsi' => $id_responsi,
							'id_prak_akhir' => $id_p,
							'nilai_akhir' => $nilai_final,
							'id_aturan' =>$id_aturan
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
							'id_responsi' => $id_responsi,
							'nilai_akhir' => $nilai_final,
							'id_aturan' => $id_aturan
						);
						$this->M_hasil_akhir->edit($data_nilai_prak);
					}
				}
			else{
					//jika ada update yang sudah ada
					foreach ($cek_nilai as $key) {
						$id = $key->id_prak_akhir;
					}
					$data_nilai_prak = array(
					'id_pelajaran' => $this->input->post('id_pelajaran'),
					'nim' => $this->input->post('nim'),
					'nilai' => $nilai_akhir,
					'id_prak_akhir' => $id,
					'nilai' => $nilai_akhir,
					'id_perm1' =>$id_prem1
					);
					$this->M_nilai_prak->edit_akhir($data_nilai_prak);
											$cek_hasil_akhir =$this->M_hasil_akhir->cek_hasil_akhir($data_eksperimen,$data_mhs);
					//get responsi
					$cek_responsi = $this->M_responsi->cek_nilai_responsi($data_eksperimen,$data_mhs);
					//print_r($cek_responsi);exit;
						if($cek_responsi == null){
							$responsi = 0;
							$id_responsi = '';
							$id_atr_prem2 = '';
							$class_prem2 = '';
						}else{
							foreach ($cek_responsi as $key) {
								//cek responsi jika kosong maka ubah ke 0
								$responsi = isset($key->nilai_responsi)? $key->nilai_responsi : '0';
								$id_responsi = isset($key->id_responsi)? $key->id_responsi : '';
								$id_atr_prem2 = isset($key->id_atr_prem2)? $key->id_atr_prem2 : '';
								$class_prem2 = isset($key->class)? $key->class : '';
							}
						}

					  $nilai_final = ($nilai_akhir+$responsi)/2;
						 //cari class dari nilai final
						 $atr_final = $this->M_atr->cek_aturan_final($class_prem1,$class_prem2);
						 foreach ($atr_final as $key => $value_final) {
						 	$id_aturan = isset($key->id_aturan)? $key->id_aturan : '';
						 }
					 //print_r($responsi);exit;
					//print_r($cek_hasil_akhir);exit;
						//jika cek nilai kosong maka buat baru
					if (empty($cek_hasil_akhir))
					{

						//get responsi
						//get nilai akhir
						//$this->db->insert_id();//get last id
						//(responsi+nilai akhir)/2
						//insert nilai akhir
						//$id_prak = $this->M_nilai_prak->tambah_akhir($data_nilai_prak);
						$data_nilai_akhir = array(
							'id_pelajaran' => $this->input->post('id_pelajaran'),
							'nim' => $this->input->post('nim'),
							'id_responsi' => $id_responsi,
							'id_prak_akhir' => $id,
							'nilai_akhir' => $nilai_final,
							'id_aturan' => $id_aturan
						);
						$this->M_hasil_akhir->tambah($data_nilai_akhir);
					}
				else{
						//jika ada update yang sudah ada
						foreach ($cek_hasil_akhir as $key) {
							$id_akhir = $key->id_hasil_akhir;
						}
						//print_r($id_akhir);exit;
						$data_nilai_prak = array(
							'id_hasil_akhir' => $id_akhir,
							'id_responsi' => $id_responsi,
							'nilai_akhir' => $nilai_final,
							'id_aturan' => $id_aturan
						);
						$this->M_hasil_akhir->edit($data_nilai_prak);
					}
				}
				$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i> Data berhasil diubah</div>");
				redirect('back/nilai_prak');
			}
		}
	else{
		$this->form_validation->set_rules('id_nilai_prak','id_nilai_prak','required');
		$this->form_validation->set_rules('pertemuan','pertemuan','required');
		$this->form_validation->set_rules('nim','nim','required');
		$this->form_validation->set_rules('id_user','id_user','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Gagal merubah data</div>");
			redirect('back/nilai_prak/edit');
		}else{
			$id= $this->session->userdata('id'); 
			$data_nilai_prak = array(
				'id_nilai_prak' => $this->input->post('id_nilai_prak'),
				'pertemuan' => $this->input->post('pertemuan'),
				'id_pelajaran' => $this->input->post('id_pelajaran'),
				'pretest' => $this->input->post('pretest'),
				'laporan' => $this->input->post('laporan'),
				'nim' => $this->input->post('nim'),
				'id_user' => $this->input->post('id_user')
				);
//print_r($data_user);exit;
			$this->M_nilai_prak->edit($data_nilai_prak);
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i> Data berhasil diubah </div>");
			redirect('back/nilai_prak');
			}
		}
	}

	public function delete($id) {
		
		$this->M_nilai_prak->delete($id);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
		redirect('back/nilai_prak');
	}
	public function get_nilai(){
		
		$nim=$this->input->post('nim');
		$idp=$this->input->post('idp');
	
		$data['nilai']=$this->M_nilai_prak->get_nilai($nim,$idp);
		$tampil = $this->load->view('back/nilai_prak/nilai_mhs',$data);
		//print_r($data);exit;
		return $tampil;
		//echo json_encode($data);
	}
}
