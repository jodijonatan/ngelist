<div class="bg-white shadow-lg rounded-lg p-6 mb-8">
  <h2 class="text-xl font-semibold mb-4 text-gray-800">Input Data Transaksi</h2>
  <form action="<?php echo BASE_URL; ?>dashboard/tambah" method="POST" class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end">

    <div class="md:col-span-1">
      <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis</label>
      <select id="jenis" name="jenis" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border">
        <option value="pemasukan">Pemasukan</option>
        <option value="pengeluaran">Pengeluaran</option>
      </select>
    </div>

    <div class="md:col-span-1">
      <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah (Rp)</label>
      <input type="number" id="jumlah" name="jumlah" required min="1" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border" placeholder="e.g., 500000">
    </div>

    <div class="md:col-span-2">
      <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
      <input type="text" id="deskripsi" name="deskripsi" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border" placeholder="Gaji bulanan / Beli kopi">
    </div>

    <div class="md:col-span-1">
      <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
      <input type="date" id="tanggal" name="tanggal" required value="<?php echo date('Y-m-d'); ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border">
    </div>

    <div class="md:col-span-1">
      <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow-md transition duration-150 ease-in-out">
        Simpan Transaksi
      </button>
    </div>
  </form>
</div>