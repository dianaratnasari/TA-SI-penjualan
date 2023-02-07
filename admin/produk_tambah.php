<?php
if (!defined('INDEX')) die("");
?>

<h2 class="judul">Tambah Produk</h2>
<hr style="margin: 3px 40px 40px 40px;">
<form class="inputan" method="post" action="?hal=produk_insert">
    <div class=" form-group">
        <label for="nama_produk">Nama Produk</label>
        <div class="input"><input type="text" id="nama_produk" name="nama_produk" required></div>
    </div>
    <div class="form-group">
        <label for="harga">Harga</label>
        <div class="input"><input type="number" min="0" id="harga" name="harga" style="width: 400px;" required></div>
    </div>
    <div class=" form-group">
        <label for="id_kategori">Kategori</label>
        <div class="input">
            <select id="id_kategori" name="id_kategori" style="width: 400px; height: 40px; outline: none; height:40px;  border: 1px solid  rgb(146, 142, 142);" required>
                <option value="" required> -Pilih Kategori-</option>
                <?php
                $querykategori = mysqli_query($con, "SELECT * FROM kategori");
                while ($j = mysqli_fetch_array($querykategori)) {
                    echo "<option value='$j[id_kategori]'>$j[nama_kategori]</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class=" form-group">
        <input type="submit" value="Simpan" class="tombol_simpan">
        <input type="reset" value="Reset" class="tombol_reset">
    </div>
</form>