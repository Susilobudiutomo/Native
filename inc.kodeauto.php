<?php
function kdauto($tabel, $inisial, $k) {
	$struktur = mysqli_query("SELECT * FROM $tabel");
	$field = mysqli_fetch_field_direct($struktur,0)->name;
	$panjang = mysqli_fetch_field_direct($struktur,0)->length;

	$qry = mysqli_query($k, "SELECT max(".$field.") FROM ".$tabel);
	$row = mysqli_fetch_array($qry);
	if ($row[0]=="") {
		$angka=0;
	}
	else {
		$angka = substr($row[0], strlen($inisial));
	}
	
	$angka++;
	$angka =strval($angka);
	$tmp ="";
	for ($i=1; $i <= ($panjang-strlen($inisial)-strlen($angka)); $i++) {
			$tmp=$tmp."0";
	}
	return $inisial.$tmp.$angka;
}
?>
	