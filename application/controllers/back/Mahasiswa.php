<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	public function __construct()	{
		parent::__construct();
		$this->load->library('session');
		$this->simple_login->cek_login();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('M_user');
		$this->load->model('M_mahasiswa');
	}


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($offset=0)
	{
		$jml = $this->db->get('tb_mahasiswa');

			//pengaturan pagination
			 $config['base_url'] = base_url().'back/mahasiswa/index';
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
			$data['data_mahasiswa'] = $this->M_mahasiswa->daftar_mahasiswa($config['per_page'], $offset);

			//print_r($data);exit;
			$this->load->view('layout/back/header');
			$this->load->view('layout/back/sidebar');
			$this->load->view('back/mahasiswa/semua_mahasiswa',$data);
			$this->load->view('layout/back/footer');
	}

	public function tambah() {
		//$data['data_user'] = $this->M_user->get_user();
		$data['kelompok'] = $this->M_mahasiswa->get_kelompok();

		$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/mahasiswa/tambah_mahasiswa',$data);
		$this->load->view('layout/back/footer',$data);
	
	}

	public function tambah_aksi(){
		$data_mahasiswa = array(
			'nim' => $this->input->post('nim'),
			'nama_mhs' => $this->input->post('nama_mhs'),
			'id_kelompok' => $this->input->post('id_kelompok')
			);

			//print_r($data_bobot);exit;
			//cek kesamaan data jika sama maka tidak di simpan
			$cek=$this->M_mahasiswa->get_cari_sama($data_mahasiswa);
			//print_r($cek);exit;
			if ($cek==0) {
		$this->M_mahasiswa->tambah($data_mahasiswa);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Berhasil menambah data</div>");
		redirect('back/mahasiswa');}
		else {
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> data sudah ada</div>");
			redirect('back/mahasiswa/tambah');
		}
	}

	public function edit($id) {	
         $data['data_mahasiswa'] = $this->M_mahasiswa->get_cari_mahasiswa($id);
         $data['kelompok'] = $this->M_mahasiswa->get_kelompok();

        $this->load->view('layout/back/header');
		$this->load->view('layout/back/sidebar');
        $this->load->view('back/mahasiswa/edit_mahasiswa',$data);
       	$this->load->view('layout/back/footer');
		
        }

    public function edit_aksi()
	{
		//print_r($_POST);exit;
		$level= $this->session->userdata('level'); 
                                if($level==1){
		$this->form_validation->set_rules('nim','nim','required');
		$this->form_validation->set_rules('nama_mhs','nama_mhs','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Gagal mengedit data</div>");
	redirect('back/mahasiswa');
		}else{
	$data_mahasiswa = array(
			'nim' => $this->input->post('nim'),
			'nama_mhs' => $this->input->post('nama_mhs'),
			'id_kelompok' => $this->input->post('id_kelompok')
			);
//print_r($data_user);exit;
	$this->M_mahasiswa->edit($data_mahasiswa);
	$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i> Data berhasil diubah</div>");
	redirect('back/mahasiswa');}}
	else {
		//$this->form_validation->set_rules('id_user','id_user','required');
		$this->form_validation->set_rules('nim','nim','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Gagal mengedit data</div>");
	redirect('back/mahasiswa/edit');
		}else{
			$id= $this->session->userdata('id'); 
	$data_mahasiswa = array(
			'nim' => $this->input->post('nim'),
			'nama_mhs' => $this->input->post('nama_mhs'),
			'id_kelompok' => $this->input->post('id_kelompok')
			);
//print_r($data_user);exit;
	$this->M_mahasiswa->edit($data_mahasiswa);
	$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i> Edit User Berhasil</div>");
	redirect('back/mahasiswa');}
	}
	}

	public function delete($id) {
		$level= $this->session->userdata('level'); 
                                if($level==1){
		$this->M_mahasiswa->delete($id);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
		redirect('back/mahasiswa');
	}else {
		$this->M_anjing->delete($id);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
		redirect('back/anjing/anjing_user');
	}
	}
}
