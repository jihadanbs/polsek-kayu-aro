<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbFeedback extends Migration
{
    public function up()
    {
        // Membuat tabel tb_feedback
        $this->forge->addField([
            'id_feedback' => [
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
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_feedback', TRUE);
        $this->forge->addForeignKey('id_babin', 'tb_babin', 'id_babin', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_desa', 'tb_desa', 'id_desa', 'CASCADE', 'CASCADE');
        // Membuat tabel tb_feedback');
        $this->forge->createTable('tb_feedback');
    }

    public function down()
    {
        // Menghapus tabel tb_feedback');
        $this->forge->dropTable('tb_feedback');
    }
}
