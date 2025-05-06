<?php
require 'custControl.php'; 
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// tes kirim mik
$order_id = 'TRS-1745225504'; // id mik
$email = 'nayzianrika@gmail.com'; //  emailmu

// Ambil data transaksi
$transaksi = query("SELECT transaksi.*, customer.email, customer.namaLengkap, customer.alamat, customer.contact 
                   FROM transaksi 
                   JOIN customer ON transaksi.username = customer.username 
                   WHERE transaksi.idTransaksi = '$order_id' LIMIT 1");

if (empty($transaksi)) {
    exit("Transaksi dengan ID $order_id tidak ditemukan.");
}

$transaksi = $transaksi[0];

// Ambil data produk
$produk = query("SELECT produk.namaProduk, keranjang.jumlah, keranjang.harga 
                FROM keranjang 
                JOIN produk ON keranjang.idProduk = produk.idProduk 
                WHERE keranjang.idTransaksi = '$order_id'");

// Ambil isi email
ob_start();
include 'email-invoice.php';
$email_content = ob_get_clean();

// Kirim Email
$mail = new PHPMailer(true);

try {
    // Konfigurasi SMTP
    $mail->SMTPDebug = 2; // Tampilkan output debug
    $mail->Debugoutput = 'html';
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'razpawardana@gmail.com'; 
    $mail->Password = 'bptm ftkf zglg teca'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Penerima
    $mail->setFrom('no-reply@apotekrazpa.com', 'Apotek Razpa');
    $mail->addAddress($email, $transaksi['namaLengkap']);

    // Konten Email
    $mail->isHTML(true);
    $mail->Subject = 'Test Invoice Pembelian #' . $order_id;
    $mail->Body    = $email_content;
    $mail->AltBody = strip_tags($email_content);

    $mail->send();
    echo "<h3 style='color:green;'>✅ Email berhasil dikirim ke $email</h3>";
} catch (Exception $e) {
    echo "<h3 style='color:red;'>❌ Email gagal dikirim.</h3>";
    echo "Mailer Error: " . $mail->ErrorInfo;
}
