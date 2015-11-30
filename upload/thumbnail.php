<?php
$id=$_GET['id'];
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'gis_ksn';
$dbConn = mysql_connect ($dbHost, $dbUser, $dbPass) or die ('MySQL connect failed. ' . mysql_error());
	mysql_select_db($dbName) or die('Cannot select database. ' . mysql_error());
include("thumbnail.class.php");
$tg = new thumbnailGenerator;
$sql="select * from ksn_galeri where id=$id";
$result=mysql_query($sql);
if ($result) {
	if ($data=mysql_fetch_array($result)) {
		$photo="$data[foto]";
		$tg->generate($photo, 200, 200);
	}
}
?>