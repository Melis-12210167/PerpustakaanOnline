<?php

namespace App\Database\Seeds;

use App\Models\TransaksiModel;
use CodeIgniter\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        $r = (int)(new TransaksiModel())->insert([
            'tgl_pinjam'            =>'2022-11-12',
            'tgl_harus_kembali'     =>'2022-11-19',
            'tgl_kembali'           =>'2022-11-19',
            'anggota_id'            =>1,
            'stok_koleksi_id'       =>1,
            'pustakawan_id'         =>1,
            'kembali_pustakawan_id' =>1,
            'denda'                 =>"0",
            'status_trx'            =>"P",
            'catatan'               =>'Banyak Membaca Banyak Ilmunya!',
        ]);

        echo "hasil insert $r";
    }
}
