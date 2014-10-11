<?php
define('yakusha', 1);
include("_header.php");

if (isset($_GET["sayfa"])) $sayfa = intval($_GET["sayfa"]);
if ($sayfa < 1) $sayfa = 1;
if ($sayfa > 10) $sayfa = 10;

$listeleneceksonuc = 300;
$baslangic = ($sayfa-1)*$listeleneceksonuc;

$SORGU_urunler = '
	SELECT stokno, urunadi, changetar
	FROM pco_stok 
	WHERE stokno > 0 
	ORDER BY changetar DESC
	LIMIT '.$baslangic.','. $listeleneceksonuc;
$SORGU_sonuc = mysql_query($SORGU_urunler);
$bulunanadet = mysql_num_rows($SORGU_sonuc);
//echo $bulunanadet;

$sayfabilgisi  = '<' . '?xml version="1.0" encoding="UTF-8"?' . '>';
$sayfabilgisi .= '<?xml-stylesheet type="text/xsl" href="'.SITELINK.'/sitemap.xsl"?><urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

for ( $i=0 ; $i<$bulunanadet; $i++ ) 
{
	$stokno = mysql_result($SORGU_sonuc,$i,"stokno");
	$urunadi = mysql_result($SORGU_sonuc,$i,"urunadi");
	$changetar = mysql_result($SORGU_sonuc,$i,"changetar");
	$changetar = date('Y-m-d',$changetar);
	$urunadi = stripslashes($urunadi);
	$file_link = SITELINK.'/' . URUNDETAY . '?pid=' . $stokno .'-'. pco_format_url($urunadi) ;
	if (SEO_OPEN == 1) $file_link = SITELINK.'/' . pco_format_url($urunadi) . '-'.DETAY . $stokno . SEO;

	$sayfabilgisi .= "<url>\n";
	$sayfabilgisi .= "\t<loc>$file_link</loc>\n";
	$sayfabilgisi .= "\t<lastmod>$changetar</lastmod>\n";
	$sayfabilgisi .= "\t<changefreq>daily</changefreq>\n";
	$sayfabilgisi .= "\t<priority>0.5</priority>\n";
	$sayfabilgisi .= "</url>\n\n";
}
$sayfabilgisi .= "</urlset>\n";
mysql_close($VT_magaza);
header('Content-type: application/xml');
?>
<?php echo $sayfabilgisi ?>