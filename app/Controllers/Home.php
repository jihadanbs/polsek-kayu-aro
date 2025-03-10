<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $id_user = 1;

        // WAJIB //
        $tb_pengaduan = $this->m_pengaduan->getPengaduan();
        $tb_informasi_edukasi = $this->m_informasi->getAllDataByUser($id_user);
        $tb_foto = $this->m_galeri->getFotoWithFile($id_user);
        $tb_faq = $this->m_faq->getAllData();
        $tb_slider_beranda = $this->m_slider->getAllData();
        $tb_review = $this->m_review->getAllData();
        $tb_babin = $this->m_babin->getBabinByUserId($id_user);
        $tb_desa = $this->m_desa->getAllDataByUser($id_user);
        // END WAJIB //

        $data = [
            'title' => 'Polsek Kayu Aro',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            // WAJIB //
            'tb_pengaduan' => $tb_pengaduan,
            'tb_informasi_edukasi' => $tb_informasi_edukasi,
            'tb_foto' => $tb_foto,
            'tb_faq' => $tb_faq,
            'tb_slider_beranda' => $tb_slider_beranda,
            'tb_review' => $tb_review,
            'tb_babin' => $tb_babin,
            'tb_desa' => $tb_desa,
            'id_user' => $id_user
            // END WAJIB //
        ];

        return view('index', $data);
    }

    public function detailInformasi($id_informasi)
    {
        $id_user = 1;

        // WAJIB //
        $informasi = $this->m_informasi->getAllDataByUser($id_user);
        $tb_informasi_edukasi = $this->m_informasi->getInformasi($id_informasi);
        $categories = $this->m_informasi->getCategoriesWithCount();
        $recent_posts = $this->m_informasi->getRecentPosts($id_user);
        // END WAJIB //

        $data = [
            'title' => 'Detail Informasi-Edukasi',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            // WAJIB //
            'informasi' => $informasi,
            'categories' => $categories,
            'recent_posts' => $recent_posts,
            'tb_informasi_edukasi' => $tb_informasi_edukasi,
            'id_user' => $id_user,
            // END WAJIB //
        ];

        return view('detail-informasi', $data);
    }

    public function statistik()
    {
        $id_user = 1;
        $tb_desa = $this->m_desa->getAllDataByUser($id_user);

        // WAJIB //
        $informasi = $this->m_informasi->getAllDataByUser($id_user);
        $categories = $this->m_informasi->getCategoriesWithCount();
        $recent_posts = $this->m_informasi->getRecentPosts($id_user);
        // END WAJIB //

        $data = [
            'title' => 'Statistik Wilayah',
            'tb_desa' => $tb_desa,
            // WAJIB //
            'informasi' => $informasi,
            'categories' => $categories,
            'recent_posts' => $recent_posts,
            'id_user' => $id_user,
            // END WAJIB //
        ];

        return view('statistik', $data);
    }

    public function review()
    {
        $id_user = 1;

        // WAJIB //
        $informasi = $this->m_informasi->getAllDataByUser($id_user);
        $categories = $this->m_informasi->getCategoriesWithCount();
        $recent_posts = $this->m_informasi->getRecentPosts($id_user);
        $tb_foto = $this->m_galeri->getFotoWithFile($id_user);
        // END WAJIB //

        $data = [
            'title' => 'Review Pengunjung',

            // WAJIB //
            'informasi' => $informasi,
            'categories' => $categories,
            'recent_posts' => $recent_posts,
            'tb_foto' => $tb_foto,
            'id_user' => $id_user,
            // END WAJIB //
        ];

        return view('review', $data);
    }

    public function save_review()
    {
        $this->m_review->save([
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'pesan_review' => $this->request->getPost('pesan_review'),
            'rating' => $this->request->getPost('rating'),
            'file_foto' => uploadFile('file_foto', 'dokumen/foto_pengunjung_review/'),
        ]);

        session()->setFlashdata('pesan', 'Terimakasih Telah Memberikan Review Anda !');

        return redirect()->to('review');
    }

    public function cekPengaduan()
    {
        $id_user = 1;

        // WAJIB //
        $informasi = $this->m_informasi->getAllDataByUser($id_user);
        $categories = $this->m_informasi->getCategoriesWithCount();
        $recent_posts = $this->m_informasi->getRecentPosts($id_user);
        // END WAJIB //

        $data = [
            'title' => 'Cek Pengaduan Masyarakat',
            // WAJIB //
            'informasi' => $informasi,
            'categories' => $categories,
            'recent_posts' => $recent_posts,
            'id_user' => $id_user,
            // END WAJIB //
        ];

        return view('cek-pengaduan', $data);
    }

    public function cek()
    {
        $kode_pengaduan = $this->request->getPost('kode_pengaduan');

        $pengaduan = $this->m_pengaduan->cekPengaduan($kode_pengaduan);

        if ($pengaduan) {
            $data = [
                'status_pengecekan' => 'success',
                'pengaduan' => $pengaduan
            ];
        } else {
            $data = [
                'status_pengecekan' => 'error',
                'message' => 'Kode pengaduan tidak ditemukan !'
            ];
        }

        return $this->response->setJSON($data);
    }
}
