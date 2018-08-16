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

		$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/eksperimen/tambah_data_eksperimen',$data);
		$this->load->view('layout/back/footer',$data);
	
	}

	public function tambah_aksi(){
		$data_eksperimen = array(
			'id_pelajaran' => $this->input->post('id_pelajaran'),
			'id_kurikulum' => $this->input->post('id_kurikulum'),
			'nama_pelajaran' => $this->input->post('nama_pelajaran')
			);

			//print_r($data_bobot);exit;
			//cek kesamaan data jika sama maka tidak di simpan
			$cek=$this->M_eksperimen->get_cari_sama($data_eksperimen);
			//print_r($cek);exit;
			if ($cek==0) {
		$this->M_eksperimen->tambah($data_eksperimen);
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
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Gagal merubah data kelompok</div>");
	redirect('back/eksperimen');
		}else{
	$data_eksperimen = array(
			'id_pelajaran' => $this->input->post('id_pelajaran'),
			'id_kurikulum' => $this->input->post('id_kurikulum'),
			'nama_pelajaran' => $this->input->post('nama_pelajaran')
			);
//print_r($data_user);exit;
	$this->M_eksperimen->edit($data_eksperimen);
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
			'nama_pelajaran' => $this->input->post('nama_pelajaran')
			);
//print_r($data_user);exit;
	$this->M_eksperimen->edit($data_kelompok);
	$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i> Data berhasil diubah</div>");
	redirect('back/eksperimen');}
	}
	}

	public function delete($id) {
		
		$this->M_eksperimen->delete($id);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
		redirect('back/eksperimen');
	}
}
