<?php 
$title = 'Transaksi Belanja';

require 'custControl.php';
require 'template/headerCust.php';
require 'template/sidebarCust.php';

$idTransaksi = $_GET["id"];
$username = $_SESSION["username"];

$detailTransaksi = query("SELECT * FROM transaksi
JOIN customer ON transaksi.username = customer.username
WHERE transaksi.idTransaksi = '$idTransaksi' AND transaksi.username = '$username';
")[0];

$keranjangUser = query("SELECT * FROM keranjang
JOIN produk ON keranjang.idProduk = produk.idProduk
WHERE keranjang.username = '$username' AND keranjang.idTransaksi = '$idTransaksi';
");

$tanggalTransaksi = strtotime($detailTransaksi["tanggalTransaksi"]);
$tanggalFormatted = date("j F Y", $tanggalTransaksi);

// feedback
if(isset($_POST["submit"])) {
    if(feedback($_POST) > 0) {
        echo "
            <script>
                alert('Feedback berhasil dikirim!');
                document.location.href = 'viewTransaksi.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Feedback gagal dikirim!');
                document.location.href = 'viewTransaksi.php';
            </script>
        ";
    }
    
}
?>

<style>
    /* Main content spacing */
    #main {
        margin-left: 250px;
        padding: 20px;
        margin-top: 70px;
        transition: all 0.3s;
    }
    
    @media (max-width: 992px) {
        #main {
            margin-left: 0;
        }
    }
    
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
        border-radius: 1rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        box-shadow: 0 4px 6px rgba(59, 130, 246, 0.25);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(59, 130, 246, 0.3);
    }
    
    .btn-secondary {
        background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
        box-shadow: 0 4px 6px rgba(107, 114, 128, 0.25);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(107, 114, 128, 0.3);
    }
    
    .btn-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        box-shadow: 0 4px 6px rgba(245, 158, 11, 0.25);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(245, 158, 11, 0.3);
    }
    
    .table-header {
        background-color: #e0f2fe;
    }
    
    .info-card {
        border-left: 4px solid #3b82f6;
    }
    
    /* Print-specific styles */
    @media print {
        body * {
            visibility: hidden;
        }
        #printableArea, #printableArea * {
            visibility: visible;
        }
        #printableArea {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 20px;
            background: white;
        }
        .no-print {
            display: none !important;
        }
        .card {
            border: none;
            box-shadow: none;
            background: transparent !important;
        }
        .glass-card {
            background: white !important;
            box-shadow: none !important;
            border: none !important;
        }
    }
</style>

<main id="main" class="main">
    <div class="pagetitle no-print">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center mr-3">
                <i class="fas fa-receipt text-xl text-blue-500"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-500 to-blue-700 bg-clip-text text-transparent">
                    Detail Transaksi
                </h1>
                <p class="text-sm text-gray-500">Hei Doc! - Customer Portal</p>
            </div>
        </div>
    </div><!-- End Page Title -->

    <section class="section" id="printableArea">
        <div class="container glass-card p-6 mt-4">
            <div class="row">
                <div class="flex flex-col items-center mb-8">
                    <img src="../img/logoapotik.jpeg" width="80px" class="mb-4">
                    <h2 class="text-xl font-bold bg-gradient-to-r from-blue-500 to-blue-700 bg-clip-text text-transparent">
                        Hei Doc!
                    </h2>
                    <h4 class="text-gray-600">Laporan Belanja Anda</h4>
                    <p class="text-sm text-gray-500 mt-2">No. Transaksi: <?= $idTransaksi; ?></p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Informasi Pelanggan -->
                    <div class="info-card bg-white rounded-lg shadow-sm p-5">
                        <div class="flex items-center mb-4 pb-2 border-b border-blue-100">
                            <i class="fas fa-user-circle text-blue-500 mr-2 text-lg"></i>
                            <h3 class="text-lg font-semibold text-blue-600">Informasi Pelanggan</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="grid grid-cols-3">
                                <span class="text-gray-600">Username</span>
                                <span class="col-span-2 font-medium"><?= $detailTransaksi["username"]; ?></span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-gray-600">Nama</span>
                                <span class="col-span-2 font-medium"><?= $detailTransaksi["namaLengkap"]; ?></span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-gray-600">Alamat</span>
                                <span class="col-span-2 font-medium"><?= $detailTransaksi["alamat"]; ?></span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-gray-600">No. Telp</span>
                                <span class="col-span-2 font-medium"><?= $detailTransaksi["contact"]; ?></span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-gray-600">Tanggal</span>
                                <span class="col-span-2 font-medium"><?= $tanggalFormatted; ?></span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-gray-600">Bank</span>
                                <span class="col-span-2 font-medium"><?= $detailTransaksi["bank"]; ?></span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-gray-600">Pembayaran</span>
                                <span class="col-span-2 font-medium"><?= $detailTransaksi["caraBayar"]; ?></span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-gray-600">Status</span>
                                <span class="col-span-2 font-medium text-blue-600"><?= $detailTransaksi["statusTransaksi"]; ?></span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-gray-600">Pengiriman</span>
                                <span class="col-span-2 font-medium text-blue-600"><?= $detailTransaksi["statusPengiriman"]; ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Produk -->
                    <div>
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="flex items-center bg-blue-50 px-5 py-3">
                                <i class="fas fa-shopping-basket text-blue-500 mr-2"></i>
                                <h3 class="text-lg font-semibold text-blue-600">Detail Produk</h3>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="table-header">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-blue-500 uppercase">No</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-blue-500 uppercase">Produk</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-blue-500 uppercase">Jumlah</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-blue-500 uppercase">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <?php $i = 1; ?>
                                        <?php foreach($keranjangUser as $keranjang) : ?>
                                        <tr class="hover:bg-blue-50">
                                            <td class="px-4 py-3 whitespace-nowrap text-sm"><?= $i; ?></td>
                                            <td class="px-4 py-3">
                                                <div class="font-medium"><?= $keranjang["namaProduk"]; ?></div>
                                                <div class="text-xs text-gray-500">ID: <?= $keranjang["idProduk"]; ?></div>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm"><?= $keranjang["jumlah"]; ?></td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">Rp<?= number_format($keranjang["harga"], 0, ',', '.'); ?></td>
                                        </tr>
                                        <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot class="bg-blue-50">
                                        <tr>
                                            <td colspan="3" class="px-4 py-3 text-right font-semibold text-blue-600">Total Pembayaran</td>
                                            <td class="px-4 py-3 font-semibold text-blue-600">Rp<?= number_format($detailTransaksi["totalHarga"], 0, ',', '.'); ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- Tanda Tangan -->
                        <div class="mt-4 bg-white rounded-lg shadow-sm p-4 text-center">
                            <div class="border-t-2 border-blue-200 pt-4">
                                <div class="inline-block border-b border-blue-200 pb-2 mb-2">
                                    <p class="text-sm text-gray-500">Hormat kami,</p>
                                </div>
                                <img src="../img/ttd.png" alt="Tanda Tangan" class="h-40 mx-auto mb-2">
                                <p class="font-semibold text-blue-600">Hei Doc!</p>
                                <p class="text-xs text-gray-500"><?= date('d/m/Y') ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feedback Section -->
                <div class="mt-6">
                    <div class="bg-white rounded-lg shadow-sm p-5">
                        <div class="flex items-center mb-4 pb-2 border-b border-blue-100">
                            <i class="fas fa-comment-dots text-blue-500 mr-2 text-lg"></i>
                            <h3 class="text-lg font-semibold text-blue-600">Feedback</h3>
                            
                        </div>
                        <div class="text-gray-700 mb-4">
                            <?= $detailTransaksi["feedBack"] ? nl2br($detailTransaksi["feedBack"]) : '<p class="text-gray-500">Belum ada feedback.</p>'; ?>
                        </div>

                        <?php if($detailTransaksi["feedBack"] == NULL && $detailTransaksi["statusPengiriman"] == "Terkirim" && $detailTransaksi["statusTransaksi"] != 'Cancelled') : ?>
                        <form action="" method="post" class="mt-4">
                            <input type="hidden" name="idTransaksi" value="<?= $detailTransaksi["idTransaksi"]; ?>">
                            <div class="mb-4">
                                <label for="feedbackInput" class="block text-sm font-medium text-gray-700 mb-1">Masukkan feedback Anda:</label>
                                <textarea id="feedbackInput" name="feedBack" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn-primary px-4 py-2 rounded-md text-white font-medium">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Feedback
                            </button>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>

                  <!-- Action Buttons -->
<div class="mt-6 flex space-x-4 no-print">
    <button id="printButton" class="btn-secondary px-4 py-2 rounded-md text-white font-medium">
        <i class="fas fa-print mr-2"></i> Cetak
    </button>
    <button id="sendEmailButton" class="btn-primary px-4 py-2 rounded-md text-white font-medium">
        <i class="fas fa-envelope mr-2"></i> Kirim ke Email
    </button>
    <a href="viewTransaksi.php" class="btn-warning px-4 py-2 rounded-md text-white font-medium">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
</div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById("printButton").addEventListener("click", function() {
            window.print();
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script>
document.getElementById("printButton").addEventListener("click", function() {
    window.print();
});

document.getElementById("sendEmailButton").addEventListener("click", function() {
    // Tampilkan loading spinner
    const button = this;
    const originalHtml = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';
    button.disabled = true;
    
    fetch('../send-invoice.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            order_id: '<?= $idTransaksi; ?>',
            email: '<?= $detailTransaksi["email"] ?? ""; ?>' // Pastikan field email ada di tabel customer
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if(data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Invoice telah dikirim ke email Anda',
                confirmButtonColor: '#3b82f6',
            });
        } else {
            throw new Error(data.message || 'Gagal mengirim email');
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: error.message,
            confirmButtonColor: '#ef4444',
        });
    })
    .finally(() => {
        // Kembalikan tombol ke state semula
        button.innerHTML = originalHtml;
        button.disabled = false;
    });
});
</script>
</main>

