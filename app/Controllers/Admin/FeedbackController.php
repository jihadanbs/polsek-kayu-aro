<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class FeedbackController extends BaseController
{
    public function index()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
        }

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_feedback->getUnreadEntries();
        $unreadCount = $this->m_feedback->countUnreadEntries();
        //END WAJIB//

        $tb_feedback = $this->m_feedback->getAllData();

        $data = [
            'title' => 'Admin | Halaman Feedback Pengunjung',
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_feedback' => $tb_feedback,
        ];

        return view('admin/feedback/index', $data);
    }

    public function tambah()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
        }

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_feedback->getUnreadEntries();
        $unreadCount = $this->m_feedback->countUnreadEntries();
        //END WAJIB//

        $tb_feedback = $this->m_feedback->getFeedback();

        $data = [
            'title' => 'Admin | Halaman Tambah Feedback Pengunjung',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_feedback' => $tb_feedback
        ];

        return view('admin/feedback/tambah', $data);
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

        // Ambil data dari form
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $subjek = $this->request->getVar('subjek');
        $pesan = $this->request->getVar('pesan');

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
        $this->email->setSubject('Terima Kasih Atas Feedback Anda');
        $this->email->setMessage($emailBody);

        // Kirim email
        if ($this->email->send()) {
            session()->setFlashdata('pesan', 'Feedback Berhasil Diajukan Dan Email Telah Dikirim.');
        } else {
            session()->setFlashdata('gagal', 'Gagal Mengirim Email. Silakan Coba Lagi.');
        }

        // Simpan data ke database
        $this->m_feedback->save($data);

        return redirect()->back();
    }

    public function cek_data($id_feedback)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
        }

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_feedback->getUnreadEntries();
        $unreadCount = $this->m_feedback->countUnreadEntries();
        //END WAJIB//
        $tb_feedback = $this->m_feedback->getFeedback($id_feedback);

        $data = [
            'title' => 'Admin | Halaman Cek Data Feedback Pengunjung',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_feedback' => $tb_feedback
        ];

        return view('admin/feedback/cek_data', $data);
    }

    public function balas($id_feedback)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
        }

        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_feedback->getUnreadEntries();
        $unreadCount = $this->m_feedback->countUnreadEntries();
        //END WAJIB//
        $tb_feedback = $this->m_feedback->getFeedback($id_feedback);

        $data = [
            'title' => 'Admin | Halaman Balas Feedback Pengunjung',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_feedback' => $tb_feedback
        ];

        return view('admin/feedback/balas', $data);
    }

    public function kirim($id_feedback)
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
        }

        // Ambil data dari form
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $subjek = $this->request->getVar('subjek');
        $pesan = $this->request->getVar('pesan');
        $balasan = $this->request->getVar('balasan');

        // Validasi input
        if (!$this->validate([
            'balasan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom balasan Tidak Boleh Kosong !',
                ]
            ],
        ])) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Ambil nama pemohon dari database
        $tb_feedback = $this->m_feedback->getFeedback($id_feedback);
        if (!$tb_feedback) {
            session()->setFlashdata('gagal', 'Data pemohon tidak ditemukan.');
            return redirect()->to('/admin/feedback');
        }

        $nama = $tb_feedback->nama;
        $email = $tb_feedback->email;
        $subjek = $tb_feedback->subjek;
        $pesan = $tb_feedback->pesan;

        $data = [
            'id_feedback' => $id_feedback,
            'balasan' => $balasan,
            'status' => 'Sudah Ditanggapi'
        ];

        // Buat template email dengan data
        $emailData = [
            'nama' => $nama,
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
        $this->email->setSubject('Balasan Feedback untuk ' . $nama);
        $this->email->setMessage($emailBody);

        // Kirim email
        if ($this->email->send()) {
            session()->setFlashdata('pesan', 'Anda telah melakukan pemberian tanggapan ' . htmlspecialchars($nama) . ' dan pengiriman email ke alamat ' . htmlspecialchars($email) . ' &#128077;');
        } else {
            session()->setFlashdata('gagal', 'Gagal Mengirim Email ke alamat' . htmlspecialchars($email) . 'Silakan Coba Lagi Atau Mungkin Email Tidak Aktif');
        }

        // Simpan data ke database
        $this->m_feedback->save($data);

        return redirect()->to('/admin/feedback');
    }

    public function send()
    {
        // Ambil data dari form
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $subjek = $this->request->getVar('subjek');
        $pesan = $this->request->getVar('pesan');

        // Validasi input dasar
        $validationRules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Nama Tidak Boleh Kosong',
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
        $this->email->setSubject('Terima Kasih Atas Feedback Anda');
        $this->email->setMessage($emailBody);

        // Kirim email
        if ($this->email->send()) {
            // Simpan data ke database
            $this->m_feedback->save($data);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Feedback Berhasil Diajukan Dan Email Telah Dikirim'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal Mengirim Email. Silakan Coba Lagi'
            ]);
        }

        return view('index');
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

        $id_feedback = $this->request->getPost('id_feedback');

        if ($this->m_feedback->delete($id_feedback)) {
            return $this->response->setJSON(['success' => 'Data berhasil dihapus']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal menghapus data']);
        }
    }

    public function delete2()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
        }

        $id_feedback = $this->request->getPost('id_feedback');

        if ($this->m_feedback->delete($id_feedback)) {
            return $this->response->setJSON(['success' => 'Data berhasil dihapus']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal menghapus data']);
        }
    }

    public function totalData()
    {
        $totalData = $this->m_feedback->getTotalFeedback();
        // Keluarkan total data sebagai JSON response
        return $this->response->setJSON(['total' => $totalData]);
    }

    public function totalByStatus($status)
    {
        $total = $this->m_feedback->getTotalByStatus($status);
        return $this->response->setJSON(['total' => $total]);
    }
}
