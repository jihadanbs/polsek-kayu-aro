<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class BabinController extends BaseController
{
    public function index()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        // Ambil data babin dan desa berdasarkan id_user
        $tb_babin = $this->m_babin->getBabinByUserId();
        $tb_desa = $this->m_desa->getAllData();
        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $data = [
            'title' => 'Admin | Halaman Data Bhabin',
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_desa' => $tb_desa,
            'tb_babin' => $tb_babin
        ];

        return view('admin/babin/index', $data);
    }

    public function tambah()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        // Ambil data babin dan desa berdasarkan id_user
        $tb_babin = $this->m_babin->getBabinByUserId();
        $tb_desa = $this->m_desa->getAllData();
        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $data = [
            'title' => 'Admin | Halaman Tambah Data Babin',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_desa' => $tb_desa,
            'tb_babin' => $tb_babin
        ];

        return view('admin/babin/tambah', $data);
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

        // Ambil data dari request
        $id_desa = $this->request->getPost('id_desa'); // Mengambil sebagai array

        // Validasi input
        if (!$this->validate([
            'id_desa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan pilih nama desa yang Anda ampu !'
                ]
            ],
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan nama lengkap Anda !'
                ]
            ],
            'nrp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan nrp lengkap Anda !'
                ]
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan jabatan Anda !'
                ]
            ],
            'no_telepon' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan No Telepon / Whatsapp Anda !',
                    'numeric' => 'No Telepon harus berupa angka !',
                ]
            ],
            'pangkat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan pangkat Anda !',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Silahkan masukkan email Anda !',
                    'valid_email' => 'Email Tidak Valid harus memakai (@)'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan alamat Anda !',
                ]
            ],
            'tanggal_mulai_tugas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan tanggal mulai tugas !',
                ]
            ],
        ])) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->to('/admin/babin/tambah/')->withInput();
        }

        // Simpan data ke tabel tb_babin
        $this->m_babin->save([
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'nrp' => $this->request->getPost('nrp'),
            'jabatan' => $this->request->getPost('jabatan'),
            'pangkat' => $this->request->getPost('pangkat'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'email' => $this->request->getPost('email'),
            'alamat' => $this->request->getPost('alamat'),
            'tanggal_mulai_tugas' => $this->request->getPost('tanggal_mulai_tugas'),
            'foto' => uploadFileUmum('foto', 'dokumen/foto-bhabin/'),
        ]);

        // Dapatkan ID babin yang baru saja disimpan
        $id_babin = $this->m_babin->getInsertID();

        // Simpan data ke tabel junction babin_desa
        foreach ($id_desa as $desa) {
            $this->db->table('tb_babin_desa')->insert([
                'id_babin' => $id_babin,
                'id_desa' => $desa,
            ]);
        }

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan !');

        return redirect()->to('/admin/babin');
    }

    public function cek_data($id_babin)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        // Ambil data babin berdasarkan id_babin
        $tb_babin = $this->m_babin->getBabinById($id_babin);

        // Jika data babin tidak ditemukan, atau id_user tidak sesuai, redirect ke halaman sebelumnya
        if (!$tb_babin) {
            return redirect()->back()->with('gagal', 'Data Bhabin tidak ditemukan atau Anda tidak memiliki akses');
        }

        // Ambil data desa dan user
        $tb_desa = $this->m_desa->getAllData(); // Filter berdasarkan id_user
        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $data = [
            'title' => 'Admin | Halaman Cek Data Bhabin',
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_desa' => $tb_desa,
            'tb_babin' => $tb_babin
        ];

        return view('admin/babin/cek_data', $data);
    }

    public function edit($id_babin)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        // Ambil data babin berdasarkan id_babin
        $tb_babin = $this->m_babin->getBabinById($id_babin);

        // Jika data babin tidak ditemukan, atau id_user tidak sesuai, redirect ke halaman sebelumnya
        if (!$tb_babin) {
            return redirect()->back()->with('gagal', 'Data Bhabin tidak ditemukan atau Anda tidak memiliki akses');
        }

        // Ambil data desa dan user
        $tb_desa = $this->m_desa->getAllData(); // Filter berdasarkan id_user
        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        // Ambil ID desa yang sudah dipilih
        $selected_desa_ids = array_column($this->m_babin->getSelectedDesaIds($id_babin), 'id_desa');

        $data = [
            'title' => 'Admin | Halaman Edit Data Bhabin',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_desa' => $tb_desa,
            'tb_babin' => $tb_babin,
            'selected_desa_ids' => $selected_desa_ids
        ];

        return view('admin/babin/edit', $data);
    }


    public function update($id_babin)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        // Ambil data dari request
        $id_desa = $this->request->getPost('id_desa');
        // Validasi input
        if (!$this->validate([
            'id_desa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan pilih nama desa yang Anda ampu !'
                ]
            ],
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan nama lengkap Anda !'
                ]
            ],
            'nrp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan nrp lengkap Anda !'
                ]
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan jabatan Anda !'
                ]
            ],
            'no_telepon' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan No Telepon / Whatsapp Anda !',
                    'numeric' => 'No Telepon harus berupa angka !',
                ]
            ],
            'pangkat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan pangkat Anda !',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Silahkan masukkan email Anda !',
                    'valid_email' => 'Email Tidak Valid harus memakai (@)'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan alamat Anda !',
                ]
            ],
            'tanggal_mulai_tugas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan tanggal mulai tugas !',
                ]
            ],
        ])) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->to('/admin/babin/edit/' . $id_babin)->withInput();
        }

        // Handle file upload
        $oldFileName = $this->request->getPost('current_foto'); // Nama file lama dari input hidden

        // Update data di tb_babin
        $this->m_babin->update($id_babin, [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'nrp' => $this->request->getPost('nrp'),
            'jabatan' => $this->request->getPost('jabatan'),
            'pangkat' => $this->request->getPost('pangkat'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'email' =>  $this->request->getPost('email'),
            'alamat' => $this->request->getPost('alamat'),
            'tanggal_mulai_tugas' => $this->request->getPost('tanggal_mulai_tugas'),
            'foto' => updateFileUmum('foto', 'dokumen/foto-bhabin/', $oldFileName),
        ]);

        // Update data di tb_babin_desa
        // Pertama, hapus entri yang ada untuk id_babin ini
        $this->db->table('tb_babin_desa')->where('id_babin', $id_babin)->delete();

        // Masukkan entri baru
        foreach ($id_desa as $desa) {
            $this->db->table('tb_babin_desa')->insert([
                'id_babin' => $id_babin,
                'id_desa' => $desa,
            ]);
        }

        // kasih pesan jika sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah !');

        return redirect()->to('/admin/babin');
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

        $id_babin = $this->request->getPost('id_babin');

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $dataFiles = $this->m_babin->getFilesById($id_babin);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk babin !');
            }

            foreach ($dataFiles[0] as $fileColumn => $filePath) {
                if (!empty($filePath)) {
                    $fullFilePath = ROOTPATH . 'public/' . $filePath;
                    if (is_file($fullFilePath)) {
                        if (!unlink($fullFilePath)) {
                            throw new \Exception('Gagal menghapus file: ' . $fullFilePath);
                        }
                    }
                }
            }

            $this->m_babin->deleteById($id_babin);

            $db->transComplete();

            if ($db->transStatus() === false) {
                $db->transRollback();
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data']);
            }

            $db->transCommit();
            return $this->response->setJSON(['status' => 'success', 'message' => 'Semua file dan data berhasil dihapus']);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data', 'error' => $e->getMessage()]);
        }
    }

    public function totalData()
    {
        $totalData = $this->m_babin->getTotalBabin();
        // Keluarkan total data sebagai JSON response
        return $this->response->setJSON(['total' => $totalData]);
    }
}
