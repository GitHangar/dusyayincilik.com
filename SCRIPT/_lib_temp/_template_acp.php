<?php
if (!defined('yakusha')) die('...');
if ($_SESSION[SES]["ADMIN"] == 1)
{
	# mesajlar
	$sayfa_baslik = $MAGAZA["site_baslik"];
	$sayfa_tazele = "18000; URL=#";

	if (isset($_REQUEST["menu"])) $menu = $_REQUEST["menu"]; else $menu = "giris";

	include($siteyolu."/_panel_acp/_acp_define.php");
	include($siteyolu."/_panel_acp/_acp_".$menu.".php");
}
else
{
	$sayfa_baslik = '��leminiz yap�l�yor. L�tfen bekleyiniz...';
	$sayfa_tazele = "0; URL=".ANASAYFALINK;
	include($siteyolu."/_lib_temp/_top.php");
	exit();
}
// ba�ta a�t�k, �imdi kapat�yoruz
@mysql_close($VT_magaza);
?>