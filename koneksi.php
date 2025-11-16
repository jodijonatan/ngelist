<?php
// Ambil konfigurasi
require_once __DIR__ . '/config.php';

// Buat koneksi
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Cek error koneksi
if ($conn->connect_error) {
  die("Koneksi database gagal: " . $conn->connect_error);
}

// Optional: set charset biar aman untuk UTF-8
$conn->set_charset("utf8mb4");
