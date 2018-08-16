<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_back extends CI_Controller {
	public function __construct()	{
		parent::__construct();
		$this->load->library('session');
		$this->simple_login->cek_login();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('M_user');
		$this->load->model('M_mahasiswa');
		$this->load->model('M_eksperimen');
		$this->load->model('M_kelompok');
		$this->load->model('M_jadwal');
		// $this->load->model('m_gejala');
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
		$level= $this->session->userdata('level'); 
                                if($level==1){
		$data['user']=$this->M_user->jumlah_user();
		$data['mhs']=$this->M_mahasiswa->jumlah_mahasiswa();
		$data['eksperimen']=$this->M_eksperimen->jumlah_eksperimen();
		$data['kelompok']=$this->M_kelompok->jumlah_kelompok();
		$data['jadwal']=$this->M_jadwal->daftar_jadwal2();
		$data['kel']=$this->M_kelompok->daftar_kelompok2();
		
	}
	else if($level==2){
		// $data['user']=$this->M_user->jumlah_user();
		// $data['mhs']=$this->M_mahasiswa->jumlah_mahasiswa();
		// $data['eksperimen']=$this->M_eksperimen->jumlah_eksperimen();
		$data['kelompok']=$this->M_kelompok->jumlah_kelompok();
		$data['jadwal']=$this->M_jadwal->daftar_jadwal2();
		$data['kel']=$this->M_kelompok->daftar_kelompok2();
	}
	else if($level==3){
		$data['user']=$this->M_user->jumlah_user();
		$data['mhs']=$this->M_mahasiswa->jumlah_mahasiswa();
		$data['eksperimen']=$this->M_eksperimen->jumlah_eksperimen();
		$data['kelompok']=$this->M_kelompok->jumlah_kelompok();
		$data['jadwal']=$this->M_jadwal->daftar_jadwal2();
		$data['kel']=$this->M_kelompok->daftar_kelompok2();
	}
	else if($level==4){
		// $data['user']=$this->M_user->jumlah_user();
		// $data['mhs']=$this->M_mahasiswa->jumlah_mahasiswa();
		// $data['eksperimen']=$this->M_eksperimen->jumlah_eksperimen();
		$data['kelompok']=$this->M_kelompok->jumlah_kelompok();
		$data['jadwal']=$this->M_jadwal->daftar_jadwal2();
		$data['kel']=$this->M_kelompok->daftar_kelompok2();
	}

		$this->load->view('layout/back/header');
		$this->load->view('layout/back/sidebar');
		$this->load->view('back/homeback',$data);
		$this->load->view('layout/back/footer');
	}
}
