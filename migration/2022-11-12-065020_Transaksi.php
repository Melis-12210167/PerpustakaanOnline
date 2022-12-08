<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                    => [ 'type' =>'int', 'constraint' =>10, 'unsigned'=>true, 'auto_increment' =>true ],
            'tgl_pinjam'            => [ 'type' =>'date', 'null'=>true ],
            'tgl_harus_kembali'     => [ 'type' =>'date', 'null'=>true ],
            'tgl_kembali'           => [ 'type' =>'datetime', 'null'=>true ],
            'anggota_id'            => [ 'type' =>'int', 'constraint' =>10, 'null'=>true, 'unsigned' =>true ],
            'stokkoleksi_id'        => [ 'type' =>'int', 'constraint' =>10, 'null'=>true, 'unsigned' =>true ],
            'pustakawan_id'         => [ 'type' =>'int', 'constraint' =>10, 'null'=>true, 'unsigned' =>true ],
            'kembalipustakawan_id' => [ 'type' =>'int', 'constraint' =>10, 'null'=>false, 'unsigned' =>true ],
            'denda'                 => [ 'type' =>'double', 'default' =>0, 'unsigned' =>true],
            'status_trx'            => [ 'type' =>'enum("P","K","R","H")', 'default'=>"P" ],
            'catatan'               => [ 'type' =>'text', 'null'=>true ],

        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('anggota_id', 'anggota', 'id', 'cascade');
        $this->forge->addForeignKey('stokkoleksi_id', 'stokkoleksi', 'id', 'cascade');
        $this->forge->addForeignKey('pustakawan_id', 'pustakawan', 'id', 'cascade');
        $this->forge->addForeignKey('kembalipustakawan_id', 'pustakawan', 'id', 'cascade');
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
