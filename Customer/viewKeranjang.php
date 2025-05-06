<?php 
$title = 'Keranjang Belanja';

require 'custControl.php';
require 'template/headerCust.php';
require 'template/sidebarCust.php';

$username = $_SESSION["username"];
$allKeranjang = query("SELECT * FROM keranjang JOIN produk ON keranjang.idProduk = produk.idProduk WHERE username = '$username' && status = 'Belum Dibayar'");

// memanggil function checkout() yang ada di custControl.php
if(isset($_POST["submit"])) {
    if(checkout($_POST) > 0) {
        echo "
            <script>
                alert('Checkout berhasil!');
                document.location.href = 'viewTransaksi.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Checkout gagal!');
                document.location.href = 'produkCust.php';
            </script>
        ";
    }
}

$totalHarga = query("SELECT SUM(harga) AS totalHarga FROM keranjang WHERE username = '$username' && status = 'Belum Dibayar'")[0]["totalHarga"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Custom styles -->
  <style>
    .gradient-bg {
      background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
    }
    .btn-primary {
      background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(107, 115, 255, 0.3);
    }
    .input-focus:focus {
      border-color: #6B73FF;
      box-shadow: 0 0 0 3px rgba(107, 115, 255, 0.2);
    }
    /* Layout adjustments */
    #main {
      margin-left: 280px; /* Match sidebar width */
      padding-top: 6rem; /* Space for header */
      padding-bottom: 2rem;
      padding-left: 2rem;
      padding-right: 2rem;
      width: calc(100% - 280px);
      min-height: calc(100vh - 6rem); /* Full height minus header */
    }
    @media (max-width: 768px) {
      #main {
        margin-left: 0;
        width: 100%;
        padding-top: 5rem; /* Less space on mobile */
      }
    }
    /* Custom table styling */
    .custom-table {
      width: 100%;
      border-collapse: collapse;
    }
    .custom-table thead tr {
      background-color: #f3f4f6;
      text-align: left;
    }
    .custom-table th, 
    .custom-table td {
      padding: 12px 15px;
      border-bottom: 1px solid #e5e7eb;
    }
    .custom-table tbody tr:hover {
      background-color: #f9fafb;
    }
    .custom-table tbody tr:last-child {
      font-weight: bold;
      background-color: #f0fdf4;
    }
  </style>
</head>

<body class="bg-gray-50">
  <!-- Header is included from headerCust.php -->
  <!-- Sidebar is included from sidebarCust.php -->
  
  <main id="main" class="main">
    <div class="pagetitle mb-8">
      <h1 class="text-3xl font-bold text-blue-600">Keranjang Anda</h1>
      <nav class="mt-2">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
          <li><i class="fas fa-home text-blue-500"></i></li>
          <li><span class="mx-2">/</span></li>
          <li>Keranjang Belanja</li>
        </ol>
      </nav>
    </div>

    <div class="container mx-auto px-4">
      <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-8">
          <h2 class="text-2xl font-semibold text-gray-800 mb-6">Semua Barang di Keranjang</h2>
          
          <div class="overflow-x-auto">
            <table class="custom-table">
              <thead>
                <tr>
                  <th class="text-left">No</th>
                  <th class="text-left">ID dan Nama Produk</th>
                  <th class="text-left">Jumlah</th>
                  <th class="text-left">Total Harga</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach($allKeranjang as $keranjang) : ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $keranjang["idProduk"]; ?> - <?= $keranjang["namaProduk"]; ?></td>
                  <td><?= $keranjang["jumlah"]; ?></td>
                  <td>Rp<?= number_format($keranjang["harga"], 0, ',', '.') ?></td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
                <tr>
                  <td colspan="3">Total Harga</td>
                  <td>Rp<?= number_format($totalHarga, 0, ',', '.'); ?></td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="mt-8">
            <form action="" method="post" class="space-y-4">
              <input type="hidden" name="username" value="<?= $username; ?>">
              <input type="hidden" name="totalHarga" value="<?= $totalHarga; ?>">
              
              <div>
                <label for="bank" class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
                <select name="bank" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                  <option value="">-- Pilih Bank --</option>
                  <option value="BCA">BCA</option>
                  <option value="BNI">BNI</option>
                  <option value="BRI">BRI</option>
                  <option value="Mandiri">Mandiri</option>
                  <option value="Bayar Ditempat">Bayar Ditempat</option>
                </select>
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cara Pembayaran</label>
                <div class="flex items-center space-x-4">
                  <label class="inline-flex items-center">
                    <input type="radio" class="form-radio text-blue-600" value="Prepaid" name="caraBayar" required>
                    <span class="ml-2">Prepaid</span>
                  </label>
                  <label class="inline-flex items-center">
                    <input type="radio" class="form-radio text-blue-600" value="Postpaid" name="caraBayar">
                    <span class="ml-2">Postpaid</span>
                  </label>
                </div>
              </div>
              
              <div class="flex items-center space-x-4 pt-4">
                <button type="submit" name="submit" class="btn-primary px-6 py-2 rounded-lg text-white font-semibold shadow-md hover:shadow-lg transition duration-200">
                  <i class="fas fa-shopping-cart mr-2"></i> Checkout
                </button>
                
                <a href="hapusKeranjang.php" onclick="return confirm('Apakah anda yakin ingin menghapus semua produk di keranjang?')" class="px-6 py-2 bg-gray-600 text-white rounded-lg font-semibold hover:bg-gray-700 transition duration-200">
                  <i class="fas fa-trash-alt mr-2"></i> Hapus Keranjang
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

</body>
</html>