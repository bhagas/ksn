<?php
	$id=$_GET['id'];
	$message="";
	$lokasi=$_FILES['fupload']['tmp_name'];
	$nama=$_FILES['fupload']['name'];
	$user=$_SESSION['name'];
	$deskripsi=$_POST['nama'];
	$direktori="../upload/banner/".$nama;
	
	if (isset($_POST['add'])) {
		if ($nama=="") {
			$message=$message."<div class='alert alert-danger'>Pilih foto dahulu!</div>";
		}
		else{
			$sql="insert into banner (foto,deskripsi,id_user) values ('".$nama."','".$deskripsi."','".$user."')";
			$result=mysql_query($sql);
			if ($result) {
				move_uploaded_file($lokasi, $direktori);
				$message=$message."<div class='alert alert-success'>Foto berhasil ditambah!</div>";
				echo "<script>
          function Redirect(){
            window.location=\"?page=banner\";
          }
          setTimeout(\"Redirect()\",3000);
        </script>";
			}
			else {
				$message=$message.mysql_error();
			}
		}
	}

	if ($_GET['act']=="hapus") {
		$sql2="update banner set deleted=true where id='".$id."'";
		$result2=mysql_query($sql2);
		if ($result2) {
			$message=$message."<div class='alert alert-success'>Foto berhasil dihapus!</div>";
			echo "<script>
          function Redirect(){
            window.location=\"?page=banner\";
          }
          setTimeout(\"Redirect()\",3000);
        </script>";
		}
	}


?>

<div class="page-header">
	<h2>Manajemen Front Banner</h2>
</div>
<div class="row">
	<div class="col-md-6">
	<?php
		if ($message!="") {
			echo $message;
		}
	?>
	<form method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label>Foto Banner</label>
			<input type="file" name="fupload">
		</div>
		<div class="form-group">
			<label>Deskripsi Singkat Foto</label>
			<input class="form-control" type="input" name="nama">
		</div>
		<button type="submit" class="btn btn-primary" name="add">Submit</button>
	</form>
</div>
</div>
<hr>
<div class="col-md-12">
	<?php
				$sql1="select * from banner where deleted=false";
				$result1=mysql_query($sql1);
				if ($result1) {
					while ($data=mysql_fetch_array($result1)) {
						echo "<div class='col-md-3'>
                  <div class='col-md-1 col-md-offset-11'><a href='?page=banner&id=$data[id]&act=hapus' onClick=\"return confirm('Anda yakin akan menghapus foto ini?')\">&times;</a></div>
                  <a href='?page=detailbanner&id=$data[id]'>
                  <img class=' img-thumbnail imgresize1' src='$webRoot/upload/banner/$data[foto]'>
                  </a>
                </div>";
					}
				}
			?>
</div>