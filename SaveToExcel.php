<?php
 //require_once '../library/config.php';
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excelfile.xls");
header("Pragma: no-cache");
header("Expires: 0");


$text = str_replace("\\\"","\"",$_POST['datatodisplay']);
$text = str_replace("class=\"sampleClean\"","class=\"sampleClean\" border=1",$text);
$text = str_replace("class=\"sample\"","class=\"sample\" border=1",$text);
$text = str_replace("[Detail]","",$text);
$text = str_replace("[Option]","",$text);
?>
<html>
<head>
<style type="text/css">
table.sample {
	border-width: 1px;
	border-spacing: ;
	border-style: none;
	border-color: gray;
	border-collapse: collapse;
	background-color: white;
	font-size: 11px;
}
table.sample th {
	border-width: thin;
	padding: 3px;
	border-style: inset;
	border-color: black;
	background-color: #E0E0E0;
	font-size: 10px;
	-moz-border-radius: ;
}
table.sample td {
	border-width: thin;
	padding: 3px;
	border-style: inset;
	border-color: black;
	background-color: #f5f5f5;
	-moz-border-radius: ;
}

table.sampleClean {
	border-width: 1px;
	border-spacing: ;
	border-style: outset;
	border-color: gray;
	border-collapse: collapse;
	background-color: white;
	font-size: 11px;
}
table.sampleClean th {
	border-width: thin;
	padding: 3px;
	border-style: inset;
	border-color: black;
	background-color: white;
	font-size: 10px;
	-moz-border-radius: ;
}
table.sampleClean td {
	border-width: thin;
	padding: 3px;
	border-style: inset;
	border-color: black;
	background-color: white;
	-moz-border-radius: ;
}

td.accountnum
  {mso-number-format:\#\,\#\#0}
  
  
@media print {
   thead {display: table-header-group;}
}
</style>
</head>
<body style="background-color:white">
<?php echo $text?>
</body>
</html>
