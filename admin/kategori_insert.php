
<?php
if (!defined('INDEX')) die("");
$nama_kategori = addslashes($_POST['nama_kategori']);
$query = mysqli_query($con, "INSERT INTO kategori SET
      nama_kategori = '$nama_kategori' ");

if ($query) {
    echo "<meta http-equiv='refresh' content='0; url=?hal=kategori'>";
} else {
    echo "Tidak dapat menyimpan data!<br>";
    echo mysqli_error($con);
}
?>
