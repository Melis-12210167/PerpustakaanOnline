<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class PustakawanTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testLogin(){
        $this->call('post', 'login', [
            'email' => 'melismel.mm@gmail.com',
            'sandi' => '123456'
        ])->assertStatus(403);
    }

    public function testCreateUpdateDelete(){
        $json = $this->call('post', 'pustakawan', [
            'nama_lengkap' => 'Testing nama_lengkap',
            'gender' => 'P',
            'tgl_lhr' => 'Testing',
            'level' => 'K',
            'email' => 'testing@gmail.com',
            'sandi' => 'testing',
            'nohp' => 'testing',
            'alamat' => 'testing',
            'kota' => 'testing',
            'token_reset' => 'testing',
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "pustakawan/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'pustakawan', [
            'nama_lengkap' => 'Testing pustakawan update',
            'gender' => 'P',
            'tgl_lhr' => 'Testing pustakawan update',
            'level' => 'K',
            'email' => 'testing@gmail.com',
            'nohp' => 'Testing pustakawan update',
            'alamat' => 'Testing pustakawan update',
            'kota' => 'Testing pustakawan update',
            'token_reset' => 'Testing pustakawan update',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'pustakawan', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'pustakawan/all')
            ->assertStatus(302);
    }

    public function testLogout(){
        $this->call('delete', 'login')
            ->assertStatus(200);
    }
}