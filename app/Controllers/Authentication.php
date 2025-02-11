<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Authentication extends BaseController
{
    protected $session;
    protected $m_user;
    protected $validation;
    protected $email;

    public function __construct()
    {
        $this->session = session();
        $this->m_user = new UserModel();
        $this->validation = \Config\Services::validation();
        $this->email = \Config\Services::email();
    }

    public function registrasi()
    {
        $data = [
            'title' => 'Registrasi Polsek Kayu Aro',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'pesan' => session()->getFlashdata('pesan'),
            'gagal' => session()->getFlashdata('gagal')
        ];

        return view('users/registrasi', $data);
    }

    public function cekRegistrasi()
    {
        // Ambil data dari request
        $nama_lengkap = $this->request->getVar('nama_lengkap');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $email = $this->request->getVar('email');
        $no_telepon = $this->request->getVar('no_telepon');
        $konfirmasi_password = $this->request->getVar('konfirmasi_password');

        // Log untuk debug
        log_message('debug', 'Data Registrasi: ' . print_r($this->request->getPost(), true));

        // Validasi input 
        $validationRules = [
            'nama_lengkap' => [
                'rules' => 'required|nama_check[tb_user,nama_lengkap]',
                'errors' => [
                    'required' => 'Masukkan Nama lengkap anda !',
                    'nama_check' => 'Nama sudah terdaftar dalam sistem !'
                ]
            ],
            'username' => [
                'rules' => 'required|trim|max_length[10]|min_length[5]|username_check[tb_user,username]',
                'errors' => [
                    'required' => 'Kolom Username tidak boleh kosong !',
                    'max_length' => 'Username tidak boleh melebihi 10 karakter !',
                    'min_length' => 'Username tidak boleh kurang dari 5 karakter !',
                    'username_check' => 'Username sudah dipakai oleh user lain !'
                ]
            ],
            'email' => [
                'rules' => 'required|trim|valid_email|email_check[tb_user,email]',
                'errors' => [
                    'required' => 'Kolom Email tidak boleh kosong !',
                    'valid_email' => 'Email tidak valid gunakan @ !',
                    'email_check' => 'Email sudah terdaftar !'
                ]
            ],
            'no_telepon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom No Telepon tidak boleh kosong !',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[2]',
                'errors' => [
                    'required' => 'Kolom Kata Sandi tidak boleh kosong !',
                    'min_length' => 'Kata Sandi tidak boleh kurang dari 2 karakter !'
                ]
            ],
            'konfirmasi_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Kolom Konfirmasi Kata Sandi tidak boleh kosong !',
                    'matches' => 'Konfirmasi Kata Sandi tidak sesuai dengan Kata Sandi !'
                ]
            ],
        ];

        if (!$this->validate($validationRules)) {
            session()->setFlashdata('validation', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }

        // Enkripsi password sebelum disimpan
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->m_user->save([
            'id_jabatan' => 1,
            'username' => $username,
            'password' => $hashedPassword,
            'email' => $email,
            'no_telepon' => $no_telepon,
            'nama_lengkap' => $nama_lengkap,
            'konfirmasi_password' => $konfirmasi_password
        ]);

        session()->setFlashdata('pesan', 'Anda berhasil melakukan registrasi');

        return redirect()->to('authentication/login');
    }

    public function login()
    {
        // Jika pengguna sudah login, arahkan kembali dan beri pesan
        if ($this->session->has('islogin')) {
            return redirect()->to('dashboard');
        }

        $data = [
            'title' => 'Login Polsek Kayu Aro',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'pesan' => session()->getFlashdata('pesan'),
            'gagal' => session()->getFlashdata('gagal')
        ];

        return view('users/login', $data);
    }

    public function cekLogin()
    {
        if ($this->session->has('islogin')) {
            return redirect()->back()->with('pesan', 'Anda Sudah Login');
        }

        $session = $this->session;

        if ($this->request->getPost()) {
            $rules = [
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username atau Email harus di isi !',
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password harus di isi !',
                    ]
                ]
            ];

            if ($this->validate($rules)) {
                $userModel = new UserModel();

                $usernameOrEmail = $this->request->getVar('username');
                $password = $this->request->getVar('password');

                $user = $userModel->where('email', $usernameOrEmail)
                    ->orWhere('username', $usernameOrEmail)
                    ->first();

                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        if ($user['status'] == 'aktif') {
                            // Cek apakah pengguna sudah login di browser lain
                            if ($user['is_logged_in']) {
                                return redirect()->to('authentication/login')->with('gagal', 'Anda sudah login menggunakan aplikasi browser lain');
                            }

                            // Periksa apakah password perlu direset
                            if (!empty($user['password_last_reset'])) {
                                $passwordLastReset = new \DateTime($user['password_last_reset']);
                                $currentDate = new \DateTime();
                                $interval = $passwordLastReset->diff($currentDate);

                                if ($interval->days > 30) {
                                    return redirect()->to('authentication/lupaPassword')->with('warning', 'Password Anda sudah kadaluarsa. Silakan reset password Anda.');
                                }
                            }

                            // Perbarui kolom terakhir_login dan set is_logged_in menjadi true
                            $userModel->updateData($user['id_user'], [
                                'terakhir_login' => date('Y-m-d H:i:s'),
                                'is_logged_in' => true
                            ]);

                            // Set session data
                            $session->set([
                                'id_user' => $user['id_user'],
                                'username' => $user['username'],
                                'email' => $user['email'],
                                'id_jabatan' => $user['id_jabatan'],
                                'nama_lengkap' => $user['nama_lengkap'],
                                'no_telepon' => $user['no_telepon'],
                                'password_last_reset' => $user['password_last_reset'],
                                'terakhir_login' => $user['terakhir_login'],
                                'file_profil' => $user['file_profil'],
                                'islogin' => true
                            ]);

                            if ($user['id_jabatan'] == 1) {
                                return redirect()->to('admin/dashboard');
                            } elseif ($user['id_jabatan'] == 2) {
                                return redirect()->to('staff/dashboard');
                            }
                        } elseif ($user['status'] == 'tidak aktif') {
                            $session->setFlashdata('gagal', 'Akun anda dinonaktifkan');
                        }
                    } else {
                        $session->setFlashdata('validation', ['password' => 'Password yang Anda masukkan salah !']);
                    }
                } else {
                    $session->setFlashdata('validation', ['username' => 'Username / Email tidak ditemukan !']);
                }
            } else {
                $session->setFlashdata('validation', $this->validator->getErrors());
            }
        }

        return redirect()->to('authentication/login')->withInput()->with('gagal', 'Silahkan Login Ulang !');
    }

    public function lupaPassword()
    {
        $err = [];

        if ($this->request->getPost()) {
            $username = $this->request->getVar('username');

            // Validasi username/email tidak boleh kosong
            if (empty($username)) {
                $err['username'] = "Silahkan masukkan username atau email yang sudah terdaftar";
            } elseif (!filter_var($username, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9]+$/', $username)) {
                $err['username'] = "Format username atau email tidak valid";
            }

            if (empty($err)) {
                $userModel = new UserModel();
                $data = $userModel->getData($username);

                if (empty($data)) {
                    $err['username'] = "Akun yang kamu masukkan tidak terdaftar";
                }
            }

            if (empty($err)) {
                $email = $data['email'];
                $token = md5(date('ymdhis'));

                $link = site_url("authentication/resetPassword/?email=$email&token=$token");

                // Load template php dari file
                $emailTemplate = file_get_contents(APPPATH . 'Views/gmail/reset_password_gmail.php');

                // Replace placeholders dengan nilai sebenarnya
                $emailContent = str_replace(['{reset_link}', '{token}'], [$link, $token], $emailTemplate);

                // Konfigurasi email
                $this->email->setNewline("\r\n");
                $this->email->setMailType('html');
                $this->email->setTo($email);
                $this->email->setSubject('Reset Password');
                $this->email->setMessage($emailContent);

                if ($this->email->send()) {
                    $dataUpdate = [
                        'token' => $token
                    ];
                    $userModel->updateData($data['id_user'], $dataUpdate);
                    session()->setFlashdata("success", "Link recovery sudah kami kirimkan ke email anda");
                } else {
                    session()->setFlashdata("error", "Gagal mengirim email.");
                }
            }

            if ($err) {
                session()->setFlashdata("username", $username);
                session()->setFlashdata("validation", $err);
            }

            return redirect()->to("authentication/lupaPassword");
        }

        $data = [
            'title' => 'Lupa Password Polsek Kayu Aro',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        ];

        return view('users/lupaPassword', $data);
    }

    public function resetPassword()
    {
        $dataAkun = null;
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');

        if ($email != '' && $token != '') {
            $dataAkun = $this->m_user->getData($email);
            if (!$dataAkun || $dataAkun['token'] != $token) {
                // Jika tidak ada data akun atau token tidak valid, arahkan pengguna ke halaman yang sesuai
                return redirect()->to('authentication/lupaPassword')->with('warning', 'Token Sudah Tidak Valid');
            }
        } else {
            // Jika email atau token kosong, arahkan pengguna ke halaman yang sesuai
            return redirect()->to('authentication/lupaPassword')->with('warning', 'Parameter Yang Dikirimkan Tidak Valid');
        }

        if ($this->request->getPost()) {
            $rules = [
                'password' => [
                    'rules' => 'required|min_length[6]',
                    'errors' => [
                        'required' => 'Password harus diisi',
                        'min_length' => 'Kata Sandi Baru harus memiliki panjang minimal 6 karakter',
                    ]
                ],
                'konfirmasi_password' => [
                    'rules' => 'required|min_length[6]|matches[password]',
                    'errors' => [
                        'required' => 'Konfirmasi password harus diisi',
                        'min_length' => 'Konfirmasi password minimal 6 karakter',
                        'matches' => 'Konfirmasi password tidak sama dengan password di atas'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                session()->setFlashdata('validation', $this->validator->getErrors());
            } else {
                if ($dataAkun && isset($dataAkun['id_user'])) {
                    $id_user = $dataAkun['id_user'];
                    $dataUpdate = [
                        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                        'password_last_reset' => date('Y-m-d H:i:s'),
                        'token' => null
                    ];
                    $this->m_user->updateData($id_user, $dataUpdate);
                    session()->setFlashdata('success', 'Password berhasil direset, silahkan login menggunakan password baru anda');
                    return redirect()->to('authentication/login');
                } else {
                    session()->setFlashdata('error', 'Terjadi kesalahan saat mereset password');
                }
            }
        }

        $data = [
            'title' => 'Reset Password Polsek Kayu Aro',
            'validation' => session()->getFlashdata('validation') ?? [],
            'old_input' => $this->request->getPost(), // Menggunakan input yang baru saja dikirimkan
        ];

        return view('users/resetPassword', $data);
    }

    public function tidakBisaLogin()
    {
        $err = [];

        if ($this->request->getPost()) {
            $username = $this->request->getVar('username');

            // Validasi username/email tidak boleh kosong
            if (empty($username)) {
                $err['username'] = "Silahkan masukkan username atau email yang sudah terdaftar";
            } elseif (!filter_var($username, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9]+$/', $username)) {
                $err['username'] = "Format username atau email tidak valid";
            }

            if (empty($err)) {
                $userModel = new UserModel();
                $data = $userModel->getData($username);

                if (empty($data)) {
                    $err['username'] = "Akun yang kamu masukkan tidak terdaftar";
                }
            }

            if (empty($err)) {
                $email = $data['email'];
                $token = md5(date('ymdhis'));
                $kode_verifikasi = $this->m_user->generateKodeStatusLogin();
                $link = site_url("authentication/resetStatusLogin/?email=$email&token=$token");

                // Load template php dari file
                $emailTemplate = file_get_contents(APPPATH . 'Views/gmail/reset_login_gmail.php');

                // Replace placeholders dengan nilai sebenarnya
                $emailContent = str_replace(['{link_reset}', '{token}', '{kode_verifikasi}'], [$link, $token, $kode_verifikasi], $emailTemplate);

                // Konfigurasi email
                $this->email->setNewline("\r\n");
                $this->email->setMailType('html');
                $this->email->setTo($email);
                $this->email->setSubject('Reset Status Login');
                $this->email->setMessage($emailContent);

                if ($this->email->send()) {
                    $dataUpdate = [
                        'token' => $token,
                        'kode_verifikasi' => $kode_verifikasi
                    ];
                    $userModel->updateData($data['id_user'], $dataUpdate);
                    session()->setFlashdata("success", "Link recovery sudah kami kirimkan ke email anda");
                } else {
                    session()->setFlashdata("error", "Gagal mengirim email.");
                }
            }

            if ($err) {
                session()->setFlashdata("username", $username);
                session()->setFlashdata("validation", $err);
            }

            return redirect()->to("authentication/tidakBisaLogin");
        }

        $data = [
            'title' => 'Tidak Dapat Login',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        ];

        return view('users/tidakBisaLogin', $data);
    }

    public function resetStatusLogin()
    {
        $dataAkun = null;
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');

        if ($email != '' && $token != '') {
            $dataAkun = $this->m_user->getData($email);
            if (!$dataAkun || $dataAkun['token'] != $token) {
                // Jika tidak ada data akun atau token tidak valid, arahkan pengguna ke halaman yang sesuai
                return redirect()->to('authentication/tidakBisaLogin')->with('warning', 'Token Sudah Tidak Valid');
            }
            // Jika email dan token valid, ambil email untuk ditampilkan
            $userEmail = $dataAkun['email'];
        } else {
            // Jika email atau token kosong, arahkan pengguna ke halaman yang sesuai
            return redirect()->to('authentication/tidakBisaLogin')->with('warning', 'Parameter Yang Dikirimkan Tidak Valid');
        }

        if ($this->request->getPost()) {
            // Validasi setiap digit
            $rules = [
                'digit1' => 'required',
                'digit2' => 'required',
                'digit3' => 'required',
                'digit4' => 'required',
            ];

            $errors = [
                'digit1' => [
                    'required' => 'Digit pertama harus diisi!',
                ],
                'digit2' => [
                    'required' => 'Digit kedua harus diisi!',
                ],
                'digit3' => [
                    'required' => 'Digit ketiga harus diisi!',
                ],
                'digit4' => [
                    'required' => 'Digit keempat harus diisi!',
                ],
            ];

            if (!$this->validate($rules, $errors)) {
                // Jika validasi gagal, simpan pesan error
                session()->setFlashdata('validation', $this->validator->getErrors());
            } else {
                // Validasi berhasil, proses kode verifikasi
                $digit1 = $this->request->getPost('digit1');
                $digit2 = $this->request->getPost('digit2');
                $digit3 = $this->request->getPost('digit3');
                $digit4 = $this->request->getPost('digit4');

                // Gabungkan digit menjadi kode verifikasi
                $kode_verifikasi = "{$digit1}-{$digit2}-{$digit3}-{$digit4}";

                // Mengecek apakah kode verifikasi cocok dengan yang tersimpan di database
                if ($kode_verifikasi === $dataAkun['kode_verifikasi']) {
                    // Jika cocok, reset kode verifikasi dan token
                    if ($dataAkun && isset($dataAkun['id_user'])) {
                        $id_user = $dataAkun['id_user'];
                        $dataUpdate = [
                            'token' => null,
                            'kode_verifikasi' => null, // Set kode verifikasi menjadi null
                            'is_logged_in' => 0
                        ];
                        $this->m_user->updateData($id_user, $dataUpdate);
                        session()->setFlashdata('success', 'Akun anda telah dipulihkan, silahkan login!');
                        return redirect()->to('authentication/login');
                    } else {
                        session()->setFlashdata('gagal', 'Terjadi kesalahan saat mereset status login, silahkan coba lagi !');
                    }
                } else {
                    // Jika kode verifikasi tidak cocok
                    session()->setFlashdata('gagal', 'Kode tidak valid !');
                }
            }
        }

        $data = [
            'title' => 'Reset Status Login',
            'validation' => session()->getFlashdata('validation') ?? [],
            'old_input' => $this->request->getPost(), // Menggunakan input yang baru saja dikirimkan
            'userEmail' => isset($userEmail) ? $userEmail : null,
        ];

        return view('users/resetStatusLogin', $data);
    }

    public function logout()
    {
        $this->m_user->setLoginStatus(session()->get('id_user'), false);

        $this->session->destroy();
        return redirect()->to('authentication/login')->with('pesan', 'Anda sudah logout');
    }
}
