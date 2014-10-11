<?php
if (!defined('yakusha')) die('...');
//üye giriþ yapmýþ mý hemen kontrol ediyoruz
if ($_SESSION[SES]["giris"]==0)
{
	$sayfa_baslik = 'Ýþleminiz yapýlýyor. Lütfen bekleyiniz...';
	$sayfa_tazele = "0; URL=".ANASAYFALINK;
	include($siteyolu."/_lib_temp/_top.php");
	exit();
}
else
{
	# mesajlar
	$sayfa_baslik = $MAGAZA["site_baslik"];

	//menü oluþturmakta kullanýyoruz
	//iþlem yoksa varsayýlan iþlemi belirliyoruz
	$menu = $_REQUEST["menu"]; $menu = htmlspecialchars($menu);
	if (!$menu) $menu = "profile"; 
	//seo özelliðini baþlatýyoruz
	switch ($menu)
	{
		case 'profile':
			$sayfa_baslik = 'Hoþgeldiniz';
			$menu = 'profile';
		break;
		case 'bilgi':
			$sayfa_baslik = 'Üye Bilgileri';
			$menu = 'bilgi';
		break;
		case 'parola':
			$sayfa_baslik = 'Parola Bilgileri';
			$menu = 'parola';
		break;
		default:
			$sayfa_baslik = 'Hoþgeldiniz';
			$menu = 'profile';
		break;
	}

	//önce linkleri yüklüyoruz
	include($siteyolu."/_panel_ucp/_ucp_define.php");
	//site baþlangýcý giriliyor
	include($siteyolu."/_panel_ucp/_temp/_t_ucp_baslangic.php"); 
	//site sol menü giriliyor
	include($siteyolu."/_panel_ucp/_temp/_t_ucp_menuleri.php"); 
	//esas iþlem baþlatýlýyor
	include($siteyolu."/_panel_ucp/_ucp_".$menu.".php");
	//site sonu giriliyor
	include($siteyolu."/_panel_ucp/_temp/_t_ucp_bitis.php");
}
//veritabaný baðlantýsý kapatýlýyor
@mysql_close($VT_magaza);
?>