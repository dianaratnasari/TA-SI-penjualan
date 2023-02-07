
<?php
if (!defined('INDEX')) die("");

if (isset($_POST['id_produk']) & (isset($_POST['tambah_pembelian']))) {
    $id = htmlspecialchars($_POST['id_produk']);
    $tanggal = htmlspecialchars($_POST['tanggal_pembelian']);
    $jumlah = htmlspecialchars($_POST['jumlah']);

    $query = mysqli_query($con, "INSERT INTO pembelian_produk SET 
                            id_produk = '$id',
                            tanggal_pembelian ='$tanggal',
                           jumlah = '$jumlah'
                       ");
    if ($query) {
        echo "Data berhasil disimpan!";
        echo "<meta http-equiv='refresh' content='0; url=?hal=pembelian'>";
    } else {
        die("<br> Tidak dapat menyimpan data!" . mysqli_error($con));
    }
}
?>
