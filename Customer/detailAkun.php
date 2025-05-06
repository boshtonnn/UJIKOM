<?php 
$title = 'Detail Akun';

require 'custControl.php';
require 'template/headerCust.php';
require 'template/sidebarCust.php';

$username = $_SESSION["username"];
$customer = query("SELECT * FROM customer WHERE username = '$username'")[0];

$tanggalLahir = strtotime($customer["dob"]);
$tanggalFormatted = date("j F Y", $tanggalLahir);
?>

<style>
    .gradient-text {
        background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .profile-card {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin-left: 0;
    }
    @media (min-width: 1024px) {
        .profile-card {
            margin-left: 16rem; /* Sesuaikan dengan lebar sidebar */
        }
    }
    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
    .detail-label {
        color: #4b5563;
        font-weight: 600;
    }
    .detail-value {
        color: #1f2937;
    }
    .divider {
        border-bottom: 1px solid #e5e7eb;
        margin: 1rem 0;
    }
    .main-content-adjust {
        margin-top: 5rem; /* Tinggi header */
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
        <h1 class="text-3xl font-bold gradient-text">Detail Akun</h1>
        <p class="text-gray-600 mt-2">Informasi lengkap profil Anda</p>
    </div>

    <section class="section">
        <div class="profile-card p-6">
            <div class="space-y-4">
                <!-- Profile Header -->
                <div class="flex items-center space-x-4 mb-6">
                    <div class="h-16 w-16 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white text-2xl font-bold">
                        <?= strtoupper(substr($customer["username"], 0, 1)); ?>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800"><?= $customer["namaLengkap"]; ?></h2>
                        <p class="text-gray-500">@<?= $customer["username"]; ?></p>
                    </div>
                </div>

                <!-- Account Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <p class="detail-label">Username</p>
                            <p class="detail-value"><?= $customer["username"]; ?></p>
                        </div>
                        
                        <div class="divider"></div>
                        
                        <div>
                            <p class="detail-label">Nama Lengkap</p>
                            <p class="detail-value"><?= $customer["namaLengkap"]; ?></p>
                        </div>
                        
                        <div class="divider"></div>
                        
                        <div>
                            <p class="detail-label">Email</p>
                            <p class="detail-value"><?= $customer["email"]; ?></p>
                        </div>
                        
                        <div class="divider"></div>
                        
                        <div>
                            <p class="detail-label">Tanggal Lahir</p>
                            <p class="detail-value"><?= $tanggalFormatted; ?></p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <p class="detail-label">Gender</p>
                            <p class="detail-value"><?= $customer["gender"]; ?></p>
                        </div>
                        
                        <div class="divider"></div>
                        
                        <div>
                            <p class="detail-label">Alamat</p>
                            <p class="detail-value"><?= $customer["alamat"]; ?></p>
                        </div>
                        
                        <div class="divider"></div>
                        
                        <div>
                            <p class="detail-label">Kota</p>
                            <p class="detail-value"><?= $customer["kota"]; ?></p>
                        </div>
                        
                        <div class="divider"></div>
                        
                        <div>
                            <p class="detail-label">Contact</p>
                            <p class="detail-value"><?= $customer["contact"]; ?></p>
                        </div>
                        
                        <div class="divider"></div>
                        
                        <div>
                            <p class="detail-label">Paypal ID</p>
                            <p class="detail-value"><?= $customer["paypalID"]; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
