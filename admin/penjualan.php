<?php
if (!defined('INDEX')) die("");

$perPage = 15; //per halaman
$page = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
$query2 = mysqli_query($con, "SELECT * FROM transaksi ORDER BY tgl_transaksi DESC LIMIT $start, $perPage");
$query = mysqli_query($con, "SELECT * FROM transaksi ORDER BY tgl_transaksi DESC");
$total = mysqli_num_rows($query);
$pages = ceil($total / $perPage);

?>
<p class="nama_tabelpembelian" style="margin-left: 38px; width: 34.5%;">Filter Data Penjualan</p>
<form class="form-tambahpembelian" style="height: 22%;  width: 34.5%; margin-left: 38px; margin-top: 60px; margin-bottom: 15px;" method="POST" action="" > 
    <div class="pembelian">
        <label class="label-pembelian">Dari tanggal</label>
        <input class="input-pembelian" type="date" name="tgl_mulai" required>
    </div>
    <div class="pembelian">
        <label class="label-pembelian">Sampai tanggal</label>
        <input class="input-pembelian" type="date" name="tgl_selesai" required>
    </div>
    <div class="tombol-pembelian">
        <button type="submit" name="filter" class="btn-tambahpembelian"  style="margin-top: 3%; width: 110px; height: 35px; letter-spacing: 1px; margin-left: 37%; "> Filter </button>
    </div>
</form>


<p class="nama_tabelpembelian" style="margin-left: 42.8%; width: 34.5%;">Cetak Laporan  Penjualan Produk</p>
<form class="form-tambahpembelian" style="height: 22%;  width: 34.5%; margin-left: 42.8%; margin-top: 60px; margin-bottom: 15px;" method="POST" action="admin/cetak_laporanpenjualan.php" > 
    <div class="pembelian">
        <label class="label-pembelian">Dari tanggal</label>
        <input class="input-pembelian" type="date" name="tgl_mulai" required>
    </div>
    <div class="pembelian">
        <label class="label-pembelian">Sampai tanggal</label>
        <input class="input-pembelian" type="date" name="tgl_selesai" required>
    </div>
    <div class="tombol-pembelian">
        <button type="submit" class="tombol_tambah" style="margin-top: 3%; padding: 6px 80px; padding-left: 35px; margin-left: 37%; border: none; box-shadow: none; "> Cetak </button>
    </div>
</form>



<div class="pagination" style="margin-left: 38px; margin-top: 20%;">
    <?php for ($i = 1; $i <= $pages; $i++) { ?>
        <a href="?hal=penjualan&halaman=<?php echo $i ?>" style="text-decoration: none; margin-right: 7px;"><?php echo $i ?></a>

    <?php } ?>
</div>
<form class="tabelpembelian" style="margin-top: 15px;" method="POST" action="">
    <p class="judul-tabelstok">Data Penjualan Produk</p>
</form>

<table class="table" style="width: 93.1%; margin-top: 5.5%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Total Transaksi</th>
            <th>Bayar</th>
            <th>Kembalian</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(isset($_POST['filter'])){
                $mulai=$_POST['tgl_mulai'];
                $selesai = $_POST['tgl_selesai'];
                if($mulai!=null || $selesai!=null){

                    if($selesai>= $mulai){
                        $query2 = mysqli_query($con, "SELECT * FROM transaksi WHERE tgl_transaksi BETWEEN '$mulai' AND '$selesai'  ORDER BY id_transaksi DESC LIMIT $start, $perPage");
                    }else{
                   echo'
                    
                   <script>
                   alert("Gagal");
                   window.location.href="?hal=penjualan";
                   </script>
                ';
                    }
                  //  echo"
                    
                   // <script>
                   // alert('$mulai, $selesai');
                   // window.location.href='?hal=penjualan';
                   // </script>
                    //";
                    
                   
                
                //}else{
                 //   $query2 = mysqli_query($con, "SELECT * FROM transaksi ORDER BY id_transaksi DESC LIMIT $start, $perPage");
               }
            }

        $no = 0;
        while ($data = mysqli_fetch_assoc($query2)) {
            $no++;
        ?>
            <tr>
                <td style="text-align: center;"><?= $no ?></td>
                <td style="text-align: center;"><?= $data['tgl_transaksi'] ?></td>
                <td>Rp.<?= number_format($data['total_transaksi']) ?></td>
                <td>Rp.<?= number_format($data['bayar']) ?></td>
                <td>Rp.<?= number_format($data['kembalian']) ?></td>
                <td style="text-align: center;">
					<a class="tombol_edit" style="padding: 10px 25px;" href="admin/cetak_detailpenjualan.php?id_transaksi=<?= $data['id_transaksi'] ?>">Detail</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>