
<?php
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include 'library/connection.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];

// menyeleksi data user dengan username dan password yang sesuai
$result = mysqli_query($con, "SELECT * FROM pengguna where username='$username' and password='$password'");

$cek = mysqli_num_rows($result);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($result);
    //menyimpan session user, nama, status dan id login
    $_SESSION['username'] = $username;
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['status'] = "sudah_login";
    $_SESSION['id_login'] = $data['id_pengguna'];
    header("location:index.php");
} else {

    header("location:login.php?pesan=Login Gagal!");
}
?>
