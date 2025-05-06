<?php 
$title = 'Transaksi Belanja';

require 'adminControl.php';
require 'template/headerAdmin.php';
require 'template/sidebarAdmin.php';

$idTransaksi = $_GET["idTransaksi"];
$username = $_GET["username"];

$detailTransaksi = query("SELECT * FROM transaksi JOIN customer ON transaksi.username = customer.username WHERE transaksi.idTransaksi = '$idTransaksi' AND transaksi.username = '$username'")[0];

$keranjangUser = query("SELECT * FROM keranjang
JOIN produk ON keranjang.idProduk = produk.idProduk
WHERE keranjang.username = '$username' AND keranjang.idTransaksi = '$idTransaksi'");

$tanggalTransaksi = strtotime($detailTransaksi["tanggalTransaksi"]);
$tanggalFormatted = date("j F Y", $tanggalTransaksi);

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
    .gradient-text {
      background-clip: text;
      -webkit-background-clip: text;
      color: transparent;
      background-image: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
    }
    .btn-primary {
      background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
      transition: all 0.3s ease;
      color: white;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(107, 115, 255, 0.3);
    }
    #main {
      margin-left: 250px;
      padding: 20px;
      min-height: 100vh;
      background-color: #f8fafc;
      transition: margin-left 0.3s ease;
    }
    @media (max-width: 768px) {
      #main {
        margin-left: 0;
      }
    }
    .print-only {
      display: none;
    }
    @media print {
      body * {
        visibility: hidden;
      }
      #print-section, #print-section * {
        visibility: visible;
      }
      #print-section {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
      }
      .no-print {
        display: none !important;
      }
      .print-only {
        display: block;
      }
    }
    .status-badge {
      padding: 0.25rem 0.5rem;
      border-radius: 9999px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: capitalize;
    }
    .status-accepted {
      background-color: #D1FAE5;
      color: #065F46;
    }
    .status-pending {
      background-color: #FEF3C7;
      color: #92400E;
    }
    .status-rejected {
      background-color: #FEE2E2;
      color: #991B1B;
    }
    .status-cancelled {
      background-color: #E5E7EB;
      color: #4B5563;
    }
    .shipping-status {
      padding: 0.25rem 0.5rem;
      border-radius: 9999px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: capitalize;
    }
    .shipping-delivered {
      background-color: #D1FAE5;
      color: #065F46;
    }
    .shipping-shipping {
      background-color: #DBEAFE;
      color: #1E40AF;
    }
    .shipping-pending {
      background-color: #FEF3C7;
      color: #92400E;
    }
  </style>
</head>

<body class="bg-gray-50">
  <main id="main" class="main">
    <div class="pagetitle mb-6 no-print">
      <h1 class="text-3xl font-bold text-gray-800">
        <span class="gradient-text">Detail Transaksi</span>
      </h1>
      <nav class="mt-2">
        <ol class="flex items-center space-x-1 text-sm text-gray-600">
          <li><a href="dashboard.php" class="hover:text-blue-600">Dashboard</a></li>
          <li><i class="fas fa-chevron-right text-xs mx-2 text-gray-400"></i></li>
          <li><a href="viewTransaksi.php" class="hover:text-blue-600">Transaksi</a></li>
          <li><i class="fas fa-chevron-right text-xs mx-2 text-gray-400"></i></li>
          <li class="text-blue-600 font-medium">Detail</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div id="print-section" class="bg-white rounded-xl shadow-md overflow-hidden p-6">
        <!-- Header for print -->
        <div class="print-only mb-8 text-center">
          <img src="../img/logo1.png" width="80px" class="mx-auto mb-4">
          <h2 class="text-2xl font-bold text-gray-800 mb-1">APOTEK WIN</h2>
          <p class="text-gray-600">Laporan Belanja <?= $detailTransaksi["username"]; ?></p>
          <p class="text-sm text-gray-500 mt-2">ID Transaksi: <?= $idTransaksi; ?></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
          <!-- Customer Info -->
          <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">Informasi Pelanggan</h3>
            <div class="space-y-2">
              <div class="flex justify-between">
                <span class="text-gray-600">Username:</span>
                <span class="font-medium"><?= $detailTransaksi["username"]; ?></span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-600">Nama Lengkap:</span>
                <span class="font-medium"><?= $detailTransaksi["namaLengkap"]; ?></span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-600">Alamat:</span>
                <span class="font-medium text-right"><?= $detailTransaksi["alamat"]; ?></span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-600">No. Telp:</span>
                <span class="font-medium"><?= $detailTransaksi["contact"]; ?></span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-600">Email:</span>
                <span class="font-medium"><?= $detailTransaksi["email"]; ?></span>
              </div>
            </div>
          </div>

          <!-- Transaction Info -->
          <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">Informasi Transaksi</h3>
            <div class="space-y-2">
              <div class="flex justify-between">
                <span class="text-gray-600">ID Transaksi:</span>
                <span class="font-medium"><?= $idTransaksi; ?></span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-600">Tanggal:</span>
                <span class="font-medium"><?= $tanggalFormatted; ?></span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-600">Metode Pembayaran:</span>
                <span class="font-medium"><?= $detailTransaksi["caraBayar"]; ?></span>
              </div>
              <?php if($detailTransaksi["bank"]): ?>
              <div class="flex justify-between">
                <span class="text-gray-600">Bank:</span>
                <span class="font-medium"><?= $detailTransaksi["bank"]; ?></span>
              </div>
              <?php endif; ?>
              <?php if($detailTransaksi["paypalID"]): ?>
              <div class="flex justify-between">
                <span class="text-gray-600">PayPal ID:</span>
                <span class="font-medium"><?= $detailTransaksi["paypalID"]; ?></span>
              </div>
              <?php endif; ?>
              <div class="flex justify-between">
                <span class="text-gray-600">Status Transaksi:</span>
                <?php
                $statusClass = 'status-pending';
                if ($detailTransaksi["statusTransaksi"] == 'Accepted') $statusClass = 'status-accepted';
                if ($detailTransaksi["statusTransaksi"] == 'Rejected') $statusClass = 'status-rejected';
                if ($detailTransaksi["statusTransaksi"] == 'Cancelled') $statusClass = 'status-cancelled';
                ?>
                <span class="status-badge <?= $statusClass ?>"><?= $detailTransaksi["statusTransaksi"]; ?></span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-600">Status Pengiriman:</span>
                <?php
                $shippingClass = 'shipping-pending';
                if ($detailTransaksi["statusPengiriman"] == 'Terkirim') $shippingClass = 'shipping-delivered';
                if ($detailTransaksi["statusPengiriman"] == 'Dalam Perjalanan') $shippingClass = 'shipping-shipping';
                ?>
                <span class="shipping-status <?= $shippingClass ?>"><?= $detailTransaksi["statusPengiriman"]; ?></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Order Items -->
        <div class="mb-8">
          <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">Daftar Produk</h3>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Produk</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Satuan</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <?php $i = 1; ?>
                <?php foreach($keranjangUser as $keranjang) : ?>
                <tr>
                  <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500"><?= $i++; ?></td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900"><?= $keranjang["idProduk"]; ?></td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900"><?= $keranjang["namaProduk"]; ?></td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500"><?= $keranjang["jumlah"]; ?></td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">Rp<?= number_format($keranjang["harga"], 0, ',', '.'); ?></td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">Rp<?= number_format($keranjang["harga"] * $keranjang["jumlah"], 0, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot class="bg-gray-50">
                <tr>
                  <td colspan="5" class="px-4 py-3 text-right text-sm font-medium text-gray-700">Total Harga:</td>
                  <td class="px-4 py-3 text-sm font-bold text-gray-900">Rp<?= number_format($detailTransaksi["totalHarga"], 0, ',', '.'); ?></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>

        <!-- Feedback -->
        <?php if($detailTransaksi["feedBack"]): ?>
        <div class="mb-8">
          <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">Feedback Pelanggan</h3>
          <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
            <p class="text-gray-700"><?= $detailTransaksi["feedBack"]; ?></p>
          </div>
        </div>
        <?php endif; ?>

        <!-- Signature for print -->
        <div class="print-only mt-12 text-center">
          <div class="inline-block text-center">
            <p class="mb-12">Tanda Tangan,</p>
            <img src="../img/ttd1.png" alt="Tanda Tangan" style="width: 150px; height: auto;" class="mx-auto mb-2">
            <p class="font-bold">APOTEK WIN</p>
            <p class="text-sm text-gray-500">Pemilik Toko</p>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="no-print flex justify-center space-x-4 mt-6">
          <button onclick="window.print()" class="btn-primary px-6 py-2 rounded-md shadow-sm text-sm font-medium text-white hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
            <i class="fas fa-print mr-2"></i> Cetak
          </button>
          <a href="viewTransaksi.php" class="px-6 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
          </a>
        </div>
      </div>
    </section>
  </main>

  <script>
    // Add animation to elements
    document.addEventListener('DOMContentLoaded', () => {
      const elements = document.querySelectorAll('#print-section > *');
      elements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        element.style.animation = `fadeInUp 0.5s ease forwards ${index * 0.1}s`;
      });
      
      // Add style for animation
      const style = document.createElement('style');
      style.textContent = `
        @keyframes fadeInUp {
          from {
            opacity: 0;
            transform: translateY(20px);
          }
          to {
            opacity: 1;
            transform: translateY(0);
          }
        }
      `;
      document.head.appendChild(style);
    });
  </script>
</body>
</html>