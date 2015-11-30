<?php

	require_once '../library/config.php';
	require_once 'template/header.php';
?>

		<!-- 	End of Header logo	 -->
		
		<!-- 	Begin of Content div	 -->
		<div class="content">
			<div class="row">
			<div class="col-md-1 pull-right margin-right">
				<img class="imgResize" src="images/pu.jpg">
			</div>
			<div class="col-md-1 pull-right margin-right">
				<img class="imgResize" src="images/logo-jateng.png">
			</div>
			<div class="col-md-9 padtop pull-right">
				<h3 class="right-align">Panel Administrator<br>Sistem Informasi Kawasan Strategis Nasional<br>Satuan Kerja Dekonsentrasi Dinas Cipta Karya dan Tata Ruang<br>Provinsi Jawa Tengah</h3>
			</div>
		</div>
		<hr class="style-two">
		<!-- 	content here	 -->
			<?php
				//check_login();
				$page = $_GET['page'];
				if ($page == "") {
					# code...
					$page="home";
					if ($_GET['actionedit']==1) {
							$page="user";
						}
					elseif ($_GET['actionedit']==2) {
						$page="artikel";
					}
					elseif ($_GET['actionedit']==3) {
						$page="shoutbox";
					}
					elseif ($_GET['editsubmit']==3) {
						$page="shoutbox";
					}
					elseif ($_GET['actionhapus']==1) {
						$page="artikel";
					}
					elseif ($_GET['actionhapus']==2) {
						$page="shoutbox";
					}
					elseif ($_GET['actionhapus']==3) {
						$page="regulasi";
					}
					elseif ($_GET['actiontampil']==3) {
						$page="regulasi";
					}
					elseif ($_GET['halaman']) {
						$page="program";
					}
					elseif ($_GET['halaman1']) {
						$page="komentar";
					}
					
					
				}

				$path="mod/".$page.".php";
				require_once $path;

			?>
		</div>
		<!-- 	End of Content div	 -->
			<!-- 	Slide Left Panel	 -->
			<div id="leftPanel">
				<div class="nav1">
					<ul>
						<li><a href="?page=home"><img src="images/home.png">Home</a></li>
						<li><a href="?page=ksn"><img src="images/page.png">RTR KSN</a></li>
						<li><a href="?page=rtrksp"><img src="images/page.png">RTRKSP</a></li>
						<li><a href="?page=hal_keterpaduan"><img src="images/page.png">Rencana Kegiatan</a></li>
						<li><a href="?page=rekapitulasi"><img src="images/page.png">Hasil Kegiatan</a></li>
						<li><a href="?page=hal_program"><img src="images/page.png">Kegiatan Prioritas</a></li>
						<li><a href="?page=profil"><img src="images/page.png">Profil Wilayah</a></li>
						<!-- <li><a href="?page=hal_perpres"><img src="images/page.png">perpres</a></li> -->
						<li><a href="?page=artikel"><img src="images/page.png">Artikel</a></li>
						<li><a href="?page=linksidebar"><img src="images/page.png">Link Sidebar</a></li>
						<li><a href="?page=banner"><img src="images/banner.png">Banner</a></li>
						<li><a href="?page=user"><img src="images/user.png">User</a></li>
						<li><a href="../peta.php" target="_blank"><img src="images/map.png">Peta</a></li>
						<li><a href="../" target="_blank"><img src="images/web.png">Web Page</a></li>
						<li><a href="index.php?logout=1"><img src="images/logout.png">Logout</a></li>
					</ul>
				</div>
			</div>
			<!-- 	End of Slide Panel	 -->
		</div>
		
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/jquery.pageslide.min.js"></script>
		<script>
        /* Slide to the left, and make it model (you'll have to call $.pageslide.close() to close) */
        $(".panel").pageslide({direction:"right"});
    </script>
    <script>
    $('input[type=file]').bootstrapFileInput();
	$('.file-inputs').bootstrapFileInput();
    </script>
    <?php ob_flush();?>
	</body>
</html>
