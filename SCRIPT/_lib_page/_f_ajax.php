<?php
header("Content-Type: text/html;charset=UTF-8");
if (!defined('yakusha')) die('...');

//admin i�lemlerini farkl� bir dosyaya yazmadan buraya al�yoruz...
if ($_SESSION[SES]["ADMIN"] == 1)
{
	//vitrin yenileme fonksiyonlar�
	$vitrinler_kitap = $_GET["kitap"];
	$vitrinler_zaman = $_GET["zaman"];
	$vitrinler_vitrintipi = $_REQUEST["vitrintipi"];

	if ($vitrinler_kitap > 0 && $vitrinler_zaman == 'yenile' )
	{
		$vitrintarihi = time();
		$SORGU_guncelle = 'UPDATE pco_vitrinler SET vitrintar = '.$vitrintarihi.' WHERE stokkod =  ' . $vitrinler_kitap . ' AND vitrintipi = '.$vitrinler_vitrintipi.';';
		$SORGU_sonuc = mysql_query($SORGU_guncelle);
		echo '<td colspan="5">Listenin En �st�ne al�nd�</td>';
	}
}

if ( $_REQUEST["yeniresim"] == 1) 
{
	global $siteyolu;	
	require($siteyolu.'/_lib_class/eb.upload.php');

	// upload i�lemleri
	if( $_FILES ) 
	{
		// s�n�f� haz�rla 
		$up = new UPLOAD( $_FILES['content_image'] ); 

		// y�klenecek dosyalar hangi klas�re kay�t edilecek 
		$up->yolDizin('_img_book'); 
		// y�klenecek dosyalar boyutu ve miktar�
		$up->minBoyut(1);
		$up->minDosya(1);
		// kabul edilecek tipler
		$up->tipKabul('gif, jpg, png');
		// varsa �st�ne yaz�ls�n m�
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
