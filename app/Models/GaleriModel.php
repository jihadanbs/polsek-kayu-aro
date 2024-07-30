<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table = 'tb_foto';
    protected $primaryKey = 'id_foto';
    protected $retunType = 'object';
    protected $allowedFields = ['id_user', 'judul_foto', 'deskripsi', 'tanggal_foto', 'slug'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getFotoWithFile($id_user)
    {
        return $this->db->table('tb_foto')
            ->select('tb_foto.*, GROUP_CONCAT(tb_file_foto.file_foto SEPARATOR ", ") as file_foto')
            ->join('tb_galeri', 'tb_foto.id_foto = tb_galeri.id_foto')
            ->join('tb_file_foto', 'tb_galeri.id_file_foto = tb_file_foto.id_file_foto')
            ->where('tb_foto.id_user', $id_user)
            ->groupBy('tb_foto.id_foto')
            ->orderBy('tb_foto.id_foto', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getFotoById($id_foto)
    {
        return $this->db->table('tb_foto')
            ->select('tb_foto.*, GROUP_CONCAT(tb_file_foto.file_foto SEPARATOR ", ") as file_foto')
            ->join('tb_galeri', 'tb_foto.id_foto = tb_galeri.id_foto')
            ->join('tb_file_foto', 'tb_galeri.id_file_foto = tb_file_foto.id_file_foto')
            ->where('tb_foto.id_foto', $id_foto)
            ->groupBy('tb_foto.id_foto')
            ->get()
            ->getRowArray();
    }

    public function getFotoBySlug($slug)
    {
        return $this->db->table('tb_foto')
            ->select('tb_foto.*, GROUP_CONCAT(tb_file_foto.file_foto SEPARATOR ", ") as file_foto')
            ->join('tb_galeri', 'tb_foto.id_foto = tb_galeri.id_foto')
            ->join('tb_file_foto', 'tb_galeri.id_file_foto = tb_file_foto.id_file_foto')
            ->where('tb_foto.slug', $slug)
            ->groupBy('tb_foto.id_foto')
            ->get()
            ->getRowArray();
    }

    public function getDokumenByFotoId($id_foto)
    {
        return $this->db->table('tb_galeri')
            ->select('*')
            ->where('id_foto', $id_foto)
            ->get()
            ->getResultArray();
    }

    public function getFilesById($id_foto)
    {
        return $this->db->table('tb_file_foto')
            ->select('file_foto')
            ->join('tb_galeri', 'tb_file_foto.id_file_foto = tb_galeri.id_file_foto')
            ->where('tb_galeri.id_foto', $id_foto)
            ->get()
            ->getResultArray();
    }

    public function deleteFilesAndEntries($id_foto)
    {
        // Hapus entri dari tb_galeri
        $this->db->table('tb_galeri')->where('id_foto', $id_foto)->delete();

        // Hapus entri dari tb_file_foto yang terkait dengan tb_galeri yang dihapus
        $this->db->table('tb_file_foto')
            ->whereIn('id_file_foto', function ($builder) use ($id_foto) {
                $builder->select('id_file_foto')
                    ->from('tb_galeri')
                    ->where('id_foto', $id_foto);
            })
            ->delete();
    }

    public function getTotalGaleri($id_user)
    {
        $query = $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table . ' WHERE id_user = ?', [$id_user]);
        $result = $query->getRow();
        return $result ? $result->total : 0;
    }
}
