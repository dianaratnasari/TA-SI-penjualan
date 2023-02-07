<?php
session_start();
ob_start();

include "../library/connection.php";

//cek apakah sesuai status sudah login? kalau belum akan kembali ke form login
if ($_SESSION['status'] != "sudah_login") {
    //melakukan pengalihan
    header("location:login.php");
}

$mulai=$_POST['tgl_mulai'];
$selesai = $_POST['tgl_selesai'];


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
            border-top: 1px solid #333333;
            border-bottom: 1px solid #333333;
            background: rgb(175, 210, 211);
        }

        td {
            border-bottom: 1px #999999;
        }

        tfoot td {
            border-bottom-width: 0px;
            border-top: 0px solid #333333;
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

        <table width="800" cellspacing="0">
		<tbody>
		<tr>
		<td>
		<img src="../css/WPK.png" align="left" style="max-width: 90px;" hspace="50">
		</td>
		<td>
		<h2 style=" margin-left: -15%;">WARUNG PERENG KALIABANK</h2>
		<h3 style="margin-left: -9%; margin-top: -15px;"><?php echo "LAPORAN PENJUALAN PRODUK"; ?></h3>
		<h4 style="margin-left: -10%;">Periode : <?= $mulai ?> s.d. <?= $selesai ?> </h4>
		</td>
		</tr>
		</tbody>
		</table>

        <table style="margin-top: 15px;" border="1" id="dataTable" width="800" cellspacing="0">
       
       <thead>
           <tr>
               <th>No</th>
               <th>Nama Produk</th>
               <th>Harga</th>
               <th>Jumlah</th>
               <th>Tanggal</th>
           </tr>
       </thead>
       <tbody>
           <?php
   
           $no = 0;
              
                   $query2 = mysqli_query($con, "SELECT * FROM detail_transaksi INNER JOIN produk ON detail_transaksi.id_produk=produk.id_produk 
                   INNER JOIN transaksi ON detail_transaksi.id_transaksi=transaksi.id_transaksi WHERE tgl_transaksi BETWEEN '$mulai' AND '$selesai' ORDER BY transaksi.tgl_transaksi DESC");
              
               if(!$query2){
                   echo mysqli_error($con);
               }
         
           
               while ($data = mysqli_fetch_assoc($query2)) {
                   $no++;
           
           //$query = mysqli_query($con, "SELECT * FROM detail_transaksi INNER JOIN produk ON detail_transaksi.id_produk=produk.id_produk 
                   //INNER JOIN transaksi ON detail_transaksi.id_transaksi=transaksi.id_transaksi ORDER BY transaksi.tgl_transaksi DESC");
          
           ?>
            <tr>
              <td style="text-align: center;"><?= $no ?></td>
            <td><?= $data['nama_produk'] ?></td>
           <td>Rp. <?= number_format($data['harga']) ?></td>
            <td style="text-align: center;"><?= $data['jumlah'] ?></td>
            <td style="text-align: center;"><?= $data['tgl_transaksi'] ?></td>
            </tr>
           <?php
            }
            
           ?>
       </tbody>
   
   
               <?php         
           
               mysqli_close($con); // menutup koneksi ke database
               ?>
   
           </table>
             <?php
           $tanggal = mktime(date("m"), date("d"), date("Y"));
       date_default_timezone_set('Asia/Jakarta');?>
           <table width="800" cellspacing="0">
               <br /><br />
               <tbody>
                   <tr>
                       <td width="50%" class="text-left">
                           &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Semarang, <?php echo date("d-M-Y", $tanggal); ?>
                           <br /><br />
                           &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Pemilik
                           <br /><br /><br /><br /><br />
                           (______________________________)
                       </td>
                   </tr>
               </tbody>
           </table>
		  <?php
        $tanggal = mktime(date("m"), date("d"), date("Y"));
    date_default_timezone_set('Asia/Jakarta');?>
        <table width="800" cellspacing="0">
            <br /><br />
            <tbody>
                <tr>
                    <td width="50%" class="text-left">
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Semarang, <?php echo date("d-M-Y", $tanggal); ?>
                        <br /><br />
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Pemilik
                        <br /><br /><br /><br /><br />
                        (______________________________)
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
