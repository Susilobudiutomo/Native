<?php
$my['host']	= "localhost";
$my['user']	= "root";
$my['pass']	= "";
$my['dbs']	= "padiberseri";

$koneksi= mysqli_connect($my['host'], $my['user'], $my['pass']);
if (! $koneksi) {
  echo "Gagal koneksi ..!";
  mysqli_error();
}
mysqli_select_db($koneksi, $my['dbs'])
	 or die ("Database tidak ditemukan".mysqli_error());

?>