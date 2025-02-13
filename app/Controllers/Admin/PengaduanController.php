<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class PengaduanController extends BaseController
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

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $tb_pengaduan = $this->m_pengaduan->getAllData();

        $data = [
            'title' => 'Admin | Halaman Pengaduan Masyarakat',
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_pengaduan' => $tb_pengaduan,
        ];

        return view('admin/pengaduan/index', $data);
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

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//

        $tb_pengaduan = $this->m_pengaduan->getPengaduan();

        $data = [
            'title' => 'Admin | Halaman Tambah Pengaduan Masyarakat',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_pengaduan' => $tb_pengaduan
        ];

        return view('admin/pengaduan/tambah', $data);
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

        // Ambil data dari form
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $subjek = $this->request->getPost('subjek');
        $pesan = $this->request->getPost('pesan');

        // Validasi input dasar
        $validationRules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Nama Tidak Boleh Kosong !',
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Email Tidak Boleh Kosong !',
                ]
            ],
            'subjek' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Subjek Tidak Boleh Kosong !',
                ]
            ],
            'pesan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Isi Pesan Tidak Boleh Kosong !',
                ]
            ],
        ];

        // Validasi input
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        $data = [
            'nama' => $nama,
            'subjek' => $subjek,
            'email' => $email,
            'pesan' => $pesan,
        ];

        // Buat template email dengan data
        $emailData = [
            'nama' => $nama,
            'email' => $email,
            'subjek' => $subjek,
            'pesan' => $pesan,
        ];

        // Load view template email
        $emailBody = view('Views/gmail/feedback_email.php', $emailData);

        // Set email parameters
        $this->email->setNewline("\r\n");
        $this->email->setMailType('html');
        $this->email->setTo($email);
        $this->email->setSubject('Terima Kasih Atas Pengaduan Anda');
        $this->email->setMessage($emailBody);

        // Kirim email
        if ($this->email->send()) {
            session()->setFlashdata('pesan', 'Pengaduan Berhasil Diajukan Dan Email Telah Dikirim !');
        } else {
            session()->setFlashdata('gagal', 'Gagal Mengirim Email. Silakan Coba Lagi !');
        }

        // Simpan data ke database
        $this->m_pengaduan->save($data);

        return redirect()->back();
    }

    public function cek_data($id_pengaduan)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//
        $tb_pengaduan = $this->m_pengaduan->getCekPengaduan($id_pengaduan);

        $data = [
            'title' => 'Admin | Halaman Cek Data Pengaduan Masyarakat',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_pengaduan' => $tb_pengaduan
        ];

        return view('admin/pengaduan/cek_data', $data);
    }

    public function balas($id_pengaduan)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_pengaduan->getUnreadEntries();
        $unreadCount = $this->m_pengaduan->countUnreadEntries();
        //END WAJIB//
        $tb_pengaduan = $this->m_pengaduan->getCekPengaduan($id_pengaduan);

        $data = [
            'title' => 'Admin | Halaman Balas Pengaduan Masyarakat',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_pengaduan' => $tb_pengaduan
        ];

        return view('admin/pengaduan/balas', $data);
    }

    public function kirim($id_pengaduan)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        // Ambil data dari form
        $nama = $this->request->getPost('nama');
        $no_telepon = $this->request->getPost('no_telepon');
        $nama_desa = $this->request->getPost('nama_desa');
        $nama_lengkap = $this->request->getPost('nama_lengkap');
        $kode_pengaduan = $this->request->getPost('kode_pengaduan');
        $email = $this->request->getPost('email');
        $subjek = $this->request->getPost('subjek');
        $pesan = $this->request->getPost('pesan');
        $balasan = $this->request->getPost('balasan');

        // Validasi input
        if (!$this->validate([
            'balasan' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Kolom balasan Tidak Boleh Kosong !',
                    'min_length' => 'Isi Konten tidak boleh kurang dari 10 karakter !',
                ]
            ],
        ])) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Ambil nama masyarakat dari database
        $tb_pengaduan = $this->m_pengaduan->getCekPengaduan($id_pengaduan);
        if (!$tb_pengaduan) {
            session()->setFlashdata('gagal', 'Data masyarakat tidak ditemukan.');
            return redirect()->to('/admin/pengaduan');
        }

        $nama = $tb_pengaduan['nama'];
        $no_telepon = $tb_pengaduan['no_telepon'];
        $nama_desa = $tb_pengaduan['nama_desa'];
        $nama_lengkap = $tb_pengaduan['nama_lengkap'];
        $kode_pengaduan = $tb_pengaduan['kode_pengaduan'];
        $email = $tb_pengaduan['email'];
        $subjek = $tb_pengaduan['subjek'];
        $pesan = $tb_pengaduan['pesan'];

        $data = [
            'id_pengaduan' => $id_pengaduan,
            'balasan' => $balasan,
            'status' => 'Sudah Ditanggapi'
        ];

        // Buat template email dengan data
        $emailData = [
            'nama' => $nama,
            'no_telepon' => $no_telepon,
            'nama_desa' => $nama_desa,
            'nama_lengkap' => $nama_lengkap,
            'kode_pengaduan' => $kode_pengaduan,
            'email' => $email,
            'subjek' => $subjek,
            'pesan' => $pesan,
            'balasan' => $balasan
        ];

        // Load view template email
        $emailBody = view('Views/gmail/tanggapan_email.php', $emailData);

        // Set email parameters
        $this->email->setNewline("\r\n");
        $this->email->setMailType('html');
        $this->email->setTo($email);
        $this->email->setSubject('Balasan Pengaduan untuk ' . $nama);
        $this->email->setMessage($emailBody);

        // Kirim email
        if ($this->email->send()) {
            session()->setFlashdata('pesan', 'Anda telah melakukan pemberian tanggapan ' . htmlspecialchars($nama) . ' dan pengiriman email ke alamat ' . htmlspecialchars($email) . ' !');
        } else {
            session()->setFlashdata('gagal', 'Gagal Mengirim Email ke alamat' . htmlspecialchars($email) . 'Silakan Coba Lagi Atau Mungkin Email Tidak Aktif !');
        }

        // Simpan data ke database
        $this->m_pengaduan->save($data);

        return redirect()->to('/admin/pengaduan');
    }

    public function send()
    {
        // Ambil data dari form
        $nama = $this->request->getPost('nama');
        $id_desa = $this->request->getPost('id_desa');
        $id_babin = $this->request->getPost('id_babin');
        $no_telepon = $this->request->getPost('no_telepon');
        $email = $this->request->getPost('email');
        $subjek = $this->request->getPost('subjek');
        $pesan = $this->request->getPost('pesan');
        $dokumentasi = uploadFileUmum('dokumentasi', 'dokumen/dokumentasi-masyarakat/');
        $kode_pengaduan = $this->m_pengaduan->generateKodePengaduan();

        $nama_desa = $this->m_desa->getNamaDesa($id_desa);
        $nama_babin = $this->m_babin->getNamaBabin($id_babin);

        // Validasi input dasar
        $validationRules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Nama Tidak Boleh Kosong',
                ]
            ],
            'id_babin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Nama Babin Tidak Boleh Kosong',
                ]
            ],
            'id_desa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Nama Desa Tidak Boleh Kosong',
                ]
            ],
            'no_telepon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom No Telepon Tidak Boleh Kosong',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Kolom Email Tidak Boleh Kosong',
                    'valid_email' => 'Silakan masukkan alamat email yang valid',
                ]
            ],
            'subjek' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Subjek Tidak Boleh Kosong',
                ]
            ],
            'pesan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Isi Pesan Tidak Boleh Kosong',
                ]
            ],
        ];

        // Validasi input
        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => \Config\Services::validation()->getErrors()
            ]);
        }

        $data = [
            'nama' => $nama,
            'subjek' => $subjek,
            'id_desa' => $id_desa,
            'id_babin' => $id_babin,
            'no_telepon' => $no_telepon,
            'email' => $email,
            'pesan' => $pesan,
            'dokumentasi' => $dokumentasi,
            'kode_pengaduan' => $kode_pengaduan
        ];

        // Buat template email dengan data
        $emailData = [
            'nama' => $nama,
            'nama_desa' => $nama_desa,
            'nama_lengkap' => $nama_babin,
            'no_telepon' => $no_telepon,
            'email' => $email,
            'subjek' => $subjek,
            'pesan' => $pesan,
            'kode_pengaduan' => $kode_pengaduan
        ];

        // Load view template email
        $emailBody = view('Views/gmail/feedback_email.php', $emailData);

        // Set email parameters
        $this->email->setNewline("\r\n");
        $this->email->setMailType('html');
        $this->email->setTo($email);
        $this->email->setSubject('Terima Kasih Atas Pengaduan Anda');
        $this->email->setMessage($emailBody);

        // Kirim email
        if ($this->email->send()) {
            // Simpan data ke database
            $this->m_pengaduan->save($data);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Pengaduan Berhasil Diajukan Dan Email Telah Dikirim !',
                'kode_pengaduan' => $kode_pengaduan
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal Mengirim Email. Silakan Coba Lagi !'
            ]);
        }
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

        $id_pengaduan = $this->request->getPost('id_pengaduan');

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $dataFiles = $this->m_pengaduan->getFilesById($id_pengaduan);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk pengaduan.');
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

            $this->m_pengaduan->deleteById($id_pengaduan);

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

    public function delete2()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda Tidak Memiliki Akses !');
        }

        $id_pengaduan = $this->request->getPost('id_pengaduan');

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $dataFiles = $this->m_pengaduan->getFilesById($id_pengaduan);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk pengaduan.');
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

            $this->m_pengaduan->deleteById($id_pengaduan);

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
        $totalData = $this->m_pengaduan->getTotalFeedback();
        // Keluarkan total data sebagai JSON response
        return $this->response->setJSON(['total' => $totalData]);
    }

    public function totalByStatus($status)
    {
        $total = $this->m_pengaduan->getTotalByStatus($status);
        return $this->response->setJSON(['total' => $total]);
    }
}
