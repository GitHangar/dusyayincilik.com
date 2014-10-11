<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"] == 1) exit ();

$this_time = time();
$this_mounth = date('n', $this_time); 
$this_year = date('Y', $this_time);

if (isset($_REQUEST["urunform"]))
{
	//varsay�lanlar
	$changetar = time();
	
	//metin gelmesi gereken alanlar
	$urun_urunadi = addslashes(trim(strip_tags($_REQUEST["urun_urunadi"])));
	$urun_yazaradi = addslashes(trim(strip_tags($_REQUEST["urun_yazaradi"])));
	$urun_editoradi = addslashes(trim(strip_tags($_REQUEST["urun_editoradi"])));
	$urun_tanitimmetni = addslashes(trim(strip_tags($_REQUEST["urun_tanitimmetni"])));
	$urun_icindekiler = addslashes(trim(strip_tags($_REQUEST["urun_icindekiler"])));
	$urun_tadimlik = addslashes(trim(strip_tags($_REQUEST["urun_tadimlik"])));
	
	//se�meli gelen alanlar
	$urun_satiskdv = trim(strip_tags($_REQUEST["urun_satiskdv"]));
	$urun_yayinevino = trim(strip_tags($_REQUEST["urun_yayinevino"]));
	$urun_satisdurumu = trim(strip_tags($_REQUEST["urun_satisdurumu"]));
	$urun_kategori1 = trim(strip_tags($_REQUEST["urun_kategori1"]));
	$urun_kategori2 = trim(strip_tags($_REQUEST["urun_kategori2"])); 
	$urun_kategori3 = trim(strip_tags($_REQUEST["urun_kategori3"]));
	$urun_yayindili = trim(strip_tags($_REQUEST["urun_yayindili"]));
	$urun_serino = trim(strip_tags($_REQUEST["urun_serino"]));	

	//say�sal gelmesi gereken alanlar
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
		
	//�n kontroller
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
	//d�zenlemeler
	$urun_satisfiyati = str_replace (',', '.', $urun_satisfiyati);
	
	//fazladan bo�luklar� temizliyoruz
	$urun_tanitimmetni = pco_bosluk_temizle($urun_tanitimmetni);
	$urun_icindekiler = pco_bosluk_temizle($urun_icindekiler);
	$urun_tadimlik = pco_bosluk_temizle($urun_tadimlik);
	
	//HATA KONTROL�
	if ( strlen($urun_urunadi) < 2 or !eregi("[[:alpha:]]",$urun_urunadi) )
	$islemsonu = '<br>�r�n Ad� alan�n� bo� b�r�kmay�n�z';

	if ( strlen($urun_yazaradi) < 2 or !eregi("[[:alpha:]]",$urun_yazaradi) )
	$islemsonu .= '<br>Yazar Ad� alan�n� bo� b�rakmay�n�z';
	
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
		$islemsonu = '<div class="successbox">'.$urun_urunadi.' �r�n� sisteme eklenmi�tir.</div>';
		pco_temizle_cache();
	}
	else
	{
		$islemsonu = '<div class="errorbox">'.$islemsonu.'<br><br></div>';
	}
	
}
?>
<h1>�r�n Ekle</h1>

<?php echo $islemsonu?>

<form name="urunform" action="<?php echo $acp_urunlerlink?>&urunekle=1" method="POST">
<input type="hidden" name="menu" value="urunler">
<input type="hidden" name="urunekle" value="1">

<table class="pati" width="100%" cellspacing="5" cellspacing="5" border="0">
<tr>
<th width="55%">
</th>
<th>
<input class="button1" id="urunform" name="urunform" value="�R�N EKLE" type="submit">
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
<td>�r�n Ad�</td>
<td>:</td>
<td><input type="text" name="urun_urunadi" style="width: 270px;"></td></td>
</tr>

<tr>
<td>Yazar Ad�</td>
<td>:</td>
<td><input type="text" name="urun_yazaradi" style="width: 270px;"></td></td>
</tr>

<tr>
<td>Yay�nevi</td>
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
<td>�r�n</td>
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
<td>�r�n Fiyat�</td>
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
<td>Seri Ad�</td>
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
Seri �� No &nbsp;&nbsp;&nbsp;<input type="text" name="urun_seriicno" style="width: 40px;" maxlength="5">
</td>
</tr>

<tr>
<td>Sayfa Say�s�</td>
<td>:</td>
<td>
<input type="text" name="urun_sayfasayisi" style="width: 145px;" maxlength="70">
S�rt No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="urun_sirtno" style="width: 40px;" maxlength="5">					
</td></td>
</tr>

<tr>
<td>Barkod</td>
<td>:</td>
<td><input type="text" name="urun_barkod" style="width: 145px;" maxlength="15"></td></td>
</tr>

<tr>
<td>Hatal� Barkod</td>
<td>:</td>
<td><input type="text" name="urun_hatalibarkod" style="width: 145px;" maxlength="15"></td></td>
</tr>

<tr class="col1">
<th colspan="3">
�LAVE B�LG�LER
</th>
</tr>

<tr>
<td>Edit�r Ad�</td>
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
<td>�lk Bask� Tarihi</td>
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
<td>Son Bask� Tarihi</td>
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

Son Bask� &nbsp;<input type="text" name="urun_sonbaskino" style="width: 60px;" maxlength="4">
</td>
</tr>

<tr>
<td>Yay�n Dili</td>
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
TANITIM METN�
</th>
</tr>

<tr>
<td>
<textarea name="urun_tanitimmetni" rows="9" style="width: 500px"></textarea></td></td>
</tr>

<tr class="col1">
<th colspan="3">
���NDEK�LER
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
* Seri Ad�: Yay�nevininde �r�n�n ait oldu�u seri.
* Seri �� no: �r�n�n, seri i�indeki ka��nc� kitap oldu�u.
* S�rt no: Yay�nevinin �r�ne atad��� �r�n numaras�.
* Hatal� Barkod: �r�n�n bas�lm�� �eklindeki barkod bir �r�n ile �ak���yorsa, �ak��t��� barkod numaras�.
* KStokNo: �r�n�n kidap.com.tr sitesindeki stok numaras�d�r. �r�n�n resmini ve sat�� linkleri bu no ile olu�turulur.
* Yay�nevleri: �r�n�n ait oldu�u muhmemel yay�nevleri.
* Kategoriler: �r�n�n ait oldu�u muhmemel kategoriler.

Yay�nevleri ve Kategoriler geni�letilebilir durumdad�r. 
Eklemek istedi�iniz kategorileri ve yay�nevlerini sistem y�neticisine bildiriniz.
</pre>
</div>
