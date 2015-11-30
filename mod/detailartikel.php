<?php
	$id=$_GET['id'];
			$sql="select *, DAY(inserted) as tanggal, MONTHNAME(inserted) as bulan, year(inserted) as tahun, TIME(inserted) as waktu from artikel where deleted=false and id=$id ORDER BY inserted desc LIMIT 0,5";
			$result=mysql_query($sql);
			if ($result) {
				if ($data=mysql_fetch_array($result)) {
					$id=$data['id'];
				$judul=$data['judul'];
				$isi=$data['isi'];
				$tanggal=$data['tanggal']." ".$data['bulan']." ".$data['tahun'];
				$waktu=$data['waktu'];
				$user=$data['id_user'];
				$foto=$data['fotopreview'];	
				}
			}
?>

<div class="row">
		<div class="large-12 columns">
		<nav class="breadcrumbs">
		  <a href="?page=home">Home</a>
		  <a href="?page=artikel">Artikel</a>
		  <a class="current"><?php echo $judul;?></a>
		</nav>
	</div>
	<hr>
<div class="row">
	
	<div class="large-12 columns">
		<?php
			echo "<h3>".$judul."</h3>";
					echo "<h6 class='subheader'>".$user." | ".$tanggal." ".$waktu."</h6>";
			echo "<img src='$webRoot/upload/artikel/$foto'>";
					echo $isi;
		?>
	</div>
</div>
<hr>
<div class="row">
	<div class="large-12 columns">
		<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52bfdd2d334179a5"></script>
<!-- AddThis Button END -->
	</div>
</div>
</div>