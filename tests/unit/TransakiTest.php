<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class TransaksiTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'transaksi', [
            'tgl_pinjam' => 'Testing',
            'tgl_harus_kembali' => 'Testing',
            'tgl_kembali' => 'testing',
            'anggota_id' => 1,
            'stok_koleksi_id' => 1,
            'pustakawan_id' => 1,
            'kembali_pustakawan_id' => 1,
            'denda' => 'Testing',
            'status_trx' => 'O',
            'catatan' => 'testing',
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "anggota/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'transaksi', [
            'tgl_pinjam' => 'Testing transaksi update',
            'tgl_harus_kembali' => 'Testing transaksi update',
            'tgl_kembali' => 'testing transaksi update',
            'anggota_id' => 1,
            'stok_koleksi_id' => 1,
            'pustakawan_id' => 1,
            'kembali_pustakawan_id' => 1,
            'denda' => 'Testing transaksi update',
            'status_trx' => 'O',
            'catatan' => 'testing transaksi update',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'transaksi', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'transaksi/all')
            ->assertStatus(200);
    }
}