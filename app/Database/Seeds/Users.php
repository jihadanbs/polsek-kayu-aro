<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        //menambahkan data dalam tabel user
        $data = [
            [
                'nama_lengkap' => 'Reissa Giana Azaria',
                'username' => 'reissa',
                'id_jabatan' => '1',
                'password' => password_hash('1234', PASSWORD_DEFAULT),
                'status' => 'aktif',
                'email' => 'jihadanb@gmail.com',
                'no_telepon' => '088215212122',
                'file_profil' => 'gambar.jpg'
            ],
            [
                'nama_lengkap' => 'Arhan Pratama',
                'username' => 'arhan',
                'id_jabatan' => '2',
                'status' => 'aktif',
                'password' => password_hash('12345', PASSWORD_DEFAULT),
                'email' => 'arhanp@gmail.com',
                'no_telepon' => '088212342233',
                'file_profil' => 'gambar.jpg'
            ],
        ];

        $this->db->table('tb_user')->insertBatch($data);
    }
}
