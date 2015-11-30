<?php
			$id=$_GET['id'];
			$sql1="select * from ksn_wilayah where deleted=0";
			$result1=mysql_query($sql1);
			if ($result1) {
				if ($data1=mysql_fetch_array($result1)) {
					$wilayah=$data1['wilayah'];
					$deskripsi=$data1['deskripsi'];
					$kebijakan=$data1['kebijakan'];
					$perpres=$data1['perpres'];
          $infrastruktur=$data1['infrastruktur'];
				}
			}
			?>
<div class="col-md-12">
	<div class="row padding-20">
		<div class="page-header centered">
			<?php
				echo "<h2>".strtoupper($wilayah)."</h2>";
			?>
		</div>
		<?php
			$sql="select * from ksn_galeri where id_wilayah=".$id." and deleted=0";
			$result=mysql_query($sql);
			if ($result) {
				while ($data=mysql_fetch_array($result)) {
					echo "<a class='fancybox' rel='gallery1' href='upload/".$data['foto']."' title='".$data['foto']."'><img class='imgresize img-thumbnail margin-5' src='upload/thumbnail.php?id=$data[id]'></a>";
				}
			}
		?>
		<!-- <a class="fancybox" rel="gallery1" href="http://farm6.staticflickr.com/5471/9036958611_fa1bb7f827_b.jpg" title="Westfield Waterfalls - Middletown CT Lower (Graham_CS)">
	<img src="http://farm6.staticflickr.com/5471/9036958611_fa1bb7f827_m.jpg" alt="" /> -->
</a>
<hr>	
	<ul id="myTab" class="nav nav-tabs">
        <li style="list-style-type:none" <?php if (!isset($_GET['tab'])) {
   			echo "class='active'";
   		}
   		else {
   			echo "";
   		}
   		?>> <a class="no-decor" href="#deskripsi" data-toggle="tab">Deskripsi</a></li>
        <li style="list-style-type:none" ><a class="no-decor" href="#kebijakan" data-toggle="tab">Kebijakan</a></li>
        <li style="list-style-type:none" ><a class="no-decor" href="#perpres" data-toggle="tab">Perpres</a></li>
        <li style="list-style-type:none" <?php if (isset($_GET['tab'])) {
   			echo "class='active'";
   		}
   		else {
   			echo "";
   		}
   		?>> 
      <a style="list-style-type:none" class="no-decor" href="#program" data-toggle="tab">Indikasi Program</a></li>
      <li><a style="list-style-type:none" class="no-decor" href="#infrastruktur" data-toggle="tab">Inftastruktur</a></li>
   	</ul>

   	<div id="myTabContent" class="tab-content">
   		<div class="tab-pane fade <?php if (!isset($_GET['tab'])) {
   			echo "in active";
   		}
   		else {
   			echo "";
   		}
   		?>" id="deskripsi">
   			<div class="col-md-12 justified">
   				<div class="page-header centered">
   						<h3>Deskripsi</h3>
   					</div>
   				<?php
   					echo $deskripsi;
   				?>
   			</div>
   		</div>
   		<div class="tab-pane fade" id="kebijakan">
   			<div class="col-md-12 justified">
   				<div class="page-header centered">
   						<h3>Kebijakan</h3>
   					</div>
   				<?php
   					echo $kebijakan;
   				?>
   			</div>
   		</div>
   		<div class="tab-pane fade" id="perpres">
   			<div class="col-md-12 justified">
   				<div class="page-header centered">
   						<h3>Peraturan Presiden</h3>
   					</div>
   				<?php
   					echo $perpres;
   				?>
   			</div>
   		</div>
      <div class="tab-pane fade" id="infrastruktur">
        <div class="col-md-12 justified">
          <div class="page-header centered">
              <h3>Infrastruktur</h3>
            </div>
          <?php
            echo $infrastruktur;
          ?>
        </div>
      </div>
   		<div class="tab-pane fade <?php if (isset($_GET['tab'])) {
   			echo "in active";
   		}
   		else{
   			echo "";
   		}
   		?>" id="program">
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

  $sql2="select * from indikasi_program where id_wilayah='".$id."' and deleted='0' ORDER BY inserted desc limit $posisi,$batas";
  $sql3="select * from indikasi_program where id_wilayah='".$id."' and deleted='0'";
  
  $result3=mysql_query($sql3);

  $jmldata=mysql_num_rows($result3);
  $jmlhalaman=ceil($jmldata/$batas);


  $result2=mysql_query($sql2);
?>
   			<div class="row padding-20">
   				<div class="col-md-10 justified">
   					<div class="page-header centered">
   						<h3>Indikasi Program</h3>
   					</div>
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
   				</div>
   			</div>
    <ul class="pagination">
      <?php
        echo "<li><a href='$_SERVER[PHP_SELF]?page=detail&id=".$id."&tab=1&halaman=1'>&laquo;</a></li>";
        for ($i=1; $i<=$jmlhalaman ; $i++) { 
          if ($i != $halaman) {
            echo "<li><a href=$_SERVER[PHP_SELF]?page=detail&id=".$id."&tab=1&halaman=$i>$i</a></li>";
          }
          else {
            echo "<li class='active'><a href=$_SERVER[PHP_SELF]?page=detail&id=".$id."&tab=1&halaman=$i>$i</a></li>";
          }
        }
        echo "<li><a href='$_SERVER[PHP_SELF]?page=detail&id=".$id."&tab=1&halaman=$jmlhalaman'>&raquo;</a></li>";
      ?>
    </ul>
   		</div>
   	</div>
	</div>
</div>
