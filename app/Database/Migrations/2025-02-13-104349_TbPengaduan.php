<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbPengaduan extends Migration
{
    public function up()
    {
        // Membuat tabel tb_pengaduan
        $this->forge->addField([
            'id_pengaduan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'id_desa' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'id_babin' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'no_telepon' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'subjek' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'pesan' => [
                'type' => 'TEXT'
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => 'Belum dibalas'
            ],
            'balasan' => [
                'type' => 'TEXT'
            ],
            'status_baca' => [
                'type' => 'BOOLEAN',
                'default' => TRUE
            ],
            'dokumentasi' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_pengaduan', TRUE);
        $this->forge->addForeignKey('id_babin', 'tb_babin', 'id_babin', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_desa', 'tb_desa', 'id_desa', 'CASCADE', 'CASCADE');
        // Membuat tabel tb_pengaduan');
        $this->forge->createTable('tb_pengaduan');
    }

    public function down()
    {
        // Menghapus tabel tb_pengaduan');
        $this->forge->dropTable('tb_pengaduan');
    }
}
