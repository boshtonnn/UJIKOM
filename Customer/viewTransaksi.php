<?php 
$title = 'Transaksi Belanja';

require 'custControl.php';
require 'template/headerCust.php';
require 'template/sidebarCust.php';

$username = $_SESSION["username"];
$allTransaksi = query("SELECT * FROM transaksi WHERE username = '$username' ORDER BY idTransaksi DESC");
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
    /* Status badges */
    .status-badge {
      padding: 4px 8px;
      border-radius: 12px;
      font-size: 12px;
      font-weight: 500;
      text-transform: capitalize;
    }
    .status-pending {
      background-color: #fef3c7;
      color: #d97706;
    }
    .status-accepted {
      background-color: #dcfce7;
      color: #16a34a;
    }
    .status-cancelled {
      background-color: #fee2e2;
      color: #dc2626;
    }
    .status-terkirim {
      background-color: #dbeafe;
      color: #2563eb;
    }
  </style>
</head>

<body class="bg-gray-50">
  <!-- Header is included from headerCust.php -->
  <!-- Sidebar is included from sidebarCust.php -->
  
  <main id="main" class="main">
    <div class="pagetitle mb-8">
      <h1 class="text-3xl font-bold text-blue-600">Laporan Transaksi</h1>
      <nav class="mt-2">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
          <li><i class="fas fa-home text-blue-500"></i></li>
          <li><span class="mx-2">/</span></li>
          <li>Transaksi Belanja</li>
        </ol>
      </nav>
    </div>

    <div class="container mx-auto px-4">
      <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-8">
          <h2 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Transaksi Anda</h2>
          
          <div class="overflow-x-auto">
            <table class="custom-table">
              <thead>
                <tr>
                  <th class="text-left">No</th>
                  <th class="text-left">ID Transaksi</th>
                  <th class="text-left">Tanggal Transaksi</th>
                  <th class="text-left">Cara Bayar</th>
                  <th class="text-left">Bank</th>
                  <th class="text-left">Status Transaksi</th>
                  <th class="text-left">Status Pengiriman</th>
                  <th class="text-left">Total Harga</th>
                  <th class="text-left">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach($allTransaksi as $transaksi) : ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $transaksi["idTransaksi"]; ?></td>
                  <td><?= date('d M Y', strtotime($transaksi["tanggalTransaksi"])); ?></td>
                  <td><?= $transaksi["caraBayar"]; ?></td>
                  <td><?= $transaksi["bank"]; ?></td>
                  <td>
                    <span class="status-badge status-<?= strtolower($transaksi["statusTransaksi"]); ?>">
                      <?= $transaksi["statusTransaksi"]; ?>
                    </span>
                  </td>
                  <td>
                    <span class="status-badge status-<?= strtolower(str_replace(' ', '-', $transaksi["statusPengiriman"])); ?>">
                      <?= $transaksi["statusPengiriman"]; ?>
                    </span>
                  </td>
                  <td>Rp<?= number_format($transaksi["totalHarga"], 0, ',', '.'); ?></td>
                  <td class="flex space-x-2">
                    <a href="detailTransaksi.php?id=<?= $transaksi["idTransaksi"]; ?>" 
                       class="btn-primary px-3 py-1 rounded-lg text-white text-sm font-medium hover:shadow-md transition duration-200">
                      <i class="fas fa-info-circle mr-1"></i> Detail
                    </a>
                    <?php if($transaksi["statusTransaksi"] == 'Pending') : ?>
                      <a href="batalkanTransaksi.php?id=<?= $transaksi["idTransaksi"]; ?>" 
                         class="px-3 py-1 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition duration-200">
                        <i class="fas fa-times mr-1"></i> Batalkan
                      </a>
                    <?php elseif(($transaksi["statusTransaksi"] == 'Accepted') && ($transaksi["statusPengiriman"] != 'Terkirim')) : ?>
                      <a href="selesaikanTransaksi.php?id=<?= $transaksi["idTransaksi"]; ?>" 
                         class="px-3 py-1 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition duration-200">
                        <i class="fas fa-check mr-1"></i> Terima
                      </a>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>