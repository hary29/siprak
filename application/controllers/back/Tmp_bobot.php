<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tmp_bobot extends CI_Controller {
	public function __construct()	{
		parent::__construct();
		$this->load->library('session');
		$this->simple_login->cek_login();
		$this->load->model('M_tmp_bobot');
		$this->load->model('M_bobot');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index($offset=0){
		$jml = $this->db->get('tb_bobot');

		$config['base_url'] = base_url().'/back/tmp_bobot/index';
   		$config['total_rows'] = $jml->num_rows();
   		$config['per_page'] = 7;
   		$config['uri_segment'] = 2;
		
   		$config['full_tag_open'] = "<ul class='pagination pagination-sm' style='position:relative; top:-25px;'>";
      	$config['full_tag_close'] ="</ul>";
   		$config['num_tag_open'] = "<li>";
   		$config['num_tag_close'] = "</li>";
   		$config['cur_tag_open'] = "<li><a href='0'>";
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
   		$this->uri->segment(2) ? $this->uri->segment(2) : 0;
   		$data['halaman'] = $this->pagination->create_links();
   		$data['offset'] = $offset;
   		$data['bobot'] = $this->M_tmp_bobot->daftar_bobot($config['per_page'], $offset);
   		//print_r($data['bobot']);exit;
   		$data['penyakit'] = $this->M_tmp_bobot->get_pny();
        $data['gejala'] = $this->M_tmp_bobot->get_gj();
   		$data['username'] = $this->session->userdata('username');
   		$data['id_user'] = $this->session->userdata('id_user');
		
		$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/tmp_bobot/tambah_tmp_bobot',$data);
		$this->load->view('layout/back/footer',$data);
	}

	public function tambah_to_bobot() {
		$data= $this->M_tmp_bobot->daftar_bobot_tmp();
		//print_r($data);exit;
		foreach($data as $list)
		{
			$data_bobot = array(
			//'id_bobot' => $this->input->post('id_bobot'),
			'id_penyakit' => $list['id_penyakit'],
			'id_gejala' => $list['id_gejala'],
			'bobot' => $list['bobot']
			);
			//print_r($data_bobot);exit;
			//cek kesamaan data jika sama maka tidak di simpan
			$cek= $this->M_tmp_bobot->get_cari_sama($data_bobot);
			//print_r($cek);exit;
			if ($cek == 0) {
				$this->M_bobot->tambah($data_bobot);
			}
			
		}
		 $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil ditambahkan</div>"); 
		 $this->M_tmp_bobot->hapustmp();
          redirect('back/bobot');
	}

	public function tambah_aksi(){
		$data_bobot = array(
			'id_tmp' => $this->input->post('id_tmp'),
			'id_penyakit' => $this->input->post('id_penyakit'),
			'id_gejala' => $this->input->post('id_gejala'),
			'bobot' => $this->input->post('bobot')
			);

		$this->M_tmp_bobot->tambah($data_bobot);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Berhasil menambah data sementara</div>");
		redirect('back/tmp_bobot');
	}

	
	public function delete($id) {
		$this->M_tmp_bobot->delete($id);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>"); 
		redirect('back/tmp_bobot');
	}
}
