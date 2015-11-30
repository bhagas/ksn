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

	$sql="select *, DAY(inserted) as tanggal, MONTHNAME(inserted) as bulan, year(inserted) as tahun, TIME(inserted) as waktu from artikel where deleted=false ORDER BY inserted desc LIMIT $posisi,$batas";
		$sql3="select * from artikel where deleted=false";
	
	$result3=mysql_query($sql3);

	$jmldata=mysql_num_rows($result3);
	$jmlhalaman=ceil($jmldata/$batas);


	$result2=mysql_query($sql2);
?>
<div class="row">
	<div class="row">
		<div class="large-5 columns">
		<nav class="breadcrumbs">
		  <a href="?page=home">Home</a>
		  <a class="current">Artikel</a>
		</nav>
	</div>
	</div>
	<h2 class="subheader">Artikel</h2>
	<?php
		$result=mysql_query($sql);
		if ($result) {
			while ($data=mysql_fetch_array($result)) {
				$id=$data['id'];
				$judul=$data['judul'];
				$isi=strip_tags($data['isi']);
				$tanggal=$data['tanggal']." ".$data['bulan']." ".$data['tahun'];
				$waktu=$data['waktu'];
				$user=$data['id_user'];
				$foto=$data['fotopreview'];

				echo "<hr>
	<div class='large-11 columns thread'>
		<div class='large-3 columns'>
			<img class='th' src='upload/artikel/".$foto."'>
		</div>
		<div class='large-9 columns'>
			<dl>
			<dt>
				<a href='?page=detailartikel&id=".$id."'>".$judul."</a>
			</dt>
			<dd>
				<h6 class='subheader'>".$user." | ".$tanggal." ".$waktu."</h6>
			</dd>
			<dd>";
			$post=getContent($isi);
			echo $post;
			echo "....<br><a href='?page=detailartikel&id=".$id."'>Selanjutnya</a>
			</dd>
		</dl>
		</div>
	</div>";
			}
		}
	?>
	<div class="row">
		<div class="large-12 columns pagination-centered">
			<ul class="pagination">
		  <?php
		  	if ($halaman > 1){
						$previous=$halaman-1;
						echo "<li><a href='?page=$page&halaman=1'>First</a></li><li class='arrow'><a href='?page=$page&halaman=$previous'>&laquo;</a></li>";
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
						echo "<li class='arrow'><a href='?page=$page&halaman=$next'>&raquo;</a></li><li><a href='?page=$page&halaman=$jmlhalaman'>Last</a></li>";
					}

		  	// echo "<li class='arrow'><a href='$_SERVER[PHP_SELF]?page=artikel&halaman=1'>&laquo;</a></li>";
		  	// for ($i=1; $i<=$jmlhalaman ; $i++) { 
		  	// 	if ($i != $halaman) {
		  	// 		echo "<li><a href=$_SERVER[PHP_SELF]?page=artikel&halaman=$i>$i</a></li>";
		  	// 	}
		  	// 	else {
		  	// 		echo "<li class='current'><a href=$_SERVER[PHP_SELF]?page=artikel&halaman=$i>$i</a></li>";
		  	// 	}
		  	// }
		  	// echo "<li class='arrow'><a href='$_SERVER[PHP_SELF]?page=artikel&halaman=$jmlhalaman'>&raquo;</a></li>";
		  ?>
		</ul>
		</div>
	</div>
	</div>