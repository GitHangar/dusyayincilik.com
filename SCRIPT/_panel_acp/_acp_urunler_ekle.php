<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"] == 1) exit ();

$this_time = time();
$this_mounth = date('n', $this_time); 
$this_year = date('Y', $this_time);

if (isset($_REQUEST["urunform"]))
{
	//varsayýlanlar
	$changetar = time();
	
	//metin gelmesi gereken alanlar
	$urun_urunadi = addslashes(trim(strip_tags($_REQUEST["urun_urunadi"])));
	$urun_yazaradi = addslashes(trim(strip_tags($_REQUEST["urun_yazaradi"])));
	$urun_editoradi = addslashes(trim(strip_tags($_REQUEST["urun_editoradi"])));
	$urun_tanitimmetni = addslashes(trim(strip_tags($_REQUEST["urun_tanitimmetni"])));
	$urun_icindekiler = addslashes(trim(strip_tags($_REQUEST["urun_icindekiler"])));
	$urun_tadimlik = addslashes(trim(strip_tags($_REQUEST["urun_tadimlik"])));
	
	//seçmeli gelen alanlar
	$urun_satiskdv = trim(strip_tags($_REQUEST["urun_satiskdv"]));
	$urun_yayinevino = trim(strip_tags($_REQUEST["urun_yayinevino"]));
	$urun_satisdurumu = trim(strip_tags($_REQUEST["urun_satisdurumu"]));
	$urun_kategori1 = trim(strip_tags($_REQUEST["urun_kategori1"]));
	$urun_kategori2 = trim(strip_tags($_REQUEST["urun_kategori2"])); 
	$urun_kategori3 = trim(strip_tags($_REQUEST["urun_kategori3"]));
	$urun_yayindili = trim(strip_tags($_REQUEST["urun_yayindili"]));
	$urun_serino = trim(strip_tags($_REQUEST["urun_serino"]));	

	//sayýsal gelmesi gereken alanlar
	$urun_sonbaskitarihi_ay = trim(strip_tags($_REQUEST["urun_sonbaskitarihi_ay"]));
	$urun_sonbaskitarihi_yil = trim(strip_tags($_REQUEST["urun_sonbaskitarihi_yil"]));
	$urun_ilkbaskitarihi_ay = trim(strip_tags($_REQUEST["urun_ilkbaskitarihi_ay"]));
	$urun_ilkbaskitarihi_yil = trim(strip_tags($_REQUEST["urun_ilkbaskitarihi_yil"]));

	$urun_satisfiyati = trim(strip_tags($_REQUEST["urun_satisfiyati"])); 
	$urun_sirtno = trim(strip_tags($_REQUEST["urun_sirtno"]));
	$urun_barkod = trim(strip_tags($_REQUEST["urun_barkod"])); 
	$urun_hatalibarkod = trim(strip_tags($_REQUEST["urun_hatalibarkod"])); 
	$urun_seriicno = trim(strip_tags($_REQUEST["urun_seriicno"]));
	$urun_sonbaskino = trim(strip_tags($_REQUEST["urun_sonbaskino"])); 
	$urun_kidaplink = trim(strip_tags($_REQUEST["urun_kidaplink"]));
	$urun_sayfasayisi = trim(strip_tags($_REQUEST["urun_sayfasayisi"]));  
		
	//ön kontroller
	if ($urun_sonbaskitarihi_ay < 1) $urun_sonbaskitarihi_ay = '';
	if ($urun_sonbaskitarihi_yil < 1) $urun_sonbaskitarihi_yil = '';
	if ($urun_ilkbaskitarihi_ay < 1) $urun_ilkbaskitarihi_ay = '';
	if ($urun_ilkbaskitarihi_yil < 1) $urun_ilkbaskitarihi_yil = '';
	
	if ($urun_satisfiyati < 1) $urun_satisfiyati = '';
	if ($urun_sirtno < 1) $urun_sirtno = '';
	if ($urun_barkod < 1) $urun_barkod = '';
	if ($urun_hatalibarkod < 1) $urun_hatalibarkod = '';
	if ($urun_seriicno < 1) $urun_seriicno = '';
	if ($urun_sonbaskino < 1) $urun_sonbaskino = '';
	if ($urun_kidaplink < 1) $urun_kidaplink = '';
	if ($urun_sayfasayisi < 1) $urun_sayfasayisi = '';
	
	$urun_sonbaskitarihi = mktime(12, 12, 12, $urun_sonbaskitarihi_ay, 2, $urun_sonbaskitarihi_yil);
	$urun_ilkbaskitarihi = mktime(12, 12, 12, $urun_ilkbaskitarihi_ay, 2, $urun_ilkbaskitarihi_yil);
	//düzenlemeler
	$urun_satisfiyati = str_replace (',', '.', $urun_satisfiyati);
	
	//fazladan boþluklarý temizliyoruz
	$urun_tanitimmetni = pco_bosluk_temizle($urun_tanitimmetni);
	$urun_icindekiler = pco_bosluk_temizle($urun_icindekiler);
	$urun_tadimlik = pco_bosluk_temizle($urun_tadimlik);
	
	//HATA KONTROLÜ
	if ( strlen($urun_urunadi) < 2 or !eregi("[[:alpha:]]",$urun_urunadi) )
	$islemsonu = '<br>Ürün Adý alanýný boþ býrýkmayýnýz';

	if ( strlen($urun_yazaradi) < 2 or !eregi("[[:alpha:]]",$urun_yazaradi) )
	$islemsonu .= '<br>Yazar Adý alanýný boþ býrakmayýnýz';
	
	if ($islemsonu == '')
	{
		$SORGU_urunekle = "
			INSERT INTO pco_stok (
			urunadi,
			yazaradi,
			sayfasayisi,
			editoradi,
			satisfiyati,
			satiskdv,
			satisdurumu,
			sirtno,
			yayinevino,
			barkod,
			hatalibarkod,
			serino,
			seriicno,
			kategori1,
			kategori2,
			kategori3,
			tanitimmetni,
			icindekiler,
			tadimlik,
			sonbaskino,
			sonbaskitarihi,
			ilkbaskitarihi,
			kidaplink,
			yayindili,
			createtar,
			changetar
			)
			VALUES (
			'".$urun_urunadi."',
			'".$urun_yazaradi."',
			'".$urun_sayfasayisi."',
			'".$urun_editoradi."',
			'".$urun_satisfiyati."',
			'".$urun_satiskdv."',
			'".$urun_satisdurumu."',
			'".$urun_sirtno."',
			'".$urun_yayinevino."',
			'".$urun_barkod."',
			'".$urun_hatalibarkod."',
			'".$urun_serino."',
			'".$urun_seriicno."',
			'".$urun_kategori1."',
			'".$urun_kategori2."',
			'".$urun_kategori3."',
			'".$urun_tanitimmetni."',
			'".$urun_icindekiler."',
			'".$urun_tadimlik."',
			'".$urun_sonbaskino."',
			'".$urun_sonbaskitarihi."',
			'".$urun_ilkbaskitarihi."',
			'".$urun_kidaplink."',
			'".$urun_yayindili."',
			'".$changetar."',
			'".$changetar."'
			);";
			//addslashes($SORGU_urunekle);
		//echo $SORGU_urunekle;
		$SORGU_sonuc = mysql_query($SORGU_urunekle);
		$etkilenen = mysql_affected_rows();
		$islemsonu = '<div class="successbox">'.$urun_urunadi.' ürünü sisteme eklenmiþtir.</div>';
		pco_temizle_cache();
	}
	else
	{
		$islemsonu = '<div class="errorbox">'.$islemsonu.'<br><br></div>';
	}
	
}
?>
<h1>Ürün Ekle</h1>

<?php echo $islemsonu?>

<form name="urunform" action="<?php echo $acp_urunlerlink?>&urunekle=1" method="POST">
<input type="hidden" name="menu" value="urunler">
<input type="hidden" name="urunekle" value="1">

<table class="pati" width="100%" cellspacing="5" cellspacing="5" border="0">
<tr>
<th width="55%">
</th>
<th>
<input class="button1" id="urunform" name="urunform" value="ÜRÜN EKLE" type="submit">
</th>
</tr>

<tr>
<td valign="top"> 
<table valign="top" width="470" cellspacing="5" cellspacing="5" border="0">
<tr class="col1">
<th colspan="3">
Temel Bilgiler
</th>
</tr>
<tr>


<tr>
<td>Ürün Adý</td>
<td>:</td>
<td><input type="text" name="urun_urunadi" style="width: 270px;"></td></td>
</tr>

<tr>
<td>Yazar Adý</td>
<td>:</td>
<td><input type="text" name="urun_yazaradi" style="width: 270px;"></td></td>
</tr>

<tr>
<td>Yayýnevi</td>
<td>:</td>
<td>
<select style="width: 275px;" name="urun_yayinevino">
<?php
foreach ($array_yayinevi as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
</td>
</tr>

<tr>
<td>Ürün</td>
<td>:</td>
<td>
<select style="width: 150px;" name="urun_satisdurumu">
<?php
foreach ($array_urun_satisdurumu_adlari as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
</td>
</tr>

<tr>
<td>Ürün Fiyatý</td>
<td>:</td>
<td>
<input type="text" name="urun_satisfiyati" style="width: 145px;" maxlength="10">
KDV&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select style="width: 46px;" name="urun_satiskdv">
<option value="8">8</option>
<?php
foreach ($array_kdv as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
</td>
</tr>

<tr>
<td>Seri Adý</td>
<td>:</td>
<td>
<select style="width: 150px;" name="urun_serino">
<?php
foreach ($array_seri_adlari as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
Seri Ýç No &nbsp;&nbsp;&nbsp;<input type="text" name="urun_seriicno" style="width: 40px;" maxlength="5">
</td>
</tr>

<tr>
<td>Sayfa Sayýsý</td>
<td>:</td>
<td>
<input type="text" name="urun_sayfasayisi" style="width: 145px;" maxlength="70">
Sýrt No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="urun_sirtno" style="width: 40px;" maxlength="5">					
</td></td>
</tr>

<tr>
<td>Barkod</td>
<td>:</td>
<td><input type="text" name="urun_barkod" style="width: 145px;" maxlength="15"></td></td>
</tr>

<tr>
<td>Hatalý Barkod</td>
<td>:</td>
<td><input type="text" name="urun_hatalibarkod" style="width: 145px;" maxlength="15"></td></td>
</tr>

<tr class="col1">
<th colspan="3">
ÝLAVE BÝLGÝLER
</th>
</tr>

<tr>
<td>Editör Adý</td>
<td>:</td>
<td><input type="text" name="urun_editoradi" style="width: 270px;"></td></td>
</tr>

<tr>
<td>Kategori 1</td>
<td>:</td>
<td>
<select style="width: 275px;" name="urun_kategori1">
<?php
foreach ($array_kategori_adlari as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
</td>
</tr>

<tr>
<td>kategori 2</td>
<td>:</td>
<td>
<select style="width: 275px;" name="urun_kategori2">
<?php
foreach ($array_kategori_adlari as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
</td>
</tr>

<tr>
<td>kategori 3</td>
<td>:</td>
<td>
<select style="width: 275px;" name="urun_kategori3">
<?php
foreach ($array_kategori_adlari as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
</td>
</tr>

<tr>
<td>Ýlk Baský Tarihi</td>
<td>:</td>
<td>
<select style="width: 80px;" name="urun_ilkbaskitarihi_ay">
<option value="<?php echo $this_mounth?>">  <?php echo $this_mounth?></option>
<?php
foreach ($array_aylar as $k => $v)
{
	echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>

<select style="width: 65px;" name="urun_ilkbaskitarihi_yil">
<option value="<?php echo $this_year?>">  <?php echo $this_year?></option>
<?php
foreach ($array_yillar as $k => $v)
{
	echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>

</td>
</tr>
<tr>
<td>Son Baský Tarihi</td>
<td>:</td>
<td>
<select style="width: 80px;" name="urun_sonbaskitarihi_ay">
<option value="<?php echo $this_mounth?>">  <?php echo $this_mounth?></option>
<?php
foreach ($array_aylar as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>

<select style="width: 65px;" name="urun_sonbaskitarihi_yil">
<option value="<?php echo $this_year?>">  <?php echo $this_year?></option>
<?php
foreach ($array_yillar as $k => $v)
{
	echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>

Son Baský &nbsp;<input type="text" name="urun_sonbaskino" style="width: 60px;" maxlength="4">
</td>
</tr>

<tr>
<td>Yayýn Dili</td>
<td>:</td>
<td>
<select style="width: 150px;" name="urun_yayindili">
<?php
foreach ($array_yayindili_adlari as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
KStokNo &nbsp;&nbsp;&nbsp;<input type="text" name="urun_kitaplink" style="width: 60px;" maxlength="10">
</td>
</tr>

</table>
</td>
<td valign="top">
<table width="400" cellspacing="5" cellspacing="5" border="0">
<tr class="col1">
<th colspan="3">
TANITIM METNÝ
</th>
</tr>

<tr>
<td>
<textarea name="urun_tanitimmetni" rows="9" style="width: 500px"></textarea></td></td>
</tr>

<tr class="col1">
<th colspan="3">
ÝÇÝNDEKÝLER
</th>
</tr>

<tr>
<td>
<textarea name="urun_icindekiler" rows="8" style="width: 500px"></textarea></td></td>
</tr>

<tr class="col1">
<th colspan="3">
TADIMLIK
</th>
</tr>

<tr>
<td>
<textarea name="urun_tadimlik" rows="8" style="width: 500px"></textarea></td></td>
</tr>
</table>
</td>
</tr>
</table>	
</form>
<br>
<div align="right">
<form name="form2" action="<?php echo SITELINK?>/_ajax.php?yeniresim=1" method="post" enctype="multipart/form-data" target="uploadtarget">
<p id="UploadForm">
<input name="content_image" type="file" size="30">
<input type="submit" name="submitBtn" class="button1" value="Ekle">
</p>

<iframe id="uploadtarget" name="uploadtarget" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
</form>
</div>

<pre>
* Seri Adý: Yayýnevininde ürünün ait olduðu seri.
* Seri Ýç no: Ürünün, seri içindeki kaçýncý kitap olduðu.
* Sýrt no: Yayýnevinin ürüne atadýðý ürün numarasý.
* Hatalý Barkod: Ürünün basýlmýþ þeklindeki barkod bir ürün ile çakýþýyorsa, çakýþtýðý barkod numarasý.
* KStokNo: Ürünün kidap.com.tr sitesindeki stok numarasýdýr. Ürünün resmini ve satýþ linkleri bu no ile oluþturulur.
* Yayýnevleri: ürünün ait olduðu muhmemel yayýnevleri.
* Kategoriler: ürünün ait olduðu muhmemel kategoriler.

Yayýnevleri ve Kategoriler geniþletilebilir durumdadýr. 
Eklemek istediðiniz kategorileri ve yayýnevlerini sistem yöneticisine bildiriniz.
</pre>
</div>
