<div class="bg-white shadow-2xl rounded-xl p-8 mb-8 border border-gray-100 transition duration-300">

  <div class="flex items-center mb-6 pb-4 border-b border-indigo-100">
    <svg class="w-7 h-7 mr-3 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    <h2 class="text-2xl font-bold text-gray-900">
      Catat Transaksi Baru
    </h2>
  </div>

  <form action="<?php echo BASE_URL; ?>dashboard/tambah" method="POST" class="grid grid-cols-1 md:grid-cols-6 gap-6 items-end">

    <div class="md:col-span-1">
      <label for="jenis" class="block text-sm font-semibold text-gray-700 mb-1">Jenis</label>
      <div class="relative">
        <select id="jenis" name="jenis" required
          class="appearance-none block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 px-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
          <option value="pemasukan">Pemasukan 🟢</option>
          <option value="pengeluaran">Pengeluaran 🔴</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
          <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </div>
      </div>
    </div>

    <div class="md:col-span-1">
      <label for="jumlah" class="block text-sm font-semibold text-gray-700 mb-1">Jumlah (Rp)</label>
      <input type="number" id="jumlah" name="jumlah" required min="1"
        class="block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 px-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
        placeholder="e.g., 500000">
    </div>

    <div class="md:col-span-2">
      <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
      <input type="text" id="deskripsi" name="deskripsi" required
        class="block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 px-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
        placeholder="Gaji bulanan / Beli kopi">
    </div>

    <div class="md:col-span-1">
      <label for="tanggal" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal</label>
      <input type="date" id="tanggal" name="tanggal" required value="<?php echo date('Y-m-d'); ?>"
        class="block w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm py-2.5 px-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
    </div>

    <div class="md:col-span-1 pt-6 md:pt-0">
      <button type="submit" class="w-full flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200 ease-in-out transform hover:scale-[1.01]">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        Simpan
      </button>
    </div>

  </form>
</div>