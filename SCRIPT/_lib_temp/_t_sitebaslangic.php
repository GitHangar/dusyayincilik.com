<?php
if (!defined('yakusha')) die('...');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Cache-Control" content="public">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9">
<meta http-equiv="refresh" content="<?php echo $sayfa_tazele?>">
<meta name="category" content="general">
<meta name="robots" content="index, follow">
<meta name="distribution" content="global">
<meta name="resource-type" content="document">
<link rel="stylesheet" type="text/css" href="nimbuslike.css" media="screen">
<?php
if ($site_link_canonical) { ?>
<link rel="canonical" href="<?php echo $site_link_canonical?>">
<?php } ?>
<title><?php echo $sayfa_baslik?></title>
<link rel="alternate" type="application/rss+xml" title="Düşün Yayıncılık Güncellemeleri" href="<?php echo SITELINK?>/feed/" />
</head>
<body>
<div id="wrapper">
<div id="header-wrapper">
<div id="header">
<div id="logo">
<h1><a href="<?php echo ANASAYFALINK?>" title="<?php echo $MAGAZA["site_isim"]?>"><?php echo $MAGAZA["site_isim"]?></a></h1>
<h2><?php echo $MAGAZA["site_slogan"]?></h2>
</div>
<div id="search">
<form action="<?php echo ANASAYFALINK?>" method="GET">
<fieldset>
<input type="text" id="search-text" name="aramaanahtari" value="" />
<input type="hidden" name="aramatipi" value="urunadi" />
</fieldset>
</form>
</div>
<!-- end #logo -->
</div>
<!-- end #header -->
<div id="menu">
<ul>
<li class="first"><a href="<?php echo ANASAYFALINK?>">Ana Sayfa</a></li>
<li><a href="<?php echo HABERLERLINK?>">Haberler</a></li>
<li><a href="<?php echo URUNLERLINK?>">Ürünler</a></li>
<li><a href="<?php echo HAKKIMIZDALINK?>">Hakkımızda</a></li>
</ul>
</div>
<!-- end #menu -->
</div>

<div id="page">
