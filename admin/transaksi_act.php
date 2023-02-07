
<?php



$tgl_transaksi = date("Y-m-d H:i:s");
$total_transaksi = $_POST['total'];
$pembayaran = $_POST['bayar'];
$kembalian = $pembayaran - $total_transaksi;
$idpengguna = $_SESSION['id_login'];
//menyimpan data ke tabel transaksi
$query = mysqli_query($con, "INSERT INTO transaksi (id_transaksi,tgl_transaksi, total_transaksi,bayar, kembalian, id_pengguna)
                         VALUES ('','$tgl_transaksi','$total_transaksi','$pembayaran','$kembalian','$idpengguna') ");

//mendapatkan id_pembelian barusan terjadi
$idtransaksi = mysqli_insert_id($con);

foreach ($_SESSION['cart'] as $key => $value) {
    $id_produk = $value['id'];
    $harga = $value['harga'];
    $jumlah = $value['jumlah'];
    // $total = $harga * $jumlah;

    mysqli_query($con, "INSERT INTO detail_transaksi (id_transaksi, id_produk, harga,jumlah)
                             VALUES ('$idtransaksi','$id_produk','$harga','$jumlah')");


    //mengkosongkan keranjang belanja
    unset($_SESSION['cart']);

}
//echo "<script>location='?hal=bayar?idtran=$idtransaksi';</script>";


//echo "<meta http-equiv='refresh' content='0; url=?hal=transaksi_bayar&idtran=$idtransaksi'>";
echo "<meta http-equiv='refresh' content='0; url=admin/nota.php?idtran=$idtransaksi'>";
?>
