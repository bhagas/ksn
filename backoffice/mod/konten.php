<?php
	$user=$_SESSION['name'];
	$id=$_GET['id'];
	$konten=$_GET['konten'];
	$_SESSION['1mypath']=$webRoot."/upload";

	if ($konten=="ksn_perpres") {
		$judul="Kebijakan Perpres";
	}
	if ($konten=="ksn_rencana_budaya") {
		$judul="Rencana Pola Ruang Kawasan Budaya";
	}
	if ($konten=="ksn_rencana_lindung") {
		$judul="Rencana Pola Ruang Kawasan Lindung";
	}
	if ($konten=="ksn_rencana_evakuasi") {
		$judul="Rencana Sistem Evakuasi Bencana";
	}
	if ($konten=="ksn_rencana_struktur_ruang") {
		$judul="Rencana Struktur Ruang";
	}
	if ($konten=="ksn_tujuan_tata_ruang") {
		$judul="Tujuan Penataan Ruang";
	}
	if ($konten=="ksn_kebijakan_strategi") {
		$judul="Kebijakan dan Strategi";
	}

	//$sql="select * from ksn_wilayah where id='".$id."' and deleted=0";
	$sql="select * from ".$konten." where id='".$id."'";
	$result=mysql_query($sql);
	if ($result) {
		if ($row=mysql_fetch_array($result)) {
			$id_wilayah=$row['id_wilayah'];
			$isi2=$row['isi'];

			$sql1="select wilayah from ksn_wilayah where id=$id_wilayah";
			$result1=mysql_query($sql1);
			if ($result1) {
				if ($data1=mysql_fetch_array($result1)) {
					$wilayah=$data1['wilayah'];
				}
			}
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
			
			$sql2="update ".$konten." set isi= '".$isi."', id_user='".$user."' where id_wilayah='".$id."'";
			$result2=mysql_query($sql2);
			if ($result2) {
				$messageSuccess=$messageSuccess."Data Berhasil Diupdate";
				echo "<script>
					function Redirect(){
						window.location=\"?page=konten&konten=$konten&id=$id\";
					}
					setTimeout(\"Redirect()\",1000);
				</script>";
			}
		}
	}
?>
<div class="page-header">
			<h2><?php echo $judul." ".ucfirst($wilayah);?></h2>
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
