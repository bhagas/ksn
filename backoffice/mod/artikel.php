<?php
	$user=$_SESSION['name'];
	$_SESSION['1mypath']="/upload";
	$foto="";

	$judul1=$_POST['judul'];
	$isi1=$_POST['isi'];
	$lokasi_file=$_FILES['fupload']['tmp_name'];
	$nama_file=$_FILES['fupload']['name'];
	$direktori="../upload/artikel/".$nama_file;


	function resetVar(){
		$judul1="";
		$isi1="";
	}
		$messageJudul="";
		$messageJudul2="";
		$messageIsi="";
		$messageIsi2 ="";
		$messageSuccess="";

	if (isset($_GET['actionhapus'])) {
		$idhapus=$_GET['idhapus'];
		$sql="update artikel set deleted=1 where id=$idhapus";
		$result=mysql_query($sql);
		if ($result) {
			$messageSuccess="Data Berhasil Dihapus<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a>";
			echo "<script>
					function Redirect(){
						window.location=\"?page=artikel\";
					}
					setTimeout(\"Redirect()\",3000);
				</script>";
		}
	}

	//action query add
	if (isset($_POST['add'])) {
		if ($judul1=="") {
			$messageJudul= $messageJudul. "has-error";
			$messageJudul2 = $messageJudul2. "Judul Tidak Boleh Kosong!<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a>";
		}
		if ($isi1=="") {
			$messageIsi= $messageIsi. "has-error";
			$messageIsi2 = $messageIsi2. "Isi Artikel Tidak Boleh Kosong<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a>";
		}
		if ($nama_file=="") {
			$nama_file="logo-jateng.png";
		}
		if ($messageJudul=="" && $messageJudul2=="" && $messageIsi=="" && $messageIsi2=="" ) {
			move_uploaded_file($lokasi_file, $direktori);
			$messageSuccess=$messageSuccess. "Data Berhasil Ditambahkan<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a>";
			$sql1="insert into artikel (judul, isi,fotopreview, id_user) values ('".$judul1."', '".$isi1."','".$nama_file."','".$user."')";
			$result1=mysql_query($sql1);
			echo "<script>
					function Redirect(){
						window.location=\"?page=artikel\";
					}
					setTimeout(\"Redirect()\",3000);
				</script>";
		}
	}

	//action editsubmit
	if (isset($_POST['editsubmit'])) {
		if (isset($_POST['delete'])) {
			$status=1;
			$messageSuccess=$messageSuccess. "Data Berhasil Dihapus<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a>";
			$sql5="update artikel set deleted=1 where id='".$_POST['id']."'";
			$result5=mysql_query($sql5);
			echo "<script>
					function Redirect(){
						window.location=\"?page=artikel\";
					}
					setTimeout(\"Redirect()\",100);
				</script>";
		}
		else {
			if ($judul1=="") {
			$messageJudul= $messageJudul. "has-error";
			$messageJudul2 = $messageJudul2. "Judul Tidak Boleh Kosong!<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a>";
		}
		if ($isi1=="") {
			$messageIsi= $messageIsi. "has-error";
			$messageIsi2 = $messageIsi2. "Isi Artikel Tidak Boleh Kosong<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a>";
		}
		if ($lokasi_file!="" && $nama_file!="") {
			move_uploaded_file($lokasi_file, $direktori);
			$foto=$foto.", fotopreview='".$nama_file."'";
		}
		if ($messageJudul=="" && $messageJudul2=="" && $messageIsi=="" && $messageIsi2=="" ) {
			$messageSuccess=$messageSuccess. "Data Berhasil Dirubah<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a>";
			
			$sql5="update artikel set judul='".$judul1."', isi='".$isi1."'".$foto;
			$sql5=$sql5."where id='".$_POST['id']."'";
			$result5=mysql_query($sql5);
			echo "<script>
					function Redirect(){
						window.location=\"?page=artikel\";
					}
					setTimeout(\"Redirect()\",6000);
				</script>";
		}
		}
	}

	// action form edit
	if (isset($_GET['actionedit']) || isset($_GET['id'])) {
		$sql4="select * from artikel where id='".$_GET['id']."' and deleted='0'";
		$result4=mysql_query($sql4);
		if ($result4) {
			if ($row4=mysql_fetch_array($result4)) {
				$judul=$row4['judul'];
				$isi=$row4['isi'];
				$fotopreview=$row4['fotopreview'];
			}
		}
	}

?>
<div class="page-header">
			<h2>Manajemen Artikel</h2>
		</div>
<div class="row">
	<div class="col-md-8">
		<form role="form" method="POST" enctype="multipart/form-data">
			<?php
				if ($messageJudul!="" || $messageJudul2 !="") {
					?>
					<div class="alert alert-danger"><?php echo $messageJudul2?></div>
					<?php
				}
				elseif ($messageSuccess!=""){
					?><div class="alert alert-success"><?php echo $messageSuccess?></div><?php
				}
			?>
		  <div class="form-group <?php echo $messageJudul?>">
		    <label class="control-label">Judul Artikel</label>
		    <input type="input" class="form-control" name="judul" value="<?php if (isset($_GET['actionedit'])) {
		    	echo $judul;
		    }
		    else {
		    	echo $judul1;
		    }
		    ?>">
		  </div>
		  
		  <div class="form-group">
			<label>Foto Preview</label>
			<input class="form-control" type="file" name="fupload">
			<?php
				if (isset($_GET['actionedit'])) {
					echo "<img src='$webRoot/upload/artikel/$fotopreview' width='200' height='200'>";
				}
			?>
		</div>
		<?php
				if ($messageIsi!="" || $messageIsi2 !="") {
					?>
					<div class="alert alert-danger"><?php echo $messageIsi2?></div>
					<?php
				}
			?>
		  <div class="form-group <?php echo $messageIsi;?>">
		    <label class="control-label">Isi Artikel</label>
		    <textarea class="form-control" rows="20" name="isi"><?php if (isset($_GET['actionedit'])) {
		    	echo $isi;
		    }
		    else{
		    	echo $isi1;
		    }
		    ?></textarea>
		  </div>
		  <div class="form-group">
		    
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

<?php
	//paging
	$batas=5;
	$halaman=$_GET['halaman'];
	if (empty($halaman)) {
		$posisi = 0;
		$halaman = 1;
	}
	else {
		$posisi = ($halaman - 1) * $batas;
	}

	$sql2="select * from artikel where deleted='0' ORDER BY inserted desc limit $posisi,$batas";
	$sql3="select * from artikel where deleted='0'";
	
	$result3=mysql_query($sql3);

	$jmldata=mysql_num_rows($result3);
	$jmlhalaman=ceil($jmldata/$batas);


	$result2=mysql_query($sql2);
?>
<!-- begin article content list  -->
<div class="row">
  <div class="page-header">
    <h3>Daftar Artikel</h3>
  </div>
</div>
<?php
	//echo $_SERVER['DOCUMENT_ROOT'];
?>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
		  <table class="table table-bordered">
		    <thead>
		    	<tr>
		    		<th width="30">Nomor</th>
		    		<th width="100">Judul</th>
		    		<th>Preview</th>
		    		<th>Foto</th>
		    		<th>Penulis</th>
		    		<th>Tanggal</th>
		    		<th>Action</th>
		    	</tr>
		    </thead>
		    	<?php
		    	$no=$posisi+1;
		    	if ($result2) {
		    		while ($row2 = mysql_fetch_array($result2)) {
		    			echo "<tr><td width=\"50\">".$no++."</td>
						    	<td>".$row2['judul']."</td>
						    	<td>".substr(strip_tags($row2['isi']),0,250)."</td>
						    	<td><img class='imgresize4' src='$webRoot/upload/artikel/".$row2['fotopreview']."'></td>
						    	<td>".$row2['id_user']."</td>
						    	<td>".$row2['inserted']."</td>
						    	<td><a href=\"?actionedit=2&id=".$row2['id']."\">[Edit]</a><br><a href=\"?actionhapus=1&idhapus=".$row2['id']."\" onClick=\"return confirm('Anda yakin akan menghapus data ini?')\">[Hapus]</a><br><a href=\"content.php?page=detailartikel&id=".$row2['id']."\">[Detail Artikel]</a></td></tr>";
		    		}
		    	}
		    	?>
		  </table>
		</div>
		<ul class="pagination">
		  <?php
		  	echo "<li><a href='$_SERVER[PHP_SELF]?page=artikel&halaman=1'>&laquo;</a></li>";
		  	for ($i=1; $i<=$jmlhalaman ; $i++) { 
		  		if ($i != $halaman) {
		  			echo "<li><a href=$_SERVER[PHP_SELF]?page=artikel&halaman=$i>$i</a></li>";
		  		}
		  		else {
		  			echo "<li class='active'><a href=$_SERVER[PHP_SELF]?page=artikel&halaman=$i>$i</a></li>";
		  		}
		  	}
		  	echo "<li><a href='$_SERVER[PHP_SELF]?page=artikel&halaman=$jmlhalaman'>&raquo;</a></li>";
		  ?>
		</ul>
	</div>
</div>