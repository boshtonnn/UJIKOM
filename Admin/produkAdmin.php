<?php 
$title = "Daftar Produk";

require 'adminControl.php';
require 'template/headerAdmin.php';
require 'template/sidebarAdmin.php';

$allProduk = query("SELECT * FROM produk");

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
  </style>
</head>

<body class="bg-gray-50">
  <main id="main" class="main">
    <div class="pagetitle mb-6">
      <h1 class="text-3xl font-bold text-gray-800">
        <span class="gradient-text">Daftar Produk</span>
      </h1>
      <nav class="mt-2">
        <ol class="flex items-center space-x-1 text-sm text-gray-600">
          <li><a href="dashboard.php" class="hover:text-blue-600">Dashboard</a></li>
          <li><i class="fas fa-chevron-right text-xs mx-2 text-gray-400"></i></li>
          <li class="text-blue-600 font-medium">Produk</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 md:mb-0">
              <span class="gradient-text">Semua Produk</span>
            </h2>
            <div class="flex flex-col sm:flex-row gap-3">
              <a href="tambahProduk.php" class="btn-primary px-4 py-2 rounded-lg text-white font-semibold shadow-md hover:shadow-lg transition duration-200 flex items-center justify-center">
                <i class="fas fa-plus-circle mr-2"></i> Tambah Produk
              </a>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" id="searchingTable" placeholder="Cari produk..." 
                  class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
              </div>
            </div>
          </div>

          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 table-hover">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Produk</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <?php $i = 1; ?>
                <?php foreach($allProduk as $produk) : ?>
                <tr class="hover:bg-gray-50 transition duration-150">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $i; ?></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $produk["idProduk"]; ?></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $produk["namaProduk"]; ?></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $produk["kategoriProduk"]; ?></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp<?= number_format($produk["hargaProduk"], 0, ',', '.'); ?></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $produk["stokProduk"] > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                      <?= $produk["stokProduk"]; ?>
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <img src="../img/<?= $produk["gambarProduk"]; ?>" class="h-12 w-12 rounded-md object-cover shadow-sm">
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex space-x-2">
                      <a href="editProduk.php?id=<?= $produk["idProduk"]; ?>" class="text-amber-600 hover:text-amber-900 flex items-center">
                        <i class="fas fa-edit mr-1"></i> Edit
                      </a>
                      <span class="text-gray-300">|</span>
                      <a href="deleteProduk.php?id=<?= $produk["idProduk"]; ?>" class="text-red-600 hover:text-red-900 flex items-center" onclick="return confirm('Yakin ingin menghapus produk <?= $produk["namaProduk"]; ?>?');">
                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                      </a>
                    </div>
                  </td>
                </tr>
                <?php $i++; ?>
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