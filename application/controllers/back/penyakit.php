<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penyakit extends CI_Controller {
	public function __construct()	{
		parent::__construct();
		$this->load->library('session');
		$this->simple_login->cek_login();
		$this->load->model('m_penyakit');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index($offset=0){
		$jml = $this->db->get('tb_penyakit');

		$config['base_url'] = base_url().'/back/penyakit/index';
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
   		$data['penyakit'] = $this->m_penyakit->daftar_penyakit($config['per_page'], $offset);
   		$data['username'] = $this->session->userdata('username');
   		$data['id_user'] = $this->session->userdata('id_user');
		
		$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/penyakit/data_penyakit',$data);
		$this->load->view('layout/back/footer',$data);
	}

	public function tambah() {
		$data['kode_penyakit'] = $this->m_penyakit->buat_kode();
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');

		$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/penyakit/tambah_penyakit',$data);
		$this->load->view('layout/back/footer',$data);
	
	}

	public function tambah_aksi(){
		$data_penyakit = array(
			'id_penyakit' => $this->input->post('id_penyakit'),
			'kode_penyakit' => $this->input->post('kode_penyakit'),
			'id_user' => $this->input->post('id_user'),
			'nama_penyakit' => $this->input->post('nama_penyakit'),
			'definisi' => $this->input->post('definisi'),
			'pengobatan' => $this->input->post('pengobatan')
			);
		$this->m_penyakit->tambah($data_penyakit);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Berhasil menambah data</div>");
		redirect('back/penyakit');
	}

	// Menampilkan halaman edit
	public function edit($id) {	
        $data['data_penyakit'] = $this->m_penyakit->get_id($id);
        $data['username'] = $this->session->userdata('username');
        $data['id_user'] = $this->session->userdata('id_user');

        $this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/penyakit/edit_penyakit',$data);
		$this->load->view('layout/back/footer',$data);
    }

	// Fungsi proses edit
	public function edit_aksi($id) {
    	$data_penyakit = array(
    		'id_penyakit' => $this->input->post('id_penyakit'),
			'kode_penyakit' => $this->input->post('kode_penyakit'),
			'id_user' => $this->input->post('id_user'),
			'nama_penyakit' => $this->input->post('nama_penyakit'),
			'definisi' => $this->input->post('definisi'),
			'pengobatan' => $this->input->post('pengobatan')
			);

          $this->m_penyakit->edit($data_penyakit);
          $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate</div>"); 
          redirect('back/penyakit');
    }

    // Menampilkan detail data
    public function detail($id) {	
        $data['penyakit'] = $this->m_penyakit->get_id($id);
        $data['username'] = $this->session->userdata('username');
        $data['id_user'] = $this->session->userdata('id_user');

        $this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/penyakit/detail_penyakit',$data);
		$this->load->view('layout/back/footer',$data);
        }

	public function delete($id) {
		$this->m_penyakit->delete($id);
		redirect('back/penyakit');
	}
}
