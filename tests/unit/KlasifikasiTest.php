<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class KlasifikasiTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'klasifikasi', [
            'ddc' => 'Testing ddc',
            'nama' => 'Testing nama',
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "klasifikasi/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'klasifikasi', [
            'ddc' => 'Testing klasifikasi update',
            'nama' => 'Testing klasifikasi update',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'klasifikasi', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'klasifikasi/all')
            ->assertStatus(200);
    }
}