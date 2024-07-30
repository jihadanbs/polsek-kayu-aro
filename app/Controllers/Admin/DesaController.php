<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DesaController extends BaseController
{
    public function index()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        $id_user = session()->get('id_user');

        // Pastikan hanya pengguna dengan id_user yang sesuai yang dapat mengakses halaman
        if (session()->get('id_user') != $id_user) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda tidak memiliki akses ke halaman ini');
        }

        $tb_desa = $this->m_desa->getAllDataByUser($id_user);
        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_feedback->getUnreadEntries();
        $unreadCount = $this->m_feedback->countUnreadEntries();
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
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        // Pastikan hanya pengguna dengan id_user yang sesuai yang dapat mengakses halaman
        $id_user = session()->get('id_user');
        if (session()->get('id_user') != $id_user) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda tidak memiliki akses ke halaman ini');
        }

        $tb_desa = $this->m_desa->getAllDataByUser($id_user);
        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_feedback->getUnreadEntries();
        $unreadCount = $this->m_feedback->countUnreadEntries();
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
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
        }

        // Ambil data dari request
        $nama_desa = $this->request->getVar('nama_desa');
        $kecamatan = $this->request->getVar('kecamatan');
        $kabupaten = $this->request->getVar('kabupaten');
        $provinsi = $this->request->getVar('provinsi');
        $kode_pos = $this->request->getVar('kode_pos');
        $luas_wilayah = $this->request->getVar('luas_wilayah');
        $jumlah_penduduk = $this->request->getVar('jumlah_penduduk');
        $website = $this->request->getVar('website');

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
        ])) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->to('/admin/desa/tambah/')->withInput();
        }

        // Ambil id_user dari session
        $id_user = session()->get('id_user');

        // Simpan data ke database
        $this->m_desa->save([
            'nama_desa' => $nama_desa,
            'kecamatan' => $kecamatan,
            'kabupaten' => $kabupaten,
            'provinsi' => $provinsi,
            'kode_pos' => $kode_pos,
            'luas_wilayah' => $luas_wilayah,
            'jumlah_penduduk' => $jumlah_penduduk,
            'website' => $website,
            'id_user' => $id_user // Menambahkan id_user
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan &#128077;');

        return redirect()->to('/admin/desa');
    }


    public function cek_data($id_desa)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        // Pastikan id_desa adalah milik id_user yang sedang login
        $id_user = session()->get('id_user');
        $desa = $this->m_desa->getDesa($id_desa);

        if (!$desa || $desa['id_user'] != $id_user) {
            return redirect()->back()->with('gagal', 'Data desa tidak ditemukan atau Anda tidak memiliki akses');
        }

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_feedback->getUnreadEntries();
        $unreadCount = $this->m_feedback->countUnreadEntries();
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
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
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
        $unread = $this->m_feedback->getUnreadEntries();
        $unreadCount = $this->m_feedback->countUnreadEntries();
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
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
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
        ])) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Update data ke database
        $this->m_desa->save([
            'id_desa' => $id_desa,
            'nama_desa' => $this->request->getVar('nama_desa'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'provinsi' => $this->request->getVar('provinsi'),
            'kode_pos' => $this->request->getVar('kode_pos'),
            'luas_wilayah' => $this->request->getVar('luas_wilayah'),
            'jumlah_penduduk' => $this->request->getVar('jumlah_penduduk'),
            'website' => $this->request->getVar('website'),
            'id_user' => $id_user // Menambahkan id_user
        ]);

        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah &#128077;');

        return redirect()->to('/admin/desa');
    }

    public function delete()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
        }

        $id_desa = $this->request->getVar('id_desa');

        if ($this->m_desa->delete($id_desa)) {
            return $this->response->setJSON(['success' => 'Data berhasil dihapus.']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal menghapus data.']);
        }
    }

    public function totalData($id_user)
    {
        $totalData = $this->m_desa->getTotalDesa($id_user);
        // Keluarkan total data sebagai JSON response
        return $this->response->setJSON(['total' => $totalData]);
    }
}
