<?php
header("Content-Type: text/html;charset=UTF-8");
if (!defined('yakusha')) die('...');

//admin iþlemlerini farklý bir dosyaya yazmadan buraya alýyoruz...
if ($_SESSION[SES]["ADMIN"] == 1)
{
	//vitrin yenileme fonksiyonlarý
	$vitrinler_kitap = $_GET["kitap"];
	$vitrinler_zaman = $_GET["zaman"];
	$vitrinler_vitrintipi = $_REQUEST["vitrintipi"];

	if ($vitrinler_kitap > 0 && $vitrinler_zaman == 'yenile' )
	{
		$vitrintarihi = time();
		$SORGU_guncelle = 'UPDATE pco_vitrinler SET vitrintar = '.$vitrintarihi.' WHERE stokkod =  ' . $vitrinler_kitap . ' AND vitrintipi = '.$vitrinler_vitrintipi.';';
		$SORGU_sonuc = mysql_query($SORGU_guncelle);
		echo '<td colspan="5">Listenin En üstüne alýndý</td>';
	}
}

if ( $_REQUEST["yeniresim"] == 1) 
{
	global $siteyolu;	
	require($siteyolu.'/_lib_class/eb.upload.php');

	// upload iþlemleri
	if( $_FILES ) 
	{
		// sýnýfý hazýrla 
		$up = new UPLOAD( $_FILES['content_image'] ); 

		// yüklenecek dosyalar hangi klasöre kayýt edilecek 
		$up->yolDizin('_img_book'); 
		// yüklenecek dosyalar boyutu ve miktarý
		$up->minBoyut(1);
		$up->minDosya(1);
		// kabul edilecek tipler
		$up->tipKabul('gif, jpg, png');
		// varsa üstüne yazýlsýn mý
		$up->yazUstune(true);
		//dosyalar yeniden isimlendirilsin mi
		$up->yeniAd( false ); 

		if( $up->baslat() === false ) 
		{
			$sayfabilgisi = $up->ilkHata();
			//$sayfabilgisi = '<div class="errorbox">'.$sayfabilgisi.'</div>';
		}
		else
		{
			$sonuc = $up->bilgiVer();
			//$dosyaadi = $sonuc[0][yeniAd];
			//return $sayfabilgisi;
		}
		unset($up);
		echo '<script language="javascript" type="text/javascript">window.top.window.stopUpload("Resim Eklendi ;)");</script>';

	}
}


?>
