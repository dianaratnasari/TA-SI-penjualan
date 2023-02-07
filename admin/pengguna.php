<?php
if (!defined('INDEX')) die("");
?>


<a class="tombol_tambah" style="margin-top: 25px;" href="?hal=pengguna_tambah">Tambah</a>
<form class="tabelkategori" style="width: 48%; margin-top: 1.5%;" method="POST" action="">
    <p class="judul-tabelkategori" style="width: 60%;">Data Pengguna</p>

</form>
<table class="table" style="width: 60%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Username</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        
            $query = mysqli_query($con, "SELECT * FROM pengguna ORDER BY id_pengguna DESC");
        
        $no = 0;
        while ($data = mysqli_fetch_array($query)) {
            $no++;
        ?>
            <tr>
                <td style="text-align: center;"><?= $no ?></td>
                <td><?= $data['nama'] ?></td>
                <td><?= $data['username'] ?></td>
                <td style="text-align: center;">
                    <a class="tombol_edit" style="padding: 10px 25px;" href="?hal=pengguna_edit&id_pengguna=<?= $data['id_pengguna'] ?>"> Edit </a>
                </td>
            </tr>
        <?php
        }
        ?>



    </tbody>
</table>