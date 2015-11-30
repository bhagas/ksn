<?php

require_once './library/config.php';


?>
<!DOCTYPE HTML>
<HTML style="height:100%">
<HEAD>
<TITLE><?php echo $judul ?></TITLE>
<link rel="stylesheet" href="<?php echo $webRoot?>/css/OpenLayers/theme/default/style.css" type="text/css">
<link rel="stylesheet" href="<?php echo $webRoot?>/css/style.css" type="text/css">
<link rel="stylesheet" href="<?php echo $webRoot?>/css/styleBack.css" type="text/css">
<link rel="stylesheet" href="<?php echo $webRoot?>/css/OpenLayers/styleOL.css" type="text/css">
<script class="jsbin" src="./js/jquery.min.js"></script> 
<script class="jsbin" src="./js/jquery-ui.min.js"></script>
<script type="text/javascript" src="./js/ajax.js"></script>
<script type="text/javascript" src="<?php echo $webRoot?>/js/jquery.touchSwipe.min.js"></script>
<script>
	$(window).load(function(){
        $("[data-toggle]").click(function() {
          var toggle_el = $(this).data("toggle");
          //$(toggle_el).toggleClass("open-sidebar");
          toggleLeftPanel();
        });
         $(".swipe-area").swipe({
              swipeStatus:function(event, phase, direction, distance, duration, fingers)
                  {
                  	  //alert(phase);
                      if (phase=="move" && direction =="right") {
                           //$(".container").addClass("open-sidebar");
                           toggleLeftPanel();
                           return false;
                      }
                      if (phase=="move" && direction =="left") {
                           //$(".container").removeClass("open-sidebar");
                           toggleLeftPanel();
                           return false;
                      }
                  }
          }); 
      });
</script>

</HEAD>
<body>
	<div id="wrapper">
	<div id="leftPanel">
	
		<?php
		require_once("left.php");
		/*
		<iframe src="peta_setup.php?<?php echo $qry;?>&left=1;" width="90%" height="80%" name="leftFrame">
	  		<p>Your browser does not support iframes.</p>
		</iframe>
		*/
		?>

	</div>
	<div id="rightPanel" class="mainPanel">
		<div class="swipe-area">
		<a href="#" data-toggle=".wrapper" id="sidebar-toggle">
              <span class="bar"></span>
              <span class="bar"></span>
              <span class="bar"></span>
          </a>

		</div>
		  <div id="mainContent" class="mainContent">
		  	<?php
		  		//require_once("map.php");
		  		
		  	?>
			  <iframe src="map.php?<?php echo $qry;?>" width="100%" height="100%" name="mapFrame" id="mapFrame">
	  			<p>Your browser does not support iframes.</p>
			  </iframe>
			
		   </div>
	</div>
</div>
<div id="divLoading"></div>
</body>
</html>