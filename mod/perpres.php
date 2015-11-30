<?php
			$kawasan1=$_GET['kawasan'];
			$kawasan="perpres_".$kawasan1;
			$sql="select ".$kawasan." from perpres";
			$result=mysql_query($sql);
			if ($result) {
				if ($data=mysql_fetch_array($result)) {
					$isi=$data[$kawasan];
				}
			}
		?>
<div class="row">
		<div class="large-12 columns">
		<nav class="breadcrumbs">
		  <a href="?page=home">Home</a>
		  <a href="#">Perpres</a>
		  <a class="current">KSN <?php echo $kawasan1;?></a>
		</nav>
	</div></div>
	<hr>
<div class="row">
	<div class="large-12 columns">
		<h3>Perpres <?php echo ucfirst($kawasan1);?></h3>
	</div>
	<div class="large-12 columns">
		<?php echo $isi;?>
	</div>
</div>