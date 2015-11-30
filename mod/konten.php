<?php
	$tipe=$_GET['id'];
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
			$sql="select * from rtrw where tipe='".$tipe."' and deleted=false";
			$result=mysql_query($sql);
?>
<div class="row">
	<div class="row">
		<div class="large-12 columns">
		<nav class="breadcrumbs">
		  <a href="?page=home">Home</a>
		  <a href="#">Rencana Tata Ruang</a>
		  <a class="current"><?php echo $link;?></a>
		</nav>
	</div></div>
	<hr>
	<div class="large-12">
		<?php
			
			if ($result) {
				if ($data=mysql_fetch_array($result)) {
					echo $data['isi'];
				}
			}
		?>
	</div>
</div>