<div class="row">
	<div class="page-header">
		<h2>Kawasan Strategis Nasional</h2>
	</div>
</div>
<div class="row centered">
		<?php
		$sql="select * from ksn_wilayah where deleted=0";
		$result=mysql_query($sql);
		if ($result) {
			while ($data=mysql_fetch_array($result)) {
				echo "<div class='box1 grey-bg centered'>	
			<a class='no-decor' href='?page=ksn_detail&id=".$data['id']."''><img src='images/artikel.png'><br><h4>".ucfirst($data['wilayah'])."</h4></a>
		</div>";
			}
		}
		?>
</div>