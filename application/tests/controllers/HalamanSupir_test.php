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
}

