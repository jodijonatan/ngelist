<?php
// Menggunakan APP_ROOT untuk path yang konsisten
require_once APP_ROOT . 'models/TransaksiModel.php';

class DashboardController
{
  private $model;
  private $user_id = 1;

  public function __construct()
  {
    // Fallback untuk APP_ROOT
    if (!defined('APP_ROOT')) {
      define('APP_ROOT', __DIR__ . '/../');
    }
    $this->model = new TransaksiModel();
  }

  /**
 * Menampilkan halaman ringkasan saldo utama (Dashboard).
 */
  public function index($params = [])
  {
    $data['page_title'] = 'Dashboard Utama'; // Judul dinamis
    $data['ringkasan'] = $this->model->getRingkasan($this->user_id);

    // ✨ Ini memastikan data tren tersedia di dashboard.php
    $data['tren_bulanan'] = $this->model->getTrenBulanan($this->user_id, 6);

    $this->view('dashboard', $data); // Memuat View dashboard.php
  }

  /**
 * Menampilkan halaman Riwayat Transaksi.
 */
  public function riwayat($params = [])
  {
    $data['page_title'] = 'Riwayat Transaksi';
    $data['transaksi'] = $this->model->getAllTransaksi($this->user_id);

    $this->view('riwayat_transaksi', $data); // Memuat View baru
  }

  /**
 * Menampilkan form Tambah Transaksi (GET) atau Menyimpan data (POST).
 */
  public function tambah($params = [])
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Logika Penyimpanan Data (Sama seperti sebelumnya)
      $data = [
        'user_id' => $this->user_id,
        'jenis' => $_POST['jenis'] ?? '',
        'jumlah' => $_POST['jumlah'] ?? 0,
        'deskripsi' => $_POST['deskripsi'] ?? '',
        'tanggal' => $_POST['tanggal'] ?? date('Y-m-d')
      ];

      if ($this->model->tambahTransaksi($data)) {
        // Redirect setelah sukses ke halaman riwayat
        header('Location: ' . BASE_URL . 'riwayat');
        exit;
      } else {
        echo "Gagal menambahkan transaksi.";
      }
    } else {
      // Tampilkan form kosong untuk input
      $data['page_title'] = 'Tambah Transaksi Baru';
      $this->view('transaksi_form', $data); // Memuat View form
    }
  }

  // Method hapus dan view helper (SAMA SEPERTI SEBELUMNYA, PASTIKAN MENGGUNAKAN APP_ROOT)
  public function hapus($params = [])
  {
    $id = $params[0] ?? null;
    if ($id && $this->model->hapusTransaksi($id, $this->user_id)) {
      header('Location: ' . BASE_URL . 'riwayat'); // Redirect ke riwayat
      exit;
    } else {
      header('Location: ' . BASE_URL . 'riwayat');
      exit;
    }
  }

  private function view($view, $data = [])
  {
    extract($data);
    require_once APP_ROOT . 'views/includes/header.php';
    require_once APP_ROOT . 'views/' . $view . '.php';
    require_once APP_ROOT . 'views/includes/footer.php';
  }
}
