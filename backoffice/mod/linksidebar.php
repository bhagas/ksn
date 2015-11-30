<?php
	$id=$_GET['id'];
	$message="";
	$lokasi=$_FILES['fupload']['tmp_name'];
	$nama=$_FILES['fupload']['name'];
	$user=$_SESSION['name'];
	$deskripsi=$_POST['nama'];
	$direktori="../upload/link/".$nama;
	$foto="";
	
	if (isset($_POST['editsubmit'])) {
		if (isset($_POST['delete'])) {
			$status=1;
			$messageSuccess=$messageSuccess. "Data Berhasil Dihapus<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a>";
			$sql5="update link set deleted=1 where id='".$_POST['id']."'";
			$result5=mysql_query($sql5);
			echo "<script>
					function Redirect(){
						window.location=\"?page=linksidebar\";
					}
					setTimeout(\"Redirect()\",100);
				</script>";
		}
		elseif(isset($_POST['update'])) {
		if ($lokasi_file!="" && $nama_file!="") {
			move_uploaded_file($lokasi_file, $direktori);
			$foto=$foto.", foto='".$nama."'";
			}
			$sql5="update link set url='".$_POST['nama']."'".$foto;
			$sql5=$sql5." where id='".$_POST['id']."'";
			
			$result5=mysql_query($sql5);
			if ($result5) {
				//echo $sql5;
				echo "<script>
					function Redirect(){
						window.location=\"?page=linksidebar\";
					}
					setTimeout(\"Redirect()\",600);
				</script>";
			}
			
		
		}
	}

	if (isset($_POST['add'])) {
		if ($nama=="") {
			$message=$message."<div class='alert alert-danger'>Pilih foto dahulu!</div>";
		}
		else{
			$sql="insert into link (foto,url,id_user) values ('".$nama."','".$deskripsi."','".$user."')";
			$result=mysql_query($sql);
			if ($result) {
				move_uploaded_file($lokasi, $direktori);
				$message=$message."<div class='alert alert-success'>Foto berhasil ditambah!</div>";
				echo "<script>
          function Redirect(){
            window.location=\"?page=linksidebar\";
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
		$sql2="update link set deleted=true where id='".$id."'";
		$result2=mysql_query($sql2);
		if ($result2) {
			$message=$message."<div class='alert alert-success'>Foto berhasil dihapus!</div>";
			echo "<script>
          function Redirect(){
            window.location=\"?page=linksidebar\";
          }
          setTimeout(\"Redirect()\",3000);
        </script>";
		}
	}
	if (isset($_GET['actionedit'])) {
		$sql3="select * from link where id=".$_GET['id']." and deleted=false";
		$result3=mysql_query($sql3);
		if ($result3) {
			if ($data3=mysql_fetch_array($result3)) {
				$url=$data3['url'];
				$foto=$data3['foto'];
			}
		}
	}
?>

<div class="page-header">
	<h2>Manajemen Link Sidebar</h2>
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
			<label>Foto link</label>
			<input type="file" name="fupload">
			<?php
				if (isset($_GET['actionedit'])) {
					echo "<img class='imgresize4' src='$webRoot/upload/link/".$foto."'>";
				}
			?>
		</div>
		<div class="form-group">
				<label>URL (ex. http://www.website.com)</label>
				<input type="input" class="form-control" name="nama" value="<?php echo $url;?>">
			</div>
			<?php
    if (isset($_GET['actionedit'])) {
        echo "<input type=\"hidden\" name=\"editsubmit\" value=\"1\">\r";
        echo "<input type=\"hidden\" name=\"id\" value=\"".$_GET['id']."\">\r";
        echo "<table><tr><td><button type=\"submit\" class=\"btn btn-danger\" value=\"1\" name=\"delete\" onClick=\"return confirm('Anda yakin akan menghapus data ini?')\">Delete</button></td>";
        echo "<td><button type=\"submit\" class=\"btn btn-primary\" name=\"update\">Update</button></td></td></table>";
        //echo "<button class\"btn btn-default\" name=\"delete\" value=\"1\" onClick=\"return confirm('Anda yakin akan menghapus data ini?')\"> Delete<br><br>\r";
    }
    else {
      ?>
        <button type="submit" class="btn btn-default" name="add">Add</button>
      <?php
    }
  ?>
	</form>
</div>
</div>
<hr>
<div class="col-md-6">
	<div class="table table-responsive">
		<table class="table table-bordered">
			<tr>
				<td width="20">No</td>
				<td width="200">url</td>
				<td width="200">foto</td>
				<td>action</td>
			</tr>
			<?php
				$sql1="select * from link where deleted=false";
				$result1=mysql_query($sql1);
				if ($result1) {
					$no=1;
					while ($data=mysql_fetch_array($result1)) {
						echo "<tr>
						<td>".$no++."</td>
						<td>".$data['url']."</td>
						<td><img class='imgresize4' src='$webRoot/upload/link/".$data['foto']."'></td>
						<td><a href='?page=linksidebar&id=$data[id]&act=hapus' onClick=\"return confirm('Anda yakin akan menghapus foto ini?')\">hapus</a><br><a href=\"?page=linksidebar&actionedit=8&id=".$data['id']."\">Edit</a></td>
						</tr>";
					}
				}
			?>
		</table>
	</div>
	
</div>
