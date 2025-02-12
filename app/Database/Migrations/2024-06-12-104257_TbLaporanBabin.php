<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbLaporanBabin extends Migration
{
    public function up()
    {
        // membuat database tb_laporan_babin
        $this->forge->addField([
            'id_laporan_babin' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            // 'id_user' => [
            //     'type' => 'INT',
            //     'constraint' => 11,
            //     'unsigned' => TRUE
            // ],
            'id_babin' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'judul_laporan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tanggal_laporan' => [
                'type' => 'DATE',
            ],
            'jenis_kegiatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ],
            'uraian_kegiatan' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
            'lokasi_kegiatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ],
            'hasil_kegiatan' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_laporan_babin', TRUE);
        // Menambahkan foreign key
        $this->forge->addForeignKey('id_babin', 'tb_babin', 'id_babin', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('id_user', 'tb_user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_laporan_babin');
    }

    public function down()
    {
        // untuk menghapus (drop) tabel
        $this->forge->dropTable('tb_laporan_babin');
    }
}
