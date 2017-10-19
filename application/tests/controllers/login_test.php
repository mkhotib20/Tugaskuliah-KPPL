<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class login_test extends TestCase
{
    protected $backupGlobalsBlacklist = array( '_SESSION' );
    
        public function setUp(){
            if ( isset( $_SESSION ) ) $_SESSION = array( );
            $this->resetInstance();
            $this->CI->load->model('Models');
            $this->obj1 = $this->CI->Models;
        }
    
    public function test_view_login() {
    		$output = $this->request('GET', 'Login/index');
    		$this->assertContains('<title>Greent Rent | Log in</title>', $output);
    }

    public function test_login_masuk_berhasil() {
        $this->request('POST', 'Login/prosesLogin',
                            [
                            'username' => 'admin',
                            'password' => 'greenrental', 
                            ]
                            );
            $this->assertEquals('admin', $_SESSION['username']);
    }
}