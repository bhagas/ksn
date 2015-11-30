<div class="col-md-12  padding-20">
	<div class="row centered">
		<?php
		$id=$_GET['id'];
		$konten=$_GET['konten'];
		$kab=$_GET['kab'];
		// tampil menu rtrw jika konten diset
		if (isset($konten)) {
			$sql="select * from rtrw where tipe='".$konten."' and deleted=0";
			$result=mysql_query($sql);
			if ($result) {
				if ($data=mysql_fetch_array($result)) {

					echo $data['isi'];
				}
			}
		}

		// tampil artikel rtrw jika id diset
		if (isset($id)) {
			$sql="select * from ksn_wilayah where jenis='".$id."' and deleted=false";
			$result=mysql_query($sql);
			if ($result) {
				echo "<h3>RTR KSN ".strtoupper($id)."</h3>";
				while ($data=mysql_fetch_array($result)) {
					echo "<div class='box1'>";
					$fotoo=null;
					$sql1="select * from ksn_galeri where id_wilayah='".$data['id']."' and deleted=0";
					$result1=mysql_query($sql1);
					if ($result1) {
						if ($data1=mysql_fetch_array($result1)) {
							$fotoo=$data1['foto'];
							if (!isset($fotoo)) {
								$fotoo=null;
							}
					}}
					echo "<a class='no-decor' href='?page=detail&id=".$data['id']."'><img class='img-circle imgresize' src='upload/".$fotoo."'><h3>".$data['wilayah']."</h3></a></div>";
				}
			}
		}


	?>
	</div>
</div>