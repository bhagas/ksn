 <SCRIPT LANGUAGE="JavaScript">
	function changePos(form) {
    	var posLat = form.posLat.value;
    	var posLon = form.posLon.value;
    	var format = form.formatKoord.options[form.formatKoord.selectedIndex].value;
    	//alert(format);
    	if(posLat!="" && posLon!="") {
	    	if(format == 'UTM') {
	    		posLat = parseFloat (posLat);
	    		posLon = parseFloat (posLon);
	    		var latlon = new Array(2);
	    		var zone = 49;
	    		var southhemi = true;
	    		UTMXYToLatLon(posLat, posLon, zone, southhemi, latlon);
	    		posLon = RadToDeg(latlon[1]);
	    		posLat = RadToDeg(latlon[0]);
	    	}

	    	//alert ("You typed: " + TestVar);
	    	top.frames['mapFrame'].goPos(posLon,posLat);
	    	makeRequest('getPos.php', '?posLat='+posLat+'&posLon='+posLon , 'posLegend');
		} else {
			alert("Lat dan Lon tidak boleh kosong!");    	
		}
	}
	function callLegend(url,query,span) {
		makeRequest(url, query , span);
	}
	
	if(navigator.geolocation)
	{
	  navigator.geolocation.getCurrentPosition(function(position)
	    {
	      var lat = position.coords.latitude;
	      var lng = position.coords.longitude;
	      //doSomething();
	      //alert (lat);
	      if(lat && lng) {
	      	document.getElementById('posLat').value = lat;
	      	document.getElementById('posLon').value = lng;
	      }

	    });
	}
	function submitGoogleForm() {
		//alert(document.getElementById("google_on").value);
    	document.form_att.submit();
    	//$("#form_setting").submit();
	}

		
</SCRIPT>
<div style="position:absolute;top:12px;width:100%;font-size:11px;">
<table align="center"><tr><td align="center">
	<!--<div id="mapTitle">
    	<br><center><b style="font-size:14px;color:#003a6b;padding-bottom:5px;margin-bottom: 0.5em;border-bottom: 1px solid #fcb100;">Peta <?php echo get_nama_peta($peta)?></b></center></br>
    </div>-->
	<div id="leftLegend">
	<?php
		//if((stristr(curPageURL(), "peta_setup.php") == false)) {
		if($_GET['web'] != "a1") {
	?>
			<table align="center">
				<tr>
					<td style="padding:2px;"><input type="image" src="<?php echo $webRoot?>/images/setting.jpeg" name="setting" width="20px" height="20px" onClick="javascript:toggle('divSetting')"></td>
					<td style="padding:2px;border-left:1px solid #E0E0E0;"><input type="image" src="<?php echo $webRoot?>/images/position.jpeg" name="setting" width="20px" height="20px" onClick="javascript:toggle('divMyPos')"></td>
					<td style="padding:2px;border-right:1px solid #E0E0E0;border-left:1px solid #E0E0E0;"><input type="image" src="<?php echo $webRoot?>/images/reset.jpeg" name="reset" width="20px" height="20px" onClick="javascript:window.top.location.href = 'peta.php';"></td>
					<td style="padding:2px;"><input type="image" src="<?php echo $webRoot?>/images/print.jpeg" name="print" width="20px" height="20px" onCLick="javascript:void(parent.mapFrame.processPrint('printKec',''));return false;"></td>
				</tr>
			</table>
	<?php
		}
	?>
		<div id="divMyPos" style="display:none;">
			<br><br>
			<form name="form_pos" action="" method="get">
			<table class="sample" width="100%">
				<tr>
					<td>
						<br><b>Masukkan koordinat posisi anda:</b><br><br>
						Format Koordinat:<br><select name="formatKoord"><option value="desimal">Desimal</option><option value="UTM">UTM</option></select><br>
						Longitude:<br><input type="text" name="posLon" id="posLon" value="<?php echo $posLon?>"><br>
						Latitude:<br><input type="text" name="posLat" id="posLat" value="<?php echo $posLat?>">
						<br><input type="Submit" value="Lihat di Peta" name="submit" onClick="javascript:changePos(this.form);return false;">
						<br>
						<div id="posLegend">
						</div>
					</td>
				</tr>
			</table>
			</form>
		</div>
		<br>
		<div id="divSetting" style="display:block;">
			<form name="form_att" id="form_setting" action="peta.php" method="get" target="_top">
			<table class="sample" width="100%">
			<tr><td>
				<input type="hidden" name="gid" value="<?php echo $gid?>">
				<input type="hidden" name="table" value="<?php echo $table?>">
				<input type="hidden" name="keyword" value="<?php echo $keyword?>">
				<input type="hidden" name="search" value="<?php echo $search?>">
				
				<?php
				/*
				?>
				<b>Kecamatan:</b><br>
				<select name="kecamatan" style="height:20px;width:150px;">
				<option value="">Semua Kecamatan</option>
				<?php
					$sql = "select distinct(kecamatan) from administrasi where the_geom<>'' and kecamatan<>'' order by kecamatan";
					//echo $sql;
					$result = mysql_query($dbh, $sql);
					if ($result) {
						while ($row = mysql_fetch_array($result)) {
							echo "<option value=\"".$row['kecamatan']."\"";
							if ($kecamatan==$row['kecamatan']) {
								echo " selected";
							}
							echo ">".$row['kecamatan']."</option>";
						}
					}
				?>
				</select>
				
				<b>Peta:</b><br>
					<select name="peta" id="peta" style="height:20px;width:150px;" onChange="javascript:makeRequest('getPola.php','?peta='+document.getElementById('peta').value,'divPola');">
					<option value=''>Pilih Peta</option>
					<?php
						$sql = "select * from daftar_peta order by urut";
						//echo $sql;
						$result = mysql_query($sql);
						if ($result) {
							while ($row = mysql_fetch_array($result)) {
								echo "<option value=\"".$row['id']."\"";
								if ($peta==$row['id']) {
									echo " selected";
								}
								echo ">".$row['nama']."</option>";
							}
						}
					?>
					</select>
				
				<div id="divPola">
					<?php
					if($peta=="kesesuaian_lahan") {
					?>
					<b>Komoditas:</b><br>
					<select name="id_mkomoditas" style="height:50px;width:150px;">
					<?php
						$sql = "select id_mkomoditas,komoditas from master_komoditas where deleted = 0 order by komoditas";
						//echo $sql;
						$result = mysql_query($sql);
						if ($result) {
							while ($row = mysql_fetch_array($result)) {
								echo "<option value=\"".$row['id_mkomoditas']."\"";
								if($id_mkomoditas == $row['id_mkomoditas']) {
									echo " selected";
								}
								echo ">".$row['komoditas']."</option>";
							}
						}
					?>
					</select>
					<?php
					}
					?>
				</div>
				<?php
				*/
				?>
				<br>
				<b>Kecamatan:</b><br>
				<select name="kecamatan" style="height:20px;width:150px;" onChange="this.form.submit();">
				<option value="">Semua Kecamatan</option>
				<?php
					$sql = "select distinct(kecamatan) from ar_batas_kecamatan where the_geom<>'' and kecamatan<>'' order by kecamatan";
					//echo $sql;
					$result = mysql_query($sql);
					if ($result) {
						while ($row = mysql_fetch_array($result)) {
							echo "<option value=\"".$row['kecamatan']."\"";
							if ($kecamatan==$row['kecamatan']) {
								echo " selected";
							}
							echo ">".$row['kecamatan']."</option>";
						}
					}
				?>
				</select>
				
			</td></tr>
			<tr><td>
				<?php
					$display = "none";
					$displayFungsi = "none";
					if ($peta=="fasum" || $peta=="infrastruktur" || $peta=="sda" || $peta=="") {
						$display ="block";
					}
					if ($peta=="fasum" || $peta=="") {
						$displayFungsi = "block";
					}
					if((stristr(curPageURL(), "peta_setup.php") == true)) {
						$buttonText = "Refresh Peta";
					} else {
						$buttonText = "Reload";
					}
					
				?>
				
				
				
			</td><tr>
			<tr>
			<td>
				<div id="mapLayer" style="font-size:11px;">
					<br><b>Informasi yang ditampilkan:</b><br><br>
				<?php
					/*
					$sql = "select * from daftar_table where urut <> 0 and id<>'pola_ruang' order by urut";
					$result = mysql_query($sql);
					if($result) {
						while($rowT = mysql_fetch_array($result)) {
							echo "<input type=\"checkbox\" name=\"".$rowT['id']."\" value=\"1\"";
							if ($_GET[$rowT['id']] == "1") {
								echo " checked";
							}
							echo ">".$rowT['nama_pendek']."<br>\r";
						}
					}
					
					*/
					/*
					echo "<input type=\"checkbox\" name=\"bangunan\" value=\"1\"";
					if ($_GET['bangunan'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','bangunan');\">Bangunan&nbsp;&nbsp;\r";
					echo "<br>";

					echo "<input type=\"checkbox\" name=\"sumber_air\" value=\"1\"";
					if ($_GET['sumber_air'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','sumber_air');\">Sumber Air&nbsp;&nbsp;\r";
					echo "<br>";

					echo "<input type=\"checkbox\" name=\"bendung\" value=\"1\"";
					if ($_GET['bendung'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','bendung');\">Bendung&nbsp;&nbsp;\r";
					echo "<br>";

					echo "<input type=\"checkbox\" name=\"kondisi\" value=\"1\"";
					if ($_GET['kondisi'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','kondisi');\">Kondisi&nbsp;&nbsp;\r";
					echo "<br>";

					echo "<input type=\"checkbox\" name=\"saluran_irigasi\" value=\"1\"";
					if ($_GET['saluran_irigasi'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','saluran_irigasi');\">Saluran Irigasi&nbsp;&nbsp;\r";
					echo "<br>";
					*/
					echo "<input type=\"checkbox\" name=\"jalan\" value=\"1\"";
					if ($_GET['jalan'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','jalan');\">Jalan&nbsp;&nbsp;\r";
					echo "<br>";
					echo "<input type=\"checkbox\" name=\"deliniasi\" value=\"1\"";
					if ($_GET['deliniasi'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','deliniasi');\">Deliniasi&nbsp;&nbsp;\r";
					echo "<br>";
					echo "<input type=\"checkbox\" name=\"jalur_evakuasi\" value=\"1\"";
					if ($_GET['jalur_evakuasi'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','jalur_evakuasi');\">jalur_evakuasi&nbsp;&nbsp;\r";
					echo "<br>";
					echo "<input type=\"checkbox\" name=\"sungai\" value=\"1\"";
					if ($_GET['sungai'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','sungai');\">Sungai&nbsp;&nbsp;\r";
					echo "<br>";
					echo "<input type=\"checkbox\" name=\"rencana_energi\" value=\"1\"";
					if ($_GET['rencana_energi'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','rencana_energi');\">Rencana Energi&nbsp;&nbsp;\r";
					echo "<br>";
					echo "<input type=\"checkbox\" name=\"rencana_jalan_tol\" value=\"1\"";
					if ($_GET['rencana_jalan_tol'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','rencana_jalan_tol');\">Rencana Jalan Tol&nbsp;&nbsp;\r";
					echo "<br>";
					echo "<input type=\"checkbox\" name=\"ibu_kota\" value=\"1\"";
					if ($_GET['ibu_kota'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','ibu_kota');\">Ibu Kota Kabupaten&nbsp;&nbsp;\r";
					echo "<br>";
					echo "<input type=\"checkbox\" name=\"ibu_kota_kec\" value=\"1\"";
					if ($_GET['ibu_kota_kec'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','ibu_kota_kec');\">Ibu Kota Kecamatan&nbsp;&nbsp;\r";
					echo "<br>";
					echo "<input type=\"checkbox\" name=\"propinsi\" value=\"1\"";
					if ($_GET['propinsi'] == "1") {
						echo " checked";
					}
					// echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','propinsi');\">Ibu Kota Propinsi&nbsp;&nbsp;\r";
					// echo "<br>";
					// 					echo "<input type=\"checkbox\" name=\"sabo_dam\" value=\"1\"";
					// if ($_GET['sabo_dam'] == "1") {
					// 	echo " checked";
					// }
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','sabo_dam');\">Sabo Dam&nbsp;&nbsp;\r";
					echo "<br>";
					echo "<input type=\"checkbox\" name=\"mataair\" value=\"1\"";
					if ($_GET['mataair'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','mataair');\">Sumber Mata air&nbsp;&nbsp;\r";
					echo "<br>";
										echo "<input type=\"checkbox\" name=\"tea\" value=\"1\"";
					if ($_GET['tea'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','tea');\">Tempat Evakuasi Akhir&nbsp;&nbsp;\r";
					echo "<br>";
					echo "<input type=\"checkbox\" name=\"terminal\" value=\"1\"";
					if ($_GET['terminal'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','terminal');\">Terminal BUS&nbsp;&nbsp;\r";
					echo "<br>";
					/*
					echo "<input type=\"checkbox\" name=\"peta_jalan\" value=\"1\"";
					if ($_GET['peta_jalan'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','peta_jalan');\">Jalan&nbsp;&nbsp;\r";
					echo "<br>";
					echo "<input type=\"checkbox\" name=\"jembatan\" value=\"1\"";
					if ($_GET['jembatan'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','jembatan');\">Jembatan&nbsp;&nbsp;\r";
					echo "<br>";
					echo "<input type=\"checkbox\" name=\"sungai\" value=\"1\"";
					if ($_GET['sungai'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('$kecamatan','sungai');\">Sungai&nbsp;&nbsp;\r";
					echo "<br>";
					*/
					/*
					echo "<input type=\"checkbox\" name=\"googleMap\" value=\"1\"";
					if ($_GET['googleMap'] == "1") {
						echo " checked";
					}
					echo " onChange=\"javascript:parent.mapFrame.addMainLayer('all','googleMap');\">Google Map (Internet)&nbsp;&nbsp;\r";
					*/
					
					
					if ($_GET['googleMap'] == "1") {
						$tog_on = "on";
						$tog_off = "off";
						$check_on = " checked";
						$check_off = "";
					} else {
						$tog_on = "off";
						$tog_off = "on";
						$check_off = " checked";
						$check_on = "";
					}

					
				?>
					<br>
					Google Map (Internet)<br>
				<input type="radio" name="googleMap" value="1" onClick="this.form.submit();"<?php echo $check_on?>>&nbsp;Ya&nbsp;&nbsp;<input type="radio" name="googleMap" value="0" onClick="this.form.submit();"<?php echo $check_off?>>&nbsp;Tidak
				</div>
			</td>
			</tr>
			<tr><td align="center">
			<button name="submitss" onclick="this.form.submit();"><?php echo $buttonText?></button>
			</td></tr>
			</table>
			
					
			</form>
			<br>
		</div>
		<?php
		//if((stristr(curPageURL(), "peta_setup.php") == false)) {
		if($_GET['web'] == "1") {
		?>
		<br>
		<div id="legend">
					<?php
					/*
                    <div id="mapTitle">
                        <table cellspacing="5" cellpadding="2">
                            <tr>
                                <td align="center"><img src="<?=$webRoot?>/images/logo.png"></td>
                                <td style="padding-left:10px;"><?php echo $judulWeb; ?></td>
                            </tr>
                        </table>
                    </div>
                    */
                    ?>
                    <div id="ketLegend">
                    </div>
        </div>
		
		<?php
		}
		?>
	</div>
</td></tr></table>


<div id="leftLegend">
	      <table align="center" width="100%">
        <tr>
            <td width="24%" style="vertical-align:top;border-left:1px solid #E0E0E0;" bgcolor="white">
                    <table width="100%" cellpadding="2" cellspacing="2" ><tr><td style="vertical-align:top;padding:5px;font-size:10px;">
                        <table>
                        </table>
                        <!-- <hr><center><b style="font-size:10px;color:#003a6b;">Peta Fasilitas Pendidikan dan Kesehatan -->
                        </b></center><hr>
                        <div style="height:200px;overflow:auto;">
                            <b style="font:size:0.8em;">KETERANGAN:</b>
                            <table style="margin:5px;font:size:0.8em;">
                                <tr><td width="20px"><hr style="border:1px solid black;"></td><td>&nbsp;&nbsp;</td><td style="padding-right:5px;">Batas Administrasi</td>
                                <td width="20px"><hr style="border:1px solid red;"></td><td>&nbsp;&nbsp;</td><td style="padding-right:5px;">Jalan</td></tr>
                                <tr><td width="20px"><hr style="border:1px solid #E0E0E0;"></td><td>&nbsp;&nbsp;</td><td style="padding-right:5px;">Batas Kelurahan</td>
                                <td width="20px"><hr style="border:1px solid blue;"></td><td>&nbsp;&nbsp;</td><td style="padding-right:5px;">Sungai</td></tr>
                                <!-- <tr><td width="20px"><hr style="border:5px solid <?php echo $warna['kesehatan'];?>;"></td><td>&nbsp;&nbsp;</td><td style="padding-right:5px;">Kesehatan</td>
                                <td width="20px"></td><td>&nbsp;&nbsp;</td><td style="padding-right:5px;"></td></tr>
                                <tr><td width="20px"><hr style="border:5px solid <?php echo $warna['pendidikan'];?>;"></td><td>&nbsp;&nbsp;</td><td style="padding-right:5px;">Pendidikan</td>
                                <td width="20px"></td><td>&nbsp;&nbsp;</td><td style="padding-right:5px;"></td></tr> -->
                                <?php
                                /*
                                echo "<tr><td width=\"20px\"><hr style=\"border:5px solid ".$warna['bangunan'].";\"></td><td>&nbsp;&nbsp;</td><td colspan=\"3\" style=\"padding-right:5px;\">Bangunan</td></tr>";
                                echo "<tr><td width=\"20px\"><hr style=\"border:5px solid ".$warna['sumber_air'].";\"></td><td>&nbsp;&nbsp;</td><td colspan=\"3\" style=\"padding-right:5px;\">Sumber Air</td></tr>";
                                echo "<tr><td width=\"20px\"><hr style=\"border:5px solid ".$warna['bendung'].";\"></td><td>&nbsp;&nbsp;</td><td colspan=\"3\" style=\"padding-right:5px;\">Bendung</td></tr>";
                                echo "<tr><td width=\"20px\"><hr style=\"border:5px solid ".$warna['kondisi'].";\"></td><td>&nbsp;&nbsp;</td><td colspan=\"3\" style=\"padding-right:5px;\">Kondisi</td></tr>";
                                echo "<tr><td width=\"20px\"><hr style=\"border:5px solid ".$warna['saluran_irigasi'].";\"></td><td>&nbsp;&nbsp;</td><td colspan=\"3\" style=\"padding-right:5px;\">Saluran Irigasi</td></tr>";
                                */
                                ?>
                            </table>
                        </div>
                    </tr></table>
            </td>
        </tr>
        </table>

  </div></div>
