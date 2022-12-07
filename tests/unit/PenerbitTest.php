<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class PenerbitTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'penerbit', [
            'nama' => 'Testing nama',
            'kota' => 'Testing kota',
            'negara' => 'Testing negara',
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "penerbit/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'penerbit', [
            'nama' => 'Testing penerbit update',
            'kota' => 'Testing penerbit update',
            'negara' => 'Testing penerbit update',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'penerbit', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'penerbit/all')
            ->assertStatus(200);
    }
}
