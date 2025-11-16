<?php
// Tentukan path ke folder app
// __DIR__ adalah folder 'ngelist'
define('APP_ROOT', __DIR__ . '/app/');

// --- Muat Konfigurasi dan Controller ---
require_once APP_ROOT . 'config/config.php';
// Muat Controller utama (Asumsi ini adalah satu-satunya controller saat ini)
require_once APP_ROOT . 'controllers/DashboardController.php';

// Fungsi utama routing
function route()
{
  // 1. Ambil URI dari request server
  $request_uri = $_SERVER['REQUEST_URI'];
  $base_path = parse_url(BASE_URL, PHP_URL_PATH);

  // 2. Hapus base path dari request URI (misal: menghapus /ngelist/)
  if (strpos($request_uri, $base_path) === 0) {
    $uri = substr($request_uri, strlen($base_path));
  } else {
    $uri = $request_uri;
  }

  // 3. Hapus Query String (?key=value) jika ada, karena kita hanya butuh path
  $uri_parts = explode('?', $uri, 2);
  $uri = $uri_parts[0];

  // 4. Bersihkan URI (hapus slash di awal/akhir) dan pecah menjadi segmen
  $uri = trim($uri, '/');
  $segments = explode('/', $uri);

  // 5. Tentukan Controller dan Method
  // Jika segmen pertama kosong, gunakan 'dashboard'
  $controller_name = 'dashboard';
  // Jika segmen kedua kosong, gunakan 'index'
  $method_name = array_shift($segments) ?: 'index';
  // Sisa segmen dianggap parameter
  $params = $segments;

  // Nama Kelas Controller harus diawali huruf besar (misal: DashboardController)
  $controller_class = ucfirst($controller_name) . 'Controller';

  // 6. Eksekusi Controller
  if (file_exists(APP_ROOT . 'controllers/' . $controller_class . '.php')) {
    // Karena DashboardController.php sudah di-require di awal, kita bisa langsung instantiate
    $controller = new $controller_class;

    if (method_exists($controller, $method_name)) {
      // Panggil method dengan parameter
      // Parameter $params dikirim sebagai array, Controller harus bisa menerimanya
      call_user_func_array([$controller, $method_name], [$params]);
    } else {
      // Error 404 jika method tidak ditemukan
      header("HTTP/1.0 404 Not Found");
      echo "404 - Method Not Found: " . $method_name;
    }
  } else {
    // Jika controller yang diminta tidak ada, arahkan ke index
    // Ini adalah fallback untuk halaman utama
    $controller = new DashboardController;
    $controller->index();
  }
}

route();
