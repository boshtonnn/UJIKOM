<?php 
$title = 'Detail Produk';

require 'custControl.php';
require 'template/headerCust.php';
require 'template/sidebarCust.php';

$id = $_GET["id"];
$produk = query("SELECT * FROM produk WHERE idProduk = '$id'")[0];
?>

<style>
    .gradient-text {
        background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .product-card {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
    .product-img {
        max-height: 400px;
        object-fit: contain;
    }
    .btn-primary-custom {
        background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
        color: white;
        transition: all 0.3s ease;
    }
    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(107, 115, 255, 0.4);
    }
    .btn-warning-custom {
        background: linear-gradient(135deg, #FFB347 0%, #FF8C00 100%);
        color: white;
        transition: all 0.3s ease;
    }
    .btn-warning-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 180, 71, 0.4);
    }
    .main-content-adjust {
        margin-top: 5rem;
        padding: 2rem;
        width: 100%;
    }
    @media (min-width: 1024px) {
        .main-content-adjust {
            margin-left: 16rem;
            width: calc(100% - 16rem);
        }
    }
</style>

<div class="main-content-adjust">
    <div class="pagetitle mb-8">
        <h1 class="text-3xl font-bold gradient-text">Detail Produk</h1>
        <p class="text-gray-600 mt-2">Informasi lengkap tentang produk</p>
    </div>

    <section class="section">
        <div class="flex justify-center">
            <div class="w-full lg:w-2/3">
                <div class="product-card p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6"><?= $produk["namaProduk"]; ?></h2>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Product Image -->
                        <div class="flex justify-center">
                            <img src="../img/<?= $produk["gambarProduk"]; ?>" class="product-img rounded-lg" alt="<?= $produk["namaProduk"]; ?>">
                        </div>

                        <!-- Product Details -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                                <input class="w-full px-4 py-2 rounded-lg border border-gray-200 bg-gray-50" value="<?= $produk["namaProduk"]; ?>" readonly>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <input class="w-full px-4 py-2 rounded-lg border border-gray-200 bg-gray-50" value="<?= $produk["kategoriProduk"]; ?>" readonly>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                                <input class="w-full px-4 py-2 rounded-lg border border-gray-200 bg-gray-50" value="Rp<?= number_format($produk["hargaProduk"], 0, ',', '.'); ?>" readonly>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Stok Tersedia</label>
                                <input class="w-full px-4 py-2 rounded-lg border border-gray-200 bg-gray-50" value="<?= $produk["stokProduk"]; ?>" readonly>
                            </div>

                            <div class="pt-4 flex space-x-4">
                                <a href="produkCust.php" class="btn-warning-custom px-6 py-2 rounded-lg font-medium text-center">
                                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                                </a>
                                <?php if($produk["stokProduk"] > 0): ?>
                                <a href="tambahKeranjang.php?idProduk=<?= $produk["idProduk"]; ?>" class="btn-primary-custom px-6 py-2 rounded-lg font-medium text-center">
                                    <i class="fas fa-shopping-cart mr-2"></i> Beli Sekarang
                                </a>
                                <?php else: ?>
                                <button class="btn-primary-custom px-6 py-2 rounded-lg font-medium text-center opacity-70 cursor-not-allowed" disabled>
                                    Stok Habis
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
