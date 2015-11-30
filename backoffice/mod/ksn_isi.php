<div class="row">
	<div class="page-header">
		<?php
		$id=$_GET['id'];
		$messageFailed="";
		$messageSuccess="";
		$user=$_SESSION['name'];

		$sql1="select * from ksn where id='".$id."' and deleted=0";
		$result1=mysql_query($sql1);
		if ($result1) {
			if ($data1=mysql_fetch_array($result1)) {
				$jenis=$data1['jenis'];
				echo "<h2>Kategori ".ucfirst($jenis)."</h2>";
			}
		}

		if (isset($_POST['submit'])) {
			$wilayah=$_POST['wilayah'];
			if ($wilayah=="") {
				$messageFailed=$messageFailed."Wilayah Tidak Boleh Kosong<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a>";
				echo "<script>
					function Redirect(){
						window.location=\"?page=ksn_isi&id=$id\";
					}
					setTimeout(\"Redirect()\",3000);
				</script>";
			}
			else{
				$sql2="insert into ksn_wilayah (wilayah, jenis, id_user) values ('".$wilayah."','".$jenis."','".$user."')";
				$result2=mysql_query($sql2);
				if ($result2) {
					$messageSuccess=$messageSuccess."Data Berhasil Disimpan<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a>";
					echo "<script>
					function Redirect(){
						window.location=\"?page=ksn_isi&id=$id\";
					}
					setTimeout(\"Redirect()\",3000);
				</script>";
				}
			}
		}
		?>
		
	</div>
</div>
<div class="row">
	<div class="col-md-2">
	<a data-toggle="modal" href="#myModal" class="btn btn-primary">Tambah Data</a>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
	<?php
	if ($messageFailed!="") {
		?>
		<div class="alert alert-danger"><?php echo $messageFailed;?></div>
		<?php
	}
	elseif ($messageSuccess!="") {
		?>
		<div class="alert alert-success"><?php echo $messageSuccess;?></div>
		<?php
	}
	?>
</div>
</div>
<div class="row centered">
		<?php
		
		$sql="select * from ksn where id='".$id."' and deleted=0";
		$result=mysql_query($sql);
		if ($result) {
			if ($data=mysql_fetch_array($result)) {
				$idjenis=$data['jenis'];
				$idwilayah=$data['id'];
				$sql3="select * from ksn_wilayah where jenis='".$idjenis."' and deleted=0";
				$result3=mysql_query($sql3);
				if ($result3) {
					$foto=null;
					$sql4="select * from ksn_galeri where id_wilayah=".$idwilayah." and deleted=0";
					$result4=mysql_query($sql4);
					if ($result4) {
						if ($data4=mysql_fetch_array($result4)) {
							$foto=$data4['foto'];
						}
					}
					while ($data3=mysql_fetch_array($result3)) {
						echo "<div class='col-md-3'>	
			<a class='no-decor1' href='?page=ksn_detail&id=".$data3['id']."''><img class='img-thumbnail imgResize3' src='/gis_ksn/upload/".$foto."'><br><h4>".$data3['wilayah']."</h4></a>
		</div>";
					}
				}
			}
		}
		?>
</div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Tambah Data</h4>
        </div>
        <div class="modal-body">
          <form role="form" method="post">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Nama Wilayah</label>
			    <input type="text" class="form-control" name="wilayah" placeholder="Wilayah">
			  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
			</form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->