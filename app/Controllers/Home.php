<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $id_user = 1;

        // WAJIB //
        $tb_feedback = $this->m_feedback->getFeedback();
        $tb_informasi_edukasi = $this->m_informasi->getAllDataByUser($id_user);
        $tb_foto = $this->m_galeri->getFotoWithFile($id_user);
        // END WAJIB //

        $data = [
            'title' => 'Polsek Kayu Aro',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            // WAJIB //
            'tb_feedback' => $tb_feedback,
            'tb_informasi_edukasi' => $tb_informasi_edukasi,
            'tb_foto' => $tb_foto,
            'id_user' => $id_user
            // END WAJIB //
        ];

        return view('index', $data);
    }

    public function blog($id_informasi)
    {
        $id_user = 1;

        // WAJIB //
        $tb_feedback = $this->m_feedback->getFeedback();
        $informasi = $this->m_informasi->getAllDataByUser($id_user);
        $tb_informasi_edukasi = $this->m_informasi->getInformasi($id_informasi);
        $categories = $this->m_informasi->getCategoriesWithCount();
        $recent_posts = $this->m_informasi->getRecentPosts();
        // END WAJIB //

        $data = [
            'title' => 'Detail Informasi-Edukasi',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            // WAJIB //
            'informasi' => $informasi,
            'tb_feedback' => $tb_feedback,
            'categories' => $categories,
            'recent_posts' => $recent_posts,
            'tb_informasi_edukasi' => $tb_informasi_edukasi
            // END WAJIB //
        ];

        return view('detail-informasi', $data);
    }
}
