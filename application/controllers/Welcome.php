<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();		
		$this->load->library('session');
		$this->load->model('M_user');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');

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
		// //$this->load->view('welcome_message');
		//  $kode = $this->M_user->get_last_id();
		// // print_r($kode);exit;
  //       if ($kode) {
  //           $cut_code = substr($kode->kode_pendaftaran, 3, 4);
            
  //           $k = $cut_code+1;//print_r($k);exit;
  //           if ($k == 1) {
  //               $kode1 = "PD-1001";
  //           }else{
  //               $kode1 = "PD-".$k;
  //           }
  //       }else{
  //           $kode1 = "PD-1001";
  //       }
        // $data['kode'] = $kode1;
		$this->load->view('layout/front/header');
		$this->load->view('front/index');
		$this->load->view('layout/front/footer');
	}

	
	
}
