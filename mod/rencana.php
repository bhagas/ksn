<?php
	$kawasan=$_GET['kawasan'];
	$sql="select * from rencana_keterpaduan where kawasan='".$kawasan."' and deleted=false";
	$result=mysql_query($sql);
?>
<div class="row">
	<div class="large-12 columns">
		<nav class="breadcrumbs">
		  <a href="?page=home">Home</a>
		  <a class="current">Rencana Kegiatan Kawasan <?php echo ucfirst($kawasan);?></a>
		</nav>
	</div>
</div>
<hr>
<div class="row">
	<div class="large-12 columns">
		<h3>Rencana Kegiatan Kawasan <?php echo ucfirst($kawasan);?></h3>
	</div>
	<div class="large-12 columns">
		<table class="responsive">
			<tr>
				<th rowspan="2">Nomor</th>
				<th rowspan="2">Infrastruktur</th>
				<th rowspan="2">Jenis Infrastruktur</th>
				<th rowspan="2">Rencana Program di RTR KSN</th>
				<th colspan="2" valign="center">RENCANA PROGRAM DALAM RPI2JM</th>
				<th rowspan="2">Masukan/Diskusi</th>
				<th colspan="2" valign="center">Rencana Terpadu Program Pengembangan Infrastruktur KSN</th>
			</tr>
			<tr>	
				<th>2014</th>
				<th>2015</th>
				<th>2014</th>
				<th>2015</th>
			</tr>
			<?php
				if ($result) {
					$no=1;
					while ($data=mysql_fetch_array($result)) {
						echo "<td>".$no++."</td>
				<td>".$data['infrastruktur']."</td>
				<td>".$data['jenis_infrastruktur']."</td>
				<td>".$data['rencana_program_rtr']."</td>
				<td>".$data['2014_rpl2jm']."</td>
				<td>".$data['2015_rpl2jm']."</td>
				<td>".$data['masukan']."</td>
				<td>".$data['2014_infrastruktur']."</td>
				<td>".$data['2014_infrastruktur']."</td>";
					}
				}
			?>
			<!-- <tr>
				<td>no</td>
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>RPI2JM 2014</td>
				<td>RPI2JM 2015</td>
				<td>6</td>
				<td>rencana infrastruktur 2014</td>
				<td>rencana infrastruktur 2015</td>
			</tr> -->
		</table>
	</div>
</div>