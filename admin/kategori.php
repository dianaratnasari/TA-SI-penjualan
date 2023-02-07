<?php
if (!defined('INDEX')) die("");
?>

<p class="nama_tabelkategori">Tambah Kategori Produk</p>
<form class="form-tambahkategori" method="POST" action="?hal=kategori_insert">
    <div class="kategori">
        <label class="label-kategori">Nama Kategori</label>
        <input class="input-kategori" type="text" name="nama_kategori" required>
    </div>
    <div class="tombol-kategori">
        <button class="btn-tambahkategori" style="width: 110px; margin-left: 77%; margin-top: -40px;" name="tambah_pembelian"> Tambah </button>
    </div>
</form>


<form class="tabelkategori" style="width: 55%; margin-top: 13%;" method="POST" action="">
    <p class="judul-tabelkategori">Kategori Produk</p>

    <form class=" searchkategori" method="POST" action="">
        <label class="label_searchkategori" style="position: absolute; margin-left: 60%;">Search</label>
        <input class="carikategori" style="width: 25%;  position: absolute; margin-left: 69%;" type="text" name="keyword" placeholder="Cari kategori" value="<?php if (isset($_POST['keyword'])) {
                                                                                                                                                                    echo $_POST['keyword'];
                                                                                                                                                                } ?>">
    </form>

</form>



<table class="table" style="margin-top: 20%; margin-left: 38px; width: 68.8%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_POST['keyword'])) {
            $keyword = addslashes($_POST['keyword']);

            $query = mysqli_query($con, "SELECT * FROM kategori WHERE nama_kategori like '%" . $keyword . "%'");
        } else {
            $query = mysqli_query($con, "SELECT * FROM kategori ORDER BY id_kategori ASC");
        }

        $no = 0;
        while ($data = mysqli_fetch_array($query)) {
            $no++;
        ?>
            <tr>
                <td style="text-align: center;"><?= $no ?></td>
                <td><?= $data['nama_kategori'] ?></td>
                <td style="text-align: center;">
                    <a class="tombol_edit" href="?hal=kategori_edit&id_kategori=<?= $data['id_kategori'] ?>"> Edit </a>
                    <a class="tombol_hapus" href="?hal=kategori_hapus&id_kategori=<?= $data['id_kategori'] ?>"> Hapus </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>