<?php
	$db="test";
	$host="localhost";
	$user="root";
	$pass="";
	$con=mysql_connect($host,$user,$pass,$db);
	
	if($con){
		echo "success";
	}
	else 
		echo "failed";
	
	date_default_timezone_set('Asia/Jakarta');
	date_default_timezone_get();
	echo date("Y");
?>