<?php

namespace App\Models;

use CodeIgniter\Model;

class DesaModel extends Model
{
    protected $table = 'tb_desa';
    protected $primaryKey = 'id_desa';
    protected $retunType = 'object';
    protected $allowedFields = ['id_user', 'nama_desa', 'kecamatan', 'kabupaten', 'provinsi', 'kode_pos', 'luas_wilayah', 'jumlah_penduduk', 'website', 'jumlah_kepala_keluarga', 'jumlah_penduduk_pria', 'jumlah_penduduk_wanita', 'jumlah_penduduk_usia_0_14', 'jumlah_penduduk_usia_15_64', 'jumlah_penduduk_usia_65_keatas', 'jumlah_penduduk_tidak_sekolah', 'jumlah_penduduk_sd', 'jumlah_penduduk_smp', 'jumlah_penduduk_sma_smk', 'jumlah_penduduk_diploma_sarjana', 'jumlah_penduduk_bekerja', 'jumlah_penduduk_tidak_bekerja', 'jumlah_penduduk_belum_menikah', 'jumlah_penduduk_menikah', 'jumlah_penduduk_cerai', 'jumlah_sekolah', 'jumlah_posyandu', 'jumlah_tempat_ibadah', 'jumlah_pos_ronda']; //29
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllDataByUser($id_user)
    {
        return $this->where('id_user', $id_user)->orderBy('id_desa', 'DESC')->findAll();
    }

    public function getDesa($id_desa = false)
    {
        if ($id_desa == false) {
            return $this->findAll();
        }

        return $this->where(['id_desa' => $id_desa])->first();
    }

    public function getAllData()
    {
        return $this->orderBy('id_desa', 'DESC')->findAll();
    }

    public function ambil_data($id_desa)
    {
        return $this->find($id_desa);
    }

    public function getTotalDesa($id_user)
    {
        $query = $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table . ' WHERE id_user = ?', [$id_user]);
        $result = $query->getRow();
        return $result ? $result->total : 0;
    }
}
