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
                'password' => password_hash('1234', PASSWORD_BCRYPT),
                'status' => 'aktif',
                'email' => 'jihadanb@gmail.com',
                'no_telepon' => '082282061449',
                'file_profil' => ''
            ],
            [
                'nama_lengkap' => 'Arhan Pratama',
                'username' => 'arhan',
                'id_jabatan' => '2',
                'status' => 'aktif',
                'password' => password_hash('12345', PASSWORD_BCRYPT),
                'email' => 'arhanp@gmail.com',
                'no_telepon' => '088212342233',
                'file_profil' => ''
            ],
        ];

        $this->db->table('tb_user')->insertBatch($data);
    }
}
