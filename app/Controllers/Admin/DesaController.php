<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DesaController extends BaseController
{
    public function index()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        $id_user = session()->get('id_user');

        // Pastikan hanya pengguna dengan id_user yang sesuai yang dapat mengakses halaman
        if (session()->get('id_user') != $id_user) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda tidak memiliki akses ke halaman ini');
        }

        $tb_desa = $this->m_desa->getAllDataByUser($id_user);
        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $data = [
            'title' => 'Admin | Halaman Data Desa',
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_desa' => $tb_desa
        ];

        return view('admin/desa/index', $data);
    }

    public function tambah()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        // Pastikan hanya pengguna dengan id_user yang sesuai yang dapat mengakses halaman
        $id_user = session()->get('id_user');
        if (session()->get('id_user') != $id_user) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda tidak memiliki akses ke halaman ini');
        }

        $tb_desa = $this->m_desa->getAllDataByUser($id_user);
        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $data = [
            'title' => 'Admin | Halaman Tambah Data Desa',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_desa' => $tb_desa
        ];

        return view('admin/desa/tambah', $data);
    }

    public function save()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        // Validasi input
        if (!$this->validate([
            'nama_desa' => [
                'rules' => 'required|is_unique_nama_desa[tb_desa,kecamatan]',
                'errors' => [
                    'required' => 'Silahkan masukkan nama desa !',
                    'is_unique_nama_desa' => 'Nama Desa Sudah Terdaftar Untuk Nama Kecamatan Yang Sama, Silahkan Ganti Nama Desa Lainnya !'
                ]
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan nama kecamatan !'
                ]
            ],
            'kabupaten' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan nama kabupaten !'
                ]
            ],
            'provinsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan nama provinsi !'
                ]
            ],
            'kode_pos' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan kode pos !',
                    'numeric' => 'Kode pos harus berupa angka !',
                ]
            ],
            'luas_wilayah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan luas wilayah !',
                    'numeric' => 'Luas wilayah harus berupa angka !'
                ]
            ],
            'jumlah_penduduk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk !',
                    'numeric' => 'Jumlah penduduk harus berupa angka !'
                ]
            ],
            'jumlah_kepala_keluarga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah Kepala Keluarga !',
                    'numeric' => 'Jumlah Kepala Keluarga harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_pria' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Pria !',
                    'numeric' => 'Jumlah penduduk Pria harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_wanita' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Wanita !',
                    'numeric' => 'Jumlah penduduk Wanita harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_usia_0_14' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Usia 0-14 !',
                    'numeric' => 'Jumlah penduduk Usia 0-14 harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_usia_15_64' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Usia 15-64 !',
                    'numeric' => 'Jumlah penduduk Usia 15-64 harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_usia_65_keatas' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Usia 65-Keatas !',
                    'numeric' => 'Jumlah penduduk Usia 65-Keatas harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_tidak_sekolah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Tidak Sekolah !',
                    'numeric' => 'Jumlah penduduk Tidak Sekolah harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_sd' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Menempuh Sekolah Dasar !',
                    'numeric' => 'Jumlah penduduk Menempuh Sekolah Dasar harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_smp' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Menempuh Sekolah Menengah Pertama !',
                    'numeric' => 'Jumlah penduduk Menempuh Sekolah Menengah Pertama harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_sma_smk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Menempuh Sekolah Menengah Keatas !',
                    'numeric' => 'Jumlah penduduk Menempuh Sekolah Menengah Keatas harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_diploma_sarjana' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Menempuh Diploma Atau Sarjana !',
                    'numeric' => 'Jumlah penduduk Menempuh Diploma Atau Sarjana harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_bekerja' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Memiliki Pekerjaan !',
                    'numeric' => 'Jumlah penduduk Memiliki Pekerjaan harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_tidak_bekerja' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Tidak Memiliki Pekerjaan !',
                    'numeric' => 'Jumlah penduduk Tidak Memiliki Pekerjaan harus berupa angka !'
                ]
            ],
            'jumlah_sekolah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah Sarana dan Prasarana Berupa Sekolah !',
                    'numeric' => 'Jumlah Sarana dan Prasarana Berupa Sekolah harus berupa angka !'
                ]
            ],
            'jumlah_posyandu' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah Sarana dan Prasarana Berupa Posyandu !',
                    'numeric' => 'Jumlah Sarana dan Prasarana Berupa Posyandu harus berupa angka !'
                ]
            ],
            'jumlah_tempat_ibadah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah Sarana dan Prasarana Berupa Tempat Ibadah !',
                    'numeric' => 'Jumlah Sarana dan Prasarana Berupa Tempat Ibadah harus berupa angka !'
                ]
            ],
            'jumlah_pos_ronda' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah Sarana dan Prasarana Berupa Pos Ronda !',
                    'numeric' => 'Jumlah Sarana dan Prasarana Berupa Pos Ronda harus berupa angka !'
                ]
            ],
        ])) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->to('/admin/desa/tambah/')->withInput();
        }

        $id_user = session()->get('id_user');

        // Simpan data ke database
        $this->m_desa->save([
            'id_user' => $id_user, // Menambahkan id_user
            'nama_desa' => $this->request->getPost('nama_desa'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'kabupaten' => $this->request->getPost('kabupaten'),
            'provinsi' => $this->request->getPost('provinsi'),
            'kode_pos' => $this->request->getPost('kode_pos'),
            'luas_wilayah' => $this->request->getPost('luas_wilayah'),
            'jumlah_penduduk' => $this->request->getPost('jumlah_penduduk'),
            'website' => $this->request->getPost('website'),
            'jumlah_kepala_keluarga' => $this->request->getPost('jumlah_kepala_keluarga'),
            'jumlah_penduduk_pria' => $this->request->getPost('jumlah_penduduk_pria'),
            'jumlah_penduduk_wanita' => $this->request->getPost('jumlah_penduduk_wanita'),
            'jumlah_penduduk_usia_0_14' => $this->request->getPost('jumlah_penduduk_usia_0_14'),
            'jumlah_penduduk_usia_15_64' => $this->request->getPost('jumlah_penduduk_usia_15_64'),
            'jumlah_penduduk_usia_65_keatas' => $this->request->getPost('jumlah_penduduk_usia_65_keatas'),
            'jumlah_penduduk_tidak_sekolah' => $this->request->getPost('jumlah_penduduk_tidak_sekolah'),
            'jumlah_penduduk_sd' => $this->request->getPost('jumlah_penduduk_sd'),
            'jumlah_penduduk_smp' => $this->request->getPost('jumlah_penduduk_smp'),
            'jumlah_penduduk_sma_smk' => $this->request->getPost('jumlah_penduduk_sma_smk'),
            'jumlah_penduduk_diploma_sarjana' => $this->request->getPost('jumlah_penduduk_diploma_sarjana'),
            'jumlah_penduduk_bekerja' => $this->request->getPost('jumlah_penduduk_bekerja'),
            'jumlah_penduduk_tidak_bekerja' => $this->request->getPost('jumlah_penduduk_tidak_bekerja'),
            'jumlah_sekolah' => $this->request->getPost('jumlah_sekolah'),
            'jumlah_posyandu' => $this->request->getPost('jumlah_posyandu'),
            'jumlah_tempat_ibadah' => $this->request->getPost('jumlah_tempat_ibadah'),
            'jumlah_pos_ronda' => $this->request->getPost('jumlah_pos_ronda'), //29
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan !');

        return redirect()->to('/admin/desa');
    }

    public function cek_data($id_desa)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        $desa = $this->m_desa->getDesa($id_desa);

        // Pastikan id_desa adalah milik id_user yang sedang login
        $id_user = session()->get('id_user');
        $desa = $this->m_desa->getDesa($id_desa);

        if (!$desa || $desa['id_user'] != $id_user) {
            return redirect()->back()->with('gagal', 'Data desa tidak ditemukan atau Anda tidak memiliki akses');
        }

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $data = [
            'title' => 'Admin | Halaman Cek Data',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_desa' => $desa,
        ];

        return view('admin/desa/cek_data', $data);
    }

    public function edit($id_desa)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        // Ambil id_user dari session
        $id_user = session()->get('id_user');

        // Pastikan data desa milik user yang login
        $tb_desa = $this->m_desa->where('id_user', $id_user)->find($id_desa);
        if (!$tb_desa) {
            return redirect()->back()->with('gagal', 'Data desa tidak ditemukan atau Anda tidak memiliki akses');
        }

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $data = [
            'title' => 'Admin | Halaman Edit Data Desa',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_desa' => $tb_desa
        ];

        return view('admin/desa/edit', $data);
    }

    public function update($id_desa)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        // Ambil id_user dari session
        $id_user = session()->get('id_user');

        // Pastikan data desa milik user yang login
        $tb_desa = $this->m_desa->where('id_user', $id_user)->find($id_desa);
        if (!$tb_desa) {
            return redirect()->to('/admin/desa')->with('gagal', 'Data desa tidak ditemukan atau Anda tidak memiliki akses');
        }

        // Validasi input
        if (!$this->validate([
            'nama_desa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan nama desa !'
                ]
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan nama kecamatan !'
                ]
            ],
            'kabupaten' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan nama kabupaten !'
                ]
            ],
            'provinsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan nama provinsi !'
                ]
            ],
            'kode_pos' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan kode pos !',
                    'numeric' => 'Kode pos harus berupa angka !',
                ]
            ],
            'luas_wilayah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan luas wilayah !',
                    'numeric' => 'Luas wilayah harus berupa angka !'
                ]
            ],
            'jumlah_penduduk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk !',
                    'numeric' => 'Jumlah penduduk harus berupa angka !'
                ]
            ],
            'jumlah_kepala_keluarga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah Kepala Keluarga !',
                    'numeric' => 'Jumlah Kepala Keluarga harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_pria' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Pria !',
                    'numeric' => 'Jumlah penduduk Pria harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_wanita' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Wanita !',
                    'numeric' => 'Jumlah penduduk Wanita harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_usia_0_14' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Usia 0-14 !',
                    'numeric' => 'Jumlah penduduk Usia 0-14 harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_usia_15_64' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Usia 15-64 !',
                    'numeric' => 'Jumlah penduduk Usia 15-64 harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_usia_65_keatas' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Usia 65-Keatas !',
                    'numeric' => 'Jumlah penduduk Usia 65-Keatas harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_tidak_sekolah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Tidak Sekolah !',
                    'numeric' => 'Jumlah penduduk Tidak Sekolah harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_sd' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Menempuh Sekolah Dasar !',
                    'numeric' => 'Jumlah penduduk Menempuh Sekolah Dasar harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_smp' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Menempuh Sekolah Menengah Pertama !',
                    'numeric' => 'Jumlah penduduk Menempuh Sekolah Menengah Pertama harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_sma_smk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Menempuh Sekolah Menengah Keatas !',
                    'numeric' => 'Jumlah penduduk Menempuh Sekolah Menengah Keatas harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_diploma_sarjana' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Menempuh Diploma Atau Sarjana !',
                    'numeric' => 'Jumlah penduduk Menempuh Diploma Atau Sarjana harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_bekerja' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Memiliki Pekerjaan !',
                    'numeric' => 'Jumlah penduduk Memiliki Pekerjaan harus berupa angka !'
                ]
            ],
            'jumlah_penduduk_tidak_bekerja' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah penduduk Tidak Memiliki Pekerjaan !',
                    'numeric' => 'Jumlah penduduk Tidak Memiliki Pekerjaan harus berupa angka !'
                ]
            ],
            'jumlah_sekolah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah Sarana dan Prasarana Berupa Sekolah !',
                    'numeric' => 'Jumlah Sarana dan Prasarana Berupa Sekolah harus berupa angka !'
                ]
            ],
            'jumlah_posyandu' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah Sarana dan Prasarana Berupa Posyandu !',
                    'numeric' => 'Jumlah Sarana dan Prasarana Berupa Posyandu harus berupa angka !'
                ]
            ],
            'jumlah_tempat_ibadah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah Sarana dan Prasarana Berupa Tempat Ibadah !',
                    'numeric' => 'Jumlah Sarana dan Prasarana Berupa Tempat Ibadah harus berupa angka !'
                ]
            ],
            'jumlah_pos_ronda' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan jumlah Sarana dan Prasarana Berupa Pos Ronda !',
                    'numeric' => 'Jumlah Sarana dan Prasarana Berupa Pos Ronda harus berupa angka !'
                ]
            ],
        ])) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Update data ke database
        $this->m_desa->update($id_desa, [
            'id_user' => $id_user,
            'nama_desa' => $this->request->getPost('nama_desa'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'kabupaten' => $this->request->getPost('kabupaten'),
            'provinsi' => $this->request->getPost('provinsi'),
            'kode_pos' => $this->request->getPost('kode_pos'),
            'luas_wilayah' => $this->request->getPost('luas_wilayah'),
            'jumlah_penduduk' => $this->request->getPost('jumlah_penduduk'),
            'website' => $this->request->getPost('website'),
            'jumlah_kepala_keluarga' => $this->request->getPost('jumlah_kepala_keluarga'),
            'jumlah_penduduk_pria' => $this->request->getPost('jumlah_penduduk_pria'),
            'jumlah_penduduk_wanita' => $this->request->getPost('jumlah_penduduk_wanita'),
            'jumlah_penduduk_usia_0_14' => $this->request->getPost('jumlah_penduduk_usia_0_14'),
            'jumlah_penduduk_usia_15_64' => $this->request->getPost('jumlah_penduduk_usia_15_64'),
            'jumlah_penduduk_usia_65_keatas' => $this->request->getPost('jumlah_penduduk_usia_65_keatas'),
            'jumlah_penduduk_tidak_sekolah' => $this->request->getPost('jumlah_penduduk_tidak_sekolah'),
            'jumlah_penduduk_sd' => $this->request->getPost('jumlah_penduduk_sd'),
            'jumlah_penduduk_smp' => $this->request->getPost('jumlah_penduduk_smp'),
            'jumlah_penduduk_sma_smk' => $this->request->getPost('jumlah_penduduk_sma_smk'),
            'jumlah_penduduk_diploma_sarjana' => $this->request->getPost('jumlah_penduduk_diploma_sarjana'),
            'jumlah_penduduk_bekerja' => $this->request->getPost('jumlah_penduduk_bekerja'),
            'jumlah_penduduk_tidak_bekerja' => $this->request->getPost('jumlah_penduduk_tidak_bekerja'),
            'jumlah_sekolah' => $this->request->getPost('jumlah_sekolah'),
            'jumlah_posyandu' => $this->request->getPost('jumlah_posyandu'),
            'jumlah_tempat_ibadah' => $this->request->getPost('jumlah_tempat_ibadah'),
            'jumlah_pos_ronda' => $this->request->getPost('jumlah_pos_ronda'),
        ]);

        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah !');

        return redirect()->to('/admin/desa');
    }

    public function delete()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        $id_desa = $this->request->getPost('id_desa');

        if ($this->m_desa->delete($id_desa)) {
            return $this->response->setJSON(['success' => 'Data berhasil dihapus.']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal menghapus data.']);
        }
    }

    // Client Side
    public function totalData($id_user)
    {
        $totalData = $this->m_desa->getTotalDesa($id_user);
        // Keluarkan total data sebagai JSON response
        return $this->response->setJSON(['total' => $totalData]);
    }

    public function getDesaData($id_desa, $kategori)
    {
        $data = $this->m_desa->find($id_desa);
        $filteredData = [];
        $additionalInfo = [
            'luas_wilayah' => $data['luas_wilayah'], // Ambil dari model sesuai kebutuhan
            'jumlah_penduduk' => $data['jumlah_penduduk'] // Ambil dari model sesuai kebutuhan
        ];

        switch ($kategori) {
            case 'Jenis Kelamin':
                $filteredData = [
                    'Pria' => $data['jumlah_penduduk_pria'],
                    'Wanita' => $data['jumlah_penduduk_wanita']
                ];
                break;
            case 'Usia':
                $filteredData = [
                    '0-14 Tahun' => $data['jumlah_penduduk_usia_0_14'],
                    '15-64 Tahun' => $data['jumlah_penduduk_usia_15_64'],
                    '65 Tahun Keatas' => $data['jumlah_penduduk_usia_65_keatas']
                ];
                break;
            case 'Pendidikan':
                $filteredData = [
                    'Tidak Sekolah' => $data['jumlah_penduduk_tidak_sekolah'],
                    'SD' => $data['jumlah_penduduk_sd'],
                    'SMP' => $data['jumlah_penduduk_smp'],
                    'SMA/SMK' => $data['jumlah_penduduk_sma_smk'],
                    'Diploma/Sarjana' => $data['jumlah_penduduk_diploma_sarjana']
                ];
                break;
            case 'Pekerjaan':
                $filteredData = [
                    'Bekerja' => $data['jumlah_penduduk_bekerja'],
                    'Tidak Bekerja' => $data['jumlah_penduduk_tidak_bekerja']
                ];
                break;
            case 'Infrastruktur':
                $filteredData = [
                    'Sekolah' => $data['jumlah_sekolah'],
                    'Tempat Ibadah' => $data['jumlah_tempat_ibadah'],
                    'Posyandu' => $data['jumlah_posyandu'],
                    'Pos Ronda' => $data['jumlah_pos_ronda']
                ];
                break;
        }

        // Gabungkan filteredData dan additionalInfo
        $responseData = [
            'filteredData' => $filteredData,
            'additionalInfo' => $additionalInfo
        ];

        return $this->response->setJSON($responseData);
    }
}
