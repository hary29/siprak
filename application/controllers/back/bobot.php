<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bobot extends CI_Controller {
	public function __construct()	{
		parent::__construct();
		$this->load->library('session');
		$this->simple_login->cek_login();
		$this->load->model('m_bobot');
		$this->load->model('M_tmp_bobot');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index($offset=0){
		$jml = $this->db->get('tb_bobot');

		$config['base_url'] = base_url().'/back/bobot/index';
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
   		$data['bobot'] = $this->m_bobot->daftar_bobot($config['per_page'], $offset);
   		$data['penyakit'] = $this->m_bobot->get_pny();
        $data['gejala'] = $this->m_bobot->get_gj();
   		$data['username'] = $this->session->userdata('username');
   		$data['id_user'] = $this->session->userdata('id_user');
		
		$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/bobot/data_bobot',$data);
		$this->load->view('layout/back/footer',$data);
	}

	public function tambah() {
		$data['penyakit'] = $this->m_bobot->get_pny();
        $data['gejala'] = $this->m_bobot->get_gj();
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');

		$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/bobot/tambah_bobot',$data);
		$this->load->view('layout/back/footer',$data);
	
	}

	public function tambah_aksi(){
		$data_bobot = array(
			'id_bobot' => $this->input->post('id_bobot'),
			'id_penyakit' => $this->input->post('id_penyakit'),
			'id_gejala' => $this->input->post('id_gejala'),
			'bobot' => $this->input->post('bobot')
			);

			//print_r($data_bobot);exit;
			//cek kesamaan data jika sama maka tidak di simpan
			$cek= $this->m_bobot->get_cari_sama($data_bobot);
			//print_r($cek);exit;
			if ($cek==0) {
		$this->m_bobot->tambah($data_bobot);
		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Berhasil menambah data</div>");
		redirect('back/bobot');}
		else {
			$this->session->set_flashdata('sukses', "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"\"><strong>error!</strong><br></i> data sudah ada</div>");
			redirect('back/bobot/tambah');
		}
	}

	// Menampilkan halaman edit
	public function edit($id) {	
		$data['bobot'] = $this->m_bobot->get_id($id);
        $data['penyakit'] = $this->m_bobot->get_pny();
        $data['gejala'] = $this->m_bobot->get_gj();
        $data['username'] = $this->session->userdata('username');
        $data['id_user'] = $this->session->userdata('id_user');

        $this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/bobot/edit_bobot',$data);
		$this->load->view('layout/back/footer',$data);
    }

	// Fungsi proses edit
	public function edit_aksi($id) {
    	$data_bobot = array(
    		'id_bobot' => $this->input->post('id_bobot'),
			'id_penyakit' => $this->input->post('id_penyakit'),
			'id_gejala' => $this->input->post('id_gejala'),
			'bobot' => $this->input->post('bobot')
			);

          $this->m_bobot->edit($data_bobot);
          $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate</div>"); 
          redirect('back/bobot');
    }

    // Menampilkan detail data
    public function detail($id) {	
        $data['penyakit'] = $this->m_bobot->get_pny();
        $data['gejala'] = $this->m_bobot->get_gj();
        $data['username'] = $this->session->userdata('username');
        $data['id_user'] = $this->session->userdata('id_user');

        $this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/bobot/detail_bobot',$data);
		$this->load->view('layout/back/footer',$data);
        }

	public function delete($id) {
		$this->m_bobot->delete($id);
		redirect('back/bobot');
	}
}
