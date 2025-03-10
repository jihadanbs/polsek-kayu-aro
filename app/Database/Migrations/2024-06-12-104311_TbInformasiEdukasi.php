<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbInformasiEdukasi extends Migration
{
    public function up()
    {
        // membuat database tb_informasi_edukasi
        $this->forge->addField([
            'id_informasi' => [
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
            'judul' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'konten' => [
                'type' => 'TEXT',
            ],
            'tanggal_diterbitkan' => [
                'type' => 'DATE',
            ],
            'penulis' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ],
            'id_kategori_informasi' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ],
            'profile_penulis' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_informasi', TRUE);
        // Menambahkan foreign key
        $this->forge->addForeignKey('id_kategori_informasi', 'tb_kategori_informasi', 'id_kategori_informasi', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user', 'tb_user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_informasi_edukasi');
    }

    public function down()
    {
        // untuk menghapus (drop) tabel
        $this->forge->dropTable('tb_informasi_edukasi');
    }
}
