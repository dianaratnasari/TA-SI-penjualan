<?php
session_start();
ob_start();

include "library/connection.php";

//cek apakah sesuai status sudah login? kalau belum akan kembali ke form login
if ($_SESSION['status'] != "sudah_login") {
    //melakukan pengalihan
    header("location:login.php");
} else {
    define('INDEX', true);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <header>
            <p> Warung Pereng Kaliabank </p>
            <h6>Welcome, <?php echo $_SESSION['nama']; ?></h6>
        </header>
        <aside>
            <ul>
                <li><a href="?hal=dashboard" class="aktif"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
                <li><a href="?hal=kategori"><i class="fas fa-th-large"></i>Kategori Produk</a></li>
                <li><a href="?hal=pembelian"><i class="fas fa-boxes"></i>Pembelian Produk</a></li>
                <li><a href="?hal=produk"><i class="fas fa-file-alt"></i>Data Produk</a></li>
                <li><a href="?hal=transaksi"><i class="fas fa-file-invoice-dollar"></i>Transaksi</a></li>
                <li><a href="?hal=penjualan"><i class="fas fa-file-invoice"></i></i>Data Penjualan</a></li>
                <li><a href="?hal=pengguna"><i class="fas fa-user"></i>Pengguna</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
            </ul>
        </aside>
        <main>
            <?php
            include "konten.php";
            ?>
        </main>
        <footer>Copyright @Warung Pereng Kaliabank</footer>
    </div>
</body>

</html>