<?php
	$id=$_GET['id'];
	$path="upload/program/perda_rtrw_".$id.".pdf";
	if ($id=="jateng") {
		$title="Wilayah Provinsi ".ucfirst($id);
	}
	elseif ($id=="jawabali"){
		$title="Pulau Jawa-Bali";
	}
	elseif ($id=="nasional") {
		$title="Wilayah ".ucfirst($id);
	}
	elseif ($id=="merapi" || $id=="borobudur") {
		$title="Wilayah ".ucfirst($id);
	}
	else{
		$title="Wilayah Kabupaten ".ucfirst($id);
	}
	echo "<h3 class='centered'>Rencana Tata Ruang ".$title."</h3><hr>";
	echo "<a href='$path' class='small button radius' target='_blank'>Download PDF</a>";
	echo "<iframe src='$path' width='100%' height='1000'></iframe>";
?>