<?php

namespace App\Models;

use CodeIgniter\Model;

class FaqModel extends Model
{
    protected $table = 'tb_faq';
    protected $primaryKey = 'id_faq';
    protected $allowedFields = ['pertanyaan', 'jawaban'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllData()
    {
        return $this->orderBy('id_faq', 'DESC')->findAll();
    }

    public function getFaq($id_faq = false)
    {
        if ($id_faq == false) {
            return $this->findAll();
        }

        return $this->where(['id_faq' => $id_faq])->first();
    }

    public function getAll($id_faq = null)
    {
        $builder = $this->db->table('tb_faq');

        if ($id_faq !== null) {
            $builder->where('id_faq', $id_faq);
        }

        return $builder->get()->getRow();
    }

    public function getid($id_faq)
    {
        $builder = $this->db->table('tb_faq');
        return $builder->where('id_faq', $id_faq)->get()->getResult();
    }
}
