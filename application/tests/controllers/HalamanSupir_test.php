<?php

class HalamanSupir_test extends TestCase
{
    public function setUp(){
        $this->resetInstance();
        $this->CI->load->model('Models');
        $this->obj1 = $this->CI->Models;
    }
        
    public function test_view_supir_sukses() {
        $_SESSION['username'] = 'admin';
        $output = $this->request('GET', 'HalamanSupir/supir');
    	$this->assertContains('<title>Green Rent | Dashboard</title>', $output);
    }
    
    public function test_view_supir_gagal() {
    	$output = $this->request('GET', 'HalamanSupir/supir');
    	$this->assertRedirect('login');
    }
    
    public function test_input_supir(){
        $_SESSION['username'] = 'admin';
        $filename = '1.jpg';
	$filepath = APPPATH.  'fototest/' .$filename;
	$files = [
            'gambarSupir' => [
            'name'     => $filename,
            'type'     => 'image/jpg',
            'tmp_name' => $filepath 
            ],
            ];
	$this->request->setFiles($files);
        $awal1 = $this->obj1->getCurrentRow('supir');
	$this->request('POST', 'HalamanSupir/prosesSupir',[
            'noKTP' => '735711',
            'namaSupir' => 'Testing',
            'noHP' => '089898988765',
            'alamatSupir' => 'Testing',
            'noSIM' => '678989'
            ]);
        $akhir1 = $this->obj1->getCurrentRow('supir');
        $this->assertEquals($akhir1, $awal1+1);        
    }
    
    public function test_input_supir_gagal(){
        $_SESSION['username'] = 'admin';
        $awal1 = $this->obj1->getCurrentRow('supir');
	$this->request('POST', 'HalamanSupir/prosesSupir',[
            'noKTP' => '',
            'namaSupir' => '',
            'noHP' => '',
            'alamatSupir' => '',
            'noSIM' => ''
            ]);
        $akhir1 = $this->obj1->getCurrentRow('supir');
        $this->assertEquals($akhir1, $awal1);        
    }
}

