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

$book_id = $_REQUEST["un"];
$delete = $_REQUEST["delete"];
if ($book_id > 0 && $delete == 1)
{
	$SORGU_cumle = 'UPDATE pco_book SET book_status = "5" WHERE book_id = "'.$book_id.'";';
	$SORGU_sonuc = mysql_query($SORGU_cumle);
	$islem_bilgisi = '<div class="errorbox">Proje silinmiþtir. Bunun anlamý kayýt imha edilmemiþtir, sadece iptal edildi durumuna getirilmiþtir.</div>';
}

if (isset($_REQUEST["projeform"]))
{
	//varsayýlanlar
	$changetar = time();

	//metin gelmesi gereken alanlar
	$book_name = addslashes(trim(strip_tags($_REQUEST["book_name"])));
	$book_author = addslashes(trim(strip_tags($_REQUEST["book_author"])));
	$book_editor = addslashes(trim(strip_tags($_REQUEST["book_editor"])));
	$book_translator = addslashes(trim(strip_tags($_REQUEST["book_translator"])));
	
	//seçmeli gelen alanlar
	$book_publisher = trim(strip_tags($_REQUEST["book_publisher"]));
	$book_type = trim(strip_tags($_REQUEST["book_type"]));
	$book_serias = trim(strip_tags($_REQUEST["book_serias"]));
	$book_isbn_status = trim(strip_tags($_REQUEST["book_isbn_status"]));	
	$book_bandrol_status = trim(strip_tags($_REQUEST["book_bandrol_status"]));	
	$book_bandrol_status = trim(strip_tags($_REQUEST["book_bandrol_status"]));	
	$author_copyright_agreement_duration = trim(strip_tags($_REQUEST["author_copyright_agreement_duration"]));	
	$author_constant_delivery_planed_type = trim(strip_tags($_REQUEST["author_constant_delivery_planed_type"]));	
	$author_constant_delivery_accept_type = trim(strip_tags($_REQUEST["author_constant_delivery_accept_type"]));	

	//checkbox ile gelen alanlar
	$author_copyright_agreement = trim(strip_tags($_REQUEST["author_copyright_agreement"]));
	$author_copyright_agreement_save = trim(strip_tags($_REQUEST["author_copyright_agreement_save"]));
	$author_constant_accepted = trim(strip_tags($_REQUEST["author_constant_accepted"]));	

	//sayýsal gelmesi gereken alanlar
	//planlanan yayýn tarihi
	$book_publish_planed_date_day = trim(strip_tags($_REQUEST["book_publish_planed_date_day"]));
	$book_publish_planed_date_month = trim(strip_tags($_REQUEST["book_publish_planed_date_month"]));
	$book_publish_planed_date_year = trim(strip_tags($_REQUEST["book_publish_planed_date_year"]));

	//telif anlaþmasý imzalanma tarih
	$author_copyright_agreement_date_day = trim(strip_tags($_REQUEST["author_copyright_agreement_date_day"]));
	$author_copyright_agreement_date_month = trim(strip_tags($_REQUEST["author_copyright_agreement_date_month"]));
	$author_copyright_agreement_date_year = trim(strip_tags($_REQUEST["author_copyright_agreement_date_year"]));

	//metin teslim alýnacak tarih
	$author_constant_delivery_planed_date_day = trim(strip_tags($_REQUEST["author_constant_delivery_planed_date_day"]));
	$author_constant_delivery_planed_date_month = trim(strip_tags($_REQUEST["author_constant_delivery_planed_date_month"]));
	$author_constant_delivery_planed_date_year = trim(strip_tags($_REQUEST["author_constant_delivery_planed_date_year"]));

	//metin teslim alýnan tarih
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
	$book_isbn = trim(strip_tags($_REQUEST["book_isbn"])); 

	//ön kontroller
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

	//checkbox alanlarý dönüþtürülüyor
	if ($author_copyright_agreement == 'on') $author_copyright_agreement = 1;
	if ($author_copyright_agreement_save  == 'on') $author_copyright_agreement_save = 1;
	if ($author_constant_accepted  == 'on') $author_constant_accepted = 1;

	//varsayýlan atamalar
	if ($book_pubnumber < 1) $book_pubnumber = '';
	if ($book_serias_id < 1) $book_serias_id = '';
	if ($book_isbn < 1) $book_isbn = '';

	//düzenlemeler
	$book_publish_planed_date = mktime(1, 1, 1, $book_publish_planed_date_month, $book_publish_planed_date_day, $book_publish_planed_date_year);
	$author_copyright_agreement_date = mktime(1, 1, 1, $author_copyright_agreement_date_month, $author_copyright_agreement_date_day, $author_copyright_agreement_date_year);
	$author_constant_delivery_planed_date = mktime(1, 1, 1, $author_constant_delivery_planed_date_month, $author_constant_delivery_planed_date_day, $author_constant_delivery_planed_date_year);
	$author_constant_delivery_accept_date = mktime(1, 1, 1, $author_constant_delivery_accept_date_month, $author_constant_delivery_accept_date_day, $author_constant_delivery_accept_date_year);
	$author_constant_accepted_date = mktime(1, 1, 1, $author_constant_accepted_date_month, $author_constant_accepted_date_day, $author_constant_accepted_date_year);
	
	//hata kontrolü
	if ( strlen($book_name) < 2 or !eregi("[[:alpha:]]",$book_name) )
	$islem_bilgisi = '<br>Proje Adý alanýný boþ býrýkmayýnýz';

	if ( strlen($book_author) < 2 or !eregi("[[:alpha:]]",$book_author) )
	$islem_bilgisi .= '<br>Yazar Adý alanýný boþ býrakmayýnýz';
	
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
		$islem_bilgisi .= '<br>'.$book_isbn.' ISBN numarasý stoklarýnýzda kayýtlý bir ürün ile eþleþiyor, lütfen kontrol ediniz.';
	}

	if ( $book_isbn > 1 && $book_type == '1')
	{
		$SORGU_sayi = '
			SELECT count(book_isbn) as bulunanadet
			FROM pco_book
			WHERE book_isbn = '.$book_isbn.'
			AND book_id <> '.$book_id.';
		';
		$SORGU_sonuc = mysql_query($SORGU_sayi);
		$bulunanadet = mysql_result($SORGU_sonuc,0,"bulunanadet");

		if ( $bulunanadet > 0 )
		$islem_bilgisi .= '<br>'.$book_isbn.' ISBN numarasý proje sayfanýzda kayýtlý bir ürün ile eþleþiyor, lütfen kontrol ediniz.';
	}	
	
	if ($islem_bilgisi == '')
	{
		$SORGU_urun = "
			UPDATE pco_book 
			SET 
				book_name = '".$book_name."',
				book_type = '".$book_type."',
				book_author = '".$book_author."',
				book_editor = '".$book_editor."',
				book_translator = '".$book_translator."',
				book_publisher = '".$book_publisher."',
				book_pubnumber = '".$book_pubnumber."',
				book_serias = '".$book_serias."',
				book_serias_id = '".$book_serias_id."',
				book_isbn = '".$book_isbn."',
				book_pagecount = '".$book_pagecount."',
				book_isbn_status = '".$book_isbn_status."',
				book_bandrol_status = '".$book_bandrol_status."',
				author_copyright_agreement = '".$author_copyright_agreement."',
				author_copyright_agreement_save = '".$author_copyright_agreement_save."',
				author_copyright_agreement_date = '".$author_copyright_agreement_date."',
				author_copyright_agreement_duration = '".$author_copyright_agreement_duration."',
				author_constant_delivery_planed_type = '".$author_constant_delivery_planed_type."',
				author_constant_delivery_planed_date = '".$author_constant_delivery_planed_date."',
				author_constant_delivery_accept_type = '".$author_constant_delivery_accept_type."',
				author_constant_delivery_accept_date = '".$author_constant_delivery_accept_date."',
				author_constant_accepted = '".$author_constant_accepted."',
				author_constant_accepted_date = '".$author_constant_accepted_date."',
				book_publish_planed_date = '".$book_publish_planed_date."',
				changetar = '".$changetar."'
			WHERE book_id = '".$book_id."'
			;";
			//addslashes($SORGU_urun);
			//echo $SORGU_urun;
		$SORGU_sonuc = mysql_query($SORGU_urun);
		$etkilenen = mysql_affected_rows();
		$islem_bilgisi = '<div class="successbox">Proje Bilgileri Güncellenmiþtir.</div>';
	}
	else
	{
		$islem_bilgisi = '<div class="errorbox">'.$islem_bilgisi.'<br><br></div>';
	}		
}

$SORGU_cumle = '
	SELECT 
		book_id,
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
		book_publish_planed_date
	FROM pco_book 
	WHERE book_id = "'.$book_id.'";';
$SORGU_sonuc = mysql_query($SORGU_cumle);
$bulunanadet = mysql_num_rows($SORGU_sonuc);

$book_id = mysql_result($SORGU_sonuc,0,"book_id");
$book_name = mysql_result($SORGU_sonuc,0,"book_name");
$book_type = mysql_result($SORGU_sonuc,0,"book_type");
$book_author = mysql_result($SORGU_sonuc,0,"book_author");
$book_editor = mysql_result($SORGU_sonuc,0,"book_editor");
$book_translator = mysql_result($SORGU_sonuc,0,"book_translator");
$book_publisher = mysql_result($SORGU_sonuc,0,"book_publisher");
$book_pubnumber = mysql_result($SORGU_sonuc,0,"book_pubnumber");
$book_serias = mysql_result($SORGU_sonuc,0,"book_serias");
$book_serias_id = mysql_result($SORGU_sonuc,0,"book_serias_id");
$book_isbn = mysql_result($SORGU_sonuc,0,"book_isbn");
$book_pagecount = mysql_result($SORGU_sonuc,0,"book_pagecount");
$book_isbn_status = mysql_result($SORGU_sonuc,0,"book_isbn_status");
$book_bandrol_status = mysql_result($SORGU_sonuc,0,"book_bandrol_status");
$author_copyright_agreement = mysql_result($SORGU_sonuc,0,"author_copyright_agreement");
$author_copyright_agreement_save = mysql_result($SORGU_sonuc,0,"author_copyright_agreement_save");
$author_copyright_agreement_date = mysql_result($SORGU_sonuc,0,"author_copyright_agreement_date");
$author_copyright_agreement_duration = mysql_result($SORGU_sonuc,0,"author_copyright_agreement_duration");
$author_constant_delivery_planed_type = mysql_result($SORGU_sonuc,0,"author_constant_delivery_planed_type");
$author_constant_delivery_planed_date = mysql_result($SORGU_sonuc,0,"author_constant_delivery_planed_date");
$author_constant_delivery_accept_type = mysql_result($SORGU_sonuc,0,"author_constant_delivery_accept_type");
$author_constant_delivery_accept_date = mysql_result($SORGU_sonuc,0,"author_constant_delivery_accept_date");
$author_constant_accepted = mysql_result($SORGU_sonuc,0,"author_constant_accepted");
$author_constant_accepted_date = mysql_result($SORGU_sonuc,0,"author_constant_accepted_date");
$book_publish_planed_date = mysql_result($SORGU_sonuc,0,"book_publish_planed_date");

//metin geldiði için temizlenmesi gereken alanlar
$book_name = stripslashes($book_name);
$book_author = stripslashes($book_author);
$book_editor = stripslashes($book_editor);
$book_translator = stripslashes($book_translator);

//checkbox ile gelen alanlar
if ($author_copyright_agreement == 1) $author_copyright_agreement = 'checked="checked"';
if ($author_copyright_agreement_save == 1) $author_copyright_agreement_save = 'checked="checked"';
if ($author_constant_accepted == 1)  $author_constant_accepted = 'checked="checked"';	

//Zaman Deðerleri Oluþturuluyor
//planlanan yayýn tarihi
$book_publish_planed_date_day = date('j', $book_publish_planed_date);
$book_publish_planed_date_month = date('n', $book_publish_planed_date);
$book_publish_planed_date_year = date('Y', $book_publish_planed_date);

//telif anlaþmasý imzalanma tarih
$author_copyright_agreement_date_day = date('j', $author_copyright_agreement_date); 
$author_copyright_agreement_date_month = date('n', $author_copyright_agreement_date); 
$author_copyright_agreement_date_year = date('Y', $author_copyright_agreement_date);

//metin teslim alýnacak tarih
$author_constant_delivery_planed_date_day = date('j', $author_constant_delivery_planed_date); 
$author_constant_delivery_planed_date_month = date('n', $author_constant_delivery_planed_date); 
$author_constant_delivery_planed_date_year = date('Y', $author_constant_delivery_planed_date);

//metin teslim alýnan tarih
$author_constant_delivery_accept_date_day = date('j', $author_constant_delivery_accept_date); 
$author_constant_delivery_accept_date_month = date('n', $author_constant_delivery_accept_date); 
$author_constant_delivery_accept_date_year = date('Y', $author_constant_delivery_accept_date);

//metin kabul edilen tarih
$author_constant_accepted_date_day = date('j', $author_constant_accepted_date); 
$author_constant_accepted_date_month = date('n', $author_constant_accepted_date); 
$author_constant_accepted_date_year = date('Y', $author_constant_accepted_date);

//ön kontroller
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

$this_day = date('j', $this_time); 
$this_mounth = date('n', $this_time); 
$this_year = date('Y', $this_time);	

?>

<h1>Proje Düzenle &raquo; <?php echo $book_name?></h1>

<br>
<div>
<a class="button1" href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>">Baþlangýç</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=disisler">Dýþ Ýþler</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=mizanpaj">Mizanpaj Kontrol</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=kapak">Kapak Kontrol</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=baski">Baský Ýþlemleri</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=yedek">Yedeklemeler</a>
</div>
<br>

<script>
function confirmDelete(delUrl)
{
if (confirm("<?php echo $book_name?> isimli projeyi iptal edilmiþ olarak iþaretlemek istediðinizden emin misiniz?"))
{
document.location = delUrl;
}
}
</script>

<?php echo $islem_bilgisi?>

<form name="projeform" action="<?php echo $acp_projelerlink?>&un=<?php echo $book_id?>" method="POST">
<input type="hidden" name="menu" value="projeler">
<input type="hidden" name="islem" value="guncelle">
<input type="hidden" name="book_id" value="<?php echo $book_id?>">

<table width="100%" border="0">
	<tr>
		<th width="50%">
			<a class="button1" href="javascript:confirmDelete('<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;delete=1')">PROJEYÝ SÝL</a>
		</th>
		<th>
			<input class="button1" type="submit" name="projeform" onclick="this.className = 'button1 disabled';" name="submit" value="DEÐÝÞÝKLÝKLERÝ KAYDET">
		</th>
	</tr>

	<tr>
		<td valign="top"> 
			<table valign="top" width="100%" cellspacing="5" border="0">
				<tr class="col1">
					<th colspan="6">
						TEMEL DEÐERLER
					</th>
				</tr>
				<tr>
					<td>Proje Tipi</td>
					<td>:</td>
					<td colspan="3">
					<select style="width: 150px;" name="book_type">
					<option value="<?php echo $book_type?>"><?php echo $array_book_type[$book_type]?></option>
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
						<input type="text" name="book_name"  value="<?php echo $book_name?>" style="width: 290px;" maxlength="70">
					</td>
				</tr>

				<tr>
					<td>Yazar</td>
					<td>:</td>
					<td colspan="3">
					<input type="text" name="book_author" value="<?php echo $book_author?>" style="width: 290px;" maxlength="70">
					</td>
				</tr>

				<tr>
					<td>Editör</td>
					<td>:</td>
					<td colspan="3">
					<input type="text" name="book_editor" value="<?php echo $book_editor?>" style="width: 290px;" maxlength="70">
					</td>
				</tr>

				<tr>
					<td>Tercüman</td>
					<td>:</td>
					<td colspan="3">
					<input type="text" name="book_translator" value="<?php echo $book_translator?>" style="width: 290px;" maxlength="70">
					</td>
				</tr>

				<tr>
					<td>Yayýnevi</td>
					<td>:</td>
					<td>
						<select style="width: 150px;" name="book_publisher">
						<option value="<?php echo $book_publisher?>"><?php echo $array_yayinevi[$book_publisher]?></option>
						<?php
						foreach ($array_yayinevi as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
					</td>

					<td width="50">Sýrt No</td>
					<td>
						<input type="text" name="book_pubnumber" value="<?php echo $book_pubnumber?>" style="width: 60px;" maxlength="70">
					</td>
				</tr>

				<tr>
					<td>Seri</td>
					<td>:</td>
					<td>
						<select style="width: 150px;" name="book_serias">
						<option value="<?php echo $book_serias?>"><?php echo $array_seri_adlari[$book_serias]?></option>
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
						<input type="text" name="book_serias_id" value="<?php echo $book_serias_id?>" style="width: 60px;" maxlength="70">
					</td>
				</tr>

				<tr>
					<td>Barkod</td>
					<td>:</td>
					<td>
						<input type="text" name="book_isbn" value="<?php echo $book_isbn?>" style="width: 145px;" maxlength="70">
					</td>
					<td>Sayfa</td>
					<td>
						<input type="text" name="book_pagecount" value="<?php echo $book_pagecount?>" style="width: 60px;" maxlength="70">
					</td>
				</tr>

				<tr class="col1">
					<th colspan="6">
						KÜLTÜR BAKANLIÐI
					</th>
				</tr>

				<tr>
					<td width="180">Ýsbn Durumu</td>
					<td>:</td>
					<td>
						<select style="width: 150px;" name="book_isbn_status">
						<option value="<?php $book_isbn_status?>"><?php echo $array_culture_status[$book_isbn_status]?></option>
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
						<option value="<?php echo $book_bandrol_status?>"><?php echo $array_culture_status[$book_bandrol_status]?></option>
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
					<td>Yayýn Tarihi</td>
					<td>:</td>
					<td colspan="3">
						<select style="width: 70px;" name="book_publish_planed_date_day">
						<option value="<?php echo $book_publish_planed_date_day ?>"> <?php echo $array_gunler[$book_publish_planed_date_day]?></option>
						<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
						<?php
						foreach ($array_gunler as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 75px;" name="book_publish_planed_date_month">
						<option value="<?php echo $book_publish_planed_date_month ?>"> <?php echo $array_aylar[$book_publish_planed_date_month] ?></option>
						<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth] ?></option>
						<?php
						foreach ($array_aylar as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 100px;" name="book_publish_planed_date_year">
						<option value="<?php echo $book_publish_planed_date_year ?>"> <?php echo $array_yillar_publish_planed[$book_publish_planed_date_year]?></option>
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
					<td width="200">Telif Anlaþmasý Ýmzalandý</td>
					<td>:</td>
					<td>
						<input type="checkbox" name="author_copyright_agreement" <?php echo $author_copyright_agreement?>>
					</td>
					<td>Arþivlendi</td>
					<td><input type="checkbox" name="author_copyright_agreement_save" <?php echo $author_copyright_agreement_save?>></td>
				</tr>
				<tr>
					<td>Telif Anlaþmasý Geçerlilik Süresi</td>
					<td>:</td>
					<td colspan="3">
						<select style="width: 190px;" name="author_copyright_agreement_duration">
						<option value="<?php echo $author_copyright_agreement_duration ?>"> <?php echo $array_copyright_duration[$author_copyright_agreement_duration]?></option>						
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
					<td>Telif Anlaþmasý Ýmzalanma Tarihi</td>
					<td>:</td>
					<td colspan="3">
						<select style="width: 50px;" name="author_copyright_agreement_date_day">
						<option value="<?php echo $author_copyright_agreement_date_day ?>"> <?php echo $array_gunler[$author_copyright_agreement_date_day]?></option>
						<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
						<?php
						foreach ($array_gunler as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 72px;" name="author_copyright_agreement_date_month">
						<option value="<?php echo $author_copyright_agreement_date_month ?>"> <?php echo $array_aylar[$author_copyright_agreement_date_month]?></option>
						<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
						<?php
						foreach ($array_aylar as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 60px;" name="author_copyright_agreement_date_year">
						<option value="<?php echo $author_copyright_agreement_date_year ?>"> <?php echo $array_yillar_publish_planed[$author_copyright_agreement_date_year]?></option>
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
						TESLÝM ALINACAK
					</th>
				</tr>
				
				<tr>
					<td>Metin Teslim Alýnacak Tip</td>
					<td>:</td>
					<td colspan="3">
						<select style="width: 190px;" name="author_constant_delivery_planed_type">
						<option value="<?php echo $author_constant_delivery_planed_type ?>"> <?php echo $array_delivery_type[$author_constant_delivery_planed_type]?></option>
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
					<td>Metin Teslim Alýnacak Tarih</td>
					<td>:</td>
					<td colspan="3">
						<select style="width: 50px;" name="author_constant_delivery_planed_date_day">
						<option value="<?php echo $author_constant_delivery_planed_date_day ?>"> <?php echo $array_gunler[$author_constant_delivery_planed_date_day]?></option>
						<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
						<?php
						foreach ($array_gunler as $k => $v)
						{
							echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 72px;" name="author_constant_delivery_planed_date_month">
						<option value="<?php echo $author_constant_delivery_planed_date_month ?>"> <?php echo $array_aylar[$author_constant_delivery_planed_date_month]?></option>
						<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
						<?php
						foreach ($array_aylar as $k => $v)
						{
							echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 60px;" name="author_constant_delivery_planed_date_year">
						<option value="<?php echo $author_constant_delivery_planed_date_year ?>"> <?php echo $array_yillar_publish_planed[$author_constant_delivery_planed_date_year]?></option>
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
						TESLÝM ALINAN
					</th>
				</tr>
				
				<tr>
					<td>Metin Teslim Alýnan Tip</td>
					<td>:</td>
					<td colspan="3">
						<select style="width: 190px;" name="author_constant_delivery_accept_type">
						<option value="<?php echo $author_constant_delivery_accept_type ?>"> <?php echo $array_delivery_type[$author_constant_delivery_accept_type]?></option>
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
					<td>Metin Teslim Alýnan Tarih</td>
					<td>:</td>
					<td colspan="3">
						<select style="width: 50px;" name="author_constant_delivery_accept_date_day">
						<option value="<?php echo $author_constant_delivery_accept_date_day ?>"> <?php echo $array_gunler[$author_constant_delivery_accept_date_day]?></option>
						<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
						<?php
						foreach ($array_gunler as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 72px;" name="author_constant_delivery_accept_date_month">
						<option value="<?php echo $author_constant_delivery_accept_date_month ?>"> <?php echo $array_aylar[$author_constant_delivery_accept_date_month]?></option>
						<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
						<?php
						foreach ($array_aylar as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 60px;" name="author_constant_delivery_accept_date_year">
						<option value="<?php echo $author_constant_delivery_accept_date_year ?>"> <?php echo $array_yillar_publish_planed[$author_constant_delivery_accept_date_year]?></option>
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
						KABUL EDÝLEN
					</th>
				</tr>
				<tr>
					<td>Metin Kabul Edildi</td>
					<td>:</td>
					<td colspan="3">
						<input type="checkbox" name="author_constant_accepted" <?php echo $author_constant_accepted?>>					
					</td>
				</tr>
				
				<tr>
					<td>Metin Kabul Edilme Tarihi</td>
					<td>:</td>
					<td colspan="3">
						<select style="width: 50px;" name="author_constant_accepted_date_day">
						<option value="<?php echo $author_constant_accepted_date_day ?>"> <?php echo $array_gunler[$author_constant_accepted_date_day]?></option>
						<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
						<?php
						foreach ($array_gunler as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 72px;" name="author_constant_accepted_date_month">
						<option value="<?php echo $author_constant_accepted_date_month ?>"> <?php echo $array_aylar[$author_constant_accepted_date_month]?></option>
						<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
						<?php
						foreach ($array_aylar as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 60px;" name="author_constant_accepted_date_year">
						<option value="<?php echo $author_constant_accepted_date_year ?>"> <?php echo $array_yillar_publish_planed[$author_constant_accepted_date_year]?></option>
						<option value="<?php echo $this_year ?>"> <?php echo $array_yillar_publish_planed[$this_year]?></option>
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