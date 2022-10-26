<?php include('inc.session.php'); ?>
<?php include('../conf/inc.koneksi.php'); ?>
<?php include('atas.php'); ?>
<?php if(isset($_GET['data'])){ ?>

<h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Data User <a class=" " href="user.php?entri"><span class="" aria-hidden="true"></span></a></h2>
<hr>


<table class="table table-bordered table-hover table-striped">
<thead>
		<tr>
	<th style="text-align:center;">No</th>
	<th style="text-align:center;">Nama Lengkap</th>
	<th style="text-align:center;">Username</th>
	
</tr>
	</thead>
	
<?php $sql="select * from admin";
	$rs=mysqli_query($koneksi, $sql);
	$no=1; 
	while($row=mysqli_fetch_array($rs)){ ?>
<tr>
	<td align="center"><?php echo $no; ?></td>
	<td><?php echo $row['nmuser']; ?></td>
	<td><?php echo $row['nmlogin']; ?></td>
	<td align="center">
		<a title="Edit Data" class="" href="user.php?edit&id=<?php echo $row[0]; ?>"><span class=""></span> </a> 
		<a title="Hapus Data" href="user.php?delete&id=<?php echo $row[0]; ?>" onclick="return confirm('Yakin Mau Hapus ?');" class=""><span class=""></span> </a>
	</td>
</tr>
<?php	$no++; } ?>
</table>
<?php } ?>

<?php
	if(isset($_GET['delete'])){
		$id=$_GET['id'];
		$sql="delete from admin where id='$id'";
		mysqli_query($koneksi, $sql);
		echo '<script type="text/javascript">
			//<![CDATA[
			window.location="?data"
			//]]>
		</script>';
	}
?>

<?php if(isset($_GET['entri'])){ ?>


<div class="panel panel-default">
  
  <div class="panel-heading">
              <h3 class="panel-title"><span class="glyphicon glyphicon-plus"></span> Tambah Data User</h3>
            </div>
			
<div class="panel-body">

<form class="form-horizontal" method="post" action="">

<div class="form-group">
                    <label class="col-sm-2 control-label">Nama Lengkap</label>
                    <div class="col-sm-4">
					<input class="form-control" autofocus required type="text" name="nm" value="" />
					</div>
		</div>
		
		<div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-4">
					<input class="form-control" required type="text" name="nmlogin" value="" />
					</div>
		</div>
		
		<div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-4">
					<input class="form-control" required type="password" name="pslogin" value="" />
					</div>
		</div>
		
		<div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                <button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Simpan</button>
				<a href="?data" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Kembali</a>
                </div> 
		</div>	

</form>
</div>
</div>

<?php	if(isset($_POST['save'])){
		$nm=$_POST['nm'];
		$nmlogin=$_POST['nmlogin'];
		$pslogin=$_POST['pslogin'];
		$sql="insert into admin (id,nmuser,nmlogin,pslogin) values(0,'$nm','$nmlogin',md5('$pslogin'))";
		
		if (mysqli_query($koneksi, $sql)) {
		echo '<script type="text/javascript">
			//<![CDATA[
			alert("Data User Berhasil Disimpan");
			window.location="?data"
			//]]>
		</script>';
		} else {
			echo '<script type="text/javascript">
			//<![CDATA[
			alert("Data User Gagal Disimpan");
			window.location="?data"
			//]]>
		</script>';
		}

		}
?>
<?php } ?>

<?php if(isset($_GET['edit'])){ $sql="select * from admin where id='$_GET[id]'";
$rs=mysqli_query($koneksi, $sql);
$row=mysqli_fetch_array($rs);{
 ?>
 
 
<div class="panel panel-default">
  
  <div class="panel-heading">
              <h3 class="panel-title"><span class="glyphicon glyphicon-plus"></span> Tambah Data User</h3>
            </div>
			
<div class="panel-body">



<form class="form-horizontal" method="post" action="">

<div class="form-group">
                    <label class="col-sm-2 control-label">Nama Lengkap</label>
                    <div class="col-sm-4">
										
					<input class="form-control" type="text" name="nm" value="<?php echo $row[1]; ?>" />
					</div>
		</div>
		
		<div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-4">
					<input class="form-control" type="text" name="nmlogin" value="<?php echo $row[2]; ?>" />
					</div>
		</div>
		
		<div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-4">
					<input class="form-control" type="password" name="pslogin" value="" placeholder="Kosongkan Jika Tidak Diganti"/>
					</div>
		</div>
		
		<div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                <button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Simpan</button>
				<a href="?data" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Kembali</a>
                </div> 
		</div>	

</form>
</div>
</div>

<?php	 } if(isset($_POST['save'])){
		$nm=$_POST['nm'];
		$nmlogin=$_POST['nmlogin'];
		$pslogin=$_POST['pslogin'];
		if($pslogin==""){
		$sql="update admin set nmuser='$nm',nmlogin='$nmlogin' where id='$_GET[id]'";
		mysqli_query($sql);
		echo '<script type="text/javascript">
			//<![CDATA[
			alert("Data User Berhasil Diubah");
			window.location="?data"
			//]]>
		</script>';
		}else{
		$sql="update admin set nmuser='$nm',nmlogin='$nmlogin',pslogin=md5('$pslogin') where id='$_GET[id]'";
		mysqli_query($koneksi, $sql);
		echo '<script type="text/javascript">
			//<![CDATA[
			alert("Data User Berhasil Diubah");
			window.location="?data"
			//]]>
		</script>';
		}
}
?>
<?php } ?>
<?php include('bawah.php'); ?>
