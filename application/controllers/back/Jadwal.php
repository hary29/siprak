<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal extends CI_Controller {
	public function __construct()	{
		parent::__construct();
		$this->load->library('session');
		$this->simple_login->cek_login();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('M_jadwal');
	}

	public function index($offset=0)
	{
		$jml = $this->db->get('tb_jadwal');

			//pengaturan pagination
			 $config['base_url'] = base_url().'back/jadwal/index';
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
			$data['jadwal'] = $this->M_jadwal->daftar_jadwal($config['per_page'], $offset);

			//print_r($data);exit;
			$this->load->view('layout/back/header');
			$this->load->view('layout/back/sidebar');
			$this->load->view('back/jadwal/semua_jadwal',$data);
			$this->load->view('layout/back/footer');
	}

	public function tambah() {
		$data['kelompok'] = $this->M_jadwal->get_kelompok();
		$data['pelajaran'] = $this->M_jadwal->get_pelajaran();
		$data['user'] = $this->M_jadwal->get_user();

		$this->load->view('layout/back/header');
		$this->load->view('layout/back/sidebar');
		$this->load->view('back/jadwal/tambah_jadwal',$data);
		$this->load->view('layout/back/footer');
	
	}

	public function tambah_aksi(){
		$data_jadwal = array(
			'id_jadwal' => $this->input->post('id_jadwal'),
			'tgl' => $this->input->post('tgl'),
			'jam' => $this->input->post('jam'),
			'id_kelompok' => $this->input->post('id_kelompok'),
			'id_pelajaran' => $this->input->post('id_pelajaran'),
			'id_user' => $this->input->post('id_user')
			);

			//print_r($data_bobot);exit;
			//cek kesamaan data jika sama maka tidak di simpan
			$cek=$this->M_jadwal->get_cari_sama($data_jadwal);
			//print_r($cek);exit;
			if ($cek==0) {
		$this->M_jadwal->tambah($data_jadwal);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Berhasil menambah data</div>");
		redirect('back/jadwal');}
		else {
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Data sudah ada</div>");
			redirect('back/jadwal/tambah');
		}
	}

	public function edit($id) 
	{	
        $data['jadwal'] = $this->M_jadwal->get_id($id);
        $data['kelompok'] = $this->M_jadwal->get_kelompok();
		$data['pelajaran'] = $this->M_jadwal->get_pelajaran();
		$data['user'] = $this->M_jadwal->get_user();

        $this->load->view('layout/back/header');
		$this->load->view('layout/back/sidebar');
		$this->load->view('back/jadwal/edit_jadwal',$data);
		$this->load->view('layout/back/footer');
	
        }

    public function edit_aksi()
	{
		//print_r($_POST);exit;
		$level= $this->session->userdata('level'); 
                                if($level==1){
		$this->form_validation->set_rules('tgl','tgl','required');
		$this->form_validation->set_rules('jam','jam','required');
		$this->form_validation->set_rules('id_kelompok','id_kelompok','required');
		$this->form_validation->set_rules('id_pelajaran','id_pelajaran','required');
		$this->form_validation->set_rules('id_user','id_user','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Gagal merubah data</div>");
	redirect('back/jadwal');
		}else{
	$data_jadwal = array(
			'id_jadwal' => $this->input->post('id_jadwal'),
			'tgl' => $this->input->post('tgl'),
			'jam' => $this->input->post('jam'),
			'id_kelompok' => $this->input->post('id_kelompok'),
			'id_pelajaran' => $this->input->post('id_pelajaran'),
			'id_user' => $this->input->post('id_user')
			);
//print_r($data_user);exit;
	$this->M_jadwal->edit($data_jadwal);
	$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i> Data berhasil diubah</div>");
	redirect('back/jadwal');}}
	else {
		$this->form_validation->set_rules('jam','jam','required');
		$this->form_validation->set_rules('id_kelompok','id_kelompok','required');
		$this->form_validation->set_rules('id_pelajaran','id_pelajaran','required');
		$this->form_validation->set_rules('id_user','id_user','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Gagal merubah data</div>");
	redirect('back/jadwal/edit');
		}else{
			$id= $this->session->userdata('id'); 
		$data_jadwal = array(
			'id_jadwal' => $this->input->post('id_jadwal'),
			'tgl' => $this->input->post('tgl'),
			'jam' => $this->input->post('jam'),
			'id_kelompok' => $this->input->post('id_kelompok'),
			'id_pelajaran' => $this->input->post('id_pelajaran'),
			'id_user' => $this->input->post('id_user')
			);
//print_r($data_user);exit;
	$this->M_jadwal->edit($data_jadwal);
	$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i> Data berhasil diubah</div>");
	redirect('back/jadwal');}
	}
	}

	public function delete($id) {
		
		$this->M_jadwal->delete($id);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
		redirect('back/jadwal');
	}
}
