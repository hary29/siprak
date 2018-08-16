<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct()	{
		parent::__construct();
		$this->load->library('session');
		$this->simple_login->cek_login();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('M_user');
		$this->load->model('M_anjing');
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
		$kode = $this->M_anjing->get_last_id_anjing();
		// print_r($kode);exit;
        if ($kode) {
            $cut_code = substr($kode->kode_anjing, 2, 4);
            
            $k = $cut_code+1;//print_r($k);exit;
            if ($k == 1) {
                $kode1 = "A-1001";
            }else{
                $kode1 = "A-".$k;
            }
        }else{
            $kode1 = "A-1001";
        }
        $data['kode'] = $kode1;
		$data['data_user'] = $this->M_user->get_user();
		$this->load->view('layout/back/header');
		$this->load->view('layout/back/sidebar');
		$this->load->view('back/register/register_anjing',$data);
		$this->load->view('layout/back/footer');
	}

	public function register_user()
	{
		 $kode = $this->M_user->get_last_id();
		// print_r($kode);exit;
        if ($kode) {
            $cut_code = substr($kode->kode_pendaftaran, 3, 4);
            
            $k = $cut_code+1;//print_r($k);exit;
            if ($k == 1) {
                $kode1 = "PD-1001";
            }else{
                $kode1 = "PD-".$k;
            }
        }else{
            $kode1 = "PD-1001";
        }
        $data['kode'] = $kode1;
        $data['data_level'] = $this->M_user->get_level();
        $this->load->view('layout/back/header');
		$this->load->view('layout/back/sidebar');
		$this->load->view('back/register/register_user',$data);
		$this->load->view('layout/back/footer');
	}

	public function tambah_user()
	{
		//print_r($_POST);exit;
		$this->form_validation->set_rules('username','username','required');
		$this->form_validation->set_rules('password','password','required');
		$this->form_validation->set_rules('jenis_kelamin','jenis_kelamin','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Registrasi Gagal, Silahkan masukkan jenis kelamin username dan password</div>");
	redirect('back/register/register_user');
		}else{
			$data_cari = array(
			'username' => $this->input->post('username'),
			);
		$cek = $this->M_user->get_cari_username1($data_cari);
if ($cek > 0){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"><strong>error!</strong><br></i> Registrasi Gagal, username anda sudah ada</div>");
	redirect('back/register/register_user');
		}else{
	$data_user = array(
			'kode_pendaftaran' => $this->input->post('kode_pendaftaran'),
			'nama' => $this->input->post('nama'),
			'pass' => $this->input->post('password'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'id_level' => $this->input->post('id_level')
			);
//print_r($data_user);exit;
	$this->M_user->tambah($data_user);
	$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i> Registrasi Berhasil, Silahkan login Untuk melakukan pemeriksaan</div>");
	redirect('back/register/register_user');}}

	
	}
}
