<!DOCTYPE html PUBLIC "-//ww3c//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title><?php if (isset($title)): echo $this->escape($title) .'-';
    endif; ?>Kiyamazon</title>

    
    <!-- BootstrapのCSS読み込み -->
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
 </head>
 <body>
 	<div id="header">
 		<h1><a href="<?php echo $base_url; ?>/">Kiyamazon<a style="font-size: 50%;">.com</a></a></h1>
 	</div>
 	
 	<div id="main">

 		<?php echo $_content; ?>

 	</div>
 
<footer class="fixed-bottom">
 	<div id="footer">
 		<a style="color: grey; ">※当サイトはテスト用のサイトになります
 		実際にご利用していただけませんのでご理解ください</a>
 	</div>
 </footer>

 	
 </body>
 </html>
 		