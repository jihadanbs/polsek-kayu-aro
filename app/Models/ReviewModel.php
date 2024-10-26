<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'tb_review';
    protected $primaryKey = 'id_reviewer';
    protected $allowedFields = ['nama_lengkap', 'pekerjaan', 'pesan_review', 'rating', 'file_foto'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllData()
    {
        return $this->orderBy('id_reviewer', 'DESC')->findAll();
    }

    public function getReview($id_reviewer = false)
    {
        if ($id_reviewer == false) {
            return $this->findAll();
        }

        return $this->where(['id_reviewer' => $id_reviewer])->first();
    }

    public function getFilesById($id_reviewer)
    {
        // Ambil hanya kolom yang dibutuhkan
        return $this->select('file_foto')->where('id_reviewer', $id_reviewer)->findAll();
    }

    public function deleteById($id_reviewer)
    {
        // Menghapus entri di tabel berdasarkan id_reviewer
        return $this->where('id_reviewer', $id_reviewer)->delete();
    }
}
