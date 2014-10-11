<?php
################################################################################
### ÇEKÝRDEK FONKSÝYON BY YAKUSHA
################################################################################

/*
Ürün adý üç bölümden oluþur. Üst baþlýk|Asýl Baþlýk;Altbaþlýk
formatlý olarak hepsinin veya sadece asýl olanýn alýnabileceði fonksion
backported from KiBO
*/
function pco_format_urunbaslik($fi_prname, $fi_type)
{
	$fi_prname = ereg_replace ("´","'",$fi_prname);
	$fi_prname = ereg_replace ("`","'",$fi_prname);

	$fi_prname1 = $fi_prname."|";
	$arr_prname = explode("|",$fi_prname1);
	$fi_prname_toptitle = '';
	$fi_prname_title = '';
	$fi_prname_bottitle = '' ;
	if ($arr_prname[1] <> '')
	{
		$fi_prname_toptitle = $arr_prname[0];
		$fi_prname = $arr_prname[1];	
	}

	$fi_prname2 = $fi_prname.";";
	$arr_prname2 = explode(";",$fi_prname2);
	if ($arr_prname2[1] <> '')
	{
		$fi_prname_bottitle = $arr_prname2[1];
		$fi_prname_title = $arr_prname2[0];
	}
	else
	{
		$fi_prname_title=$fi_prname;
	}
	switch($fi_type)
	{
		case "ustbaslik":
			return $fi_prname_toptitle;
			break;
		case "altbaslik":
			return $fi_prname_bottitle;
			break;
		case "esasbaslik":
			return $fi_prname_title;
		break;
		default:
		if ($fi_prname_toptitle <> '') $fi_prname_toptitle = $fi_prname_toptitle.'<br>';
		if ($fi_prname_bottitle <> '') $fi_prname_bottitle = '<br>'.$fi_prname_bottitle;
		return '<em>'.$fi_prname_toptitle.'</em>'.$fi_prname_title.'<em>'.$fi_prname_bottitle.'</em>';
		break;
	}
}

function pco_format_url($url)
{
	$url = trim($url);
	$url = strtolower($url);

	$find = array(' ', '&quot;', '&amp;', '&', '\r\n', '\n', '/', '\\', '+', '<', '>');
	$url = str_replace ($find, '-', $url);

	$find = array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ë', 'Ê');
	$url = str_replace ($find, 'e', $url);

	$find = array('í', 'ý', 'ì', 'î', 'ï', 'I', 'Ý', 'Í', 'Ì', 'Î', 'Ï');
	$url = str_replace ($find, 'i', $url);

	$find = array('ó', 'ö', 'Ö', 'ò', 'ô', 'Ó', 'Ò', 'Ô');
	$url = str_replace ($find, 'o', $url);

	$find = array('á', 'ä', 'â', 'à', 'â', 'Ä', 'Â', 'Á', 'À', 'Â');
	$url = str_replace ($find, 'a', $url);

	$find = array('ú', 'ü', 'Ü', 'ù', 'û', 'Ú', 'Ù', 'Û');
	$url = str_replace ($find, 'u', $url);

	$find = array('ç', 'Ç');
	$url = str_replace ($find, 'c', $url);

	$find = array('þ', 'Þ');
	$url = str_replace ($find, 's', $url);

	$find = array('ð', 'Ð');
	$url = str_replace ($find, 'g', $url);

	$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');

	$repl = array('', '-', '');

	$url = preg_replace ($find, $repl, $url);
	$url = str_replace ('--', '-', $url);

	$url = $url;

	return $url;
} 

//çoklu platform yeni satýr
function pco_imla_denetle($metin)
{
	$metin = str_replace(array("\r\n","\r","<bn>","<br><br>",), "\n<br>", $metin); // cross-platform newlines
	$metin = trim($metin);
	return $metin;
}

//çoklu platform yeni satýr
function pco_bosluk_temizle($metin)
{
	$metin = str_replace('  ', ' ', $metin);
	$metin = trim($metin);
	return $metin;
}


################################################################################
### SONRASI SADECE ARÞÝV OLMALI
################################################################################

function pco_format_title($title)
{
	$title = strtolower($title);
	$title = ucwords($title);
	return $title;
}

function pco_encode_utf_escape($url)
{
	$url = trim($url);
	$url = strtoupper($url);

//tr karakterler tanýmlanýyor
//â harfi
	$find = array('á', 'ä', 'â', 'à', 'â', 'Ä', 'Â', 'Á', 'À', 'Â');
	$url = str_replace ($find, '|_A_|', $url);

//ç harfi
	$find = array('ç', 'Ç');
	$url = str_replace ($find, '|_C_|', $url);


//g harfi
	$find = array('ð', 'Ð');
	$url = str_replace ($find, '|_G_|', $url);

//ý harfi
	$find = array('ý', 'I');
	$url = str_replace ($find, '|_I_|', $url);

//i harfi
	$find = array('í', 'ì', 'î', 'ï', 'Ý', 'Í', 'Ì', 'Î', 'Ï');
	$url = str_replace ($find, '|_II_|', $url);

//î harfi
	$find = array('î', 'Î');
	$url = str_replace ($find,'|_III_|', $url);
	
//ö harfi
	$find = array('ö', 'Ö');
	$url = str_replace ($find, '|_O_|', $url);

//þ harfi
	$find = array('þ', 'Þ');
	$url = str_replace ($find, '|_S_|', $url);

//ü karakteri
	$find = array('û', 'Û');
	$url = str_replace ($find, '|_U_|', $url);

//ü karakteri
	$find = array('ü', 'Ü');
	$url = str_replace ($find, '|_UU_|', $url);

//boþluk karakteri
	$find = array(' ', '&quot;', '&amp;', '&', '\r\n', '\n', '/', '\\', '+', '<', '>');
	$url = str_replace ($find,'|__|', $url);

	return $url;
} 


function pco_decode_utf_escape($url)
{
//tr karakterler tanýmlanýyor
//â harfi
	$url = str_replace ('|_A_|','Â',$url);

//ç harfi
	$url = str_replace ('|_C_|','Ç',$url);


//g harfi
	$url = str_replace ('|_G_|','Ð',$url);

//ý harfi
	$url = str_replace ('|_I_|','I',$url);

//i harfi
	$url = str_replace ('|_II_|','Ý',$url);

//î harfi
	$url = str_replace ('|_III_|','Î',$url);
	
//ö harfi
	$url = str_replace ('|_O_|','Ö',$url);

//þ harfi
	$url = str_replace ('|_S_|','Þ',$url);

//ü karakteri
	$url = str_replace ( '|_U_|','Û',$url);

//ü karakteri
	$url = str_replace ('|_UU_|','Ü',$url);

//boþluk karakteri
	$url = str_replace ('|__|',' ',$url);

	return $url;
}


function pco_format_name($metin)
{
	$metin = trim($metin);
	$metin = mb_convert_encoding($metin,"UTF-8","ISO-8859-9");
	//mb_convert_encoding($metin,"ISO-8859-9","UTF-8");
    return $metin;
}

function pco_format_yazaradi($url)
{
	$url = trim($url);
	$url = strtoupper($url);
	$url = urlencode($url);
	return $url;
} 

################################################################################
### ALINTI FONKSÝYONLAR BY CODE MASTERS
################################################################################

function f_secure_search($f_aranacak) 
{
	//bu fonksiyon mentis biliþim, bayram atmaca tarafýndan yazýlmýþtýr
	//sistemin orjinaline ait deðildir

	# Aranacak ifade SQL sorgusu için güvenli hale getiriliyor.
	$aranacak = trim( strip_tags(substr( ereg_replace("%","",$f_aranacak),0,20) ) ); 
	$aranacak = trim( ereg_replace ("<","",$aranacak) );
	$aranacak = trim( ereg_replace (">","",$aranacak) );
	$aranacak = trim( ereg_replace ("\"","",$aranacak) );
	$aranacak = trim( ereg_replace ("'","",$aranacak) );
	$aranacak = trim( ereg_replace ("&","",$aranacak) );
	$aranacak = trim( ereg_replace ("#","",$aranacak) );
	$aranacak = trim( ereg_replace ("\*","",$aranacak) );
	$aranacak = trim( ereg_replace ("\?","",$aranacak) );
	$aranacak = trim( ereg_replace ("\+","",$aranacak) );
	$aranacak = trim( ereg_replace ("\(","",$aranacak) );
	$aranacak = trim( ereg_replace ("\)","",$aranacak) );
	$aranacak = trim( ereg_replace ("\[","",$aranacak) );
	$aranacak = trim( ereg_replace ("\]","",$aranacak) );
	$aranacak = trim( ereg_replace ("\{","",$aranacak) );
	$aranacak = trim( ereg_replace ("\}","",$aranacak) );
	$aranacak = trim( ereg_replace ("\|","",$aranacak) );

	$char = htmlentities($aranacak);
	$c = strlen($char);

	$char = str_replace("&eth;","&ETH;",$char);
	$char = str_replace("&uuml;","&Uuml;",$char);
	$char = str_replace("&thorn;","&THORN;",$char);
	$char = str_replace("&ccedil;","_",$char);
	$char = str_replace("&yacute;","_",$char);
	$char = str_replace("i","_",$char);
	$char = str_replace("Ý","_",$char);
	$char = str_replace("ý","_",$char);
	$char = str_replace("&ouml;","&Ouml;",$char);
	//$char = str_replace("Ç","_",$char);
	//$char = str_replace("ç","_",$char);
	return html_entity_decode($char);
}

function pco_upper_first($metin)
{
	$metin = strtolower($metin);
	$metin = ucwords($metin);
	return $metin;
}

//metinleri imla açýsýndan kontrol eder
function pco_temizle_cache()
{
	global $bellekyolu;
	$bellek = opendir($bellekyolu);
	if (!$bellek)
	{
		$mesaj =  '<div class="hata">Bellek Dizini Bulunamadý</div>';
	}

	while ($dosya = readdir($bellek))
	{
		unlink("_cache/".$dosya);
	}
	closedir($bellekyolu);
	$mesaj = '<div class="successbox">Bellek Dizini Temizlendi</div>';
	return $mesaj;
}

?>
