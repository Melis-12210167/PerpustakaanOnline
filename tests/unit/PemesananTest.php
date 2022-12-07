<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class PemesananTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'pemesanan', [
            'tgl_awal' => 1,
            'tgl_akhir' => 0,
            'koleksi_id' => 1,
            'anggota_id' => 1,
            'status_pesan' => 'B',
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "pemesanan/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'pemesanan', [
            'tgl_awal' => 1,
            'tgl_akhir' => 0,
            'koleksi_id' => 1,
            'anggota_id' => 1,
            'status_pesan' => 'B',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'pemesanan', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'pemesanan/all')
            ->assertStatus(200);
    }
}