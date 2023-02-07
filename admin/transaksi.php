<?php

if (!defined('INDEX')) die("");


?>
<h4 style="margin-top: 15px; float:right; margin-right: 35px;">
    <?php
    $tanggal = mktime(date("m"), date("d"), date("Y"));
    echo "Tanggal : " . date("d-M-Y", $tanggal) . " ";
    date_default_timezone_set('Asia/Jakarta');
    $jam = date("H:i:s");
    echo "| Pukul : " . $jam . " " . "";
    ?>
</h4>



<form class="transaksi" style="height: 48%;" method="post" action="">
    <h3>Tambah Transaksi</h3>
    <div class="form-transaksi">
        <label for="id_produk">Nama Produk</label>
        <div class="input_transaksi">
            <select name="id_produk">
                <option value=""> -Pilih Produk-</option>
                <?php
                $queryproduk = mysqli_query($con, "SELECT * FROM produk");
                while ($j = mysqli_fetch_array($queryproduk)) {
                    echo "<option value='$j[id_produk]'>$j[nama_produk]</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-transaksi">
        <label for="jumlah">Jumlah Transaksi</label>
        <div class="input_transaksi"><input type="number" min="0" id="jumlah" name="jumlah" required></div>
    </div>
    <div class=" form-transaksi">
        <button type="submit" class="tombol_tambahtransaksi">Tambah</button>
    </div>
</form>



<div class="tbl">
    <table class="tabel_penjualan" style="width: 52.3%; margin-left: 25%; margin-top: 14.1%;">
        <thead>
            <tr>
                <th style="width: 15px;">No</th>
                <th>Nama barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subharga</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <?php
           
              if(isset($_POST['id_produk'])){
                $id_produk = $_POST['id_produk'];
                $jumlah = $_POST['jumlah'];
                $query = mysqli_query($con, "SELECT * FROM produk WHERE id_produk = '$id_produk' ");
                $row = mysqli_fetch_assoc($query);
                $stoksekarang = $row['stok'];
             
               
                //echo var_dump($row);
                // return false;
                
                foreach ($_SESSION['cart'] as $key => $value){
                    $produkada=$value['id'];
                    $produk=$value['nama_produk'];
                   if($produkada === $id_produk){
                    echo'
                    <script>
                    alert("Produk Sudah ada.");
                    window.location.href="?hal=transaksi";
                    </script>
                    ';
                   die();
                   }
                }
                    if($stoksekarang >= $jumlah){
            
                        $produk = [
                            'id' => $row['id_produk'],
                            'nama_produk' => $row['nama_produk'],
                            'harga' => $row['harga'],
                            'jumlah' => $jumlah
                        ];
                        $_SESSION['cart'][] = $produk;
                       
                    }else{
                        echo'
                        <script>
                        alert("Stok Tidak Mencukupi.");
                        window.location.href="?hal=transaksi";
                        </script>
                        ';
                    } 
                    echo "<meta http-equiv='refresh' content='0; url=?hal=detail_transaksi'>";
                }else{
                    $_SESSION['cart']=[]; ?>
                     <th colspan="7" style="background: white; text-align:left; padding-left:20px; font-size: 14px;">Tidak ada produk yang dipilih.</th>
          <?php      } 
               
            
            
                
            
                  // echo "<pre>";
                  // var_dump($produk);
                   //echo"</pre>"

               

        ?>
        <tbody>
            <?php $no = 1; ?>
            <?php $total = 0;  ?>
            <?php foreach ($_SESSION['cart'] as $key => $value) : ?>

                <?php $subharga = $value['harga'] * $value['jumlah'];
                ?>
                <tr>
                    <td style=" width: 15px; text-align:center;"><?php echo $no; ?></td>
                    <td><?= $value['nama_produk'] ?></td>
                    <td>Rp. <?= number_format($value['harga']) ?></td>
                    <td style="text-align:center;"><?= $value['jumlah'] ?></td>
                    <td>Rp. <?= number_format($subharga) ?></td>
                    <td style="text-align:center;">
                        <a class="tombol_delete" name="hapus" href="?hal=transaksi_hapus&id=<?= $value['id'] ?>"> Hapus </a>
                    </td>
                </tr>
                <?php $no++; ?>
                <?php $total += $subharga;?>
            <?php endforeach ?>
        </tbody>

        <tfoot>
            <div style="display: flex; justify-content: flex-start; margin-left: 88%; font-size: 30px;">
                <input readonly name="total" id="total" style=" position: absolute; width: 24%; height:10%; padding-left: 10px; outline: none; border: none; font-weight: bold; font-size: 35px; margin-top: 70px; z-index: 2;" value="Rp. <?php echo number_format($total); ?>">
            </div>
        </tfoot>
    </table>
</div>

<form class="form-pembayarantransaksi" method="POST" action="?hal=transaksi_act">
    <input type="hidden" name="total" value="<?= $total ?>">
    <div class=" bayartransaksi">
        <label class="label-bayar">Bayar</label>
        <input class="input-bayar" type="number" min="0"  name="bayar" id="bayar" required> 
    </div>
    <div class="tombol">
        <button class="tombol_cetak">Bayar</button>
        <a class="tombol_resettransaksi" href="?hal=transaksi_reset"> Reset </a>
    </div>
</form>


