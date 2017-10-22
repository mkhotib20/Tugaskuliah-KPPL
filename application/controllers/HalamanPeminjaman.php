<?php

class halamanPeminjaman extends CI_Controller {
    public function __construct() {
	parent::__construct();
       if(!$this->session->has_userdata('username')){
            redirect(base_url('login'));
        }
    }
    public function peminjaman(){
			$data=$this->Models->readPeminjaman()->result_array();
			$kirim['tampil']  = $data;
			$this->load->view('header');
			$this->load->view('peminjaman', $kirim);
			$this->load->view('footer');
		
		
	}
	public function inputPeminjaman(){
			$kirim['kode'] = time();
			$dataM=$this->Models->read('mobil','','')->result_array();
			$dataS=$this->Models->read('supir','','')->result_array();
			$kirim['tampilM']  = $dataM;
			$kirim['tampilS']  = $dataS;
			$this->load->view('header');
			$this->load->view('input-pinjam', $kirim);
			$this->load->view('footer');
		
	}
    public function prosesPinjam(){
		$this->form_validation->set_rules('kodePeminjaman', 'kodePeminjaman', 'required');
		$this->form_validation->set_rules('namaPeminjam', 'namaPeminjam', 'required');
		$this->form_validation->set_rules('alamatPeminjam', 'alamatPeminjam', 'required');
		$this->form_validation->set_rules('ktpPeminjam', 'ktpPeminjam', 'required');
		$this->form_validation->set_rules('hpPeminjam', 'hpPeminjam', 'required');
		$this->form_validation->set_rules('uangMuka', 'uangMuka', 'required');
		$this->form_validation->set_rules('kondisiKendaraan', 'kondisiKendaraan', 'required');
		$this->form_validation->set_rules('tglBalik', 'tglBalik', 'required');
		$this->form_validation->set_rules('mobil', 'mobil', 'required');

		if ($this->form_validation->run()==TRUE) {

			$this->load->helper('security');
			$kodePeminjaman = $this->input->post('kodePeminjaman', true);
			$namaPeminjam = $this->input->post('namaPeminjam', true);
			$alamatPeminjam = $this->input->post('alamatPeminjam', true);
			$ktpPeminjam = $this->input->post('ktpPeminjam', true);
			$hpPeminjam = $this->input->post('hpPeminjam', true);
			$uangMuka = $this->input->post('uangMuka', true);
			$kondisiKendaraan = $this->input->post('kondisiKendaraan', true);
			$tglBalik = $this->input->post('tglBalik', true);

			$tglKembali = strtotime($tglBalik);
			$tglPinjam    = time(); 
			$diff =  $tglKembali - $tglPinjam;
			$totalHari = floor($diff / (60 * 60 * 24))+1;

			$mobil = $this->input->post('mobil', true);
			
			$supir = $this->input->post('supir', true);
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
			$totalBiaya = $totalHari * ($tarif+$biayaSupir) ;	
			

			$dataPeminjam = array(
				'no_ktp_peminjam' => $ktpPeminjam,
				'nama_peminjam' => $namaPeminjam,
				'no_hp_peminjam' => $hpPeminjam,
				'alamat_peminjam' => $alamatPeminjam
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
				'kondisi' => $kondisiKendaraan
			);
			$dataUpdate = array(
				'status' => 0 , 
			);
			$this->Models->input('peminjam', $dataPeminjam);
			$this->Models->input('peminjaman', $dataPeminjaman);
			$this->Models->update('mobil', $dataUpdate, 'no_polisi', $no_pol);
			$this->Models->update('supir', $dataUpdate, 'no_ktp', $ktp_supir);
			$this->session->set_flashdata('pesan', '
				<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Gagal!</h4>Simpan Data Sukses </div>
			');
			redirect(base_url('halamanPeminjaman/peminjaman'));
		}
		else{
			$this->session->set_flashdata('pesan', '
				<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Gagal!</h4>Data anda tidak lengkap. </div>
			');
			redirect(base_url('halamanPeminjaman/inputPeminjaman'));}}
                       
}
