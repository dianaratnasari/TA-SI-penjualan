<?php
if (!defined('INDEX')) die("");

$query = mysqli_query($con, "SELECT * FROM kategori WHERE id_kategori='$_GET[id_kategori]'");
$data = mysqli_fetch_array($query);
?>

<h2 class="judul">Edit Kategori</h2>
<hr style="margin: 3px 40px 40px 40px;">
<form method="post" action="?hal=kategori_update">
    <input type="hidden" name="id_kategori" value="<?= $data['id_kategori'] ?>">

    <div class="form-group">
        <label for="nama_kategori">Nama</label>
        <div class="input">
            <input type="text" id="nama_kategori" name="nama_kategori" value="<?= $data['nama_kategori'] ?>">
        </div>
    </div>
    <div class="form-group">
        <input type="submit" value="Simpan" class="tombol_simpan" style="width: 130px;">
    </div>
</form>