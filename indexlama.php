<?php
	require_once "library/config.php";
?>
<html>
	<head>
		<title><?php echo $judul;?></title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<link rel="stylesheet" type="text/css" href="css/justified.css">
		<link rel="stylesheet" type="text/css" href="css/normalize.css">
		<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css">
	</head>
	<body>
		<!-- Top Banner -->
		<div class="row">
			<div class="banner">
				<div class="cycle-slideshow" data-cycle-fx="tileBlind"
				    data-cycle-timeout="5000" data-cycle-tile-count=20>
				    <?php
				    	$sql1="select * from banner where deleted=false";
				    	$result1=mysql_query($sql1);
				    	if ($result1) {
				    		while ($data=mysql_fetch_array($result1)) {
				    			echo "<img src=\"upload/banner/".$data['foto']."\">";
				    		}
				    	}
				    ?>
				    <div class="row caption">
						<img src="img/logo-jateng.png">
						<img src="img/pu.jpg">
						Sistem Informasi Geografis Kawasan Strategis Nasional
					</div>
				</div>

			</div>
		</div>
		<!-- end of slider -->
		<div class="container">
			<ul class="nav nav-justified">
	          <li><a href="?page=home">Home</a></li>
	          <li class="dropdown">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown">RTRW<b class="caret"></b></a>
		        <ul class="dropdown-menu">
		          <li><a href="?page=content&konten=nasional">RTRW Nasional</a></li>
		          <li><a href="?page=content&konten=jawa-bali">RTRP Jawa-Bali</a></li>
		          <li><a href="?page=content&konten=provinsi">RTRW Provinsi Jateng</a></li>
		          <li><a href="?page=kabupaten">RTRW Kabupaten</a></li>
		        </ul>
		      </li>
		      <li class="dropdown">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown">RTR KSN<b class="caret"></b></a>
		        <ul class="dropdown-menu">
		        	<?php
		        		$sql="select * from ksn where deleted=0";
		        		$result=mysql_query($sql);
		        		if ($result) {
		        			while ($data=mysql_fetch_array($result)) {
		        				echo "<li><a href=\"?page=content&id=".$data['jenis']."\">".ucfirst($data['jenis'])."</a></li>";
		        			}
		        		}
		        	?>
		        </ul>
		      </li>
	          <li><a href="#">RTR KSP</a></li>
	          <!-- <li><a href="?page=indikasi_program">Indikasi Program</a></li> -->
	          <li><a href="peta.php" target="_blank">Peta</a></li>
        </ul>
        <?php
        		$page=$_GET['page'];
        		if ($page=="") {
        			$page="home";
        		}
        		$path="mod/".$page.".php";
        		require_once $path;
        	?>
		</div>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
		<script type="text/javascript" src="js/jquery.fancybox.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.cycle2.js"></script>
		<script type="text/javascript" src="js/jquery.cycle2.tile.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$(".fancybox").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true
			});
			});
		</script>
	</body>
</html>