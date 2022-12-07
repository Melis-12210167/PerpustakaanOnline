<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class StokkoleksiTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'stokkoleksi', [
            'koleksi_id' => 1,
            'nomor' => 0,
            'status_tersedia' => 'A',
            'anggota_id' => 1,
            'pustakawan_id' => 1,
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "stokkoleksi/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'stokkoleksi', [
            'koleksi_id' => 1,
            'nomor' => 0,
            'status_tersedia' => 'A',
            'anggota_id' => 1,
            'pustakawan_id' => 1,
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'stokkoleksi', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'stokkoleksi/all')
            ->assertStatus(200);
    }
}