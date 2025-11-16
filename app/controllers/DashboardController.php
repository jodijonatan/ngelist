<?php
require_once __DIR__ . '/../models/TransaksiModel.php';

class DashboardController
{
  private $model;
  private $user_id = 1; // Asumsi ID pengguna yang sedang login

  public function __construct()
  {
    $this->model = new TransaksiModel();
  }

  public function index()
  {
    $data['page_title'] = 'Dashboard Utama';
    $data['ringkasan'] = $this->model->getRingkasan($this->user_id);
    $data['transaksi'] = $this->model->getAllTransaksi($this->user_id);

    $this->view('dashboard', $data);
  }

  public function tambah()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $data = [
        'user_id'   => $this->user_id,
        'jenis'     => $_POST['jenis'],
        'jumlah'    => $_POST['jumlah'],
        'deskripsi' => $_POST['deskripsi'],
        'tanggal'   => $_POST['tanggal']
      ];

      if ($this->model->tambahTransaksi($data)) {
        header('Location: ' . BASE_URL);
        exit;
      } else {
        // Tampilkan pesan error
        echo "Gagal menambahkan transaksi.";
      }
    } else {
      // Jika request GET, tampilkan form (kita bisa gabungkan form di dashboard)
      // $this->view('transaksi_form'); 
    }
  }

  public function hapus($params)
  {
    $id = $params[0] ?? null;
    if ($id && $this->model->hapusTransaksi($id, $this->user_id)) {
      header('Location: ' . BASE_URL);
      exit;
    } else {
      header('Location: ' . BASE_URL); // Kembali ke dashboard jika gagal/ID tidak ada
      exit;
    }
  }

  // Fungsi helper untuk memuat View
  private function view($view, $data = [])
  {
    // Membuat variabel data bisa diakses langsung di view
    extract($data);
    require_once __DIR__ . '/../views/includes/header.php';
    require_once __DIR__ . '/../views/' . $view . '.php';
    require_once __DIR__ . '/../views/includes/footer.php';
  }
}
