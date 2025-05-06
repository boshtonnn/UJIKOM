<?php 
session_start();

//cek apakah username ada di database admin
$userLogin = $_SESSION["username"];
$checkLogin = query("SELECT username FROM admin WHERE username = '$userLogin'");

if (count($checkLogin) === 0) {
    header("Location: ../logout.php");
    exit;
}

// cek login
if(!isset($_SESSION["login"])){
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?? 'APOTEK WIN - Admin'; ?></title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Custom styles -->
  <style>
    .admin-header {
      background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
    }
    .dropdown-item:hover {
      background-color: #f1f5f9;
    }
    .sidebar-bg {
      background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
    }
    .nav-item:hover {
      background-color: #e2e8f0;
      border-left: 4px solid #000DFF;
    }
    .nav-item.active {
      background-color: #e2e8f0;
      border-left: 4px solid #000DFF;
    }
    .active-link {
      color: #dc2626 !important;
      font-weight: 500;
    }
  </style>
</head>

<body class="bg-gray-50">
<!-- Overlay for mobile -->
<div id="sidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden"></div>
<!-- Header -->
<header class="fixed top-0 left-0 right-0 z-40 bg-white shadow-md">
  <div class="flex items-center justify-between px-6 py-3">
    <!-- Logo and Toggle -->
    <div class="flex items-center space-x-4">
      <button id="sidebarToggle" class="text-gray-600 focus:outline-none lg:hidden">
        <i class="fas fa-bars text-xl"></i>
      </button>
      <a href="dashboard.php" class="flex items-center">
        <img src="../img/logoapotik.jpeg" alt="Logo" class="h-10">
        <span class="ml-3 text-2xl font-bold text-blue-600 hidden lg:block">
          Hei Doc! ADMIN
        </span>
      </a>
    </div>

    <!-- User Profile -->
    <div class="relative">
      <button id="userMenuButton" class="flex items-center space-x-2 focus:outline-none">
        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-semibold">
          <?= strtoupper(substr($userLogin, 0, 1)); ?>
        </div>
        <span class="hidden md:block font-medium text-gray-700"><?= $userLogin; ?></span>
        <i class="fas fa-chevron-down text-gray-500 text-xs"></i>
      </button>

      <!-- Dropdown Menu -->
      <div id="userDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
        <div class="px-4 py-3 border-b border-gray-200">
          <p class="text-sm font-semibold text-gray-900"><?= $userLogin; ?></p>
          <p class="text-xs text-gray-500">Administrator</p>
        </div>
        <a href="../logout.php" class="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
          <i class="fas fa-sign-out-alt mr-2 text-red-500"></i> Sign Out
        </a>
      </div>
    </div>
  </div>
</header>

<script>
  // Toggle sidebar on mobile
  document.getElementById('sidebarToggle').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    sidebar.classList.toggle('-translate-x-full');
    sidebar.classList.toggle('lg:-translate-x-0');
    overlay.classList.toggle('hidden');
  });

  // Close sidebar when clicking overlay
  document.getElementById('sidebarOverlay').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    sidebar.classList.add('-translate-x-full');
    sidebar.classList.remove('lg:-translate-x-0');
    overlay.classList.add('hidden');
  });

  // Toggle user dropdown
  document.getElementById('userMenuButton').addEventListener('click', function() {
    document.getElementById('userDropdown').classList.toggle('hidden');
  });

  // Close dropdown when clicking outside
  document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('userDropdown');
    const button = document.getElementById('userMenuButton');
    
    if (!dropdown.contains(event.target) && !button.contains(event.target)) {
      dropdown.classList.add('hidden');
    }
  });
</script>