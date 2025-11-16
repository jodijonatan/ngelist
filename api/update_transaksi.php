<?php
require __DIR__ . '/koneksi.php';

$id = $_POST['id'];
$jenis = $_POST['jenis'];
$jumlah = $_POST['jumlah'];
$deskripsi = $_POST['deskripsi'];
$tanggal = $_POST['tanggal'];

$conn->query("UPDATE transaksi SET 
  jenis='$jenis',
  jumlah='$jumlah',
  deskripsi='$deskripsi',
  tanggal='$tanggal'
WHERE id=$id");

echo "OK";
