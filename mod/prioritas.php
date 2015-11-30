<?php
	$kawasan=$_GET['kawasan'];
	$sql="select * from prioritas_pembangunan where kawasan='".$kawasan."' and deleted=false";
	$result=mysql_query($sql);
  $title="Prioritas Kegiatan Kawasan ".ucfirst($kawasan);
?>
<div class="row">
	<div class="large-12 columns">
		<nav class="breadcrumbs">
		  <a href="?page=home">Home</a>
		  <a class="current">Prioritas Kegiatan Kawasan <?php echo ucfirst($kawasan);?></a>
		</nav>
	</div>
</div>
<hr>
<div class="row">
  <div class="large-12 columns">
    <h3><?php echo $title;?></h3>
    <table align="right">
            <tr>
                <td valign="top"><a href="javascript:void(processPrint('list_content',''));"><img src="<?php echo $webRoot?>/images/printButton.png"></a>
                <td>
                    <form action="<?php echo $webRoot?>/SaveToExcel.php" method="post" onsubmit='$("#datatodisplay").val( $("<div>").append( $("#list_content").eq(0).clone() ).html() )'>
                        <input  type="image" src="<?php echo $webRoot?>/images/xls.gif">
                        <input type="hidden" id="datatodisplay" name="datatodisplay" />
                    </form>
                </td>
            </tr>
        </table>
  </div>
	<div class="large-12 columns" id="list_content">
		<table class="responsive">
			<tr>
            <th >Nomor</th>
            <th >Jenis Program</th>
            <th >Program</th>
            <th >Lokasi</th>
            <th >Volume</th>
            <th >Sumber Dana</th>
          </tr>
          <?php
          	if ($result) {
          		$no=1;
          		while ($data=mysql_fetch_array($result)) {
          			echo "<tr>
          	<td >".$no++."</td>
            <td >".$data['jenis_program']."</td>
            <td >".$data['program']."</td>
            <td >".$data['lokasi']."</td>
            <td >".$data['volume']."</td>
            <td >".$data['sumber_dana']."</td>
          </tr>";
          		}
          	}
          ?>
          <!-- <tr>
          	<td >Nomor</td>
            <td >Jenis Program</td>
            <td >Program</td>
            <td >Lokasi</td>
            <td >Volume</td>
            <td >Sumber Dana</td>
            <td >Kawasan</td>
          </tr> -->
		</table>
	</div>
</div>