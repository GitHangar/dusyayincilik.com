<?php
	if (!defined('yakusha')) die('...');
	if ($_REQUEST["sifredegistirmeformu"])
	{
		$parola1 = trim(substr($_REQUEST["parola1"],0,32));
		$parola2 = trim(substr($_REQUEST["parola2"],0,32));
		$parolam = trim(substr($_REQUEST["parolam"],0,32));

		if ($parola1 <> $parola2)
		{
			$islem_bilgisi.= '<div class="errorbox">Yeni Parola Hatas� <br>Her iki alan da ayn� ifadeyi i�ermelidir.</div>';
		}	
		else if(strlen($parola1) < 4 or strlen($parola1) > 32)
		{	
			$islem_bilgisi.= '<div class="errorbox">Yeni Parola Hatas� <br>Yeni parola en az 6, en fazla 32 karakter uzunlukta olmal�d�r.</div>';
		}
		else if(strlen($parolam) < 1)
		{
			$islem_bilgisi.= '<div class="errorbox">Mevcut Parola Hatas� <br>Mevcut Parolay� bo� b�rakmay�n�z.</div>';
		}
		else
		{
			$ysifre = $parola1;
			$msifre = $parolam;

			if ($ysifre == $msifre)
			{
				$islem_bilgisi.= '<div class="errorbox">Mevcut ve Yeni parola alanlar� ayn� olamaz.</div>';
			}	
			else
			{
				$SORGU_parolaguncelle = "
					UPDATE pco_users 
					SET pass='".$ysifre."'
					WHERE email='".$_SESSION[SES]["eposta"]."' 
					AND pass='".$msifre."'";
				$SORGU_sonuc = mysql_query($SORGU_parolaguncelle);
				$islem_bilgisi.= '<div class="errorbox">Mevcut Parola Hatas� <br>Mevcut parolan�z� yanl�� girdiniz.</div>';
			}
		}
	}
	include($siteyolu."/_panel_ucp/_temp/_t_ucp_parola.php");
?>