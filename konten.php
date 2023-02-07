
<?php
if (!defined('INDEX')) die("");

$halaman = array(
    "dashboard","pembelian", "pembelian_tambah", "pembelian_insert","pembelian_hapus",
    "produk", "produk_tambah",  "produk_insert", "kategori", "kategori_tambah",
    "kategori_insert", "kategori_edit", "kategori_update", "kategori_hapus", "transaksi", "detail_transaksi","transaksi_act","transaksi_hapus",
      "transaksi_reset", "penjualan", "penjualan_detail", "laporan_penjualan", "cetak_laporanpenjualan","pengguna", "pengguna_tambah",
       "pengguna_insert", "pengguna_edit", "pengguna_update"
);

if (isset($_GET['hal'])) $hal = $_GET['hal'];
else $hal = "dashboard";

foreach ($halaman as $h) {
    if ($hal == $h) {
        include "admin/$h.php";
        break;
    }
}
?>