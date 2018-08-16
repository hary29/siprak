<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Responsi extends CI_Controller {
	public function __construct()	{
		parent::__construct();
		$this->load->library('session');
		$this->simple_login->cek_login();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('M_user');
		$this->load->model('M_responsi');
	}

	public function index($offset=0)
	{
		$jml = $this->db->get('tb_responsi');

			//pengaturan pagination
			 $config['base_url'] = base_url().'back/responsi/index';
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
			$data['data_responsi'] = $this->M_responsi->daftar_responsi($config['per_page'], $offset);

			//print_r($data);exit;
			$this->load->view('layout/back/header');
			$this->load->view('layout/back/sidebar');
			$this->load->view('back/responsi/semua_responsi',$data);
			$this->load->view('layout/back/footer');
	}

	public function tambah() {
		$data['user'] = $this->M_responsi->get_user();
		$data['mhs'] = $this->M_responsi->get_mahasiswa();
		$data['prem2'] = $this->M_responsi->get_perm2();
		$data['kur'] = $this->M_responsi->get_kurikulum();

		$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/responsi/tambah_responsi',$data);
		$this->load->view('layout/back/footer',$data);
	
	}

	public function tambah_aksi(){
		$data_responsi = array(
			'id_responsi' => $this->input->post('id_responsi'),
			'nilai_responsi' => $this->input->post('nilai_responsi'),
			'nim' => $this->input->post('nim'),
			'id_atr_perm2' => $this->input->post('id_atr_perm2'),
			'id_kurikulum' => $this->input->post('id_kurikulum'),
			'id_user' => $this->input->post('id_user')
			);

			//print_r($data_bobot);exit;
			//cek kesamaan data jika sama maka tidak di simpan
			$cek=$this->M_responsi->get_cari_sama($data_responsi);
			//print_r($cek);exit;
			if ($cek==0) {
		$this->M_responsi->tambah($data_responsi);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Berhasil menambah data</div>");
		redirect('back/responsi');}
		else {
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Data sudah ada</div>");
			redirect('back/responsi/tambah');
		}
	}

	public function edit($id) 
	{	
         $data['responsi'] = $this->M_responsi->get_cari_nilai($id);
         $data['user'] = $this->M_responsi->get_user();
         $data['mhs'] = $this->M_responsi->get_mahasiswa();
         //$data['pel'] = $this->M_responsi->get_pelajaran();
         $data['perm'] = $this->M_responsi->get_perm2();
         $data['kur'] = $this->M_responsi->get_kurikulum();

        $this->load->view('layout/back/header');
		$this->load->view('layout/back/sidebar');
		$this->load->view('back/responsi/edit_responsi',$data);
		$this->load->view('layout/back/footer');
	
        }

    public function edit_aksi()
	{
		//print_r($_POST);exit;
		$level= $this->session->userdata('level'); 
                                if($level==1){
        $this->form_validation->set_rules('id_responsi','id_responsi','required');
		$this->form_validation->set_rules('nilai_responsi','nilai_responsi','required');
		$this->form_validation->set_rules('nim','nim','required');
		$this->form_validation->set_rules('id_atr_perm2','id_atr_perm2','required');
		//$this->form_validation->set_rules('id_pelajaran','id_pelajaran','required');
		$this->form_validation->set_rules('id_kurikulum','id_kurikulum','required');
		$this->form_validation->set_rules('id_user','id_user','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Gagal merubah</div>");
	redirect('back/responsi');
		}else{
	$data_responsi = array(
			'id_responsi' => $this->input->post('id_responsi'),
			'nilai_responsi' => $this->input->post('nilai_responsi'),
			'nim' => $this->input->post('nim'),
			'id_atr_perm2' => $this->input->post('id_atr_perm2'),
			'id_kurikulum' => $this->input->post('id_kurikulum'),
			'id_user' => $this->input->post('id_user')
			);
//print_r($data_user);exit;
	$this->M_responsi->edit($data_responsi);
	$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i> Data berhasil diubah</div>");
	redirect('back/responsi');}}
	else {
		//$this->form_validation->set_rules('id_responsi','id_responsi','required');
		$this->form_validation->set_rules('nilai_responsi','pertemuan','required');
		//$this->form_validation->set_rules('nim','nim','required');
		$this->form_validation->set_rules('id_atr_perm2','id_atr_perm2','required');
		//$this->form_validation->set_rules('id_pelajaran','id_pelajaran','required');
		$this->form_validation->set_rules('id_kurikulum','id_kurikulum','required');
		$this->form_validation->set_rules('id_user','id_user','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Gagal merubah data</div>");
	redirect('back/responsi/edit');
		}else{
			$id= $this->session->userdata('id'); 
		$data_responsi = array(
			'id_responsi' => $this->input->post('id_responsi'),
			'nilai_responsi' => $this->input->post('nilai_responsi'),
			'nim' => $this->input->post('nim'),
			'id_atr_perm2' => $this->input->post('id_atr_perm2'),
			'id_kurikulum' => $this->input->post('id_kurikulum'),
			'id_user' => $this->input->post('id_user')
			);
//print_r($data_user);exit;
	$this->M_responsi->edit($data_responsi);
	$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i> Data berhasil diubah </div>");
	redirect('back/responsi');}
	}
	}

	public function delete($id) {
		
		$this->M_responsi->delete($id);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
		redirect('back/responsi');
	}
}
