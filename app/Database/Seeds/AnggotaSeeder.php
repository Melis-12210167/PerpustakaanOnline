<?php

namespace App\Database\Seeds;

use App\Models\AnggotaModel;
use CodeIgniter\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run()
    {
        $id = (new AnggotaModel())->insert([
            'nama_depan' => 'Melis',
            'nama_belakang' => 'Li',
            'email' => 'melismel.mm@gmail.com',
            'nohp' => '081649188136',
            'alamat' => 'Pontianak',
            'kota' => 'Pontianak',
            'gender' =>"P",
            'foto' =>'',
            'tgl_daftar' =>'2022-11-12',
            'status_aktif' =>"A",
            'berlaku_awal' =>'2022-11-12',
            'berlaku_akhir' =>'2022-11-19',

        ]);
        echo "hasil id = $id";
    }
}
