<?php

namespace App\Models;

use CodeIgniter\Model;

class FileLaporanModel extends Model
{
    protected $table = 'tb_file_foto_laporan';
    protected $primaryKey = 'id_file_foto_laporan';
    protected $returnType = 'object';
    protected $allowedFields = ['id_file_foto_laporan', 'file_foto'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
}
