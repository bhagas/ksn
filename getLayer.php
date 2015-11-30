<?php
 require_once './library/config.php';
    $kecamatan = $_GET['kecamatan'];
    $table = $_GET['table'];

//echo "hehe".$pola_ruang_prov;

?>

<script type="text/javascript" id="mainScript">
            
    function processLayer() {
            <?php
            
                
                //kesehatan
                if($table=="jalur_evakuasi" || $jalur_evakuasi == "1") {

                    
                    $sql = "select AsText(the_geom) as geom, AsText(centroid(the_geom)) as center, gid from ln_jalur_evakuasi a where the_geom<>''";

                    if($kecamatan!="") {
                        $sql = "select AsText(a.the_geom) as geom, AsText(centroid(a.the_geom)) as center, a.gid from ln_jalur_evakuasi a, ar_batas_kecamatan k where a.the_geom<>'' and k.kecamatan = '$kecamatan' and intersects(k.the_geom, a.the_geom)";
                    }
                    
                    //limit
                    //$sql .= " limit 200";
                    
                         //echo $sql;
                    $myTable = $table;
                    if($jalur_evakuasi=="1") {
                        $myTable = "jalur_evakuasi";
                    }
                    $result = mysql_query($sql);
                    if ($result) {
                        $converted_points = array();
                        $number_points = 0;
                        $b = 0;
                        $pol=0;
                        while ($row = mysql_fetch_array($result)) {
                            //$strPoly = "var poly".$pol." = format.read(\"POLYGON((";
                            echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['geom']."\");\n";
                            
                            $myStyle=",null,{strokeColor: \"red\",strokeOpacity: 1,strokeWidth: 2,fillColor: \"red\",fillOpacity: 1,'pointRadius': 4,fillOpacity: 0.6}";

                            //$style="style_jalan_lokal";

                            echo "\nif(online) {\n";
                                echo "var layerJalur_evakuasi_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3)$myStyle);\n";
                            echo "} else {\n";
                                echo "var layerJalur_evakuasi_$pol = new OpenLayers.Feature.Vector(myGeom$myStyle);\n";
                            echo "}\n";

                            //echo "kecamatan_$pol.attributes = {divContent:\"".get_desa_popup($row['gid'],$myTable,0)."\"};\n";
                            echo "layerJalur_evakuasi_$pol.attributes = {divContent:\"gid=".$row['gid']."&table=$myTable&legend=1\"};\n";


                            echo "layerJalur_evakuasi.addFeatures([layerJalur_evakuasi_$pol]);\n";

                            
                            $pol++;
                        }
                    }

                    echo "map.addLayer(layerJalur_evakuasi);";
                }

                if($table=="propinsi" || $propinsi == "1") {

                    
                    $sql = "select AsText(the_geom) as geom, AsText(centroid(the_geom)) as center, gid from pt_nama_1propinsi a where the_geom<>''";

                    if($kecamatan!="") {
                        $sql = "select AsText(a.the_geom) as geom, AsText(centroid(a.the_geom)) as center, a.gid from pt_nama_1propinsi a, ar_batas_kecamatan k where a.the_geom<>'' and k.kecamatan = '$kecamatan' and intersects(k.the_geom, a.the_geom)";
                    }
                    
                    //limit
                    //$sql .= " limit 200";
                    
                         //echo $sql;
                    $myTable = $table;
                    if($propinsi=="1") {
                        $myTable = "propinsi";
                    }
                    $result = mysql_query($sql);
                    if ($result) {
                        $converted_points = array();
                        $number_points = 0;
                        $b = 0;
                        $pol=0;
                        while ($row = mysql_fetch_array($result)) {
                            //$strPoly = "var poly".$pol." = format.read(\"POLYGON((";
                            echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['geom']."\");\n";
                            
                            $myStyle=",null,{strokeColor: \"red\",strokeOpacity: 1,strokeWidth: 2,fillColor: \"red\",fillOpacity: 1,'pointRadius': 4,fillOpacity: 0.6}";

                            //$style="style_jalan_lokal";

                            echo "\nif(online) {\n";
                                echo "var layerPropinsi_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3)$myStyle);\n";
                            echo "} else {\n";
                                echo "var layerPropinsi_$pol = new OpenLayers.Feature.Vector(myGeom$myStyle);\n";
                            echo "}\n";

                            //echo "kecamatan_$pol.attributes = {divContent:\"".get_desa_popup($row['gid'],$myTable,0)."\"};\n";
                            echo "layerPropinsi_$pol.attributes = {divContent:\"gid=".$row['gid']."&table=$myTable&legend=1\"};\n";


                            echo "layerPropinsi.addFeatures([layerPropinsi_$pol]);\n";

                            
                            $pol++;
                        }
                    }

                    echo "map.addLayer(layerPropinsi);";
                }
                //pendidikan
                if($table=="deliniasi" || $deliniasi == "1") {

                    
                    $sql = "select AsText(the_geom) as geom, AsText(centroid(the_geom)) as center, gid from ar_deliniasi a where the_geom<>''";

                    if($kecamatan!="") {
                        $sql = "select AsText(a.the_geom) as geom, AsText(centroid(a.the_geom)) as center, a.gid from ar_deliniasi a, ar_batas_kecamatan k where a.the_geom<>'' and k.kecamatan = '$kecamatan' and intersects(k.the_geom, a.the_geom)";
                    }
                    
                    //limit
                    //$sql .= " limit 200";
                    
                         //echo $sql;
                    $myTable = $table;
                    if($deliniasi=="1") {
                        $myTable = "deliniasi";
                    }
                    $result = mysql_query($sql);
                    if ($result) {
                        $converted_points = array();
                        $number_points = 0;
                        $b = 0;
                        $pol=0;
                        while ($row = mysql_fetch_array($result)) {
                            //$strPoly = "var poly".$pol." = format.read(\"POLYGON((";
                            echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['geom']."\");\n";
                            
                            $myStyle=",null,{strokeColor: \"cyan\",strokeOpacity: 1,strokeWidth: 1,fillColor: \"cyan\",fillOpacity: 1,'pointRadius': 4,fillOpacity: 0.6}";

                            //$style="style_jalan_lokal";

                            echo "\nif(online) {\n";
                                echo "var layerDeliniasi_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3)$myStyle);\n";
                            echo "} else {\n";
                                echo "var layerDeliniasi_$pol = new OpenLayers.Feature.Vector(myGeom$myStyle);\n";
                            echo "}\n";

                            //echo "kecamatan_$pol.attributes = {divContent:\"".get_desa_popup($row['gid'],$myTable,0)."\"};\n";
                            echo "layerDeliniasi_$pol.attributes = {divContent:\"gid=".$row['gid']."&table=$myTable&legend=1\"};\n";


                            echo "layerDeliniasi.addFeatures([layerDeliniasi_$pol]);\n";

                            
                            $pol++;
                        }
                    }

                    echo "map.addLayer(layerDeliniasi);";
                }

 if($table=="sabo_dam" || $sabo_dam == "1") {

                    
                    $sql = "select AsText(the_geom) as geom, AsText(centroid(the_geom)) as center, gid from pt_sabo_dam a where the_geom<>''";

                    if($kecamatan!="") {
                        $sql = "select AsText(a.the_geom) as geom, AsText(centroid(a.the_geom)) as center, a.gid from pt_sabo_dam a, ar_batas_kecamatan k where a.the_geom<>'' and k.kecamatan = '$kecamatan' and intersects(k.the_geom, a.the_geom)";
                    }
                    
                    //limit
                    //$sql .= " limit 200";
                    
                         //echo $sql;
                    $myTable = $table;
                    if($sabo_dam=="1") {
                        $myTable = "sabo_dam";
                    }
                    $result = mysql_query($sql);
                    if ($result) {
                        $converted_points = array();
                        $number_points = 0;
                        $b = 0;
                        $pol=0;
                        while ($row = mysql_fetch_array($result)) {
                            //$strPoly = "var poly".$pol." = format.read(\"POLYGON((";
                            echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['geom']."\");\n";
                            
                           $myStyle=",null,{externalGraphic: \"".$webRoot."/images/sabo_dam.png\",
                                 pointRadius: \"6\"
                                  }";

                            //$style="style_jalan_lokal";

                            echo "\nif(online) {\n";
                                echo "var layerSabo_dam_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3)$myStyle);\n";
                            echo "} else {\n";
                                echo "var layerSabo_dam_$pol = new OpenLayers.Feature.Vector(myGeom$myStyle);\n";
                            echo "}\n";

                            //echo "kecamatan_$pol.attributes = {divContent:\"".get_desa_popup($row['gid'],$myTable,0)."\"};\n";
                            echo "layerSabo_dam_$pol.attributes = {divContent:\"gid=".$row['gid']."&table=$myTable&legend=1\"};\n";


                            echo "layerSabo_dam.addFeatures([layerSabo_dam_$pol]);\n";

                            
                            $pol++;
                        }
                    }

                    echo "map.addLayer(layerSabo_dam);";
                }

if($table=="rencana_energi" || $rencana_energi == "1") {

                    
                    $sql = "select AsText(the_geom) as geom, AsText(centroid(the_geom)) as center, gid from ln_rencana_energi a where the_geom<>''";

                    if($kecamatan!="") {
                        $sql = "select AsText(a.the_geom) as geom, AsText(centroid(a.the_geom)) as center, a.gid from ln_rencana_energi a, ar_batas_kecamatan k where a.the_geom<>'' and k.kecamatan = '$kecamatan' and intersects(k.the_geom, a.the_geom)";
                    }
                    
                    //limit
                    //$sql .= " limit 200";
                    
                         //echo $sql;
                    $myTable = $table;
                    if($rencana_energi=="1") {
                        $myTable = "rencana_energi";
                    }
                    $result = mysql_query($sql);
                    if ($result) {
                        $converted_points = array();
                        $number_points = 0;
                        $b = 0;
                        $pol=0;
                        while ($row = mysql_fetch_array($result)) {
                            //$strPoly = "var poly".$pol." = format.read(\"POLYGON((";
                            echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['geom']."\");\n";
                            
                            $myStyle=",null,{strokeColor: \"".$warna['pendidikan']."\",strokeOpacity: 1,strokeWidth: 1,fillColor: \"".$warna['pendidikan']."\",fillOpacity: 1,'pointRadius': 4,fillOpacity: 0.6}";

                            //$style="style_jalan_lokal";

                            echo "\nif(online) {\n";
                                echo "var layerRencana_energi_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3)$myStyle);\n";
                            echo "} else {\n";
                                echo "var layerRencana_energi_$pol = new OpenLayers.Feature.Vector(myGeom$myStyle);\n";
                            echo "}\n";

                            //echo "kecamatan_$pol.attributes = {divContent:\"".get_desa_popup($row['gid'],$myTable,0)."\"};\n";
                            echo "layerRencana_energi_$pol.attributes = {divContent:\"gid=".$row['gid']."&table=$myTable&legend=1\"};\n";


                            echo "layerRencana_energi.addFeatures([layerRencana_energi_$pol]);\n";

                            
                            $pol++;
                        }
                    }

                    echo "map.addLayer(layerRencana_energi);";
                }
                if($table=="rencana_jalan_tol" || $rencana_jalan_tol == "1") {

                    
                    $sql = "select AsText(the_geom) as geom, AsText(centroid(the_geom)) as center, gid from ln_rencana_jalan_toll a where the_geom<>''";

                    if($kecamatan!="") {
                        $sql = "select AsText(a.the_geom) as geom, AsText(centroid(a.the_geom)) as center, a.gid from ln_rencana_jalan_toll a, ar_batas_kecamatan k where a.the_geom<>'' and k.kecamatan = '$kecamatan' and intersects(k.the_geom, a.the_geom)";
                    }
                    
                    //limit
                    //$sql .= " limit 200";
                    
                         //echo $sql;
                    $myTable = $table;
                    if($rencana_jalan_tol=="1") {
                        $myTable = "rencana_jalan_tol";
                    }
                    $result = mysql_query($sql);
                    if ($result) {
                        $converted_points = array();
                        $number_points = 0;
                        $b = 0;
                        $pol=0;
                        while ($row = mysql_fetch_array($result)) {
                            //$strPoly = "var poly".$pol." = format.read(\"POLYGON((";
                            echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['geom']."\");\n";
                            
                            $myStyle=",null,{strokeColor: \"".$warna['pendidikan']."\",strokeOpacity: 1,strokeWidth: 1,fillColor: \"".$warna['pendidikan']."\",fillOpacity: 1,'pointRadius': 4,fillOpacity: 0.6}";

                            //$style="style_jalan_lokal";

                            echo "\nif(online) {\n";
                                echo "var layerRencana_jalan_tol_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3)$myStyle);\n";
                            echo "} else {\n";
                                echo "var layerRencana_jalan_tol_$pol = new OpenLayers.Feature.Vector(myGeom$myStyle);\n";
                            echo "}\n";

                            //echo "kecamatan_$pol.attributes = {divContent:\"".get_desa_popup($row['gid'],$myTable,0)."\"};\n";
                            echo "layerRencana_jalan_tol_$pol.attributes = {divContent:\"gid=".$row['gid']."&table=$myTable&legend=1\"};\n";


                            echo "layerRencana_jalan_tol.addFeatures([layerRencana_jalan_tol_$pol]);\n";

                            
                            $pol++;
                        }
                    }

                    echo "map.addLayer(layerRencana_jalan_tol);";
                }

                //sungai
                if($table=="sungai" || $sungai=="1") {
                    
                    $sql = "select AsText(the_geom) as geom, gid from ln_sungai where the_geom<>''";
                    
                    if($kecamatan!="") {
                        $sql = "select AsText(a.the_geom) as geom, AsText(centroid(a.the_geom)) as center, a.gid from ln_sungai a, ar_batas_kecamatan k where a.the_geom<>'' and k.kecamatan = '$kecamatan' and intersects(k.the_geom, a.the_geom)";
                    }

                         //echo $sql;
                         
                    $result = mysql_query($sql);
                    if ($result) {
                        
                        $b = 0;
                        $pol=0;
                        while ($row = mysql_fetch_array($result)) {
                            //$strPoly = "var poly".$pol." = format.read(\"POLYGON((";
                            echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['geom']."\");\n";
                            
                            $style="style_sungai";

                            echo "\nif(online) {\n";
                                echo "var layerSungai_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3), null, $style);\n";
                            echo "} else {\n";
                                echo "var layerSungai_$pol = new OpenLayers.Feature.Vector(myGeom, null, $style);\n";
                            echo "}\n";
                            
                            echo "layerSungai.addFeatures([layerSungai_$pol]);\n";
                            
                            $pol++;
                        }
                    }

                    echo "map.addLayer(layerSungai);";

                }
                if($table=="jalan" || $jalan == "1") {

                    
                    $sql = "select AsText(the_geom) as geom, AsText(centroid(the_geom)) as center, gid from ln_jalan a where the_geom<>''";

                    if($kecamatan!="") {
                        $sql = "select AsText(a.the_geom) as geom, AsText(centroid(a.the_geom)) as center, a.gid from ln_jalan a, ar_batas_kecamatan k where a.the_geom<>'' and k.kecamatan = '$kecamatan' and intersects(k.the_geom, a.the_geom)";
                    }
                    
                    //limit
                    //$sql .= " limit 200";
                    
                         //echo $sql;
                    $myTable = $table;
                    if($jalan=="1") {
                        $myTable = "jalan";
                    }
                    $result = mysql_query($sql);
                    if ($result) {
                        $converted_points = array();
                        $number_points = 0;
                        $b = 0;
                        $pol=0;
                        while ($row = mysql_fetch_array($result)) {
                            //$strPoly = "var poly".$pol." = format.read(\"POLYGON((";
                            echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['geom']."\");\n";
                            
                            $myStyle=",null,{strokeColor: \"green\",strokeOpacity: 1,strokeWidth: 1,fillColor: \"green\",fillOpacity: 1,'pointRadius': 3,fillOpacity: 0.6}";

                            //$style="style_jalan_lokal";

                            echo "\nif(online) {\n";
                                echo "var layerJalann_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3)$myStyle);\n";
                            echo "} else {\n";
                                echo "var layerJalann_$pol = new OpenLayers.Feature.Vector(myGeom$myStyle);\n";
                            echo "}\n";

                            //echo "kecamatan_$pol.attributes = {divContent:\"".get_desa_popup($row['gid'],$myTable,0)."\"};\n";
                            echo "layerJalann_$pol.attributes = {divContent:\"gid=".$row['gid']."&table=$myTable&legend=1\"};\n";


                            echo "layerJalann.addFeatures([layerJalann_$pol]);\n";

                            
                            $pol++;
                        }
                    }

                    echo "map.addLayer(layerJalann);";
                }

            
                    if($table=="ibu_kota" || $ibu_kota == "1") {

                    
                    $sql = "select AsText(the_geom) as geom, AsText(centroid(the_geom)) as center, gid from pt_ibukota_2kabupaten a where the_geom<>''";

                    if($kecamatan!="") {
                        $sql = "select AsText(a.the_geom) as geom, AsText(centroid(a.the_geom)) as center, a.gid from pt_ibukota_2kabupaten a, ar_batas_kecamatan k where a.the_geom<>'' and k.kecamatan = '$kecamatan' and intersects(k.the_geom, a.the_geom)";
                    }
                    
                    //limit
                    //$sql .= " limit 200";
                    
                         //echo $sql;
                    $myTable = $table;
                    if($ibu_kota=="1") {
                        $myTable = "ibu_kota";
                    }
                    $result = mysql_query($sql);
                    if ($result) {
                        $converted_points = array();
                        $number_points = 0;
                        $b = 0;
                        $pol=0;
                        while ($row = mysql_fetch_array($result)) {
                            //$strPoly = "var poly".$pol." = format.read(\"POLYGON((";
                            echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['geom']."\");\n";
                            
                           $myStyle=",null,{externalGraphic: \"".$webRoot."/images/kabupaten.png\",
                                 pointRadius: \"15\"
                                  }";

                            //$style="style_jalan_lokal";

                            echo "\nif(online) {\n";
                                echo "var layerIbu_kota_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3)$myStyle);\n";
                            echo "} else {\n";
                                echo "var layerIbu_kota_$pol = new OpenLayers.Feature.Vector(myGeom$myStyle);\n";
                            echo "}\n";

                            //echo "kecamatan_$pol.attributes = {divContent:\"".get_desa_popup($row['gid'],$myTable,0)."\"};\n";
                            echo "layerIbu_kota_$pol.attributes = {divContent:\"gid=".$row['gid']."&table=$myTable&legend=1\"};\n";


                            echo "layerIbu_kota.addFeatures([layerIbu_kota_$pol]);\n";

                            
                            $pol++;
                        }
                    }

                    echo "map.addLayer(layerIbu_kota);";
                }


                    if($table=="mataair" || $mataair == "1") {

                    
                    $sql = "select AsText(the_geom) as geom, AsText(centroid(the_geom)) as center, gid from pt_sumber_mataair a where the_geom<>''";

                    if($kecamatan!="") {
                        $sql = "select AsText(a.the_geom) as geom, AsText(centroid(a.the_geom)) as center, a.gid from pt_sumber_mataair a, ar_batas_kecamatan k where a.the_geom<>'' and k.kecamatan = '$kecamatan' and intersects(k.the_geom, a.the_geom)";
                    }
                    
                    //limit
                    //$sql .= " limit 200";
                    
                         //echo $sql;
                    $myTable = $table;
                    if($mataair=="1") {
                        $myTable = "mataair";
                    }
                    $result = mysql_query($sql);
                    if ($result) {
                        $converted_points = array();
                        $number_points = 0;
                        $b = 0;
                        $pol=0;
                        while ($row = mysql_fetch_array($result)) {
                            //$strPoly = "var poly".$pol." = format.read(\"POLYGON((";
                            echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['geom']."\");\n";
                            
                           $myStyle=",null,{externalGraphic: \"".$webRoot."/images/mata_air.png\",
                                 pointRadius: \"15\"
                                  }";

                            //$style="style_jalan_lokal";

                            echo "\nif(online) {\n";
                                echo "var layerMataair_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3)$myStyle);\n";
                            echo "} else {\n";
                                echo "var layerMataair_$pol = new OpenLayers.Feature.Vector(myGeom$myStyle);\n";
                            echo "}\n";

                            //echo "kecamatan_$pol.attributes = {divContent:\"".get_desa_popup($row['gid'],$myTable,0)."\"};\n";
                            echo "layerMataair_$pol.attributes = {divContent:\"gid=".$row['gid']."&table=$myTable&legend=1\"};\n";


                            echo "layerMataair.addFeatures([layerMataair_$pol]);\n";

                            
                            $pol++;
                        }
                    }

                    echo "map.addLayer(layerMataair);";
                }
                 if($table=="tea" || $tea == "1") {

                    
                    $sql = "select AsText(the_geom) as geom, AsText(centroid(the_geom)) as center, gid from pt_tea a where the_geom<>''";

                    if($kecamatan!="") {
                        $sql = "select AsText(a.the_geom) as geom, AsText(centroid(a.the_geom)) as center, a.gid from pt_tea a, ar_batas_kecamatan k where a.the_geom<>'' and k.kecamatan = '$kecamatan' and intersects(k.the_geom, a.the_geom)";
                    }
                    
                    //limit
                    //$sql .= " limit 200";
                    
                         //echo $sql;
                    $myTable = $table;
                    if($tea=="1") {
                        $myTable = "tea";
                    }
                    $result = mysql_query($sql);
                    if ($result) {
                        $converted_points = array();
                        $number_points = 0;
                        $b = 0;
                        $pol=0;
                        while ($row = mysql_fetch_array($result)) {
                            //$strPoly = "var poly".$pol." = format.read(\"POLYGON((";
                            echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['geom']."\");\n";
                            
                           $myStyle=",null,{externalGraphic: \"".$webRoot."/images/tea.png\",
                                 pointRadius: \"15\"
                                  }";

                            //$style="style_jalan_lokal";

                            echo "\nif(online) {\n";
                                echo "var layerTea_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3)$myStyle);\n";
                            echo "} else {\n";
                                echo "var layerTea_$pol = new OpenLayers.Feature.Vector(myGeom$myStyle);\n";
                            echo "}\n";

                            //echo "kecamatan_$pol.attributes = {divContent:\"".get_desa_popup($row['gid'],$myTable,0)."\"};\n";
                            echo "layerTea_$pol.attributes = {divContent:\"gid=".$row['gid']."&table=$myTable&legend=1\"};\n";


                            echo "layerTea.addFeatures([layerTea_$pol]);\n";

                            
                            $pol++;
                        }
                    }

                    echo "map.addLayer(layerTea);";
                } 
                 if($table=="terminal" || $terminal == "1") {

                    
                    $sql = "select AsText(the_geom) as geom, AsText(centroid(the_geom)) as center, gid from pt_terminal a where the_geom<>''";

                    if($kecamatan!="") {
                        $sql = "select AsText(a.the_geom) as geom, AsText(centroid(a.the_geom)) as center, a.gid from pt_terminal a, ar_batas_kecamatan k where a.the_geom<>'' and k.kecamatan = '$kecamatan' and intersects(k.the_geom, a.the_geom)";
                    }
                    
                    //limit
                    //$sql .= " limit 200";
                    
                         //echo $sql;
                    $myTable = $table;
                    if($terminal=="1") {
                        $myTable = "terminal";
                    }
                    $result = mysql_query($sql);
                    if ($result) {
                        $converted_points = array();
                        $number_points = 0;
                        $b = 0;
                        $pol=0;
                        while ($row = mysql_fetch_array($result)) {
                            //$strPoly = "var poly".$pol." = format.read(\"POLYGON((";
                            echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['geom']."\");\n";
                            
                           $myStyle=",null,{externalGraphic: \"".$webRoot."/images/terminal.png\",
                                 pointRadius: \"15\"
                                  }";

                            //$style="style_jalan_lokal";

                            echo "\nif(online) {\n";
                                echo "var layerTerminal_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3)$myStyle);\n";
                            echo "} else {\n";
                                echo "var layerTerminal_$pol = new OpenLayers.Feature.Vector(myGeom$myStyle);\n";
                            echo "}\n";

                            //echo "kecamatan_$pol.attributes = {divContent:\"".get_desa_popup($row['gid'],$myTable,0)."\"};\n";
                            echo "layerTerminal_$pol.attributes = {divContent:\"gid=".$row['gid']."&table=$myTable&legend=1\"};\n";


                            echo "layerTerminal.addFeatures([layerTerminal_$pol]);\n";

                            
                            $pol++;
                        }
                    }

                    echo "map.addLayer(layerTerminal);";
                }
                if($table=="ibu_kota_kec" || $ibu_kota_kec == "1") {
                    
                    $sql = "select AsText(the_geom) as geom, AsText(centroid(the_geom)) as center, gid from pt_ibukota_3kecamatan a where the_geom<>''";

                    if($kecamatan!="") {
                        $sql = "select AsText(a.the_geom) as geom, AsText(centroid(a.the_geom)) as center, a.gid from pt_ibukota_3kecamatan a, ar_batas_kecamatan k where a.the_geom<>'' and k.kecamatan = '$kecamatan' and intersects(k.the_geom, a.the_geom)";
                    }
                    
                    //limit
                    //$sql .= " limit 200";
                    
                         //echo $sql;
                    $myTable = $table;
                    if($ibu_kota_kec=="1") {
                        $myTable = "ibu_kota_kec";
                    }
                    $result = mysql_query($sql);
                    if ($result) {
                        $converted_points = array();
                        $number_points = 0;
                        $b = 0;
                        $pol=0;
                        while ($row = mysql_fetch_array($result)) {
                            //$strPoly = "var poly".$pol." = format.read(\"POLYGON((";
                            echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['geom']."\");\n";
                            
                           $myStyle=",null,{externalGraphic: \"".$webRoot."/images/kecamatan.png\",
                                 pointRadius: \"12\"
                                  }";

                            //$style="style_jalan_lokal";

                            echo "\nif(online) {\n";
                                echo "var layerIbu_kota_kec_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3)$myStyle);\n";
                            echo "} else {\n";
                                echo "var layerIbu_kota_kec_$pol = new OpenLayers.Feature.Vector(myGeom$myStyle);\n";
                            echo "}\n";

                            //echo "kecamatan_$pol.attributes = {divContent:\"".get_desa_popup($row['gid'],$myTable,0)."\"};\n";
                            echo "layerIbu_kota_kec_$pol.attributes = {divContent:\"gid=".$row['gid']."&table=$myTable&legend=1\"};\n";


                            echo "layerIbu_kota_kec.addFeatures([layerIbu_kota_kec_$pol]);\n";

                            
                            $pol++;
                        }
                    }

                    echo "map.addLayer(layerIbu_kota_kec);";
                }
                //jembatan
                if($table=="jembatan" || $jembatan == "1") {

                    
                    $sql = "select AsText(the_geom) as geom, AsText(centroid(the_geom)) as center, gid from jembatan a where the_geom<>''";

                    if($kecamatan!="") {
                        $sql = "select AsText(a.the_geom) as geom, AsText(centroid(a.the_geom)) as center, a.gid from jembatan a, administrasi k where a.the_geom<>'' and k.kecamatan = '$kecamatan' and intersects(k.the_geom, a.the_geom)";
                    }
                    
                    //limit
                    //$sql .= " limit 200";
                    
                         //echo $sql;
                    $myTable = $table;
                    if($jembatan=="1") {
                        $myTable = "jembatan";
                    }
                    $result = mysql_query($sql);
                    if ($result) {
                        $converted_points = array();
                        $number_points = 0;
                        $b = 0;
                        $pol=0;
                        while ($row = mysql_fetch_array($result)) {
                            //$strPoly = "var poly".$pol." = format.read(\"POLYGON((";
                            echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['geom']."\");\n";
                            
                            $myStyle=",null,{strokeColor: \"green\",strokeOpacity: 1,strokeWidth: 1,fillColor: \"green\",fillOpacity: 1,'pointRadius': 3,fillOpacity: 0.6}";

                            //$style="style_jalan_lokal";

                            echo "\nif(online) {\n";
                                echo "var layerJembatan_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3)$myStyle);\n";
                            echo "} else {\n";
                                echo "var layerJembatan_$pol = new OpenLayers.Feature.Vector(myGeom$myStyle);\n";
                            echo "}\n";

                            //echo "kecamatan_$pol.attributes = {divContent:\"".get_desa_popup($row['gid'],$myTable,0)."\"};\n";
                            echo "layerJembatan_$pol.attributes = {divContent:\"gid=".$row['gid']."&table=$myTable&legend=1\"};\n";


                            echo "layerJembatan.addFeatures([layerJembatan_$pol]);\n";

                            
                            $pol++;
                        }
                    }

                    echo "map.addLayer(layerJembatan);";
                }

                //peta_jalan
                if($table=="peta_jalan" || $peta_jalan == "1") {

                    
                    $sql = "select AsText(the_geom) as geom, AsText(centroid(the_geom)) as center,AsText(PointN(the_geom,1)) as siji,AsText(PointN(the_geom,round(NumPoints(the_geom)))) as loro, id_jalan from peta_jalan a where the_geom<>''";

                    if($kecamatan!="") {
                        $sql = "select AsText(a.the_geom) as geom, AsText(centroid(a.the_geom)) as center,AsText(PointN(a.the_geom,1)) as siji,AsText(PointN(a.the_geom,round(NumPoints(a.the_geom)))) as loro, a.id_jalan from peta_jalan a, administrasi k where a.the_geom<>'' and upper(k.kecamatan) = upper('$kecamatan') and intersects(k.the_geom, a.the_geom)";
                    }
                    
                    //limit
                    //$sql .= " limit 200";
                    
                         //echo $sql;
                    $myTable = $table;
                    if($peta_jalan=="1") {
                        $myTable = "peta_jalan";
                    }
                    $result = mysql_query($sql);
                    if ($result) {
                        $converted_points = array();
                        $number_points = 0;
                        $b = 0;
                        $pol=0;
                        while ($row = mysql_fetch_array($result)) {
                            //$strPoly = "var poly".$pol." = format.read(\"POLYGON((";
                            echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['geom']."\");\n";
                            
                            if($row['id_jalan']!=0) {
                                $myStyle=",null,{strokeColor: \"red\",strokeOpacity: 1,strokeWidth: 2,fillColor: \"red\",fillOpacity: 1,fillOpacity: 0.6}";
                            } else {
                                //$myStyle=",null,{strokeColor: \"black\",strokeOpacity: 1,strokeWidth: 1,fillColor: \"black\",fillOpacity: 1,fillOpacity: 0.6}";    
                                $myStyle=",null,{strokeColor: \"red\",strokeOpacity: 1,strokeWidth: 1,fillColor: \"red\",fillOpacity: 1,fillOpacity: 0.6}";
                            }

                            if($gid==$row['id_jalan']) {
                                $myStyle=",null,{strokeColor: \"green\",strokeOpacity: 1,strokeWidth: 2,fillColor: \"green\",fillOpacity: 1,fillOpacity: 0.6}";
                            }
                            //$style="style_jalan_lokal";

                            echo "\nif(online) {\n";
                                echo "var layerJalan_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3)$myStyle);\n";
                            echo "} else {\n";
                                echo "var layerJalan_$pol = new OpenLayers.Feature.Vector(myGeom$myStyle);\n";
                            echo "}\n";

                            //echo "kecamatan_$pol.attributes = {divContent:\"".get_desa_popup($row['gid'],$myTable,0)."\"};\n";
                            if($row['id_jalan']!=0) {
                                echo "layerJalan_$pol.attributes = {divContent:\"gid=".$row['id_jalan']."&table=$myTable&legend=1\"};\n";
                            }


                            echo "layerJalan.addFeatures([layerJalan_$pol]);\n";

                            //add start and end node
                            if($row['id_jalan']!=0) {
                                $pol++;
                                $myStyle=",null,{strokeColor: \"yellow\",strokeOpacity: 1,strokeWidth: 1,fillColor: \"yellow\",fillOpacity: 1,'pointRadius': 3,fillOpacity: 0.6}";
                                echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['siji']."\");\n";
                                echo "\nif(online) {\n";
                                    echo "var layerJalan_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3)$myStyle);\n";
                                echo "} else {\n";
                                    echo "var layerJalan_$pol = new OpenLayers.Feature.Vector(myGeom$myStyle);\n";
                                echo "}\n";
                                echo "layerJalan.addFeatures([layerJalan_$pol]);\n";

                                $pol++;
                                $myStyle=",null,{strokeColor: \"yellow\",strokeOpacity: 1,strokeWidth: 1,fillColor: \"yellow\",fillOpacity: 1,'pointRadius': 2,fillOpacity: 0.6}";
                                echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['loro']."\");\n";
                                echo "\nif(online) {\n";
                                    echo "var layerJalan_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3)$myStyle);\n";
                                echo "} else {\n";
                                    echo "var layerJalan_$pol = new OpenLayers.Feature.Vector(myGeom$myStyle);\n";
                                echo "}\n";
                                echo "layerJalan.addFeatures([layerJalan_$pol]);\n";
                            }
                            
                            $pol++;
                        }
                    }
                    //echo "map.addLayer(layerJalanAll);";
                    echo "map.addLayer(layerJalan);";

                }


                
            ?>
        }    
</script>
