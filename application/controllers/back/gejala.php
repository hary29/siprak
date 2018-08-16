<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gejala extends CI_Controller {
	
	public function __construct()	{
		parent::__construct();
		$this->load->model('m_gejala');
		$this->load->helper('form');
		$this->load->library('pagination');
	}

	// Menampilkan seluruh data
	public function index($offset=0) {


		$jml = $this->db->get('tb_gejala');

		$config['base_url'] = base_url().'/back/gejala/index';
   		$config['total_rows'] = $jml->num_rows();
   		$config['per_page'] = 10;
   		$config['uri_segment'] = 4;
		$config['full_tag_open'] = '<ul class="pagination pagination-sm" style="position:relative; top:-25px;">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Prev';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

   		$this->pagination->initialize($config);
   		$this->uri->segment(4) ? $this->uri->segment(4) : 0;

   		$data['halaman'] = $this->pagination->create_links();
   		$data['offset'] = $offset;
   		$data['gejala'] = $this->m_gejala->daftar_gejala($config['per_page'], $offset);
   		$data['username'] = $this->session->userdata('username');
   		$data['id_user'] = $this->session->userdata('id_user');

		$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/gejala/data_gejala',$data);
		$this->load->view('layout/back/footer',$data);
		
	}

	// Funfsi pencarian data
	public function cari() {
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data_cari = $this->input->post('cari');
		$data['search'] = $this->m_gejala->get_cari($data_cari);
       	if($data['search']==null) {
       		echo $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data yang dicari tidak ditemukan</div>");
       		redirect('admin/gejala');
       	}
       	else
       	{
       	$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/penyakit/edit_penyakit',$data);
		$this->load->view('layout/back/footer',$data);
       	} 
	}
	
	// Menampilkan halaman tambah
	public function tambah() {
		$data['kode_gejala'] = $this->m_gejala->buat_kode();
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');

		$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/gejala/tambah_gejala',$data);
		$this->load->view('layout/back/footer',$data);
	
	}

	// Fungsi proses tambah
	public function tambah_aksi(){
		$data_gejala = array(
			'id_gejala' => $this->input->post('id_gejala'),
			'id_user' => $this->input->post('id_user'),
			'kode_gejala' => $this->input->post('kode_gejala'),
			'gejala' => $this->input->post('gejala')
			);
		$this->m_gejala->tambah($data_gejala);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Berhasil menambah data</div>");
		redirect('back/gejala');
	}
	
	// Menampilkan halaman edit
	public function edit($id) {	
        $data['data_gejala'] = $this->m_gejala->get_id($id);
        $data['username'] = $this->session->userdata('username');
        $data['id_user'] = $this->session->userdata('id_user');

        $this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/gejala/edit_gejala',$data);
		$this->load->view('layout/back/footer',$data);

	}

	// Fungsi proses edit
	public function edit_aksi($id) {
    	$data_gejala = array(
    		'id_gejala' => $this->input->post('id_gejala'),
			'id_user' => $this->input->post('id_user'),
			'kode_gejala' => $this->input->post('kode_gejala'),
			'gejala' => $this->input->post('gejala')
			);

          $this->m_gejala->edit($data_gejala);
          $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate</div>"); 
          redirect('back/gejala');
    }

    // Menampilkan detail data
    public function detail($id) {	
        $data['gejala'] = $this->m_gejalas->get_id($id);
        $data['username'] = $this->session->userdata('username');
        $data['id_user'] = $this->session->userdata('id_user');

        $this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/gejala/detail_gejala',$data);
		$this->load->view('layout/back/footer',$data);
        }
	
	// Menghapus data
	public function delete($id) {
		$this->m_gejala->delete($id);
		redirect('back/gejala');
	}

}