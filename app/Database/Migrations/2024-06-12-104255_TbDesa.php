<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbDesa extends Migration
{
    public function up()
    {
        // membuat database tb_desa
        $this->forge->addField([
            'id_desa' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'nama_desa' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'kecamatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'kabupaten' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'provinsi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'kode_pos' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ],
            'luas_wilayah' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'jumlah_penduduk' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'jumlah_kepala_keluarga' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'website' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            // Jenis Kelamin
            'jumlah_penduduk_pria' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'jumlah_penduduk_wanita' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            // Usia
            'jumlah_penduduk_usia_0_14' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'jumlah_penduduk_usia_15_64' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'jumlah_penduduk_usia_65_keatas' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            // Pendidikan
            'jumlah_penduduk_tidak_sekolah' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'jumlah_penduduk_sd' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'jumlah_penduduk_smp' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'jumlah_penduduk_sma_smk' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'jumlah_penduduk_diploma_sarjana' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            // Pekerjaan
            'jumlah_penduduk_bekerja' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'jumlah_penduduk_tidak_bekerja' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            // Sarana dan Prasarana
            'jumlah_sekolah' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'jumlah_posyandu' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'jumlah_tempat_ibadah' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'jumlah_pos_ronda' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_desa', TRUE);
        $this->forge->addForeignKey('id_user', 'tb_user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_desa');
    }

    public function down()
    {
        // untuk menghapus (drop) tabel
        $this->forge->dropTable('tb_desa');
    }
}
