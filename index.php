<?php
// Tentukan path ke folder app
define('APP_ROOT', __DIR__ . '/app/');

// Muat konfigurasi
require_once APP_ROOT . 'config/config.php';
// Muat Controller utama
require_once APP_ROOT . 'controllers/DashboardController.php';

// Fungsi utama routing
function route()
{
  // Ambil path setelah BASE_URL
  $request_uri = $_SERVER['REQUEST_URI'];
  // Hati-hati dengan BASE_URL, pastikan path di dalamnya benar
  $base_path = parse_url(BASE_URL, PHP_URL_PATH);

  // Hapus base path dari request URI
  if (strpos($request_uri, $base_path) === 0) {
    $uri = substr($request_uri, strlen($base_path));
  } else {
    $uri = $request_uri;
  }

  // Bersihkan URI dan pecah menjadi segmen
  $uri = trim($uri, '/');
  $segments = explode('/', $uri);

  // Tentukan Controller dan Method
  $controller_name = array_shift($segments) ?: 'dashboard';
  $method_name = array_shift($segments) ?: 'index';
  $params = $segments;

  // Untuk sistem sederhana kita, hanya ada satu Controller: DashboardController
  $controller_class = ucfirst($controller_name) . 'Controller';

  if (file_exists(APP_ROOT . 'controllers/' . $controller_class . '.php')) {
    $controller = new $controller_class;

    if (method_exists($controller, $method_name)) {
      // Panggil method dengan parameter
      call_user_func_array([$controller, $method_name], [$params]);
    } else {
      header("HTTP/1.0 404 Not Found");
      echo "404 - Method Not Found: " . $method_name;
    }
  } else {
    // Jika controller yang diminta tidak ada, arahkan ke dashboard/index
    $controller = new DashboardController;
    $controller->index();
  }
}

route();
