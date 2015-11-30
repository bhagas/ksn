<?php
  $id=$_GET['id'];
  $id_user=$_SESSION['name'];
  $infrastruktur=$_POST['infrastruktur'];
  $jenis_infrastruktur=$_POST['jenis_infrastruktur'];
  $rencana_program_rtr=$_POST['rencana_program_rtr'];
  $rpl2jm_2014=$_POST['rpl2jm_2014'];
  $rpl2jm_2015=$_POST['rpl2jm_2015'];
  $masukan=$_POST['masukan'];
  $infrastruktur_2014=$_POST['infrastruktur_2014'];
  $infrastruktur_2015=$_POST['infrastruktur_2015'];
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
    $sqlhapus1="update rencana_keterpaduan set deleted=1 where id='".$idhapus."'";
    $resulthapus1=mysql_query($sqlhapus1);
    if ($resulthapus1) {
      $message=$message."Data berhasil dihapus";
        echo "<script>
          function Redirect(){
            window.location=\"?page=program\";
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
   
      if ($jenis_infrastruktur=="") {
        $message9=$message9."Jenis Program Tidak Boleh Kosong";
        $message1=$message1."has-error";
      }
      if ($message10=="" && $message9=="" && $message8=="" && $message7=="" && $message6=="" && $message5=="" && $message4=="" && $message3=="" && $message2=="") {
        $sql1="insert into rencana_keterpaduan ( 
                                          infrastruktur, 
                                          jenis_infrastruktur, 
                                          rencana_program_rtr,
                                          2014_rpl2jm,
                                          2015_rpl2jm, 
                                          masukan,
                                          2014_infrastruktur,
                                          2015_infrastruktur,
                                          kawasan,
                                          id_user) VALUES
                                          (
                                            '".$infrastruktur."',
                                            '".$jenis_infrastruktur."',
                                            '".$rencana_program_rtr."',
                                            '".$rpl2jm_2014."',
                                            '".$rpl2jm_2015."',
                                            '".$masukan."',
                                            '".$infrastruktur_2014."',
                                            '".$infrastruktur_2015."',
                                            '".$kawasan."',
                                            '".$user."')";
      $result1=mysql_query($sql1);
      if ($result1) {
        $message=$message."Data berhasil disimpan";
        echo "<script>
          function Redirect(){
            window.location=\"?page=keterpaduan&kawasan=$kawasan\";
          }
          setTimeout(\"Redirect()\",2000);
        </script>";
      }
      }
      

  }

  

  if (isset($_POST['editsubmit'])) {
    $id1=$_POST['id'];
    if (isset($_POST['delete'])) {
      $sqlhapus="update rencana_keterpaduan set deleted=1 where id='".$id1."'";
      $resulthapus=mysql_query($sqlhapus);
      if ($resulthapus) {
        $message=$message."Data berhasil dihapus";
        echo "<script>
          function Redirect(){
            window.location=\"?page=keterpaduan&kawasan=$kawasan\";
          }
          setTimeout(\"Redirect()\",2000);
        </script>";
      }
    }
    else{
      
      if ($jenis_infrastruktur=="") {
        $message9=$message9."Jenis Program Tidak Boleh Kosong";
        $message1=$message1."has-error";
      }
      if ($message10=="" && $message9=="" && $message8=="" && $message7=="" && $message6=="" && $message5=="" && $message4=="" && $message3=="" && $message2=="") {
        $sqlupdate="update rencana_keterpaduan set infrastruktur='".$infrastruktur."', jenis_infrastruktur='".$jenis_infrastruktur."', rencana_program_rtr='".$rencana_program_rtr."'
        ,2014_rpl2jm='".$rpl2jm_2014."', 2015_rpl2jm='".$rpl2jm_2015."', masukan='".$masukan."', 2014_infrastruktur='".$infrastruktur_2014."', 2015_infrastruktur='".$infrastruktur_2015."', kawasan='".$kawasan."', id_user='".$user."' where id='".$id1."'";
        //echo $sqlupdate;
        $resultupdate=mysql_query($sqlupdate);
        if ($resultupdate) {
          $message=$message."Data berhasil disimpan";
          echo "<script>
          function Redirect(){
            window.location=\"?page=keterpaduan&kawasan=$kawasan\";
          }
          setTimeout(\"Redirect()\",2000);
        </script>";
        }
      }
    }
  }
  if (isset($_GET['actionedit'])) {
    $idedit=$_GET['idedit'];
    $sql4="select * from rencana_keterpaduan where id='".$idedit."'";
    $result4=mysql_query($sql4);
    if ($result4) {
      if ($data4=mysql_fetch_array($result4)) {
        $infrastruktur=$data4['infrastruktur'];
  $jenis_infrastruktur=$data4['jenis_infrastruktur'];
  $rencana_program_rtr=$data4['rencana_program_rtr'];
  $rpl2jm_2014=$data4['2014_rpl2jm'];
  $rpl2jm_2015=$data4['2015_rpl2jm'];
  $masukan=$data4['masukan'];
  $infrastruktur_2014=$data4['2014_infrastruktur'];
  $infrastruktur_2015=$data4['2015_infrastruktur'];
  $kawasan=$data4['kawasan'];
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
    <?php if ($message9!="") {
      ?><div class="alert alert-danger"><?php echo $message9;?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div><?php
    }?>
    <label>Infrastruktur</label>
    <input type="input" class="form-control" name="infrastruktur" placeholder="Infrastruktur" value="<?php echo $infrastruktur ?>">
  </div>
  <div class="form-group">
    <?php if ($message8!="") {
      ?><div class="alert alert-danger"><?php echo $message8;?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div><?php
    }?>
    <label>Jenis Infrastruktur</label>
    <input type="input" class="form-control" name="jenis_infrastruktur" placeholder="Jenis Infrastruktur" value="<?php 
      echo $program;
    ?>">
  </div>

  <div class="form-group">
    <?php if ($message5!="") {
      ?><div class="alert alert-danger"><?php echo $message5;?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div><?php
    }?>
    <label>Rencana Program Di RTR</label>
    <input type="input" class="form-control" name="rencana_program_rtr" placeholder="Rencana Program" value="<?php 
      echo $lokasi;
    ?>">
  </div>
  <div class="form-group">
    <?php if ($message4!="") {
      ?><div class="alert alert-danger"><?php echo $message4;?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div><?php
    }?>
    <label>Rencana Program dalam RPI2JM tahun 2014</label>
    <input type="input" class="form-control" name="rpl2jm_2014" placeholder="rpl2jm_2014" value="<?php
      echo $rpl2jm_2014;
  
    ?>">
  </div>
    <div class="form-group">
    <?php if ($message4!="") {
      ?><div class="alert alert-danger"><?php echo $message4;?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div><?php
    }?>
    <label>Rencana Program dalam RPI2JM tahun 2015</label>
    <input type="input" class="form-control" name="rpl2jm_2015" placeholder="rpl2jm_2015" value="<?php
      echo $rpl2jm_2015;
  
    ?>">
  </div>
   <div class="form-group">
    <?php if ($message5!="") {
      ?><div class="alert alert-danger"><?php echo $message5;?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div><?php
    }?>
    <label>Masukan / Diskusi</label>
    <input type="input" class="form-control" name="masukan" placeholder="Masukan" value="<?php 
      echo $masukan;
    ?>">
  </div>
   <div class="form-group">
    <?php if ($message5!="") {
      ?><div class="alert alert-danger"><?php echo $message5;?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div><?php
    }?>
    <label>Rencana Infrastruktur tahun 2014</label>
    <input type="input" class="form-control" name="infrastruktur_2014" placeholder="Rencana Infrastruktur" value="<?php 
      echo $infrastruktur_2014;
    ?>">
  </div>
     <div class="form-group">
    <?php if ($message5!="") {
      ?><div class="alert alert-danger"><?php echo $message5;?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div><?php
    }?>
    <label>Rencana Infrastruktur tahun 2015</label>
    <input type="input" class="form-control" name="infrastruktur_2015" placeholder="Rencana Infrastruktur" value="<?php 
      echo $infrastruktur_2015;
    ?>">
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
  $batas=5;
  $halaman=$_GET['halaman'];
  if (empty($halaman)) {
    $posisi = 0;
    $halaman = 1;
  }
  else {
    $posisi = ($halaman - 1) * $batas;
  }

  $sql2="select * from rencana_keterpaduan where kawasan='".$kawasan."' and  deleted='0' ORDER BY inserted desc limit $posisi,$batas";
  $sql3="select * from rencana_keterpaduan where kawasan='".$kawasan."' and deleted='0'";
  
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
            <th valign="middle">Infrastruktur</th>
            <th valign="middle">Jenis Infrastruktur</th>
            <th valign="middle">Rencana Program di dalam RTR</th>
            <th valign="middle">RENCANA PROGRAM DALAM RPI2JM tahun 2014</th>
            <th valign="middle">RENCANA PROGRAM DALAM RPI2JM tahun 2015</th>
            <th valign="middle">Masukan</th>
            <th valign="middle">RENCANA INFRASTRUKTUR tahun 2014</th>
            <th valign="middle">RENCANA INFRASTRUKTUR tahun 2015</th>
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
                  <td>".$row2['infrastruktur']."</td>
                  <td>".$row2['jenis_infrastruktur']."</td>
                  <td>".$row2['rencana_program_rtr']."</td>
                  <td>".$row2['2014_rpl2jm']."</td>
                  <td>".$row2['2015_rpl2jm']."</td>
                  <td>".$row2['masukan']."</td>
                  <td>".$row2['2015_infrastruktur']."</td>
                  <td>".$row2['2015_infrastruktur']."</td> 
                  <td>".$row2['id_user']."</td>
                  <td>".$row2['inserted']."</td>
                  <td><a href=\"?page=keterpaduan&kawasan=".$row2['kawasan']."&actionedit=2&idedit=".$row2['id']."\">[Edit]</a><br><a href=\"?page=program&actionhapus=1&idhapus=".$row2['id']."\" onClick=\"return confirm('Anda yakin akan menghapus data ini?')\">[Hapus]</a></tr>";
            }
          }
          ?>
      </table>
    </div>
    <ul class="pagination">
      <?php
        echo "<li><a href='$_SERVER[PHP_SELF]?page=program&id=".$id."&halaman=1'>&laquo;</a></li>";
        for ($i=1; $i<=$jmlhalaman ; $i++) { 
          if ($i != $halaman) {
            echo "<li><a href=$_SERVER[PHP_SELF]?page=program&id=".$id."&halaman=$i>$i</a></li>";
          }
          else {
            echo "<li class='active'><a href=$_SERVER[PHP_SELF]?page=program&id=".$id."&halaman=$i>$i</a></li>";
          }
        }
        echo "<li><a href='$_SERVER[PHP_SELF]?page=program&id=".$id."&halaman=$jmlhalaman'>&raquo;</a></li>";
      ?>
    </ul>
  </div>
</div>