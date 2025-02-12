<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table = 'tb_pengaduan';
    protected $primaryKey = 'id_pengaduan';
    protected $returnType = 'object';
    protected $allowedFields = ['id_desa', 'id_babin', 'nama', 'no_telepon', 'email', 'subjek', 'pesan', 'balasan', 'status', 'dokumentasi'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getPengaduan($id_pengaduan = false)
    {
        if ($id_pengaduan == false) {
            return $this->findAll();
        }

        return $this->where(['id_pengaduan' => $id_pengaduan])->first();
    }

    public function getAllData()
    {
        return $this->orderBy('id_pengaduan', 'DESC')->findAll();
    }

    public function getId($id_pengaduan)
    {
        return $this->db->table('tb_pengaduan')->where('id_pengaduan', $id_pengaduan)->get()->getRowArray();
    }

    public function updateStatusBaca($id_pengaduan)
    {
        return $this->update($id_pengaduan, ['status_baca' => false]);
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
        return $this->db->table('tb_pengaduan')
            ->where('status', 'Belum dibalas')
            ->get()
            ->getResultObject();
    }

    public function countUnreadEntries()
    {
        return $this->db->table('tb_pengaduan')
            ->where('status', 'Belum dibalas')
            ->countAllResults();
    }
}
