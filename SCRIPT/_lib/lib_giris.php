<?php
if (!defined('yakusha')) die('...');

$redirectlink = PROFILELINK;
$fsignout = $_REQUEST["fsignout"]; settype($fsignout,"integer");
if ($fsignout == 1)
{
	if (isset($_SESSION[SES])) unset($_SESSION[SES]);
	$_SESSION[SES]["giris"] = 0;
	$sayfa_tazele = '0; URL='.ANASAYFALINK;
	$sayfa_baslik = 'Ýþleminiz Gerçekleþtiriliyor';
	$sayfa_mesaj = '<div class="successbox">Çýkýþ Ýþleminiz Onaylandý<br>Lütfen bekleyiniz.</div>';
	include($siteyolu."/_lib_temp/_top.php");
	exit();
}

if (isset($_REQUEST["fmemberin"]))
{
	$parola = trim(substr( ereg_replace("'","",$_REQUEST["parola"]),0,32));
	$eposta = strtolower( trim(strip_tags(substr(ereg_replace("'","",$_REQUEST["eposta"]),0,70) )));
	//kullanýcý sorgulanýyor
	if ($parola == '' || $eposta == '')
	{
		$sayfa_tazele = "3; URL=".ANASAYFALINK;
		$sayfa_baslik = 'Hata Oluþtu';
		$sayfa_mesaj = '<div class="errorbox">Kullanýcý adýnýzý ve Parolanýzý boþ býrakmayýnýz.<br>Lütfen tekrar deneyiniz.</div>';
		include($siteyolu."/_lib_temp/_top.php");
		exit();
	}

	$SORGU_uyegetir = "
	SELECT 
		*
	FROM 
		pco_users 
	WHERE 
		email='".$eposta."' 
	AND 
		pass='".$parola."'
	;
	";	

	$SORGU_sonuc = mysql_query($SORGU_uyegetir);
	$bulunanadet = mysql_num_rows($SORGU_sonuc);
	
	//kullanýcý var ise
	if ($bulunanadet)
	{
		//kullanýcý bilgileri oturuma aktarýlýyor
		$_SESSION[SES]["giris"] = 1;
		$_SESSION[SES]["giristar"] = time();
		$_SESSION[SES]["id"] = mysql_result($SORGU_sonuc,0,"id");
		$_SESSION[SES]["eposta"] = mysql_result($SORGU_sonuc,0,"email");
		$_SESSION[SES]["status"] = mysql_result($SORGU_sonuc,0,"status");

		//yönetici ise yönetici oturumu açýlýyor
		if ($_SESSION[SES]["status"] == 1 OR  $_SESSION[SES]["status"] == 10)
		{
			$_SESSION[SES]["ADMIN"] = 1;
			$redirectlink = ADMINLINK;
		}
		else
		{
			$_SESSION[SES]["ADMIN"] = 0;
		}

		//sayfa yönlendirmesi oluþturuluyor
		$sayfa_tazele = "0; URL=".$redirectlink;
		$sayfa_baslik = 'Ýþleminiz Gerçekleþtiriliyor';
		$sayfa_mesaj = '<div class="successbox">Üyelik Giriþiniz Onaylandý.<br>Lütfen bekleyiniz.</div>';		
		include($siteyolu."/_lib_temp/_top.php");
		exit();
	}
	else
	{
		$sayfa_tazele = "3; URL=".ANASAYFALINK;
		$sayfa_baslik = 'Hata Oluþtu';
		$sayfa_mesaj = '<div class="errorbox">Yanlýþ Kullanýcý Adý ve/veya Parola girdiniz. Lütfen tekrar deneyiniz.</div>';
		include($siteyolu."/_lib_temp/_top.php");
		exit();
	}
}
