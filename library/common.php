<?php

function refresh2($url) 
{ 
?> 
<html> 
<head> 
<title>Please wait..</title> 
<meta http-equiv="refresh" content="0"; url="<?php echo $url;?>"> 
</head>
<body> 
<table bgcolor="#5397e9" cellspacing="4" cellpadding="5">
<tr><td><span style="color:white;">
Processing 
</span>
</td></tr>
</table>
</body> 
</html> 
<?php 
} 

//fungsi untuk merefresh halaman
function refresh($url) {
	ob_start();
	//script
	$url="Location:".$url;
	header($url);
	ob_end_flush();
}

//fungsi untuk mengganti koma menjadi titik
function replace_comma($text) {
	$text = str_replace(".","",$text);
	$text2 = str_replace(",",".",$text);
	return $text2;
}

//fungsi untuk mengganti titik menjadi koma
function replace_dot($text) {
	$text2 = number_format($text,2,",",".");
	return $text2;
}

//fungsi untuk memformat angka ke format dua digit di belakang koma
function format_point($text) {
	$text2 = number_format($text,2);
	return $text2;
}

//fungsi untuk cek status login dengan return value boolean
function check_login_stat() {
	 if (isset($_SESSION['1id_user'])) {
	 	return true;
	 }
	 return false;
}

//fungsi untuk cek status login dengan error dan redirect ke halaman login
function check_login() {
    global $webRootAdmin;
	 if (!isset($_SESSION['1id_user'])) {
	 	global $webRootAdmin;
	 	@header("Location: $webRootAdmin");
	 } else if (get_user_log($_SESSION['1id_user']) == false) {
         @header("Location: $webRootAdmin/index.php?logout=1&message=Session habis atau anda login dari komputer lain, silahkan login lagi");
     }
}

function myEncode($str) {
	$str = str_replace("&","~",$str);
	$str = str_replace("=","||",$str);
	return $str;
}

function myDecode($str) {
	$str = str_replace("~","&",$str);
	$str = str_replace("||","=",$str);
	return $str;
}


//fungsi untuk membaca log dari user tertentu
function get_user_log($id_user) {
	$mySes = false;
    $ses_id = session_id();
	
	$sqlg = "select * from log_in where id_user = '".$id_user."' order by last_active desc limit 1";
	//echo $sqlg;
	$resultg = mysql_query($sqlg);
	if ($resultg) {
		if ($rowg = mysql_fetch_array($resultg)) {
            $mySes = true;
            if($ses_id != $rowg['session_id']) {
                $mySes = false;
            }
			//$last_active = $rowg['last_active'];	
            //check now
		}
	}
	return $mySes;
}

//fungsi untuk cek injection pada method post atau get
function check_injection() {
    global $webRoot;
	foreach($_GET as $name => $value) {
		$_GET[$name] = fixup($value);
		//if (fixup($value) == true) {
		//	header("Location: $webRoot/error.php?message=A script/sql injection attempt has been detected, system has logged all of your data!!!");
		//}
	}
	
	foreach($_POST as $name => $value) {
		$_POST[$name] = fixup($value);
		//if (fixup($value) == true) {
		//	header("Location: $webRoot/error.php?message=A script/sql injection attempt has been detected, system has logged all of your data!!!");
		//}
	}
	
	foreach($_REQUEST as $name => $value) {
		$_REQUEST[$name] = fixup($value);
		//if (fixup($value) == true) {
		//	header("Location: $webRoot/error.php?message=A script/sql injection attempt has been detected, system has logged all of your data!!!");
		//}
	}


}

check_injection();

function curPageURL() {
	 $pageURL = 'http';
	 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  //$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	  $pageURL .= getenv('HTTP_HOST').":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  //$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	  $pageURL .= getenv('HTTP_HOST').$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
}

//fungsi untuk mendapatkan host
function getHost($Address) { 
   $parseUrl = parse_url(trim($Address)); 
   return trim($parseUrl[host] ? $parseUrl[host] : array_shift(explode('/', $parseUrl[path], 2))); 
} 

//fungsi untuk cek apabila ada header injection
function check_header_injection() {

	global $webDomain;
	//http://www.alt-php-faq.com/local/115/
	if(!isset($_SERVER['HTTP_USER_AGENT'])){ 
	   die("Forbidden - You are not authorized to view this page"); 
	   exit; 
	} 

	// Make sure the form was indeed POST'ed: 
	if(!$_SERVER['REQUEST_METHOD'] == "POST"){ 
	   die("Forbidden - You are not authorized to view this page"); 
	   exit;     
	} 
	
	
	// Where have we been posted from? 
	
	if($webDomain==trim("localhost")) {
		if(!stristr($_SERVER['HTTP_REFERER'], "localhost")) {
			if ($_SERVER['REQUEST_METHOD'] == "POST") {
				//echo "test";
				header("HTTP/1.0 403 Forbidden"); 
				exit;
			}
		}
	} else {
		if(!stristr($_SERVER['HTTP_REFERER'], $webDomain) && !stristr($_SERVER['HTTP_REFERER'], "localhost")) {
			if ($_SERVER['REQUEST_METHOD'] == "POST") {
				//echo "test";
				header("HTTP/1.0 403 Forbidden"); 
				exit;
			}
		}
	}
	
    
	// Made it past spammer test, free up some memory 
	// and continue rest of script:     
	//unset($k, $v, $v2, $badStrings, $authHosts, $fromArray, $wwwUsed); 
}

//check_header_injection();

//fungsi untuk mereplace karakter tertentu, menghindari injection
function fixup($str)
{
	$str2 = $str;
       $str2 = str_replace("<script", "scri", $str2);
       $str2 = str_replace("</script", "scri", $str2);
       $str2 = str_replace("<SCRIPT", "scri", $str2);
       $str2 = str_replace("</SCRIPT", "scri", $str2);
       //$str2 = str_replace(";", ":", $str2);
       $str2 = str_replace("*", "&#42;", $str2);
       //$str2 = str_replace("-", "&#45;", $str2);
       $str2 = str_replace("%", "&#37;", $str2);
       //$str2 = str_replace("union", "unison", $str2);
       $str2 = str_replace("' or", "or", $str2);
       $str2 = str_replace("'", "&#39;", $str2);
       return $str2;
}

function fixup_gb($str)
{
	//echo $str;
	$str2 = $str;
       $str2 = str_replace("<script", "scri", $str2);
       $str2 = str_replace("</script", "scri", $str2);
       $str2 = str_replace("<SCRIPT", "scri", $str2);
       $str2 = str_replace("</SCRIPT", "scri", $str2);
       $str2 = str_replace(";", "semicolon", $str2);
       $str2 = str_replace("*", "star", $str2);
       $str2 = str_replace("%", "percent", $str2);
       $str2 = str_replace("union", "unison", $str2);
       $str2 = str_replace("' or", "percent", $str2);
       return $str2;
       /*
       if ($str == $str2) {
       		return false;
       } else {
       		return true;
       }
       */
}


//fungsi untuk mendapatkan tanggal sekarang dalam format Indonesia
function get_tanggal() {
    //Array Hari
    $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
    $hari = $array_hari[date('N')];
    //Format Tanggal
    $tanggal = date ('j');
    //Array Bulan
    $array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
    $bulan = $array_bulan[date('n')];
    //Format Tahun
    $tahun = date('Y');
    
    return "$hari, $tanggal $bulan $tahun";
}


//fungsi untuk mereplace \r dengan kode html <br>
function replace_r($a) {
	return str_replace("\r","<br>",$a);
}

//fungsi untuk memperoleh nama user dari id user yang diinputkan
function get_nama_user($id) {
	$nama = "";
	
	$sqlg = "Select username from user where id_user = '".$id."'";
	//echo $sqlg;
	$resultg = mysql_query($sqlg);
	if ($resultg) {
		while ($rowg = mysql_fetch_array($resultg)) {
			$nama = $rowg['username'];	
		}
	}
	return $nama;
}

function get_centroids($gid,$table,$dbstring) {
	$nama = "";
  	
	$centro="the_geom";
	$field_id = "gid";
	if($table == "peta_jalan") {
		$table == "peta_jalan";
		$field_id = "id_jalan";
		$centro="PointN(the_geom,round(NumPoints(the_geom))/2)";
	}
	
	$sqlg = "select astext(".$centro.") as geom from ".$table." where $field_id='".$gid."'";
	//echo $sqlg;
	$result = mysql_query($sqlg);
	if ($result) {
		while ($row = mysql_fetch_array($result)) {
			$nama = $row['geom'];	
		}
	}

	return $nama;
}

function get_centroids_text($kecamatan,$table) {
	$nama = "";
	$table1=$table;
	if($table == "administrasi") {
		$table1 = "kabupaten";
	}
  	
		$sqlg = "select AsText(centroid(the_geom)) as geom from ".$table." where upper(".$table1.")=upper('".$kecamatan."')";
		
		//echo $sqlg;
		$result = mysql_query($sqlg);
		if ($result) {
			while ($row = mysql_fetch_array($result)) {
				$nama = $row['geom'];	
			}
		}
	return $nama;
}

function get_nama_table($id) {
	$nama = "";

  	
		$sqlg = "select nama from daftar_table where id = '$id'";
		$result = mysql_query($sqlg);
		if ($result) {
			while ($row = mysql_fetch_array($result)) {
				$nama = $row['nama'];	
			}
		}
	return $nama;
}

function get_menu($id_menu) {
	$nama = "";

  	
		$sqlg = "select menu_ind from menu where id_menu = '$id_menu'";
		//echo $sqlg;
		$result = mysql_query($sqlg);
		if ($result) {
			while ($row = mysql_fetch_array($result)) {
				$nama = $row['menu_ind'];	
			}
		}
	return $nama;
}

function get_nama_peta($id) {
	$nama = "";

  	
		$sqlg = "select nama from daftar_peta where id = '$id'";
		$result = mysql_query($sqlg);
		if ($result) {
			while ($row = mysql_fetch_array($result)) {
				$nama = $row['nama'];	
			}
		}
	return $nama;
}

function get_komoditas($id) {
	$nama = "";

  	
		$sqlg = "select komoditas from master_komoditas where id_mkomoditas = '$id'";
		$result = mysql_query($sqlg);
		if ($result) {
			while ($row = mysql_fetch_array($result)) {
				$nama = $row['komoditas'];	
			}
		}
	return $nama;
}


function get_geom_from_multiline($geom) {
	$line = str_replace("MULTILINESTRING((","",$geom);
 	$line = str_replace("))","",$line);
 	$line = str_replace("),(",",",$line);
 	//echo $line;
 	$mark = explode(",",$line);
 	return $mark;
}

/*
function get_geom_from_multipolygon($geom) {
	$line = str_replace("MULTIPOLYGON(((","",$geom);
 	$line = str_replace(")))","",$line);
 	//echo $line;
 	$mark = explode(",",$line);
 	return $mark;
}
*/

function get_geom_from_multipolygon($geom) {
	$line = str_replace("MULTIPOLYGON(((","",$geom);
 	$line = str_replace(")))","",$line);
 	$line = str_replace("),(","|",$line);
 	$line = str_replace(")","",$line);
 	$line = str_replace("(","",$line);
 	//echo $line;
 	$mark = explode("|",$line);
 	return $mark;
}

function get_geom_from_polygon($geom) {
	//$line = str_replace("MULTIPOLYGON(((","",$geom);
 	//$line = str_replace(")))","",$line);
 	//$line = str_replace("),(","|",$line);
 	//echo $line;
 	$mark = explode(",",$geom);
 	return $mark;
}


function get_geom_from_point($geom) {
	$line = str_replace("POINT(","",$geom);
 	$line = str_replace(")","",$line);
 	//echo $line;
 	$mark = explode(",",$line);
 	return $mark;
}


function get_nama_jalan($id_jalan) {
	
	$txt="";
	$sql = "select a.nama_jalan from jalan_dasar a where a.id_jalan_dasar='".$id_jalan."'";
	//echo $sql;
	$result = mysql_query($sql);
	if ($result) {
		while ($row = mysql_fetch_array($result)) {
			$txt = $row['nama_jalan'];
		}
	}
	return $txt;
}

function get_kode_jalan($id_jalan) {
	
	$txt="";
	$sql = "select a.kode_jalan from jalan_dasar a where a.id_jalan_dasar='".$id_jalan."'";
	//echo $sql;
	$result = mysql_query($sql);
	if ($result) {
		while ($row = mysql_fetch_array($result)) {
			$txt = $row['kode_jalan'];
		}
	}
	return $txt;
}

function get_id_jalan($id_jalan,$query) {
	
	$txt="";
	$sql = "select a.id_jalan_$query from jalan_$query a where a.id_jalan='".$id_jalan."'";
	//echo $sql;
	$result = mysql_query($sql);
	if ($result) {
		while ($row = mysql_fetch_array($result)) {
			$txt = $row["id_jalan_$query"];
		}
	}
	return $txt;
}

function get_jalan_dasar($gid) {
	global $webFoto;
	$txt = "";
	$sql = "select a.* from jalan_dasar a where a.id_jalan_dasar = '$gid'";
  		
  		//echo $sql;
		$result = mysql_query($sql);
		if($result) {
			$txt .= "<b>Jalan</b>";
			$txt .= "<table class=sample>";
			while ($row = mysql_fetch_array($result)) {
				$txt .= "<tr><td>Nama Jalan</td><td>:</td><td>".$row['nama_jalan']."</td></tr>";
				$txt .= "<tr><td>Kode Jalan</td><td>:</td><td>".$row['kode_jalan']."</td></tr>";
				//$txt .= "<tr><td>Panjang (Pemkot)</td><td>:</td><td>".$row['panjang_versi_pemkot']."</td></tr>";
				$txt .= "<tr><td>Panjang Roll</td><td>:</td><td>".$row['panjang_roll']."</td></tr>";
				//$txt .= "<tr><td>GPS Pangkal</td><td>:</td><td>".$row['gps_pangkal']."</td></tr>";
				//$txt .= "<tr><td>GPS Ujung</td><td>:</td><td>".$row['gps_ujung']."</td></tr>";
				$txt .= "<tr><td>Nama Pangkal</td><td>:</td><td>".$row['nama_pangkal']."</td></tr>";
				$txt .= "<tr><td>Nama Ujung</td><td>:</td><td>".$row['nama_ujung']."</td></tr>";
				$txt .= "<tr><td>Status</td><td>:</td><td>".$row['status']."</td></tr>";
				$txt .= "<tr><td>Sistem</td><td>:</td><td>".$row['sistem']."</td></tr>";
				$txt .= "<tr><td>Fungsi</td><td>:</td><td>".$row['fungsi']."</td></tr>";
				$txt .= "<tr><td>Medan</td><td>:</td><td>".$row['medan']."</td></tr>";
				$txt .= "<tr><td>Kecamatan</td><td>:</td><td>".$row['kecamatan']."</td></tr>";
				$txt .= "<tr><td>Sektor Dominan</td><td>:</td><td>".$row['sektor_dominan']."</td></tr>";
				$txt .= "<tr><td>Kelandaian</td><td>:</td><td>".$row['kelandaian']."</td></tr>";
				$txt .= "<tr><td>Tebal Perkerasan</td><td>:</td><td>".$row['tebal_perkerasan']."</td></tr>";
				$txt .= "<tr><td>Kondisi Umum</td><td>:</td><td>".$row['kondisi_umum']."</td></tr>";
				$txt .= "<tr><td>Jml Jembatan</td><td>:</td><td>".$row['jml_jembatan']."</td></tr>";
				//$txt .= "<tr><td>Sketsa Pangkal</td><td>:</td><td>".$row['sketsa_pangkal']."</td></tr>";
				//$txt .= "<tr><td>Sketsa Ujung</td><td>:</td><td>".$row['sketsa_ujung']."</td></tr>";
				$txt .= "<tr><td>Sketsa Pangkal</td><td>:</td><td>";
				$foto = explode(",",$row['sketsa_pangkal']);
				if ($row['sketsa_pangkal']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br>";
                    }
				}
				$txt .= "</td></tr>";
				$txt .= "<tr><td>Sketsa Ujung</td><td>:</td><td>";
				$foto = explode(",",$row['sketsa_ujung']);
				if ($row['sketsa_ujung']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br>";
                    }
				}

				$txt .= "<tr><td>Foto Pangkal</td><td>:</td><td>";
				$foto = explode(",",$row['foto_awal']);
				if ($row['foto_awal']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br>";
                    }
				}
				$txt .= "</td></tr>";
				$txt .= "<tr><td>Foto Ujung</td><td>:</td><td>";
				$foto = explode(",",$row['foto_ujung']);
				if ($row['foto_ujung']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br>";
                    }
				}
				$txt .= "</td></tr>";
				//$txt .= "<tr><td>Kelurahan</td><td>:</td><td>".$row['kelurahan']."</td></tr>";
				//$txt .= "<tr><td>Kecamatan</td><td>:</td><td>".$row['kecamatan']."</td></tr>";
			}
			$txt .= "</table>";
		}
		return $txt;
}

function get_jalan_bagian($gid) {
	global $webFoto;
	$txt = "";
	$sql = "select a.* from jalan_bagian a where a.id_jalan = '$gid'";
  		
  		//echo $sql;
		$result = mysql_query($sql);
		if($result) {
			$txt .= "<b>Bagian</b>";
			$txt .= "<table class=sample>";
			while ($row = mysql_fetch_array($result)) {
				$txt .= "<tr><td>Nama Jalan</td><td>:</td><td>".$row['nama_jalan']."</td></tr>";
				$txt .= "<tr><td>Kode Jalan</td><td>:</td><td>".$row['kode_jalan']."</td></tr>";
				$txt .= "<tr><td>Rumija</td><td>:</td><td>".$row['rumija']."</td></tr>";
				$txt .= "<tr><td>Rumaja</td><td>:</td><td>".$row['rumaja']."</td></tr>";
				$txt .= "<tr><td>Ruwasja</td><td>:</td><td>".$row['ruwasja']."</td></tr>";
				$txt .= "<tr><td>Lebar Badan Jalan</td><td>:</td><td>".$row['lebar_badan_jalan']."</td></tr>";
				$txt .= "<tr><td>Lebar Jalur</td><td>:</td><td>".$row['lebar_jalur_lalintas']."</td></tr>";
				$txt .= "<tr><td>Lebar Median</td><td>:</td><td>".$row['lebar_median']."</td></tr>";
				$txt .= "<tr><td>Bahan Median</td><td>:</td><td>".$row['bahan_median']."</td></tr>";
				$txt .= "<tr><td>Lebar Ambang Pengaman</td><td>:</td><td>".$row['lebar_ambang_pengaman']."</td></tr>";
				$txt .= "<tr><td>Lebar Pemisah</td><td>:</td><td>".$row['jalur_pemisah_lebar']."</td></tr>";
				$txt .= "<tr><td>Jenis Pemisah</td><td>:</td><td>".$row['jalur_jenis_pemisah']."</td></tr>";
				$txt .= "<tr><td>Bahan Pemisah</td><td>:</td><td>".$row['jalur_bahan_pemisah']."</td></tr>";
				$txt .= "<tr><td>Lebar Bahu (Kanan)</td><td>:</td><td>".$row['bahu_lebar_kanan']."</td></tr>";
				$txt .= "<tr><td>Lebar Bahu (Kiri)</td><td>:</td><td>".$row['bahu_lebar_kiri']."</td></tr>";
				$txt .= "<tr><td>Jenis Bahan Bahu</td><td>:</td><td>".$row['bahu_jenis_bahan']."</td></tr>";
				$txt .= "<tr><td>Lebar Kerb (Kanan)</td><td>:</td><td>".$row['kerb_lebar_kanan']."</td></tr>";
				$txt .= "<tr><td>Lebar Kerb (Kiri)</td><td>:</td><td>".$row['kerb_lebar_kiri']."</td></tr>";
				$txt .= "<tr><td>Jenis Bahan Kerb</td><td>:</td><td>".$row['kerb_jenis_bahan']."</td></tr>";
				$txt .= "<tr><td>Lebar Trotoar (Kanan)</td><td>:</td><td>".$row['trotoar_lebar_kanan']."</td></tr>";
				$txt .= "<tr><td>Lebar Trotoar (Kiri)</td><td>:</td><td>".$row['trotoar_lebar_kiri']."</td></tr>";
				$txt .= "<tr><td>Panjang Trotoar (Kanan)</td><td>:</td><td>".$row['trotoar_panjang_kanan']."</td></tr>";
				$txt .= "<tr><td>Panjang Trotoar (Kiri)</td><td>:</td><td>".$row['trotoar_panjang_kiri']."</td></tr>";
				$txt .= "<tr><td>Jenis Bahan Trotoar</td><td>:</td><td>".$row['trotoar_jenis_bahan']."</td></tr>";
				$txt .= "<tr><td>Lebar Saluran Tepi (Kanan)</td><td>:</td><td>".$row['saluran_tepi_lebar_kanan']."</td></tr>";
				$txt .= "<tr><td>Lebar Saluran Tepi (Kiri)</td><td>:</td><td>".$row['saluran_tepi_lebar_kiri']."</td></tr>";
				$txt .= "<tr><td>Panjang Saluran Tepi (Kanan)</td><td>:</td><td>".$row['saluran_tepi_panjang_kanan']."</td></tr>";
				$txt .= "<tr><td>Panjang Saluran Tepi (Kiri)</td><td>:</td><td>".$row['saluran_tepi_panjang_kiri']."</td></tr>";
				$txt .= "<tr><td>Dalam Saluran Tepi (Kanan)</td><td>:</td><td>".$row['saluran_tepi_dalam_kanan']."</td></tr>";
				$txt .= "<tr><td>Dalam Saluran Tepi (Kiri)</td><td>:</td><td>".$row['saluran_tepi_dalam_kiri']."</td></tr>";
				$txt .= "<tr><td>Jenis Bahan Saluran Tepi</td><td>:</td><td>".$row['saluran_tepi_jenis_bahan']."</td></tr>";
				$txt .= "<tr><td>Bentuk Penampang</td><td>:</td><td>".$row['saluran_tepi_bentuk_penampang']."</td></tr>";
				$txt .= "<tr><td>Tipe</td><td>:</td><td>".$row['saluran_tepi_tipe']."</td></tr>";
				//$txt .= "<tr><td>Kelurahan</td><td>:</td><td>".$row['kelurahan']."</td></tr>";
				//$txt .= "<tr><td>Kecamatan</td><td>:</td><td>".$row['kecamatan']."</td></tr>";
			}
			$txt .= "</table>";
		}
		return $txt;
}

function get_jalan_kondisi($gid) {
	global $webFoto;
	$txt = "";
	$sql = "select a.* from jalan_kondisi a where a.id_jalan = '$gid'";
  		
  		//echo $sql;
		$result = mysql_query($sql);
		if($result) {
			$txt .= "<b>Kondisi</b>";
			$txt .= "<table class=sample>";
			while ($row = mysql_fetch_array($result)) {
				$txt .= "<tr><td>Nama Jalan</td><td>:</td><td>".$row['nama_jalan']."</td></tr>";
				$txt .= "<tr><td>Kode Jalan</td><td>:</td><td>".$row['kode_jalan']."</td></tr>";
				$txt .= "<tr><td>Aspal (Baik)</td><td>:</td><td>".$row['aspal_baik']."</td></tr>";
				$txt .= "<tr><td>Aspal (Rusak Ringan)</td><td>:</td><td>".$row['aspal_rusak_ringan']."</td></tr>";
				$txt .= "<tr><td>Aspal (Rusak Berat)</td><td>:</td><td>".$row['aspal_rusak_berat']."</td></tr>";
				$txt .= "<tr><td>Penetrasi Macadam (Baik)</td><td>:</td><td>".$row['penetrasi_macadam_baik']."</td></tr>";
				$txt .= "<tr><td>Penetrasi Macadam (Rusak Ringan)</td><td>:</td><td>".$row['penetrasi_macadam_rusak_ringan']."</td></tr>";
				$txt .= "<tr><td>Penetrasi Macadam (Rusak Berat)</td><td>:</td><td>".$row['penetrasi_macadam_rusak_berat']."</td></tr>";
				$txt .= "<tr><td>Beton (Baik)</td><td>:</td><td>".$row['beton_baik']."</td></tr>";
				$txt .= "<tr><td>Beton (Rusak Ringan)</td><td>:</td><td>".$row['beton_rusak_ringan']."</td></tr>";
				$txt .= "<tr><td>Beton (Rusak Berat)</td><td>:</td><td>".$row['beton_rusak_berat']."</td></tr>";
				$txt .= "<tr><td>Paving Blok (Baik)</td><td>:</td><td>".$row['paving_blok_baik']."</td></tr>";
				$txt .= "<tr><td>Paving Blok (Rusak Ringan)</td><td>:</td><td>".$row['paving_blok_rusak_ringan']."</td></tr>";
				$txt .= "<tr><td>Paving Blok (Rusak Berat)</td><td>:</td><td>".$row['paving_blok_rusak_berat']."</td></tr>";
				$txt .= "<tr><td>Batu/Kerikil (Baik)</td><td>:</td><td>".$row['batu_kerikil_baik']."</td></tr>";
				$txt .= "<tr><td>Batu/Kerikil (Rusak Ringan)</td><td>:</td><td>".$row['batu_kerikil_rusak_ringan']."</td></tr>";
				$txt .= "<tr><td>Batu/Kerikil (Rusak Berat)</td><td>:</td><td>".$row['batu_kerikil_rusak_berat']."</td></tr>";
				$txt .= "<tr><td>Tanah</td><td>:</td><td>".$row['tanah']."</td></tr>";
				$txt .= "<tr><td>Kondisi Umum (Baik)</td><td>:</td><td>".$row['kondisi_umum_baik']."</td></tr>";
				$txt .= "<tr><td>Kondisi Umum (Rusak Ringan)</td><td>:</td><td>".$row['kondisi_umum_rusak_ringan']."</td></tr>";
				$txt .= "<tr><td>Kondisi Umum (Rusak Berat)</td><td>:</td><td>".$row['kondisi_umum_rusak_berat']."</td></tr>";
				$txt .= "<tr><td>Perkerasan Jalan Eksisting</td><td>:</td><td>".$row['perkerasan_eksisting']."</td></tr>";
				$txt .= "<tr><td>Penanganan Jalan</td><td>:</td><td>".$row['penanganan_jalan']."</td></tr>";
			}
			$txt .= "</table>";
		}
		return $txt;
}

function get_jalan_lalin($gid) {
	global $webFoto;
	$txt = "";
	$sql = "select a.* from jalan_lalin a where a.id_jalan = '$gid'";
  		
  		//echo $sql;
		$result = mysql_query($sql);
		if($result) {
			$txt .= "<b>Lalu Lintas</b>";
			$txt .= "<table class=sample>";
			while ($row = mysql_fetch_array($result)) {
				$txt .= "<tr><td>Nama Jalan</td><td>:</td><td>".$row['nama_jalan']."</td></tr>";
				$txt .= "<tr><td>Kode Jalan</td><td>:</td><td>".$row['kode_jalan']."</td></tr>";
				$txt .= "<tr><td>Jumlah Lajur</td><td>:</td><td>".$row['jumlah_lajur']."</td></tr>";
				$txt .= "<tr><td>Lebar Lajur</td><td>:</td><td>".$row['lebar_lajur']."</td></tr>";
				$txt .= "<tr><td>Tipe</td><td>:</td><td>".$row['tipe']."</td></tr>";
				$txt .= "<tr><td>Kecepatan Aktual (Km/Jam)</td><td>:</td><td>".$row['kecepatan_aktual']."</td></tr>";
				$txt .= "<tr><td>Gangguan Samping</td><td>:</td><td>".$row['gangguan_samping']."</td></tr>";
				$txt .= "<tr><td>GPS Gangguan Samping</td><td>:</td><td>".$row['gps_gangguan_samping']."</td></tr>";
				$txt .= "<tr><td>Pengaturan Lalu Lintas</td><td>:</td><td>".$row['pengaturan']."</td></tr>";
			}
			$txt .= "</table>";
		}
		return $txt;
}

function get_jalan_salteptrotbahu($gid) {
	global $webFoto;
	$txt = "";
	$sql = "select a.* from jalan_salteptrotbahu a where a.id_jalan = '$gid'";
  		
  		//echo $sql;
		$result = mysql_query($sql);
		if($result) {
			$txt .= "<b>Saluran Tepi, Fisik Trotoar, dan Bahu Jalan</b>";
			$txt .= "<table class=sample>";
			while ($row = mysql_fetch_array($result)) {
				$txt .= "<tr><td>Nama Jalan</td><td>:</td><td>".$row['nama_jalan']."</td></tr>";
				$txt .= "<tr><td>Kode Jalan</td><td>:</td><td>".$row['kode_jalan']."</td></tr>";
				$txt .= "<tr><td>Kondisi Saluran Tepi (Baik)</td><td>:</td><td>".$row['kondisi_saluran_tepi_baik']."</td></tr>";
				$txt .= "<tr><td>Kondisi Saluran Tepi (Rusak Ringan)</td><td>:</td><td>".$row['kondisi_saluran_tepi_rusak_ringan']."</td></tr>";
				$txt .= "<tr><td>Kondisi Saluran Tepi (Rusak Berat)</td><td>:</td><td>".$row['kondisi_saluran_tepi_rusak_berat']."</td></tr>";
				$txt .= "<tr><td>Kondisi Fisik Trotoar (Baik)</td><td>:</td><td>".$row['kondisi_fisik_trotoar_baik']."</td></tr>";
				$txt .= "<tr><td>Kondisi Fisik Trotoar (Rusak Ringan)</td><td>:</td><td>".$row['kondisi_fisik_trotoar_rusak_ringan']."</td></tr>";
				$txt .= "<tr><td>Kondisi Fisik Trotoar (Rusak Berat)</td><td>:</td><td>".$row['kondisi_fisik_trotoar_rusak_berat']."</td></tr>";
				$txt .= "<tr><td>Kondisi Bahu Jalan (Baik)</td><td>:</td><td>".$row['kondisi_bahu_jalan_baik']."</td></tr>";
				$txt .= "<tr><td>Kondisi Bahu Jalan (Rusak Ringan)</td><td>:</td><td>".$row['kondisi_bahu_jalan_rusak_ringan']."</td></tr>";
				$txt .= "<tr><td>Kondisi Bahu Jalan (Rusak Berat)</td><td>:</td><td>".$row['kondisi_bahu_jalan_rusak_berat']."</td></tr>";
			}
			$txt .= "</table>";
		}
		return $txt;
}

function get_jembatan($gid) {
	global $webFoto;
	$txt = "";
	$sql = "select a.* from jembatan a where a.gid = '$gid'";
  		
  		//echo $sql;
		$result = mysql_query($sql);
		if($result) {
			$txt .= "<b>Jembatan</b>";
			$txt .= "<table class=sample>";
			while ($row = mysql_fetch_array($result)) {
				$txt .= "<tr><td>Nama Jalan</td><td>:</td><td>".$row['nama_jalan']."</td></tr>";
				$txt .= "<tr><td>Kode Jalan</td><td>:</td><td>".$row['kode_jalan']."</td></tr>";

				$txt .= "<tr><td>Foto</td><td>:</td><td>";
				$foto = explode(",",$row['no_foto']);
				if ($row['no_foto']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br>";
                    }
				}
				$txt .= "</td></tr>";

				$txt .= "<tr><td>Foto 2</td><td>:</td><td>";
				$foto = explode(",",$row['no_foto2']);
				if ($row['no_foto2']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br>";
                    }
				}
				$txt .= "</td></tr>";
				//$txt .= "<tr><td>Kelurahan</td><td>:</td><td>".$row['kelurahan']."</td></tr>";
				//$txt .= "<tr><td>Kecamatan</td><td>:</td><td>".$row['kecamatan']."</td></tr>";
			}
			$txt .= "</table>";
		}
		return $txt;
}
function get_kepala_tab(){
	$txtt="";
	$txtt.='<ul id="myTab" class="nav nav-tabs">
                <li style="list-style-type:none" class="active"> <a href="#umum" data-toggle="tab">Umum</a></li>
                 <li style="list-style-type:none"><a href="#sdm" data-toggle="tab">SDM</a></li>
                <li style="list-style-type:none"><a href="#fasilitas" data-toggle="tab">Fasilitas</a></li>                
               </ul>';
               return $txtt;
}function get_kepala_tab_sdm(){
	$txtt="";
	$txtt.='<ul id="myTab" class="nav nav-tabs">
                <li style="list-style-type:none" class="active"> <a href="#umum" data-toggle="tab">SDM</a></li>
               </ul>';
               return $txtt;
}function get_kepala_tab_kesehatan(){
	$txtt="";
	$txtt.='<ul id="myTab" class="nav nav-tabs">
                <li style="list-style-type:none" class="active"> <a href="#umum" data-toggle="tab">Umum</a></li>
                 <li style="list-style-type:none"><a href="#sdm" data-toggle="tab">Fasilitas</a></li>
                <li style="list-style-type:none"><a href="#fasilitas" data-toggle="tab">Layanan</a></li>                
               </ul>';
               return $txtt;
}function get_kepala_tab_kesehatan_layanan(){
	$txtt="";
	$txtt.='<ul id="myTab" class="nav nav-tabs">
                <li style="list-style-type:none" class="active"> <a href="#umum" data-toggle="tab">Layanan</a></li>
               </ul>';
               return $txtt;
}
function get_kepala_tab_fasilitas(){
	$txtt="";
	$txtt.='<ul id="myTab" class="nav nav-tabs">
                <li style="list-style-type:none" class="active"> <a href="#umum" data-toggle="tab">Fasilitas</a></li>
               </ul>';
               return $txtt;
}
function get_pendidikan($gid) {
	global $webFoto;
	$txt = "";
	$sql = "select a.* from pendidikan a where a.gid = '$gid'";
  		
  		//echo $sql;
		$result = mysql_query($sql);
		if($result) {
			$txt .= "<b>Pendidikan</b>";
			$txt .= "<table class=sample>";
			while ($row = mysql_fetch_array($result)) {
				$txt .= "<tr><td>Nama Sekolah</td><td>:</td><td>".$row['nama_sekolah']."</td></tr>";
				$txt .= "<tr><td>Tingkat Pendidikan</td><td>:</td><td>".$row['tingkat_pendidikan']."</td></tr>";
				$txt .= "<tr><td>Kecamatan</td><td>:</td><td>".$row['kecamatan']."</td></tr>";
				$txt .= "<tr><td>Kelurahan</td><td>:</td><td>".$row['kelurahan']."</td></tr>";
				$txt .= "<tr><td>alamat sekolah</td><td>:</td><td>".$row['alamat_sekolah']."</td></tr>";
				$txt .= "<tr><td>Website sekolah</td><td>:</td><td>".$row['website_sekolah']."</td></tr>";
				$txt .= "<tr><td>Telepon sekolah</td><td>:</td><td>".$row['telepon_sekolah']."</td></tr>";
				$txt .= "<tr><td>Kondisi</td><td>:</td><td>".$row['kondisi']."</td></tr>";
				
				$txt .= "<tr><td>Foto</td><td>:</td><td>";
				$foto = explode(",",$row['no_foto']);
				if ($row['no_foto']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br>";
                    }
				}
				$txt .= "</td></tr>";

				//$txt .= "<tr><td>Kelurahan</td><td>:</td><td>".$row['kelurahan']."</td></tr>";
				//$txt .= "<tr><td>Kecamatan</td><td>:</td><td>".$row['kecamatan']."</td></tr>";
			}
			$txt .= "</table>";
		}
		return $txt;
}
function get_kesehatan($gid) {
	global $webFoto;
	$txt = "";
	$sql = "select a.* from kesehatan a where a.gid = '$gid'";
  		
  		//echo $sql;
		$result = mysql_query($sql);
		if($result) {
			$txt .= "<b>Kesehatan</b>";
			$txt .= "<table class=sample>";
			while ($row = mysql_fetch_array($result)) {
				$txt .= "<tr><td>Nama Puskesmas</td><td>:</td><td>".$row['nama']."</td></tr>";
				$txt .= "<tr><td>Jenis Puskesmas</td><td>:</td><td>".$row['pustu']."</td></tr>";
				$txt .= "<tr><td>Kecamatan</td><td>:</td><td>".$row['kecamatan']."</td></tr>";
				$txt .= "<tr><td>Kelurahan</td><td>:</td><td>".$row['kelurahan']."</td></tr>";
				$txt .= "<tr><td>alamat puskesmas</td><td>:</td><td>".$row['alamat']."</td></tr>";
				$txt .= "<tr><td>Website </td><td>:</td><td>".$row['website']."</td></tr>";
				$txt .= "<tr><td>Telepon </td><td>:</td><td>".$row['telepon']."</td></tr>";
				$txt .= "<tr><td>Email </td><td>:</td><td>".$row['email']."</td></tr>";
				
				$txt .= "<tr><td>Kondisi</td><td>:</td><td>".$row['kondisi']."</td></tr>";
				$txt .= "<tr><td>Luas Lahan Puskesmas</td><td>:</td><td>".$row['luas_lahan_puskesmas']."</td></tr>";
				
				$txt .= "<tr><td>Foto</td><td>:</td><td>";
				$foto = explode(",",$row['no_foto']);
				if ($row['no_foto']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br>";
                    }
				}
				$txt .= "</td></tr>";

				//$txt .= "<tr><td>Kelurahan</td><td>:</td><td>".$row['kelurahan']."</td></tr>";
				//$txt .= "<tr><td>Kecamatan</td><td>:</td><td>".$row['kecamatan']."</td></tr>";
			}
			$txt .= "</table>";
		}
		return $txt;
}
function get_kesehatan_layanan($gid) {
	global $webFoto;
	$txt = "";
	$sql = "select a.* from kesehatan a where a.gid = '$gid'";
  		
  		//echo $sql;
		$result = mysql_query($sql);
		if($result) {
			$txt .= "<b>Kesehatan</b>";
			$txt .= "<table class=sample>";
			while ($row = mysql_fetch_array($result)) {
				$txt .= "<tr><td>Hari Poli Umum</td><td>:</td><td>".$row['hari_poli_umum']."</td><td>Waktu Poli Umum</td><td>:</td><td>".$row['waktu_poli_umum']."</td></tr>";
				$txt .= "<tr><td>Hari Poli Gizi</td><td>:</td><td>".$row['hari_poli_gizi']."</td><td>Waktu Poli Gizi</td><td>:</td><td>".$row['waktu_poli_gizi']."</td></tr>";
				$txt .= "<tr><td>Hari Poli Mata</td><td>:</td><td>".$row['hari_poli_mata']."</td><td>Waktu Poli Mata</td><td>:</td><td>".$row['waktu_poli_mata']."</td></tr>";
				$txt .= "<tr><td>Hari Imunisasi</td><td>:</td><td>".$row['hari_imunisasi']."</td><td>Waktu Imunisasi</td><td>:</td><td>".$row['waktu_imunisasi']."</td></tr>";
				$txt .= "<tr><td>Hari Gawat Darurat</td><td>:</td><td>".$row['hari_gawat_darurat']."</td><td>Waktu Gawat Darurat</td><td>:</td><td>".$row['waktu_gawat_darurat']."</td></tr>";
				$txt .= "<tr><td>Hari Persalinan</td><td>:</td><td>".$row['hari_persalinan']."</td><td>Waktu Persalinan</td><td>:</td><td>".$row['waktu_persalinan']."</td></tr>";
				$txt .= "<tr><td>Pelayanan Lainnya</td><td>:</td><td>".$row['nama_pelayanan_lainnya']."</td><td>Hari</td><td>:</td><td>".$row['hari_pelayanan_lainnya']."</td></td><td>Waktu</td><td>:</td><td>".$row['waktu_pelayanan_lainnya']."</td></tr>";
				
				

				//$txt .= "<tr><td>Kelurahan</td><td>:</td><td>".$row['kelurahan']."</td></tr>";
				//$txt .= "<tr><td>Kecamatan</td><td>:</td><td>".$row['kecamatan']."</td></tr>";
			}
			$txt .= "</table>";
		}
		return $txt;
}
function get_pendidikan_sdm($gid) {
	global $webFoto;
	$txt = "";
	$sql = "select a.* from pendidikan a where a.gid = '$gid'";
  		
  		//echo $sql;
		$result = mysql_query($sql);
		if($result) {
			$txt .= "<b>Pendidikan</b>";
			$txt .= "<table class=sample>";
			while ($row = mysql_fetch_array($result)) {
				$txt .= "<tr><td>Nama Sekolah</td><td>:</td><td>".$row['nama_sekolah']."</td></tr>";
				$txt .= "<tr><td>Tingkat Sekolah</td><td>:</td><td>".$row['tingkat_pendidikan']."</td></tr>";
				$txt .= "<tr><td>jumlah guru</td><td>:</td><td>".$row['jumlah_guru']."</td></tr>";
				$txt .= "<tr><td>jumlah non guru</td><td>:</td><td>".$row['jumlah_non_guru']."</td></tr>";
if($row['tingkat_pendidikan']=='sd'){
$txt .= "<tr><td>jumlah murid kelas I</td><td>:</td><td>".$row['jumlah_murid_i']."</td></tr>";
$txt .= "<tr><td>jumlah murid kelas II</td><td>:</td><td>".$row['jumlah_murid_ii']."</td></tr>";
$txt .= "<tr><td>jumlah murid kelas III</td><td>:</td><td>".$row['jumlah_murid_iii']."</td></tr>";
$txt .= "<tr><td>jumlah murid kelas IV</td><td>:</td><td>".$row['jumlah_murid_iv']."</td></tr>";
$txt .= "<tr><td>jumlah murid kelas V</td><td>:</td><td>".$row['jumlah_murid_v']."</td></tr>";
$txt .= "<tr><td>jumlah murid kelas VI</td><td>:</td><td>".$row['jumlah_murid_vi']."</td></tr>";

}else if($row['tingkat_pendidikan']=='sltp'){
$txt .= "<tr><td>jumlah murid kelas VII</td><td>:</td><td>".$row['jumlah_murid_vii']."</td></tr>";
$txt .= "<tr><td>jumlah murid kelas VIII</td><td>:</td><td>".$row['jumlah_murid_viii']."</td></tr>";
$txt .= "<tr><td>jumlah murid kelas IX</td><td>:</td><td>".$row['jumlah_murid_ix']."</td></tr>";
}else{
$txt .= "<tr><td>jumlah murid kelas X</td><td>:</td><td>".$row['jumlah_murid_x']."</td></tr>";
$txt .= "<tr><td>jumlah murid kelas XI</td><td>:</td><td>".$row['jumlah_murid_xi']."</td></tr>";
$txt .= "<tr><td>jumlah murid kelas XII</td><td>:</td><td>".$row['jumlah_murid_xii']."</td></tr>";

}
				//$txt .= "<tr><td>Kelurahan</td><td>:</td><td>".$row['kelurahan']."</td></tr>";
				//$txt .= "<tr><td>Kecamatan</td><td>:</td><td>".$row['kecamatan']."</td></tr>";
			}
			$txt .= "</table>";
		}
		return $txt;
}function get_kesehatan_fasilitas($gid) {
	global $webFoto;
	$txt = "";
	$sql = "select a.* from kesehatan a where a.gid = '$gid'";
  		
  		//echo $sql;
		$result = mysql_query($sql);
		if($result) {
			$txt .= "<b>Pendidikan</b>";
			$txt .= "<table class=sample>";
			while ($row = mysql_fetch_array($result)) {
				$txt .= "<tr><td>Nama Puskesmas</td><td>:</td><td>".$row['nama']."</td></tr>";
				$txt .= "<tr><td>Jenis Puskesmas</td><td>:</td><td>".$row['pustu']."</td></tr>";

				$txt .= "<tr><td>Jumlah Pustu</td><td>:</td><td>".$row['jumlah_pustu']."</td></tr>";

$txt .= "<tr><td>Gedung Rawat Inap</td><td>:</td><td>".$row['gedung_rawat_inap']."</td><td>";
$foto = explode(",",$row['foto_gedung_rawat_inap']);
				if ($row['foto_gedung_rawat_inap']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Ambulance</td><td>:</td><td>".$row['ambulan']."</td><td>";
$foto = explode(",",$row['foto_ambulan']);
				if ($row['foto_ambulan']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}

$txt .= "<tr><td>Rumah Dokter</td><td>:</td><td>".$row['rumah_dokter']."</td><td>";
$foto = explode(",",$row['foto_rumah_dokter']);
				if ($row['foto_rumah_dokter']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Gedung Obat</td><td>:</td><td>".$row['gudang_obat']."</td><td>";
$foto = explode(",",$row['foto_gudang_obat']);
				if ($row['foto_gudang_obat']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}

$txt .= "<tr><td>Tempat Ibadah</td><td>:</td><td>".$row['tempat_ibadah']."</td><td>";
$foto = explode(",",$row['foto_tempat_ibadah']);
				if ($row['foto_tempat_ibadah']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
				$txt .= "<tr><td>Sarpras</td><td>:</td><td>".$row['sarpras']."</td><td>";
$foto = explode(",",$row['foto_sarpras']);
				if ($row['foto_sarpras']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
				$txt .= "<tr><td>Luas_taman</td><td>:</td><td>".$row['luas_taman']."</td><td>";
$foto = explode(",",$row['foto_taman']);
				if ($row['foto_taman']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
				$txt .= "<tr><td>Luas Lapangan</td><td>:</td><td>".$row['luas_lapangan']."</td><td>";
$foto = explode(",",$row['foto_lapangan']);
				if ($row['foto_lapangan']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
				$txt .= "<tr><td>Luas Tempat parkir</td><td>:</td><td>".$row['luas_tempat_parkir']."</td><td>";
$foto = explode(",",$row['foto_tempat_parkir']);
				if ($row['foto_tempat_parkir']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Luas Ruang terbuka lainnya</td><td>:</td><td>".$row['luas_ruang_terbuka_lainnya']."</td><td>";
$foto = explode(",",$row['foto_ruang_terbuka_lainnya']);
				if ($row['foto_ruang_terbuka_lainnya']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Denah Puskesmas</td><td>:</td><td></td><td>";
$foto = explode(",",$row['gambar_denah_puskesmas']);
				if ($row['gambar_denah_puskesmas']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Foto Lainnya I</td><td>:</td><td></td><td>";
$foto = explode(",",$row['foto_lainnya_1']);
				if ($row['foto_lainnya_1']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
				$txt .= "<tr><td>Foto Lainnya II</td><td>:</td><td></td><td>";
$foto = explode(",",$row['foto_lainnya_2']);
				if ($row['foto_lainnya_2']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
				$txt .= "<tr><td>Foto Lainnya III</td><td>:</td><td></td><td>";
$foto = explode(",",$row['foto_lainnya_3']);
				if ($row['foto_lainnya_3']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Dokumen Tambahan</td><td>:</td><td></td><td>";
$foto = explode(",",$row['dokumen_tambahan']);
				if ($row['dokumen_tambahan']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<a href=".$webRoot."/images/dokumen/".$ft."\">".$ft."</a></td></tr>";
                    }
				}

				//$txt .= "<tr><td>Kelurahan</td><td>:</td><td>".$row['kelurahan']."</td></tr>";
				//$txt .= "<tr><td>Kecamatan</td><td>:</td><td>".$row['kecamatan']."</td></tr>";
			}
			$txt .= "</table>";
		}
		return $txt;
}
function get_pendidikan_fasilitas($gid) {
	global $webFoto;
	$txt = "";
	$sql = "select a.* from pendidikan a where a.gid = '$gid'";
  		
  		//echo $sql;
		$result = mysql_query($sql);
		if($result) {
			$txt .= "<b>Pendidikan</b>";
			$txt .= "<table class=sample>";
			while ($row = mysql_fetch_array($result)) {
				$txt .= "<tr><td>Nama Sekolah</td><td>:</td><td>".$row['nama_sekolah']."</td></tr>";
				$txt .= "<tr><td>Tingkat Sekolah</td><td>:</td><td>".$row['tingkat_pendidikan']."</td></tr>";
if($row['tingkat_pendidikan']=='sd'){
$txt .= "<tr><td>jumlah kelas I</td><td>:</td><td>".$row['jumlah_kelas_i']."</td></tr>";
$txt .= "<tr><td>jumlah kelas II</td><td>:</td><td>".$row['jumlah_kelas_ii']."</td></tr>";
$txt .= "<tr><td>jumlah kelas III</td><td>:</td><td>".$row['jumlah_kelas_iii']."</td></tr>";
$txt .= "<tr><td>jumlah kelas IV</td><td>:</td><td>".$row['jumlah_kelas_iv']."</td></tr>";
$txt .= "<tr><td>jumlah kelas V</td><td>:</td><td>".$row['jumlah_kelas_v']."</td></tr>";
$txt .= "<tr><td>jumlah kelas VI</td><td>:</td><td>".$row['jumlah_kelas_vi']."</td></tr>";

}else if($row['tingkat_pendidikan']=='sltp'){
$txt .= "<tr><td>jumlah kelas VII</td><td>:</td><td>".$row['jumlah_kelas_vii']."</td></tr>";
$txt .= "<tr><td>jumlah kelas VIII</td><td>:</td><td>".$row['jumlah_kelas_viii']."</td></tr>";
$txt .= "<tr><td>jumlah kelas IX</td><td>:</td><td>".$row['jumlah_kelas_ix']."</td></tr>";
}else{
$txt .= "<tr><td>jumlah kelas X</td><td>:</td><td>".$row['jumlah_kelas_x']."</td></tr>";
$txt .= "<tr><td>jumlah kelas XI</td><td>:</td><td>".$row['jumlah_kelas_xi']."</td></tr>";
$txt .= "<tr><td>jumlah kelas XII</td><td>:</td><td>".$row['jumlah_kelas_xii']."</td></tr>";
$txt .= "<tr><td>ruang perpustakaan</td><td>:</td><td>".$row['ruang_perpustakaan']."</td><td>";
$foto = explode(",",$row['foto_perpustakaan']);
				if ($row['foto_perpustakaan']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Ruang lab Komputer</td><td>:</td><td>".$row['ruang_lab_komputer']."</td><td>";
$foto = explode(",",$row['foto_lab_komputer']);
				if ($row['foto_lab_komputer']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Ruang lab Bahasa</td><td>:</td><td>".$row['ruang_lab_bahasa']."</td><td>";
$foto = explode(",",$row['foto_lab_bahasa']);
				if ($row['foto_lab_bahasa']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Ruang lab Fisika</td><td>:</td><td>".$row['ruang_lab_fisika']."</td><td>";
$foto = explode(",",$row['foto_lab_fisika']);
				if ($row['foto_lab_fisika']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Ruang lab Kimia</td><td>:</td><td>".$row['ruang_lab_kimia']."</td><td>";
$foto = explode(",",$row['foto_lab_kimia']);
				if ($row['foto_lab_kimia']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Ruang lab Biologi</td><td>:</td><td>".$row['ruang_lab_biologi']."</td><td>";
$foto = explode(",",$row['foto_lab_biologi']);
				if ($row['foto_lab_biologi']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Ruang Musik</td><td>:</td><td>".$row['ruang_musik']."</td><td>";
$foto = explode(",",$row['foto_musik']);
				if ($row['foto_musik']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
				$txt .= "<tr><td>Tempat Ibadah</td><td>:</td><td>".$row['tempat_ibadah']."</td><td>";
$foto = explode(",",$row['foto_tempat_ibadah']);
				if ($row['foto_tempat_ibadah']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Kantin</td><td>:</td><td>".$row['kantin']."</td><td>";
$foto = explode(",",$row['foto_kantin']);
				if ($row['foto_kantin']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>UKS</td><td>:</td><td>".$row['uks']."</td><td>";
$foto = explode(",",$row['foto_uks']);
				if ($row['foto_uks']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Fasilitas Lainnya</td><td>:</td><td>".$row['fasilitas_lainnya']."</td><td>";
$foto = explode(",",$row['foto_fasilitas_lainnya']);
				if ($row['foto_fasilitas_lainnya']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Luas Taman</td><td>:</td><td>".$row['luas_taman']."</td><td>";
$foto = explode(",",$row['no_foto_taman']);
				if ($row['no_foto_taman']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Luas Lapangan</td><td>:</td><td>".$row['luas_lapangan']."</td><td>";
$foto = explode(",",$row['no_foto_lapangan']);
				if ($row['no_foto_lapangan']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Luas Tempat parkir</td><td>:</td><td>".$row['luas_tempat_parkir']."</td><td>";
$foto = explode(",",$row['no_foto_tempat_parkir']);
				if ($row['no_foto_tempat_parkir']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Luas Ruang terbuka lainnya</td><td>:</td><td>".$row['luas_ruang_terbuka_lainnya']."</td><td>";
$foto = explode(",",$row['no_foto_ruang_terbuka_lainnya']);
				if ($row['no_foto_ruang_terbuka_lainnya']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Denah Sekolah</td><td>:</td><td></td><td>";
$foto = explode(",",$row['gambar_denah_sekolah']);
				if ($row['gambar_denah_sekolah']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Foto Lainnya I</td><td>:</td><td></td><td>";
$foto = explode(",",$row['foto_lainnya_1']);
				if ($row['foto_lainnya_1']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
				$txt .= "<tr><td>Foto Lainnya II</td><td>:</td><td></td><td>";
$foto = explode(",",$row['foto_lainnya_2']);
				if ($row['foto_lainnya_2']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
				$txt .= "<tr><td>Foto Lainnya III</td><td>:</td><td></td><td>";
$foto = explode(",",$row['foto_lainnya_3']);
				if ($row['foto_lainnya_3']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br></td></tr>";
                    }
				}
$txt .= "<tr><td>Dokumen Tambahan</td><td>:</td><td></td><td>";
$foto = explode(",",$row['dokumen_tambahan']);
				if ($row['dokumen_tambahan']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<a href=".$webRoot."/images/dokumen/".$ft."\">".$ft."</a></td></tr>";
                    }
				}

}
				//$txt .= "<tr><td>Kelurahan</td><td>:</td><td>".$row['kelurahan']."</td></tr>";
				//$txt .= "<tr><td>Kecamatan</td><td>:</td><td>".$row['kecamatan']."</td></tr>";
			}
			$txt .= "</table>";
		}
		return $txt;
}

function get_jembatan_list($gid) {
	global $webFoto;
	$txt = "";
	$sql = "select a.* from jembatan a where a.id_jalan = '$gid'";
  		
  		//echo $sql;
		$result = mysql_query($sql);
		if($result) {
			$txt .= "<b>Jembatan</b>";
			$txt .= "<table class=sample>";
			$txt .= "<tr><th>Nama Jalan</th><th>Kode Jalan</th><th>Foto</th><th>Foto 2</th></tr>";
			while ($row = mysql_fetch_array($result)) {
				$txt .= "<tr><td>".$row['nama_jalan']."</td>";
				$txt .= "<td>".$row['kode_jalan']."</td>";

				$txt .= "<td>";
				$foto = explode(",",$row['no_foto']);
				if ($row['no_foto']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br>";
                    }
				}
				$txt .= "</td>";

				$txt .= "<td>";
				$foto = explode(",",$row['no_foto2']);
				if ($row['no_foto2']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br>";
                    }
				}
				$txt .= "</td></tr>";
				//$txt .= "<tr><td>Kelurahan</td><td>:</td><td>".$row['kelurahan']."</td></tr>";
				//$txt .= "<tr><td>Kecamatan</td><td>:</td><td>".$row['kecamatan']."</td></tr>";
			}
			$txt .= "</table>";
		}
		return $txt;
}

function get_pembangunan($gid) {
	global $webFoto;
	$txt = "";
	$sql = "select a.* from pembangunan a where a.id_pembangunan = '$gid'";
  		
  		//echo $sql;
		$result = mysql_query($sql);
		if($result) {
			$txt .= "<b>Pembangunan</b>";
			$txt .= "<table class=sample>";
			while ($row = mysql_fetch_array($result)) {
				$txt .= "<tr><td>Nama Jalan</td><td>:</td><td>".$row['nama_jalan']."</td></tr>";
				$txt .= "<tr><td>Kode Jalan</td><td>:</td><td>".$row['kode_jalan']."</td></tr>";
				$txt .= "<tr><td>Program Tahun</td><td>:</td><td>".$row['program_tahun']."</td></tr>";
				$txt .= "<tr><td>No Kegiatan</td><td>:</td><td>".$row['no_kegiatan']."</td></tr>";
				$txt .= "<tr><td>Lokasi</td><td>:</td><td>".$row['lokasi']."</td></tr>";
				$txt .= "<tr><td>Jenis Kegiatan</td><td>:</td><td>".$row['jenis_kegiatan']."</td></tr>";
				$txt .= "<tr><td>Volume</td><td>:</td><td>".$row['volume']."</td></tr>";
				$txt .= "<tr><td>Unit</td><td>:</td><td>".$row['unit']."</td></tr>";
				$txt .= "<tr><td>STA Awal</td><td>:</td><td>".$row['sta_awal']."</td></tr>";
				$txt .= "<tr><td>STA Akhir</td><td>:</td><td>".$row['sta_akhir']."</td></tr>";
				$txt .= "<tr><td>Biaya</td><td>:</td><td>".$row['biaya']."</td></tr>";
				$txt .= "<tr><td>Dana Pendamping</td><td>:</td><td>".$row['dana_pendamping']."</td></tr>";
				$txt .= "<tr><td>Sumber Dana</td><td>:</td><td>".$row['sumber_dana']."</td></tr>";
				$txt .= "<tr><td>PPKOM</td><td>:</td><td>".$row['ppkom']."</td></tr>";
				$txt .= "<tr><td>Bendahara Pengeluaran Pembantu</td><td>:</td><td>".$row['bendahara_pengeluaran_pembantu']."</td></tr>";
				$txt .= "<tr><td>Ketua Pejabat Pengadaan</td><td>:</td><td>".$row['ketua_pejabat_pengadaan']."</td></tr>";
				$txt .= "<tr><td>Sekretaris Pejabat Pengadaan</td><td>:</td><td>".$row['sekretaris_pejabat_pengadaan']."</td></tr>";
				$txt .= "<tr><td>Anggota 1 Pejabat Pengadaan</td><td>:</td><td>".$row['anggota_satu_pejabat_pengadaan']."</td></tr>";
				$txt .= "<tr><td>Anggota 2 Pejabat Pengadaan</td><td>:</td><td>".$row['anggota_dua_pejabat_pengadaan']."</td></tr>";
				$txt .= "<tr><td>Anggota 3 Pejabat Pengadaan</td><td>:</td><td>".$row['anggota_tiga_pejabat_pengadaan']."</td></tr>";
				$txt .= "<tr><td>Pengawas Lapangan</td><td>:</td><td>".$row['pengawas_lapangan']."</td></tr>";
				$txt .= "<tr><td>Ketua Panitia Penerima Hasil Pekerjaan</td><td>:</td><td>".$row['ketua_panitia_penerima_hasil_pekerjaan']."</td></tr>";
				$txt .= "<tr><td>Sekretaris Panitia Penerima Hasil Pekerjaan</td><td>:</td><td>".$row['sekretaris_panitia_penerima_hasil_pekerjaan']."</td></tr>";
				$txt .= "<tr><td>Anggota Panitia Penerima Hasil Pekerjaan</td><td>:</td><td>".$row['anggota_panitia_penerima_hasil_pekerjaan']."</td></tr>";
				$txt .= "<tr><td>Nama Penyedia Jasa</td><td>:</td><td>".$row['nama_penyedia_jasa']."</td></tr>";
				$txt .= "<tr><td>Alamat Penyedia Jasa</td><td>:</td><td>".$row['alamat_penyedia_jasa']."</td></tr>";
				$txt .= "<tr><td>Kab/Kota Penyedia Jasa</td><td>:</td><td>".$row['kab_kota_penyedia_jasa']."</td></tr>";
				$txt .= "<tr><td>NPWP Penyedia Jasa</td><td>:</td><td>".$row['npwp_penyedia_jasa']."</td></tr>";
				$txt .= "<tr><td>Metode Pelaksanaan</td><td>:</td><td>".$row['metode_pelaksanaan']."</td></tr>";
				$txt .= "<tr><td>No Kontrak</td><td>:</td><td>".$row['no_kontrak']."</td></tr>";
				$txt .= "<tr><td>Tanggal Kontrak</td><td>:</td><td>".$row['tgl_kontrak']."</td></tr>";
				$txt .= "<tr><td>Nilai Kontrak</td><td>:</td><td>".$row['nilai_kontrak']."</td></tr>";
				$txt .= "<tr><td>No SPMK</td><td>:</td><td>".$row['no_spmk']."</td></tr>";
				$txt .= "<tr><td>Tgl Mulai SPMK</td><td>:</td><td>".$row['tgl_mulai_spmk']."</td></tr>";
				$txt .= "<tr><td>Tgl Selesai SPMK</td><td>:</td><td>".$row['tgl_selesai_spmk']."</td></tr>";
				$txt .= "<tr><td>Jangka Waktu Pelaksanaan SPMK</td><td>:</td><td>".$row['jangka_waktu_pelaksanaan_spmk']."</td></tr>";
				$txt .= "<tr><td>Pimpro PTK</td><td>:</td><td>".$row['pimpro_ptk']."</td></tr>";
				$txt .= "<tr><td>Tahun Pembangunan Perkerasan</td><td>:</td><td>".$row['tahun_pembangunan_perkerasan']."</td></tr>";
				$txt .= "<tr><td>Tahun Perbaikan Terakhir</td><td>:</td><td>".$row['tahun_perbaikan_terakhir']."</td></tr>";
				$txt .= "<tr><td>Tgl Perubahan Data</td><td>:</td><td>".$row['tgl_perubahan_data']."</td></tr>";
				$txt .= "<tr><td>Uraian Pekerjaan</td><td>:</td><td>".$row['uraian_pekerjaan']."</td></tr>";

				/*
				$txt .= "<tr><td>Foto</td><td>:</td><td>";
				$foto = explode(",",$row['no_foto']);
				if ($row['no_foto']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br>";
                    }
				}
				$txt .= "</td></tr>";

				$txt .= "<tr><td>Foto 2</td><td>:</td><td>";
				$foto = explode(",",$row['no_foto2']);
				if ($row['no_foto2']!="") {
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        $txt .= "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br>";
                    }
				}
				$txt .= "</td></tr>";
				*/
				//$txt .= "<tr><td>Kelurahan</td><td>:</td><td>".$row['kelurahan']."</td></tr>";
				//$txt .= "<tr><td>Kecamatan</td><td>:</td><td>".$row['kecamatan']."</td></tr>";
			}
			$txt .= "</table>";
		}
		return $txt;
}

function get_pembangunan_list($gid) {
	global $webFoto;
	$txt = "";
	$sql = "select a.* from pembangunan a where a.id_jalan = '$gid' and deleted = 0";
  		
  		//echo $sql;
		$result = mysql_query($sql);
		if($result) {
			$txt .= "<b>Pembangunan</b>";
			$txt .= "<table class=sample>";
			$txt .= "<tr><th>Nama Jalan</th><th>Kode Jalan</th><th>Program Tahun</th><th>Lokasi</th><th>Jenis Kegiatan</th></tr>";
			while ($row = mysql_fetch_array($result)) {
				$txt .= "<tr><td>".$row['nama_jalan']."</td>";
				$txt .= "<td>".$row['kode_jalan']."</td>";
				$txt .= "<td>".$row['program_tahun']."</td>";
				$txt .= "<td>".$row['lokasi']."</td>";
				$txt .= "<td>".$row['jenis_kegiatan']."</td></tr>";

				
			}
			$txt .= "</table>";
		}
		return $txt;
}

function get_desa_popup($gid,$table,$legend) {
	global $webFoto;
	$txt="";
	if($table=="peta_jalan" || $table=="jalan_dasar") {
  		$txt = get_jalan_dasar($gid);

  		$txt .= "<br>".get_jalan_bagian($gid);
  		$txt .= "<br>".get_jalan_kondisi($gid);
  		$txt .= "<br>".get_jalan_lalin($gid);
  		$txt .= "<br>".get_jalan_salteptrotbahu($gid);
  		$txt .= "<br>".get_pembangunan_list($gid);

	} else if($table=="jembatan") {
  		$txt = get_jembatan($gid);

	} else if($table=="kesehatan") {
  		$txt = get_kesehatan($gid);

	} else if($table=="pendidikan") {
  		$txt = get_pendidikan($gid);

	} else if($table=="administrasis") {
  		$sql = "select a.* from administrasi a where a.gid = '$gid'";
		//echo $sql;
		$result = mysql_query($sql);
		if ($result) {
			if($legend!=1) {
				//$txt.="var table_pola = '$table'\n";
			}
			$txt = "<table class=sample>";
			$count = 0;
			while ($row = mysql_fetch_array($result)) {
				if($count == 0) {
					$txt .= "<tr><td><b>Kabupaten/ Kota:</b></td><td>".$row['kabupaten']."</td></tr>";
				}
				
				$count++;
			}
			if($legend!=1) {
				$txt .= "</ul></td></tr><tr><td colspan='2' align='center'><a href=javascript:makeRequest('getLegend.php','?gid=$gid&table=$table','ketLegend');>Info</a></td></tr></table>";
			} else {
				$txt .= "</ul></td></tr></table>";
			}
		}
	}
	
	return $txt;
}

function get_pola_ruang_desc($gid) {
	global $webFoto;
	$txt="";
		$sql = "select l.*, a.aturan from pola_ruang l, master_rtgl a where a.rtgl = l.rtgl and l.gid='".$gid."'";
		//echo $sql;
		$result = mysql_query($sql);
		if ($result) {
			while ($row = mysql_fetch_array($result)) {
				
				//$txt=$row['gid']."<br>";
				$txt=$txt."<b>Pola Ruang</b><br>";
				$txt .= "<table class=\"sample\"><tr><th>RTGL</td><td>".$row['rtgl']."</td></tr><tr><th>Desa/Kelurahan</td><td>".$row['desa_klrhn']."</td></tr><tr><th>Kecamatan</td><td>".$row['kecamatan']."</td></tr></table><br><table><tr><td><h3>Aturan</h3></td></tr><tr><td>".$row['aturan']."</td></tr></table>";
			}
		}
	return $txt;
}

//fungsi untuk mendapatkan daftar instruktur berdasarkan modul
function get_instruktur($id) {
	$nama = "";
	
	$sqlg = "Select a.nama_instruktur,a.perusahaan from instruktur a, modul_instruktur b where b.id_modul = '".$id."' and a.id_instruktur = b.id_instruktur";
	//echo $sqlg;
    $nama = "<ul>";
	$resultg = mysql_query($sqlg);
	if ($resultg) {
		while ($rowg = mysql_fetch_array($resultg)) {
			$nama .= "<li>".$rowg['nama_instruktur'].", ".$rowg['perusahaan']."</li>";	
		}
	}
    $nama .= "</ul>";
	return $nama;
}

//fungsi untuk mendapatkan level dengan id tertentu
function get_level($id) {
	$nama = "";
	
	$sqlg = "Select level from level where id_level = '".$id."'";
	//echo $sqlg;
	$resultg = mysql_query($sqlg);
	if ($resultg) {
		while ($rowg = mysql_fetch_array($resultg)) {
			$nama = $rowg['level'];	
		}
	}
	return $nama;
}

function getShoutBox() {
    global $webRoot;
    //promo
	$sql = "select a.*, day(inserted) as tgl, month(inserted) as bln from shoutbox a where deleted=0 and sepakat = 1 order by inserted desc";
	$sql=$sql." limit 50";

	$result3 = mysql_query($sql);
	$content = "";
	if ($result3) {
	    echo "<br><div id=\"shoutBoxTitle\"><center>Komentar</center></div><div id=\"shoutBox\">";
	    echo "<table style=\"font-size:9px\">";
		while ($row3 = mysql_fetch_array($result3)) {
			echo "<tr><td><span style=\"color:red;\">".$row3['tgl']."/".$row3['bln'].":</span> ".$row3['comment']." (".$row3['name'].")</td></tr>";
		}
		echo "</table></div>";
		echo "<div id=\"shoutBoxTitle\"><span style=\"font-size:10px;float:left;\">klik <a href=\"javascript:toggleEdit('./frame.php','?id_inventaris=".$row3['id_inventaris']."','floatdiv');\">disini</a> untuk mengisi</span></div><br>";
	}

}


//fungsi untuk cek ekstensi file
function isAllowedExtension($fileName,$allowedExtensions) {
  return in_array(end(explode(".", $fileName)), $allowedExtensions);
}

//fungsi untuk memperoleh ekstensi file
function get_file_extension($file_name) {
    return substr(strchr($file_name,'.'),1);
}

//fungsi untuk mengupload dokumen ke folder modul
function upload_dokumen($tag) {
 	$teks="";
 	if ($_FILES[$tag]["tmp_name"]!="") {
 	
 			 global $allowedExtensions;
 			 global $fileMaxSize;
 			 global $webRoot;
 			 global $webModul;
             global $modulFolder;
 			 
			if (isAllowedExtension($_FILES[$tag]["name"],$allowedExtensions) && ($_FILES[$tag]["size"] < $fileMaxSize))
			  {
				if ($_FILES[$tag]["error"] > 0) {
					$teks = "Error: " . $_FILES["file"]["error"] . "<br />";
				} else {
					$teks= md5(time()."_".$_FILES[$tag]["name"]).".".get_file_extension($_FILES[$tag]["name"]);
					move_uploaded_file($_FILES[$tag]["tmp_name"], "../..".$modulFolder."/".$teks);
				}
			  } else {
					$teks =  $_FILES[$tag]["name"]." Unsupported file<br>";
			  }
	}
	return $teks;
 }
 
 //fungsi untuk mengupload foto ke folder images/news
function upload_foto($tag) {
 	$teks="";
 	if ($_FILES[$tag]["tmp_name"]!="") {
 	
 			 global $allowedExtensions;
 			 global $fileMaxSize;
 			 global $webRoot;
 			 global $webModul;
             global $modulFolder;
             global $webFotoFolder;
 			 
			if (isAllowedExtension($_FILES[$tag]["name"],$allowedExtensions) && ($_FILES[$tag]["size"] < $fileMaxSize))
			  {
				if ($_FILES[$tag]["error"] > 0) {
					$teks = "Error: " . $_FILES["file"]["error"] . "<br />";
				} else {
					$teks= md5(time()."_".$_FILES[$tag]["name"]).".".get_file_extension($_FILES[$tag]["name"]);
					move_uploaded_file($_FILES[$tag]["tmp_name"], "..".$webFotoFolder."/".$teks);
				}
			  } else {
					$teks =  $_FILES[$tag]["name"]." Unsupported file<br>";
			  }
	}
	return $teks;
 }

function getContent($string)
	{
		$post=explode(" ", $string);
		for ($i=0; $i < 40; $i++) { 
			echo $post[$i]." ";
		}
	}

?>