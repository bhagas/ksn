<div class="row">
	<h2 class="subheader">Berita Terbaru</h2>
	<?php
		$sql="select *, DAY(inserted) as tanggal, MONTHNAME(inserted) as bulan, year(inserted) as tahun, TIME(inserted) as waktu from artikel where deleted=false ORDER BY inserted desc LIMIT 0,5";
		$result=mysql_query($sql);
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