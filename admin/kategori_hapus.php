
<?php
if (!defined('INDEX')) die("");

$query = mysqli_query($con, "DELETE FROM kategori WHERE id_kategori='$_GET[id_kategori]'");

if ($query) {
    echo "Data berhasil dihapus!";
    echo "<meta http-equiv='refresh' content='1; url=?hal=kategori'>";
} else {
    echo "Tidak dapat menyimpan data!<br>";
    echo mysqli_error($con);
}
