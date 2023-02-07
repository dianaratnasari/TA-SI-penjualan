<?php
if (!defined('INDEX')) die("");
$perPage = 15; //per halaman
$page = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
$query2 = mysqli_query($con, "SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori ORDER BY produk.id_produk ASC LIMIT $start, $perPage");
$query = mysqli_query($con, "SELECT * FROM  produk");
$total = mysqli_num_rows($query);
$pages = ceil($total / $perPage);

?>

<a class="tombol_tambah" style="box-shadow: 4px 4px 4px #010642;" href="?hal=produk_tambah">Tambah</a>
<a class="tombol_cetaklaporan" style="margin-left: 37px; background-color: #389e38; margin-top: 31px; border-radius: 4px; fint-size: 24px; box-shadow: 4px 4px 4px #251b2e;" href="admin/cetak_laporanproduk.php">Cetak Laporan Stok Produk</a>
<a class="tombol_cetaklaporan" style="margin-left: 37px; margin-top: 30px; box-shadow: 4px 4px 4px #251b2e;" href="admin/cetak_stoklimit.php">Cetak Laporan Stok Limit</a>

<div class="pagination" style="margin-left: 38px; margin-top: 2%;">
    <?php for ($i = 1; $i <= $pages; $i++) { ?>
        <a href="?hal=produk&halaman=<?php echo $i ?>" style="text-decoration: none; margin-right: 7px;"><?php echo $i ?></a>

    <?php } ?>
</div>

<form class="tabelstok" method="POST" action="">
    <p class="judul-tabelstok">Stok Produk</p>

    <form class="searchstok" method="POST" action="">
        <label class="label_searchstok">Search</label>
        <input class="caristok" type="text" name="keyword" placeholder="Cari produk" value="<?php if (isset($_POST['keyword'])) {
                                                                                                echo $_POST['keyword'];
                                                                                            } ?>">
    </form>

</form>


<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Kategori</th>
			 <th>Stok</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];

            $query = mysqli_query($con, "SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori
                WHERE nama_produk like '%" . $keyword . "%' OR nama_kategori like '%" . $keyword . "%' LIMIT $start, $perPage");
        } else {
            $query = mysqli_query($con, "SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori 
                                        ORDER BY produk.id_produk ASC LIMIT $start, $perPage");
        }
        $no = 0;
        while ($data = mysqli_fetch_array($query)) {
            $no++;
        ?>
            <tr>
                <td style="text-align: center;"><?= $no ?></td>
                <td><?= $data['nama_produk'] ?></td>
                <td>Rp. <?= number_format($data['harga']) ?></td>
                <td><?= $data['nama_kategori'] ?></td>
				<td style="text-align: center;"><?= $data['stok'] ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>