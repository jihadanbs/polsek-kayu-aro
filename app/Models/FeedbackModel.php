<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table = 'tb_feedback';
    protected $primaryKey = 'id_feedback';
    protected $returnType = 'object';
    protected $allowedFields = ['nama', 'email', 'subjek', 'pesan', 'balasan', 'status'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getFeedback($id_feedback = false)
    {
        if ($id_feedback == false) {
            return $this->findAll();
        }

        return $this->where(['id_feedback' => $id_feedback])->first();
    }

    public function getAllData()
    {
        return $this->orderBy('id_feedback', 'DESC')->findAll();
    }

    public function getId($id_feedback)
    {
        return $this->db->table('tb_feedback')->where('id_feedback', $id_feedback)->get()->getRowArray();
    }

    public function updateStatusBaca($id_feedback)
    {
        return $this->update($id_feedback, ['status_baca' => false]);
    }

    public function getTotalFeedback()
    {
        $query = $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table);
        $result = $query->getRow();
        return $result ? $result->total : 0;
    }

    public function getTotalByStatus($status)
    {
        $query = $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table . ' WHERE status = ?', [$status]);
        $result = $query->getRow();

        return $result ? $result->total : 0;
    }

    public function getUnreadEntries()
    {
        return $this->db->table('tb_feedback')
            ->where('status', 'Belum dibalas')
            ->get()
            ->getResultObject();
    }

    public function countUnreadEntries()
    {
        return $this->db->table('tb_feedback')
            ->where('status', 'Belum dibalas')
            ->countAllResults();
    }
}
