<?php

class HalamanSupir_test extends TestCase
{
  /*  protected $backupGlobalsBlacklist = array( '_SESSION' ); */
    
<<<<<<< HEAD
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
        public function test_view_inputsupir_sukses() {
                $_SESSION['username'] = 'admin';
                
    		$output = $this->request('GET', 'HalamanSupir/inputSupir');
    		$this->assertContains('<title>Green Rent | Dashboard</title>', $output);
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
           $this->obj1->delete('supir', 'no_ktp', '735711');  
        }
=======
    public function test_view_inputsupir_sukses() {
        $_SESSION['username'] = 'admin';
        $output = $this->request('GET', 'HalamanSupir/inputSupir');
    	$this->assertContains('<title>Green Rent | Dashboard</title>', $output);
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
    
    public function test_input_supir_tanpa_gambar(){
        $_SESSION['username'] = 'admin';
        $awal1 = $this->obj1->getCurrentRow('supir');
	$this->request('POST', 'HalamanSupir/prosesSupir',[
            'noKTP' => '1232323',
            'namaSupir' => 'Testing',
            'noHP' => '989889',
            'alamatSupir' => 'Testing',
            'noSIM' => 'Testing'
            ]);
        $akhir1 = $this->obj1->getCurrentRow('supir');
        $this->assertEquals($akhir1, $awal1);        
    }
}
>>>>>>> 635f2a1ba456dfa39d7cfa9a99bac489d568349f

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
       public function test_input_supir_tanpa_gambar(){
           $_SESSION['username'] = 'admin';
           $awal1 = $this->obj1->getCurrentRow('supir');
           $this->request('POST', 'HalamanSupir/prosesSupir',[
                   'noKTP' => '1232323',
                   'namaSupir' => 'Testing',
                   'noHP' => '989889',
                   'alamatSupir' => 'Testing',
                   'noSIM' => 'Testing'
               ]);
           $akhir1 = $this->obj1->getCurrentRow('supir');
           $this->assertEquals($akhir1, $awal1);        
       }
}
