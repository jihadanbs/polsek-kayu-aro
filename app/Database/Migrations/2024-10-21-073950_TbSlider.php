<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbSlider extends Migration
{
    public function up()
    {
        // membuat database tb_slider_beranda
        $this->forge->addField([
            'id_slider_beranda' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'gambar_slider' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_slider_beranda', TRUE);
        $this->forge->createTable('tb_slider_beranda');
    }

    public function down()
    {
        // untuk menghapus (drop) table
        $this->forge->dropTable('tb_slider_beranda');
    }
}
