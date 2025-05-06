<?php 
$title = 'Transaksi Belanja';

require 'adminControl.php';
require 'template/headerAdmin.php';
require 'template/sidebarAdmin.php';

$allTransaksi = query("SELECT * FROM transaksi ORDER BY idTransaksi DESC");

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
    .table-hover tbody tr:hover {
      background-color: rgba(107, 115, 255, 0.05);
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
    <div class="pagetitle mb-6">
      <h1 class="text-3xl font-bold text-gray-800">
        <span class="gradient-text">Transaction Management</span>
      </h1>
      <nav class="mt-2">
        <ol class="flex items-center space-x-1 text-sm text-gray-600">
          <li><a href="dashboard.php" class="hover:text-blue-600">Dashboard</a></li>
          <li><i class="fas fa-chevron-right text-xs mx-2 text-gray-400"></i></li>
          <li class="text-blue-600 font-medium">Transactions</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 md:mb-0">
              <span class="gradient-text">All Customer Transactions</span>
            </h2>
            <div class="relative w-full md:w-64">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
              </div>
              <input type="text" id="searchingTable" placeholder="Cari transaksi..." 
                class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
            </div>
          </div>

          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 table-hover">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Shipping</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <?php $i = 1; foreach($allTransaksi as $transaksi) : ?>
                <tr class="hover:bg-gray-50 transition duration-150">
                  <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500"><?= $i++; ?></td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">#<?= $transaksi["idTransaksi"]; ?></td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900"><?= $transaksi["username"]; ?></td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500"><?= date('d M Y', strtotime($transaksi["tanggalTransaksi"])); ?></td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                    <div class="flex items-center">
                      <span class="mr-2"><?= $transaksi["caraBayar"]; ?></span>
                      <?php if($transaksi["bank"]): ?>
                        <span class="text-xs px-2 py-1 rounded bg-blue-100 text-blue-800"><?= $transaksi["bank"]; ?></span>
                      <?php endif; ?>
                    </div>
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm">
                    <?php
                    $statusClass = 'status-pending';
                    if ($transaksi["statusTransaksi"] == 'Accepted') $statusClass = 'status-accepted';
                    if ($transaksi["statusTransaksi"] == 'Rejected') $statusClass = 'status-rejected';
                    if ($transaksi["statusTransaksi"] == 'Cancelled') $statusClass = 'status-cancelled';
                    ?>
                    <span class="status-badge <?= $statusClass ?>"><?= $transaksi["statusTransaksi"]; ?></span>
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm">
                    <?php
                    $shippingClass = 'shipping-pending';
                    if ($transaksi["statusPengiriman"] == 'Terkirim') $shippingClass = 'shipping-delivered';
                    if ($transaksi["statusPengiriman"] == 'Dalam Perjalanan') $shippingClass = 'shipping-shipping';
                    ?>
                    <span class="shipping-status <?= $shippingClass ?>"><?= $transaksi["statusPengiriman"]; ?></span>
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                    Rp<?= number_format($transaksi["totalHarga"], 0, ',', '.'); ?>
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                    <?php if($transaksi["statusTransaksi"] == 'Accepted' || $transaksi["statusTransaksi"] == 'Rejected' || $transaksi["statusTransaksi"] == 'Cancelled') : ?>
                      <span class="text-gray-400 text-xs">Completed</span>
                    <?php else : ?>
                      <div class="flex space-x-1">
                        <a href="acceptTransaksi.php?idTransaksi=<?= $transaksi["idTransaksi"]; ?>" 
                          class="text-green-600 hover:text-green-900 flex items-center px-2 py-1 border border-green-300 rounded-md hover:bg-green-50 transition text-xs"
                          onclick="return confirm('Yakin menerima pesanan dengan id <?= $transaksi["idTransaksi"]; ?>?');">
                          <i class="fas fa-check-circle mr-1"></i> Accept
                        </a>
                        <a href="rejectTransaksi.php?idTransaksi=<?= $transaksi["idTransaksi"]; ?>" 
                          class="text-red-600 hover:text-red-900 flex items-center px-2 py-1 border border-red-300 rounded-md hover:bg-red-50 transition text-xs"
                          onclick="return confirm('Yakin menolak pesanan dengan id <?= $transaksi["idTransaksi"]; ?>?');">
                          <i class="fas fa-times-circle mr-1"></i> Reject
                        </a>
                      </div>
                    <?php endif; ?>
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                    <a href="cetakTransaksi.php?idTransaksi=<?= $transaksi["idTransaksi"]; ?>&username=<?= $transaksi["username"]; ?>" 
                      class="text-blue-600 hover:text-blue-900 flex items-center px-3 py-1 border border-blue-300 rounded-md hover:bg-blue-50 transition">
                      <i class="fas fa-eye mr-1"></i> View
                    </a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </main>

  <script>
    // Search functionality
    document.getElementById('searchingTable').addEventListener('input', function() {
      const searchValue = this.value.toLowerCase();
      const rows = document.querySelectorAll('tbody tr');
      
      rows.forEach(row => {
        const rowText = row.textContent.toLowerCase();
        row.style.display = rowText.includes(searchValue) ? '' : 'none';
      });
    });

    // Add animation to table rows
    document.addEventListener('DOMContentLoaded', () => {
      const rows = document.querySelectorAll('tbody tr');
      rows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateX(-20px)';
        row.style.animation = `fadeInRight 0.3s ease forwards ${index * 0.05}s`;
      });
      
      // Add style for animation
      const style = document.createElement('style');
      style.textContent = `
        @keyframes fadeInRight {
          from {
            opacity: 0;
            transform: translateX(-20px);
          }
          to {
            opacity: 1;
            transform: translateX(0);
          }
        }
      `;
      document.head.appendChild(style);
    });
  </script>
</body>
</html>