<?php
ob_start();
$id = $_GET['id'];
$img=false;
$query = "SELECT foto FROM banner WHERE id =$id and deleted=false";
$hasil = mysql_query($query);
if ($hasil) {
	if ($data = mysql_fetch_array($hasil)) {
		//base64_encode($data['foto']);
		echo "<img class='imgPreview' src='$webRoot/upload/banner/$data[foto]'/>";
	}
	
}
ob_flush();
?>

