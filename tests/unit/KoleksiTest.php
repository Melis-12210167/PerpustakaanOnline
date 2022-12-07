<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class KoleksiTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'koleksi', [
            'judul' => 'Testing',
            'jilid' => 'Testing',
            'edisi' => 'testing',
            'penerbit_id' => 1,
            'penulis' => 'testing',
            'thn_terbit' => 'testing',
            'klasifikasi_id' => 1,
            'jenis_id' => 1,
            'jml_halaman' => 1234,
            'isbn' => 12456578976,
            'bahasa_id' => 1,
            'stok' => 100,
            'eksemplar' => 10010023,
            'kategori_id' => 1,
            'pustakawan_id' => 1,
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "koleksi/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'koleksi', [
            'judul' => 'Testing koleksi update',
            'jilid' => 'Testing koleksi update',
            'edisi' => 'testing koleksi update',
            'penerbit_id' => 1,
            'penulis' => 'testing koleksi update',
            'thn_terbit' => 'testing koleksi update',
            'klasifikasi_id' => 1,
            'jenis_id' => 1,
            'jml_halaman' => 1234,
            'isbn' => 12456578976,
            'bahasa_id' => 1,
            'stok' => 100,
            'eksemplar' => 10010023,
            'kategori_id' => 1,
            'pustakawan_id' => 1,
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'koleksi', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'koleksi/all')
            ->assertStatus(200);
    }
}