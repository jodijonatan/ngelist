<?php
// --- START: Perhitungan data yang diperlukan di view ---

// Hitung total keseluruhan (Pemasukan + Pengeluaran) untuk basis persentase
$total_semua = ($ringkasan['total_pemasukan'] ?? 0) + ($ringkasan['total_pengeluaran'] ?? 0);

// Hitung persentase Pemasukan dan Pengeluaran dari Total Keseluruhan
$persen_pemasukan = 0;
$persen_pengeluaran = 0;

if ($total_semua > 0) {
  $persen_pemasukan = round((($ringkasan['total_pemasukan'] ?? 0) / $total_semua) * 100);
  $persen_pengeluaran = 100 - $persen_pemasukan; // Sisa adalah pengeluaran
}
// --- END: Perhitungan data yang diperlukan di view ---
?>

<!-- Bagian Top Cards (Row 1) -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

  <!-- Card 1: Saldo Akhir -->
  <div class="bg-white p-5 rounded-xl shadow-lg border-b-4 border-blue-500 hover:shadow-xl transition duration-300">
    <div class="flex items-center justify-between">
      <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Saldo Akhir</h2>
      <span class="p-2 bg-blue-100 rounded-full text-blue-600">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V9m0 3v2m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
      </span>
    </div>
    <p class="text-3xl font-extrabold text-gray-900 mt-2">
      Rp <?php echo number_format($ringkasan['saldo_akhir'] ?? 0, 0, ',', '.'); ?>
    </p>
    <div class="flex items-center text-sm mt-2">
      <span class="text-gray-500">Saldo saat ini</span>
    </div>
  </div>

  <!-- Card 2: Total Pemasukan -->
  <div class="bg-white p-5 rounded-xl shadow-lg border-b-4 border-green-500 hover:shadow-xl transition duration-300">
    <div class="flex items-center justify-between">
      <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Pemasukan</h2>
      <span class="p-2 bg-green-100 rounded-full text-green-600">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
        </svg>
      </span>
    </div>
    <p class="text-3xl font-extrabold text-green-600 mt-2">
      Rp <?php echo number_format($ringkasan['total_pemasukan'] ?? 0, 0, ',', '.'); ?>
    </p>
    <div class="flex items-center text-sm mt-2">
      <span class="text-green-500 font-semibold mr-1 flex items-center">
        +<?php echo $persen_pemasukan; ?>%
      </span>
      <span class="text-gray-500">Dari Total Transaksi</span>
    </div>
  </div>

  <!-- Card 3: Total Pengeluaran -->
  <div class="bg-white p-5 rounded-xl shadow-lg border-b-4 border-red-500 hover:shadow-xl transition duration-300">
    <div class="flex items-center justify-between">
      <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Pengeluaran</h2>
      <span class="p-2 bg-red-100 rounded-full text-red-600">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
        </svg>
      </span>
    </div>
    <p class="text-3xl font-extrabold text-red-600 mt-2">
      Rp <?php echo number_format($ringkasan['total_pengeluaran'] ?? 0, 0, ',', '.'); ?>
    </p>
    <div class="flex items-center text-sm mt-2">
      <span class="text-red-500 font-semibold mr-1 flex items-center">
        -<?php echo $persen_pengeluaran; ?>%
      </span>
      <span class="text-gray-500">Dari Total Transaksi</span>
    </div>
  </div>

  <!-- Card 4: Selisih Saldo -->
  <div class="bg-white p-5 rounded-xl shadow-lg border-b-4 border-yellow-500 hover:shadow-xl transition duration-300">
    <div class="flex items-center justify-between">
      <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Selisih (Pemasukan - Pengeluaran)</h2>
      <span class="p-2 bg-yellow-100 rounded-full text-yellow-600">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v14c0 1.105-.895 2-2 2H9z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m0-16L5 8m7-4l7-4"></path>
        </svg>
      </span>
    </div>
    <p class="text-3xl font-extrabold text-blue-600 mt-2">
      Rp <?php echo number_format($ringkasan['total_pemasukan'] - $ringkasan['total_pengeluaran'] ?? 0, 0, ',', '.'); ?>
    </p>
    <div class="flex items-center text-sm mt-2">
      <span class="text-blue-500 font-semibold mr-1">
        <?php echo ($ringkasan['total_pemasukan'] - $ringkasan['total_pengeluaran']) >= 0 ? 'Positif' : 'Negatif'; ?>
      </span>
      <span class="text-gray-500">Selisih bersih</span>
    </div>
  </div>
</div>

<hr class="mb-8">

<!-- Bagian Grafik dan Distribusi (Row 2) -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

  <!-- Kolom Kiri: Grafik Tren Real (MENGGANTIKAN PLACEHOLDER) -->
  <div class="lg:col-span-2 bg-white shadow-lg rounded-xl p-6">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-semibold text-gray-800">Tren Pemasukan vs Pengeluaran (6 Bulan Terakhir)</h2>
      <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Bulanan Real-Time</span>
    </div>

    <!-- Canvas untuk Grafik Chart.js -->
    <div class="h-80">
      <canvas id="transaksiChart"></canvas>
    </div>
  </div>

  <!-- Kolom Kanan: Distribusi Saldo -->
  <div class="bg-white shadow-lg rounded-xl p-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Distribusi Pemasukan vs Pengeluaran</h2>

    <?php
    $persen_pemasukan = $persen_pemasukan ?? 0;
    $persen_pengeluaran = 100 - $persen_pemasukan;
    ?>

    <div class="flex justify-center items-center h-48 relative">
      <!-- Donut Chart -->
      <div
        class="w-36 h-36 rounded-full flex items-center justify-center relative"
        style="background: conic-gradient(
                #4ade80 <?php echo $persen_pemasukan; ?>%, 
                #f87171 <?php echo $persen_pemasukan; ?>%
            );">
        <div class="absolute inset-4 bg-white rounded-full flex flex-col items-center justify-center">
          <span class="text-xl font-bold text-gray-800"><?php echo $persen_pemasukan; ?>%</span>
          <span class="text-sm text-gray-500">Pemasukan</span>
        </div>
      </div>
    </div>

    <div class="mt-4 space-y-2">
      <div class="flex justify-between items-center text-sm">
        <div class="flex items-center">
          <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
          <span class="text-gray-700">Pemasukan (<?php echo $persen_pemasukan; ?>%)</span>
        </div>
        <span class="font-semibold text-gray-900">
          Rp <?php echo number_format($ringkasan['total_pemasukan'] ?? 0, 0, ',', '.'); ?>
        </span>
      </div>

      <div class="flex justify-between items-center text-sm">
        <div class="flex items-center">
          <span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>
          <span class="text-gray-700">Pengeluaran (<?php echo $persen_pengeluaran; ?>%)</span>
        </div>
        <span class="font-semibold text-gray-900">
          Rp <?php echo number_format($ringkasan['total_pengeluaran'] ?? 0, 0, ',', '.'); ?>
        </span>
      </div>
    </div>
  </div>

</div>

<hr class="mb-8">

<!-- Bagian Riwayat Transaksi Terakhir (Row 3) -->
<div class="bg-white shadow-lg rounded-xl p-6">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-semibold text-gray-800">Riwayat Transaksi Terakhir</h2>
    <a href="<?php echo BASE_URL; ?>riwayat" class="text-sm font-medium text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out flex items-center">
      Lihat Semua Riwayat
      <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
      </svg>
    </a>
  </div>

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
          <?php foreach (array_slice($transaksi, 0, 5) as $t): // Batasi hanya 5 transaksi terakhir 
          ?>
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
                <a href="<?php echo BASE_URL; ?>hapus/<?php echo $t['id']; ?>"
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

<!-- SCRIPT CHART.JS UNTUK MERENDER GRAFIK -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // 1. Ambil data tren dari PHP dan konversi ke JavaScript
    // PHP harus menyediakan $tren_bulanan (dari controller)
    const trenData = <?php echo json_encode($tren_bulanan ?? []); ?>;

    // 2. Memproses data untuk format Chart.js
    const labels = trenData.map(item => item.label);
    const pemasukanData = trenData.map(item => item.pemasukan);
    const pengeluaranData = trenData.map(item => item.pengeluaran);

    // 3. Merender Chart
    const ctx = document.getElementById('transaksiChart');
    if (ctx) {
      new Chart(ctx, {
        type: 'bar', // Menggunakan Bar Chart (Batang)
        data: {
          labels: labels,
          datasets: [{
              label: 'Pemasukan',
              data: pemasukanData,
              backgroundColor: 'rgba(52, 211, 153, 0.8)', // Green-500
              borderColor: 'rgb(52, 211, 153)',
              borderWidth: 1,
              borderRadius: 4
            },
            {
              label: 'Pengeluaran',
              data: pengeluaranData,
              backgroundColor: 'rgba(239, 68, 68, 0.8)', // Red-500
              borderColor: 'rgb(239, 68, 68)',
              borderWidth: 1,
              borderRadius: 4
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'top',
            },
            title: {
              display: false
            }
          },
          scales: {
            x: {
              grid: {
                display: false
              }
            },
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Jumlah (Rp)'
              },
              ticks: {
                callback: function(value, index, values) {
                  // Format angka menjadi mata uang
                  return 'Rp ' + value.toLocaleString('id-ID');
                }
              }
            }
          }
        }
      });
    } else {
      console.error("Canvas element with ID 'transaksiChart' not found.");
    }
  });
</script>