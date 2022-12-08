<?php

namespace App\Database\Seeds;

use App\Models\PenerbitModel;
use CodeIgniter\Database\Seeder;

class PenerbitSeeder extends Seeder
{
    public function run()
    {
        $id = (new PenerbitModel())->insert([
            'nama' => 'Intan',
            'kota' => 'Jakarta',
            'negara' => 'Indonesia',

        ]);
        echo "hasil id = $id";
    }
}
