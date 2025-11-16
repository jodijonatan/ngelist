<?php
class TransaksiModel
{
  private $db;

  public function __construct()
  {
    // Inisiasi koneksi PDO
    try {
      $this->db = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
      );
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Koneksi Database Gagal: " . $e->getMessage());
    }
  }

  public function getAllTransaksi($userId)
  {
    $stmt = $this->db->prepare("SELECT * FROM transaksi WHERE user_id = :user_id ORDER BY tanggal DESC");
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

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
