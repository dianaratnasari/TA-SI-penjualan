<?php
if (!defined('INDEX')) die("");
?>

<h2 class="judul">Tambah Pengguna</h2>
<hr style="margin: 3px 40px 40px 40px;">
<form class="inputan" method="post" action="?hal=pengguna_insert">
    <div class=" form-group">
        <label for="nama">Nama Pengguna</label>
        <div class="input"><input type="text" id="nama" name="nama" required></div>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <div class="input"><input type="text" id="username" name="username" required></div>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <div class="input"><input type="password" id="password" name="password" required></div>
    </div>

    <div class=" form-group">
        <input type="submit" value="Simpan" class="tombol_simpan">
        <input type="reset" value="Reset" class="tombol_reset">
    </div>
</form>