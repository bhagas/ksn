<?php
	$user=$_SESSION['name'];
	$_SESSION['1mypath']=$webRoot."/upload";

	$sql="select * from about";
	$result=mysql_query($sql);
	if ($result) {
		while ($row=mysql_fetch_array($result)) {
			$isi2=$row['isi'];
		}
	}

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
			//$messageSuccess=$messageSuccess. "Data Berhasil Diupdate";
			$sql2="update about set isi= '".$isi."', id_user='".$user."'";
			$result2=mysql_query($sql2);
			if ($result2) {
				$messageSuccess=$messageSuccess. "Data Berhasil Diupdate";
				// echo "<script>
    //       function Redirect(){
    //         window.location=\"?page=contact\";
    //       }
    //       setTimeout(\"Redirect()\",3000);
    //     </script>";
			}
		}
	}
?>
<div class="page-header">
			<h2>Manajemen About</h2>
		</div>
<div class="row">
	<div class="col-md-8">
		<form role="form" method="POST" >
		  <?php
				if ($messageIsi!="" || $messageIsi2 !="") {
					?>
					<div class="alert alert-danger"><?php echo $messageIsi2?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div>
					<?php
				}
				elseif($messageSuccess!=""){
					?>
					<div class="alert alert-success"><?php echo $messageSuccess?><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a></div>
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
