<?php include "conf/inc.koneksi.php"; ?>

<div class="panel panel-default">

  <div class="panel-heading">
              <h3 class="panel-title"><span class="glyphicon glyphicon-info-sign"></span> Informasi</h3>
            </div>
<div class="panel-body">
      
        <?php 
        // $sql= 'SELECT * from artikel WHERE ket="Y" order by id asc LIMIT 10';
        $rs=mysqli_query($koneksi,'SELECT * from artikel WHERE ket="Y" order by id_artikel asc LIMIT 10');
        while($row=mysqli_fetch_array($rs)){ ?>
		
		
		  <a href="?page=read&id=<?php echo $row['id_artikel']; ?>" class="list-group-item">
          <img style="float:left;margin-right:20px;" src="news/<?php echo $row['foto']; ?>" class="image-rounded" width="120" height="80"/>
		  <h4 class="list-group-item-heading"><?php echo $row['judul']; ?></h4>
		  <p class="list-group-item-text-justify">
          <?php echo substr($row['isi'],0,350); ?>
          </p></a>
		
		
          <?php } ?>

</div>
</div>