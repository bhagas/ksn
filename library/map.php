<?php
    require_once './library/config.php';
    

    if ($gid!="" && $table!="") {
        $mark = get_geom_from_point(get_centroids($gid,$table,$dbstring));
        //echo get_centroids($gid,$table,$dbstring);
        for ( $i=0; $i < count($mark) ; $i++ ) {
            $entity = explode(" ",$mark[$i]);
            if ($entity[0]!="" || $entity[1]!="") {
                $my_latA = $entity[1];
                $my_longA = $entity[0];
            }
        }   
    } else if ($kecamatan!="") {
        $mark = get_geom_from_point(get_centroids_text($kecamatan,"administrasi"));
        for ( $i=0; $i < count($mark) ; $i++ ) {
            $entity = explode(" ",$mark[$i]);
            if ($entity[0]!="" || $entity[1]!="") {
                $my_latA = $entity[1];
                $my_longA = $entity[0];
            }
        }
        //echo "test".$my_latA;
    }
    if ($my_latA=="" || $my_longA=="") {
        $my_lat   = $default_lat;
        $my_long  = $default_lon;
    } else {
        $my_lat = $my_latA;
        $my_long = $my_longA;
    }

    //$myPoint = new gPoint();
    //$myPoint->setUTM( $my_lat, $my_long, $latlonPosition);
    //$myPoint->convertTMtoLL();
    $center_lat = $my_lat;
    $center_long = $my_long;
    
    
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title><?php echo $judul?></title>
     <link rel="stylesheet" href="<?php echo $webRoot?>/css/OpenLayers/theme/default/style.css" type="text/css">
     <link rel="stylesheet" href="<?php echo $webRoot?>/css/style.css" type="text/css">
     <link rel="stylesheet" href="<?php echo $webRoot?>/css/OpenLayers/styleOL.css" type="text/css">
    <?php
    //if($googleMap=="1") {
    ?>
    <!-- this gmaps key generated for http://openlayers.org/dev/ -->
    <script src="http://maps.google.com/maps/api/js?v=3.6&sensor=false"></script>
    <?php
    //}
    ?>
    <script type="text/javascript" src="<?php echo $webRoot; ?>/js/jquery-1.4.2.min.js"></script>
    <script src="<?php echo $webRoot?>/js/OpenLayers/OpenLayers.js"></script>
    <script src="<?php echo $webRoot?>/js/OpenLayers/google-v3.js"></script>
    <script type="text/javascript" src="<?php echo $webRoot?>/js/ajax.js"></script>
    <script type="text/javascript">
        var map;
        var selectControlKab;
        var selectedFeature;
        var selectControlM;
        
        var style_green =
            {
                strokeColor: "#00FF00",
                strokeOpacity: 1,
                strokeWidth: 1,
                fillColor: "#00FF00",
                fillOpacity: 0.6
            };
        var style_red =
            {
                strokeColor: "#FF0000",
                strokeOpacity: 1,
                strokeWidth: 1,
                fillColor: "#FF0000",
                fillOpacity: 0.6
            };
        var style_kelurahan =
            {
                strokeColor: "#000000",
                strokeOpacity: 1,
                strokeWidth: 1,
                fillColor: "#FF0000",
                fillOpacity: 0
            };
        var style_kelurahan_offline =
                {
                    strokeColor: "black",
                    strokeOpacity: 1,
                    strokeWidth: 1,
                    fillColor: "#F7EFDE",
                    fillOpacity: 0.4
                };
        var style_desa =
                {
                    strokeColor: "#E0E0E0",
                    strokeOpacity: 1,
                    strokeWidth: 1,
                    fillColor: "#F7EFDE",
                    fillOpacity: 0
                };
        var style_jalan_arteri =
                {
                    strokeColor: "red",
                    strokeOpacity: 1,
                    strokeWidth: 2,
                    fillColor: "red",
                    fillOpacity: 0
                };
        var style_jalan_kolektor =
        {
            strokeColor: "red",
            strokeOpacity: 1,
            strokeWidth: 1,
            fillColor: "red",
            fillOpacity: 0
        };
        var style_jalan_lokal =
                {
                    strokeColor: "red",
                    strokeOpacity: 1,
                    strokeWidth: 0.5,
                    fillColor: "red",
                    fillOpacity: 0
                };

        var style_sungai =
                {
                    strokeColor: "blue",
                    strokeOpacity: 1,
                    strokeWidth: 0.5,
                    fillColor: "blue",
                    fillOpacity: 0
                };
        var style_choosen =
                {
                    strokeColor: "#008000",
                    strokeOpacity: 1,
                    strokeWidth: 2,
                    fillColor: "#008000",
                    fillOpacity: 0.6
                };

        var styleBup = null;
        var zoomStat = 1;
        
        var online = false;
        var proj = new OpenLayers.Projection("EPSG:4326");
        var projV3 = new OpenLayers.Projection("EPSG:900913");

        <?php
        if($googleMap=="1") {
            echo "var img = document.createElement('img');\n";
            echo "img.src = \"https://www.google.com/images/srpr/logo3w.png\";\n";
            echo "img.onload = function() { online = true; }\n";
        } else {
            echo "online=false;\n";
        }
        ?>

        if(online) {
        } else {
            //alert('Anda tidak terkoneksi dengan internet');
        }

            var layerJalan = new OpenLayers.Layer.Vector("Jalan", {isBaseLayer: false, 
            eventListeners:{
                        'beforefeatureselected':function(evt) {
                            var feature = evt.feature;
                            styleBup = feature.style;
                            feature.style = style_choosen;
                            if(zoomStat == 1) {
                                zoomStat = 0;
                            } else {
                                zoomStat = 1;
                            }
                        },
                        'featureselected':function(evt){
                            var feature = evt.feature;
                            var popup = new OpenLayers.Popup.AnchoredBubble("popup",
                                feature.geometry.getBounds().getCenterLonLat(),
                                new OpenLayers.Size(200,300),
                                "<div style='font-size:.8em'><div id='legSI'></div></div>",
                                null,
                                true
                            );
                            makeRequest('getLegend.php','?' + feature.attributes.divContent,'legSI');
                            feature.popup = popup;
                            map.addPopup(popup);
                            map.panTo(feature.geometry.getBounds().getCenterLonLat());
                            //goCenter(feature.attributes.divContent,feature.geometry.getBounds().getCenterLonLat().lon,feature.geometry.getBounds().getCenterLonLat().lat);
                        },
                        'featureunselected':function(evt){
                            var feature = evt.feature;
                            map.removePopup(feature.popup);
                            feature.popup.destroy();
                            feature.popup = null;
                            feature.style = styleBup;
                            if(zoomStat == 1) {
                                map.zoomIn(0.1);
                            } else {
                                map.zoomOut(0.1);
                            }
                        }
                    }
            });

            var layerJembatan = new OpenLayers.Layer.Vector("Jembatan", {isBaseLayer: false, 
            eventListeners:{
                        'beforefeatureselected':function(evt) {
                            var feature = evt.feature;
                            styleBup = feature.style;
                            feature.style = style_choosen;
                            if(zoomStat == 1) {
                                zoomStat = 0;
                            } else {
                                zoomStat = 1;
                            }
                        },
                        'featureselected':function(evt){
                            var feature = evt.feature;
                            var popup = new OpenLayers.Popup.AnchoredBubble("popup",
                                feature.geometry.getBounds().getCenterLonLat(),
                                new OpenLayers.Size(200,300),
                                "<div style='font-size:.8em'><div id='legSI'></div></div>",
                                null,
                                true
                            );
                            makeRequest('getLegend.php','?' + feature.attributes.divContent,'legSI');
                            feature.popup = popup;
                            map.addPopup(popup);
                            map.panTo(feature.geometry.getBounds().getCenterLonLat());
                            //goCenter(feature.attributes.divContent,feature.geometry.getBounds().getCenterLonLat().lon,feature.geometry.getBounds().getCenterLonLat().lat);
                        },
                        'featureunselected':function(evt){
                            var feature = evt.feature;
                            map.removePopup(feature.popup);
                            feature.popup.destroy();
                            feature.popup = null;
                            feature.style = styleBup;
                            if(zoomStat == 1) {
                                map.zoomIn(0.1);
                            } else {
                                map.zoomOut(0.1);
                            }
                        }
                    }
            });

            var mainLayer2 = new OpenLayers.Layer.Vector("Pola Ruang Kabupaten/Kota", {isBaseLayer: false});
            
            var layerSungai = new OpenLayers.Layer.Vector("Sungai", {isBaseLayer: false});
            var layerJalanAll = new OpenLayers.Layer.Vector("Semua Jalan", {isBaseLayer: false});

        function init() {
            
            
            map = new OpenLayers.Map('map', {
                controls: [
                    new OpenLayers.Control.Navigation(),
                    new OpenLayers.Control.PanZoomBar(),
                    new OpenLayers.Control.LayerSwitcher({'ascending':false}),
                    new OpenLayers.Control.OverviewMap(),
                    new OpenLayers.Control.KeyboardDefaults()
                ]});
            
            
            var myStyles = new OpenLayers.StyleMap({
                "default": new OpenLayers.Style({
                    fillColor: "#000000"
                }),
                "select": new OpenLayers.Style({
                    fillColor: "#ffffff"
                })
            });
            
            if(online) {
                var gphy = new OpenLayers.Layer.Google(
                    "Physical",
                    {type: google.maps.MapTypeId.TERRAIN,sphericalMercator: true,projection: "EPSG:900913"}
                );
                var gmap = new OpenLayers.Layer.Google(
                    "Streets", // the default
                    {numZoomLevels: 20,sphericalMercator: true,projection: "EPSG:900913"}
                );
                var ghyb = new OpenLayers.Layer.Google(
                    "Hybrid",
                    {type: google.maps.MapTypeId.HYBRID, numZoomLevels: 20,sphericalMercator: true,projection: "EPSG:900913"}
                );
                var gsat = new OpenLayers.Layer.Google(
                    "Satellite",
                    {type: google.maps.MapTypeId.SATELLITE, numZoomLevels: 20,sphericalMercator: true,projection: "EPSG:900913"}
                );
            }
            
            
            var kecamatan = new OpenLayers.Layer.Vector("Kecamatan", {isBaseLayer: false,
            eventListeners:{
                        'beforefeatureselected':function(evt) {
                            var feature = evt.feature;
                            styleBup = feature.style;
                            feature.style = style_choosen;
                            if(zoomStat == 1) {
                                zoomStat = 0;
                            } else {
                                zoomStat = 1;
                            }
                        },
                        'featureselected':function(evt){
                            var feature = evt.feature;
                            var popup = new OpenLayers.Popup.AnchoredBubble("popup",
                                feature.geometry.getBounds().getCenterLonLat(),
                                new OpenLayers.Size(200,300),
                                "<div style='font-size:.8em'><div id='legKec'></div></div>",
                                null,
                                true
                            );
                            makeRequest('getLegend.php','?' + feature.attributes.divContent,'legKec');
                            feature.popup = popup;
                            map.addPopup(popup);
                            map.panTo(feature.geometry.getBounds().getCenterLonLat());
                            //goCenter(feature.attributes.divContent,feature.geometry.getBounds().getCenterLonLat().lon,feature.geometry.getBounds().getCenterLonLat().lat);
                        },
                        'featureunselected':function(evt){
                            var feature = evt.feature;
                            map.removePopup(feature.popup);
                            feature.popup.destroy();
                            feature.popup = null;
                            feature.style = styleBup;
                            if(zoomStat == 1) {
                                map.zoomIn(0.1);
                            } else {
                                map.zoomOut(0.1);
                            }
                        }
                    }
            });

            
            if(online) {
                var kelurahan = new OpenLayers.Layer.Vector("Kelurahan", {isBaseLayer: false});
            } else {
                var kelurahan = new OpenLayers.Layer.Vector("Kelurahan", {isBaseLayer: true, numZoomLevels: 20});
            }
            

            var styleBaseKec = new OpenLayers.Style({ 
                                 label: "${nama}", 
                                  fontColor: "black", 
                                  fontFamily: "Arial", 
                                  labelAlign: "cb"
                              },
                              {rules: [
                                    new OpenLayers.Rule({
                                        minScaleDenominator: 700000,
                                        symbolizer: {
                                            fontSize: "0px"
                                        }
                                    }),
                                    new OpenLayers.Rule({
                                        maxScaleDenominator: 700000,
                                        minScaleDenominator: 400000,
                                        symbolizer: {
                                            fontSize: "9px"
                                        }
                                    }),
                                    new OpenLayers.Rule({
                                        maxScaleDenominator: 400000,
                                        minScaleDenominator: 200000,
                                        symbolizer: {
                                            fontSize: "12px"
                                        }
                                    }),
                                    new OpenLayers.Rule({
                                        maxScaleDenominator: 200000,
                                        symbolizer: {
                                            fontSize: "14px"
                                        }
                                    })
                                ]
                            })
            var styleBaseKel = new OpenLayers.Style({ 
                                 label: "${nama}", 
                                  fontColor: "black", 
                                  fontFamily: "Arial", 
                                  labelAlign: "cb"
                              },
                              {rules: [
                                    new OpenLayers.Rule({
                                        minScaleDenominator: 200000,
                                        symbolizer: {
                                            fontSize: "0px"
                                        }
                                    }),
                                    new OpenLayers.Rule({
                                        maxScaleDenominator: 200000,
                                        minScaleDenominator: 100000,
                                        symbolizer: {
                                            fontSize: "9px"
                                        }
                                    }),
                                    new OpenLayers.Rule({
                                        maxScaleDenominator: 100000,
                                        symbolizer: {
                                            fontSize: "11px"
                                        }
                                    })
                                ]
                            })

            var labelKec = new OpenLayers.Layer.Vector("Label Kecamatan", {isBaseLayer: false,minZoomLevel: 3,
            styleMap: new OpenLayers.StyleMap({"default": styleBaseKec})});
            var labelKel = new OpenLayers.Layer.Vector("Label Kelurahan", {isBaseLayer: false,minZoomLevel: 5,
            styleMap: new OpenLayers.StyleMap({"default": styleBaseKel})});
            
            //selected control;
            
            

            selectControlJalan = new OpenLayers.Control.SelectFeature(layerJalan,
               {
                   hover:false,
                   toggle:true,
                   autoActivate:true
            });
            map.addControl(selectControlJalan);

            selectControlJembatan = new OpenLayers.Control.SelectFeature(layerJembatan,
               {
                   hover:false,
                   toggle:true,
                   autoActivate:true
            });
            map.addControl(selectControlJembatan);

            var myGeom = null;
            <?php

                //kelurahan as upper layer
                //if($kecamatan!="") {
                    
                    $sql = "select AsText(the_geom) as geom, AsText(centroid(the_geom)) as center, gid,kelurahan from kelurahan where the_geom<>''";
                    if($kecamatan!="") {
                        $sql .= " and upper(kecamatan) = upper('$kecamatan')";
                    }
                         //echo $sql;
                        $myTable = $peta;
                        $result = mysql_query($sql);
                            if ($result) {
                                $converted_points = array();
                                $number_points = 0;
                                $b = 0;
                                $pol=0;
                                while ($row = mysql_fetch_array($result)) {
                                    //$strPoly = "var poly".$pol." = format.read(\"POLYGON((";
                                    echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['geom']."\");\n";
                            
                                    if($pop=="1" && $googleMap != "1") {
                                        $style="style_kelurahan_offline";
                                    } else {
                                        $style="style_desa";    
                                    }

                                    echo "\nif(online) {\n";
                                        echo "var kelurahan_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3), null, $style);\n";
                                    echo "} else {\n";
                                        echo "var kelurahan_$pol = new OpenLayers.Feature.Vector(myGeom, null, $style);\n";
                                    echo "}\n";

                                    //echo "kelurahan_$pol.attributes = {divContent:\"".get_desa_popup($row['gid'],$myTable,0)."\"};\n";
                                    echo "kelurahan_$pol.attributes = {divContent:\"gid=".$row['gid']."&table=$myTable&legend=1\"};\n";
                                    
                                    echo "kelurahan.addFeatures([kelurahan_$pol]);\n";
                                    
                                    //label
                                    $mymark = get_geom_from_point($row['center']);
                                    for ( $j=0; $j < count($mymark) ; $j++ ) {
                                        $entity = explode(" ",$mymark[$j]);
                                        $lat = $entity[1];
                                        $lon = $entity[0];
                                        
                                    }
                                    echo "\nif(online) {\n";
                                        echo "var labelKel_$pol = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.Point($lon, $lat).transform(proj,projV3),{nama:\"".$row['kelurahan']."\"});\n";
                                    echo "} else {\n";
                                        echo "var labelKel_$pol = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.Point($lon, $lat),{tag:\"kec\",nama:\"".$row['kelurahan']."\"});\n";
                                    echo "}\n";
                                    echo "labelKel.addFeatures([labelKel_$pol]);\n"; 
                                    $pol++;
                                }
                            }

                            //echo "labelDesa.visibility = false;\n";
                            
                //}
                

                //Kabupaten/ Kota
                //if($peta=="penduduk" || $peta=="pola_ruang") {
                    
                    $sql = "select AsText(the_geom) as geom, AsText(centroid(the_geom)) as center, gid, kecamatan from administrasi where the_geom<>''";
                                            
                    if($kecamatan!="") {
                        $sql .= " and upper(kecamatan) = upper('$kecamatan')";
                    }
                         
                        //$myTable = "penduduk";
                        $myTable = $peta;
                        $result = mysql_query($sql);
                            if ($result) {
                                $converted_points = array();
                                $number_points = 0;
                                $b = 0;
                                $pol=0;
                                while ($row = mysql_fetch_array($result)) {
                                    //$strPoly = "var poly".$pol." = format.read(\"POLYGON((";
                                    echo "myGeom = new OpenLayers.Geometry.fromWKT(\"".$row['geom']."\");\n";
                            
                                    //$style="style_kelurahan";
                                    if($pop=="1" && $googleMap != "1") {
                                        $style="style_kelurahan_offline";
                                    } else {
                                        $style="style_kelurahan";    
                                    }

                                    echo "\nif(online) {\n";
                                        echo "var kecamatan_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3), null, $style);\n";
                                    echo "} else {\n";
                                        echo "var kecamatan_$pol = new OpenLayers.Feature.Vector(myGeom, null, $style);\n";
                                    echo "}\n";

                                    //echo "kelurahan_$pol.attributes = {divContent:\"".get_desa_popup($row['gid'],$myTable,0)."\"};\n";
                                    echo "kecamatan_$pol.attributes = {divContent:\"gid=".$row['gid']."&table=$myTable&legend=1\"};\n";
                                    
                                    echo "kecamatan.addFeatures([kecamatan_$pol]);\n";
                                    
                                    
                                    //label
                                    $mymark = get_geom_from_point($row['center']);
                                    for ( $j=0; $j < count($mymark) ; $j++ ) {
                                        $entity = explode(" ",$mymark[$j]);
                                        $lat = $entity[1];
                                        $lon = $entity[0];
                                        
                                    }
                                    echo "\nif(online) {\n";
                                        echo "var labelKec_$pol = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.Point($lon, $lat).transform(proj,projV3),{nama:\"".$row['kecamatan']."\"});\n";
                                    echo "} else {\n";
                                        echo "var labelKec_$pol = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.Point($lon, $lat),{tag:\"kec\",nama:\"".$row['kecamatan']."\"});\n";
                                    echo "}\n";
                                    echo "labelKec.addFeatures([labelKec_$pol]);\n";                                    
                                    
                                    $pol++;
                                }
                            }

                            //jalan All
                            //if($table=="peta_jalan" || $peta_jalan == "1") {

                            /*    
                                $sql = "select AsText(the_geom) as geom, AsText(centroid(the_geom)) as center, gid from jalan a where the_geom<>''";

                                if($kecamatan!="") {
                                    $sql = "select AsText(a.the_geom) as geom, AsText(centroid(a.the_geom)) as center, a.gid from jalan a, administrasi k where a.the_geom<>'' and k.kecamatan = '$kecamatan' and intersects(k.the_geom, a.the_geom)";
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
                                        
                                        $myStyle=",null,{strokeColor: \"black\",strokeOpacity: 1,strokeWidth: 1,fillColor: \"black\",fillOpacity: 1,fillOpacity: 0.6}";
                                        //$style="style_jalan_lokal";

                                        echo "\nif(online) {\n";
                                            echo "var layerJalanAll_$pol = new OpenLayers.Feature.Vector(myGeom.transform(proj,projV3)$myStyle);\n";
                                        echo "} else {\n";
                                            echo "var layerJalanAll_$pol = new OpenLayers.Feature.Vector(myGeom$myStyle);\n";
                                        echo "}\n";

                                        //echo "kecamatan_$pol.attributes = {divContent:\"".get_desa_popup($row['gid'],$myTable,0)."\"};\n";
                                        echo "layerJalanAll_$pol.attributes = {divContent:\"gid=".$row['id_jalan']."&table=$myTable&legend=1\"};\n";


                                        echo "layerJalanAll.addFeatures([layerJalanAll_$pol]);\n";

                                        
                                        $pol++;
                                    }
                                }

                                echo "map.addLayer(layerJalanAll);";
                                */
                            //}
                            
                //}

                
                
                
                $listOfLayerOFF = "";
                $listOfLayerON = "";
                if($pop=="1") {
                    $listOfLayerOFF = "kelurahan";
                } else if($pop=="0") {//if($peta=="pola_ruang") {
                    $listOfLayerOFF = "kelurahan,kecamatan";
                } 

                $listOfLayerOFF .= ",labelKel,labelKec";

                if($pop=="1") {
                    //$listOfLayerOFF .= ",layerJalanAll,kecamatan";  
                    $listOfLayerOFF .= ",kecamatan";  
                } else { //if($peta=="pola_ruang") {
                    $listOfLayerOFF .= ",desa,kelurahan";
                }

                $listOfLayerON = $listOfLayerOFF.",gmap, gsat, ghyb";
                //$listOfLayerON = $listOfLayerOFF;
                
            ?>
            
            if(online) {
                //map.addLayers([kelurahan,kec_label,mainLayer,gmap, gsat, ghyb]);
                map.addLayers([<?php echo $listOfLayerON?>]);
                //map.addLayers([mainLayer,gmap, gsat, ghyb]);
                map.setCenter(new OpenLayers.LonLat(<?php echo $center_long?>,<?php echo $center_lat?>).transform(proj,map.getProjectionObject()), <?php echo $default_zoom?>);
                map.addControl(new OpenLayers.Control.MousePosition({displayProjection: proj}));
            } else {
                //map.addLayers([kelurahan,kec_label,mainLayer]);
                //map.addLayers([kelurahan,kec_label,mainLayer]);
                map.addLayers([<?php echo $listOfLayerOFF?>]);
                //map.addLayers([mainLayer]);
                map.setCenter(new OpenLayers.LonLat(<?php echo $center_long?>,<?php echo $center_lat?>), <?php echo $default_zoom?>);
                map.addControl(new OpenLayers.Control.MousePosition());
            }
            var scaleline = new OpenLayers.Control.ScaleLine({
                div: document.getElementById("scaleline-id")
            });
            map.addControl(scaleline);
            

            
            
            <?php
            if($peta_jalan=="1" || $jembatan=="1" || $sungai=="1") {
                echo "processLayer();\r";
            }

            if($gid!="" && $table!="") {
                ?>
                    var markers = new OpenLayers.Layer.Markers( "Marker" );
                    map.addLayer(markers);
                    if(online) {
                        markers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(<?php echo $center_long?>,<?php echo $center_lat?>).transform(proj,projV3),icon));
                    } else {
                        markers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(<?php echo $center_long?>,<?php echo $center_lat?>),icon));
                    }
                <?php
            }
            ?>
                        
        }

    
    statJalan = 0;
    statJembatan = 0;
    statSungai = 0;

    <?php
    
    if($peta_jalan=="1") {
        echo "statJalan=1;\r";   
    }
    if($jembatan=="1") {
        echo "statJembatan=1;\r";   
    }
    if($sungai=="1") {
        echo "statSungai=1;\r";   
    }
    ?>

    function addMainLayer(mykecamatan,mytable){
        //alert(mytable+statMainLayer+statMainLayer2);
        if(mytable=="peta_jalan") {
            if(statJalan==0) {
                $.ajax({
                    type: "GET",
                    url:"getLayer.php",
                    data: { kecamatan: mykecamatan, table: mytable},
                    beforeSend:function() {
                        parent.document.getElementById("divLoading").style.display = "block";
                    },
                    success:function(result){
                        $("#divMainLayer").html(result);
                        processLayer();
                        statJalan=1;
                        parent.document.getElementById("divLoading").style.display = "none";
                  }});
            } else if(statJalan!=0){
                if(statJalan==1) {
                    //map.raiseLayer(mainLayer,1);
                    //layerJalan.setVisibility(false);
                    map.removeLayer(layerJalan);
                    statJalan=2;
                } else {
                    //layerJalan.setVisibility(true);
                    map.addLayer(layerJalan);
                    statJalan=1;
                    //map.setLayerIndex(mainLayer,0);
                    map.raiseLayer(layerJalan,1);
                }
                //alert("Peta Sudah Ditampilkan");
            }
        } else if(mytable=="jembatan") {
            if(statJembatan==0) {
                $.ajax({
                    type: "GET",
                    url:"getLayer.php",
                    data: { kecamatan: mykecamatan, table: mytable},
                    beforeSend:function() {
                        parent.document.getElementById("divLoading").style.display = "block";
                    },
                    success:function(result){
                        $("#divMainLayer").html(result);
                        processLayer();
                        statJembatan=1;
                        parent.document.getElementById("divLoading").style.display = "none";
                  }});
            } else if(statJembatan!=0){
                if(statJembatan==1) {
                    //map.raiseLayer(mainLayer,1);
                    //layerJalan.setVisibility(false);
                    map.removeLayer(layerJembatan);
                    statJembatan=2;
                } else {
                    //layerJalan.setVisibility(true);
                    map.addLayer(layerJembatan);
                    statJembatan=1;
                    //map.setLayerIndex(mainLayer,0);
                    map.raiseLayer(layerJembatan,1);
                }
                //alert("Peta Sudah Ditampilkan");
            }
        } else if(mytable=="sungai") {
            if(statSungai==0) {
                $.ajax({
                    type: "GET",
                    url:"getLayer.php",
                    data: { kecamatan: mykecamatan, table: mytable},
                    beforeSend:function() {
                        parent.document.getElementById("divLoading").style.display = "block";
                    },
                    success:function(result){
                        $("#divMainLayer").html(result);
                        processLayer();
                        statSungai=1;
                        parent.document.getElementById("divLoading").style.display = "none";
                  }});
            } else if(statSungai!=0){
                if(statSungai==1) {
                    //map.raiseLayer(mainLayer,1);
                    //layerJalan.setVisibility(false);
                    map.removeLayer(layerSungai);
                    statSungai=2;
                } else {
                    //layerJalan.setVisibility(true);
                    map.addLayer(layerSungai);
                    statSungai=1;
                    //map.setLayerIndex(mainLayer,0);
                    map.raiseLayer(layerSungai,1);
                }
                //alert("Peta Sudah Ditampilkan");
            }
        }
        
    }

    var markers = null;
    //icon marker
    var size = new OpenLayers.Size(20,34);
    var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
    var icon = new OpenLayers.Icon('<?php echo $webRoot?>/images/pin.gif', size, offset);
    var markerCount = 0;
    function goCenter(query,lon,lat) {
        
        if(markerCount>0) {
            markers.destroy();
        }

        markerCount++;
        markers = new OpenLayers.Layer.Markers( "Marker" );
        map.addLayer(markers);
        if(online) {
            markers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(lon,lat).transform(proj,projV3),icon));
        } else {
            markers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(lon,lat),icon));
        }
        top.frames['leftFrame'].callLegend('getLegend.php', '?'+query , 'ketLegend');
    }

    //for position
    var posMarkers = null;
    //icon marker
    //var size = new OpenLayers.Size(20,34);
    //var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
    var posIcon = new OpenLayers.Icon('<?php echo $webRoot?>/images/pin_r.gif', size, offset);
    var posCount = 0;
    function goPos(lon,lat) {
        
        if(posCount>0) {
            //alert(lon);
            posMarkers.destroy();
        }
        posCount++;
        posMarkers = new OpenLayers.Layer.Markers( "Position" );
        map.addLayer(posMarkers);
        if(online) {
            posMarkers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(lon,lat).transform(proj,projV3),posIcon));
            map.panTo(new OpenLayers.LonLat(lon,lat).transform(proj,projV3));
        } else {
            posMarkers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(lon,lat),posIcon));
            map.panTo(new OpenLayers.LonLat(lon,lat));
        }
        
        //top.frames['leftFrame'].callLegend('getPos.php', '?posLat='+lat+'&posLon='+lon , 'ketLegend');
        //map.panTo(feature.geometry.getBounds().getCenterLonLat());
        //makeRequest('getLegend.php', '?gid='+gid+'&table='+table , 'ketLegend')
    }

    </script>
  </head>
  <!--<body onload="init()" bgcolor="#E6E6E6">-->
  <body onload="init()" bgcolor="#E6E6E6">
  <div id="printKec">
        <table align="center" width="100%">
        <tr>
            <td width="75%"><div id="map" class="smallmap"></div></td>
            <td width="5px"></td>
            <td width="24%" style="vertical-align:top;border-left:1px solid #E0E0E0;" bgcolor="white">
                    <table width="100%" cellpadding="2" cellspacing="2" ><tr><td style="vertical-align:top;padding:5px;font-size:10px;">
                        <table>
                        <tr>
                        <td><img style="max-height:70px;" src="<?php echo $webRoot; ?>/images/logo.png"></td>
                        <td valign="top" style="font-size:12px; font-weight:bold; padding-left:20px;">Dinas BAPPEDA<br>Kota Salatiga</td>
                        </tr>
                        </table>
                        <hr><center><b style="font-size:10px;color:#003a6b;">Peta Infrastruktur Jaringan Jalan Kota Salatiga
                        </b></center><hr>
                        <div style="height:320px;overflow:auto;">
                            <b style="font:size:0.8em;">KETERANGAN:</b>
                            <table style="margin:5px;font:size:0.8em;">
                                <tr><td width="20px"><hr style="border:1px solid black;"></td><td>&nbsp;&nbsp;</td><td style="padding-right:5px;">Batas Administrasi</td>
                                <td width="20px"><hr style="border:1px solid red;"></td><td>&nbsp;&nbsp;</td><td style="padding-right:5px;">Jalan</td></tr>
                                <tr><td width="20px"><hr style="border:1px solid #E0E0E0;"></td><td>&nbsp;&nbsp;</td><td style="padding-right:5px;">Batas Desa</td>
                                <td width="20px"><hr style="border:1px solid blue;"></td><td>&nbsp;&nbsp;</td><td style="padding-right:5px;">Sungai</td></tr>
                                <tr><td width="20px"><hr style="border:5px solid green;"></td><td>&nbsp;&nbsp;</td><td style="padding-right:5px;">Jembatan</td>
                                <td width="20px"></td><td>&nbsp;&nbsp;</td><td style="padding-right:5px;"></td></tr>
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
                        <hr>
                        <table style="margin:5px;font:size:0.8em;" width="100%">
                        <tr>
                            <td align="center" width="30%"></td>
                            <td align="center"><div id="scaleline-id"></div></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Sumber: <br>
                                <ul>
                                    <li>Peta RBI Kota Salatiga</li>
                                    <li>Peta RTRW Kota Salatiga</li>
                                    <li>Hasil Survey tahun 2012</li>
                            </td>
                        </tr>
                        </table>
                    <td>
                    </tr></table>
            </td>
        </tr>
        </table>

  </div>
  <div id="divMainLayer">
  <?php
    require_once './getLayer.php';
  ?>
  </div>
  </body>
</html>

