<div class="bg-white shadow-lg rounded-lg p-6">
  <h2 class="text-xl font-semibold mb-4 text-gray-800">Daftar Semua Transaksi</h2>

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