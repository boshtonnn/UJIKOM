<?php 
$title = 'Edit Produk';

require 'adminControl.php';
require 'template/headerAdmin.php';
require 'template/sidebarAdmin.php';

$idProduk = $_GET["id"];
$produk = query("SELECT * FROM produk WHERE idProduk = '$idProduk'")[0];

$kategori = array(
    "Peralatan Medis",
    "Obat dan Suplemen",
    "Alat Bantu Jalan",
    "Alat Ukur Kesehatan",
    "Alat Pemantau Kesehatan",
    "Alat Terapi dan Rehabilitasi",
    "Perlengkapan Rumah Sakit",
    "Perlengkapan Dokter",
    "Perlengkapan Perawat",
    "lain-lain"
);

if(isset($_POST["submit"])){
    if(updateProduk($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil diubah!');
                document.location.href = 'produkAdmin.php';
            </script>
        ";
    }
    else{
        echo "
            <script>
                alert('Data gagal diubah!');
                document.location.href = 'produkAdmin.php';
            </script>
        ";
    }
}
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
    .input-focus:focus {
      border-color: #6B73FF;
      box-shadow: 0 0 0 3px rgba(107, 115, 255, 0.2);
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
    .form-card {
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      transition: all 0.3s ease;
    }
    .form-card:hover {
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
  </style>
</head>

<body class="bg-gray-50">
  <main id="main" class="main">
    <div class="pagetitle mb-6">
      <h1 class="text-3xl font-bold text-gray-800">
        <span class="gradient-text">Edit Produk</span>
      </h1>
      <nav class="mt-2">
        <ol class="flex items-center space-x-1 text-sm text-gray-600">
          <li><a href="dashboard.php" class="hover:text-blue-600">Dashboard</a></li>
          <li><i class="fas fa-chevron-right text-xs mx-2 text-gray-400"></i></li>
          <li><a href="produkAdmin.php" class="hover:text-blue-600">Produk</a></li>
          <li><i class="fas fa-chevron-right text-xs mx-2 text-gray-400"></i></li>
          <li class="text-blue-600 font-medium">Edit Produk</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="bg-white rounded-xl form-card overflow-hidden p-6">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-xl font-bold text-gray-800">
            <span class="gradient-text">Form Edit Produk</span>
          </h2>
        </div>

        <form class="space-y-6" method="post" enctype="multipart/form-data">
          <input type="hidden" name="idProduk" value="<?= $produk["idProduk"]; ?>">
          <input type="hidden" name="beforeupdate" value="<?= $produk["gambarProduk"]; ?>">

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="namaProduk" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
              <input type="text" id="namaProduk" name="namaProduk" required value="<?= $produk["namaProduk"]; ?>"
                class="input-focus w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                placeholder="Masukkan nama produk">
            </div>

            <div>
              <label for="kategoriProduk" class="block text-sm font-medium text-gray-700 mb-1">Kategori Produk</label>
              <select id="kategoriProduk" name="kategoriProduk" required
                class="input-focus w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                <option value="">-- Pilih Kategori --</option>
                <?php foreach($kategori as $k) : ?>
                  <?php if($k == $produk["kategoriProduk"]) : ?>
                    <option value="<?= $k; ?>" selected><?= $k; ?></option>
                  <?php else : ?>
                    <option value="<?= $k; ?>"><?= $k; ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>

            <div>
              <label for="hargaProduk" class="block text-sm font-medium text-gray-700 mb-1">Harga Produk</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <span class="text-gray-500">Rp</span>
                </div>
                <input type="number" id="hargaProduk" name="hargaProduk" required value="<?= $produk["hargaProduk"]; ?>"
                  class="input-focus pl-10 w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                  placeholder="Masukkan harga">
              </div>
            </div>

            <div>
              <label for="stokProduk" class="block text-sm font-medium text-gray-700 mb-1">Stok Produk</label>
              <input type="number" id="stokProduk" name="stokProduk" required value="<?= $produk["stokProduk"]; ?>"
                class="input-focus w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                placeholder="Masukkan jumlah stok">
            </div>

            <div class="md:col-span-2">
              <label for="gambarProduk" class="block text-sm font-medium text-gray-700 mb-1">Gambar Produk</label>
              <div class="mt-1 flex items-center space-x-4">
                <div class="border rounded-lg p-2">
                  <img src="../img/<?= $produk["gambarProduk"]; ?>" width="150" class="rounded-md">
                  <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                </div>
                <div>
                  <label for="gambarProduk" class="cursor-pointer">
                    <div class="flex flex-col items-center justify-center px-6 py-8 border-2 border-dashed border-gray-300 rounded-lg hover:border-gray-400 transition">
                      <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                      <p class="text-sm text-gray-600">Klik untuk upload gambar baru</p>
                      <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG (Max 2MB)</p>
                    </div>
                    <input id="gambarProduk" name="gambarProduk" type="file" class="sr-only">
                  </label>
                </div>
              </div>
              <div id="preview" class="mt-2 hidden">
                <p class="text-sm text-gray-600">Preview gambar baru:</p>
                <img id="previewImage" class="mt-1 h-32 rounded-md border border-gray-200">
              </div>
            </div>
          </div>

          <div class="flex justify-end space-x-3 pt-4">
            <a href="produkAdmin.php" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
              <i class="fas fa-times mr-2"></i> Batal
            </a>
            <button type="submit" name="submit" class="btn-primary px-4 py-2 rounded-md shadow-sm text-sm font-medium text-white hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
              <i class="fas fa-save mr-2"></i> Update Produk
            </button>
          </div>
        </form>
      </div>
    </section>
  </main>

  <script>
    // Image preview functionality
    document.getElementById('gambarProduk').addEventListener('change', function(e) {
      const preview = document.getElementById('preview');
      const previewImage = document.getElementById('previewImage');
      const file = e.target.files[0];
      
      if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
          previewImage.src = e.target.result;
          preview.classList.remove('hidden');
        }
        
        reader.readAsDataURL(file);
      } else {
        preview.classList.add('hidden');
      }
    });

    // Add animation to form elements
    document.addEventListener('DOMContentLoaded', () => {
      const formElements = document.querySelectorAll('input, select, button, label');
      formElements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(10px)';
        element.style.animation = `fadeInUp 0.3s ease forwards ${index * 0.05}s`;
      });
      
      // Add style for animation
      const style = document.createElement('style');
      style.textContent = `
        @keyframes fadeInUp {
          from {
            opacity: 0;
            transform: translateY(10px);
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