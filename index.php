<?php
  require_once "library/config.php";
  $page=$_GET['page'];
            if ($page=="") {
              $page="home";
            }
?>
<!DOCTYPE html><!--[if IE 7]>
<html lang="en" class="ie7 oldie"></html><![endif]--><!--[if IE 8]>
<html lang="en" class="ie8 oldie"></html><![endif]-->
<!-- [if gt IE 8] <!-->

<html lang="en">

  <!-- <![endif]-->
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Kawasan Strategis Nasional Provinsi Jawa Tengah</title>
    <link href="css/flexnav.css" media="screen, projection" rel="stylesheet" type="text/css">
    <link href="css/page.css" media="screen, projection" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" type="text/css" href="css/responsive-tables.css">
    <script src="js/vendor/custom.modernizr.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>

    </head>
    <body class="home-page">
      <div class="row header">
          <div class="large-12 columns ">
            <img src="img/pu.jpg">
            <img src="img/logo-jateng.png">
          </div>
      </div>
      <div class="row header">
        <div class="large-12 columns">
            <div class="title">
              <h3>Sistem Informasi Geografis Kawasan Strategis Nasional<br>Provinsi Jawa Tengah</h3>
            </div>
          </div>
      </div>
          <nav class="top-bar">
  <ul class="title-area">
    <!-- Title Area -->
    <li class="name">
     
    </li>
    <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>

  <section class="top-bar-section">
    <!-- Left Nav Section -->
    <ul class="left">
      <li><a href="?page=home">Home</a></li>
      <li><a href="?page=artikel">Artikel</a></li>
      <li class="has-dropdown"><a href="#">Profil Wilayah</a>
        <ul class="dropdown">
          <li><a href="?page=profil&tipe=provinsi">Profil Provinsi Jawa Tengah</a></li>
          <li class="has-dropdown"><a href="#">Profil Kabupaten</a>
            <ul class="dropdown">
              <li><a href="?page=profil&tipe=magelang">Kabupaten Magelang</a></li>
              <li><a href="?page=profil&tipe=boyolali">Kabupaten Boyolali</a></li>
              <li><a href="?page=profil&tipe=klaten">Kabupaten Klaten</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="has-dropdown"><a href="#">Rencana Tata Ruang</a>
        <ul class="dropdown">
          <li><a href="?page=peraturan&id=nasional">RTRW Nasional</a></li>
          <li><a href="?page=peraturan&id=jawabali">RTR Pulau Jawa-Bali</a></li>
          <li><a href="?page=peraturan&id=jateng">RTRW Provinsi Jateng</a></li>
          <li class="has-dropdown"><a href="#">RTRW Kabupaten</a>
            <ul class="dropdown">
              <li><a href="?page=peraturan&id=magelang">Kabupaten Magelang</a></li>
              <li><a href="?page=peraturan&id=boyolali">Kabupaten Boyolali</a></li>
              <li><a href="?page=peraturan&id=klaten">Kabupaten Klaten</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="has-dropdown"><a href="#">Peraturan</a>
        <ul class="dropdown">
          <li class="has-dropdown"><a href="#">Peraturan Presiden</a>
            <ul class="dropdown">
              <li><a href="?page=peraturan&id=borobudur">KSN Borobudur</a></li>
              <li><a href="?page=peraturan&id=merapi">KSN Merapi</a></li>
              <li><a href="#">KSN Prambanan</a></li>
            </ul>
          </li>
          <li class="has-dropdown"><a href="#">Perda</a>
            <ul class="dropdown">
          <li><a href="?page=peraturan&id=jateng">RTRW Provinsi Jateng</a></li>
              <li class="has-dropdown"><a href="#">Kabupaten</a>
                <ul class="dropdown">
              <li><a href="?page=peraturan&id=magelang">Kabupaten Magelang</a></li>
              <li><a href="?page=peraturan&id=boyolali">Kabupaten Boyolali</a></li>
              <li><a href="?page=peraturan&id=klaten">Kabupaten Klaten</a></li>
            </ul>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="has-dropdown"><a href="#">Program Infrastruktur</a>
        <ul class="dropdown">
          <li class="has-dropdown"><a href="#">Rencana Kegiatan</a>
            <ul class="dropdown">
              <li><a href="?page=rencana&kawasan=borobudur">KSN Borobudur</a></li>
              <li><a href="?page=rencana&kawasan=merapi">KSN Merapi</a></li>
              <li><a href="#">KSN Prambanan</a></li>
            </ul>
          </li>
          <li><a href="?page=hasil">Hasil Kegiatan</a></li>
          <li class="has-dropdown"><a href="#">Kegiatan Prioritas</a>
            <ul class="dropdown">
              <li><a href="?page=prioritas&kawasan=borobudur">KSN Borobudur</a></li>
              <li><a href="?page=prioritas&kawasan=merapi">KSN Merapi</a></li>
              <li><a href="#">KSN Prambanan</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="has-dropdown"><a href="#">RTR KSN</a>
        <ul class="dropdown">
          <li class="has-dropdown"><a href="#">KSN Merapi</a>
            <ul class="dropdown">
              <li><a href="?page=detailksn&ksn=merapi&konten=ksn_perpres">Kebijakan Perpres</a></li>
              <li><a href="?page=detailksn&ksn=merapi&konten=ksn_tujuan_tata_ruang">Tujuan Penataan Ruang</a></li>
              <li><a href="?page=detailksn&ksn=merapi&konten=ksn_kebijakan_strategi">Kebijakan dan Strategi</a></li>
              <li><a href="?page=detailksn&ksn=merapi&konten=ksn_rencana_evakuasi">Rencana Sistem Evakuasi Bencana</a></li>
              <li><a href="?page=detailksn&ksn=merapi&konten=ksn_rencana_struktur_ruang">Rencana Struktur Ruang</a></li>
              <li><a href="?page=detailksn&ksn=merapi&konten=ksn_rencana_lindung">Rencana Pola Ruang Kawasan Lindung</a></li>
              <li><a href="?page=detailksn&ksn=merapi&konten=ksn_rencana_budaya">Rencana Pola Ruang Kawasan Budaya</a></li>
            </ul>
          </li>
          <li class="has-dropdown"><a href="#">KSN Borobudur</a>
            <ul class="dropdown">
              <li><a href="?page=detailksn&ksn=borobudur&konten=ksn_perpres">Kebijakan Perpres</a></li>
              <li><a href="?page=detailksn&ksn=borobudur&konten=ksn_tujuan_tata_ruang">Tujuan Penataan Ruang</a></li>
              <li><a href="?page=detailksn&ksn=borobudur&konten=ksn_kebijakan_strategi">Kebijakan dan Strategi</a></li>
              <li><a href="?page=detailksn&ksn=borobudur&konten=ksn_rencana_struktur_ruang">Rencana Struktur Ruang</a></li>
              <li><a href="?page=detailksn&ksn=borobudur&konten=ksn_rencana_lindung">Rencana Pola Ruang Kawasan Lindung</a></li>
              <li><a href="?page=detailksn&ksn=borobudur&konten=ksn_rencana_budaya">Rencana Pola Ruang Kawasan Budaya</a></li>
            </ul>
          </li>
          <li class="has-dropdown"><a href="#">KSN Prambanan</a>
            <ul class="dropdown">
              <li><a href="?page=detailksn&ksn=prambanan&konten=ksn_perpres">Kebijakan Perpres</a></li>
              <li><a href="?page=detailksn&ksn=prambanan&konten=ksn_tujuan_tata_ruang">Tujuan Penataan Ruang</a></li>
              <li><a href="?page=detailksn&ksn=prambanan&konten=ksn_kebijakan_strategi">Kebijakan dan Strategi</a></li>
              <li><a href="?page=detailksn&ksn=prambanan&konten=ksn_rencana_struktur_ruang">Rencana Struktur Ruang</a></li>
              <li><a href="?page=detailksn&ksn=prambanan&konten=ksn_rencana_lindung">Rencana Pola Ruang Kawasan Lindung</a></li>
              <li><a href="?page=detailksn&ksn=prambanan&konten=ksn_rencana_budaya">Rencana Pola Ruang Kawasan Budaya</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="has-dropdown"><a href="#">RTR KSP</a>
        <ul class="dropdown">
          <li><a href="">Kawasan Perkotaan Bergasmalang</a></li>
          <li><a href="">Kawasan Perkotaan Petanglong</a></li>
          <li><a href="">Kawasan Perkotaan Cepu</a></li>
          <li><a href="">Kawasan Masjid Agung Demak dan Kadilangu</a></li>
          <li><a href="">Kawasan Koridor Perbatasan Purwokulon</a></li>
          <li><a href="">Kawasan Candi Gedongsongo</a></li>
          <li><a href="">Kawasan Rawa Pening</a></li>
          <li><a href="">Kawasan Dataran Tinggi Dieng</a></li>
          <li><a href="">Kawasan Kebun Raya Baturraden</a></li>
        </ul>
      </li>
      <li><a href="<?php echo$webRoot;?>/peta.php" target="_BLANK">Peta</a></li>
    </ul>

    <!-- Right Nav Section -->
    <ul class="right">
      
      
      <li class="has-form">
        <form method="post" action="?page=search">
          <div class="row collapse">
            <div class="small-9 columns">
              <input type="text" name="artikel" placeholder="Cari Artikel">
            </div>
            <div class="small-3 columns">
              <button type="submit" name="cari" class="button">Cari</a>
            </div>
          </div>
        </form>
      </li>
    </ul>
  </section>
</nav>
      <div class="container">
        <?php
            if ($page=="home") {
              echo "<div class='row'>
          <div class='cycle-slideshow' 
          data-cycle-fx='scrollHorz' 
          data-cycle-tile-vertical=false
          data-cycle-tile-count=10 
          data-cycle-caption-plugin=caption2
          data-cycle-caption-fx-out='slideUp'
          data-cycle-caption-fx-in='slideDown'>
          <div class='cycle-overlay'></div>";
          
            $sql="select * from banner where deleted=false";
            $result=mysql_query($sql);
            if ($result) {
              while ($data=mysql_fetch_array($result)) {
                echo "<img class=\"banner\" src=\"upload/banner/".$data['foto']."\" data-cycle-title=\"".$data['deskripsi']."\" data-cycle-desc=\"\">";
              }
            }
          echo "</div>
        </div>";
            }
         ?>
        <div class="row">
          <!-- article template -->
          <div class="large-12 columns wrapper">
            <div class="<?php if ($page=='home') {
              echo "large-9";
            }
            else{
              echo "large-12";
            }
            ?> columns wrapper">
              <?php
            
            $path="mod/".$page.".php";
            require_once $path;
          ?>
            </div>
            <!-- Sidebar -->
            
                <?php
                  if ($page=="home") {
                    echo "<div class='large-3 columns sidebar'>
              <div class='panel sidebar_panel centered'><h5 class='subheader'>Link Terkait</h5></div>";
                    $sql1="select * from link where deleted=false";
                    $result1=mysql_query($sql1);
                    if ($result1) {
                      while ($data1=mysql_fetch_array($result1)) {
                    echo "
                    
                      <a href='".$data1['url']."' target='_blank'><div class='iklan'><img src='upload/link/".$data1['foto']."'></div></a>
                    ";
                      // echo $sql1;
                        
                      }
                    }
                    echo "</div>";
                  }

                ?>
                
            <!-- end of sidebar -->
          </div>
        </div>
      </div>
      <?php
        require_once "footer.php";
      ?>
      <script src="js/jquery-1.9.0.min.js"></script>
      <script src="js/jquery.flexnav.js" type="text/javascript"></script>
      <script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
      <script type="text/javascript" src="js/jquery.fancybox.js"></script>
      <script type="text/javascript" src="js/jquery.cycle2.js"></script>
      <script type="text/javascript" src="js/jquery.cycle2.caption2.js"></script>
      <script type="text/javascript" src="js/jquery.cycle2.tile.min.js"></script>
        <script>
    document.write('<script src=' +
    ('__proto__' in {} ? 'js/vendor/zepto' : 'js/vendor/jquery') +
    '.js><\/script>')
    </script>
    
    <script src="js/foundation.min.js"></script>
    
    
    <script src="js/foundation/foundation.js"></script>
    
    <script src="js/foundation/foundation.alerts.js"></script>
    
    <script src="js/foundation/foundation.clearing.js"></script>
    
    <script src="js/foundation/foundation.cookie.js"></script>
    
    <script src="js/foundation/foundation.dropdown.js"></script>
    
    <script src="js/foundation/foundation.forms.js"></script>
    
    <script src="js/foundation/foundation.joyride.js"></script>
    
    <script src="js/foundation/foundation.magellan.js"></script>
    
    <script src="js/foundation/foundation.orbit.js"></script>
    
    <script src="js/foundation/foundation.reveal.js"></script>
    
    <script src="js/foundation/foundation.section.js"></script>
    
    <script src="js/foundation/foundation.tooltips.js"></script>
    
    <script src="js/foundation/foundation.topbar.js"></script>
    
    <script src="js/foundation/foundation.interchange.js"></script>
    
    <script src="js/foundation/foundation.placeholder.js"></script>
    
    <script src="js/foundation/foundation.abide.js"></script>
    
    <script src="js/responsive-tables.js"></script>
    
    
    <script>
      $(document).foundation();

    </script>
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
