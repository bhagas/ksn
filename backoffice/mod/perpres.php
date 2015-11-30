<?php
	$user=$_SESSION['name'];
	$_SESSION['1mypath']=$webRoot."/upload";
	$foto="";
	$kawasan1=$_GET['kawasan'];
	$kawasan="perpres_".$kawasan1;
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

	if (isset($_POST['edit'])) {
		if ($isi1=="") {
			$messageIsi= $messageIsi. "has-error";
			$messageIsi2 = $messageIsi2. "Isi Tidak Boleh Kosong<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a>";
		}
		
		if ($messageIsi=="" && $messageIsi2=="" ) {
			
			$sql5="update perpres set ".$kawasan."='".$isi1."'";
			$result5=mysql_query($sql5);
			if ($result5) {
				$messageSuccess=$messageSuccess. "Data Berhasil Dirubah<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a>";
				echo "<script>
					function Redirect(){
						window.location=\"?page=perpres&kawasan=".$kawasan1."\";
					}
					setTimeout(\"Redirect()\",600);
				</script>";
			}
			
		}
	}
	$sql4="select ".$kawasan." from perpres";
		$result4=mysql_query($sql4);
		if ($result4) {
			if ($row4=mysql_fetch_array($result4)) {
				$isi=$row4[$kawasan];

			}
		}

?>
<div class="page-header">
			<h2>Manajemen Perpres Kawasan <?php echo $kawasan1;?></h2>
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
		 
		  
		 
		<?php
				if ($messageIsi!="" || $messageIsi2 !="") {
					?>
					<div class="alert alert-danger"><?php echo $messageIsi2?></div>
					<?php
				}
			?>
		  <div class="form-group <?php echo $messageIsi;?>">
		    <label class="control-label">Isi Perpres</label>
		    <textarea class="form-control" rows="20" name="isi"><?php echo $isi;?></textarea>
		  </div>
		  <div class="form-group">
		    
		  </div>
		  <button type="submit" class="btn btn-primary" name="edit">Update</button>
		  
		</form>
	</div>
</div>

<?php
	// //paging
	// $batas=5;
	// $halaman=$_GET['halaman'];
	// if (empty($halaman)) {
	// 	$posisi = 0;
	// 	$halaman = 1;
	// }
	// else {
	// 	$posisi = ($halaman - 1) * $batas;
	// }

	// $sql2="select * from perpres where deleted='0' ORDER BY inserted desc limit $posisi,$batas";
	// $sql3="select * from perpres where deleted='0'";
	
	// $result3=mysql_query($sql3);

	// $jmldata=mysql_num_rows($result3);
	// $jmlhalaman=ceil($jmldata/$batas);


	// $result2=mysql_query($sql2);
?>
<!-- begin article content list  -->
<!-- <div class="row">
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
		    		<th>Preview</th>
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
						    	<td>".substr(strip_tags($row2['perpres_'.$kawasan.'']),0,250)."</td>
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
		  	echo "<li><a href='$_SERVER[PHP_SELF]?page=perpres&kawasan=".$kawasan."&halaman=1'>&laquo;</a></li>";
		  	for ($i=1; $i<=$jmlhalaman ; $i++) { 
		  		if ($i != $halaman) {
		  			echo "<li><a href=$_SERVER[PHP_SELF]?page=perpres&kawasan=".$kawasan."&halaman=$i>$i</a></li>";
		  		}
		  		else {
		  			echo "<li class='active'><a href=$_SERVER[PHP_SELF]?page=perpres&kawasan=".$kawasan."&halaman=$i>$i</a></li>";
		  		}
		  	}
		  	echo "<li><a href='$_SERVER[PHP_SELF]?page=perpres&kawasan=".$kawasan."&halaman=$jmlhalaman'>&raquo;</a></li>";
		  ?>
		</ul>
	</div>
</div> -->