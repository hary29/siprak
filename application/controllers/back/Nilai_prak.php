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
		$this->load->view('back/nilai_prak/tambah_nilai_prak',$data);
		$this->load->view('layout/back/footer',$data);
	
	}

	public function tambah_aksi(){
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
			$cek=$this->M_nilai_prak->get_cari_sama($data_nilai_prak);
			//print_r($cek);exit;
			if ($cek==0) {
		$this->M_nilai_prak->tambah($data_nilai_prak);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Berhasil menambah data</div>");
		redirect('back/nilai_prak');}
		else {
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Data sudah ada</div>");
			redirect('back/nilai_prak/tambah');
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
                                if($level==1){
        $this->form_validation->set_rules('id_nilai_prak','id_nilai_prak','required');
		$this->form_validation->set_rules('pertemuan','pertemuan','required');
		$this->form_validation->set_rules('id_pelajaran','id_pelajaran','required');
		$this->form_validation->set_rules('pretest','pretest','required');
		$this->form_validation->set_rules('laporan','laporan','required');
		$this->form_validation->set_rules('nim','nim','required');
		$this->form_validation->set_rules('id_user','id_user','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Gagal merubah data</div>");
	redirect('back/nilai_prak');
		}else{
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
	$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i> Data berhasil diubah</div>");
	redirect('back/nilai_prak');}}
	else {
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
	redirect('back/nilai_prak');}
	}
	}

	public function delete($id) {
		
		$this->M_nilai_prak->delete($id);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
		redirect('back/nilai_prak');
	}
}
