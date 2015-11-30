<?php

  $username = null;
  $password = null;
  $password2 = null;
  $telepon=null;
  $email=null;
  $namaLengkap=null;

   function check_Av($username,$id_user) {
    global $dbh;
    $stat = 0;
    $sql = "select username from user_gis where deleted=false and username = '".$username."'";
    if ($id_user != "") {
      $sql = $sql." and id_user!=".$id_user;
    }
    //echo $sql;
    $result = mysql_query($sql);
    if ($result) {
      while ($row = mysql_fetch_array($result)) {
        $stat = 1;
      }
    }
    if ($stat == 1) {
      return(true);
    } else {
      return(false);
    }
 }
 function resetVar(){
  $username = null;
  $password = null;
  $password2 = null;
  $telepon=null;
  $email=null;
  $namaLengkap=null;
  
 }
  $user=$_SESSION['name'];

  $username2=$_POST['username'];
  $password3=$_POST['password'];
  $password22=$_POST['password2'];
  $namaLengkap2=$_POST['namaLengkap'];
  $email2=$_POST['email'];
  $telepon2=$_POST['telepon'];


  $messageUser=null;
  $messageUser2=null;
  $messagePwd=null;
  $messagePwd2=null;
  $messagePwd3=null;
  $messageNama=null;
  $messageNama2=null;
  $messageEmail=null;
  $messageEmail2=null;
  $messageTelepon=null;
  $messageTelepon2=null;
  $messageSuccess=null;
  $messageFailed=null;

  //checking Input and give message warning
  if (isset($_POST['add'])) {
    # code...
    if ($username2=="") {
      $messageUser=$messageUser."has-error";
      $messageUser2=$messageUser2."Username Tidak Boleh Kosong!";
    }
    if ($password3=="" && $password22=="") {
      $messagePwd=$messagePwd."has-error";
      $messagePwd2=$messagePwd2."Password Tidak Boleh Kosong!";
    }
    if ($password3!=$password22) {
      $messagePwd=$messagePwd."has-error";
        $messagePwd3=$messagePwd3."Kombinasi Password Tidak Sama";
    }
    if ($namaLengkap2=="") {
      $messageNama=$messageNama."has-error";
      $messageNama2=$messageNama2."Nama Lengkap Tidak Boleh Kosong!";
    }
    if ($email2=="") {
      $messageEmail=$messageEmail."has-error";
      $messageEmail2=$messageEmail2."Email Tidak Boleh Kosong!";
    }
    if ($telepon2=="") {
      $messageTelepon=$messageTelepon."has-error";
      $messageTelepon2=$messageTelepon2."Telepon Tidak Boleh Kosong!";
    }
    if (check_Av($username2,"")==true){
      $messageFailed= $messageFailed."Username sudah dipakai!";
    }
    if ($messageUser=="" && $messageUser2=="" && $messagePwd=="" && $messagePwd2=="" && $messagePwd3=="" && $messageNama=="" && $messageNama2=="" && $messageEmail=="" && $messageEmail2=="" && $messageTelepon=="" && $messageTelepon2=="" && $messageFailed=="") {
      
      $sql5="insert into user_gis (username, pwd, status, fullname, email, telp) values ('".$username2."','$password22','admin','".$namaLengkap2."', '".$email2."', '".$telepon2."')";
      $result5=mysql_query($sql5);
      if ($result5) {
        $messageSuccess=$messageSuccess."Data Berhasil Ditambahkan";
        echo "<script>
          function Redirect(){
            window.location=\"?page=user\";
          }
          setTimeout(\"Redirect()\",1000);
        </script>";
      }
    }
  }

  //action delete user
  if ($_POST['editsubmit']) {
    if ($_POST['delete']) {
      $status=1;
      $sql6 = "update user_gis set deleted = true where id_user = '".$_POST['id_user']."'";
      $result5=mysql_query($sql6);
        if ($result5) {
           $messageFailed=$messageFailed."Data Berhasil Dihapus";
           echo "<script>
          function Redirect(){
            window.location=\"?page=user\";
          }
          setTimeout(\"Redirect()\",1000);
        </script>";
        }
     
    }
    else {
      if ($username2=="") {
      $messageUser=$messageUser."has-error";
      $messageUser2=$messageUser2."Username Tidak Boleh Kosong!";
      }
      if ($password3=="" && $password22=="") {
        $messagePwd=$messagePwd."has-error";
        $messagePwd2=$messagePwd2."Password Tidak Boleh Kosong!";
      }
      if ($password3!=$password22) {
        $messagePwd=$messagePwd."has-error";
          $messagePwd3=$messagePwd3."Kombinasi Password Tidak Sama";
      }
      if ($namaLengkap2=="") {
        $messageNama=$messageNama."has-error";
        $messageNama2=$messageNama2."Nama Lengkap Tidak Boleh Kosong!";
      }
      if ($email2=="") {
        $messageEmail=$messageEmail."has-error";
        $messageEmail2=$messageEmail2."Email Tidak Boleh Kosong!";
      }
      if ($telepon2=="") {
        $messageTelepon=$messageTelepon."has-error";
        $messageTelepon2=$messageTelepon2."Telepon Tidak Boleh Kosong!";
      }
      if ($messageUser=="" && $messageUser2=="" && $messagePwd=="" && $messagePwd2=="" && $messagePwd3=="" && $messageNama=="" && $messageNama2=="" && $messageEmail=="" && $messageEmail2=="" && $messageTelepon=="" && $messageTelepon2=="") {
        //$status=1;
        $sql6 = "update user_gis set username = '".$username2."',pwd = '$password22',status = 'admin',fullname = '".$namaLengkap2."',email = '".$email2."',telp = '".$telepon2."' where id_user = '".$_POST['id_user']."'";
        $result5=mysql_query($sql6);
        if ($result5) {
          $messageSuccess=$messageSuccess."Data Berhasil Dirubah";
          echo "<script>
          function Redirect(){
            window.location=\"?page=user\";
          }
          setTimeout(\"Redirect()\",1000);
        </script>";
        }
      }
    }
   
  }
 if (isset($_GET['actionedit']) &&  isset($_GET['id_user']) ) {
    $sql4="select * from user_gis where id_user='".$_GET['id_user']."' and deleted='0'";
    $result4=mysql_query($sql4);
    if ($result4) {
      while ($row4=mysql_fetch_array($result4)) {
        $username=$row4['username'];
        $namaLengkap=$row4['fullname'];
        $password=$row4['pwd'];
        $password2=$row4['pwd'];
        $email=$row4['email'];
        $telepon=$row4['telp'];
      }
    }
  }
  //action Edit User
  
?>

<div class="row">
  <div class="col-md-12 centered">
      <h2>Manajemen User Administrator Web</h2>
    <hr>
</div></div>
<div class="row">
  <div class="col-md-6">
    <?php
      if ($messageSuccess!=""){
          ?><div class="alert alert-success"><?php echo $messageSuccess?></div><?php
        }
      if ($messageUser2!="" || $messageUser!="") {
        ?>
        <div class="alert alert-danger"><?php echo $messageUser2?></div>
        <?php
      }
      if ($messageFailed!="") {
        ?>
        <div class="alert alert-danger"><?php echo $messageFailed?></div>
        <?php
      }
    ?>
    <form role="form" method="post">
  <div class="form-group <?php echo $messageUser?>">
    <label class="control-label">Username</label>
    <input class="form-control" name="username" value="<?php echo $username?>">
  </div>
  <?php
    if ($messagePwd2!="") {
        ?>
        <div class="alert alert-danger"><?php echo $messagePwd2?></div>
        <?php
      }
      if ($messagePwd3!="") {
        ?>
        <div class="alert alert-danger"><?php echo $messagePwd3?></div>
        <?php
      }
  ?>
  <div class="form-group <?php echo $messagePwd?>">
    <label class="control-label">Password</label>
    <input type="password" class="form-control" name="password" value="<?php echo $password?>">
  </div>
  <div class="form-group <?php echo $messagePwd?>">
    <label class="control-label">Re-enter Password</label>
    <input type="password" class="form-control" name="password2" value="<?php echo $password2?>">
  </div>
<?php
    if ($messageNama!="" || $messageNama2!="") {
        ?>
        <div class="alert alert-danger"><?php echo $messageNama2?></div>
        <?php
      }
  ?>
  <div class="form-group <?php echo $messageNama?>">
    <label class="control-label">Nama Lengkap</label>
    <input class="form-control" name="namaLengkap" value="<?php echo $namaLengkap?>">
  </div>

  <?php
    if ($messageEmail!="" || $messageEmail2!="") {
        ?>
        <div class="alert alert-danger"><?php echo $messageEmail2?></div>
        <?php
      }
  ?>
  <div class="form-group <?php echo $messageEmail?>">
    <label class="control-label">Email</label>
    <input class="form-control" name="email" value="<?php echo $email?>">
  </div>
<?php
    if ($messageTelepon!="" || $messageTelepon2!="") {
        ?>
        <div class="alert alert-danger"><?php echo $messageTelepon2?></div>
        <?php
      }
  ?>
  <div class="form-group <?php echo $messageTelepon?>">
    <label class="control-label">Nomor Telepon/Handphone</label>
    <input class="form-control" name="telepon" value="<?php echo $telepon?>">
  </div>
  <?php
    if (isset($_GET['actionedit']) && $jon==0) {
        echo "<input type=\"hidden\" name=\"editsubmit\" value=\"1\">\r";
        echo "<input type=\"hidden\" name=\"id_user\" value=\"".$_GET['id_user']."\">\r";
        echo "<table><tr><td><button type=\"submit\" class=\"btn btn-danger\" value=\"1\" name=\"delete\" onClick=\"return confirm('Anda yakin akan menghapus data ini?')\">Delete</button></td>";
        echo "<td><button type=\"submit\" class=\"btn btn-primary\" name=\"update\">Update</button></td></td></table>";
        //echo "<button class\"btn btn-default\" name=\"delete\" value=\"1\" onClick=\"return confirm('Anda yakin akan menghapus data ini?')\"> Delete<br><br>\r";
    }
    else {
      ?>
        <button type="submit" class="btn btn-default" name="add">Add</button>
      <?php
    }
  ?>
  
</form>
  </div>
</div>

<?php
  $sql2="select * from user_gis where deleted=false";
  $sql3="select count(id_user) as tot from user_gis where deleted=false";
  $result2=mysql_query($sql2);

  //query count number
  $resultCount=mysql_query($sql3);
  if ($resultCount) {
    while ($rowCount = mysql_fetch_array($resultCount)) {
      $total=$rowCount['tot'];
    }
  }
  $num_of_pages = $total;
  $offset=1;
  $limit=0;
    $first_index=1;
    if($limit>0) {
        $num_of_pages = ceil($total / $limit);
        $first_index = (($offset*$limit)-$limit)+1;
    }
?>

<!-- begin user content list  -->
<hr>
<div class="row">
  <div class="col-md-12 centered">
    <h3>Daftar Administrator</h3>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th width="80">Id user</th>
            <th>Username</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Nomor Kontak</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <?php
        $no=$first_index;
          if ($result2) {
            while ($row2 = mysql_fetch_array($result2)) {
              echo "<tr><td width=\"50\">".$no++."</td>
          <td>".$row2['username']."</td>
          <td>".$row2['fullname']."</td>
          <td>".$row2['email']."</td>
          <td>".$row2['telp']."</td>
          <td><a href=\"?actionedit=1&id_user=".$row2['id_user']."\">Edit</a></td>
        </tr>";
            }
          }
        ?>
      </table>
    </div>
  </div>
</div>