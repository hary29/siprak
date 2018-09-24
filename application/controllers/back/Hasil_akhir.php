<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hasil_akhir extends CI_Controller {
	public function __construct()	{
		parent::__construct();
		$this->load->library('session');
		$this->simple_login->cek_login();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('M_hasil_akhir');
		$this->load->model('M_nilai_prak');
	}

	public function index()
	{
		$data['pel'] = $this->M_nilai_prak->get_pelajaran();


		$this->load->view('layout/back/header',$data);
		$this->load->view('layout/back/sidebar',$data);
		$this->load->view('back/nilai/pilih_experimen',$data);
		$this->load->view('layout/back/footer',$data);
	}

	public function daftar($offset=0)
	{
		$jml = $this->db->get('tb_hasil_akhir');

			//pengaturan pagination
			 $config['base_url'] = base_url().'back/hasil_akhir/daftar';
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
			$id = $this->input->post('id_pelajaran');
			$data['offset'] = $offset;
			$data['hasil'] = $this->M_hasil_akhir->daftar_nilai($config['per_page'], $offset,$id);
//print_r($data['hasil']);exit;
			//print_r($data);exit;
			$this->load->view('layout/back/header');
			$this->load->view('layout/back/sidebar');
			$this->load->view('back/nilai/daftar_nilai',$data);
			$this->load->view('layout/back/footer');
	}
}
