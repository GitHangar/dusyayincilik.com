<?php
if (!defined('yakusha')) die('...');

# mesajlar
$sayfa_baslik = $MAGAZA["site_baslik"];
$sayfa_tazele = "18000; URL=#";

//sayfa ad�na g�re sayfa ba�l��� at�yoruz
$sayfaadi = basename($_SERVER['SCRIPT_NAME'],".php");
switch ($sayfaadi)
{
	case 'projeler':
		$sayfa_baslik = 'Projeler  | '. $sayfa_baslik;
	break;

	case 'urunler':
		$sayfa_baslik = '�r�nler  | '. $sayfa_baslik;
	break;
}
//---- [  -  ]  seo mod  ----- 

include($siteyolu."/_lib_temp/_t_sitebaslangic.php"); 

include($siteyolu."/_lib_page/_page_".$MAGAZA["islem"].".php");

include($siteyolu."/_lib_temp/_t_sitebitis.php"); 
// ba�ta a�t�k, �imdi kapat�yoruz
@mysql_close($VT_magaza);
?>