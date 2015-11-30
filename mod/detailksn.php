<?php
	$wilayah=$_GET['ksn'];
	$konten=$_GET['konten'];
	if ($konten=="ksn_perpres") {
		$ksn="Kebijakan Perpres";
	}
	if ($konten=="ksn_rencana_budaya") {
		$ksn="Rencana Pola Ruang Kawasan Budaya";
	}
	if ($konten=="ksn_rencana_lindung") {
		$ksn="Rencana Pola Ruang Kawasan Lindung";
	}
	if ($konten=="ksn_rencana_evakuasi") {
		$ksn="Rencana Sistem Evakuasi Bencana";
	}
	if ($konten=="ksn_rencana_struktur_ruang") {
		$ksn="Rencana Struktur Ruang";
	}
	if ($konten=="ksn_tujuan_tata_ruang") {
		$ksn="Tujuan Penataan Ruang";
	}
	if ($konten=="ksn_kebijakan_strategi") {
		$ksn="Kebijakan dan Strategi";
	}

	$sql="select * from ksn_wilayah where wilayah='".$wilayah."' and deleted=false";
	$result=mysql_query($sql);
	if ($result) {
		if ($data=mysql_fetch_array($result)) {
			$id=$data['id'];
		}
	}
	$sql1="select * from ".$konten." where id_wilayah=".$id." and deleted=false";
	$result1=mysql_query($sql1);
	if ($result1) {
		if ($data1=mysql_fetch_array($result1)) {
			$isi=$data1['isi'];
		}
	}

?>
<div class="row">
		<div class="large-12 columns">
		<nav class="breadcrumbs">
		  <a href="?page=home">Home</a>
		  <a href="#"><?php echo $wilayah;?></a>
		  <a class="current"><?php echo $ksn;?></a>
		</nav>
	</div></div>
<div class="row">
	<hr>
	<div class="large-12 columns">
		<?php
			echo $isi;
		?>
	</div>
</div>