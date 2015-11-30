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

  $sql2="select * from indikasi_program where deleted='0' ORDER BY inserted desc limit $posisi,$batas";
  $sql3="select * from indikasi_program where deleted='0'";
  
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
            <th width="100" valign="middle">Indikasi Program Utama</th>
            <th valign="middle">Jenis Program</th>
            <th valign="middle">Program</th>
            <th valign="middle">Jenis Kegiatan</th>
            <th valign="middle">Kegiatan</th>
            <th valign="middle">Lokasi</th>
            <th valign="middle">Instansi Pelaksana</th>
            <th valign="middle">Sumber Dana</th>
            <th valign="middle">Periode Waktu Mulai Pelaksanaan</th>
            <th valign="middle">Periode Waktu Akhir Pelaksanaan</th>
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
                  <td>".$row2['indikasi_program_utama']."</td>
                  <td>".$row2['jenis_program']."</td>
                  <td>".$row2['program']."</td>
                  <td>".$row2['jenis_kegiatan']."</td>
                  <td>".$row2['kegiatan']."</td>
                  <td>".$row2['lokasi']."</td>
                  <td>".$row2['instansi_pelaksana']."</td>
                  <td>".$row2['sumber_dana_apbn']." ".$row2['sumber_dana_apbd']."</td>
                  <td>".$row2['waktu_pelaksanaan_mulai']."</td>
                  <td>".$row2['waktu_pelaksanaan_selesai']."</td>";
            }
          }
          ?>
      </table>
    </div>
    <ul class="pagination">
      <?php
        echo "<li><a href='$_SERVER[PHP_SELF]?page=indikasi_program&id=".$id."&halaman=1'>&laquo;</a></li>";
        for ($i=1; $i<=$jmlhalaman ; $i++) { 
          if ($i != $halaman) {
            echo "<li><a href=$_SERVER[PHP_SELF]?page=indikasi_program&id=".$id."&halaman=$i>$i</a></li>";
          }
          else {
            echo "<li class='active'><a href=$_SERVER[PHP_SELF]?page=indikasi_program&id=".$id."&halaman=$i>$i</a></li>";
          }
        }
        echo "<li><a href='$_SERVER[PHP_SELF]?page=indikasi_program&id=".$id."&halaman=$jmlhalaman'>&raquo;</a></li>";
      ?>
    </ul>
  </div>
</div>