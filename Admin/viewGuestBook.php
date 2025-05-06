<?php 
$title = 'Guest Book';

require 'adminControl.php';
require 'template/headerAdmin.php';
require 'template/sidebarAdmin.php';

$allGuestBook = query("SELECT * FROM guestbook ORDER BY idGuest DESC");

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
    .message-cell {
      max-width: 300px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .message-cell:hover {
      white-space: normal;
      overflow: visible;
      position: relative;
      z-index: 10;
      background: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
  </style>
</head>

<body class="bg-gray-50">
  <main id="main" class="main">
    <div class="pagetitle mb-6">
      <h1 class="text-3xl font-bold text-gray-800">
        <span class="gradient-text">Guest Book Messages</span>
      </h1>
      <nav class="mt-2">
        <ol class="flex items-center space-x-1 text-sm text-gray-600">
          <li><a href="dashboard.php" class="hover:text-blue-600">Dashboard</a></li>
          <li><i class="fas fa-chevron-right text-xs mx-2 text-gray-400"></i></li>
          <li class="text-blue-600 font-medium">Guest Book</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 md:mb-0">
              <span class="gradient-text">All Guest Messages</span>
            </h2>
            <div class="relative w-full md:w-64">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
              </div>
              <input type="text" id="searchingTable" placeholder="Cari pesan..." 
                class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
            </div>
          </div>

          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 table-hover">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Guest</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email Guest</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pesan Guest</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <?php $i = 1; foreach($allGuestBook as $guestBook) : ?>
                <tr class="hover:bg-gray-50 transition duration-150">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $i++; ?></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $guestBook["namaGuest"]; ?></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    <a href="mailto:<?= $guestBook["emailGuest"]; ?>" class="text-blue-600 hover:text-blue-800"><?= $guestBook["emailGuest"]; ?></a>
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-500 message-cell" title="<?= htmlspecialchars($guestBook["pesanGuest"]); ?>">
                    <?= $guestBook["pesanGuest"]; ?>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="deleteGuestBook.php?idGuest=<?= $guestBook["idGuest"]; ?>" 
                      class="text-red-600 hover:text-red-900 flex items-center px-3 py-1 border border-red-300 rounded-md hover:bg-red-50 transition"
                      onclick="return confirm('Yakin ingin menghapus pesan dari <?= $guestBook["namaGuest"]; ?>?');">
                      <i class="fas fa-trash-alt mr-1"></i> Delete
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