<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbFAQ extends Migration
{
    public function up()
    {
        //membuat tabel tb_faq
        $this->forge->addField([
            'id_faq' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => TRUE
            ],
            'pertanyaan' => [
                'type' => 'TEXT',
            ],
            'jawaban' => [
                'type' => 'TEXT',
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_faq', TRUE);
        // Membuat tabel tb_faq
        $this->forge->createTable('tb_faq');
    }

    public function down()
    {
        // Menghapus tabel tb_faq
        $this->forge->dropTable('tb_faq');
    }
}
