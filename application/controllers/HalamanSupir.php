<?php

class halamanSupir extends CI_Controller {
    public function __construct() {
	parent::__construct();
       if(!$this->session->has_userdata('username')){
            redirect(base_url('login'));
        }
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
            $this->form_validation->set_rules('noKTP', 'noKTP', 'required');
            $this->form_validation->set_rules('namaSupir', 'noKTP', 'required');
            $this->form_validation->set_rules('noHP', 'noHP', 'required');
            $this->form_validation->set_rules('alamatSupir', 'alamatSupir', 'required');
            $this->form_validation->set_rules('noSIM', 'noSIM', 'required');
        if ($this->form_validation->run() == TRUE) {
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
				$this->Models->input('supir', $data);
			}
			else{
				$this->session->set_flashdata('pesan', '
					<div class="alert alert-danger alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	            <h4><i class="icon fa fa-ban"></i> Gagal!</h4>Anda belum memasukan gambar. </div>
				');
				redirect(base_url('halamanSupir/inputSupir'));
			}
        }
        else{
        	$this->session->set_flashdata('pesan', '
				<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Gagal!</h4>Harap Lengkapi Data. </div>
			');
			redirect(base_url('halamanSupir/inputSupir'));
        }        
	}
}