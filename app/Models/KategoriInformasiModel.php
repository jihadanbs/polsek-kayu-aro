<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriInformasiModel extends Model
{
    protected $table = 'tb_kategori_informasi';
    protected $primaryKey = 'id_kategori_informasi';
    protected $retunType = 'object';
    protected $allowedFields = ['id_user', 'nama_kategori'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllData()
    {
        return $this->orderBy('id_kategori_informasi', 'DESC')->findAll();
    }

    public function getAllDataByUser()
    {
        return $this->orderBy('id_kategori_informasi', 'DESC')->findAll();
    }

    public function simpan_perubahan($id_kategori_informasi, $nama_kategori)
    {
        // Data yang akan diupdate
        $data = [
            'kategori' => $nama_kategori
            // Tambahkan kolom lain yang perlu diupdate jika ada
        ];

        // Lakukan update data alasan ke database berdasarkan ID
        $this->update($id_kategori_informasi, $data);
    }

    // Method untuk menghitung jumlah data berdasarkan id tertentu
    public function countById($id_kategori_informasi)
    {
        return $this->where('id_kategori_informasi', $id_kategori_informasi)->countAllResults();
    }
}
