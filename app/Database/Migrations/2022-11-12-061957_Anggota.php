<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Anggota extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => [ 'type' =>'int', 'constraint' =>10, 'unsigned'=>true, 'auto_increment' =>true ],
            'nama_depan'        => [ 'type' =>'varchar', 'constraint' =>50, 'null'=>true ],
            'nama_belakang'     => [ 'type' =>'varchar', 'constraint' =>50, 'null'=>true ],
            'email'             => [ 'type' =>'varchar', 'constraint'=>255, 'null'=>false ],
            'nohp'              => [ 'type' =>'varchar', 'constraint'=>15, 'null'=>true ],
            'alamat'            => [ 'type' =>'varchar', 'constraint'=>255, 'null'=>true ],
            'kota'              => [ 'type' =>'varchar', 'constraint'=>30, 'null'=>true ],
            'gender'            => [ 'type' =>'enum("L","P")', 'null'=>true ],
            'foto'              => [ 'type' =>'varchar', 'constraint'=>255, 'null'=>true ],
            'tgl_daftar'        => [ 'type' =>'date', 'null'=>true ],
            'status_aktif'      => [ 'type' =>'enum("A","N")', 'default'=>"A", 'null'=>true ],
            'berlaku_awal'      => [ 'type' =>'date', 'null'=>true ],
            'berlaku_akhir'     => [ 'type' =>'date', 'null'=>true ],
            'created_at'        => [ 'type' =>'datetime', 'null'=>true ],
            'updated_at'        => [ 'type' =>'datetime', 'null'=>true ],
            'deleted_at'        => [ 'type' =>'datetime', 'null'=>true ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('anggota');
    }

    public function down()
    {
        $this->forge->dropTable('angota');
    }
}
