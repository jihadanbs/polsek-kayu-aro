<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbFoto extends Migration
{
    public function up()
    {
        // membuat database tb_foto
        $this->forge->addField([
            'id_foto' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'judul_foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
            'tanggal_foto' => [
                'type' => 'DATE',
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_foto', TRUE);
        $this->forge->addForeignKey('id_user', 'tb_user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_foto');
    }

    public function down()
    {
        // untuk menghapus (drop) tabel
        $this->forge->dropTable('tb_foto');
    }
}
