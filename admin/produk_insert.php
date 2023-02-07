
<?php
if (!defined('INDEX')) die("");

$nama_produk = addslashes($_POST['nama_produk']);
$harga = htmlspecialchars($_POST['harga']);
$id_kategori = htmlspecialchars($_POST['id_kategori']);


$query = mysqli_query($con, "INSERT INTO produk SET 
                         nama_produk = '$nama_produk',
                        harga = '$harga',
                        id_kategori = '$id_kategori'
                     
                   ");
if ($query) {
    echo "Data berhasil disimpan!";
    echo "<meta http-equiv='refresh' content='1; url=?hal=produk'>";
} else {
    die("<br> Tidak dapat menyimpan data!" . mysqli_error($con));
}
?>