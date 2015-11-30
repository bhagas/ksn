<?php
ob_start();
	require_once '../library/config.php';
?>

<html>
	<head>
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">  
		<title>
			Backoffice Sistem Informasi Tata Ruang Banyumas
		</title>
		<link rel="stylesheet" type="text/css" href="<?php echo $webRootAdmin;?>/css/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $webRootAdmin;?>/css/jquery.pageslide.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $webRootAdmin;?>/css/bootstrap-theme.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $webRootAdmin;?>/css/bootstrap.css">
		<script type="text/javascript" src="<?php echo $webRootAdmin;?>/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript" src="<?php echo $webRootAdmin;?>/js/amcharts.js"></script>
		<script type="text/javascript" src="<?php echo $webRootAdmin;?>/tinymce/jscripts/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php?fp=1"></script>
		<script type="text/javascript" src="<?php echo $webRootAdmin;?>/js/bootstrap.file-input.js"></script>
<script type="text/javascript">
tinyMCE.init({
		// General options
		
		file_browser_callback : "tinyBrowser",
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
		
		
		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		
		relative_urls : false,
		//remove_script_host : false,
		//document_base_url : "http://localhost/staff",
		//document_base_url : "<?php echo $baseURL?>",
		//convert_urls : true,
		//entity_encoding : "raw",

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
 
</script>
	</head>
	<body>
		<div class="container">
		<div class="toggle">
			<div class="topbar">
				<a href="#leftPanel" class="panel"><img src="images/row.png"><h3>Menu</h3></a>
			</div>
		</div>
		<!-- 	Begin Header Logo	 -->
		

		<!-- <div class="wrap">
			<div class="header">
				<img src="images/logo.png">
				<h3>Panel Administrator<br>Sistem Informasi Penataan Ruang<br>Dinas Cipta Karya, Kebersihan, dan Tata Ruang<br>Kabupaten Banyumas</h3>
			</div>
		</div> -->