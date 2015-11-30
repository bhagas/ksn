<?php
			$tipe=$_GET['tipe'];
			if ($tipe=="jawa-bali") {
		$link="Pulau Jawa-Bali";
	}
	if ($tipe=="nasional") {
		$link="Nasional";
	}
	if ($tipe=="provinsi") {
		$link="Provinsi Jawa Tengah";
	}
	if ($tipe=="magelang") {
		$link="Kabupaten Magelang";
	}
	if ($tipe=="klaten") {
		$link="Kabupaten Klaten";
	}
	if ($tipe=="boyolali") {
		$link="Kabupaten Boyolali";
	}
			$sql="select * from profil where posisi='".$tipe."' and deleted=false";
			$result=mysql_query($sql);
			if ($result) {
				if ($data=mysql_fetch_array($result)) {
					$isi=$data['isi'];
				}
			}
		?>
<div class="row">
		<div class="large-12 columns">
		<nav class="breadcrumbs">
		  <a href="?page=home">Home</a>
		  <a href="#">Profil Wilayah</a>
		  <a class="current"><?php echo $link;?></a>
		</nav>
	</div></div>
<hr>
<div class="row">
	<div class="large-12">
		<?php echo $isi;?>
	</div>
</div>