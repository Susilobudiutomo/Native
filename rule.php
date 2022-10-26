<?php include('inc.session.php'); ?>
<?php include('../conf/inc.koneksi.php'); ?>
<?php include('atas.php'); ?>
<?php if(isset($_GET['entri'])){ ?>


<div class="panel panel-default">
  
  <div class="panel-heading">
              <h3 class="panel-title"><span class="glyphicon glyphicon-plus"></span> Tambah Data Aturan</h3>
            </div>
			
<div class="panel-body">



<form class="form-horizontal" name="form1" method="post" >


<div class="form-group">
                    <label class="col-sm-2 control-label">Daftar Penyakit</label>
                    <div class="col-sm-5">
					<select class="form-control" name="CmbSolusi" >
	<option value=0> Nama Penyakit </option>
	<?php
	$sqlp = "SELECT * FROM solusi ORDER BY kd_solusi";
	$qryp = mysqli_query($koneksi, $sqlp)
		or die ("SQL Error: ".mysqli_error());
	while ($datap=mysqli_fetch_array($qryp)) {
	echo "<option value=$datap[kd_solusi]>$datap[nm_solusi]</option>";
	}
	?>
	</select>
					</div>
		</div>
		
		
		<div class="form-group">
                    <label class="col-sm-2 control-label">Daftar Gejala</label>
                    <div class="col-sm-10">
					
<?php
$sql = "SELECT * FROM gejala ORDER BY kd_gejala";
$qry = mysqli_query($koneksi, $sql)
	or die ("SQL Error: ".mysqli_error());
	$no=1;
while ($data=mysqli_fetch_array($qry)) {
	$sqlr = "SELECT * FROM rule ";
	$sqlr .= "WHERE kd_solusi='$datap[kd_solusi]' ";
	$sqlr .= "AND kd_gejala='$data[kd_gejala]'";
	$qryr = mysqli_query($koneksi, $sqlr);
	$cocok= mysqli_num_rows($qryr);
	// Kode untuk nilai gejala terpilih dan
	// Kode untuk memberi warna pada nilai terpilih
	if ($cocok==1) {
		$cek = "checked";
		$bg = "#CCFF00";
	}
	else {
		$cek = "";
		$bg = "#FFFFFF";
	}
?>
<table>
<tr bgcolor="#FFFFFF">
	<td width="20" style="padding:8px;" bgcolor="<?php echo $bg; ?>">
	<input name="CekGejala[]" type="checkbox" value="<?php echo $data['kd_gejala']; ?>" <?php echo $cek; ?>>
	</td>
	<td width="469">( <?php echo $data['kd_gejala']; ?> ) <?php echo $data['nm_gejala']; ?></td>
</tr>
<?php
	$no++;
	}
?>
</table>

					</div>
		</div>

<div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                <button name="simpan" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Simpan</button>
				<a href="?data" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Kembali</a>
                </div> 
		</div>
</form>
</div>
</div>

<?php 
if (isset($_POST['simpan'])) {

$TxtKodeH = $_REQUEST['TxtKodeH'];
$CekGejala = $_REQUEST['CekGejala'];

# Validasi Form
$TxtKodeH=$_POST['CmbSolusi'];
	$jum = count($CekGejala);
	if ($jum==0) {
		echo "Gejala Belum Dipilih";
	}
	else {
		# UNTUK MENGHAPUS YANG TIDAK DIPILIH LAGI
			// Kode untuk mendata rule
			$sqlpil = "SELECT * FROM rule WHERE kd_solusi='$TxtKodeH'";
			$qrypil = mysqli_query($koneksi, $sqlpil);
			while ($datapil=mysqli_fetch_array($qrypil)){
			// Kode untuk mengurai Gejala yang dipilih
				for ($i = 0; $i < $jum; ++$i) {
			// Perintah untuk menghapus rule
				if ($datapil['kd_gejala'] != $CekGejala[$i]) {
					$sqldel = "DELETE FROM rule ";
					$sqldel .= "WHERE kd_solusi='$TxtKodeH' ";
					$sqldel .= "AND NOT kd_gejala IN ('$CekGejala[$i]')";
					mysqli_query($koneksi, $sqldel);
				}
			}
		}
		
		# UNTUK DATA GEJALA TAMBAHAN
		for ($i = 0; $i < $jum; ++$i) {
			// Perintah untuk mendapat rule
			$sqlr = "SELECT * FROM rule ";
			$sqlr .= "WHERE kd_solusi='$TxtKodeH' ";
			$sqlr .= "AND kd_gejala='$CekGejala[$i]'";
			$qryr = mysqli_query($koneksi, $sqlr);
			$cocok = mysqli_num_rows($qryr);
				// Gejala yang baru akan disimpan
			if (! $cocok==1) {
			
			$sql = "INSERT INTO rule (kd_solusi,kd_gejala) ";
			$sql .= "VALUES ('$TxtKodeH','$CekGejala[$i]')";
			mysqli_query($koneksi, $sql)
				or die ("SQL Input rule Gagal".mysqli_error());
			}
		}
			// Pesan sebagai konfirmasi
		echo'<script type="text/javascript">
			alert("Data Aturan Berhasil Disimpan");
			window.location="?data"
		</script>';
	
	}

}
 ?>

<?php }?>

<?php if(isset($_GET['data'])){ ?>

<h2><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Data Aturan <a class="btn btn-success btn-sm add" href="rule.php?entri"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data</a></h2>
<hr>


<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="example">
	<thead>
		<tr>
			<th style="text-align:center;">No</th>
			<th style="text-align:center;">Kode Penyakit</th>
			<th style="text-align:center;">Kode Gejala</th>
			<th style="text-align:center;">Aksi</th>
		</tr>
	</thead>
	<tbody>
<?php
	$sql="select * from rule order by kd_solusi";
	$rs=mysqli_query($koneksi, $sql); $no=1;
	while($row=mysqli_fetch_array($rs)){	 ?>
		<tr class="odd gradeX">
			<td style="text-align:center;" width="50"><?php echo $no; ?></td>
			<td><?php echo $row['kd_solusi']; ?></td>
			<td><?php echo $row['kd_gejala']; ?></td>
			<td style="text-align:center;" width="80">
				<a title="Hapus Data" href="?hapus&id=<?php echo $row[0]; ?>" onclick="return confirm('Yakin Mau Hapus ?');" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> </a>
			</td>
		</tr>
<?php $no++; } ?>
	</tbody>
</table>
<?php } ?>


<?php
	if(isset($_GET['hapus'])){
		$id=$_GET['id'];
		$sql="delete from rule where kd_solusi='$id'";
		mysqli_query($koneksi, $sql);
		echo '<script type="text/javascript">
			//<![CDATA[
			window.location="?data"
			//]]>
		</script>';
	}
?>
<?php include('bawah.php'); ?>