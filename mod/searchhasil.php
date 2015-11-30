<?php
	$jenis=$_POST['jenis'];
	$instansi=$_POST['instansi'];
	$limit=$_POST['limit'];
	$keyword=$_POST['keyword'];
	if (isset($_GET['submit'])) {
		$jenis=$_GET['jenis'];
	$instansi=$_GET['instansi'];
	$limit=$_GET['limit'];
	$keyword=$_GET['keyword'];
	}

  //paging
  $halaman=$_GET['halaman'];
  if (empty($halaman)) {
    $posisi = 0;
    $halaman = 1;
  }
  else {
    $posisi = ($halaman - 1) * $limit;
  }

  $sql4="select * from rekapitulasi_kegiatan where deleted=false";
	if ($keyword!=null) {
		$sql4=$sql4." and instansi LIKE '%".$keyword."%' or jenis_kegiatan LIKE '%".$keyword."%' or kegiatan LIKE '%".$keyword."%' or lokasi LIKE '%".$keyword."%'";
	}
	if ($keyword=="") {
		$sql4=$sql4."";
	}
	if ($jenis!="0") {
		$sql4=$sql4." and jenis_kegiatan='".$jenis."'";
	}
	if ($instansi!="0") {
		$sqlcount=$sql4." and instansi='".$instansi."'";
		$sql4=$sql4." and instansi='".$instansi."'";
	}
	if ($limit!="0") {
		$sql4=$sql4." limit $posisi, $limit";
	}
	 //echo $sqlcount."<br>";
	  //echo $sql4;
  $result3=mysql_query($sqlcount);
	if ($result3) {
		$jmldata=mysql_num_rows($result3);
		//echo $sqlcount;
	  $jmlhalaman=ceil($jmldata/$limit);
	}

  $result2=mysql_query($sql4);
?>
<div class="row">
	<div class="large-12 columns">
		<nav class="breadcrumbs">
		  <a href="?page=home">Home</a>
		  <a class="current">Hasil Pencarian Kegiatan Merapi dan Borobudur</a>
		</nav>
	</div>
</div>
<hr>
<div class="row">
<h3>Hasil Pencarian Kegiatan Merapi dan Borobudur</h3>
	<div class="large-12 columns">
		<div class="large-2 columns">
			<div data-alert class="alert-box">
		<p>Ditemukan <?php echo $jmldata;?> Data</p>
		</div>
		</div>
		<table align="right">
            <tr>
                <td valign="top"><a href="javascript:void(processPrint('list_content',''));"><img src="<?php echo $webRoot?>/images/printButton.png"></a>
                <td>
                    <form action="<?php echo $webRoot?>/SaveToExcel.php" method="post" onsubmit='$("#datatodisplay").val( $("<div>").append( $("#list_content").eq(0).clone() ).html() )'>
                        <input  type="image" src="<?php echo $webRoot?>/images/xls.gif">
                        <input type="hidden" id="datatodisplay" name="datatodisplay" />
                    </form>
                </td>
            </tr>
        </table>
	</div>
</div>
	<div class="row">
	<div class="large-12 columns">
		<table class="responsive" id="list_content">
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
          				if ($data['dokumen_0']=null) {
          					$foto1="foto belum ada";
          				}
          				else{
          					$foto1="upload/".$data['dokumen_0'];
          				}
          				if ($data['dokumen_50']=null) {
          					$foto2="foto belum ada";
          				}
          				else{
          					$foto2="upload/".$data['dokumen_50'];
          				}
          				if ($data['no_foto']=null) {
          					$foto3="foto belum ada";
          				}
          				else{
          					$foto3="upload/".$data['no_foto'];
          				}
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
            <td ><img src='".$foto1."'></td>
            <td ><img src='".$foto2."'></td>
            <td ><img src='".$foto3."'></td></tr>";
          			}
          		}
          	?>
          
		</table>
	</div>
  <div class="row">
    <div class="large-12 columns">
      <ul class="pagination">
      <?php
        echo "<li class='arrow'><a href='?page=searchhasil&halaman=1&limit=$limit&keyword=$keyword&jenis=$jenis&instansi=$instansi&submit=1'>&laquo;</a></li>";
        for ($i=1; $i<=$jmlhalaman ; $i++) { 
          if ($i != $halaman) {
            echo "<li><a href='?page=searchhasil&halaman=$i&limit=$limit&keyword=$keyword&jenis=$jenis&instansi=$instansi&submit=1'>$i</a></li>";
          }
          else {
            echo "<li class='current'><a href='?page=searchhasil&halaman=$i&limit=$limit&keyword=$keyword&jenis=$jenis&instansi=$instansi&submit=1'>$i</a></li>";
          }
        }
        echo "<li class='arrow'><a href='?page=searchhasil&halaman=$jmlhalaman&limit=$limit&keyword=$keyword&jenis=$jenis&instansi=$instansi&submit=1'>&raquo;</a></li>";
      ?>
    </ul>
    </div>
  </div>
</div>