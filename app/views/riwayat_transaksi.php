<div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-100 transition duration-300">

  <div class="flex items-center justify-between mb-6 border-b pb-4 border-gray-100">
    <h2 class="text-2xl font-extrabold text-gray-900 flex items-center">
      <svg class="w-6 h-6 mr-3 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
      </svg>
      Riwayat Transaksi
    </h2>
  </div>

  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-indigo-50">
        <tr>
          <th class="px-4 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider rounded-tl-xl">Tanggal</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Jenis</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Deskripsi</th>
          <th class="px-4 py-3 text-right text-xs font-semibold text-indigo-600 uppercase tracking-wider">Jumlah</th>
          <th class="px-4 py-3 text-center text-xs font-semibold text-indigo-600 uppercase tracking-wider rounded-tr-xl">Aksi</th>
        </tr>
      </thead>

      <tbody class="bg-white divide-y divide-gray-100">

        <?php if (empty($transaksi)): ?>
          <tr>
            <td colspan="5" class="px-4 py-10 text-center text-gray-500 italic">
              <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              Belum ada transaksi yang tercatat. Mari mulai mencatat!
            </td>
          </tr>
        <?php else: ?>
          <?php foreach ($transaksi as $t): ?>

            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
              <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                <?php echo date('d M Y', strtotime($t['tanggal'])); ?>
              </td>

              <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold">
                <?php
                $isPemasukan = $t['jenis'] == 'pemasukan';
                $badgeClass = $isPemasukan ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700';
                $icon = $isPemasukan
                  ? '<svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>'
                  : '<svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path></svg>';
                ?>
                <span class="px-3 py-1 inline-flex text-xs leading-5 font-medium rounded-full <?php echo $badgeClass; ?> flex items-center">
                  <?php echo $icon; ?>
                  <?php echo ucfirst($t['jenis']); ?>
                </span>
              </td>

              <td class="px-4 py-4 text-sm font-medium text-gray-900 max-w-xs truncate" title="<?php echo htmlspecialchars($t['deskripsi']); ?>">
                <?php echo htmlspecialchars($t['deskripsi']); ?>
              </td>

              <td class="px-4 py-4 whitespace-nowrap text-sm font-extrabold text-right 
                                  <?php echo $isPemasukan ? 'text-emerald-600' : 'text-rose-600'; ?>">
                Rp <?php echo number_format($t['jumlah'], 0, ',', '.'); ?>
              </td>

              <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">

                <button
                  onclick="openEditModal(<?php echo $t['id']; ?>)"
                  class="text-indigo-600 hover:text-indigo-800 transition duration-150 ease-in-out p-2 rounded-full hover:bg-indigo-50"
                  title="Edit Transaksi">
                  <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-9-6l9 9m-4.5 4.5l-2.5-2.5 4.5-4.5 2.5 2.5"></path>
                  </svg>
                </button>


                <a href="<?php echo BASE_URL; ?>dashboard/hapus/<?php echo $t['id']; ?>"
                  onclick="return confirm('Yakin ingin menghapus transaksi ini? Tindakan ini tidak dapat dibatalkan.')"
                  class="text-red-500 hover:text-red-700 transition duration-150 ease-in-out p-2 rounded-full hover:bg-red-50"
                  title="Hapus Transaksi">
                  <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                  </svg>
                </a>
              </td>
            </tr>

          <?php endforeach; ?>
        <?php endif; ?>

      </tbody>
    </table>

    <!-- MODAL EDIT -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
      <div class="bg-white w-full max-w-md p-6 rounded-xl shadow-xl relative">

        <h3 class="text-lg font-bold mb-4">Edit Transaksi</h3>

        <form id="editForm">

          <input type="hidden" id="edit_id">

          <label class="block mb-2 text-sm font-medium">Jenis</label>
          <select id="edit_jenis" class="w-full p-2 border rounded-lg mb-4">
            <option value="pemasukan">Pemasukan</option>
            <option value="pengeluaran">Pengeluaran</option>
          </select>

          <label class="block mb-2 text-sm font-medium">Jumlah</label>
          <input type="number" id="edit_jumlah" class="w-full p-2 border rounded-lg mb-4">

          <label class="block mb-2 text-sm font-medium">Deskripsi</label>
          <input type="text" id="edit_deskripsi" class="w-full p-2 border rounded-lg mb-4">

          <label class="block mb-2 text-sm font-medium">Tanggal</label>
          <input type="date" id="edit_tanggal" class="w-full p-2 border rounded-lg mb-4">

          <div class="flex justify-end space-x-2">
            <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded-lg">Batal</button>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Simpan</button>
          </div>

        </form>

      </div>
    </div>

  </div>
</div>
<script>
  function openEditModal(id) {
    // tampilkan modal
    document.getElementById("editModal").classList.remove("hidden");
    document.getElementById("editModal").classList.add("flex");

    // ambil data via ajax
    fetch("<?php echo BASE_URL; ?>api/get_transaksi.php?id=" + id)
      .then(res => res.json())
      .then(data => {
        document.getElementById("edit_id").value = data.id;
        document.getElementById("edit_jenis").value = data.jenis;
        document.getElementById("edit_jumlah").value = data.jumlah;
        document.getElementById("edit_deskripsi").value = data.deskripsi;
        document.getElementById("edit_tanggal").value = data.tanggal;
      });
  }

  function closeModal() {
    document.getElementById("editModal").classList.add("hidden");
    document.getElementById("editModal").classList.remove("flex");
  }

  // submit update
  document.getElementById("editForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let formData = new FormData();
    formData.append("id", document.getElementById("edit_id").value);
    formData.append("jenis", document.getElementById("edit_jenis").value);
    formData.append("jumlah", document.getElementById("edit_jumlah").value);
    formData.append("deskripsi", document.getElementById("edit_deskripsi").value);
    formData.append("tanggal", document.getElementById("edit_tanggal").value);

    fetch("<?php echo BASE_URL; ?>api/update_transaksi.php", {
        method: "POST",
        body: formData
      })
      .then(r => r.text())
      .then(res => {
        closeModal();
        location.reload(); // refresh tabel setelah update
      });
  });
</script>