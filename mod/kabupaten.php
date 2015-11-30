<div class="col-md-12  padding-20">
	<div class="row centered">
		<?php
		$sql="select * from rtrw where posisi='kabupaten'";
			$result=mysql_query($sql);
			if ($result) {
				while ($data=mysql_fetch_array($result)) {
					//echo $data['tipe'];
					echo "<div class='col-md-3'><a class='no-decor' href='?page=content&konten=".$data['tipe']."'><img class='img-rounded imgresize' src='upload/logo/".$data['logo']."'><h3>".ucfirst($data['tipe'])."</h3></a></div>";
				}
			}
	?>
	</div>
</div>