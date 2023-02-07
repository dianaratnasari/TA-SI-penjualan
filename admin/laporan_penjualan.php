<?php
if (!defined('INDEX')) die("");

$perPage = 15; //per halaman
$page = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
$query2 = mysqli_query($con, "SELECT * FROM detail_transaksi INNER JOIN produk ON detail_transaksi.id_produk=produk.id_produk 
            INNER JOIN transaksi ON detail_transaksi.id_transaksi=transaksi.id_transaksi ORDER BY transaksi.tgl_transaksi DESC LIMIT $start, $perPage");
$query = mysqli_query($con, "SELECT * FROM detail_transaksi INNER JOIN produk ON detail_transaksi.id_produk=produk.id_produk 
INNER JOIN transaksi ON detail_transaksi.id_transaksi=transaksi.id_transaksi ORDER BY transaksi.tgl_transaksi DESC");
$total = mysqli_num_rows($query);
$pages = ceil($total / $perPage);

?>

<form class="form-tambahpembelian" style="height: 15%; margin-top: 25px; margin-bottom: 15px;" method="POST" action="admin/cetak_laporanpenjualan.php" > 
    <div class="pembelian">
        <label class="label-pembelian">Dari tanggal</label>
        <input class="input-pembelian" type="date" name="tgl_mulai" required>
    </div>
    <div class="pembelian">
        <label class="label-pembelian">Sampai tanggal</label>
        <input class="input-pembelian" type="date" name="tgl_selesai" required>
    </div>
    <div class="tombol-pembelian">
        <button type="submit" class="btn-tambahpembelian" style="margin-top: -10%; margin-left: 80%; height: 40px;"> Cetak </button>
    </div>
</form>


<div class="pagination" style="margin-left: 38px; margin-top: 13%;">
    <?php for ($i = 1; $i <= $pages; $i++) { ?>
        <a href="?hal=laporan_penjualan&halaman=<?php echo $i ?>" style="text-decoration: none; margin-right: 7px;"><?php echo $i ?></a>

    <?php } ?>
</div>
<form class="tabelstok" method="POST" action="">
    <p class="judul-tabelstok">Data Penjualan Produk</p>
</form>

<table class="table" style="width: 93%; margin-top: 5.4%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php
//if(isset($_POST['filter'])){
  //  $mulai=$_POST['tgl_mulai'];
   // $selesai = $_POST['tgl_selesai'];
   // if($mulai!=null || $selesai!=null){
       // $query2 = mysqli_query($con, "SELECT * FROM detail_transaksi INNER JOIN produk ON detail_transaksi.id_produk=produk.id_produk 
       // INNER JOIN transaksi ON detail_transaksi.id_transaksi=transaksi.id_transaksi WHERE tgl_transaksi BETWEEN '$mulai' AND '$selesai' ORDER BY transaksi.tgl_transaksi DESC LIMIT $start, $perPage");
   // }else{
        $query2 = mysqli_query($con, "SELECT * FROM detail_transaksi INNER JOIN produk ON detail_transaksi.id_produk=produk.id_produk 
        INNER JOIN transaksi ON detail_transaksi.id_transaksi=transaksi.id_transaksi ORDER BY transaksi.tgl_transaksi DESC LIMIT $start, $perPage"); 
   // }
//}
        $no = 0;
        while ($data = mysqli_fetch_assoc($query2)) {
            $no++;
        ?>
            <tr>
                <td style="text-align: center;"><?= $no ?></td>
                <td><?= $data['nama_produk'] ?></td>
                <td>Rp. <?= number_format($data['harga']) ?></td>
                <td style="text-align: center;"><?= $data['jumlah'] ?></td>
                <td style="text-align: center;"><?= $data['tgl_transaksi'] ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

