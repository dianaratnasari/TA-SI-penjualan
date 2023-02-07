<?php
if (!defined('INDEX')) die("");


$perPage = 15; //per halaman
$page = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
$query2 = mysqli_query($con, "SELECT * FROM pembelian_produk INNER JOIN produk ON pembelian_produk.id_produk=produk.id_produk ORDER BY tanggal_pembelian DESC LIMIT $start, $perPage");
$query = mysqli_query($con, "SELECT * FROM pembelian_produk ORDER BY tanggal_pembelian DESC");
$total = mysqli_num_rows($query);
$pages = ceil($total / $perPage);
?>


<p class="nama_tabelpembelian">Tambah Data Pembelian Produk</p>
<form class="form-tambahpembelian" method="POST" action="?hal=pembelian_insert">
    <div class="pembelian">
        <label class="label-pembelian" for=" id_produk">Pilih Produk</label>
        <div class="i">
            <select id="id_produk" name="id_produk" required>
                <option value="" required> --------------Pilih Produk--------------</option>
                <?php
                $querypembelian = mysqli_query($con, "SELECT * FROM produk");
                while ($j = mysqli_fetch_array($querypembelian)) {
                    echo "<option value='$j[id_produk]'>$j[nama_produk]</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="pembelian">
        <label class="label-pembelian">Jumlah</label>
        <input class="input-pembelian" type="number" min="0" name="jumlah" required>
    </div>
    <div class="pembelian">
        <label class="label-pembelian">Tanggal</label>
        <input class="input-pembelian" type="date" name="tanggal_pembelian" required>
    </div>
    <div class="tombol-pembelian">
        <button class="btn-tambahpembelian" name="tambah_pembelian"> Tambah </button>
        <input type="reset" value="Reset" class="btn-resetpembelian">

    </div>
</form>
<p class="nama_tabelpembelian" style="margin-left: 45%; width: 31.5%;">Cetak Laporan  Pembelian Produk</p>
<form class="form-tambahpembelian" style="height: 22%;  width: 31.5%; margin-left: 45%; margin-top: 60px; margin-bottom: 15px;" method="POST" action="admin/cetak_laporanpembelian.php" > 
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

<div class="pagination" style="margin-left: 38px; margin-top: 21%;">
    <?php for ($i = 1; $i <= $pages; $i++) { ?>
        <a href="?hal=pembelian&halaman=<?php echo $i ?>" style="text-decoration: none; margin-right: 7px;"><?php echo $i ?></a>

    <?php } ?>
</div>

<form class="tabelpembelian" method="POST" action="">
    <p class="judul-tabelpembelian">Data Pembelian Produk</p>

    <form class="searchpembelian" method="POST" action="">
        <label class="label_searchpembelian">Search</label>
        <input class="caripembelian" type="text" name="keyword" placeholder="Cari produk" value="<?php if (isset($_POST['keyword'])) {
                                                                                                        echo $_POST['keyword'];
                                                                                                    } ?>">
    </form>

</form>

<table class="table" style="margin-top: 5%; margin-left: 38px; width: 93.1%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_POST['keyword'])) {
            $keyword = addslashes($_POST['keyword']);

            $query = mysqli_query($con, "SELECT * FROM pembelian_produk INNER JOIN produk ON pembelian_produk.id_produk=produk.id_produk
              WHERE nama_produk like '%" . $keyword . "%'   ORDER BY pembelian_produk.tanggal_pembelian  DESC LIMIT $start, $perPage" );
        } else {
            $query = mysqli_query($con, "SELECT * FROM pembelian_produk INNER JOIN produk ON pembelian_produk.id_produk=produk.id_produk
                                     ORDER BY pembelian_produk.tanggal_pembelian DESC LIMIT $start, $perPage");
        }
        $no = 0;
        while ($data = mysqli_fetch_array($query)) {
            $no++;
        ?>
            <tr>
                <td style="text-align: center;"><?= $no ?></td>
                <td><?= $data['nama_produk'] ?></td>
                <td>Rp. <?= number_format($data['harga']) ?></td>
                <td style="text-align: center;"><?= $data['tanggal_pembelian'] ?></td>
                <td style="text-align: center;"><?= $data['jumlah'] ?></td>
                <td style="text-align: center;">
                    <a class="tombol_hapus" href="?hal=pembelian_hapus&id_pembelian=<?= $data['id_pembelian'] ?>"> Hapus </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>