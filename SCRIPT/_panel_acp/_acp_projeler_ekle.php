<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"] == 1) exit ();

$this_time = time();
$this_day = date('d', $this_time); 
$this_mounth = date('n', $this_time); 
$this_year = date('Y', $this_time);	

// echo "<pre>";
// print_r($_REQUEST);
// echo "</pre>";

if (isset($_REQUEST["form1"]))
{
	//varsay�lanlar
	$changetar = time();
	$createtar = time();

	//
	//metin gelmesi gereken alanlar
	//
	$book_name = addslashes(trim(strip_tags($_REQUEST["book_name"])));
	$book_author = addslashes(trim(strip_tags($_REQUEST["book_author"])));
	$book_editor = addslashes(trim(strip_tags($_REQUEST["book_editor"])));
	$book_translator = addslashes(trim(strip_tags($_REQUEST["book_translator"])));
	
	//
	//se�meli gelen alanlar
	//
	$book_type = trim(strip_tags($_REQUEST["book_type"]));
	$book_publisher = trim(strip_tags($_REQUEST["book_publisher"]));
	$book_serias = trim(strip_tags($_REQUEST["book_serias"]));
	$book_isbn_status = trim(strip_tags($_REQUEST["book_isbn_status"]));	
	$book_bandrol_status = trim(strip_tags($_REQUEST["book_bandrol_status"]));	
	$book_bandrol_status = trim(strip_tags($_REQUEST["book_bandrol_status"]));	
	$author_copyright_agreement_duration = trim(strip_tags($_REQUEST["author_copyright_agreement_duration"]));	
	$author_constant_delivery_planed_type = trim(strip_tags($_REQUEST["author_constant_delivery_planed_type"]));	
	$author_constant_delivery_accept_type = trim(strip_tags($_REQUEST["author_constant_delivery_accept_type"]));	

	//
	//checkbox ile gelen alanlar
	//
	$author_copyright_agreement= trim(strip_tags($_REQUEST["author_copyright_agreement"]));
	$author_copyright_agreement_save = trim(strip_tags($_REQUEST["author_copyright_agreement_save"]));
	$author_constant_accepted = trim(strip_tags($_REQUEST["author_constant_accepted"]));	

	//
	//say�sal gelmesi gereken alanlar
	//

		//planlanan yay�n tarihi
		$book_publish_planed_date_day = trim(strip_tags($_REQUEST["book_publish_planed_date_day"]));
		$book_publish_planed_date_month = trim(strip_tags($_REQUEST["book_publish_planed_date_month"]));
		$book_publish_planed_date_year = trim(strip_tags($_REQUEST["book_publish_planed_date_year"]));

		//telif anla�mas� imzalanma tarih
		$author_copyright_agreement_date_day = trim(strip_tags($_REQUEST["author_copyright_agreement_date_day"]));
		$author_copyright_agreement_date_month = trim(strip_tags($_REQUEST["author_copyright_agreement_date_month"]));
		$author_copyright_agreement_date_year = trim(strip_tags($_REQUEST["author_copyright_agreement_date_year"]));

		//metin teslim al�nacak tarih
		$author_constant_delivery_planed_date_day = trim(strip_tags($_REQUEST["author_constant_delivery_planed_date_day"]));
		$author_constant_delivery_planed_date_month = trim(strip_tags($_REQUEST["author_constant_delivery_planed_date_month"]));
		$author_constant_delivery_planed_date_year = trim(strip_tags($_REQUEST["author_constant_delivery_planed_date_year"]));

		//metin teslim al�nan tarih
		$author_constant_delivery_accept_date_day = trim(strip_tags($_REQUEST["author_constant_delivery_accept_date_day"]));
		$author_constant_delivery_accept_date_month = trim(strip_tags($_REQUEST["author_constant_delivery_accept_date_month"]));
		$author_constant_delivery_accept_date_year = trim(strip_tags($_REQUEST["author_constant_delivery_accept_date_year"]));

		//metin kabul edilen tarih
		$author_constant_accepted_date_day = trim(strip_tags($_REQUEST["author_constant_accepted_date_day"]));
		$author_constant_accepted_date_month = trim(strip_tags($_REQUEST["author_constant_accepted_date_month"]));
		$author_constant_accepted_date_year = trim(strip_tags($_REQUEST["author_constant_accepted_date_year"]));

	$book_pubnumber = trim(strip_tags($_REQUEST["book_pubnumber"])); 
	$book_serias_id = trim(strip_tags($_REQUEST["book_serias_id"]));
	$book_isbn = trim(strip_tags($_REQUEST["book_isbn"])); 
	$book_pagecount = trim(strip_tags($_REQUEST["book_pagecount"])); 

	//
	//�n kontroller
	//
	if ($book_publish_planed_date_day < 1) $book_publish_planed_date_day = '';
	if ($book_publish_planed_date_month < 1) $book_publish_planed_date_month = '';
	if ($book_publish_planed_date_year < 1) $book_publish_planed_date_year = '';
	
	if ($author_copyright_agreement_date_day < 1) $author_copyright_agreement_date_day = '';
	if ($author_copyright_agreement_date_month < 1) $author_copyright_agreement_date_month = '';
	if ($author_copyright_agreement_date_year < 1) $author_copyright_agreement_date_year = '';

	if ($author_constant_delivery_planed_date_day < 1) $author_constant_delivery_planed_date_day = '';
	if ($author_constant_delivery_planed_date_month < 1) $author_constant_delivery_planed_date_month = '';
	if ($author_constant_delivery_planed_date_year < 1) $author_constant_delivery_planed_date_year = '';

	if ($author_constant_delivery_accept_date_day < 1) $author_constant_delivery_accept_date_day = '';
	if ($author_constant_delivery_accept_date_month < 1) $author_constant_delivery_accept_date_month = '';
	if ($author_constant_delivery_accept_date_year < 1) $author_constant_delivery_accept_date_year = '';

	if ($author_constant_accepted_date_day < 1) $author_constant_accepted_date_day = '';
	if ($author_constant_accepted_date_month < 1) $author_constant_accepted_date_month = '';
	if ($author_constant_accepted_date_year < 1) $author_constant_accepted_date_year = '';

	//
	//checkbox alanlar� d�n��t�r�l�yor
	//
	if ($author_copyright_agreement == 'on') $author_copyright_agreement = 1; else $author_copyright_agreement = 0;
	if ($author_copyright_agreement_save  == 'on') $author_copyright_agreement_save = 1; else $author_copyright_agreement_save = 0;
	if ($author_constant_accepted  == 'on') $author_constant_accepted = 1; else $author_constant_accepted = 0;

	//
	//varsay�lan atamalar
	//
	if ($book_pubnumber < 1) $book_pubnumber = '';
	if ($book_serias_id < 1) $book_serias_id = '';
	if ($book_isbn < 1) $book_isbn = '';
	if ($book_isbn < 1) $book_isbn = '';

	//
	//d�zenlemeler
	//
	$book_publish_planed_date = mktime(1, 1, 1, $book_publish_planed_date_month, $book_publish_planed_date_day, $book_publish_planed_date_year);
	$author_copyright_agreement_date = mktime(1, 1, 1, $author_copyright_agreement_date_month, $author_copyright_agreement_date_day, $author_copyright_agreement_date_year);
	$author_constant_delivery_planed_date = mktime(1, 1, 1, $author_constant_delivery_planed_date_month, $author_constant_delivery_planed_date_day, $author_constant_delivery_planed_date_year);
	$author_constant_delivery_accept_date = mktime(1, 1, 1, $author_constant_delivery_accept_date_month, $author_constant_delivery_accept_date_day, $author_constant_delivery_accept_date_year);
	$author_constant_accepted_date = mktime(1, 1, 1, $author_constant_accepted_date_month, $author_constant_accepted_date_day, $author_constant_accepted_date_year);
	
	//
	//hata kontrol�
	//
	if ( strlen($book_name) < 2 or !eregi("[[:alpha:]]",$book_name) )
	$islem_bilgisi = '<br>Proje Ad� alan�n� bo� b�r�kmay�n�z';

	if ( strlen($book_author) < 2 or !eregi("[[:alpha:]]",$book_author) )
	$islem_bilgisi .= '<br>Yazar Ad� alan�n� bo� b�rakmay�n�z';
	
	if ( $book_isbn > 1 && strlen($book_isbn) < 13 )
	$islem_bilgisi .= '<br>ISBN numaras� ge�ersiz, l�tfen kontrol ediniz';
	
	if ( $book_isbn > 1 && $book_type == '1')
	{
		$SORGU_sayi = '
			SELECT count(barkod) as bulunanadet
			FROM pco_stok
			WHERE barkod = '.$book_isbn.';
		';
		$SORGU_sonuc = mysql_query($SORGU_sayi);
		$bulunanadet = mysql_result($SORGU_sonuc,0,"bulunanadet");

		if ( $bulunanadet > 0 )
		$islem_bilgisi .= '<br>'.$book_isbn.' ISBN numaras� stoklar�n�zda kay�tl� bir �r�n ile e�le�iyor, l�tfen kontrol ediniz.';
	}

	if ( $book_isbn > 1 && $book_type == '1')
	{
		$SORGU_sayi = '
			SELECT count(book_isbn) as bulunanadet
			FROM pco_book
			WHERE book_isbn = '.$book_isbn.';
		';
		$SORGU_sonuc = mysql_query($SORGU_sayi);
		$bulunanadet = mysql_result($SORGU_sonuc,0,"bulunanadet");

		if ( $bulunanadet > 0 )
		$islem_bilgisi .= '<br>'.$book_isbn.' ISBN numaras� proje sayfan�zda kay�tl� bir �r�n ile e�le�iyor, l�tfen kontrol ediniz.';
	}

	if ($islem_bilgisi == '')
	{
		$SORGU_projeekle = "
			INSERT INTO pco_book (
			book_name,
			book_type,
			book_author,
			book_editor,
			book_translator,
			book_publisher,
			book_pubnumber,
			book_serias,
			book_serias_id,
			book_isbn,
			book_pagecount,
			book_isbn_status,
			book_bandrol_status,
			author_copyright_agreement,
			author_copyright_agreement_save,
			author_copyright_agreement_date,
			author_copyright_agreement_duration,
			author_constant_delivery_planed_type,
			author_constant_delivery_planed_date,
			author_constant_delivery_accept_type,
			author_constant_delivery_accept_date,
			author_constant_accepted,
			author_constant_accepted_date,
			book_publish_planed_date,
			createtar,
			changetar
			)
			VALUES (
			'".$book_name."',
			'".$book_type."',
			'".$book_author."',
			'".$book_editor."',
			'".$book_translator."',
			'".$book_publisher."',
			'".$book_pubnumber."',
			'".$book_serias."',
			'".$book_serias_id."',
			'".$book_isbn."',
			'".$book_pagecount."',
			'".$book_isbn_status."',
			'".$book_bandrol_status."',
			'".$author_copyright_agreement."',
			'".$author_copyright_agreement_save."',
			'".$author_copyright_agreement_date."',
			'".$author_copyright_agreement_duration."',
			'".$author_constant_delivery_planed_type."',
			'".$author_constant_delivery_planed_date."',
			'".$author_constant_delivery_accept_type."',
			'".$author_constant_delivery_accept_date."',
			'".$author_constant_accepted."',
			'".$author_constant_accepted_date."',
			'".$book_publish_planed_date."',
			'".$changetar."',
			'".$changetar."'
			);";
			//addslashes($SORGU_projeekle);
		// echo '<pre>'.$SORGU_projeekle.'</pre>';
		$SORGU_sonuc = mysql_query($SORGU_projeekle);
		$etkilenen = mysql_affected_rows();
		$islem_bilgisi = '<div class="successbox">'.stripslashes($book_name).' proje sisteme eklenmi�tir.</div>';
	}
	else
	{
		$islem_bilgisi = '<div class="errorbox">'.$islem_bilgisi.'<br><br></div>';
	}
	
}
?>
<h1>Proje Ekle</h1>

<?php echo $islem_bilgisi?>

<form name="form1" action="<?php echo $acp_projelerlink?>&projeekle=1" method="POST">
<input type="hidden" name="menu" value="projeler">
<input type="hidden" name="projeekle" value="1">

<table width="100%" border="0">
<tr>
<th width="50%"></th>
<th>
<input class="button1" id="form1" name="form1" value="PROJE EKLE" type="submit">
</th>
</tr>

<tr>
<td valign="top"> 
<table valign="top" width="100%" cellspacing="5" border="0">
<tr class="col1">
<th colspan="6">
TEMEL DE�ERLER
</th>
</tr>

<tr>
<td>Proje Tipi</td>
<td>:</td>
<td colspan="3">

<select style="width: 150px;" name="book_type">
<?php
foreach ($array_book_type as $k => $v)
{
	echo '<option value="'.$k.'"><strong>'.$v.'</strong></option>'. "\r\n";
}
?>
</select>

</td>
</tr>

<tr>
<td width="150">Proje</td>
<td>:</td>
<td colspan="3">
<input type="text" name="book_name" style="width: 290px;" maxlength="70">
</td>
</tr>

<tr>
<td>Yazar</td>
<td>:</td>
<td colspan="3">
<input type="text" name="book_author" style="width: 290px;" maxlength="70">
</td>
</tr>

<tr>
<td>Edit�r</td>
<td>:</td>
<td colspan="3">
<input type="text" name="book_editor" style="width: 290px;" maxlength="70">
</td>
</tr>

<tr>
<td>Terc�man</td>
<td>:</td>
<td colspan="3">
<input type="text" name="book_translator" style="width: 290px;" maxlength="70">
</td>
</tr>

<tr>
<td>Yay�nevi</td>
<td>:</td>
<td>
<select style="width: 150px;" name="book_publisher">
<?php
foreach ($array_yayinevi as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
</td>

<td width="50">S�rt No</td>
<td>
<input type="text" name="book_pubnumber" style="width: 60px;" maxlength="70">
</td>
</tr>

<tr>
<td>Seri</td>
<td>:</td>
<td>
<select style="width: 150px;" name="book_serias">
<?php
foreach ($array_seri_adlari as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
</td>

<td>Seri No</td>
<td>
<input type="text" name="book_serias_id" style="width: 60px;" maxlength="70">
</td>
</tr>

<tr>
<td>Barkod</td>
<td>:</td>
<td>
<input type="text" name="book_isbn" style="width: 145px;" maxlength="70">
</td>
<td>Sayfa</td>
<td>
<input type="text" name="book_pagecount" style="width: 60px;" maxlength="70">
</td>
</tr>

<tr class="col1">
<th colspan="6">
K�LT�R BAKANLI�I
</th>
</tr>

<tr>
<td width="180">ISBN Durumu</td>
<td>:</td>
<td>
<select style="width: 150px;" name="book_isbn_status">
<?php
foreach ($array_culture_status as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
</td>
</tr>
<tr>
<td>Bandrol Durumu</td>
<td>:</td>
<td>
<select style="width: 150px;" name="book_bandrol_status">
<?php
foreach ($array_culture_status as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
</td>
</tr>
<tr>
<td>Yay�n Tarihi</td>
<td>:</td>
<td colspan="3">
<select style="width: 70px;" name="book_publish_planed_date_day">
<option value="">Se�</option>
<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
<?php
foreach ($array_gunler as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
<select style="width: 75px;" name="book_publish_planed_date_month">
<option value="">Se�</option>
<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth] ?></option>
<?php
foreach ($array_aylar as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
<select style="width: 100px;" name="book_publish_planed_date_year">
<option value="">Se�</option>
<option style="background-color:red;" value="<?php echo $this_year ?>"> <?php echo $array_yillar_publish_planed[$this_year]?></option>
<?php
foreach ($array_yillar_publish_planed as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
</td>
</tr>
</table>
</td>
<td valign="top">
<table width="50%" cellspacing="5" border="0">
<tr class="col1">
<th colspan="5">
YAZAR
</th>
</tr>
<tr>
<td width="200">Telif Anla�mas� �mzaland�</td>
<td>:</td>
<td>
<input type="checkbox" name="author_copyright_agreement">
</td>
<td>Ar�ivlendi</td>
<td><input type="checkbox" name="author_copyright_agreement_save"></td>
</tr>
<tr>
<td>Telif Anla�mas� Ge�erlilik S�resi</td>
<td>:</td>
<td colspan="3">
<select style="width: 190px;" name="author_copyright_agreement_duration">
<?php
foreach ($array_copyright_duration as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
</td>
</tr>
<tr>
<td>Telif Anla�mas� �mzalanma Tarihi</td>
<td>:</td>
<td colspan="3">
<select style="width: 50px;" name="author_copyright_agreement_date_day">
<option value="">Se�</option>
<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
<?php
foreach ($array_gunler as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
<select style="width: 72px;" name="author_copyright_agreement_date_month">
<option value="">Se�</option>
<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
<?php
foreach ($array_aylar as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
<select style="width: 60px;" name="author_copyright_agreement_date_year">
<option value="">Se�</option>
<option style="background-color:red;" value="<?php echo $this_year ?>"> <?php echo $array_yillar_publish_planed[$this_year]?></option>
<?php
foreach ($array_yillar_publish_planed as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
</td>
</tr>

<tr class="col1">
<th colspan="5">
TESL�M ALINACAK
</th>
</tr>

<tr>
<td>Metin Teslim Al�nacak Tip</td>
<td>:</td>
<td colspan="3">
<select style="width: 190px;" name="author_constant_delivery_planed_type">
<?php
foreach ($array_delivery_type as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
</td>
</tr>

<tr>
<td>Metin Teslim Al�nacak Tarih</td>
<td>:</td>
<td colspan="3">
<select style="width: 50px;" name="author_constant_delivery_planed_date_day">
<option value="">Se�</option>
<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
<?php
foreach ($array_gunler as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
<select style="width: 72px;" name="author_constant_delivery_planed_date_month">
<option value="">Se�</option>
<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
<?php
foreach ($array_aylar as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
<select style="width: 60px;" name="author_constant_delivery_planed_date_year">
<option value="">Se�</option>
<option style="background-color:red;" value="<?php echo $this_year ?>"> <?php echo $array_yillar_publish_planed[$this_year]?></option>
<?php
foreach ($array_yillar_publish_planed as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
</td>
</tr>

<tr class="col1">
<th colspan="5">
TESL�M ALINAN
</th>
</tr>

<tr>
<td>Metin Teslim Al�nan Tip</td>
<td>:</td>
<td colspan="3">
<select style="width: 190px;" name="author_constant_delivery_accept_type">
<?php
foreach ($array_delivery_type as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
</td>
</tr>

<tr>
<td>Metin Teslim Al�nan Tarih</td>
<td>:</td>
<td colspan="3">
<select style="width: 50px;" name="author_constant_delivery_accept_date_day">
<option value="">Se�</option>
<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
<?php
foreach ($array_gunler as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
<select style="width: 72px;" name="author_constant_delivery_accept_date_month">
<option value="">Se�</option>
<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
<?php
foreach ($array_aylar as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
<select style="width: 60px;" name="author_constant_delivery_accept_date_year">
<option value="">Se�</option>
<option style="background-color:red;" value="<?php echo $this_year ?>"> <?php echo $array_yillar_publish_planed[$this_year]?></option>
<?php
foreach ($array_yillar_publish_planed as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
</td>
</tr>

<tr class="col1">
<th colspan="5">
KABUL ED�LEN
</th>
</tr>
<tr>
<td>Metin Kabul Edildi</td>
<td>:</td>
<td colspan="3">
<input type="checkbox" name="author_constant_accepted">		
</td>
</tr>

<tr>
<td>Metin Kabul Edilme Tarihi</td>
<td>:</td>
<td colspan="3">
<select style="width: 50px;" name="author_constant_accepted_date_day">
<option value="">Se�</option>
<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
<?php
foreach ($array_gunler as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
<select style="width: 72px;" name="author_constant_accepted_date_month">
<option value="">Se�</option>
<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
<?php
foreach ($array_aylar as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
<select style="width: 60px;" name="author_constant_accepted_date_year">
<option value="">Se�</option>
<option style="background-color:red;" value="<?php echo $this_year ?>"> <?php echo $array_yillar_publish_planed[$this_year]?></option>
<?php
foreach ($array_yillar_publish_planed as $k => $v)
{
echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
}
?>
</select>
</td>
</tr>

</table>
</td>
</tr>
</table>
</form>
</div>