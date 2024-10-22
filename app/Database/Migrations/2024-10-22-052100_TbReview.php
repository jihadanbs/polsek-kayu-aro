<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbReview extends Migration
{
    public function up()
    {
        // membuat database tb_review
        $this->forge->addField([
            'id_reviewer' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'nama_lengkap' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'pekerjaan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'pesan_review' => [
                'type' => 'TEXT',
            ],
            'rating' => [
                'type' => 'DECIMAL',
                'constraint' => '3,1',
                'check' => 'rating BETWEEN 1.0 AND 5.0',
            ],
            'file_foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_reviewer', TRUE);
        $this->forge->createTable('tb_review');
    }

    public function down()
    {
        // untuk menghapus (drop) table
        $this->forge->dropTable('tb_review');
    }
}
