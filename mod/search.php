<?php
			$artikel=$_POST['artikel'];
			if ($artikel=="") {
				$message="Tidak ada hasil pencarian";
			}
			else{
			$sql="select *, DAY(inserted) as tanggal, MONTHNAME(inserted) as bulan, year(inserted) as tahun, TIME(inserted) as waktu from artikel where judul LIKE '%".$artikel."%' and  deleted=false ORDER BY inserted desc";
			$result=mysql_query($sql);
				
			}
			
		?>
<div class="row">
		<div class="large-12 columns">
		<nav class="breadcrumbs">
		  <a href="?page=home">Home</a>
		  <a href="#">Search</a>
		  <a class="current"><?php echo $artikel;?></a>
		</nav>
	</div></div>
	<hr>
	<h2 class="subheader">Result Pencarian : <?php echo $artikel;?></h2>
	
  <?php
  	if ($message!="") {?><div data-alert class="alert-box alert"><?php
  		echo $message;?>
  <a href="#" class="close">&times;</a>
</div><?php
  	}
  ?>
<div class="row">
	<div class="large-12">
		<?php
			if ($result) {
				while ($data=mysql_fetch_array($result)) {
					$id=$data['id'];
				$judul=$data['judul'];
				$isi=$data['isi'];
				$tanggal=$data['tanggal']." ".$data['bulan']." ".$data['tahun'];
				$waktu=$data['waktu'];
				$user=$data['id_user'];
				$foto=$data['fotopreview'];

				echo "<hr>
	<div class='large-11 columns thread'>
		<div class='large-3 columns'>
			<img class='th' src='upload/artikel/".$foto."'>
		</div>
		<div class='large-9 columns'>
			<dl>
			<dt>
				<a href='?page=detailartikel&id=".$id."'>".$judul."</a>
			</dt>
			<dd>
				<h6 class='subheader'>".$user." | ".$tanggal." ".$waktu."</h6>
			</dd>
			<dd>".strip_tags(substr($isi, 0,200))."....<br><a href='?page=detailartikel&id=".$id."'>Selanjutnya</a>
			</dd>
		</dl>
		</div>
	</div>";
				}
			}
		?>
	</div>
</div>