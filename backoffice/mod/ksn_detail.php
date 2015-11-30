<div class="page-header">
	<?php
	$id=$_GET['id'];
	$sql="select * from ksn_wilayah where id='".$id."'";
	$result=mysql_query($sql);
	if ($result) {
		if ($data=mysql_fetch_array($result)) {
			$wilayah=$data['wilayah'];
			echo "<h2>Kawasan ".ucfirst($wilayah)."</h2>";
		}
	}
	?>
	
</div>
<div class="row centered">	
		<div class="col-md-2">
			<a href="?page=konten&konten=ksn_perpres&id=<?php echo $id;?>"><img class="img-circle imgresize" src="images/logo-jateng.png"><br><h4>Kebijakan Perpres</h4></a>
		</div>
		<div class="col-md-2">
			<a href="?page=konten&konten=ksn_tujuan_tata_ruang&id=<?php echo $id;?>"><img class="img-circle imgresize" src="images/logo-jateng.png"><br><h4>Tujuan Penataan Ruang</h4></a>
		</div>
		<div class="col-md-2">
			<a href="?page=konten&konten=ksn_kebijakan_strategi&id=<?php echo $id;?>"><img class="img-circle imgresize" class="" src="images/logo-jateng.png"><br><h4>Kebijakan dan Strategi</h4></a>
		</div>
		<?php
			if ($wilayah=="merapi") {
				?>
				<div class="col-md-2">
			<a href="?page=konten&konten=ksn_rencana_evakuasi&id=<?php echo $id;?>"><img class="img-circle imgresize" src="images/logo-jateng.png"><br><h4>Rencana Sistem Evakuasi Bencana</h4></a>
		</div>
				<?php
			}
		?>
		<div class="col-md-2">
			<a href="?page=konten&konten=ksn_rencana_struktur_ruang&id=<?php echo $id;?>"><img class="img-circle imgresize" src="images/logo-jateng.png"><br><h4>Rencana Struktur Ruang</h4></a>
		</div>
		<div class="col-md-2">
			<a href="?page=konten&konten=ksn_rencana_lindung&id=<?php echo $id;?>"><img class="img-circle imgresize" src="images/logo-jateng.png"><br><h4>Rencana Pola Ruang Kawasan Lindung</h4></a>
		</div>
		<div class="col-md-2">
			<a href="?page=konten&konten=ksn_rencana_budaya&id=<?php echo $id;?>"><img class="img-circle imgresize" src="images/logo-jateng.png"><br><h4>Rencana Pola Ruang Kawasan Budaya</h4></a>
		</div>
</div>