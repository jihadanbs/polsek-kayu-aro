<?php

namespace App\Models;

use CodeIgniter\Model;

class InformasiModel extends Model
{
    protected $table = 'tb_informasi_edukasi';
    protected $primaryKey = 'id_informasi';
    protected $retunType = 'object';
    protected $allowedFields = ['id_user', 'judul', 'konten', 'tanggal_diterbitkan', 'penulis', 'id_kategori_informasi', 'gambar', 'profile_penulis', 'slug'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllDataByUser1($id_user)
    {
        return $this->where('id_user', $id_user)->orderBy('id_informasi', 'DESC')->findAll();
    }

    public function getAllDataByUser()
    {
        return $this->db->table('tb_informasi_edukasi')
            ->select('tb_informasi_edukasi.*, GROUP_CONCAT(tb_kategori_informasi.nama_kategori SEPARATOR ", ") as nama_kategori')
            ->join('tb_kategori_informasi', 'tb_informasi_edukasi.id_kategori_informasi = tb_kategori_informasi.id_kategori_informasi')
            ->groupBy('tb_informasi_edukasi.id_informasi')
            ->orderBy('tb_informasi_edukasi.id_informasi', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getAllData($id_informasi = null)
    {
        $builder = $this->db->table('tb_informasi_edukasi');
        $builder->join('tb_kategori_informasi', 'tb_kategori_informasi.id_kategori_informasi = tb_informasi_edukasi.id_kategori_informasi');

        if ($id_informasi !== null) {
            $builder->where('id_informasi', $id_informasi);
        }

        return $builder->get()->getRow();
    }

    public function getAllSorted()
    {
        $builder = $this->db->table('tb_informasi_edukasi');
        $builder->select('tb_informasi_edukasi.*, tb_kategori_informasi.nama_kategori');
        $builder->join('tb_kategori_informasi', 'tb_kategori_informasi.id_kategori_informasi = tb_informasi_edukasi.id_kategori_informasi');
        $builder->orderBy('tb_informasi_edukasi.id_informasi', 'DESC');
        $query = $builder->get();
        // return $query->getResult();
        $results = $query->getResult();

        // Ambil data tambahan berdasarkan id informasi publik
        foreach ($results as $result) {
            $id_informasi = $result->id_informasi;
            $additional_data = $this->getDokumenById($id_informasi);
            $result->additional_data = $additional_data;
        }

        return $results;
    }

    public function getDokumenById($id_informasi)
    {
        $builder = $this->db->table('tb_informasi_edukasi');
        $result = $builder->where('id_informasi', $id_informasi)->get()->getResult();
        return $result;
    }

    public function getInformasi($slug = false)
    {
        $builder = $this->db->table('tb_informasi_edukasi');
        $builder->select('tb_informasi_edukasi.*, tb_kategori_informasi.nama_kategori');
        $builder->join('tb_kategori_informasi', 'tb_kategori_informasi.id_kategori_informasi = tb_informasi_edukasi.id_kategori_informasi');

        if ($slug !== false) {
            $builder->where('tb_informasi_edukasi.slug', $slug);
        }

        $builder->orderBy('tb_informasi_edukasi.id_informasi', 'DESC');
        $query = $builder->get();
        $results = $query->getResult();

        // Ambil data tambahan berdasarkan id informasi publik
        foreach ($results as $result) {
            $id_informasi = $result->id_informasi;
            $additional_data = $this->getDokumenById($id_informasi);
            $result->additional_data = $additional_data;
        }

        // Jika $id_informasi diberikan, kembalikan satu baris hasil
        if ($id_informasi !== false) {
            return $results ? $results[0] : null;
        }

        return $results;
    }

    public function getAll($id_informasi = null)
    {
        $builder = $this->db->table('id_informasi');

        if ($id_informasi !== null) {
            $builder->where('id_informasi', $id_informasi);
        }

        return $builder->get()->getRow();
    }

    public function getData()
    {
        return $this->orderBy('id_informasi', 'DESC')->findAll();
    }

    public function getFilesById($id_informasi)
    {
        // Ambil hanya kolom yang dibutuhkan
        return $this->select('gambar, profile_penulis')->where('id_informasi', $id_informasi)->findAll();
    }

    public function deleteById($id_informasi)
    {
        // Menghapus entri di tabel berdasarkan id_informasi
        return $this->where('id_informasi', $id_informasi)->delete();
    }

    public function getTotalInformasi()
    {
        $query = $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table);
        $result = $query->getRow();
        return $result ? $result->total : 0;
    }

    public function getCategoriesWithCount()
    {
        $builder = $this->db->table('tb_informasi_edukasi');
        $builder->select('tb_kategori_informasi.nama_kategori, COUNT(tb_informasi_edukasi.id_informasi) as count');
        $builder->join('tb_kategori_informasi', 'tb_kategori_informasi.id_kategori_informasi = tb_informasi_edukasi.id_kategori_informasi');
        $builder->groupBy('tb_kategori_informasi.nama_kategori');
        $builder->orderBy('count', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getRecentPosts($id_user)
    {
        $builder = $this->db->table('tb_informasi_edukasi');
        $builder->select('tb_informasi_edukasi.judul, tb_informasi_edukasi.slug, tb_informasi_edukasi.tanggal_diterbitkan, tb_informasi_edukasi.gambar');
        $builder->where('tb_informasi_edukasi.id_user', $id_user);
        $builder->orderBy('tb_informasi_edukasi.tanggal_diterbitkan', 'DESC'); // Order by date descending
        $builder->limit(5); // Limit to 5 most recent posts
        $query = $builder->get();
        return $query->getResult();
    }
}
