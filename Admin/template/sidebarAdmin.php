<style>
  .sidebar-bg {
    background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
  }
  .nav-item:hover {
    background-color: #e2e8f0;
    border-left: 4px solid #6B73FF;
  }
  .nav-item.active {
    background-color: #e2e8f0;
    border-left: 4px solid #6B73FF;
  }
  .active-link {
    color: #2563eb !important;
    font-weight: 500;
  }
</style>

<!-- Sidebar -->
<aside id="sidebar" class="fixed top-0 left-0 z-30 w-64 h-screen pt-16 sidebar-bg shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
  <div class="h-full px-3 py-4 overflow-y-auto">
    <ul class="space-y-2">
      <li class="nav-item <?= ($title == 'Dashboard') ? 'active' : ''; ?> rounded-lg">
        <a href="dashboard.php" class="flex items-center p-3 text-gray-900 hover:text-blue-600 group <?= ($title == 'Dashboard') ? 'active-link' : ''; ?>">
          <i class="fas fa-house mr-3 text-blue-500 group-hover:text-blue-600"></i>
          <span class="font-medium">Dashboard</span>
        </a>
      </li>
      
      <li class="nav-item <?= ($title == 'Daftar Produk') ? 'active' : ''; ?> rounded-lg">
        <a href="produkAdmin.php" class="flex items-center p-3 text-gray-900 hover:text-blue-600 group <?= ($title == 'Daftar Produk') ? 'active-link' : ''; ?>">
          <i class="fas fa-boxes mr-3 text-blue-500 group-hover:text-blue-600"></i>
          <span class="font-medium">Daftar Produk</span>
        </a>
      </li>
      
      <li class="nav-item <?= ($title == 'Customer') ? 'active' : ''; ?> rounded-lg">
        <a href="viewCustomer.php" class="flex items-center p-3 text-gray-900 hover:text-blue-600 group <?= ($title == 'Customer') ? 'active-link' : ''; ?>">
          <i class="fas fa-users mr-3 text-blue-500 group-hover:text-blue-600"></i>
          <span class="font-medium">Customer</span>
        </a>
      </li>
      
      <li class="nav-item <?= ($title == 'Transaksi Belanja') ? 'active' : ''; ?> rounded-lg">
        <a href="viewTransaksi.php" class="flex items-center p-3 text-gray-900 hover:text-blue-600 group <?= ($title == 'Transaksi Belanja') ? 'active-link' : ''; ?>">
          <i class="fas fa-receipt mr-3 text-blue-500 group-hover:text-blue-600"></i>
          <span class="font-medium">Transaksi Belanja</span>
        </a>
      </li>
      
      <li class="nav-item <?= ($title == 'Guest Book') ? 'active' : ''; ?> rounded-lg">
        <a href="viewGuestBook.php" class="flex items-center p-3 text-gray-900 hover:text-blue-600 group <?= ($title == 'Guest Book') ? 'active-link' : ''; ?>">
          <i class="fas fa-book-open mr-3 text-blue-500 group-hover:text-blue-600"></i>
          <span class="font-medium">Guest Book</span>
        </a>
      </li>
    </ul>
  </div>
</aside>

<!-- Main Content Padding -->
<div class="lg:pl-64 pt-16"></div>