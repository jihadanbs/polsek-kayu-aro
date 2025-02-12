<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'tb_laporan_babin';
    protected $primaryKey = 'id_laporan_babin';
    protected $retunType = 'object';
    protected $allowedFields = ['id_user', 'id_babin', 'id_file_foto_laporan', 'judul_laporan', 'tanggal_laporan', 'jenis_kegiatan', 'uraian_kegiatan', 'lokasi_kegiatan', 'hasil_kegiatan', 'dokumentasi_kegiatan'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllDataByUser()
    {
        return $this->db->table('tb_laporan_babin')
            ->select('tb_laporan_babin.*, GROUP_CONCAT(tb_babin.nama_lengkap SEPARATOR ", ") as nama_lengkap')
            ->join('tb_babin', 'tb_laporan_babin.id_babin = tb_babin.id_babin')
            ->groupBy('tb_laporan_babin.id_laporan_babin')
            ->orderBy('tb_laporan_babin.id_laporan_babin', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getLaporanById1()
    {
        return $this->db->table('tb_laporan_babin')
            ->select('tb_laporan_babin.*, GROUP_CONCAT(tb_babin.nama_lengkap SEPARATOR ", ") as nama_lengkap')
            ->join('tb_babin', 'tb_laporan_babin.id_babin = tb_babin.id_babin')
            ->groupBy('tb_laporan_babin.id_laporan_babin')
            ->get()
            ->getRowArray();
    }

    public function getLaporanById()
    {
        return $this->db->table('tb_laporan_babin')
            ->select('tb_laporan_babin.*, 
                      GROUP_CONCAT(DISTINCT tb_babin.nama_lengkap SEPARATOR ", ") as nama_lengkap,
                      GROUP_CONCAT(DISTINCT tb_file_foto_laporan.file_foto SEPARATOR ", ") as file_foto')
            ->join('tb_babin', 'tb_laporan_babin.id_babin = tb_babin.id_babin', 'left')
            ->join('tb_galeri_laporan', 'tb_laporan_babin.id_laporan_babin = tb_galeri_laporan.id_laporan_babin', 'left')
            ->join('tb_file_foto_laporan', 'tb_galeri_laporan.id_file_foto_laporan = tb_file_foto_laporan.id_file_foto_laporan', 'left')
            ->groupBy('tb_laporan_babin.id_laporan_babin')
            ->get()
            ->getRowArray();
    }

    public function getDokumenById($id_laporan_babin)
    {
        $builder = $this->db->table('tb_laporan_babin');
        return $builder->where('id_laporan_babin', $id_laporan_babin)->get()->getResult();
    }

    public function getFilesById($id_laporan_babin)
    {
        return $this->db->table('tb_file_foto_laporan')
            ->select('file_foto')
            ->join('tb_galeri_laporan', 'tb_file_foto_laporan.id_file_foto_laporan = tb_galeri_laporan.id_file_foto_laporan')
            ->where('tb_galeri_laporan.id_laporan_babin', $id_laporan_babin)
            ->get()
            ->getResultArray();
    }

    public function deleteFilesAndEntries($id_laporan_babin)
    {
        // Hapus entri dari tb_galeri
        $this->db->table('tb_galeri_laporan')->where('id_laporan_babin', $id_laporan_babin)->delete();

        // Hapus entri dari tb_file_foto_laporan yang terkait dengan tb_galeri_laporan yang dihapus
        $this->db->table('tb_file_foto_laporan')
            ->whereIn('id_file_foto_laporan', function ($builder) use ($id_laporan_babin) {
                $builder->select('id_file_foto_laporan')
                    ->from('tb_galeri_laporan')
                    ->where('id_laporan_babin', $id_laporan_babin);
            })
            ->delete();
    }

    public function getTotalLaporan()
    {
        $query = $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table);
        $result = $query->getRow();
        return $result ? $result->total : 0;
    }
}
