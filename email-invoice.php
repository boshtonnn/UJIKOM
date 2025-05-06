<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice #<?= $order_id ?></title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f8f8f8; padding: 20px 0;">
        <tr>
            <td align="center">
                <table width="800" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding: 20px; border: 1px solid #eee;">
                    <tr>
                        <td align="center" style="border-bottom: 1px solid #eee; padding-bottom: 10px;">
                            <h2 style="margin: 0; color: #1f2937;">Hei Doc!</h2>
                            <h3 style="margin: 5px 0; color: #3b82f6;">INVOICE PEMBELIAN</h3>
                            <p style="margin: 0; font-size: 14px;">No. Transaksi: <?= $order_id ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 20px;">
                            <h4 style="margin-bottom: 10px;">Informasi Pelanggan</h4>
                            <p style="margin: 0; font-size: 14px;">
                                <strong>Nama:</strong> <?= $transaksi['namaLengkap'] ?><br>
                                <strong>Email:</strong> <?= $email ?><br>
                                <strong>Alamat:</strong> <?= $transaksi['alamat'] ?><br>
                                <strong>No. Telp:</strong> <?= $transaksi['contact'] ?><br>
                                <strong>Tanggal:</strong> <?= date('d F Y', strtotime($transaksi['tanggalTransaksi'])) ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 20px;">
                            <h4 style="margin-bottom: 10px;">Detail Produk</h4>
                            <table width="100%" cellpadding="8" cellspacing="0" border="0" style="font-size: 14px; border: 1px solid #eee;">
                                <thead>
                                    <tr style="background-color: #f5f5f5;">
                                        <th align="left" style="border-bottom: 1px solid #eee;">No</th>
                                        <th align="left" style="border-bottom: 1px solid #eee;">Produk</th>
                                        <th align="left" style="border-bottom: 1px solid #eee;">Jumlah</th>
                                        <th align="left" style="border-bottom: 1px solid #eee;">Harga</th>
                                        <th align="left" style="border-bottom: 1px solid #eee;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; $total = 0; ?>
                                    <?php foreach ($produk as $item): ?>
                                        <?php $subtotal = $item['jumlah'] * $item['harga']; ?>
                                        <?php $total += $subtotal; ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $item['namaProduk'] ?></td>
                                            <td><?= $item['jumlah'] ?></td>
                                            <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                            <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr style="background-color: #f5f5f5;">
                                        <td colspan="4" align="right" style="font-weight: bold;">Total Pembayaran</td>
                                        <td style="font-weight: bold;">Rp <?= number_format($total, 0, ',', '.') ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 30px; text-align: center; font-size: 13px; color: #777;">
                            <p style="margin-bottom: 5px;">Terima kasih telah berbelanja di Hei Doc!</p>
                            <p style="margin: 0;">Jika Anda memiliki pertanyaan, silakan hubungi kami di <a href="mailto:contact@hei-doc.com" style="color: #3b82f6;">contact@hei-doc.com</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
