<?php

namespace App\Controllers;

use App\Models\JabatanModel;
use App\Models\UserModel;
use App\Models\FeedbackModel;
use App\Models\DesaModel;
use App\Models\BabinModel;
use App\Models\LaporanModel;
use App\Models\FileLaporanModel;
use App\Models\GaleriModel;
use App\Models\FileFotoModel;
use App\Models\InformasiModel;
use App\Models\KategoriInformasiModel;
use CodeIgniter\Config\Services;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form', 'number'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */

    // protected
    protected $session;
    protected $validation;
    protected $m_desa;
    protected $m_jabatan;
    protected $m_user;
    protected $m_babin;
    protected $m_feedback;
    protected $m_laporan;
    protected $m_file_laporan;
    protected $m_galeri;
    protected $m_file_foto;
    protected $m_informasi;
    protected $m_kategori_informasi;
    protected $db;
    protected $email;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // E.g.: $this->session = \Config\Services::session();

        // Preload any models, libraries, etc, here.
        $this->session = session();
        $this->session = Services::session();
        $this->validation = \Config\Services::validation();
        $this->db = \Config\Database::connect();
        $this->email = \Config\Services::email();

        // Helper
        helper("upload_helper");

        // Model 
        $this->m_jabatan = new JabatanModel();
        $this->m_user = new UserModel();
        $this->m_desa = new DesaModel();
        $this->m_babin = new BabinModel();
        $this->m_feedback = new FeedbackModel();
        $this->m_laporan = new LaporanModel();
        $this->m_file_laporan = new FileLaporanModel();
        $this->m_galeri = new GaleriModel();
        $this->m_file_foto = new FileFotoModel();
        $this->m_informasi = new InformasiModel();
        $this->m_kategori_informasi = new KategoriInformasiModel();
    }
}
