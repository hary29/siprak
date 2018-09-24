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
	public function index($offset=0)
	{
		$jml = $this->db->get('tb_jadwal');

			//pengaturan pagination
			 $config['base_url'] = base_url().'back/home_back/index';
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
			$data['jadwal'] = $this->M_jadwal->daftar_jadwal2($config['per_page'], $offset);
			
		$level= $this->session->userdata('level'); 
                                if($level==1){

		
		$data['user']=$this->M_user->jumlah_user();
		$data['mhs']=$this->M_mahasiswa->jumlah_mahasiswa();
		$data['eksperimen']=$this->M_eksperimen->jumlah_eksperimen();
		$data['kelompok']=$this->M_kelompok->jumlah_kelompok();
		//$data['jadwal']=$this->M_jadwal->daftar_jadwal2();
		$data['kel']=$this->M_kelompok->daftar_kelompok2();
		
	}
	else if($level==2){
		// $data['user']=$this->M_user->jumlah_user();
		// $data['mhs']=$this->M_mahasiswa->jumlah_mahasiswa();
		// $data['eksperimen']=$this->M_eksperimen->jumlah_eksperimen();
		$data['kelompok']=$this->M_kelompok->jumlah_kelompok();
		$data['jadwal'] = $this->M_jadwal->daftar_jadwal2($config['per_page'], $offset);
		$data['kel']=$this->M_kelompok->daftar_kelompok2();
	}
	else if($level==3){
		$data['user']=$this->M_user->jumlah_user();
		$data['mhs']=$this->M_mahasiswa->jumlah_mahasiswa();
		$data['eksperimen']=$this->M_eksperimen->jumlah_eksperimen();
		$data['kelompok']=$this->M_kelompok->jumlah_kelompok();
		$data['jadwal'] = $this->M_jadwal->daftar_jadwal2($config['per_page'], $offset);
		$data['kel']=$this->M_kelompok->daftar_kelompok2();
	}
	else if($level==4){
		// $data['user']=$this->M_user->jumlah_user();
		// $data['mhs']=$this->M_mahasiswa->jumlah_mahasiswa();
		// $data['eksperimen']=$this->M_eksperimen->jumlah_eksperimen();
		$id_user= $this->session->userdata('id'); 
		$data['kelompok']=$this->M_kelompok->jumlah_kelompok();
		$data['jadwal'] = $this->M_jadwal->daftar_jadwal3($config['per_page'], $offset, $id_user);
		$data['kel']=$this->M_kelompok->daftar_kelompok3($id_user);
	}

		$this->load->view('layout/back/header');
		$this->load->view('layout/back/sidebar');
		$this->load->view('back/homeback',$data);
		$this->load->view('layout/back/footer');
	}
}
