<?php
if (!defined('INDEX')) die("");

$nama =  addslashes($_POST['nama']);
$username =  addslashes($_POST['username']);
$password =  addslashes($_POST['password']);
$query = mysqli_query($con, "INSERT INTO pengguna SET nama = '$nama', username = '$username', password = '$password' ");

if ($query) {
    echo "Data berhasil disimpan!";
    echo "<meta http-equiv='refresh' content='1; url=?hal=pengguna'>";
} else {
    echo "Tidak dapat menyimpan data!<br>";
    mysqli_error($con);
}
