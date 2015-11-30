<?php

require_once '../library/config.php';
$username = $_POST['username'];
$pwd = $_POST['pwd'];

$messagenama="";
$messagepassword="";
$messagefinal="";
$messageSuccess="";
//session_start();
if (isset($_POST['login'])) {
      if ($username=="") {
        $messagenama=$messagenama."Username tidak boleh kosong!";
      }
      if ($pwd=="") {
        $messagepassword=$messagepassword."Password tidak boleh kosong!";
      }
      if ($messagenama=="" && $messagepassword=="") {
        echo $pass;
        $sql = "select * from user_gis where deleted = 0 and username = '".$username."' and pwd = '".$pwd."'";
        $result3 = mysql_query($sql);
        if ($result3) {
            while ($row3 = mysql_fetch_array($result3)) {
              $_SESSION['uname'] = $row3['id_user'];
              $_SESSION['name'] = $row3['username'];
              $_SESSION['pass'] = $row3['pwd'];
              $_SESSION['fullname'] = $row3['fullname'];
              $_SESSION['position'] = $row3['status'];
              $stat = 1;
              //update last login
              $sqlt = "update user_gis set last_login = now() where id_user = '".$row3['id_user']."'";
              $resultt = mysql_query($sqlt);
            }
        }
      }
      if ($stat == 0) {
        $messagefinal = $messagefinal."<div class='alert alert-danger'>Username dan Password tidak Ditemukan!<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a></div>";
      }
} 
if (isset($_GET['logout'])) {
      $_SESSION['uname'] = NULL;
      $_SESSION['name'] = NULL;
      $_SESSION['fullname'] = NULL;
      $_SESSION['position'] = NULL;
      @session_regenerate_id();
      @session_destroy();
      @header("Location: $webRootAdmin");
    
}
if (isset($_SESSION['uname'])) {
     //echo "Klik <a href=\"content.php\">disini</a> untuk melanjutkan";
      header("Location: content.php");
}
?>
  <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sistem Informasi Geografis Kawasan Strategis Negara Provinsi Jawa Tengah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo $webRootAdmin;?>/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo $webRootAdmin;?>/css/login.css">
    <link href="<?php echo $webRootAdmin;?>/css/bootstrap-responsive.css" rel="stylesheet">

  </head>

  <body>
    <div class="container">
      <form class="form-signin" method="POST">
        <div class="row">
        <div class="col-md-12">
          <?php echo $messagefinal;?>
        </div>
      </div>
        <div class="row">
          <div class="col-md-4 centered">
            <img src="<?php echo $webRootAdmin;?>/images/logo-jateng.png">
            <h5>Sistem Informasi Kawasan Strategis Negara<br>Provinsi Jawa Tengah</h5>
          </div>
          <div class="col-md-8 left-bordered">
            <h3>Halaman Login Panel Administrator</h3>
        <input type="text" class="form-control" placeholder="Username" name="username">
        <input type="password" class="form-control" placeholder="Password" name="pwd">
        <button class="btn btn-default btn-info" name="login" type="submit">Sign in</button>
          </div>
        </div>
      </form>
    
     </div>
     <script src="<?php echo "$webRootAdmin";?>/js/jquery.js"></script>
     <script src="<?php echo "$webRootAdmin";?>/js/bootstrap.js"></script>
     </body>
 </html>

