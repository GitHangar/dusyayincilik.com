<?php
if (!defined('yakusha')) die('...');

$pid = $_REQUEST["pid"]; settype($pid,"integer");

$deneme_sorgusu = "SELECT count(stokno) as sayim FROM pco_stok WHERE stokno = ". $pid. ";";
$sorgu_sonucu = mysql_query($deneme_sorgusu);
$sonuc = mysql_result($sorgu_sonucu,0,"sayim");

if ($sonuc)
{
	$SORGU_urundetay = "SELECT * FROM pco_stok WHERE stokno = ". $pid. ";";
	$SONUC_urundetay = mysql_query($SORGU_urundetay);

	//deðiþkenleri döngüyle al
	$urunadi = mysql_result($SONUC_urundetay,0,"urunadi");
	$yazaradi = mysql_result($SONUC_urundetay,0,"yazaradi");
	$editoradi = mysql_result($SONUC_urundetay,0,"editoradi");
	$tanitimmetni = mysql_result($SONUC_urundetay,0,"tanitimmetni");
	$icindekiler = mysql_result($SONUC_urundetay,0,"icindekiler");
	$tadimlik = mysql_result($SONUC_urundetay,0,"tadimlik");

	$yayinevino = mysql_result($SONUC_urundetay,0,"yayinevino");
	$sayfasayisi = mysql_result($SONUC_urundetay,0,"sayfasayisi");
	$satisfiyati = mysql_result($SONUC_urundetay,0,"satisfiyati");
	$satiskdv = mysql_result($SONUC_urundetay,0,"satiskdv");
	$satisdurumu = mysql_result($SONUC_urundetay,0,"satisdurumu");
	$sirtno = mysql_result($SONUC_urundetay,0,"sirtno");
	$barkod = mysql_result($SONUC_urundetay,0,"barkod");
	$hatalibarkod = mysql_result($SONUC_urundetay,0,"hatalibarkod");
	$serino = mysql_result($SONUC_urundetay,0,"serino");
	$seriicno = mysql_result($SONUC_urundetay,0,"seriicno");
	$kategori1 = mysql_result($SONUC_urundetay,0,"kategori1");
	$kategori2 = mysql_result($SONUC_urundetay,0,"kategori2");
	$kategori3 = mysql_result($SONUC_urundetay,0,"kategori3");
	$sonbaskino = mysql_result($SONUC_urundetay,0,"sonbaskino");
	$sonbaskitarihi = mysql_result($SONUC_urundetay,0,"sonbaskitarihi");
	$ilkbaskitarihi = mysql_result($SONUC_urundetay,0,"ilkbaskitarihi");
	$kidaplink = mysql_result($SONUC_urundetay,0,"kidaplink");
	$yayindili = mysql_result($SONUC_urundetay,0,"yayindili");


	//gerekli olan biçimlendirme
	$satisfiyati = number_format($satisfiyati,2, '.', '');
	$urunadi = stripslashes($urunadi);
	$yazaradi = stripslashes($yazaradi);
	$editoradi = stripslashes($editoradi);
	$tanitimmetni = stripslashes($tanitimmetni);
	$icindekiler = stripslashes($icindekiler);
	$tadimlik = stripslashes($tadimlik);

	//yeni satýrlamalar
	$tanitimmetni = pco_imla_denetle($tanitimmetni);
	$icindekiler = pco_imla_denetle($icindekiler);
	$tadimlik = pco_imla_denetle($tadimlik);

	//özel kullanýmlar
	$urunadi_baslik = pco_format_urunbaslik($urunadi);

	if ($kidaplink > 0)
	{
		$satislinki = '<a target="_blank" class="vitrinler" href="http://www.'.SATIS.'/'.pco_format_url($urunadi).'-'.pco_format_url($yazaradi).'-k'.$kidaplink.'.kitap"><img title="" src="'.SITELINK.'/_img/_icon_sepet.gif"></a>';
		$resimlinki = '_img_book/'.$barkod.'.jpg';
		if (!file_exists($resimlinki))
		{
			$dosyaadi = 'http://www.'.SATIS.'/_cresim/_isbn_200_'.$barkod.'.jpg';
			$dosyayolu = './../../'.SATIS.'/public_html/_cresim/_isbn_200_'.$barkod.'.jpg';
			if (file_exists($dosyayolu))
			{ 
				$resimlinki = $dosyaadi;
			}
			else 
			{ 
				$resimlinki = 'http://www.'.SATIS.'/'.pco_format_url($stokcins).'-'.pco_format_url($yazar).'-isbn'.$barkod.'-sz200.jpg';
			}
		}
	}
	else
	{
		$satislinki = '';
		$resimlinki = '';
	}
	mysql_free_result($SONUC_urundetay);
}

if ($sonuc){
?>
<style>
.button-primary {
float:right;
width:190px;
padding-left:10px;
padding-bottom:10px;
}
</style>

<div id="page-bgcontent">

<div id="content">
<div class="right_articles">
<h2><?php echo strtoupper($urunadi)?> <?php if ($_SESSION[SES]["ADMIN"]==1) echo ' | <a title="Ürün Bilgilerini Düzenle" href="'.ADMINLINK.'?menu=urunler&un='.$pid.'">Düzenle</a>'; ?></h2>
</div>

<div class="post">
<div class="entry">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td valign="top">
<div class="button-primary">
<div class="right_articles">
<center>
<img height="230" title="<?php echo $urunadi?> - <?php echo $yazaradi?>" src="<?php echo $resimlinki?>">
<br>
<br>
<?php echo $satislinki?>
</center>
</div>
</div>

<p>
<strong>Yazar :</strong> <a href="<?php echo URUNLERLINK?>?&aramatipi=yazaradi&amp;aramaanahtari=<?php echo $yazaradi?>"><?php echo $yazaradi?></a>
<?php if ($editor <> '') { ?>
<strong>Editör :</strong> <?php echo $editor?>
<?php } ?>
</p>

<p><?php echo $tanitimmetni?></p>

<?php if ($icindekiler <> '') { ?>
	<hr>
	<h2>ÝÇÝNDEKÝLER</h2>
	<p><?php echo $icindekiler?><p>
<?php } ?>

<?php if ($tadimlik <> '') { ?>
	<hr>
	<h2>TADIMLIK</h2>
	<p><?php echo $tadimlik?></p>
<?php } ?>

<br class="clear" />

<div class="right_articles">

<table width="100%">
<tr>
<td width="50%">

<table width="100%">
<tr>
	<td width="120"><p>Yayýnevi</p></td><td><p>:</p></td><td><p><?php echo $array_yayinevi[$yayinevino]?> </p></td>
</tr><tr>
	<td><p>Seri Adý</p></td><td><p>:</p></td><td><p><?php echo $array_seri_adlari[$serino]?></p></td>
</tr>
<tr colspan="2">
	<td><p>Yayýn Dili</p></td><td><p>:</p></td><td><p><?php echo $array_yayindili_adlari[$yayindili]?></p></td>
</tr><tr>
	<td><p>Barkod</p></td><td><p>:</p></td><td><p><?php echo $barkod ?></p></td>
</tr>
</table>

</td>
<td width="50%">

<table width="100%">
<tr>
	<td width="120"><p>Sayfa Sayýsý</p></td><td><p>:</p></td><td><p><?php echo $sayfasayisi ?> Sayfa</p></td>
</tr><tr>
	<td><p>Ýlk Baský Tarihi</p></td><td><p>:</p></td><td><p><?php echo date('F Y', $ilkbaskitarihi)?></p></td>
<tr colspan="2">
<tr>
	<td><p>Fiyatý</p></td><td><p>:</p></td><td><p><font style="color: rgb(204, 0, 0);"><strong><?php echo $satisfiyati ?> TL</strong></font></p></td>
</tr><tr>
	<td><p>Satýþ Durumu</p></td><td><p>:</p></td><td><p><font style="color: rgb(204, 0, 0);"><?php echo $array_satisdurumu[$satisdurumu] ?> <?php echo $array_urun_satisdurumu_adlari[$satisdurumu] ?></font></p></td>
</tr>
</table>

</td>
</tr>
</table>
</div>

</td>
</tr>
</table>

</div>

</div>
</div>

<?php } else { include($siteyolu."/_lib_temp/_hata.php"); } ?>
