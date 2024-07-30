<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbBabinDesa extends Migration
{
    public function up()
    {
        // membuat database tb_babin_desa
        $this->forge->addField([
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_babin' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_desa' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addForeignKey('id_user', 'tb_user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_babin', 'tb_babin', 'id_babin', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_desa', 'tb_desa', 'id_desa', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_babin_desa');
    }

    public function down()
    {
        // untuk menghapus (drop) tabel
        $this->forge->dropTable('tb_babin_desa');
    }
}
