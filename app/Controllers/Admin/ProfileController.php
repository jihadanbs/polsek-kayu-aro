<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ProfileController extends BaseController
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

        $tb_jabatan = $this->m_jabatan->getAll();
        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_feedback->getUnreadEntries();
        $unreadCount = $this->m_feedback->countUnreadEntries();
        //END WAJIB//

        $data = [
            'title' => 'Admin | Profile',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_jabatan' => $tb_jabatan,
        ];

        return view('admin/profile/index', $data);
    }

    public function update($id_user)
    {
        // Cek session
        if (!session()->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
        }

        // Validasi input
        if (!$this->validate([
            'nama_lengkap' => [
                'rules' => 'required|trim|max_length[255]|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Nama Lengkap Anda Tidak Boleh Kosong',
                    'max_length' => 'Inputan tidak boleh melebihi 255 karakter.',
                    'min_length' => 'Inputan tidak boleh kurang dari 5 karakter.'
                ]
            ],
            'username' => [
                'rules' => 'required|trim|max_length[10]|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Username Anda Tidak Boleh Kosong',
                    'max_length' => 'Inputan tidak boleh melebihi 10 karakter.',
                    'min_length' => 'Inputan tidak boleh kurang dari 5 karakter.'
                ]
            ],
            'email' => [
                'rules' => 'required|trim|max_length[50]|valid_email',
                'errors' => [
                    'required' => 'Kolom Email Anda Tidak Boleh Kosong',
                    'max_length' => 'Inputan tidak boleh melebihi 50 karakter.',
                    'valid_email' => 'Format Email tidak valid.'
                ]
            ],
            'no_telepon' => [
                'rules' => 'required|trim|max_length[20]|numeric',
                'errors' => [
                    'required' => 'Kolom No. Telepon Anda Tidak Boleh Kosong',
                    'max_length' => 'Inputan tidak boleh melebihi 20 karakter.',
                    'numeric' => 'No. Telepon harus berupa angka.'
                ]
            ],
        ])) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Panggil helper updateFile
        $oldFileName = $this->request->getVar('old_file_profil'); // Nama file lama harus diambil dari input hidden
        $newFileName = $this->request->getFile('file_profil')->isValid() ?
            updateFile('file_profil', 'dokumen/profile/', $oldFileName) :
            $oldFileName;

        // Simpan data ke dalam database
        $this->m_user->save([
            'id_user' => $id_user,
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'no_telepon' => $this->request->getVar('no_telepon'),
            'file_profil' => $newFileName
        ]);

        // Perbarui nilai sesi setelah menyimpan ke database
        session()->set([
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'no_telepon' => $this->request->getVar('no_telepon'),
            'file_profil' => $newFileName
        ]);

        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah &#128077;');

        return redirect()->to('/admin/profile');
    }

    public function resetPassword()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
        }

        $tb_jabatan = $this->m_jabatan->getAll();
        //WAJIB//
        $tb_user = $this->m_user->getAll();
        $unread = $this->m_feedback->getUnreadEntries();
        $unreadCount = $this->m_feedback->countUnreadEntries();
        //END WAJIB//

        $data = [
            'title' => 'Admin | Atur Ulang Kata Sandi',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            //WAJIB//
            'tb_user' => $tb_user,
            'unread' => $unread,
            'unreadCount' => $unreadCount,
            //END WAJIB//
            'tb_jabatan' => $tb_jabatan,
        ];

        return view('admin/profile/resetpassword', $data);
    }

    public function updateSandi()
    {
        // Validasi input
        if (!$this->validate([
            'sandi_lama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib diisi &#128541',
                ],
            ],
            'sandi_baru' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Wajib diisi &#128541',
                    'min_length' => 'Kata Sandi Baru harus memiliki panjang minimal 6 karakter &#128548'
                ]
            ],
            'konfirmasi_sandi_baru' => [
                'rules' => 'required|matches[sandi_baru]',
                'errors' => [
                    'required' => 'Wajib diisi &#128541',
                    'matches' => 'Konfirmasi Kata Sandi Baru harus sama dengan Kata Sandi Baru Anda Yang Diatas &#129303'
                ]
            ],
        ])) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Ambil data pengguna dari sesi
        $id_user = session('id_user');

        // Pastikan id_user ada dalam sesi
        if (!$id_user) {
            session()->setFlashdata('gagal', 'ID pengguna tidak ditemukan dalam sesi');
            return redirect()->to('authentication/login');
        }

        // Ambil data pengguna berdasarkan id_user
        $user = $this->m_user->getUserById($id_user);

        // Pastikan $user adalah objek sebelum mengakses propertinya
        if ($user && password_verify($this->request->getVar('sandi_lama'), $user->password)) {
            // Generate hash baru untuk kata sandi baru
            $new_password_hash = password_hash($this->request->getVar('sandi_baru'), PASSWORD_DEFAULT);

            // Update kata sandi baru dan kolom password_last_reset
            $this->m_user->updateData($id_user, [
                'password' => $new_password_hash,
                'password_last_reset' => date('Y-m-d H:i:s'),
            ]);

            // Perbarui nilai sesi setelah menyimpan ke database
            session()->set([
                'password_last_reset' => date('Y-m-d H:i:s'),
            ]);

            // Setelah update sukses, tampilkan pesan berhasil
            session()->setFlashdata('pesan', 'Kata sandi berhasil diubah');
            return redirect()->to('admin/profile/resetpassword');
        } else {
            // Jika kata sandi lama tidak cocok
            session()->setFlashdata('gagal', 'Kata sandi lama tidak cocok');
            return redirect()->to('admin/profile/resetpassword')->withInput();
        }
    }
}
