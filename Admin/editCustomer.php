<?php 
$title = 'Edit Customer';

require 'adminControl.php';
require 'template/headerAdmin.php';
require 'template/sidebarAdmin.php';

$username = $_GET["username"];
$customer = query("SELECT * FROM customer WHERE username = '$username'")[0];

if(isset($_POST["submit"])){
    if(updateCustomer($_POST) > 0){
        echo "
            <script>
                alert('Customer berhasil diupdate!');
                document.location.href = 'viewCustomer.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Customer gagal diupdate!');
                document.location.href = 'viewCustomer.php';
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
    .radio-label {
      display: flex;
      align-items: center;
      cursor: pointer;
      margin-right: 16px;
    }
    .radio-input {
      margin-right: 8px;
    }
  </style>
</head>

<body class="bg-gray-50">
  <main id="main" class="main">
    <div class="pagetitle mb-6">
      <h1 class="text-3xl font-bold text-gray-800">
        <span class="gradient-text">Edit Customer</span>
      </h1>
      <nav class="mt-2">
        <ol class="flex items-center space-x-1 text-sm text-gray-600">
          <li><a href="dashboard.php" class="hover:text-blue-600">Dashboard</a></li>
          <li><i class="fas fa-chevron-right text-xs mx-2 text-gray-400"></i></li>
          <li><a href="viewCustomer.php" class="hover:text-blue-600">Customer</a></li>
          <li><i class="fas fa-chevron-right text-xs mx-2 text-gray-400"></i></li>
          <li class="text-blue-600 font-medium">Edit Customer</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="bg-white rounded-xl form-card overflow-hidden p-6">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-xl font-bold text-gray-800">
            <span class="gradient-text">Form Edit Customer: <?= $customer["username"]; ?></span>
          </h2>
        </div>

        <form class="space-y-6" method="post">
          <input type="hidden" name="passwordOLD" value="<?= $customer["password"]; ?>">

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
              <input type="text" id="username" name="username" required readonly value="<?= $customer["username"]; ?>"
                class="input-focus w-full px-4 py-2 rounded-lg border border-gray-300 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
            </div>

            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password (Kosongkan jika tidak ingin diubah)</label>
              <input type="password" id="password" name="password"
                class="input-focus w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                placeholder="Masukkan password baru">
            </div>

            <div>
              <label for="namaLengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
              <input type="text" id="namaLengkap" name="namaLengkap" required value="<?= $customer["namaLengkap"]; ?>"
                class="input-focus w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                placeholder="Masukkan nama lengkap">
            </div>

            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
              <input type="email" id="email" name="email" required value="<?= $customer["email"]; ?>"
                class="input-focus w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                placeholder="Masukkan email">
            </div>

            <div>
              <label for="dob" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
              <input type="date" id="dob" name="dob" required value="<?= $customer["dob"]; ?>"
                class="input-focus w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
              <div class="flex mt-2">
                <label class="radio-label">
                  <input type="radio" id="male" name="gender" value="male" class="radio-input" <?= ($customer["gender"] == "male") ? 'checked' : ''; ?>>
                  <span>Male</span>
                </label>
                <label class="radio-label">
                  <input type="radio" id="female" name="gender" value="female" class="radio-input" <?= ($customer["gender"] == "female") ? 'checked' : ''; ?>>
                  <span>Female</span>
                </label>
              </div>
            </div>

            <div class="md:col-span-2">
              <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
              <input type="text" id="alamat" name="alamat" required value="<?= $customer["alamat"]; ?>"
                class="input-focus w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                placeholder="Masukkan alamat lengkap">
            </div>

            <div>
              <label for="kota" class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
              <input type="text" id="kota" name="kota" required value="<?= $customer["kota"]; ?>"
                class="input-focus w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                placeholder="Masukkan kota">
            </div>

            <div>
              <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
              <input type="tel" id="contact" name="contact" required pattern="[0-9]*" value="<?= $customer["contact"]; ?>"
                class="input-focus w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                placeholder="Masukkan nomor telepon">
            </div>

            <div>
              <label for="paypalID" class="block text-sm font-medium text-gray-700 mb-1">Paypal ID</label>
              <input type="text" id="paypalID" name="paypalID" required value="<?= $customer["paypalID"]; ?>"
                class="input-focus w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                placeholder="Masukkan Paypal ID">
            </div>
          </div>

          <div class="flex justify-end space-x-3 pt-4">
            <a href="viewCustomer.php" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
              <i class="fas fa-times mr-2"></i> Batal
            </a>
            <button type="submit" name="submit" class="btn-primary px-4 py-2 rounded-md shadow-sm text-sm font-medium text-white hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
              <i class="fas fa-save mr-2"></i> Update Customer
            </button>
          </div>
        </form>
      </div>
    </section>
  </main>

  <script>
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