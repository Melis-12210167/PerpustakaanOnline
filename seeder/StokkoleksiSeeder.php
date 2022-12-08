<?php

namespace App\Database\Seeds;

use App\Models\StokkoleksiModel;
use CodeIgniter\Database\Seeder;

class StokkoleksiSeeder extends Seeder
{
    public function run()
    {
        $r = (int)(new StokkoleksiModel())->insert([
            'koleksi_id'        =>1,
            'nomor'             =>'123/Perpus/1x/2022',
            'status_tersedia'   =>"A",
            'anggota_id'        =>1,
            'pustakawan_id'     =>1,
        ]);

        echo "hasil insert $r";
    }
}
