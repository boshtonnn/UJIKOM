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
</style>

<!-- Sidebar -->
<aside id="sidebar" class="fixed top-0 left-0 z-30 w-64 h-screen pt-16 sidebar-bg shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
  <div class="h-full px-3 py-4 overflow-y-auto">
    <ul class="space-y-2">
      <li class="nav-item <?= ($title == 'Daftar Produk') ? 'active' : ''; ?> rounded-lg">
        <a href="produkCust.php" class="flex items-center p-3 text-gray-900 hover:text-blue-600 group">
          <i class="fas fa-box-open mr-3 text-blue-500 group-hover:text-blue-600"></i>
          <span class="font-medium">Daftar Produk</span>
        </a>
      </li>
      
      <li class="nav-item <?= ($title == 'Keranjang Belanja') ? 'active' : ''; ?> rounded-lg">
        <a href="viewKeranjang.php" class="flex items-center p-3 text-gray-900 hover:text-blue-600 group">
          <i class="fas fa-shopping-cart mr-3 text-blue-500 group-hover:text-blue-600"></i>
          <span class="font-medium">Keranjang Belanja</span>
          <span class="ml-auto inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white rounded-full"></span>
        </a>
      </li>
      
      <li class="nav-item <?= ($title == 'Transaksi Belanja') ? 'active' : ''; ?> rounded-lg">
        <a href="viewTransaksi.php" class="flex items-center p-3 text-gray-900 hover:text-blue-600 group">
          <i class="fas fa-receipt mr-3 text-blue-500 group-hover:text-blue-600"></i>
          <span class="font-medium">Transaksi Belanja</span>
        </a>
      </li>
      
      <li class="nav-item <?= ($title == 'FAQ Customer') ? 'active' : ''; ?> rounded-lg">
        <a href="faqCust.php" class="flex items-center p-3 text-gray-900 hover:text-blue-600 group">
          <i class="fas fa-question-circle mr-3 text-blue-500 group-hover:text-blue-600"></i>
          <span class="font-medium">FAQ Customer</span>
        </a>
      </li>
    </ul>
  </div>
</aside>

<!-- Main Content Padding -->
<div class="lg:pl-64"></div>