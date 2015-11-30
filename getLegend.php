<?php
 require_once './library/config.php';
    $gid = $_GET['gid'];
    $table = $_GET['table'];
    $legend = $_GET['legend'];
    if($legend!=1) {
      $legend = 0;
    }
    echo "<h1>Keterangan</h1>";
    //echo $table;
    //echo $legend;
    $txt=get_desa_popup($gid,$table,$legend);
    echo $txt;
    
  ?>



