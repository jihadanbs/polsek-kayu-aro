<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbFileLaporanBabin extends Migration
{
    public function up()
    {
        // membuat database tb_file_foto_laporan
        $this->forge->addField([
            'id_file_foto_laporan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'file_foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_file_foto_laporan', TRUE);
        $this->forge->createTable('tb_file_foto_laporan');
    }

    public function down()
    {
        // untuk menghapus (drop) tabel
        $this->forge->dropTable('tb_file_foto_laporan');
    }
}
