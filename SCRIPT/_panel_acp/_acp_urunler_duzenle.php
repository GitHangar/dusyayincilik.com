<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"] == 1) exit ();

$this_time = time();
$this_mounth = date('n', $this_time); 
$this_year = date('Y', $this_time);

if (isset($_REQUEST["urunform"]))
{
	//varsayýlan deðerler
	$changetar = time();
	$urun_stokno = trim(strip_tags($_REQUEST["urun_stokno"]));

	if ($urun_stokno > 0)
	{
		//metin gelmesi gereken alanlar
		$urun_urunadi = addslashes(trim(strip_tags($_REQUEST["urun_urunadi"])));
		$urun_yazaradi = addslashes(trim(strip_tags($_REQUEST["urun_yazaradi"])));
		$urun_editoradi = addslashes(trim(strip_tags($_REQUEST["urun_editoradi"])));
		$urun_tanitimmetni = addslashes(trim($_REQUEST["urun_tanitimmetni"]));
		$urun_icindekiler = addslashes(trim($_REQUEST["urun_icindekiler"]));
		$urun_tadimlik = addslashes(trim($_REQUEST["urun_tadimlik"]));

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
		$urun_satisfiyati = str_replace (',', '.', $urun_satisfiyati);
		//fazladan boþluklarý temizliyoruz
		$urun_tanitimmetni = pco_bosluk_temizle($urun_tanitimmetni);
		$urun_icindekiler = pco_bosluk_temizle($urun_icindekiler);
		$urun_tadimlik = pco_bosluk_temizle($urun_tadimlik);		

		$SORGU_urun = "
			UPDATE pco_stok 
			SET 
				urunadi = '".$urun_urunadi."',
				yazaradi = '".$urun_yazaradi."',
				sayfasayisi = '".$urun_sayfasayisi."',
				editoradi = '".$urun_editoradi."',
				satisfiyati = '".$urun_satisfiyati."',
				satiskdv = '".$urun_satiskdv."',
				satisdurumu = '".$urun_satisdurumu."',
				sirtno = '".$urun_sirtno."',
				yayinevino = '".$urun_yayinevino."',
				barkod = '".$urun_barkod."',
				hatalibarkod = '".$urun_hatalibarkod."',
				serino = '".$urun_serino."',
				seriicno = '".$urun_seriicno."',
				kategori1 = '".$urun_kategori1."',
				kategori2 = '".$urun_kategori2."',
				kategori3 = '".$urun_kategori3."',
				tanitimmetni = '".$urun_tanitimmetni."',
				icindekiler = '".$urun_icindekiler."',
				tadimlik = '".$urun_tadimlik."',
				sonbaskino = '".$urun_sonbaskino."',
				sonbaskitarihi = '".$urun_sonbaskitarihi."',
				ilkbaskitarihi = '".$urun_ilkbaskitarihi."',
				kidaplink = '".$urun_kidaplink."',
				yayindili = '".$urun_yayindili."',
				changetar = '".$changetar."'
			WHERE stokno = '".$urun_stokno."'
			;";
			addslashes($SORGU_urun);
			//echo $SORGU_urun;
		$SORGU_sonuc = mysql_query($SORGU_urun);
		$etkilenen = mysql_affected_rows();
		$islemsonu = '<div class="successbox">'.stripcslashes($_REQUEST["urun_urunadi"]).' ürününe ait bilgiler güncellenmiþtir.</div>';
		pco_temizle_cache();
	}
	else
	{
		$islemsonu = '<div class="errorbox">Ürün Stokno Hatasý, neden acaba?</div>';
	}
}

$urun_stokno = $_REQUEST["un"];
$delete = $_REQUEST["delete"];
if ($urun_stokno > 0 && $delete == 1)
{
	//$SORGU_cumle = 'UPDATE pco_stok SET satisdurumu = "3" WHERE stokno = "'.$urun_stokno.'";';
	$SORGU_cumle = 'DELETE FROM pco_stok WHERE stokno = "'.$urun_stokno.'";';
	$SORGU_sonuc = mysql_query($SORGU_cumle);
	$islemsonu = '<div class="errorbox">Seçilen ürün silinmiþ olarak iþaretlenip arþive alýnmýþtýr.</div>';
}

$SORGU_cumle = '
	SELECT 
		stokno, urunadi, yazaradi, sayfasayisi, editoradi, satisfiyati, satiskdv, satisdurumu, sirtno, yayinevino,
		barkod, hatalibarkod, serino, seriicno, kategori1, kategori2, kategori3, tanitimmetni, 
		icindekiler, tadimlik, sonbaskino, sonbaskitarihi, ilkbaskitarihi, kidaplink, yayindili
	FROM pco_stok 
	WHERE stokno = "'.$urun_stokno.'";';
$SORGU_sonuc = mysql_query($SORGU_cumle);
$bulunanadet = mysql_num_rows($SORGU_sonuc);

$urun_stokno = mysql_result($SORGU_sonuc,0,"stokno");
$urun_urunadi = mysql_result($SORGU_sonuc,0,"urunadi");
$urun_yazaradi = mysql_result($SORGU_sonuc,0,"yazaradi");
$urun_sayfasayisi = mysql_result($SORGU_sonuc,0,"sayfasayisi");
$urun_editoradi = mysql_result($SORGU_sonuc,0,"editoradi");
$urun_satisfiyati = mysql_result($SORGU_sonuc,0,"satisfiyati");
$urun_satiskdv = mysql_result($SORGU_sonuc,0,"satiskdv");
$urun_satisdurumu = mysql_result($SORGU_sonuc,0,"satisdurumu");
$urun_sirtno = mysql_result($SORGU_sonuc,0,"sirtno");
$urun_yayinevino = mysql_result($SORGU_sonuc,0,"yayinevino");
$urun_barkod = mysql_result($SORGU_sonuc,0,"barkod");
$urun_hatalibarkod = mysql_result($SORGU_sonuc,0,"hatalibarkod");
$urun_serino = mysql_result($SORGU_sonuc,0,"serino");
$urun_seriicno = mysql_result($SORGU_sonuc,0,"seriicno");
$urun_kategori1 = mysql_result($SORGU_sonuc,0,"kategori1");
$urun_kategori2 = mysql_result($SORGU_sonuc,0,"kategori2");
$urun_kategori3 = mysql_result($SORGU_sonuc,0,"kategori3");
$urun_tanitimmetni = mysql_result($SORGU_sonuc,0,"tanitimmetni");
$urun_icindekiler = mysql_result($SORGU_sonuc,0,"icindekiler");
$urun_tadimlik = mysql_result($SORGU_sonuc,0,"tadimlik");
$urun_sonbaskino = mysql_result($SORGU_sonuc,0,"sonbaskino");
$urun_sonbaskitarihi = mysql_result($SORGU_sonuc,0,"sonbaskitarihi");
$urun_ilkbaskitarihi = mysql_result($SORGU_sonuc,0,"ilkbaskitarihi");
$urun_kidaplink = mysql_result($SORGU_sonuc,0,"kidaplink");
$urun_yayindili = mysql_result($SORGU_sonuc,0,"yayindili");
	$urun_sonbaskitarihi_ay = date('n', $urun_sonbaskitarihi);
	$urun_sonbaskitarihi_yil = date('Y', $urun_sonbaskitarihi);
	$urun_ilkbaskitarihi_ay = date('n', $urun_ilkbaskitarihi);
	$urun_ilkbaskitarihi_yil = date('Y', $urun_ilkbaskitarihi);
	
//slash iþaretleri temizleniyor
$urun_urunadi = stripslashes($urun_urunadi);
$urun_yazaradi = stripslashes($urun_yazaradi);
$urun_editoradi = stripslashes($urun_editoradi);
$urun_tanitimmetni = stripslashes($urun_tanitimmetni);
$urun_icindekiler = stripslashes($urun_icindekiler);
$urun_tadimlik = stripslashes($urun_tadimlik);

$file_link = SITELINK.'/' . URUNDETAY . '?pid=' . $urun_stokno .'-'. pco_format_url($urun_urunadi) ;
if (SEO_OPEN == 1) $file_link = SITELINK.'/' . pco_format_url($urun_urunadi) . '-'.DETAY . $urun_stokno . SEO;
?>
<h1>Ürün Güncelle &raquo; <a title="Ürün Bilgilerini Görüntüle" href="<?php echo $file_link?>"><?php echo $urun_urunadi?></a></h1>
<script>
function confirmDelete(delUrl)
{
if (confirm("<?php echo $urun_urunadi?> isimli bu ürünü silinmiþ olarak iþaretlemek istediðinizden emin misiniz?"))
{
document.location = delUrl;
}
}
</script>

<?php echo $islemsonu?>

<form name="urunform" action="<?php echo $acp_urunlerlink?>&un=<?php echo $urun_stokno?>" method="POST">
<input type="hidden" name="menu" value="urunler">
<input type="hidden" name="islem" value="guncelle">
<input type="hidden" name="urun_stokno" value="<?php echo $urun_stokno?>">

<table width="100%" cellspacing="5" cellspacing="5" border="0">
<tr>
<th width="55%">
<a class="button1" href="javascript:confirmDelete('<?php echo $acp_urunlerlink?>&amp;un=<?php echo $urun_stokno?>&amp;delete=1')">ÜRÜNÜ SÝL</a>
</th>
<th>
<input class="button1" id="urunform" name="urunform" value="DEÐÝÞÝKLÝKLERÝ KAYDET" type="submit">
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
<td><input type="text" name="urun_urunadi" value="<?php echo $urun_urunadi?>" style="width: 270px;"></td></td>
</tr>

<tr>
<td>Yazar Adý</td>
<td>:</td>
<td><input type="text" name="urun_yazaradi" value="<?php echo $urun_yazaradi?>" style="width: 270px;"></td></td>
</tr>

<tr>
<td>Yayýnevi</td>
<td>:</td>
<td>
<select style="width: 275px;" name="urun_yayinevino">
<option value="<?php echo $urun_yayinevino?>"> <?php echo $array_yayinevi[$urun_yayinevino]?></option>
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
<option value="<?php echo $urun_satisdurumu?>"> <?php echo $array_urun_satisdurumu_adlari[$urun_satisdurumu]?></option>
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
<input type="text" name="urun_satisfiyati" value="<?php echo $urun_satisfiyati?>" style="width: 145px;" maxlength="10">
KDV&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select style="width: 46px;" name="urun_satiskdv">
<option value="<?php echo $urun_satiskdv?>"><?php echo $array_kdv[$urun_satiskdv]?></option>
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
<option value="<?php echo $urun_serino?>"> <?php echo $array_seri_adlari[$urun_serino]?></option>
<?php
foreach ($array_seri_adlari as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
Seri Ýç No &nbsp;&nbsp;&nbsp;<input type="text" name="urun_seriicno" value="<?php echo $urun_seriicno?>" style="width: 40px;">
</td>
</tr>

<tr>
<td>Sayfa Sayýsý</td>
<td>:</td>
<td>
<input type="text" name="urun_sayfasayisi" value="<?php echo $urun_sayfasayisi?>" style="width: 145px;" maxlength="70">
Sýrt No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="urun_sirtno" value="<?php echo $urun_sirtno?>" style="width: 40px;" maxlength="5">					
</td></td>
</tr>

<tr>
<td>Barkod</td>
<td>:</td>
<td><input type="text" name="urun_barkod" value="<?php echo $urun_barkod?>" style="width: 145px;" maxlength="15"></td></td>
</tr>

<tr>
<td>Hatalý Barkod</td>
<td>:</td>
<td><input type="text" name="urun_hatalibarkod" value="<?php echo $urun_hatalibarkod?>" style="width: 145px;" maxlength="15"></td></td>
</tr>

<tr class="col1">
<th colspan="3">
ÝLAVE BÝLGÝLER
</th>
</tr>

<tr>
<td>Editör Adý</td>
<td>:</td>
<td><input type="text" name="urun_editoradi" value="<?php echo $urun_editoradi?>" style="width: 270px;"></td></td>
</tr>

<tr>
<td>Kategori 1</td>
<td>:</td>
<td>
<select style="width: 275px;" name="urun_kategori1">
<option value="<?php echo $urun_kategori1?>"> <?php echo $array_kategori_adlari[$urun_kategori1]?></option>
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
<option value="<?php echo $urun_kategori2?>"> <?php echo $array_kategori_adlari[$urun_kategori2]?></option>
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
<option value="<?php echo $urun_kategori3?>"> <?php echo $array_kategori_adlari[$urun_kategori3]?></option>
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
<option value="<?php echo $urun_ilkbaskitarihi_ay?>">  <?php echo $array_aylar[$urun_ilkbaskitarihi_ay]?></option>
<option style="background-color:red;" value="<?php echo $this_mounth?>">  <?php echo $array_aylar[$this_mounth]?></option>
<?php
foreach ($array_aylar as $k => $v)
{
	echo '<option value="'.$k.'"><strong>'.$v.'</strong></option>'. "\r\n";
}
?>
</select>

<select style="width: 65px;" name="urun_ilkbaskitarihi_yil">
<option value="<?php echo $urun_ilkbaskitarihi_yil?>">  <?php echo $urun_ilkbaskitarihi_yil?></option>
<option style="background-color:red;" value="<?php echo $this_year?>">  <?php echo $array_yillar[$this_year]?></option>
<?php
foreach ($array_yillar as $k => $v)
{
	echo '<option value="'.$k.'"><strong>'.$v.'</strong></option>'. "\r\n";
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
<option value="<?php echo $urun_sonbaskitarihi_ay?>">  <?php echo $array_aylar[$urun_sonbaskitarihi_ay]?></option>
<option style="background-color:red;" value="<?php echo $this_mounth?>">  <?php echo $array_aylar[$this_mounth]?></option>
<?php
foreach ($array_aylar as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>

<select style="width: 65px;" name="urun_sonbaskitarihi_yil">
<option value="<?php echo $urun_sonbaskitarihi_yil?>">  <?php echo $urun_sonbaskitarihi_yil?></option>
<option style="background-color:red;" value="<?php echo $this_year?>">  <?php echo $array_yillar[$this_year]?></option>
<?php
foreach ($array_yillar as $k => $v)
{
	echo '<option value="'.$k.'"><strong>'.$v.'</strong></option>'. "\r\n";
}
?>
</select>

Son Baský &nbsp;<input type="text" name="urun_sonbaskino" value="<?php echo $urun_sonbaskino?>" style="width: 60px;" maxlength="4">
</td>
</tr>

<tr>
<td>Yayýn Dili</td>
<td>:</td>
<td>
<select style="width: 150px;" name="urun_yayindili">
<option value="<?php echo $urun_yayindili?>"> <?php echo $array_yayindili_adlari[$urun_yayindili]?></option>
<?php
foreach ($array_yayindili_adlari as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
KStokNo &nbsp;&nbsp;&nbsp;<input type="text" name="urun_kidaplink" value="<?php echo $urun_kidaplink?>" style="width: 60px;" maxlength="10">
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
<textarea name="urun_tanitimmetni" rows="9" style="width: 500px"><?php echo $urun_tanitimmetni?></textarea></td></td>
</tr>

<tr class="col1">
<th colspan="3">
ÝÇÝNDEKÝLER
</th>
</tr>

<tr>
<td>
<textarea name="urun_icindekiler" rows="8" style="width: 500px"><?php echo $urun_icindekiler?></textarea></td></td>
</tr>

<tr class="col1">
<th colspan="3">
TADIMLIK
</th>
</tr>

<tr>
<td>
<textarea name="urun_tadimlik" rows="8" style="width: 500px"><?php echo $urun_tadimlik?></textarea></td></td>
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
