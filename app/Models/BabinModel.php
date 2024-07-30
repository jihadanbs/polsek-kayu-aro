<?php

namespace App\Models;

use CodeIgniter\Model;

class BabinModel extends Model
{
    protected $table = 'tb_babin';
    protected $primaryKey = 'id_babin';
    protected $retunType = 'object';
    protected $allowedFields = ['id_user', 'id_desa', 'nama_lengkap', 'nrp', 'pangkat', 'jabatan', 'no_telepon', 'email', 'alamat', 'tanggal_mulai_tugas', 'foto', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getBabinWithDesa()
    {
        return $this->db->table('tb_babin')
            ->select('tb_babin.*, GROUP_CONCAT(tb_desa.nama_desa SEPARATOR ", ") as nama_desa')
            ->join('tb_babin_desa', 'tb_babin.id_babin = tb_babin_desa.id_babin')
            ->join('tb_desa', 'tb_babin_desa.id_desa = tb_desa.id_desa')
            ->groupBy('tb_babin.id_babin')
            ->get()
            ->getResultArray();
    }

    public function getBabinByUserId($id_user)
    {
        return $this->db->table('tb_babin')
            ->select('tb_babin.*, GROUP_CONCAT(tb_desa.nama_desa SEPARATOR ", ") as nama_desa')
            ->join('tb_babin_desa', 'tb_babin.id_babin = tb_babin_desa.id_babin')
            ->join('tb_desa', 'tb_babin_desa.id_desa = tb_desa.id_desa')
            ->where('tb_babin.id_user', $id_user)
            ->groupBy('tb_babin.id_babin')
            ->orderBy('tb_babin.id_babin', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getBabinById($id_babin)
    {
        return $this->db->table('tb_babin')
            ->select('tb_babin.*, GROUP_CONCAT(tb_desa.nama_desa SEPARATOR ", ") as nama_desa')
            ->join('tb_babin_desa', 'tb_babin.id_babin = tb_babin_desa.id_babin')
            ->join('tb_desa', 'tb_babin_desa.id_desa = tb_desa.id_desa')
            ->where('tb_babin.id_babin', $id_babin)
            ->groupBy('tb_babin.id_babin')
            ->get()
            ->getRowArray();
    }


    public function getBabinByUser($id_user)
    {
        return $this->where('id_user', $id_user)->findAll();
    }

    public function getId($id_babin)
    {
        return $this->db->table('tb_babin')
            ->select('tb_babin.*, GROUP_CONCAT(tb_desa.nama_desa SEPARATOR ", ") as nama_desa, tb_babin.foto')
            ->join('tb_babin_desa', 'tb_babin.id_babin = tb_babin_desa.id_babin')
            ->join('tb_desa', 'tb_babin_desa.id_desa = tb_desa.id_desa')
            ->where('tb_babin.id_babin', $id_babin)
            ->groupBy('tb_babin.id_babin')
            ->get()
            ->getResultArray();
    }

    public function getAll($id_babin = null)
    {
        $builder = $this->db->table('tb_babin');
        $builder->select('tb_babin.*, GROUP_CONCAT(tb_desa.nama_desa SEPARATOR ", ") as nama_desa, tb_babin.foto');
        $builder->join('tb_babin_desa', 'tb_babin.id_babin = tb_babin_desa.id_babin');
        $builder->join('tb_desa', 'tb_babin_desa.id_desa = tb_desa.id_desa');

        // Jika $id_babin disediakan, tambahkan kondisi where
        if ($id_babin !== null) {
            $builder->where('tb_babin.id_babin', $id_babin);
        }

        // Selalu tambahkan pengelompokan
        $builder->groupBy('tb_babin.id_babin');

        // Jika $id_babin disediakan, gunakan getRow() untuk satu hasil
        if ($id_babin !== null) {
            return $builder->get()->getRow();
        } else {
            // Jika $id_babin tidak disediakan, gunakan getResultArray() untuk beberapa hasil
            return $builder->get()->getResultArray();
        }
    }

    public function getDesa($id_desa = false)
    {
        if ($id_desa == false) {
            return $this->findAll();
        }

        return $this->where(['id_desa' => $id_desa])->first();
    }

    public function getSelectedDesaIds($id_babin)
    {
        return $this->db->table('tb_babin_desa')
            ->select('id_desa')
            ->where('id_babin', $id_babin)
            ->get()
            ->getResultArray();
    }

    public function getFilesById($id_babin)
    {
        // Ambil hanya kolom yang dibutuhkan
        return $this->select('foto')->where('id_babin', $id_babin)->findAll();
    }

    public function deleteById($id_babin)
    {
        // Menghapus entri di tabel berdasarkan id_babin
        return $this->where('id_babin', $id_babin)->delete();
    }

    public function getTotalBabin($id_user)
    {
        $query = $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table . ' WHERE id_user = ?', [$id_user]);
        $result = $query->getRow();
        return $result ? $result->total : 0;
    }
}
