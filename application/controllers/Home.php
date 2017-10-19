<?php

class home extends CI_Controller {

	public function index(){
		if ($this->session->has_userdata('username')) {
			$this->load->view('header');
			$this->load->view('home');
			$this->load->view('footer');
		}
		else{
			redirect(base_url('login'));
                        
                }		
	}
	public function peminjaman(){
		if ($this->session->has_userdata('username')) {
			$data=$this->Models->read('peminjaman','','')->result_array();
			$kirim['tampil']  = $data;
			$this->load->view('header');
			$this->load->view('peminjaman', $kirim);
			$this->load->view('footer');
		}
		else{
			redirect(base_url('login'));
		}
		
	}
	public function inputPeminjaman(){
		if ($this->session->has_userdata('username')) {
			$kirim['kode'] = time();
			$dataM=$this->Models->read('mobil','','')->result_array();
			$dataS=$this->Models->read('supir','','')->result_array();
			$kirim['tampilM']  = $dataM;
			$kirim['tampilS']  = $dataS;
			$this->load->view('header');
			$this->load->view('input-pinjam', $kirim);
			$this->load->view('footer');
		}
		else{
			redirect(base_url('login'));
		}
	}
	public function mobil(){
		if ($this->session->has_userdata('username')) {
			$data=$this->Models->read('mobil','','')->result_array();
			$kirim['tampil']  = $data;
			$this->load->view('header');
			$this->load->view('mobil', $kirim);
			$this->load->view('footer');
		}
		else{
			redirect(base_url('login'));
		}
		
	}
	public function supir(){
		if ($this->session->has_userdata('username')) {
			$data=$this->Models->read('supir','','')->result_array();
			$kirim['tampil']  = $data;
			$this->load->view('header');
			$this->load->view('supir', $kirim);
			$this->load->view('footer');
		}
		else{
			redirect(base_url('login'));
		}
	}
	public function inputSupir(){
		if ($this->session->has_userdata('username')) {
			$this->load->view('header');
			$this->load->view('input-supir');
			$this->load->view('footer');
		}
		else{
			redirect(base_url('login'));
		}
	}
	public function inputMobil(){
		if ($this->session->has_userdata('username')) {
			$this->load->view('header');
			$this->load->view('input-mobil');
			$this->load->view('footer');
		}
		else{
			redirect(base_url('login'));
		}
		
	}
	public function prosesPinjam(){
		$kodePeminjaman = $this->input->post('kodePeminjaman');
		$namaPeminjam = $this->input->post('namaPeminjam');
		$alamatPeminjam = $this->input->post('alamatPeminjam');
		$ktpPeminjam = $this->input->post('ktpPeminjam');
		$hpPeminjam = $this->input->post('hpPeminjam');
		$uangMuka = $this->input->post('uangMuka');
		$kondisiKendaraan = $this->input->post('kondisiKendaraan');
		$tglBalik = $this->input->post('tglBalik');

		$tglKembali = strtotime($tglBalik);
		$tglPinjam    = time(); 
		$diff =  $tglKembali - $tglPinjam;
		$totalHari = floor($diff / (60 * 60 * 24))+1;

		$mobil = $this->input->post('mobil');
		
		$supir = $this->input->post('supir');
		if ($supir=='') {
			$ktp_supir='0';
			$biayaSupir = 0;
		}
		else{
			$getSupir = $this->Models->readWH('supir', 'nama_supir', $supir)->result_array();
			foreach ($getSupir as $g) {
				$ktp_supir = $g['no_ktp'];
			}
			$biayaSupir = 100000;
		}
		$variable = $this->Models->readWH('mobil', 'merk', $mobil)->result_array();
		foreach ($variable as $v) {
			$tarif  = $v['harga'];
			$no_pol  = $v['no_polisi'];
		}
		$totalBiaya = ($totalHari * $tarif) +$biayaSupir;	
		

		$dataPeminjam = array(
			'no_ktp_peminjam' => $ktpPeminjam,
			'nama_peminjam' => $namaPeminjam,
			'no_hp_peminjam' => $hpPeminjam,
			'alamat_peminjam' => $alamatPeminjam,
		);

		$dataPeminjaman = array(
			'kode_pinjam' => $kodePeminjaman, 
			'no_pol' => $no_pol, 
			'no_ktp_spr' => $ktp_supir, 
			'no_ktp_pjm' => $ktpPeminjam, 
			'tgl_pinjam' => date('Y-m-d'), 
			'tgl_kembali' => $tglBalik, 
			'biaya_total' => $totalBiaya, 
			'status' => 0, 
			'uang_muka' => $uangMuka, 
			'kondisi' => $kondisiKendaraan, 
		);
		if ($this->Models->input('peminjam', $dataPeminjam)) {
			if ($this->Models->input('peminjaman', $dataPeminjaman)) {
				echo 'berhasil';
				redirect(base_url('home/peminjaman'));
			}
			else{
				echo 'gagal peminjaman';
			}
		}
		else{
			echo 'gaga;';
		}
	}
	public function prosesMobil(){
		$config['upload_path']          = 'gambar/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5000;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('gambarMobil')) {
			$updata = array('upload_data' => $this->upload->data());
			foreach ($updata as $d) {
				$filename = $d['file_name'];
			}
			$pathGambar = base_url().$config['upload_path'].$filename;
			$nopol = $this->input->post('noPolisi');
			$merk = $this->input->post('merkMobil');
			$tarif = $this->input->post('tarifMobil');
			$nopol = $this->input->post('noPolisi');
			$data = array(
				'no_polisi' => $nopol,
				'merk' => $merk,
				'harga' => $tarif,
				'status' => 1 ,
				'gambar' => $pathGambar , 
			);
			if ($this->Models->input('mobil', $data)) {
				 $this->session->set_flashdata('pesan', '
					<div class="alert alert-success alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	            <h4><i class="icon fa fa-ban"></i> Sukses!</h4>Data yang anda masukan telah tersimapan di database. </div>
				');
				redirect(base_url('home/mobil'));
			}
		}
		else{
			
		}
	}
	public function prosesSupir(){
		$config['upload_path']          = 'gambar/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5000;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('gambarSupir')) {
			$updata = array('upload_data' => $this->upload->data());
			foreach ($updata as $d) {
				$filename = $d['file_name'];
			}
			$pathGambar = base_url().$config['upload_path'].$filename;
			$noKTP = $this->input->post('noKTP');
			$namaSupir = $this->input->post('namaSupir');
			$noHP = $this->input->post('noHP');
			$alamatSupir = $this->input->post('alamatSupir');
			$noSIM = $this->input->post('noSIM');
			$data = array(
				'no_ktp' => $noKTP,
				'nama_supir' => $namaSupir,
				'alamat' => $alamatSupir,
				'status' => 1 ,
				'foto' => $pathGambar , 
				'no_hp' => $noHP,
				'no_sim' => $noSIM ,
			);
			if ($this->Models->input('supir', $data)) {
				 $this->session->set_flashdata('pesan', '
					<div class="alert alert-success alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	            <h4><i class="icon fa fa-ban"></i> Sukses!</h4>Data yang anda masukan telah tersimapan di database. </div>
				');
				redirect(base_url('home/supir'));
			}
		}
		else{
			
		}
	}
}
