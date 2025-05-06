<?php
$title = 'FAQ Customer';

require 'custControl.php';
require 'template/headerCust.php';
require 'template/sidebarCust.php';

$username = $_SESSION["username"];
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
  </style>
</head>

<body class="bg-gray-50">
  <!-- Header is included from headerCust.php -->
  <!-- Sidebar is included from sidebarCust.php -->
  
  <main id="main" class="main">
    <div class="pagetitle mb-8">
      <h1 class="text-3xl font-bold text-blue-600">Frequently Asked Questions</h1>
      <nav class="mt-2">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
          <li><i class="fas fa-home text-blue-500"></i></li>
          <li><span class="mx-2">/</span></li>
          <li>FAQ</li>
        </ol>
      </nav>
    </div>

    <div class="container mx-auto px-4">
      <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-8">
          <div class="space-y-6">
            <div class="faq-item border-b border-gray-200 pb-6 last:border-0">
              <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                <i class="fas fa-question-circle text-green-500 mr-3"></i>
                Bagaimana cara membuat akun?
              </h3>
              <p class="mt-2 text-gray-600 pl-9">
                Untuk membuat akun, klik tombol 'Daftar' di halaman login dan isi formulir pendaftaran dengan data yang benar. Anda akan menerima email konfirmasi setelahnya.
              </p>
            </div>

            <div class="faq-item border-b border-gray-200 pb-6 last:border-0">
              <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                <i class="fas fa-user-edit text-blue-500 mr-3"></i>
                Bagaimana cara mengubah informasi akun?
              </h3>
              <p class="mt-2 text-gray-600 pl-9">
                Anda dapat mengubah informasi akun dengan masuk ke akun Anda, lalu di pojok kanan atas pergi ke menu 'My Profil'. Di sana Anda bisa memperbarui informasi Anda.
              </p>
            </div>

            <div class="faq-item border-b border-gray-200 pb-6 last:border-0">
              <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                <i class="fas fa-history text-purple-500 mr-3"></i>
                Bagaimana cara melihat riwayat pesanan saya?
              </h3>
              <p class="mt-2 text-gray-600 pl-9">
                Setelah pesanan dikonfirmasi, pesanan Anda akan masuk secara otomatis di menu Transaksi Belanja. Anda juga bisa melakukan pengecekan apakah pesanan Anda sudah dikonfirmasi oleh pihak admin.
              </p>
            </div>

            <div class="faq-item border-b border-gray-200 pb-6 last:border-0">
              <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                <i class="fas fa-credit-card text-yellow-500 mr-3"></i>
                Apa metode pembayaran yang tersedia?
              </h3>
              <p class="mt-2 text-gray-600 pl-9">
                Kami menerima berbagai metode pembayaran seperti pembayaran di tempat dan transfer bank. Pilihan metode pembayaran dapat Anda lihat di halaman Keranjang Belanja.
              </p>
            </div>

            <div class="faq-item">
              <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                <i class="fas fa-exchange-alt text-red-500 mr-3"></i>
                Bagaimana cara mengajukan pengembalian barang?
              </h3>
              <p class="mt-2 text-gray-600 pl-9">
                Barang yang sudah dibeli tidak bisa dikembalikan lagi, jadi pastikan barang yang Anda beli sudah sesuai dengan kebutuhan Anda.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

</body>
</html>