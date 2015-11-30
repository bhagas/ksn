<?php
  //paging
  $batas=20;
  $halaman=$_GET['halaman'];
  if (empty($halaman)) {
    $posisi = 0;
    $halaman = 1;
  }
  else {
    $posisi = ($halaman - 1) * $batas;
  }

  $sql2="select * from rekapitulasi_kegiatan where deleted=false LIMIT $posisi,$batas";
    $sql3="select * from rekapitulasi_kegiatan where deleted=false";
  
  $result3=mysql_query($sql3);

  $jmldata=mysql_num_rows($result3);
  $jmlhalaman=ceil($jmldata/$batas);


  $result2=mysql_query($sql2);
?>
<?php
	// $sql="select * from rekapitulasi_kegiatan where deleted=false";
	// $result=mysql_query($sql);
?>
<div class="row">
	<div class="large-12 columns">
		<nav class="breadcrumbs">
		  <a href="?page=home">Home</a>
		  <a class="current">Hasil Kegiatan Merapi dan Borobudur</a>
		</nav>
	</div>
</div>
<hr>
<div class="row">
	<div class="large-12 columns">
		<h3>Hasil Kegiatan Merapi dan Borobudur</h3>
    <a href="#" data-reveal-id="myModal" class="small button radius">Advance Search</a>
	</div>
	<div class="large-12 columns">
		<table class="responsive">
			<tr>
            <th >No</th>
            <th >Jenis Kegiatan</th>
            <th>Kegiatan</th>
            <th >Lokasi</th>
            <th >Volume Sasaran</th>
            <th >Instansi</th>
            <th >Nilai Pagu</th>
            <th >Sumber dana</th>
            <th >Tahun</th>
            <th >Progres</th>
            <th >Dokumen 0%</th>
            <th >Dokumen 50%</th>
            <th >Dokumen 100%</th>
          </tr>
          
          	<?php
          		if ($result2) {
          			$no=$posisi+1;
          			while ($data=mysql_fetch_array($result2)) {
          				// if ($data['dokumen_0']=null) {
          				// 	$foto1="foto belum ada";
          				// }
          				// else{
          				// 	$foto1="upload/".$data['dokumen_0'];
          				// }
          				// if ($data['dokumen_50']=null) {
          				// 	$foto2="foto belum ada";
          				// }
          				// else{
          				// 	$foto2="upload/".$data['dokumen_50'];
          				// }
          				// if ($data['no_foto']=null) {
          				// 	$foto3="foto belum ada";
          				// }
          				// else{
          				// 	$foto3="upload/".$data['no_foto'];
          				// }
          				echo "<tr><td >".$no++."</td>
            <td >".$data['jenis_kegiatan']."</td>
            <td >".$data['kegiatan']."</td>
            <td >".$data['lokasi']."</td>
            <td >".$data['jumlah_sasaran']." ".$data['satuan_sasaran']."</td>
            <td >".$data['instansi']."</td>
            <td >Rp ".$data['nilai_pagu']."</td>
            <td >".$data['sumber_dana']."</td>
            <td >".$data['tahun']."</td>
            <td >".$data['progres']."</td>
            <td ><img src='$webRoot/upload/".$data['dokumen_0']."'></td>
            <td ><img src='$webRoot/upload/".$data['dokumen_50']."'></td>
            <td ><img src='$webRoot/upload/".$data['no_foto']."'></td></tr>";
          			}
          		}
          	?>
          	<!-- <td >Nomor</td>
            <td >Instansi</td>
            <td >Jenis Kegiatan</td>
            <td >Lokasi</td>
            <td >Jumlah Sasaran</td>
            <td >Nilai Pagu</td>
            <td >Sumber dana</td>
            <td >Tahun</td>
            <td >Progres</td>
            <td >Dokumen 0%</td>
            <td >Dokumen 50%</td>
            <td >Dokumen 100%</td> -->
          
		</table>
	</div>
  <div class="row">
    <div class="large-12 columns">
      <ul class="pagination">
      <?php
        if ($halaman > 1){
            $previous=$halaman-1;
            echo "<li><a href='?page=$page&halaman=1'>First</a></li><li><a href='?page=$page&halaman=$previous'>Previous</a></li>";
          }

          for($page1 = 1; $page1 <= $jmlhalaman; $page1++)
          {
                   if ((($page1 >= $halaman - 3) && ($page1 <= $halaman + 3)) || ($page1 == 1) || ($page1 == $jumPage)) 
                   {   
                      if (($showPage == 1) && ($page1 != 2))  echo "<li><a href='#'>...</a></li>"; 
                      if (($showPage != ($jmlhalaman - 1)) && ($page1 == $jmlhalaman))  echo "<li><a href='#'>...</a></li>";
                      if ($page1 == $halaman) echo "<li class='current'><a href='#'>".$page1."</a></li>";
                      else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=$page&halaman=".$page1."'>".$page1."</a></li>";
                      $showPage = $page1;          
                   }
          }
          if ($halaman<$jmlhalaman) {
            $next=$halaman+1;
            echo "<li><a href='?page=$page&halaman=$next'>Next</a></li><li><a href='?page=$page&halaman=$jmlhalaman'>Last</a></li>";
          }
      ?>
    </ul>
    </div>
  </div>
</div>

<!-- modal -->
<div id="myModal" class="reveal-modal">
  <form class="custom" method="post" action="?page=searchhasil">
  <fieldset>
    <legend>Advance Search Hasil Kegiatan</legend>

    <div class="row">
      <div class="large-5 columns">
        <label>Keyword</label>
        <input type="text" placeholder="Keyword" name="keyword">
      </div>
    </div>

    <div class="row">
        <div class="large-12 columns">
      <label for="customDropdown1">Jenis Kegiatan</label>
      <select id="customDropdown1" class="medium" name="jenis">
        <option value="0">- Pilih Jenis Kegiatan -</option>
        <?php
          $sql="select distinct(jenis_kegiatan) as jenis from rekapitulasi_kegiatan where deleted=false";
          $result=mysql_query($sql);
          if ($result) {
            while ($data=mysql_fetch_array($result)) {
              echo "<option value='".$data['jenis']."'>".$data['jenis']."</option>";
            }
          }
        ?>
      </select>
    </div>
    </div>

    <div class="row">
      <div class="large-12 columns">
      <label for="customDropdown1">Instansi</label>
      <select id="customDropdown1" class="medium" name="instansi">
        <option value="0">- Pilih Instansi -</option>
        <?php
          $sql="select distinct(instansi) as instansi from rekapitulasi_kegiatan where deleted=false";
          $result=mysql_query($sql);
          if ($result) {
            while ($data=mysql_fetch_array($result)) {
              echo "<option value='".$data['instansi']."'>".$data['instansi']."</option>";
            }
          }
        ?>
      </select>
    </div>
    </div>

    <div class="row">
      <div class="large-12 columns">
      <label for="customDropdown1">Jumlah Data Yang Akan Ditampilkan</label>
      <select id="customDropdown1" class="medium" name="limit">
        <option value="10">10</option>
        <option value="30">30</option>
        <option value="50">50</option>
        <option value="0">Semua Data</option>
      </select>
    </div>
    </div>
    <button type="submit" name="cari" class="small button radius">Cari</a>
  </fieldset>
</form>
</div>