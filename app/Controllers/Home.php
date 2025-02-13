<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // WAJIB //
        $tb_pengaduan = $this->m_pengaduan->getPengaduan();
        $tb_informasi_edukasi = $this->m_informasi->getAllDataByUser();
        $tb_foto = $this->m_galeri->getFotoWithFile();
        $tb_faq = $this->m_faq->getAllData();
        $tb_slider_beranda = $this->m_slider->getAllData();
        $tb_review = $this->m_review->getAllData();
        $tb_babin = $this->m_babin->getBabinByUserId();
        $tb_desa = $this->m_desa->getAllData();
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
            // END WAJIB //
        ];

        return view('index', $data);
    }

    public function detailInformasi($id_informasi)
    {
        // WAJIB //
        $informasi = $this->m_informasi->getAllDataByUser();
        $tb_informasi_edukasi = $this->m_informasi->getInformasi($id_informasi);
        $categories = $this->m_informasi->getCategoriesWithCount();
        $recent_posts = $this->m_informasi->getRecentPosts();
        // END WAJIB //

        $data = [
            'title' => 'Detail Informasi-Edukasi',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            // WAJIB //
            'informasi' => $informasi,
            'categories' => $categories,
            'recent_posts' => $recent_posts,
            'tb_informasi_edukasi' => $tb_informasi_edukasi
            // END WAJIB //
        ];

        return view('detail-informasi', $data);
    }

    public function statistik()
    {
        $tb_desa = $this->m_desa->getAllData();

        // WAJIB //
        $informasi = $this->m_informasi->getAllDataByUser();
        $categories = $this->m_informasi->getCategoriesWithCount();
        $recent_posts = $this->m_informasi->getRecentPosts();
        // END WAJIB //

        $data = [
            'title' => 'Statistik Wilayah',
            'tb_desa' => $tb_desa,
            // WAJIB //
            'informasi' => $informasi,
            'categories' => $categories,
            'recent_posts' => $recent_posts,
            // END WAJIB //
        ];

        return view('statistik', $data);
    }

    public function review()
    {
        // WAJIB //
        $informasi = $this->m_informasi->getAllDataByUser();
        $categories = $this->m_informasi->getCategoriesWithCount();
        $recent_posts = $this->m_informasi->getRecentPosts();
        $tb_foto = $this->m_galeri->getFotoWithFile();
        // END WAJIB //

        $data = [
            'title' => 'Review Pengunjung',

            // WAJIB //
            'informasi' => $informasi,
            'categories' => $categories,
            'recent_posts' => $recent_posts,
            'tb_foto' => $tb_foto,
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
        $data = [
            'title' => 'Cek Pengaduan Masyarakat'
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
