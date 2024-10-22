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
}
