<?php
session_start();
ob_start();

include "../library/connection.php";

//cek apakah sesuai status sudah login? kalau belum akan kembali ke form login
if ($_SESSION['status'] != "sudah_login") {
    //melakukan pengalihan
    header("location:login.php");
}

$idtransaksi = $_GET['id_transaksi'];
$query = mysqli_query($con, "SELECT * FROM transaksi LEFT JOIN pengguna ON transaksi.id_pengguna = pengguna.id_pengguna WHERE id_transaksi ='$idtransaksi'");
$row=mysqli_fetch_assoc($query);

?>
<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <style type="text/css">
        body {
            font-family: verdana, arial, sans-serif;
            font-size: 12px;
        }

        th,
        td {
            padding: 4px 4px 4px 4px;
        }

        th {
            border-top: none;
            border-bottom: none;

        }

        td {
            border-bottom: none;
        }

        tfoot td {
            border-bottom-width: 0px;
            border-top: none;
            padding-top: 20px;
        }

        @media print {
            .noprint {
                display: none;
            }
        }

        @page {
            size: auto;
            /* auto is the initial value */
            margin: 0mm 3cm 0mm 3cm;
            /* this affects the margin in the printer settings */
        }


        td,
        th {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div align="center">
        <span class="noprint">
            <input class="noprint" type="button" value="Print" onclick="window.print()">
            <a class="noprint" href="../index.php?hal=penjualan">Kembali</a>

        </span>
        <br /><br />


        <form class="form-transaksibayar">
            <h2 class="nama-nota">WARUNG PERENG KALIABANK</h2>
            <h3 class="nama-nota" style=" margin-top: -15px; font-size: 16px;">KEBUMEN</h3>
            <h4 class="nama-nota" style="margin-top: -5px;"> Tanggal :
                <?= $row['tgl_transaksi']?>
            </h4>
            <p style="margin-top: -10px; margin-left: -15px;">=========================================</p><br>
            <h4 style="margin-top: -23px; margin-left: -290px;"> Admin : <?= $row['username'] ?> </h4>
            <p style="margin-top: -10px; margin-left: -15px;">=========================================</p>



            <table style="margin-top: 15px; " border="0" id="dataTable" width="400" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 30%; text-align: left;">Nama Produk</th>
                        <th>Harga</th>
                        <th>Jml</th>
                        <th>Subharga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $query2 = mysqli_query($con, "SELECT * FROM  detail_transaksi LEFT JOIN produk ON
            detail_transaksi.id_produk=produk.id_produk WHERE detail_transaksi.id_transaksi='$idtransaksi'");


                    while ($data = mysqli_fetch_assoc($query2)) {
                        $subharga = $data['harga'] * $data['jumlah'];
                    ?>
                        <tr>
                            <td><?= $data['nama_produk'] ?></td>
                            <td style="text-align: center;">Rp. <?= number_format($data['harga']) ?></td>
                            <td style="text-align: center;"><?= $data['jumlah'] ?></td>
                            <td style="text-align: center;">Rp. <?= number_format($subharga) ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <table style="margin-top: 20px;" border=" 0" id="dataTable" width="400" cellspacing="0">

                <tr>
                    <td style="width: 76%;">Total</td>
                    <td>Rp. <?= number_format($row['total_transaksi']) ?></td>
                </tr>
                <tr>
                    <td>Bayar </td>
                    <td>Rp. <?= number_format($row['bayar']) ?></td>
                </tr>
                <tr>
                    <td>Kembalian</td>
                    <td>Rp. <?= number_format($row['kembalian']) ?></td>
                </tr>

            </table>
            <table border=" 0" id="dataTable" width="400" cellspacing="0">

                <p style="margin-top: 10px; margin-left: -15px;">=========================================</p>
                <h3 style="margin-top: -5px; font-size: 16px; ">Terimakasih</h3>
                <h3 style="margin-top: -10px;">Atas Kunjungan Anda</h3>
            </table>

        </form>

</body>

</html>