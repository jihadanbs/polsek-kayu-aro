<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbGaleriLaporan extends Migration
{
    public function up()
    {
        // membuat database tb_laporan_galeri_laporan
        $this->forge->addField([
            'id_laporan_babin' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'id_file_foto_laporan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        // Menambahkan foreign key
        $this->forge->addForeignKey('id_laporan_babin', 'tb_laporan_babin', 'id_laporan_babin', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_file_foto_laporan', 'tb_file_foto_laporan', 'id_file_foto_laporan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_galeri_laporan');
    }

    public function down()
    {
        // untuk menghapus (drop) tabel
        $this->forge->dropTable('tb_galeri_laporan');
    }
}
