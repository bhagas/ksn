<?php
	$kab=$_POST['kabupaten'];
	$user=$_SESSION['name'];
	$messageFailed="";
	$messageSuccess="";
	if (isset($_POST['submit'])) {
			if ($kab=="") {
				$messageFailed=$messageFailed."Nama Kabupaten Tidak Boleh Kosong<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a>";
				// echo "<script>
				// 	function Redirect(){
				// 		window.location=\"?page=ksn_isi&id=$id\";
				// 	}
				// 	setTimeout(\"Redirect()\",3000);
				// </script>";
			}
			else{
				$sql2="insert into rtrw (tipe, posisi, id_user) values ('".$kab."','kabupaten','".$user."')";
				$result2=mysql_query($sql2);
				if ($result2) {
					$messageSuccess=$messageSuccess."Data Berhasil Disimpan<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a>";
				// 	echo "<script>
				// 	function Redirect(){
				// 		window.location=\"?page=ksn_isi&id=$id\";
				// 	}
				// 	setTimeout(\"Redirect()\",3000);
				// </script>";
				}
			}
		}
?>

<div class="row">
	<div class="page-header">
		<h2>Rencana Tata Ruang Kabupaten</h2>
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
		$sql="select * from rtrw where posisi='kabupaten' and deleted=0 ORDER BY tipe asc";
		$result=mysql_query($sql);
		if ($result) {
			while ($data=mysql_fetch_array($result)) {
				echo "<div class='box1 grey-bg centered centered'>	
			<a class='no-decor' href='?page=rtrw&konten=".$data['tipe']."''><img src='images/artikel.png'><br><h4>RTRW ".ucfirst($data['tipe'])."</h4></a>
		</div>";
			}
		}
		?>
		<!-- <div class="box1 grey-bg centered centered">	
			<a class="no-decor" href="?page=rtrw&konten=magelang"><img class="" src="images/artikel.png"><br><h4>RTRW Magelang</h4></a>
		</div>
		<div class="box1 grey-bg centered">	
			<a class="no-decor" href="?page=rtrw&konten=boyolali"><img src="images/komentar.png"><br><h4>RTRW Boyolali</h4></a>
		</div>
		<div class="box1 grey-bg centered centered">	
			<a class="no-decor" href="?page=rtrw&konten=klaten"><img class="" src="images/artikel.png"><br><h4>RTRW klaten</h4></a>
		</div> -->

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
			    <input type="text" class="form-control" name="kabupaten" placeholder="Kabupaten">
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