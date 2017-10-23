<?php

class HalamanMobil_test extends TestCase
{

       public function setUp(){
            $this->resetInstance();
            $this->CI->load->model('Models');
            $this->obj1 = $this->CI->Models;
        }
        
        public function test_view_mobil_sukses() {
                $_SESSION['username'] = 'admin';
                $_SESSION['hak_akses'] = 2;
    		$output = $this->request('GET', 'HalamanMobil/mobil');
    		$this->assertContains('<title>Green Rent | Dashboard</title>', $output);
        }
        
        public function test_view_mobil_gagal() {
                    $output = $this->request('GET', 'HalamanMobil/mobil');
                    $this->assertRedirect('login');
        }
        
        public function test_view_inputmobil_sukses() {
                $_SESSION['username'] = 'admin';
                $_SESSION['hak_akses'] = 2;
    		$output = $this->request('GET', 'HalamanMobil/inputMobil');
    		$this->assertContains('<title>Green Rent | Dashboard</title>', $output);
        }
        public function test_input_mobil(){
            $_SESSION['username'] = 'admin';
            $_SESSION['hak_akses'] = 2;
            $filename = '425642.jpg';
            $filepath = APPPATH.  'fototest/' .$filename;
            $files = [
                    'gambarMobil' => [
                    'name'     => $filename,
                    'type'     => 'image/jpg',
                    'tmp_name' => $filepath 
                ],
            ];
            $this->request->setFiles($files);
            $awal = $this->obj1->getCurrentRow('mobil');
            $this->request('POST', 'HalamanMobil/prosesMobil',[
                    'noPolisi' => 'L1990as',
                    'merkMobil' => 'Testing',
                    'tarifMobil' => '20000'
                ]);
            $akhir = $this->obj1->getCurrentRow('mobil');
            $this->assertEquals($akhir, $awal+1);   
            $this->obj1->delete('mobil', 'no_polisi', 'L1990as');
        }
        
          public function test_input_mobil_gagal(){
            $_SESSION['username'] = 'admin';
            $_SESSION['hak_akses'] = 2;
            $awal = $this->obj1->getCurrentRow('mobil');
            $this->request('POST', 'HalamanMobil/prosesMobil',[
                    'noPolisi' => '',
                    'merkMobil' => '',
                    'tarifMobil' => ''
                ]);
            $akhir = $this->obj1->getCurrentRow('mobil');
            $this->assertEquals($akhir, $awal);        
        }
        public function test_input_mobil_tanpa_gambar(){
            $_SESSION['username'] = 'admin';
            $_SESSION['hak_akses'] = 2;
            $awal = $this->obj1->getCurrentRow('mobil');
            $this->request('POST', 'HalamanMobil/prosesMobil',[
                    'noPolisi' => 'L1003EL',
                    'merkMobil' => 'Sengaja Emang :p',
                    'tarifMobil' => 'Emang Juga'
                ]);
            $akhir = $this->obj1->getCurrentRow('mobil');
            $this->assertEquals($akhir, $awal);        
        }
}
