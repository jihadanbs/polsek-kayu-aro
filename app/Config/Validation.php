<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;
use App\Models\UserModel;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        Validation::class,

    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public function is_unique_judul($str, string $fields, array $data): bool
    {
        $params = explode(',', $fields);
        $table = array_shift($params);
        $builder = db_connect()->table($table);

        // Mendapatkan id_kategori_informasi dari $data jika tersedia
        $id_kategori_informasi = isset($data[$params[0]]) ? $data[$params[0]] : null;

        // Memeriksa keunikan judul hanya jika id_kategori_informasi dan id_kategori_informasi telah dipilih
        if ($id_kategori_informasi !== null) {
            $builder->where('judul', $str)
                ->where('id_kategori_informasi', $id_kategori_informasi);
        } else {
            // Jika salah satu atau ketiga nilai tidak ada, abaikan periksa keunikan judul
            return true;
        }

        // Menghitung jumlah baris yang sesuai dengan kriteria
        return $builder->countAllResults() === 0;
    }

    public function username_check(string $str, string $fields, array $data): bool
    {
        $userModel = new UserModel();
        $user = $userModel->where('username', $str)->first();

        return $user === null;
    }

    public function email_check(string $str, string $fields, array $data): bool
    {
        $userModel = new UserModel();
        $user = $userModel->where('email', $str)->first();

        return $user === null;
    }

    public function nama_check(string $str, string $fields, array $data): bool
    {
        $userModel = new UserModel();
        $user = $userModel->where('nama_lengkap', $str)->first();

        return $user === null;
    }

    // public function title_exists(string $str, string &$fields, array $data): bool
    // {
    //     $model = new InformasiPublikModel();
    //     return $model->isTitleExists($data['id_lembaga'], $data['id_kategori_informasi_publik'], $data['id_jenis'], $str) === null;
    // }

    // public function is_unique_judul(string $str, string $fields, array $data): bool
    // {
    //     $params = explode(',', $fields);
    //     $table = array_shift($params);
    //     $builder = db_connect()->table($table);

    //     $id_lembaga = $data[$params[0]] ?? null;
    //     $id_kategori_informasi = $data[$params[1]] ?? null;
    //     $id_jenis = $data[$params[2]] ?? null;

    //     if ($id_lembaga !== null && $id_kategori_informasi !== null && $id_jenis !== null) {
    //         $builder->where('judul', $str)
    //             ->where('id_lembaga', $id_lembaga)
    //             ->where('id_kategori_informasi', $id_kategori_informasi)
    //             ->where('id_jenis', $id_jenis);
    //     } else {
    //         return true;
    //     }

    //     return $builder->countAllResults() === 0;
    // }

    public function password_match(string $str, ?string $fields = null, array $data = []): bool
    {
        // Pastikan parameter fields tidak null
        if ($fields === null) {
            return false;
        }

        // Ekstrak parameter tabel dan kolom ID pengguna dari string fields
        [$table, $userIdColumn] = explode(',', $fields);

        // Pastikan kolom ID pengguna tersedia dalam $data
        if (!isset($data[$userIdColumn])) {
            return false;
        }

        // Ambil ID pengguna dari $data
        $userId = $data[$userIdColumn];

        // Buat kueri untuk mengambil password dari database
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($userId);

        // Periksa apakah pengguna ditemukan dan apakah password cocok
        if ($user && isset($user['password'])) {
            return password_verify($str, $user['password']);
        }

        // Jika pengguna tidak ditemukan atau tidak ada password di database, kembalikan false
        return false;
    }

    public function is_unique_password(string $password, string $fields, array $data): bool
    {
        $params = explode(',', $fields);
        $table = array_shift($params);
        $id_user_field = array_shift($params);
        $id_user = isset($data[$id_user_field]) ? $data[$id_user_field] : null;

        if ($id_user === null) {
            return true;
        }

        $builder = db_connect()->table($table);
        $user = $builder->select('password')->where('id_user', $id_user)->get()->getRow();

        if ($user && password_verify($password, $user->password)) {
            // Password baru sama dengan password lama
            return false;
        }

        return true;
    }
}
