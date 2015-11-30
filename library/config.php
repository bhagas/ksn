<?php
ini_set('display_errors', 'On');
//ob_start("ob_gzhandler");

//ganti max upload sesuai dengan kebutuhan
ini_set('post_max_size','30M');
ini_set('upload_max_filesize','30M');
ini_set('memory_limit','100M');
ini_set('max_execution_time','90');
ini_set('error_reporting','E_ALL & ~E_NOTICE');

//echo ini_get('post_max_size');

// start the session
@session_start();

// database connection config
$dbHost = 'localhost';
// $dbUser = 'ksnp5316_jateng';
// $dbPass = 'jateng12345';
$dbUser = 'root';
$dbPass = '';
$dbName = 'ksnp5316_gis_ksn';

//path
$webRoot = "http://localhost/ksn";							//root awal
$webRootAdmin = $webRoot."/backoffice";		//path untuk admin/backoffice
$modulFolder = "/images/dokumen";                    //nama folder penyimpanan modul
$webModul = $webRoot.$modulFolder;					//path untuk menyimpan modul
$newsFotoFolder = "/images/news";			//nama folder penyimpanan foto news
$newsFoto = $webRoot.$newsFotoFolder;			//path untuk menyimpan foto news
$webFotoFolder = "/upload";			//nama folder penyimpanan foto news
$webFoto = $webRoot.$webFotoFolder;			//path untuk menyimpan foto news

$webDomain = "http://localhost";		//domain web server contoh: pemalangkab.go.id

$judul = "Sistem Informasi Geografis Kawasan Strategis Nasional";
$judulWeb = "Sistem Informasi Geografis <br>Pemerintah Kota Salatiga";


//limit default untuk jumlah data pada report

$default_lat = -7.673029999457634;
$default_lon = 110.4313650002114;
$latlonPosition = "49M";
$default_zoom = 11;
$limit=30;
$hal_kanan_kiri = 5; //jumlah halaman sebelum menjadi ...

//parameters
$allowedExtensions = array("gif", "jpeg", "png","jpg","GIF","JPEG","PNG","JPG","pdf","PDF","doc","docx","DOC","DOCX","odt","xls","xlsx","ppt","pptx","zip","ZIP","rar","RAR");
$fileMaxSize = 50000000;



// setting up the web root and server root for
// this shopping cart application
$thisFile = str_replace('\\', '/', __FILE__);
$docRoot = $_SERVER['DOCUMENT_ROOT'];
$srvRoot  = str_replace('library/config.php', '', $thisFile);

$warna["sungai"] = "#2ba8b0";
$warna["jalan"] = "#FF0000";
$warna["kesehatan"] = "green";
$warna["pendidikan"] = "blue";
$warna["saluran_irigasi"] = "#0080FF";
$warna["lingkungan"] = "#008500";

//create query
$qry="web=1";
//$qry.='myScale=$scale';

//if ($_GET['submit'] == "Reload") {
if ($_GET['pola_ruang'] == "1") {
	$qry .= '&pola_ruang=1';
	$pola_ruang = $_GET['pola_ruang'];
}

//always shown
//$pola_ruang = "1";



if ($_GET['kecamatan']!="") {
	$qry .= '&kecamatan='.$_GET['kecamatan'];
	$kecamatan = $_GET['kecamatan'];
}



if ($_GET['peta_jalan']!="") {
	$qry .= '&peta_jalan='.$_GET['peta_jalan'];
	$peta_jalan = $_GET['peta_jalan'];
}

if ($_GET['jembatan']!="") {
	$qry .= '&jembatan='.$_GET['jembatan'];
	$jembatan = $_GET['jembatan'];
}

if ($_GET['sungai']!="") {
	$qry .= '&sungai='.$_GET['sungai'];
	$sungai = $_GET['sungai'];
}

if ($_GET['kesehatan']!="") {
	$qry .= '&kesehatan='.$_GET['kesehatan'];
	$kesehatan = $_GET['kesehatan'];
}

if ($_GET['pendidikan']!="") {
	$qry .= '&pendidikan='.$_GET['pendidikan'];
	$pendidikan = $_GET['pendidikan'];
}


if ($_GET['googleMap']!="") {
	$qry .= '&googleMap='.$_GET['googleMap'];
	$googleMap = $_GET['googleMap'];
}

if ($_GET['gid'] != "") {
	$qry .= '&gid='.$_GET['gid'];
	$gid = $_GET['gid'];
}

if ($_GET['table'] != "") {
	$qry .= '&table='.$_GET['table'];
	$table = $_GET['table'];
}

if ($_GET['peta'] != "") {
	$qry .= '&peta='.$_GET['peta'];
	$peta = $_GET['peta'];
} else if ($_GET['peta'] == "") {
	$qry .= '&peta=administrasi';
	$peta = "administrasi";
}
/*
if ($_GET['jenis_peta'] != "") {
	$qry .= '&jenis_peta='.$_GET['jenis_peta'];
	$jenis_peta = $_GET['jenis_peta'];
} else if ($_GET['jenis_peta'] == "") {
	$qry .= '&jenis_peta=Kependudukan';
	$jenis_peta = "Kependudukan";
}
*/



$pop = 0;

if($peta == "administrasi") {
	$pop = 1;
}



// since all page will require a database access
// and the common library is also used by all
// it's logical to load these library here
require_once 'database.php';
require_once 'common.php';
require_once 'cutstr.php';
require_once 'gPoint.php';

?>
