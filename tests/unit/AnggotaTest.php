<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class AnggotaTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'anggota', [
            'nama_depan' => 'Testing nama_depan',
            'nama_belakang' => 'Testing nama_belakang',
            'email' => 'testing@gmail.com',
            'nohp' => 'testing',
            'alamat' => 'testing',
            'kota' => 'testing',
            'gender' => 'P',
            'foto' => 'Testing',
            'tgl_daftar' => 'testing',
            'status_aktif' => 'A',
            'berlaku_awal' => 'testing',
            'berlaku_akhir' => 'testing',
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "anggota/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'anggota', [
            'nama_depan' => 'Testing anggota update',
            'nama_belakang' => 'Testing anggota update',
            'email' => 'testing@gmail.com',
            'nohp' => 'testing anggota update',
            'alamat' => 'testing anggota update',
            'kota' => 'testing anggota update',
            'gender' => 'P',
            'foto' => 'Testing anggota update',
            'tgl_daftar' => 'testing anggota update',
            'status_aktif' => 'A',
            'berlaku_awal' => 'testing anggota update',
            'berlaku_akhir' => 'testing anggota update',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'anggota', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'anggota/all')
            ->assertStatus(200);
    }
}