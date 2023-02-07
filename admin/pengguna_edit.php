<?php
if (!defined('INDEX')) die("");

$query = mysqli_query($con, "SELECT * FROM pengguna WHERE id_pengguna='$_GET[id_pengguna]'");
$data = mysqli_fetch_array($query);
?>

<h2 class="judul">Edit Pengguna</h2>
<hr style="margin: 3px 40px 40px 40px;">
<form method="post" action="?hal=pengguna_update">
    <input type="hidden" name="id_pengguna" value="<?= $data['id_pengguna'] ?>">

    <div class="form-group">
        <label for="nama">Nama Pengguna</label>
        <div class="input">
            <input type="text" id="nama" name="nama" value="<?= $data['nama'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <div class="input">
            <input type="text" id="username" name="username" value="<?= $data['username'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <div class="input"><input type="password" id="password" name="password" value="<?= $data['password'] ?>"></div>
    </div>

    <div class="form-group">
        <input type="submit" value="Simpan" class="tombol_simpan">
        <input type="reset" value="Reset" class="tombol_reset">
    </div>
</form>