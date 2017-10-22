<?php 

class login extends CI_Controller{
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));}
		
	public function index(){
		$this->load->view('login');
	}
	public function prosesLogin(){
		$username = $this->input->post('username');
		$password = $this->Models->enkripsi($this->input->post('password'));
		$data = $this->Models->readWH('user', 'username', $username);
		if ($data->num_rows()>0) {
			foreach ($data->result_array() as $akun) {
				$pass = $akun['password'];
			}
			if ($password==$pass) {
				$this->session->set_userdata('username', $username);
				$this->session->set_flashdata('pesan', '
					<div class="alert alert-success alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Selamat Datang Admin!
					</div>
					');
				redirect(base_url());
			}
			else{
				$this->session->set_flashdata('pesan', '
					<div class="alert alert-danger alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Password yang anda masukan salah
					</div>
					');
				$this->session->set_flashdata('login', $username);
				redirect(base_url('login'));
			}

		}
		else{
			$this->session->set_flashdata('pesan', '
					<div class="alert alert-danger alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Username yang anda masukan salah
					</div>
					');
				redirect(base_url('login'));}}
	
}
 ?>