<?php
if (!defined('yakusha')) die('...');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="Cache-Control" content="public">
	<meta http-equiv="Content-type" content="text/html; charset=iso-8859-9">
	<meta http-equiv="refresh" content="<?=$sayfa_tazele?>">
	<meta name="copyright" content="Yakusha Bilişim">
	<title><?=$MAGAZA["site_isim"]?> &bull; Yönetim Paneli</title>
</head>
<body>

<?php include($siteyolu."/_panel_acp/_temp/_t_admincss.php");?>

<script language="javascript" type="text/javascript">
<!--
function stopUpload(success)
{
	var result = '';
	if (success)
	{
		result = success;
	}
	document.getElementById('UploadForm').innerHTML = result;
	return true;
}
//-->
</script>

<div id="wrap">

<div id="page-body">
<div id="tabs">

<?php
	$menu = $_REQUEST['menu'];
?>
<ul>
<li <?php 
if(!$menu 
|| $menu == "giris"
|| $menu == "istatistik")
echo 'id="activetab"'; ?>><a href="<?=$acp_anamenulink?>"><span>YÖNETİM</span></a></li>
<li <?php if($menu == "urunler") echo 'id="activetab"'; ?>><a href="<?=$acp_urunlerlink?>&amp;lt=satista&amp;order=tarih&amp;by=1"><span>ÜRÜNLER</span></a></li>
<li <?php 
if (
$menu == "vitrin_yeniler"
	|| 	$menu == "vitrin_coksatanlar"
	|| 	$menu == "vitrin_tekrarbaskilar"
) echo 'id="activetab"'; ?>>
<a href="<?=$acp_vitrinlerlink?>"><span>VİTRİNLER</span></a></li>
<li <?php if($menu == "yazilar") echo 'id="activetab"'; ?>><a href="<?=$acp_yazilarlink?>"><span>YAZILAR</span></a></li>
<li <?php if($menu == "uyeler") echo 'id="activetab"'; ?>><a href="<?=$acp_uyelerlink?>"><span>ÜYELER</span></a></li>
<li <?php if($menu == "projeler") echo 'id="activetab"'; ?>><a href="<?=$acp_projelerlink?>"><span>PROJELER</span></a></li>
<li><a href="<?=ANASAYFALINK?>"><span>ANA SAYFA</span></a></li>
</ul>
</div>

<div id="acp">
<div class="panel">
<span class="corners-top"><span></span></span>
<div id="content">
