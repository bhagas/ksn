<?php
			$tipe=$_GET['id'];
			$sql="select * from peraturan where posisi='".$tipe."' and deleted=false";
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
		  <a href="#">Peraturan</a>
		  <a class="current"><?php echo $tipe;?></a>
		</nav>
	</div></div>
	<hr>
<div class="row">
	<div class="large-12">
		<?php echo $isi;?>
	</div>
</div>