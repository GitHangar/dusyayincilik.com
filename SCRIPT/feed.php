<?php
	define('yakusha', 1);
	include("_header.php");

	/*
	* prepare to $metin for rss
	*/
	function pco_rss_metin_hazirla($metin)
	{
		$metin = trim(strip_tags(substr( $metin,0,350)));
		$metin = stripslashes($metin);
		// embed $metin into CDATA tags in case it contains HTML tags or entities
		if (preg_match('/<[^>]+>|&#?[\w]+;/', $$metin))
		{
			// replace any ]]>
			$$metin = str_replace(']]>', ']]&gt;', $$metin);
			$$metin = '<![CDATA[' . $metin . ']]>';
		}
		$metin = str_replace('`', '\'', $metin);
		$metin = str_replace('’', '\'', $metin);
		return $metin;
	}

	/**
	* create a date according to  RFC 822 for RSS2
	*/
	function pco_format_date($vitrintar)
	{
		return date('D, d M Y H:i:s O', $vitrintar);
	}

	// get time, use current time
	$last_build_date = mktime();

	$listeleneceksonuc = 50;
	$baslangic = $sayfa*$listeleneceksonuc;

	$SORGU_feed = "
		SELECT stokno,urunadi,yazaradi,tanitimmetni,vitrintar
		FROM pco_stok,pco_vitrinler 
			WHERE pco_stok.stokno = pco_vitrinler.stokkod
		ORDER BY vitrintar DESC
		LIMIT ".$baslangic.",". $listeleneceksonuc;
	$SONUC_feed = mysql_query($SORGU_feed);
	$bulunanadet = mysql_num_rows($SONUC_feed);

	$sayfabilgisi = '
	<?xml version="1.0" encoding="UTF-8"?>
	<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>'.$MAGAZA["site_isim"].' | RSS Kaynaðý</title>
		<link>'.SITELINK.'/feed/</link>
		<description>'.$MAGAZA["site_isim"].' için RSS Kaynaðýdýr.</description>
		<language>TR-tr</language>
		<pubDate>'.pco_format_date($last_build_date).'</pubDate>
		<lastBuildDate>'.pco_format_date($last_build_date).'</lastBuildDate>
		<docs></docs>
		<generator>Yakusha Biliþim</generator>
		<managingEditor></managingEditor>
		<webMaster></webMaster>
	';

	for ( $i=0 ; $i < $bulunanadet; $i++ ) 
	{
		$pco_stokno = mysql_result($SONUC_feed,$i,"stokno");
		$pco_urunadi = mysql_result($SONUC_feed,$i,"urunadi");
		$pco_yazaradi = mysql_result($SONUC_feed,$i,"yazaradi");
		$pco_tanitimmetni = mysql_result($SONUC_feed,$i,"tanitimmetni");
		$pco_vitrintar = mysql_result($SONUC_feed,$i,"vitrintar");
		
		//metin temizleme fonksiyonu
		$pco_tanitimmetni = str_replace ("?","!",$pco_tanitimmetni);

		$pco_urunadi = stripslashes($pco_urunadi);
		$pco_yazaradi = stripslashes($pco_yazaradi);

		$pco_tanitimmetni = pco_rss_metin_hazirla($pco_tanitimmetni);
		$vitrintar = pco_format_date($vitrintar);

		$file_link = SITELINK.'/' . URUNDETAY . '?pid=' . $pco_stokno .'-'. pco_format_url($pco_urunadi) ;
		if (SEO_OPEN == 1) $file_link = SITELINK.'/' . pco_format_url($pco_urunadi) . '-'.DETAY . $pco_stokno . SEO;
	
		$sayfabilgisi.= "\n<item>\n";
		$sayfabilgisi.= "\t<dc:creator>".$pco_yazaradi."</dc:creator>\n";
		$sayfabilgisi.= "\t<pubDate>".$vitrintar."</pubDate>\n";
		$sayfabilgisi.= "\t<link>".$file_link."</link>\n";
		$sayfabilgisi.= "\t<guid>".$file_link."</guid>\n";
		$sayfabilgisi.= "\t<title>".$pco_urunadi.", ".$pco_yazaradi."</title>\n";
		$sayfabilgisi.= "\t<description>".$pco_tanitimmetni."</description>\n";
		$sayfabilgisi.= "</item>";
	}
	$sayfabilgisi .= "\n\t</channel>\n\t</rss>";
	mysql_close($VT_magaza);
	header('Content-type: application/xml');
?>
<?php echo pco_format_name($sayfabilgisi);?>