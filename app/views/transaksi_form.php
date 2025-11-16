<div class="bg-white shadow-lg rounded-lg p-6 mb-8">

  <?php
  // Tentukan apakah kita dalam mode Edit atau Tambah
  $is_edit = isset($transaksi_data) && !empty($transaksi_data);
  $action_url = BASE_URL . ($is_edit ? 'dashboard/update/' . $transaksi_data['id'] : 'dashboard/tambah');
  $title = $is_edit ? 'Edit Transaksi' : 'Tambah Transaksi Baru';

  // Isi nilai form
  $jenis = $is_edit ? $transaksi_data['jenis'] : 'pemasukan';
  $jumlah = $is_edit ? $transaksi_data['jumlah'] : '';
  $deskripsi = $is_edit ? $transaksi_data['deskripsi'] : '';
  $tanggal = $is_edit ? $transaksi_data['tanggal'] : date('Y-m-d');
  ?>

  <h2 class="text-xl font-semibold mb-4 text-gray-800"><?php echo $title; ?></h2>

  <form action="<?php echo $action_url; ?>" method="POST" class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end">

    <div class="md:col-span-1">
      <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis</label>
      <select id="jenis" name="jenis" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border">
        <option value="pemasukan" <?php echo $jenis == 'pemasukan' ? 'selected' : ''; ?>>Pemasukan</option>
        <option value="pengeluaran" <?php echo $jenis == 'pengeluaran' ? 'selected' : ''; ?>>Pengeluaran</option>
      </select>
    </div>

    <div class="md:col-span-1">
      <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah (Rp)</label>
      <input type="number" id="jumlah" name="jumlah" required min="1" value="<?php echo htmlspecialchars($jumlah); ?>"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border" placeholder="e.g., 500000">
    </div>

    <div class="md:col-span-2">
      <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
      <input type="text" id="deskripsi" name="deskripsi" required value="<?php echo htmlspecialchars($deskripsi); ?>"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border" placeholder="Gaji bulanan / Beli kopi">
    </div>

    <div class="md:col-span-1">
      <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
      <input type="date" id="tanggal" name="tanggal" required value="<?php echo htmlspecialchars($tanggal); ?>"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border">
    </div>

    <div class="md:col-span-1">
      <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow-md transition duration-150 ease-in-out">
        <?php echo $is_edit ? 'Update' : 'Simpan'; ?>
      </button>
    </div>
  </form>
</div>