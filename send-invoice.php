<?php
require 'custControl.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}


$json = file_get_contents('php://input');
$data = json_decode($json, true);


if (empty($data['order_id']) || empty($data['email'])) {
    echo json_encode(['success' => false, 'message' => 'Order ID atau email tidak valid']);
    exit;
}

$order_id = $data['order_id'];
$email = $data['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Format email tidak valid']);
    exit;
}


$transaksi = query("SELECT transaksi.*, customer.email, customer.namaLengkap, customer.alamat, customer.contact 
                    FROM transaksi 
                    JOIN customer ON transaksi.username = customer.username 
                    WHERE transaksi.idTransaksi = '$order_id' LIMIT 1");

if (empty($transaksi)) {
    echo json_encode(['success' => false, 'message' => 'Transaksi tidak ditemukan']);
    exit;
}

$transaksi = $transaksi[0];


$produk = query("SELECT produk.namaProduk, keranjang.jumlah, keranjang.harga 
                FROM keranjang 
                JOIN produk ON keranjang.idProduk = produk.idProduk 
                WHERE keranjang.idTransaksi = '$order_id'");


ob_start();
include __DIR__ . '/email-invoice.php';
$email_content = ob_get_clean();


$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = '22082010243@student.upnjatim.ac.id';
    $mail->Password = 'uzyr pqzg lsrs xzor'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ];

    $mail->setFrom('no-reply@hei-doc.com', 'Hei Doc!');
    $mail->addAddress($email, $transaksi['namaLengkap']);
    $mail->addReplyTo('cs@hei-doc.com', 'Customer Service');

    $mail->isHTML(true);
    $mail->Subject = 'Invoice Pembelian #' . $order_id;
    $mail->Body    = $email_content;
    $mail->AltBody = strip_tags($email_content);

    $mail->send();

    echo json_encode(['success' => true, 'message' => 'Invoice berhasil dikirim ke email']);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Gagal mengirim email. Error: ' . $mail->ErrorInfo
    ]);
}
