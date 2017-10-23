<?php

class halamanMobil extends CI_Controller {
    public function __construct() {
	parent::__construct();
       if($this->session->userdata('hak_akses')!=2){
            redirect(base_url('login'));
        }
    }

    public function mobil(){
			$data=$this->Models->read('mobil','','')->result_array();
			$kirim['tampil']  = $data;
			$this->load->view('header');
			$this->load->view('mobil', $kirim);
			$this->load->view('footer');	
	}
    public function inputMobil(){
			$this->load->view('header');
			$this->load->view('input-mobil');
			$this->load->view('footer');
	}
    public function prosesMobil(){
		$this->form_validation->set_rules('noPolisi', 'noPolisi', 'required');
		$this->form_validation->set_rules('merkMobil', 'merkMobil', 'required');
		$this->form_validation->set_rules('tarifMobil', 'tarifMobil', 'required');

		if ($this->form_validation->run()==TRUE) {
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
				$this->load->helper('security');
				$nopol = $this->input->post('noPolisi', true);
				$merk = $this->input->post('merkMobil', true);
				$tarif = $this->input->post('tarifMobil', true);
				$data = array(
					'no_polisi' => $nopol,
					'merk' => $merk,
					'harga' => $tarif,
					'status' => 1 ,
					'gambar' => $pathGambar , 
				);
				$this->Models->input('mobil', $data);
				 $this->session->set_flashdata('pesan', '
					<div class="alert alert-success alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	            <h4><i class="icon fa fa-ban"></i> Sukses!</h4>Data yang anda masukan telah tersimapan di database. </div>
				');
				redirect(base_url('halamanMobil/mobil'));
				
			}
			else{
				$this->session->set_flashdata('pesan', '
					<div class="alert alert-danger alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	            <h4><i class="icon fa fa-ban"></i> Gagal!</h4>Anda Belum Memasukan Gambar. </div>
				');
				redirect(base_url('halamanMobil/inputMobil'));
			}
		}
		else{
			$this->session->set_flashdata('pesan', '
				<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Gagal!</h4>Harap Lengkapi Data. </div>
			');
			redirect(base_url('halamanMobil/inputMobil'));}}
}