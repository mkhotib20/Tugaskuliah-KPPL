<?php

class HalamanPeminjaman_test extends TestCase
{
  /*  protected $backupGlobalsBlacklist = array( '_SESSION' ); */
    
        public function setUp(){
            $this->resetInstance();
            $this->CI->load->model('Models');
            $this->obj1 = $this->CI->Models;
        }
        public function test_view_peminjaman_sukses() {
                $_SESSION['username'] = 'admin';
                
    		$output = $this->request('GET', 'HalamanPeminjaman/peminjaman');
    		$this->assertContains('<title>Green Rent | Dashboard</title>', $output);
        }
        public function test_view_peminjaman_gagal() {
    		$output = $this->request('GET', 'HalamanPeminjaman/peminjaman');
    		$this->assertRedirect('login');
    }
    public function test_view_input_peminjaman() {
                $_SESSION['username'] = 'admin';
                
    		$output = $this->request('GET', 'HalamanPeminjaman/inputPeminjaman');
    		$this->assertContains('<title>Green Rent | Dashboard</title>', $output);
    }
    public function test_prosesPinjam(){
        $_SESSION['username'] = 'admin';
        $inputPeminjamanSebelum = $this->obj1->getCurrentRow('peminjaman');
        $inputPeminjamSebelum = $this->obj1->getCurrentRow('peminjam');
        $output = $this->request('POST','HalamanPeminjaman/prosesPinjam', [
            'kodePeminjaman' => '109393',  
            'namaPeminjam' => 'Testing9',
            'ktpPeminjam' => '11',
            'hpPeminjam' => '089824237178',
            'alamatPeminjam' => 'Gebang wetan',
            'uangMuka' => 100000, 
            'kondisiKendaraan' => 'BAIK', 
            'tglBalik' => '2017-10-23',
            'mobil' => 'Avanza',
            'supir' => 'Khobahay', 
        ]);
        $inputPeminjamSesudah = $this->obj1->getCurrentRow('peminjam');
        $this->assertEquals($inputPeminjamSesudah,$inputPeminjamSebelum+1);
        
        $inputPeminjamanSesudah = $this->obj1->getCurrentRow('peminjaman');
        $this->assertEquals($inputPeminjamSesudah,$inputPeminjamSebelum+1);
    }
    
    public function test_prosesPinjam_tanpa_supir(){
        $_SESSION['username'] = 'admin';
        $inputPeminjamanSebelum = $this->obj1->getCurrentRow('peminjaman');
        $inputPeminjamSebelum = $this->obj1->getCurrentRow('peminjam');
        $output = $this->request('POST','HalamanPeminjaman/prosesPinjam', [
            'kodePeminjaman' => '87654531',  
            'namaPeminjam' => 'Testing',
            'ktpPeminjam' => '12',
            'hpPeminjam' => '0578883',
            'alamatPeminjam' => 'Kertajaya',
            'uangMuka' => 120000, 
            'kondisiKendaraan' => 'BAIK', 
            'tglBalik' => '2017-10-30',
            'mobil' => 'Motor',
            'supir' => '', 
        ]);
        $inputPeminjamSesudah = $this->obj1->getCurrentRow('peminjam');
        $this->assertEquals($inputPeminjamSesudah,$inputPeminjamSebelum+1);
        
        $inputPeminjamanSesudah = $this->obj1->getCurrentRow('peminjaman');
        $this->assertEquals($inputPeminjamSesudah,$inputPeminjamSebelum+1);
    }
    
    
    public function test_prosesPinjam_gagal(){
        $_SESSION['username'] = 'admin';
        $inputPeminjamanSebelum = $this->obj1->getCurrentRow('peminjaman');
        $inputPeminjamSebelum = $this->obj1->getCurrentRow('peminjam');
        $output = $this->request('POST','HalamanPeminjaman/prosesPinjam', [
            'kodePeminjaman' => '',  
            'namaPeminjam' => '',
            'ktpPeminjam' => '',
            'hpPeminjam' => '',
            'alamatPeminjam' => '',
            'uangMuka' => '', 
            'kondisiKendaraan' => '', 
            'tglBalik' => '',
            'mobil' => '',
            'supir' => '', 
        ]);
        $inputPeminjamSesudah = $this->obj1->getCurrentRow('peminjam');
        $this->assertEquals($inputPeminjamSesudah,$inputPeminjamSebelum);
        
        $inputPeminjamanSesudah = $this->obj1->getCurrentRow('peminjaman');
        $this->assertEquals($inputPeminjamSesudah,$inputPeminjamSebelum);
    }
}
