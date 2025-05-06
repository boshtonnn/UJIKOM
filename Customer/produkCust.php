<?php 
$title = 'Daftar Produk';

require 'custControl.php';
require 'template/headerCust.php';
require 'template/sidebarCust.php';

$allProduk = query("SELECT * FROM produk");

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
?>

<!-- Custom styles for this page -->
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
    .btn-danger {
      background: linear-gradient(135deg, #FF6B6B 0%, #FF0000 100%);
      transition: all 0.3s ease;
    }
    .btn-danger:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(255, 107, 107, 0.3);
    }
    .input-focus:focus {
      border-color: #6B73FF;
      box-shadow: 0 0 0 3px rgba(107, 115, 255, 0.2);
    }
    .custom-card-img {
      height: 220px;
      object-fit: cover;
    }
    .card-hover {
      transition: all 0.3s ease;
    }
    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    /* Main content adjustment for sidebar */
    .main-content {
      margin-top: 4rem; /* Header height */
      margin-left: 0;
      transition: margin-left 0.3s ease;
    }
    @media (min-width: 1024px) {
      .main-content {
        margin-left: 16rem; /* Sidebar width */
      }
    }
</style>

<main class="main-content p-6">
<div class="pagetitle mb-8">
  <h1 class="text-3xl font-bold text-blue-600">
    Semua Produk Hei Doc!
  </h1>
  <p class="text-gray-600 mt-2">Temukan produk kesehatan terbaik untuk kebutuhan Anda</p>
</div>

    <!-- Kategori Filter -->
    <div class="mb-8 max-w-md">
        <label for="kategoriFilter" class="block text-sm font-medium text-gray-700 mb-2">Pilih Kategori</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-filter text-gray-400"></i>
            </div>
            <select class="input-focus pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 transition duration-200" id="kategoriFilter">
                <option value="all">Semua Kategori</option>
                <?php foreach($kategori as $k) : ?>
                <option value="<?= $k; ?>"><?= $k; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php foreach($allProduk as $produk) : ?>
            <div id="produk" class="w-full" data-kategori="<?= $produk["kategoriProduk"]; ?>">
                <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
                    <img src="../img/<?= $produk["gambarProduk"]; ?>" class="w-full custom-card-img" alt="<?= $produk["namaProduk"]; ?>">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800"><?= $produk["namaProduk"]; ?></h3>
                                <span class="inline-block px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full mt-1">
                                    <?= $produk["kategoriProduk"]; ?>
                                </span>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <span class="text-xl font-bold text-red-600">
                                Rp<?= number_format($produk["hargaProduk"], 0, ',', '.'); ?>
                            </span>
                        </div>

                        <div class="mt-6 flex justify-between space-x-3">
                            <?php if($produk["stokProduk"] == 0) : ?>
                                <button class="btn-danger w-full py-2 px-4 rounded-lg text-white font-semibold cursor-not-allowed opacity-70" disabled>
                                    Stok Kosong
                                </button>
                            <?php else : ?>
                                <a href="tambahKeranjang.php?idProduk=<?= $produk["idProduk"]; ?>" class="btn-danger w-full py-2 px-4 rounded-lg text-white font-semibold text-center">
                                    Beli
                                </a>
                            <?php endif; ?>
                            
                            <a href="detailProduk.php?id=<?= $produk["idProduk"]; ?>" class="btn-primary w-full py-2 px-4 rounded-lg text-white font-semibold text-center">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        // Category filter functionality
        $("#kategoriFilter").on("change", function() {
            var selectedCategory = $(this).val();

            $("[data-kategori]").each(function() {
                var cardCategory = $(this).data("kategori");
                var isCategoryMatch = selectedCategory === "all" || cardCategory === selectedCategory;
                
                $(this).toggle(isCategoryMatch);
            });
        });
        
        // Close sidebar when clicking on a product (for mobile)
        $(".main-content").on("click", function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (window.innerWidth < 1024) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        });
    });
</script>