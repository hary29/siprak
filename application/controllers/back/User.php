<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()	{
		parent::__construct();
		$this->load->library('session');
		$this->simple_login->cek_login();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('M_user');
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
	public function index()
	{
		$data_cari= $this->session->userdata('username'); 
		$data['data_user'] = $this->M_user->get_cari_username($data_cari);
		//print_r($data);exit;
		$this->load->view('layout/back/header');
		$this->load->view('layout/back/sidebar');
		$this->load->view('back/user/user_profile',$data);
		$this->load->view('layout/back/footer');
	}

	public function tambah() {
		$data['data_user'] = $this->M_user->get_user();
		$data['data_level'] = $this->M_user->get_level();

		$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/user/tambah_user',$data);
		$this->load->view('layout/back/footer',$data);
	
	}

	public function tambah_aksi(){
		//print_r($_POST);exit;
		$this->form_validation->set_rules('username','username','required');
		$this->form_validation->set_rules('password','password','required');
		$this->form_validation->set_rules('jenis_kelamin','jenis_kelamin','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Registrasi Gagal, Silahkan masukkan jenis kelamin username dan password</div>");
		redirect('back/user/tambah');
		}else{
			$data_cari = array(
			'username' => $this->input->post('username'),
			);
		$cek = $this->M_user->get_cari_username1($data_cari);
		if ($cek > 0){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"><strong>error!</strong><br></i> Registrasi Gagal, username anda sudah ada</div>");
		redirect('back/user/tambah');
		}else{
		$data_user = array(
			'nama' => $this->input->post('nama'),
			'pass' => $this->input->post('password'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'id_level' => $this->input->post('id_level')
			);
		//print_r($data_user);exit;
		$this->M_user->tambah($data_user);
		$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i>Berhasil menambah data user </div>");
		redirect('back/user/semua_user');}}
	}

	public function edit($id) {	

		 //$id= $this->session->userdata('id'); 
         $data['data_user'] = $this->M_user->get_id($id);
         $data['data_level'] = $this->M_user->get_level();

        $this->load->view('layout/back/header');
		$this->load->view('layout/back/sidebar');
        $this->load->view('back/user/edit_user',$data);
       	$this->load->view('layout/back/footer');
		
        }
        public function edit_aksi()
	{
		//print_r($_POST);exit;
		$level= $this->session->userdata('level'); 
                                if($level==1){
		$this->form_validation->set_rules('username','username','required');
		$this->form_validation->set_rules('password','password','required');
		$this->form_validation->set_rules('jenis_kelamin','jenis_kelamin','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Edit Data Gagal, Silahkan masukkan jenis kelamin username dan password</div>");
	redirect('back/user/edit');
		}else{
	$data_user = array(
			'id_user' => $this->input->post('id_user'),
			'id_level' => $this->input->post('id_level'),
			'nama' => $this->input->post('nama'),
			'pass' => $this->input->post('password'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			);
//print_r($data_user);exit;
	$this->M_user->edit($data_user);
	$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i> Data User Berhasil Diubah</div>");
	redirect('back/user/semua_user');}}
	
	}

	public function semua_user($offset=0)
	{
			$jml = $this->db->get('tb_user');

			//pengaturan pagination
			 $config['base_url'] = base_url().'back/user/semua_user';
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
			$data['data_user'] = $this->M_user->daftar_user($config['per_page'], $offset);
			$this->load->view('layout/back/header');
			$this->load->view('layout/back/sidebar');
			$this->load->view('back/user/semua_user',$data);
			$this->load->view('layout/back/footer');
	}

	public function delete($id) {
		$this->M_user->delete($id);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
		redirect('back/user/semua_user');
	}
}
