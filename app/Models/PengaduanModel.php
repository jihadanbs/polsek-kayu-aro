<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table = 'tb_pengaduan';
    protected $primaryKey = 'id_pengaduan';
    protected $returnType = 'object';
    protected $allowedFields = ['id_desa', 'id_babin', 'nama', 'no_telepon', 'email', 'subjek', 'pesan', 'balasan', 'status', 'dokumentasi', 'kode_pengaduan'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getFilesById($id_pengaduan)
    {
        // Ambil hanya kolom yang dibutuhkan
        return $this->select('dokumentasi')->where('id_pengaduan', $id_pengaduan)->findAll();
    }

    public function deleteById($id_pengaduan)
    {
        // Menghapus entri di tabel berdasarkan id_pengaduan
        return $this->where('id_pengaduan', $id_pengaduan)->delete();
    }

    public function CekPengaduan($kode_pengaduan = false)
    {
        $builder = $this->db->table('tb_pengaduan');
        $builder->select('tb_pengaduan.*, tb_desa.nama_desa, tb_babin.nama_lengkap');
        $builder->join('tb_desa', 'tb_desa.id_desa = tb_pengaduan.id_desa');
        $builder->join('tb_babin', 'tb_babin.id_babin = tb_pengaduan.id_babin');

        if ($kode_pengaduan !== false) {
            $builder->where('tb_pengaduan.kode_pengaduan', $kode_pengaduan);
            return $builder->get()->getRowArray(); // Ubah menjadi getRowArray()
        }

        $builder->orderBy('tb_pengaduan.kode_pengaduan', 'DESC');
        return $builder->get()->getResult();
    }

    public function getCekPengaduan($id_pengaduan = false)
    {
        $builder = $this->db->table('tb_pengaduan');
        $builder->select('tb_pengaduan.*, tb_desa.nama_desa, tb_babin.nama_lengkap');
        $builder->join('tb_desa', 'tb_desa.id_desa = tb_pengaduan.id_desa');
        $builder->join('tb_babin', 'tb_babin.id_babin = tb_pengaduan.id_babin');

        if ($id_pengaduan !== false) {
            $builder->where('tb_pengaduan.id_pengaduan', $id_pengaduan);
            return $builder->get()->getRowArray(); // Ubah menjadi getRowArray()
        }

        $builder->orderBy('tb_pengaduan.id_pengaduan', 'DESC');
        return $builder->get()->getResult();
    }

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

    public function generateKodePengaduan()
    {
        $letters = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3);
        $numbers = mt_rand(100, 999);
        $moreLetters = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3);

        return "{$letters}-{$numbers}-{$moreLetters}";
    }
}
