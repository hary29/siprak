<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sub_eksperimen extends CI_Controller {
	public function __construct()	{
		parent::__construct();
		$this->load->library('session');
		$this->simple_login->cek_login();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('M_eksperimen');
	}

	public function index($offset=0)
	{
		$jml = $this->db->get('tb_sub_pelajaran');

			//pengaturan pagination
			 $config['base_url'] = base_url().'back/sub_eksperimen/index';
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
			$data['data_sub'] = $this->M_eksperimen->daftar_sub($config['per_page'], $offset);

			//print_r($data);exit;
			$this->load->view('layout/back/header');
			$this->load->view('layout/back/sidebar');
			$this->load->view('back/eksperimen/semua_sub',$data);
			$this->load->view('layout/back/footer');
	}

	public function tambah() {
		$test= $this->M_kurikulum->cek_kurikulum();
			//print_r($test);exit;
		if ($test == 0)
		{
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i>kurikulum sudah ada yang aktif, silahkan edit kurikulum terlebih dahulu</div>");
			redirect('back/kurikulum/index');
		}

		$this->load->view('layout/back/header');
		$this->load->view('layout/back/sidebar');
		$this->load->view('back/kurikulum/tambah_kurikulum');
		$this->load->view('layout/back/footer');
	
	}

	public function tambah_aksi(){
		$test= $this->M_kurikulum->cek_kurikulum();
			//print_r($test);exit;
		if ($test == 0)
		{
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i>kurikulum sudah ada yang aktif, silahkan edit kurikulum terlebih dahulu</div>");
			redirect('back/kurikulum/index');
		}

		$data_kurikulum = array(
			'id_kurikulum' => $this->input->post('id_kurikulum'),
			'semester' => $this->input->post('semester'),
			'tahun' => $this->input->post('tahun'),
			'flag' => $this->input->post('flag')
			);

			//print_r($data_bobot);exit;
			//cek kesamaan data jika sama maka tidak di simpan
			$cek=$this->M_kurikulum->get_cari_sama($data_kurikulum);
			//print_r($cek);exit;
			if ($cek==0) {
		$this->M_kurikulum->tambah($data_kurikulum);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Berhasil menambah data</div>");
		redirect('back/kurikulum');}
		else {
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Data sudah ada</div>");
			redirect('back/kurikulum/tambah');
		}
	}

	public function edit($id) 
	{	
         $data['sub'] = $this->M_eksperimen->get_id_sub($id);
        
        $this->load->view('layout/back/header');
		$this->load->view('layout/back/sidebar');
		$this->load->view('back/eksperimen/edit_sub',$data);
		$this->load->view('layout/back/footer');
	
        }

    public function edit_aksi()
	{
		//print_r($_POST);exit;
		$data_sub = array(
			'id_sub' => $this->input->post('id_sub'),
			'id_pelajaran' => $this->input->post('id_pelajaran'),
			'nama_sub_pelajaran' => $this->input->post('nama_sub_pelajaran')
			);
		$test= $this->M_eksperimen->get_cari_sama_sub($data_sub);
			//print_r($test);exit;
		if ($test == 0)
		{
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i>kurikulum sudah ada yang aktif, silahkan edit kurikulum terlebih dahulu</div>");
			redirect('back/sub_eksperimen/index');
		}
	else{
		$this->form_validation->set_rules('id_sub','id_sub','required');
		$this->form_validation->set_rules('id_pelajaran','id_pelajaran','required');
		$this->form_validation->set_rules('nama_sub_pelajaran','nama_sub_pelajaran','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> Gagal merubah data</div>");
	redirect('back/sub_eksperimen');
		}else{
			//$id= $this->session->userdata('id'); 
		
//print_r($data_user);exit;
	$this->M_eksperimen->edit_sub($data_sub);
	$this->session->set_flashdata('sukses', "<div class=\"alert alert-success\" id=\"alert\"><i class=\"\"></i> Data berhasil diubah</div>");
	redirect('back/sub_eksperimen');}
	}
	}

	public function delete($id) {
		
		$this->M_eksperimen->delete_sub($id);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
		redirect('back/kurikulum');
	}
}
