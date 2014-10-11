<?php
	if (!defined('yakusha')) die('...');

	//form gönderilmiþ ise
	if ($_REQUEST["bilgiformu"])
	{
		$user_name = ucwords(strtolower(trim(strip_tags(substr(ereg_replace("'","`",$_REQUEST["name"]),0,70)))));
		$user_tel = ucwords(strtolower(trim(strip_tags(substr(ereg_replace("'","`",$_REQUEST["tel"]),0,70)))));
		$user_username = ucwords(strtolower(trim(strip_tags(substr(ereg_replace("'","`",$_REQUEST["username"]),0,70)))));

		# cari isimli tabloda müþteri kaydý güncellenecek
		$SORGU_guncelle = "
		UPDATE pco_users
		SET
			name = '".$user_name."',			
			tel = '".$user_tel."',
			username = '".$user_username."'
		WHERE 
			id = '".$_SESSION[SES]["id"]."' 
		;";

		$SORGU_sonuc = mysql_query($SORGU_guncelle);
		//sorgu_denetle($SORGU_guncelle);
		$islem_bilgisi.= '<div class="">Üye bilgileriniz güncellendi.</div>';
	}

	$SORGU_adres = '
		SELECT id, name, tel, username
		FROM pco_users
		WHERE 
		id = "'.$_SESSION[SES]["id"].'" 
		AND email = "'.$_SESSION[SES]["eposta"].'";
	';
	//sorgu_denetle($SORGU_adres);
	$SORGU_sonuc = mysql_query($SORGU_adres);

	$user_id = mysql_result($SORGU_sonuc,0,"id");
	$user_name = mysql_result($SORGU_sonuc,0,"name");
	$user_tel = mysql_result($SORGU_sonuc,0,"tel");
	$user_username = mysql_result($SORGU_sonuc,0,"username");
	include($siteyolu."/_panel_ucp/_temp/_t_ucp_bilgi.php");
?>