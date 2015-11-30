<?php
$user=$_SESSION['name'];
$id=$_GET['id'];
$idfoto=$_GET['idfoto'];
$hapusss="";
$message="";

$sqll="select * from ksn_wilayah where id='".$id."'";
$resultt=mysql_query($sqll);
if ($resultt) {
  if ($datat=mysql_fetch_array($resultt)) {
    $id_wilayah=$datat['id'];
    $wilayah=$datat['wilayah'];
  }
}
// if ($_GET['act']=="hapus") {
//   $sql2="update galeri set deleted=true where id=".$id."";
//   $sql22="update foto set deleted=true where id_galeri='".$id."'";
//   $result22=mysql_query($sql22);
//   $result2=mysql_query($sql2);
//   if ($result2) {
//     $message=$message."<div class='alert alert-success'>Hapus Galeri Berhasil<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a></div>";
//     echo "<script>
//             window.location=\"?page=galeri&message=$message\";
//         </script>";
//   }
  
// }
if ($_GET['act']=="hapusfoto") {
  $sql123="update ksn_galeri set deleted=true where id=".$idfoto."";
  $result123=mysql_query($sql123);
  if ($result123) {
    $message=$message."<div class='alert alert-success'>Tambah Foto Berhasil<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a></div>";
    // echo "<script>
    // alert('Foto Berhasil Dihapus');
    //   window.location.replace(\"content.php?page=detailgaleri&id=$id\")
    // </script>";
  }
}
//upload foto
$rootUpload="..";
if(isset($_FILES['files'])){
    $errors= array();
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name = $key.$_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	
        if($file_size > 2097152){
			$errors[]='Size lebih dari 2MB';
        }		
        $query="INSERT into ksn_galeri (`id_wilayah`,`foto`,`id_user`) VALUES('".$id_wilayah."','".$file_name."','".$user."'); ";
        $desired_dir=$rootUpload."/upload";
        if(empty($errors)==true){
            
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
            }else{									// rename the file if another one exist
                $new_dir="$desired_dir/".$file_name.time();
                 rename($file_tmp,$new_dir) ;				
            }
		    mysql_query($query);			
        }else{
                //print_r($errors);
                $message=$message."<div class='alert alert-danger'>Foto Lebih Dari 2MB<a class='close' data-dismiss='alert' href='#'' aria-hidden='true'>&times;</a></div>";
        }
    }
}


?>


<div class="page-header">
		<h2><?php
      echo "Galeri KSN ".ucfirst($wilayah);
    ?></h2>
	</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<a data-toggle="modal" href="#myModal" class="btn btn-primary" >Tambah Foto</a>
	</div>
  <div class="row margin-top-10 centered">
      <?php
      echo $message;
    ?>
    </div>
	<div class="col-md-12 centered">
    <?php
      $sql="select * from ksn_galeri where id_wilayah='".$id."' and deleted=0";
      $result=mysql_query($sql);
      if ($result) {
        while ($data=mysql_fetch_array($result)) {
          echo "<div class='col-md-3'>
                  <div class='col-md-1 col-md-offset-11'><a href='?page=galeri&id=".$data['id_wilayah']."&act=hapusfoto&idfoto=".$data['id']."' onClick=\"return confirm('Anda yakin akan menghapus foto ini?')\">&times;</a></div>
                  <a class='no-decor' href='?page=detailfoto&id=".$data['id']."'><img class=' img-thumbnail imgresize1' src='$webRoot/upload/$data[foto]'></a>
                </div>";
        }
      }
    ?>
		
	</div>
	<!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Tambah Foto</h4>
        </div>
        <div class="modal-body">
          <div class="alert alert-info">Tahan Tombol Control Saat Memilih Foto Untuk Upload Lebih Dari 1 Foto</div>
          <div class="alert alert-warning">Ukuran Foto Tidak Boleh Lebih Dari 2MB!</div>
          <form action="" method="POST" enctype="multipart/form-data">
          <input type="file" title="Search for a file to add" name="files[]" multiple/>
        	<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
        </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</div>

