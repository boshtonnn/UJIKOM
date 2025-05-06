<?php 

$title = 'Landing Page';

session_start();
require 'connect.php';

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
  </style>
</head>

<body class="bg-gray-50">
  <div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
      <div class="text-center mb-8">
      </div>

      <div class="bg-white rounded-xl shadow-lg overflow-hidden">
      <div class="p-8">
          <div class="text-center mb-2">
            <h2 class="text-3xl font-bold text-gray-800">
            <span class="bg-clip-text text-transparent gradient-bg">Hei Doc!</span>
        </h2>
            <p class="text-gray-600 mt-2">Your Trusted Pharmacy Partner</p>
          </div>
        <div class="flex justify-center">
        <img src="img/logoapotik.jpeg" alt="Apotik Logo" class="h-30">
        </div>
        <a href="login.php" class="btn-primary w-full py-3 px-4 rounded-lg text-white font-semibold shadow-md hover:shadow-lg transition duration-200 block text-center"> Login
        </a>
        </form>

      <div class="mt-8 text-center">
        <p class="text-xs text-gray-500">
          &copy; 2025 Hei Doc!. All rights reserved.
        </p>
      </div>
    </div>
  </div>
</body>
</html>