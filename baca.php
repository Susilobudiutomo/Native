<?php include "conf/inc.koneksi.php";
?>

          <?php $sql="select * from artikel where id_artikel=$_GET[id]";
		$rs=mysqli_query($koneksi, $sql);
		$row=mysqli_fetch_array($rs);{ ?>
		
<div class="panel panel-default">

  <div class="panel-heading">
              <h3 class="panel-title"><?php echo $row['judul']; ?></h3>
            </div>
<div class="panel-body">

		    <p style="text-align:center;">
			<img src="news/<?php echo $row['foto']; ?>" class="image-rounded" width="400" height="300"/>
			</p>
		    <p><?php echo $row['isi']; ?></p>
		  </div>
		</div>
		<?php } ?>