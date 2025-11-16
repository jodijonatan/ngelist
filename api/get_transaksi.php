<?php
require __DIR__ . '/koneksi.php';

$id = $_GET['id'];
$q = $conn->query("SELECT * FROM transaksi WHERE id = $id");
echo json_encode($q->fetch_assoc());
