<?php
class TransaksiModel
{
  private $db;

  public function __construct()
  {
    // Inisiasi koneksi PDO
    try {
      // Asumsi DB_HOST, DB_NAME, DB_USER, DB_PASS sudah didefinisikan
      $this->db = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
      );
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Set default fetch mode
    } catch (PDOException $e) {
      die("Koneksi Database Gagal: " . $e->getMessage());
    }
  }

  public function getAllTransaksi($userId)
  {
    $stmt = $this->db->prepare("SELECT * FROM transaksi WHERE user_id = :user_id ORDER BY tanggal DESC");
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function getRingkasan($userId)
  {
    $sql = "
            SELECT 
                SUM(CASE WHEN jenis = 'pemasukan' THEN jumlah ELSE 0 END) AS total_pemasukan,
                SUM(CASE WHEN jenis = 'pengeluaran' THEN jumlah ELSE 0 END) AS total_pengeluaran,
                (SUM(CASE WHEN jenis = 'pemasukan' THEN jumlah ELSE 0 END) - SUM(CASE WHEN jenis = 'pengeluaran' THEN jumlah ELSE 0 END)) AS saldo_akhir
            FROM transaksi 
            WHERE user_id = :user_id
        ";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    return $stmt->fetch();
  }

    // =========================================================
    // ✨ METHOD BARU: GET DATA TREN BULANAN UNTUK GRAFIK
    // =========================================================

  /**
   * Mengambil ringkasan data transaksi per bulan untuk periode 6 bulan terakhir.
   * @param int $user_id
   * @param int $months Jumlah bulan terakhir yang ingin diambil
   * @return array Data tren yang diisi nol jika tidak ada transaksi.
   */
  public function getTrenBulanan($user_id, $months = 6)
  {
    // 1. Menentukan tanggal mulai (misalnya, 6 bulan lalu di awal bulan)
    $start_date = date('Y-m-01', strtotime("-$months months"));

    // 2. Query untuk mengambil total pemasukan dan pengeluaran per bulan
    $sql = "
            SELECT 
                DATE_FORMAT(tanggal, '%Y-%m') as bulan_tahun,
                SUM(CASE WHEN jenis = 'pemasukan' THEN jumlah ELSE 0 END) as total_pemasukan,
                SUM(CASE WHEN jenis = 'pengeluaran' THEN jumlah ELSE 0 END) as total_pengeluaran
            FROM 
                transaksi
            WHERE 
                user_id = :user_id 
                AND tanggal >= :start_date
            GROUP BY 
                bulan_tahun
            ORDER BY 
                bulan_tahun ASC;
        ";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->execute();

    $results = $stmt->fetchAll();

    // 3. Memproses hasil query untuk memastikan 6 bulan penuh terisi (termasuk bulan tanpa transaksi)
    $tren_data_map = [];

    // Inisialisasi 6 bulan terakhir dengan nilai 0
    for ($i = $months - 1; $i >= 0; $i--) {
      $date_key = date('Y-m', strtotime("-$i months"));
      $month_label = date('M Y', strtotime("-$i months"));

      $tren_data_map[$date_key] = [
        'label' => $month_label,
        'pemasukan' => 0.0,
        'pengeluaran' => 0.0
      ];
    }

    // Gabungkan hasil query ke dalam array inisialisasi
    foreach ($results as $row) {
      $key = $row['bulan_tahun'];
      if (isset($tren_data_map[$key])) {
        // Konversi ke float untuk memastikan kompatibilitas JS Chart.js
        $tren_data_map[$key]['pemasukan'] = (float) $row['total_pemasukan'];
        $tren_data_map[$key]['pengeluaran'] = (float) $row['total_pengeluaran'];
      }
    }

    return array_values($tren_data_map); // Mengembalikan array numerik
  }

  // =========================================================
  // END: METHOD BARU
  // =========================================================

  public function tambahTransaksi($data)
  {
    $sql = "INSERT INTO transaksi (user_id, jenis, jumlah, deskripsi, tanggal) VALUES (:user_id, :jenis, :jumlah, :deskripsi, :tanggal)";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute($data);
  }

  public function hapusTransaksi($id, $userId)
  {
    $sql = "DELETE FROM transaksi WHERE id = :id AND user_id = :user_id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':user_id', $userId);
    return $stmt->execute();
  }
}
