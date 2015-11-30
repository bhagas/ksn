<?php
  $id=$_GET['id'];
  $id_user=$_SESSION['name'];
  $instansi=$_POST['instansi'];
  $jenis_kegiatan=$_POST['jenis_kegiatan'];
  $kegiatan=$_POST['kegiatan'];
  $lokasi=$_POST['lokasi'];
  $jumlah_sasaran=$_POST['jumlah_sasaran'];
  $satuan_sasaran=$_POST['satuan_sasaran'];
  $nilai_pagu=$_POST['nilai_pagu'];
  $progres=$_POST['progres'];
  
  $sumber_dana=$_POST['sumber_dana'];
  $tahun=$_POST['tahun'];
  $kawasan=$_GET['kawasan'];
  $message="";
  $message1="";
  $message2="";
  $message3="";
  $message4="";
  $message5="";
  $message6="";
  $message7="";
  $message8="";
  $message9="";
  $message10="";

  if (isset($_GET['actionhapus'])) {
    $idhapus=$_GET['idhapus'];
    $sqlhapus1="update rekapitulasi_kegiatan set deleted=1 where id='".$idhapus."'";
    $resulthapus1=mysql_query($sqlhapus1);
    if ($resulthapus1) {
      $message=$message."Data berhasil dihapus";
        echo "<script>
          function Redirect(){
            window.location=\"?page=rekapitulasi\";
          }
          setTimeout(\"Redirect()\",2000);
        </script>";
    }
  }

  if (isset($_POST['submit'])) {
    // echo $indikasi;
    // echo $jenis;
    // echo $program;
    // echo $jenis_kegiatan;
    // echo $kegiatan;
    // echo $lokasi;
    // echo $instansi;
    // echo $waktu_awal;
    // echo $waktu_akhir;
    // echo $apbn;
    // echo $apbd;
    if ($lokasi=="") {
        $message10=$message10."Lokasi Program Tidak Boleh Kosong";
        $message1=$message1."has-error";
      }
     
         if ($_FILES["dokumen_0"]["tmp_name"]!="") {
                $dokumen=upload_foto("dokumen_0");
                if(stristr($dokumen,"Error") == True || stristr($dokumen,"Unsupported") == True) {
                  $message = $message.$dokumen;
                } else {
                  $sql1=$sql1.", dokumen_0";
                  $sql2=$sql2.",'".$dokumen."'";
                }
            }
         if ($_FILES["dokumen_50"]["tmp_name"]!="") {
                $dokumen=upload_foto("dokumen_50");
                if(stristr($dokumen,"Error") == True || stristr($dokumen,"Unsupported") == True) {
                  $message = $message.$dokumen;
                } else {
                  $sql1=$sql1.", dokumen_50";
                  $sql2=$sql2.",'".$dokumen."'";
                }
            }
         if ($_FILES["no_foto"]["tmp_name"]!="") {
                $dokumen=upload_foto("no_foto");
                if(stristr($dokumen,"Error") == True || stristr($dokumen,"Unsupported") == True) {
                  $message = $message.$dokumen;
                } else {
                  $sql1=$sql1.", no_foto";
                  $sql2=$sql2.",'".$dokumen."'";
                }
            }
      if ($message10=="" && $message9=="" && $message8=="" && $message7=="" && $message6=="" && $message5=="" && $message4=="" && $message3=="" && $message2=="") {
        $sql="insert into rekapitulasi_kegiatan ( 
                                          instansi,
  jenis_kegiatan,
  kegiatan,
  lokasi,
  jumlah_sasaran,
  satuan_sasaran,
  nilai_pagu,
  sumber_dana,
  tahun,
  progres,
  id_user
  ";

                                      $sql=$sql.$sql1;

                                      $sql=$sql."    ) VALUES
                                          (
                                            '".$instansi."',
                                            '".$jenis_kegiatan."',
                                            '".$kegiatan."',
                                            '".$lokasi."',
                                            '".$jumlah_sasaran."',
                                            '".$satuan_sasaran."',
                                            '".$nilai_pagu."',
                                            
                                            '".$sumber_dana."',
                                            '".$tahun."',
                                            '".$progres."',
                                            '".$user."'
                                          ";
                                          $sql=$sql.$sql2;
                                          $sql=$sql."
                                            )";
//echo $sql;
      $result1=mysql_query($sql);
      if ($result1) {
        $message=$message."Data berhasil disimpan";
        echo "<script>
          function Redirect(){
            window.location=\"?page=rekapitulasi\";
          }
          setTimeout(\"Redirect()\",2000);
        </script>";
      }
      }
      

  }

  

  if (isset($_POST['editsubmit'])) {
    $id1=$_POST['id'];
    if (isset($_POST['delete'])) {
      $sqlhapus="update prioritas_pembangunan set deleted=1 where id='".$id1."'";
      $resulthapus=mysql_query($sqlhapus);
      if ($resulthapus) {
        $message=$message."Data berhasil dihapus";
        echo "<script>
          function Redirect(){
            window.location=\"?page=rekapitulasi\";
          }
          setTimeout(\"Redirect()\",2000);
        </script>";
      }
    }
    else{
      if ($lokasi=="") {
        $message10=$message10."Lokasi Program Tidak Boleh Kosong";
        $message1=$message1."has-error";
      }
       if ($_FILES["dokumen_0"]["tmp_name"]!="") {
                    $dokumen=upload_foto("dokumen_0");
                    if(stristr($dokumen,"Error") == True || stristr($dokumen,"Unsupported") == True) {
                      $message = $message.$dokumen;
                    } else {
                      $sql1=$sql1.", dokumen_0 = '".$dokumen."'";
                    }
                }   if ($_FILES["dokumen_50"]["tmp_name"]!="") {
                    $dokumen=upload_foto("dokumen_50");
                    if(stristr($dokumen,"Error") == True || stristr($dokumen,"Unsupported") == True) {
                      $message = $message.$dokumen;
                    } else {
                      $sql1=$sql1.", dokumen_50 = '".$dokumen."'";
                    }
                }
       if ($_FILES["no_foto"]["tmp_name"]!="") {
                    $dokumen=upload_foto("no_foto");
                    if(stristr($dokumen,"Error") == True || stristr($dokumen,"Unsupported") == True) {
                      $message = $message.$dokumen;
                    } else {
                      $sql1=$sql1.", no_foto = '".$dokumen."'";
                    }
                }
      if ($message10=="" && $message9=="" && $message8=="" && $message7=="" && $message6=="" && $message5=="" && $message4=="" && $message3=="" && $message2=="") {
        $sql="update rekapitulasi_kegiatan set 
        jenis_kegiatan='".$jenis_kegiatan."',
         kegiatan='".$kegiatan."',
          lokasi='".$lokasi."'
        ,jumlah_sasaran='".$jumlah_sasaran."', 
        satuan_sasaran='".$satuan_sasaran."',
        nilai_pagu='".$nilai_pagu."', 
         tahun='".$tahun."', 
         progres='".$progres."', 
         instansi='".$instansi."',
         sumber_dana='".$sumber_dana."', 
         id_user='".$user."' 
        ";
        $sql=$sql.$sql1;
        $sql=$sql."
        where id='".$id1."'";
        //echo $sqlupdate;
        $resultupdate=mysql_query($sql);
        if ($resultupdate) {
          $message=$message."Data berhasil disimpan";
          echo "<script>
          function Redirect(){
            window.location=\"?page=rekapitulasi\";
          }
          setTimeout(\"Redirect()\",2000);
        </script>";
        }
      }
    }
  }
  if (isset($_GET['actionedit'])) {
    $idedit=$_GET['idedit'];
    $sql4="select * from rekapitulasi_kegiatan where id='".$idedit."'";
    $result4=mysql_query($sql4);
    if ($result4) {
      if ($data4=mysql_fetch_array($result4)) {
       $instansi=$data4['instansi'];
  $jenis_kegiatan=$data4['jenis_kegiatan'];
  $kegiatan=$data4['kegiatan'];
  $lokasi=$data4['lokasi'];
  $jumlah_sasaran=$data4['jumlah_sasaran'];
  $satuan_sasaran=$data4['satuan_sasaran'];
  $nilai_pagu=$data4['nilai_pagu'];
  $progres=$data4['progres'];
  $dokumen_0=$data4['dokumen_0']; 
  $dokumen_50=$data4['dokumen_50'];
  $no_foto=$data4['no_foto'];
  $sumber_dana=$data4['sumber_dana'];
  $tahun=$data4['tahun'];
  }
    }
  }
?>


<div class="page-header">
    <?php
    $sql="select * from ksn_wilayah where id='".$id."'";
  $result=mysql_query($sql);
  if ($result) {
    if ($data=mysql_fetch_array($result)) {
      $wilayah=$data['wilayah'];
      echo "<h2>Manajemen Program ".ucfirst($wilayah)."</h2>";
    }
  }
    ?>
      
    </div>
<div class="row">
  <div class="col-md-5">
    <?php if ($message!="") {
      ?><div class="alert alert-success"><?php echo $message;?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div><?php
    }?>
  </div>
</div>
<div class="row">
  <div class="col-md-7">
    <form role="form" method="post" enctype="multipart/form-data">
  
  
 <div class="form-group">
    <label>Jenis Kegiatan</label>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="jenis_kegiatan" value="Rehabilitasi" <?php if ($jenis_kegiatan=="Rehabilitasi") {
          echo "checked";
        }?>>
        Rehabilitasi
      </label>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="jenis_kegiatan" value="Pembangunan" <?php if ($jenis_kegiatan=="Pembangunan") {
          echo "checked";
        }?>>
        Pembangunan
      </label>
    </div>
  </div>
  <div class="form-group">
    <?php if ($message4!="") {
      ?><div class="alert alert-danger"><?php echo $message4;?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div><?php
    }?>
    <label>Kegiatan</label>
    <input type="input" class="form-control" name="kegiatan" placeholder="Kegiatan" value="<?php
      echo $kegiatan;
  
    ?>">
  </div>
  <div class="form-group">
    <?php if ($message5!="") {
      ?><div class="alert alert-danger"><?php echo $message5;?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div><?php
    }?>
    <label>Lokasi</label>
    <input type="input" class="form-control" name="lokasi" placeholder="Lokasi" value="<?php 
      echo $lokasi;
    ?>">
  </div>
 <div class="form-group">
    <?php if ($message4!="") {
      ?><div class="alert alert-danger"><?php echo $message4;?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div><?php
    }?>
    <label>Jumlah Sasaran</label>
    <input type="input" class="form-control" name="jumlah_sasaran" placeholder="Jumlah sasaran" value="<?php
      echo $jumlah_sasaran;
  
    ?>">
  </div> <div class="form-group">
    <?php if ($message4!="") {
      ?><div class="alert alert-danger"><?php echo $message4;?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div><?php
    }?>
    <label>Satuan Sasaran</label>
    <input type="input" class="form-control" name="satuan_sasaran" placeholder="Satuan sasaran" value="<?php
      echo $satuan_sasaran;
  
    ?>">
  </div> 
  <div class="form-group">
    <?php if ($message9!="") {
      ?><div class="alert alert-danger"><?php echo $message9;?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div><?php
    }?>
    <label>Instansi</label>
    <input type="input" class="form-control" name="instansi" placeholder="Instansi" value="<?php echo $instansi ?>">
  </div>
  <div class="form-group">
    <?php if ($message4!="") {
      ?><div class="alert alert-danger"><?php echo $message4;?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div><?php
    }?>
    <label>Nilai Pagu</label>
    <input type="input" class="form-control" name="nilai_pagu" placeholder="nilai_pagu" value="<?php
      echo $nilai_pagu;
  
    ?>">
  </div>
  <div class="form-group">
    <label>Sumber Dana</label>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="sumber_dana" value="APBN" <?php if ($sumber_dana=="APBN") {
          echo "checked";
        }?>>
        APBN
      </label>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="sumber_dana" value="APBD" <?php if ($sumber_dana=="APBD") {
          echo "checked";
        }?>>
        APBD
      </label>
    </div>
  </div>
   <div class="form-group">
    <?php if ($message4!="") {
      ?><div class="alert alert-danger"><?php echo $message4;?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div><?php
    }?>
    <label>Tahun</label>
    <input type="input" class="form-control" name="tahun" placeholder="tahun" value="<?php
      echo $tahun;
  
    ?>">
  </div>
  <div class="form-group">
    <?php if ($message4!="") {
      ?><div class="alert alert-danger"><?php echo $message4;?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div><?php
    }?>
    <label>Progres (%)</label>
    <input type="input" class="form-control" name="progres" placeholder="progres" value="<?php
      echo $tahun;
  
    ?>">
  </div>
   <div class="form-group">
    <label>Dokumen 0%</label>
     <?php
            if($dokumen_0!="") {
              $foto = explode(",",$dokumen_0);
              if ($dokumen_0!="") {
                  //echo count($foto);
                  for($j=0;$j<count($foto);$j++) {
                      $ft = trim($foto[$j]);
                      if(strstr($ft,".") == false) {
                          $ft = $ft.".JPG";
                      }
                      echo "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br>";
                  }
              }
            } else {
              echo "Foto belum ada";
            }
            ?>
            <input type="file" name="dokumen_0"/>
  </div>
   <div class="form-group">
    <label>Dokumen 50%</label>
     <?php
            if($dokumen_50!="") {
              $foto = explode(",",$dokumen_50);
              if ($dokumen_50!="") {
                  //echo count($foto);
                  for($j=0;$j<count($foto);$j++) {
                      $ft = trim($foto[$j]);
                      if(strstr($ft,".") == false) {
                          $ft = $ft.".JPG";
                      }
                      echo "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br>";
                  }
              }
            } else {
              echo "Foto belum ada";
            }
            ?>
            <input type="file" name="dokumen_50"/>
  </div>
   <div class="form-group">
    <label>Dokumen 100%</label>
     <?php
            if($no_foto!="") {
              $foto = explode(",",$no_foto);
              if ($no_foto!="") {
                  //echo count($foto);
                  for($j=0;$j<count($foto);$j++) {
                      $ft = trim($foto[$j]);
                      if(strstr($ft,".") == false) {
                          $ft = $ft.".JPG";
                      }
                      echo "<img id=\"imgResize\" src=\"".$webFoto."/".$ft."\"><br>";
                  }
              }
            } else {
              echo "Foto belum ada";
            }
            ?>
            <input type="file" name="no_foto"/>
  </div>
  
  
  <?php
    if (isset($_GET['actionedit'])) {
        echo "<input type=\"hidden\" name=\"editsubmit\" value=\"1\">\r";
        echo "<input type=\"hidden\" name=\"id\" value=\"".$idedit."\">\r";
        echo "<table><tr><td><button type=\"submit\" class=\"btn btn-danger\" value=\"1\" name=\"delete\" onClick=\"return confirm('Anda yakin akan menghapus data ini?')\">Delete</button></td>";
        echo "<td><button type=\"submit\" class=\"btn btn-primary\" name=\"update\">Update</button></td></td></table>";
        //echo "<button class\"btn btn-default\" name=\"delete\" value=\"1\" onClick=\"return confirm('Anda yakin akan menghapus data ini?')\"> Delete<br><br>\r";
    }
    else {
      ?>
        <button type="submit" class="btn btn-default" name="submit">Add</button>
      <?php
    }
  ?>
  <!-- <button type="submit" class="btn btn-default" name="submit">Submit</button> -->
</form>
  </div>
</div>
<hr class="style-one">

<?php
  //paging
  $batas=25;
  $halaman=$_GET['halaman'];
  if (empty($halaman)) {
    $posisi = 0;
    $halaman = 1;
  }
  else {
    $posisi = ($halaman - 1) * $batas;
  }

  $sql2="select * from rekapitulasi_kegiatan where   deleted='0' ORDER BY inserted desc limit $posisi,$batas";
  $sql3="select * from rekapitulasi_kegiatan where   deleted='0'";
  
  $result3=mysql_query($sql3);

  $jmldata=mysql_num_rows($result3);
  $jmlhalaman=ceil($jmldata/$batas);


  $result2=mysql_query($sql2);
?>
<!-- begin article content list  -->
<div class="row">
  <div class="page-header">
    <h3>Daftar Program</h3>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th width="30" valign="middle">Nomor</th>
            <th valign="middle">Instansi</th>
            <th valign="middle">Jenis Kegiatan</th>
            <th valign="middle">Kegiatan</th>
            <th valign="middle">Lokasi</th>
            <th valign="middle">Jumlah Sasaran</th>
            <th valign="middle">Satuan Sasaran</th>
                        <th valign="middle">Nilai Pagu</th>
                        <th valign="middle">Sumber dana</th>
           
                        <th valign="middle">Tahun</th>
                       <th valign="middle">Progres</th>
                        <th valign="middle">Dokumen 0%</th>
                         <th valign="middle">Dokumen 50%</th>
                        <th valign="middle">Dokumen 100%</th>
            
            <th valign="middle">User</th>
            <th valign="middle">Inserted</th>
            <th valign="middle">action</th>
          </tr>
        </thead>
          <?php
          $no=$posisi+1;
          if ($result2) {
            while ($row2 = mysql_fetch_array($result2)) {
              // if ($row2['sumber_dana_apbd']!=null || $row2['sumber_dana_apbn']!=null) {
              //   $sumber="APBN dan APBD";
              // }
              // elseif ($row2['sumber_dana_apbd']!=null || $row2['sumber_dana_apbn']==null) {
              //   $sumber="APBD";
              // }
              // elseif ($row2['sumber_dana_apbd']==null || $row2['sumber_dana_apbn']!=null) {
              //   $sumber="APBN";
              // }
              echo "<tr><td width=\"50\">".$no++."</td>
                  <td>".$row2['instansi']."</td>
                  <td>".$row2['jenis_kegiatan']."</td>
                  <td>".$row2['kegiatan']."</td>
                  <td>".$row2['lokasi']."</td>
                  <td>".$row2['jumlah_sasaran']."</td>
                  <td>".$row2['satuan_sasaran']."</td>
                  <td>".$row2['nilai_pagu']."</td>
                  <td>".$row2['sumber_dana']."</td>
                  <td>".$row2['tahun']."</td>
                                    <td>".$row2['progres']."</td>";
                   echo "<td>";
            $foto = explode(",",$row2['dokumen_0']); //sesuaikan fieldnya
                if ($row2['dokumen_0']!="") { //sesuaikan fieldnya
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        echo "<img src=\"".$webFoto."/".$ft."\"><br>";
                    }
                }
            echo "</td>\r";
             echo "<td>";
            $foto = explode(",",$row2['dokumen_50']); //sesuaikan fieldnya
                if ($row2['dokumen_50']!="") { //sesuaikan fieldnya
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        echo "<img src=\"".$webFoto."/".$ft."\"><br>";
                    }
                }
            echo "</td>\r";
                  echo "<td>";
            $foto = explode(",",$row2['no_foto']); //sesuaikan fieldnya
                if ($row2['no_foto']!="") { //sesuaikan fieldnya
                    //echo count($foto);
                    for($j=0;$j<count($foto);$j++) {
                        $ft = trim($foto[$j]);
                        if(strstr($ft,".") == false) {
                            $ft = $ft.".JPG";
                        }
                        echo "<img src=\"".$webFoto."/".$ft."\"><br>";
                    }
                }
            echo "</td>\r"; echo "
                  <td>".$row2['id_user']."</td>
                  <td>".$row2['inserted']."</td>
                  <td><a href=\"?page=rekapitulasi&actionedit=2&idedit=".$row2['id']."\">[Edit]</a><br><a href=\"?page=rekapitulasi&actionhapus=1&idhapus=".$row2['id']."\" onClick=\"return confirm('Anda yakin akan menghapus data ini?')\">[Hapus]</a></tr>";
            }
          }
          ?>
      </table>
    </div>
    <ul class="pagination">
      <?php
        echo "<li><a href='?page=rekapitulasi&id=".$id."&halaman=1'>&laquo;</a></li>";
        for ($i=1; $i<=$jmlhalaman ; $i++) { 
          if ($i != $halaman) {
            echo "<li><a href=?page=rekapitulasi&id=".$id."&halaman=$i>$i</a></li>";
          }
          else {
            echo "<li class='active'><a href=?page=rekapitulasi&id=".$id."&halaman=$i>$i</a></li>";
          }
        }
        echo "<li><a href='?page=rekapitulasi&id=".$id."&halaman=$jmlhalaman'>&raquo;</a></li>";
      ?>
    </ul>
  </div>
</div>