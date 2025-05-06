<?php 
$title = 'Dashboard';

require 'adminControl.php';
require 'template/headerAdmin.php';
require 'template/sidebarAdmin.php';

$totalTransaksiSelesai = count(query("SELECT * FROM transaksi WHERE statusPengiriman = 'Terkirim'"));
$totalTransaksiBelumSelesai = count(query("SELECT * FROM transaksi WHERE statusPengiriman = 'Dalam Perjalanan' OR statusPengiriman = 'Pending'"));
$totalTransaksiReject = count(query("SELECT * FROM transaksi WHERE statusTransaksi = 'Rejected'"));
$totalCancelTransaksi = count(query("SELECT * FROM transaksi WHERE statusTransaksi = 'Cancelled'"));
$totalProduk = count(query("SELECT * FROM produk"));
$totalGuestBook = count(query("SELECT * FROM guestbook"));
$totalCustomer = count(query("SELECT * FROM customer"));
$totalKeuangan = query("SELECT SUM(totalHarga) FROM transaksi WHERE statusPengiriman = 'Terkirim'")[0]['SUM(totalHarga)'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    .gradient-bg {
      background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
    }
    .gradient-bg-light {
      background: linear-gradient(135deg, rgba(107, 115, 255, 0.1) 0%, rgba(0, 13, 255, 0.1) 100%);
    }
    .card-hover {
      transition: all 0.3s ease;
    }
    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(107, 115, 255, 0.2);
    }
    .stat-card {
      border-radius: 12px;
      overflow: hidden;
      position: relative;
    }
    .stat-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(107, 115, 255, 0.8) 0%, rgba(0, 13, 255, 0.8) 100%);
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    .stat-card:hover::before {
      opacity: 1;
    }
    .stat-card-content {
      position: relative;
      z-index: 1;
    }
    .sidebar-collapsed ~ #main {
      margin-left: 80px;
    }
    #main {
      transition: margin-left 0.3s ease;
      margin-left: 250px;
      padding: 20px;
      min-height: 100vh;
      background-color: #f8fafc;
    }
    @media (max-width: 768px) {
      #main {
        margin-left: 0;
      }
    }
  </style>
</head>

<body class="bg-gray-50">
  <main id="main" class="main">
    <div class="pagetitle mb-6">
      <h1 class="text-3xl font-bold text-gray-800">
        <span class="text-blue-600">Dashboard</span>
      </h1>
      <nav class="mt-2">
        <ol class="flex items-center space-x-1 text-sm text-gray-600">
          <li><a href="#" class="hover:text-blue-600">Home</a></li>
          <li><i class="fas fa-chevron-right text-xs mx-2 text-gray-400"></i></li>
          <li class="text-blue-600 font-medium">Dashboard</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Completed Transactions Card -->
        <div class="stat-card bg-white shadow-md card-hover">
          <div class="stat-card-content p-5">
            <div class="flex justify-between items-start">
              <div>
                <h5 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Completed Transactions</h5>
                <h3 class="text-2xl font-bold text-gray-800 mt-2"><?= $totalTransaksiSelesai; ?></h3>
              </div>
              <div class="p-3 rounded-full gradient-bg text-white">
                <i class="fas fa-check-circle text-xl"></i>
              </div>
            </div>
            <div class="mt-4">
              <span class="text-green-500 text-sm font-semibold flex items-center">
                <i class="fas fa-arrow-up mr-1"></i> Successful
              </span>
            </div>
          </div>
        </div>

        <!-- Pending Transactions Card -->
        <div class="stat-card bg-white shadow-md card-hover">
          <div class="stat-card-content p-5">
            <div class="flex justify-between items-start">
              <div>
                <h5 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Pending Transactions</h5>
                <h3 class="text-2xl font-bold text-gray-800 mt-2"><?= $totalTransaksiBelumSelesai; ?></h3>
              </div>
              <div class="p-3 rounded-full bg-amber-100 text-amber-600">
                <i class="fas fa-clock text-xl"></i>
              </div>
            </div>
            <div class="mt-4">
              <span class="text-amber-500 text-sm font-semibold flex items-center">
                <i class="fas fa-arrow-right mr-1"></i> In Process
              </span>
            </div>
          </div>
        </div>

        <!-- Rejected Transactions Card -->
        <div class="stat-card bg-white shadow-md card-hover">
          <div class="stat-card-content p-5">
            <div class="flex justify-between items-start">
              <div>
                <h5 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Rejected Transactions</h5>
                <h3 class="text-2xl font-bold text-gray-800 mt-2"><?= $totalTransaksiReject; ?></h3>
              </div>
              <div class="p-3 rounded-full bg-red-100 text-red-600">
                <i class="fas fa-times-circle text-xl"></i>
              </div>
            </div>
            <div class="mt-4">
              <span class="text-red-500 text-sm font-semibold flex items-center">
                <i class="fas fa-arrow-down mr-1"></i> Rejected
              </span>
            </div>
          </div>
        </div>

        <!-- Cancelled Transactions Card -->
        <div class="stat-card bg-white shadow-md card-hover">
          <div class="stat-card-content p-5">
            <div class="flex justify-between items-start">
              <div>
                <h5 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Cancelled Transactions</h5>
                <h3 class="text-2xl font-bold text-gray-800 mt-2"><?= $totalCancelTransaksi; ?></h3>
              </div>
              <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <i class="fas fa-ban text-xl"></i>
              </div>
            </div>
            <div class="mt-4">
              <span class="text-purple-500 text-sm font-semibold flex items-center">
                <i class="fas fa-arrow-down mr-1"></i> Cancelled
              </span>
            </div>
          </div>
        </div>

        <!-- Products Card -->
        <div class="stat-card bg-white shadow-md card-hover">
          <div class="stat-card-content p-5">
            <div class="flex justify-between items-start">
              <div>
                <h5 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Products</h5>
                <h3 class="text-2xl font-bold text-gray-800 mt-2"><?= $totalProduk; ?></h3>
              </div>
              <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-boxes text-xl"></i>
              </div>
            </div>
            <div class="mt-4">
              <span class="text-blue-500 text-sm font-semibold flex items-center">
                <i class="fas fa-cube mr-1"></i> In Stock
              </span>
            </div>
          </div>
        </div>

        <!-- Guestbook Card -->
        <div class="stat-card bg-white shadow-md card-hover">
          <div class="stat-card-content p-5">
            <div class="flex justify-between items-start">
              <div>
                <h5 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Guestbook Entries</h5>
                <h3 class="text-2xl font-bold text-gray-800 mt-2"><?= $totalGuestBook; ?></h3>
              </div>
              <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-book text-xl"></i>
              </div>
            </div>
            <div class="mt-4">
              <span class="text-green-500 text-sm font-semibold flex items-center">
                <i class="fas fa-comment mr-1"></i> Messages
              </span>
            </div>
          </div>
        </div>

        <!-- Customers Card -->
        <div class="stat-card bg-white shadow-md card-hover">
          <div class="stat-card-content p-5">
            <div class="flex justify-between items-start">
              <div>
                <h5 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Customers</h5>
                <h3 class="text-2xl font-bold text-gray-800 mt-2"><?= $totalCustomer; ?></h3>
              </div>
              <div class="p-3 rounded-full bg-cyan-100 text-cyan-600">
                <i class="fas fa-users text-xl"></i>
              </div>
            </div>
            <div class="mt-4">
              <span class="text-cyan-500 text-sm font-semibold flex items-center">
                <i class="fas fa-user-plus mr-1"></i> Registered
              </span>
            </div>
          </div>
        </div>

        <!-- Revenue Card -->
        <div class="stat-card bg-white shadow-md card-hover">
          <div class="stat-card-content p-5">
            <div class="flex justify-between items-start">
              <div>
                <h5 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Revenue</h5>
                <h3 class="text-2xl font-bold text-gray-800 mt-2">Rp<?= number_format($totalKeuangan, 0, ',', '.'); ?></h3>
              </div>
              <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
                <i class="fas fa-wallet text-xl"></i>
              </div>
            </div>
            <div class="mt-4">
              <span class="text-emerald-500 text-sm font-semibold flex items-center">
                <i class="fas fa-chart-line mr-1"></i> Income
              </span>
            </div>
          </div>
        </div>
      </div>


  <script>
    // Add animation to cards on page load
    document.addEventListener('DOMContentLoaded', () => {
      const cards = document.querySelectorAll('.stat-card');
      cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.animation = `fadeInUp 0.5s ease forwards ${index * 0.1}s`;
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