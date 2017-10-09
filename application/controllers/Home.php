<?php

class home extends CI_Controller {
	function coba(){
		$tanggal_lahir  = strtotime('2017-10-10');
		$sekarang    = time(); 
		$diff =  $tanggal_lahir - $sekarang;
		$hasil = floor($diff / (60 * 60 * 24))+1 ;
	}
	public function index(){
		
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}
    public function supir(){
		$data=$this->Models->read('supir','','')->result_array();
		$kirim['tampil']  = $data;
		$this->load->view('header');
		$this->load->view('supir', $kirim);
		$this->load->view('footer');
	}
	public function inputSupir(){
		$this->load->view('header');
		$this->load->view('input-supir');
		$this->load->view('footer');
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

			

