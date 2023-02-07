
<?php
if (!defined('INDEX')) die("");
$nama_kategori = addslashes($_POST['nama_kategori']);
$query = mysqli_query($con, "UPDATE kategori SET nama_kategori ='$nama_kategori' WHERE id_kategori='$_POST[id_kategori]'");

if ($query) {
    echo "Data berhasil disimpan!";
    echo "<meta http-equiv='refresh' content='1; url=?hal=kategori'>";
} else {
    echo "Tidak dapat menyimpan data!<br>";
    echo mysqli_error($con);
}
?>