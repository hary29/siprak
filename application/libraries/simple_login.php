<?php if(! defined('BASEPATH')) exit('Akses langsung tidak diperbolehkan');

class Simple_login {
 // SET SUPER GLOBAL
 var $CI = NULL;
 public function __construct() {
 $this->CI =& get_instance();
 }
 // Fungsi login
 public function login($username, $password) {
 $query = $this->CI->db->get_where('tb_user',array('username'=>$username, 'password'=>$password));
 //print_r($query);exit;
 if($query->num_rows() == 1) {
 $row = $this->CI->db->query('SELECT * FROM tb_user where username = "'.$username.'"');
 $admin = $row->row();
 $id = $admin->id_user;
 $level = $admin->id_level;
 $nama = $admin->nama;
 //$nama1=$this->session->userdata('nama');
		
 $this->CI->session->set_userdata('username', $username);
 $this->CI->session->set_userdata('id_login', uniqid(rand()));
 $this->CI->session->set_userdata('id', $id);
 $this->CI->session->set_userdata('level', $level);
 $this->CI->session->set_userdata('nama', $nama); 
 redirect(base_url('back/home_back'));
 }else{
 $this->CI->session->set_flashdata('sukses',"<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Oops... Username/password salah</div>");
 redirect(base_url('welcome'));
 }
 return false;
 }
 // Proteksi halaman
 public function cek_login() {
 if($this->CI->session->userdata('username') == '') {
 $this->CI->session->set_flashdata('sukses',"<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Anda belum login !!! </div>");
redirect(base_url('welcome'));
 }
 }
 // Fungsi logout
 public function logout() {
 $this->CI->session->unset_userdata('username');
 $this->CI->session->unset_userdata('id_login');
 $this->CI->session->unset_userdata('id');
 $this->CI->session->set_flashdata('sukses',"<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Anda berhasil Logout </div>");
redirect(base_url('welcome'));
 }
}