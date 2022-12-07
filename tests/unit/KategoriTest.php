<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class KategoriTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'kategori', [
            'nama' => 'Testing nama',
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "kategori/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'kategori', [
            'nama' => 'Testing kategori update',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'kategori', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'kategori/all')
            ->assertStatus(200);
    }
}