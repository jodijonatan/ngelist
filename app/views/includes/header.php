<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ngelist - <?php echo $page_title ?? 'Dashboard'; ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex h-screen">

  <aside class="w-64 bg-gray-800 text-white flex flex-col p-4 shadow-xl shrink-0">
    <div class="text-2xl font-bold mb-8 text-indigo-400">
      💸 Ngelist App
    </div>
    <nav class="flex-grow">
      <ul>
        <li class="mb-2">
          <a href="<?php echo BASE_URL; ?>"
            class="flex items-center p-3 rounded-lg hover:bg-indigo-700 transition duration-150 
               <?php echo (!isset($page_title) || $page_title == 'Dashboard Utama') ? 'bg-indigo-600' : ''; ?>">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l-2-2m-2 2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Dashboard
          </a>
        </li>
        <li class="mb-2">
          <a href="<?php echo BASE_URL; ?>dashboard/riwayat"
            class="flex items-center p-3 rounded-lg hover:bg-indigo-700 transition duration-150 
                       <?php echo (isset($page_title) && $page_title == 'Riwayat Transaksi') ? 'bg-indigo-600' : ''; ?>">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Riwayat Transaksi
          </a>
        </li>
        <li class="mb-2">
          <a href="<?php echo BASE_URL; ?>dashboard/tambah"
            class="flex items-center p-3 rounded-lg hover:bg-indigo-700 transition duration-150 
                       <?php echo (isset($page_title) && $page_title == 'Tambah Transaksi Baru') ? 'bg-indigo-600' : ''; ?>">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Tambah Transaksi
          </a>
        </li>
      </ul>
    </nav>
    <div class="mt-auto pt-4 border-t border-gray-700 text-sm text-gray-400">
      Login sebagai: <span class="font-bold">Admin</span>
    </div>
  </aside>
  <div class="flex-1 flex flex-col overflow-hidden">

    <header class="bg-white shadow-md p-4 flex justify-between items-center z-10 shrink-0">
      <h1 class="text-2xl font-semibold text-gray-800">
        <?php echo $page_title ?? 'Dashboard Utama'; ?>
      </h1>
      <div class="text-sm text-gray-500">
        Kelola Keuangan Pribadi
      </div>
    </header>
    <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">