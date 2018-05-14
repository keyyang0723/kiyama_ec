<!DOCTYPE html PUBLIC "-//ww3c//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title><?php if (isset($title)): echo $this->escape($title) .'-';
    endif; ?>Mini Blog</title>

    
    <!-- BootstrapのCSS読み込み -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/style.css" />
 </head>
 <body>
 	<div id="header">
 		<h1><a href="<?php echo $base_url; ?>/">Kiyamazon</a></h1>
 	</div>
 	
 	<div id="main">

 		<?php echo $_content; ?>

 	</div>

 	<div id="footer">
 		※当サイトはテスト用のサイトになります
 		実際にご利用していただけませんのでご理解ください
 	</div>


 	
 </body>
 </html>
 		