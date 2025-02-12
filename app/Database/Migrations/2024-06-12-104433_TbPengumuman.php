<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbPengumuman extends Migration
{
    public function up()
    {
        // membuat database tb_pengumuman
        $this->forge->addField([
            'id_pengumuman' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            // 'id_user' => [
            //     'type' => 'INT',
            //     'constraint' => 11,
            //     'unsigned' => true,
            // ],
            'judul' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
            'tanggal_kegiatan' => [
                'type' => 'DATE',
            ],
            'gambar_pengumuman' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_pengumuman', TRUE);
        // $this->forge->addForeignKey('id_user', 'tb_user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_pengumuman');
    }

    public function down()
    {
        // untuk menghapus (drop) tabel
        $this->forge->dropTable('tb_pengumuman');
    }
}
