<?php
	$message="";
	$nama=$_POST['nama'];
	$id=$_GET['id'];
	$sql="select * from ksn_galeri where id='".$id."'";
	$result=mysql_query($sql);
	if ($result) {
		if ($data=mysql_fetch_array($result)) {
			$namafoto=$data['foto'];
		}
	}

	if (isset($_POST['change'])) {
		if ($nama=="") {
			$message=$message."<div class='alert alert-danger centered'>Nama Tidak Boleh Kosong!</div>";
		}
		else{
			$sql1="update foto set nama='".$nama."' where id='".$id."'";
			$result1=mysql_query($sql1);
			if ($result1) {
				$message=$message."<div class='alert alert-success'>Nama Foto Berhasil Dirubah!</div>";
				echo "<script>
          function Redirect(){
            window.location=\"?page=detailfoto&id=$id\";
          }
          setTimeout(\"Redirect()\",1000);
        </script>";
			}
		}
	}
?>
<div class="row">
  <div class="col-md-12">
    <h3><?php echo $namafoto;?></h3>
  </div>
  <!-- <div class="col-md-1">
  	<a data-toggle="modal" href="#myModal" class="btn btn-default">Edit Nama Foto</a>
  </div> -->
</div>
<hr>

<div class="row">
	<?php
		if ($message !="") {
			echo $message;
		}
	?>
		<div class="col-md-12 centered margin-30">
			<img src="<?php echo "$webRoot/upload/$namafoto";?>">
		</div>
		
</div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit Nama Foto</h4>
        </div>
        <div class="modal-body">
          <form method=post>
		<div class="row">
				<div class="form-group">
					<label>Nama Foto</label>
					<input type="text" name="nama" class="form-control" value="">
				</div>
		</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="change">Simpan</button>
        </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->