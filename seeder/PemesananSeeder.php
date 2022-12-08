<?php

namespace App\Database\Seeds;

use App\Models\PemesananModel;
use CodeIgniter\Database\Seeder;

class PemesananSeeder extends Seeder
{
    public function run()
    {
        $r = (int)(new PemesananModel())->insert([
            'tgl_awal'          =>'2022-11-12',
            'tgl_akhir'         =>'2022-11-19',
            'koleksi_id'        =>1,
            'anggota_id'        =>1,
            'status_pesan'      =>"B",
        ]);

        echo "hasil insert $r";
    }
}
