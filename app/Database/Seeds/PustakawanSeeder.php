<?php

namespace App\Database\Seeds;

use App\Models\PustakawanModel;
use CodeIgniter\Database\Seeder;

class PustakawanSeeder extends Seeder
{
    public function run()
    {
        $id = (new PustakawanModel())->insert([
            'nama_lengkap' => 'Melis Li',
            'gender' => 'P',
            'tgl_lhr' =>'2022-12-12',
            'level' =>'K',
            'email' =>'melismel.mm@gmail.com',
            'sandi' =>'123456',
            'nohp' =>'081649188136',
            'alamat' =>'Mempawah',
            'kota' =>'Pontianak',
            'token_reset' =>'000-001',

        ]);
        echo "hasil id = $id";
    }
}
