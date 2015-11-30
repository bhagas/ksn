<?php
	$user=$_SESSION['name'];
	$_SESSION['1mypath']=$webRoot."/upload";
	$sql="select * from welcome where deleted=0";
	$result=mysql_query($sql);
	if ($result) {
		while ($row=mysql_fetch_array($result)) {
			$isi2=$row['isi'];
		}
	}
		$message=$_GET['message'];
		$messageIsi="";
		$messageIsi2 ="";
		$messageSuccess="";

		$isi=$_POST['isi'];
	//action editsubmit
	if (isset($_POST['edit'])) {
		if ($isi=="") {
			$messageIsi= $messageIsi. "has-error";
			$messageIsi2 = $messageIsi2. "Isi Artikel Tidak Boleh Kosong!";
		}
		elseif ($isi!="") {
			
			$sql2="update welcome set isi= '".$isi."', id_user='".$user."'";
			$result2=mysql_query($sql2);
			if ($result2) {
				$messageSuccess=$messageSuccess."Data Berhasil Diupdate";
				echo "<script>
            window.location=\"?page=welcome&message=$messageSuccess\";
        </script>";
			}
		}
	}
?>
<div class="page-header">
			<h2>Manajemen Welcome Page</h2>
		</div>
<div class="row">
	<div class="col-md-12">
		<form role="form" method="POST" >
		  <?php
				if ($messageIsi!="" || $messageIsi2 !="") {
					?>
					<div class="alert alert-danger"><?php echo $messageIsi2?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div>
					<?php
				}
				elseif($message!=""){
					?>
					<div class="alert alert-success"><?php echo $message?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div>
					<?php
				}
			?>
		  <div class="form-group <?php echo $messageIsi?>">
		    <label class="control-label">Content</label>
		    <textarea class="form-control" rows="10" name="isi"><?php echo $isi2?></textarea>
		  </div>
		  <button type="submit" class="btn btn-primary" name="edit">Update</button>
		</form>
	</div>
</div>
