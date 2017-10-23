<?php

class Home_test extends TestCase
{    
        public function setUp(){
            $this->resetInstance();
            $this->CI->load->model('Models');
            $this->obj1 = $this->CI->Models;
        }
    
    public function test_view_home_sukses() {
                $_SESSION['username'] = 'admin';
                $_SESSION['hak_akses'] = 2;
    		$output = $this->request('GET', 'Home/index');
    		$this->assertContains('<title>Green Rent | Dashboard</title>', $output);
    }
    public function test_view_home_gagal() {
    		$output = $this->request('GET', 'Home/index');
    		$this->assertRedirect('login');
    }
}

