<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pricing extends CI_Controller {
	public function __construct()	{
		parent::__construct();
		$this->load->library('session');
		//$this->simple_login->cek_login();
		$this->load->helper('form');
		$this->load->helper('url');
		//$this->load->model('M_user');
		
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
		//$this->load->view('welcome_message');
		$this->load->view('layout/front/header');
		$this->load->view('front/pricing');
		$this->load->view('layout/front/footer');

	}
	
}
