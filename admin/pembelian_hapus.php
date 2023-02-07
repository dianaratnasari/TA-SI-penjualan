
<?php
if (!defined('INDEX')) die("");
$id_pembelian = $_GET['id_pembelian'];

$sql = mysqli_query($con, "DELETE FROM pembelian_produk WHERE id_pembelian='$id_pembelian'");

if ($sql) {
    echo "Data berhasil dihapus!";
    echo "<meta http-equiv='refresh' content='1; url=?hal=pembelian'>";
} else {
    die("<br> Tidak dapat menghapus data!" . mysqli_error($con));
}
?>