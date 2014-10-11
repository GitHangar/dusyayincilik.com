<?php
if (!defined('yakusha')) die('...');

# mesajlar
$sayfa_baslik = $MAGAZA["site_baslik"];
$sayfa_tazele = "18000; URL=#";

$pid = $_REQUEST["pid"]; settype($pid,"integer");
$cat = $_REQUEST["cat"]; settype($cat,"integer");
$seri = $_REQUEST["seri"]; settype($seri,"integer");

//sayfa adýna göre SEO ve TITLE deðerleri atýyoruz
$sayfaadi = basename($_SERVER['SCRIPT_NAME'],".php");
switch ($sayfaadi)
{
	case 'index':
		if ($cat > 0 && $seri == '')
		{
			$sayfaadi = $array_vitrin_tipleri[$cat];
			$sayfa_baslik = $sayfaadi .' | '. $sayfa_baslik;
		}

		if ($seri > 0 && $cat == '')
		{
			$sayfaadi = $array_seri_adlari[$seri];
			$sayfa_baslik = $sayfaadi .' | '. $sayfa_baslik;
		}
	break;
	case 'urundetay':
		$SORGU_baslik = 'SELECT urunadi FROM pco_stok WHERE stokno =  '.$pid.';';
		$SORGU_sonuc = mysql_query($SORGU_baslik);
		$baslik_urunadi =  mysql_result($SORGU_sonuc,"0","urunadi");
		$baslik_urunadi =  stripslashes($baslik_urunadi);
		
		$site_link_canonical = SITELINK.'/' . URUNDETAY . '?pid=' . $pid .'-'. pco_format_url($baslik_urunadi) ;
		if (SEO_OPEN == 1) $file_link = SITELINK.'/' . pco_format_url($baslik_urunadi) . '-'.DETAY . $pid . SEO;
		$sayfa_baslik = $baslik_urunadi .' | '. $sayfa_baslik;
		
		//- - - -  [  +  ] - - - - - | inceledikleriniz listesi |  - -  
		//normalde urundetay.php içine konumlu, lakin son eklenen yazýlýmý da göstersin diye  buraya aldýk
		$_SESSION[SITELINK]["file"][$pid]["site_link"] = $site_link_canonical;
		$_SESSION[SITELINK]["file"][$pid]["file_name"] = strtoupper($baslik_urunadi);
		//- - - -  [  -  ] - - - - - | inceledikleriniz listesi |  - -  
	break;

	case 'hakkimizda':
		$sayfa_baslik = 'Hakkýmýzda  | '. $sayfa_baslik;
	break;
	case 'haberler':
		$sayfa_baslik = 'Haberler  | '. $sayfa_baslik;
	break;
}
//---- [  -  ]  seo mod  ----- 

include($siteyolu."/_lib_temp/_t_sitebaslangic.php"); 

include($siteyolu."/_lib_page/_page_".$MAGAZA["islem"].".php");

include($siteyolu."/_lib_temp/_t_siteright.php"); 

include($siteyolu."/_lib_temp/_t_sitebitis.php"); 
// baþta açtýk, þimdi kapatýyoruz
@mysql_close($VT_magaza);
?>
