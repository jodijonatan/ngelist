<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
  <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 border-blue-500">
    <h2 class="text-lg font-semibold text-gray-500">Saldo Akhir</h2>
    <p class="text-3xl font-bold text-gray-900 mt-1">
      Rp <?php echo number_format($ringkasan['saldo_akhir'] ?? 0, 0, ',', '.'); ?>
    </p>
  </div>
  <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 border-green-500">
    <h2 class="text-lg font-semibold text-gray-500">Total Pemasukan</h2>
    <p class="text-3xl font-bold text-green-600 mt-1">
      Rp <?php echo number_format($ringkasan['total_pemasukan'] ?? 0, 0, ',', '.'); ?>
    </p>
  </div>
  <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 border-red-500">
    <h2 class="text-lg font-semibold text-gray-500">Total Pengeluaran</h2>
    <p class="text-3xl font-bold text-red-600 mt-1">
      Rp <?php echo number_format($ringkasan['total_pengeluaran'] ?? 0, 0, ',', '.'); ?>
    </p>
  </div>
</div>

<div class="bg-white shadow-lg rounded-lg p-6 mb-8">
  <h2 class="text-xl font-semibold mb-4 text-gray-800">Tambah Transaksi Baru</h2>
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
        Simpan
      </button>
    </div>
  </form>
</div>

<div class="bg-white shadow-lg rounded-lg p-6">
  <h2 class="text-xl font-semibold mb-4 text-gray-800">Riwayat Transaksi</h2>
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
          <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
          <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <?php if (empty($transaksi)): ?>
          <tr>
            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada transaksi yang tercatat.</td>
          </tr>
        <?php else: ?>
          <?php foreach ($transaksi as $t): ?>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo date('d M Y', strtotime($t['tanggal'])); ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php echo $t['jenis'] == 'pemasukan' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                  <?php echo ucfirst($t['jenis']); ?>
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo htmlspecialchars($t['deskripsi']); ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-right 
                                <?php echo $t['jenis'] == 'pemasukan' ? 'text-green-600' : 'text-red-600'; ?>">
                Rp <?php echo number_format($t['jumlah'], 0, ',', '.'); ?>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <a href="<?php echo BASE_URL; ?>dashboard/hapus/<?php echo $t['id']; ?>"
                  onclick="return confirm('Yakin ingin menghapus transaksi ini?')"
                  class="text-red-600 hover:text-red-900 transition duration-150 ease-in-out">
                  Hapus
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>