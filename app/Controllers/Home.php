<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // WAJIB //
        $tb_feedback = $this->m_feedback->getFeedback();
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
            'tb_feedback' => $tb_feedback,
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
            'tb_informasi_edukasi' => $tb_informasi_edukasi
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
            'id_user' => $id_user,
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
        $id_user = 1;

        // WAJIB //
        $informasi = $this->m_informasi->getAllDataByUser($id_user);
        $categories = $this->m_informasi->getCategoriesWithCount();
        $recent_posts = $this->m_informasi->getRecentPosts($id_user);
        $tb_foto = $this->m_galeri->getFotoWithFile($id_user);
        // END WAJIB //

        $data = [
            'title' => 'Review Pengunjung',
            'id_user' => $id_user,

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
        // Ambil data dari request
        $nama_lengkap = $this->request->getVar('nama_lengkap');
        $pekerjaan = $this->request->getVar('pekerjaan');
        $pesan_review = $this->request->getVar('pesan_review');
        $rating = $this->request->getPost('rating');

        // Upload gambar
        $uploadFotoPengunjung = uploadFile('file_foto', 'dokumen/foto_pengunjung_review/');

        $this->m_review->save([
            'nama_lengkap' => $nama_lengkap,
            'pekerjaan' => $pekerjaan,
            'pesan_review' => $pesan_review,
            'rating' => $rating,
            'file_foto' => $uploadFotoPengunjung,
        ]);

        session()->setFlashdata('pesan', 'Terimakasih Telah Memberikan Review Anda !');

        return redirect()->to('review');
    }
}
