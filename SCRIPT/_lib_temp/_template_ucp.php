<?php
if (!defined('yakusha')) die('...');
//�ye giri� yapm�� m� hemen kontrol ediyoruz
if ($_SESSION[SES]["giris"]==0)
{
	$sayfa_baslik = '��leminiz yap�l�yor. L�tfen bekleyiniz...';
	$sayfa_tazele = "0; URL=".ANASAYFALINK;
	include($siteyolu."/_lib_temp/_top.php");
	exit();
}
else
{
	# mesajlar
	$sayfa_baslik = $MAGAZA["site_baslik"];

	//men� olu�turmakta kullan�yoruz
	//i�lem yoksa varsay�lan i�lemi belirliyoruz
	$menu = $_REQUEST["menu"]; $menu = htmlspecialchars($menu);
	if (!$menu) $menu = "profile"; 
	//seo �zelli�ini ba�lat�yoruz
	switch ($menu)
	{
		case 'profile':
			$sayfa_baslik = 'Ho�geldiniz';
			$menu = 'profile';
		break;
		case 'bilgi':
			$sayfa_baslik = '�ye Bilgileri';
			$menu = 'bilgi';
		break;
		case 'parola':
			$sayfa_baslik = 'Parola Bilgileri';
			$menu = 'parola';
		break;
		default:
			$sayfa_baslik = 'Ho�geldiniz';
			$menu = 'profile';
		break;
	}

	//�nce linkleri y�kl�yoruz
	include($siteyolu."/_panel_ucp/_ucp_define.php");
	//site ba�lang�c� giriliyor
	include($siteyolu."/_panel_ucp/_temp/_t_ucp_baslangic.php"); 
	//site sol men� giriliyor
	include($siteyolu."/_panel_ucp/_temp/_t_ucp_menuleri.php"); 
	//esas i�lem ba�lat�l�yor
	include($siteyolu."/_panel_ucp/_ucp_".$menu.".php");
	//site sonu giriliyor
	include($siteyolu."/_panel_ucp/_temp/_t_ucp_bitis.php");
}
//veritaban� ba�lant�s� kapat�l�yor
@mysql_close($VT_magaza);
?>