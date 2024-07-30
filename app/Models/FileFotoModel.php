<?php

namespace App\Models;

use CodeIgniter\Model;

class FileFotoModel extends Model
{
    protected $table = 'tb_file_foto';
    protected $primaryKey = 'id_file_foto';
    protected $returnType = 'object';
    protected $allowedFields = ['id_file_foto', 'file_foto'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    // public function getAllDataByUser($id_user)
    // {
    //     return $this->where('id_user', $id_user)->orderBy('id_file_foto', 'DESC')->findAll();
    // }
}
