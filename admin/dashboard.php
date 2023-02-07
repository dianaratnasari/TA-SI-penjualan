<?php
if (!defined('INDEX')) die("");
$query = mysqli_query($con,"SELECT * FROM produk");
$tproduk = mysqli_num_rows($query);

?>
<div class="kotak" style="width: 28%; height: 28%; background: purple; psition: absolute; margin-left: 25px; margin-top: 28px; border-radius: 4px; box-shadow: 4px 4px 4px rgba(0,0,0,0.8);"> 
<h2 style="font-size: 40px; font-weight: bold; color: white; margin-top: 3.5%; margin-left: 30px; position: absolute"><?= $tproduk ?> </h2>
    <p style="font-size: 30px; font-weight: bold; color: white; margin-top: 8%; margin-left: 30px; position: absolute"> Produk </p>
    <i class="fas fa-file-alt fa-7x" style="color: white; margin-top: 2.7%; margin-left: 14.5%; position: absolute; opacity: 0.4;"></i>
</div>

<div class="kotak" style="width: 28%; height: 28%; background: 	#483D8B; psition: absolute; margin-left: 35%; margin-top: -17.2%; border-radius: 4px; box-shadow: 4px 4px 4px rgba(0,0,0,0.8);"> 
<h2 style="font-size: 40px; font-weight: bold; color: white; margin-top: 3.5%;  margin-left: 30px; position: absolute"><?php
while($row= mysqli_fetch_array($query)){
    $stok[] = $row['stok'];
    $tstok = array_sum($stok);
}
echo "$tstok";?> </h2>
    <p style="font-size: 30px; font-weight: bold; color: white; margin-top: 8%; margin-left: 30px; position: absolute"> Total Stok </p>
    <i class="fas fa-boxes fa-6x" style="color: white; margin-top: 3%; margin-left: 13%; position: absolute; opacity: 0.4;"></i>
</div>

<div class="kotak" style="width: 30%; height: 28%; background: 	#2F4F4F; psition: absolute; margin-left: 67%; margin-top: -17.2%; border-radius: 4px; box-shadow: 4px 4px 4px rgba(0,0,0,0.8);"> 
<h2 style="font-size: 40px; font-weight: bold; color: white; margin-top: 2%;  margin-left: 30px; position: absolute"><?php
$query1 = mysqli_query($con,"SELECT * FROM detail_transaksi");
while($row= mysqli_fetch_array($query1)){
    $jumlahp[] = $row['jumlah'];
    $tpenjualan = array_sum($jumlahp);
}
echo "$tpenjualan";?> </h2>
    <p style="font-size: 30px; font-weight: bold; color: white; margin-top: 6.5%; margin-left: 30px; position: absolute"> Total <br> Penjualan </p>
    <i class="fas fa-file-invoice-dollar  fa-7x" style="color: white; margin-top: 2.7%; margin-left: 16%; position: absolute; opacity: 0.4;"></i>
</div>

