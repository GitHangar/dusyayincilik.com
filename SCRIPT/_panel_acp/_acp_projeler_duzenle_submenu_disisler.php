<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"] == 1) exit ();

$this_time= time();
$this_day= date('j', $this_time); 
$this_mounth= date('n', $this_time); 
$this_year= date('Y', $this_time);	

// echo "<pre>";
// print_r($_REQUEST);
// echo "</pre>";

$book_id = $_REQUEST["un"];

if (isset($_REQUEST["projeform"]))
{
	//varsayýlanlar
	$changetar = time();

	//dýþ iþleri yapacak kiþiler
	$pre_layout_designer_id= trim(strip_tags($_REQUEST["pre_layout_designer_id"]));
	$pre_cover_redactor_id = trim(strip_tags($_REQUEST["pre_cover_redactor_id"]));
	$pre_correction_redactor_id = trim(strip_tags($_REQUEST["pre_correction_redactor_id"]));	
	//iþlerin durumlarý
	$pre_layout_status = trim(strip_tags($_REQUEST["pre_layout_status"]));	
	$pre_cover_status = trim(strip_tags($_REQUEST["pre_cover_status"]));	
	$pre_correction_status = trim(strip_tags($_REQUEST["pre_correction_status"]));	

	//
	//sayýsal gelmesi gereken alanlar
	//

	//MÝZANPAJ
	//proje teslim edilen tarih
	$pre_layout_delivery_date_day = trim(strip_tags($_REQUEST["pre_layout_delivery_date_day"]));
	$pre_layout_delivery_date_month = trim(strip_tags($_REQUEST["pre_layout_delivery_date_month"]));
	$pre_layout_delivery_date_year = trim(strip_tags($_REQUEST["pre_layout_delivery_date_year"]));

	//proje teslim alýnacak tarih
	$pre_layout_acceptance_date_day = trim(strip_tags($_REQUEST["pre_layout_acceptance_date_day"]));
	$pre_layout_acceptance_date_month= trim(strip_tags($_REQUEST["pre_layout_acceptance_date_month"]));
	$pre_layout_acceptance_date_year = trim(strip_tags($_REQUEST["pre_layout_acceptance_date_year"]));

	//proje teslim alýnan tarih
	$pre_layout_accepted_date_day = trim(strip_tags($_REQUEST["pre_layout_accepted_date_day"]));
	$pre_layout_accepted_date_month = trim(strip_tags($_REQUEST["pre_layout_accepted_date_month"]));
	$pre_layout_accepted_date_year = trim(strip_tags($_REQUEST["pre_layout_accepted_date_year"]));
	
	//KAPAK
	//proje teslim edilen tarih
	$pre_cover_delivery_date_day = trim(strip_tags($_REQUEST["pre_cover_delivery_date_day"]));
	$pre_cover_delivery_date_month = trim(strip_tags($_REQUEST["pre_cover_delivery_date_month"]));
	$pre_cover_delivery_date_year = trim(strip_tags($_REQUEST["pre_cover_delivery_date_year"]));

	//proje teslim alýnacak tarih
	$pre_cover_acceptance_date_day = trim(strip_tags($_REQUEST["pre_cover_acceptance_date_day"]));
	$pre_cover_acceptance_date_month = trim(strip_tags($_REQUEST["pre_cover_acceptance_date_month"]));
	$pre_cover_acceptance_date_year = trim(strip_tags($_REQUEST["pre_cover_acceptance_date_year"]));

	//proje teslim alýnan tarih
	$pre_cover_accepted_date_day = trim(strip_tags($_REQUEST["pre_cover_accepted_date_day"]));
	$pre_cover_accepted_date_month = trim(strip_tags($_REQUEST["pre_cover_accepted_date_month"]));
	$pre_cover_accepted_date_year = trim(strip_tags($_REQUEST["pre_cover_accepted_date_year"]));
	
	//TASHÝH
	//proje teslim edilen tarih
	$pre_correction_delivery_date_day = trim(strip_tags($_REQUEST["pre_correction_delivery_date_day"]));
	$pre_correction_delivery_date_month = trim(strip_tags($_REQUEST["pre_correction_delivery_date_month"]));
	$pre_correction_delivery_date_year = trim(strip_tags($_REQUEST["pre_correction_delivery_date_year"]));

	//proje teslim alýnacak tarih
	$pre_correction_acceptance_date_day = trim(strip_tags($_REQUEST["pre_correction_acceptance_date_day"]));
	$pre_correction_acceptance_date_month = trim(strip_tags($_REQUEST["pre_correction_acceptance_date_month"]));
	$pre_correction_acceptance_date_year = trim(strip_tags($_REQUEST["pre_correction_acceptance_date_year"]));

	//proje teslim alýnan tarih
	$pre_correction_accepted_date_day = trim(strip_tags($_REQUEST["pre_correction_accepted_date_day"]));
	$pre_correction_accepted_date_month = trim(strip_tags($_REQUEST["pre_correction_accepted_date_month"]));
	$pre_correction_accepted_date_year = trim(strip_tags($_REQUEST["pre_correction_accepted_date_year"]));
	
	//
	//ön kontroller
	//

	//mizanpaj tarih sýfýrlamalarý
	if ($pre_layout_delivery_date_day < 1) $pre_layout_delivery_date_day = ''; if ($pre_layout_delivery_date_month < 1) $pre_layout_delivery_date_month = ''; if ($pre_layout_delivery_date_year < 1) $pre_layout_delivery_date_year = '';
	if ($pre_layout_acceptance_date_day < 1) $pre_layout_acceptance_date_day = ''; if ($pre_layout_acceptance_date_month < 1) $pre_layout_acceptance_date_month = ''; if ($pre_layout_acceptance_date_year < 1) $pre_layout_acceptance_date_year = '';
	if ($pre_layout_accepted_date_day < 1) $pre_layout_accepted_date_day = ''; if ($pre_layout_accepted_date_month < 1) $pre_layout_accepted_date_month = ''; if ($pre_layout_accepted_date_year < 1) $pre_layout_accepted_date_year = '';

	//kapak tarih sýfýrlamalarý
	if ($pre_cover_delivery_date_day < 1) $pre_cover_delivery_date_day = ''; if ($pre_cover_delivery_date_month < 1) $pre_cover_delivery_date_month = ''; if ($pre_cover_delivery_date_year < 1) $pre_cover_delivery_date_year = '';
	if ($pre_cover_acceptance_date_day < 1) $pre_cover_acceptance_date_day = ''; if ($pre_cover_acceptance_date_month < 1) $pre_cover_acceptance_date_month = ''; if ($pre_cover_acceptance_date_year < 1) $pre_cover_acceptance_date_year = '';
	if ($pre_cover_accepted_date_day < 1) $pre_cover_accepted_date_day = ''; if ($pre_cover_accepted_date_month < 1) $pre_cover_accepted_date_month = ''; if ($pre_cover_accepted_date_year < 1) $pre_cover_accepted_date_year = '';

	//tashih tarih sýfýrlamalarý
	if ($pre_correction_delivery_date_day < 1) $pre_correction_delivery_date_day = ''; if ($pre_correction_delivery_date_month < 1) $pre_correction_delivery_date_month = ''; if ($pre_correction_delivery_date_year < 1) $pre_correction_delivery_date_year = '';
	if ($pre_correction_acceptance_date_day < 1) $pre_correction_acceptance_date_day = ''; if ($pre_correction_acceptance_date_month < 1) $pre_correction_acceptance_date_month = ''; if ($pre_correction_acceptance_date_year < 1) $pre_correction_acceptance_date_year = '';
	if ($pre_correction_accepted_date_day < 1) $pre_correction_accepted_date_day = ''; if ($pre_correction_accepted_date_month < 1) $pre_correction_accepted_date_month = ''; if ($pre_correction_accepted_date_year < 1) $pre_correction_accepted_date_year = '';

	//
	//düzenlemeler, tarih þekline dönüþtürmeler
	//
	$pre_layout_delivery_date = mktime(1, 1, 1, $pre_layout_delivery_date_month, $pre_layout_delivery_date_day, $pre_layout_delivery_date_year);
	$pre_layout_acceptance_date = mktime(1, 1, 1, $pre_layout_acceptance_date_month, $pre_layout_acceptance_date_day, $pre_layout_acceptance_date_year);
	$pre_layout_accepted_date = mktime(1, 1, 1, $pre_layout_accepted_date_month, $pre_layout_accepted_date_day, $pre_layout_accepted_date_year);
	
	$pre_cover_delivery_date = mktime(1, 1, 1, $pre_cover_delivery_date_month, $pre_cover_delivery_date_day, $pre_cover_delivery_date_year);
	$pre_cover_acceptance_date = mktime(1, 1, 1, $pre_cover_acceptance_date_month, $pre_cover_acceptance_date_day, $pre_cover_acceptance_date_year);
	$pre_cover_accepted_date = mktime(1, 1, 1, $pre_cover_accepted_date_month, $pre_cover_accepted_date_day, $pre_cover_accepted_date_year);

	$pre_correction_delivery_date = mktime(1, 1, 1, $pre_correction_delivery_date_month, $pre_correction_delivery_date_day, $pre_correction_delivery_date_year);
	$pre_correction_acceptance_date = mktime(1, 1, 1, $pre_correction_acceptance_date_month, $pre_correction_acceptance_date_day, $pre_correction_acceptance_date_year);
	$pre_correction_accepted_date = mktime(1, 1, 1, $pre_correction_accepted_date_month, $pre_correction_accepted_date_day, $pre_correction_accepted_date_year);

	//
	//hata kontrolü
	//
	/*
	if ( strlen($book_name) < 2 or !eregi("[[:alpha:]]",$book_name) )
	$islem_bilgisi = '<br>Proje Adý alanýný boþ býrýkmayýnýz';

	if ( strlen($book_author) < 2 or !eregi("[[:alpha:]]",$book_author) )
	$islem_bilgisi .= '<br>Yazar Adý alanýný boþ býrakmayýnýz';
	*/
	
	if ($islem_bilgisi == '')
	{
		$SORGU_guncelle = "
			UPDATE pco_book 
			SET 
				pre_layout_designer_id = '".$pre_layout_designer_id."',
				pre_layout_status = '".$pre_layout_status."',
				pre_layout_delivery_date = '".$pre_layout_delivery_date."',
				pre_layout_acceptance_date = '".$pre_layout_acceptance_date."',
				pre_layout_accepted_date = '".$pre_layout_accepted_date."',
				pre_cover_redactor_id = '".$pre_cover_redactor_id."',
				pre_cover_status = '".$pre_cover_status."',
				pre_cover_delivery_date = '".$pre_cover_delivery_date."',
				pre_cover_acceptance_date = '".$pre_cover_acceptance_date."',
				pre_cover_accepted_date = '".$pre_cover_accepted_date."',
				pre_correction_redactor_id = '".$pre_correction_redactor_id."',
				pre_correction_status = '".$pre_correction_status."',
				pre_correction_delivery_date = '".$pre_correction_delivery_date."',
				pre_correction_acceptance_date = '".$pre_correction_acceptance_date."',
				pre_correction_accepted_date = '".$pre_correction_accepted_date."',
				changetar = '".$changetar."'
			WHERE book_id = '".$book_id."'
			;";
			//echo $SORGU_guncelle;
		$SORGU_sonuc = mysql_query($SORGU_guncelle);
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
		pre_layout_designer_id,
		pre_layout_status,
		pre_layout_delivery_date,
		pre_layout_acceptance_date,
		pre_layout_accepted_date,
		pre_correction_redactor_id,
		pre_correction_status,
		pre_correction_delivery_date,
		pre_correction_acceptance_date,
		pre_correction_accepted_date,
		pre_cover_redactor_id,
		pre_cover_status,
		pre_cover_delivery_date,
		pre_cover_acceptance_date,
		pre_cover_accepted_date
	FROM pco_book 
	WHERE book_id = "'.$book_id.'";';
//echo $SORGU_cumle;
$SORGU_sonuc = mysql_query($SORGU_cumle);
$bulunanadet = mysql_num_rows($SORGU_sonuc);

$book_id = mysql_result($SORGU_sonuc,0,"book_id");
$book_name = mysql_result($SORGU_sonuc,0,"book_name");
$pre_layout_designer_id = mysql_result($SORGU_sonuc,0,"pre_layout_designer_id");
$pre_correction_redactor_id = mysql_result($SORGU_sonuc,0,"pre_correction_redactor_id");
$pre_cover_redactor_id = mysql_result($SORGU_sonuc,0,"pre_cover_redactor_id");

$pre_layout_status = mysql_result($SORGU_sonuc,0,"pre_layout_status");
$pre_correction_status = mysql_result($SORGU_sonuc,0,"pre_correction_status");
$pre_cover_status = mysql_result($SORGU_sonuc,0,"pre_cover_status");

$pre_layout_delivery_date = mysql_result($SORGU_sonuc,0,"pre_layout_delivery_date");
$pre_layout_acceptance_date = mysql_result($SORGU_sonuc,0,"pre_layout_acceptance_date");
$pre_layout_accepted_date = mysql_result($SORGU_sonuc,0,"pre_layout_accepted_date");

$pre_cover_delivery_date = mysql_result($SORGU_sonuc,0,"pre_cover_delivery_date");
$pre_cover_acceptance_date = mysql_result($SORGU_sonuc,0,"pre_cover_acceptance_date");
$pre_cover_accepted_date = mysql_result($SORGU_sonuc,0,"pre_cover_accepted_date");

$pre_correction_delivery_date = mysql_result($SORGU_sonuc,0,"pre_correction_delivery_date");
$pre_correction_acceptance_date = mysql_result($SORGU_sonuc,0,"pre_correction_acceptance_date");
$pre_correction_accepted_date = mysql_result($SORGU_sonuc,0,"pre_correction_accepted_date");


//
//Zaman Deðerleri Oluþturuluyor
//

//mizanpaj tarihleri
$pre_layout_delivery_date_day = date('j', $pre_layout_delivery_date); $pre_layout_delivery_date_month = date('n', $pre_layout_delivery_date); $pre_layout_delivery_date_year = date('Y', $pre_layout_delivery_date);
$pre_layout_acceptance_date_day = date('j', $pre_layout_acceptance_date); $pre_layout_acceptance_date_month = date('n', $pre_layout_acceptance_date); $pre_layout_acceptance_date_year = date('Y', $pre_layout_acceptance_date);
$pre_layout_accepted_date_day = date('j', $pre_layout_accepted_date); $pre_layout_accepted_date_month = date('n', $pre_layout_accepted_date); $pre_layout_accepted_date_year = date('Y', $pre_layout_accepted_date);

//kapak iþlemleri
$pre_cover_delivery_date_day = date('j', $pre_cover_delivery_date); $pre_cover_delivery_date_month = date('n', $pre_cover_delivery_date); $pre_cover_delivery_date_year = date('Y', $pre_cover_delivery_date);
$pre_cover_acceptance_date_day = date('j', $pre_cover_acceptance_date); $pre_cover_acceptance_date_month = date('n', $pre_cover_acceptance_date); $pre_cover_acceptance_date_year = date('Y', $pre_cover_acceptance_date);
$pre_cover_accepted_date_day = date('j', $pre_cover_accepted_date); $pre_cover_accepted_date_month = date('n', $pre_cover_accepted_date); $pre_cover_accepted_date_year = date('Y', $pre_cover_accepted_date);

//tashih tarihleri
$pre_correction_delivery_date_day = date('j', $pre_correction_delivery_date); $pre_correction_delivery_date_month = date('n', $pre_correction_delivery_date); $pre_correction_delivery_date_year = date('Y', $pre_correction_delivery_date);
$pre_correction_acceptance_date_day = date('j', $pre_correction_acceptance_date); $pre_correction_acceptance_date_month = date('n', $pre_correction_acceptance_date); $pre_correction_acceptance_date_year = date('Y', $pre_correction_acceptance_date);
$pre_correction_accepted_date_day = date('j', $pre_correction_accepted_date); $pre_correction_accepted_date_month = date('n', $pre_correction_accepted_date); $pre_correction_accepted_date_year = date('Y', $pre_correction_accepted_date);

//
//ön kontroller
//

//mizanpaj tarih sýfýrlamalarý
if ($pre_layout_delivery_date_day < 1) $pre_layout_delivery_date_day = ''; if ($pre_layout_delivery_date_month < 1) $pre_layout_delivery_date_month = ''; if ($pre_layout_delivery_date_year < 1) $pre_layout_delivery_date_year = '';
if ($pre_layout_acceptance_date_day < 1) $pre_layout_acceptance_date_day = ''; if ($pre_layout_acceptance_date_month < 1) $pre_layout_acceptance_date_month = ''; if ($pre_layout_acceptance_date_year < 1) $pre_layout_acceptance_date_year = '';
if ($pre_layout_accepted_date_day < 1) $pre_layout_accepted_date_day = ''; if ($pre_layout_accepted_date_month < 1) $pre_layout_accepted_date_month = ''; if ($pre_layout_accepted_date_year < 1) $pre_layout_accepted_date_year = '';

//kapak tarih sýfýrlamalarý
if ($pre_cover_delivery_date_day < 1) $pre_cover_delivery_date_day = ''; if ($pre_cover_delivery_date_month < 1) $pre_cover_delivery_date_month = ''; if ($pre_cover_delivery_date_year < 1) $pre_cover_delivery_date_year = '';
if ($pre_cover_acceptance_date_day < 1) $pre_cover_acceptance_date_day = ''; if ($pre_cover_acceptance_date_month < 1) $pre_cover_acceptance_date_month = ''; if ($pre_cover_acceptance_date_year < 1) $pre_cover_acceptance_date_year = '';
if ($pre_cover_accepted_date_day < 1) $pre_cover_accepted_date_day = ''; if ($pre_cover_accepted_date_month < 1) $pre_cover_accepted_date_month = ''; if ($pre_cover_accepted_date_year < 1) $pre_cover_accepted_date_year = '';

//tashih tarih sýfýrlamalarý
if ($pre_correction_delivery_date_day < 1) $pre_correction_delivery_date_day = ''; if ($pre_correction_delivery_date_month < 1) $pre_correction_delivery_date_month = ''; if ($pre_correction_delivery_date_year < 1) $pre_correction_delivery_date_year = '';
if ($pre_correction_acceptance_date_day < 1) $pre_correction_acceptance_date_day = ''; if ($pre_correction_acceptance_date_month < 1) $pre_correction_acceptance_date_month = ''; if ($pre_correction_acceptance_date_year < 1) $pre_correction_acceptance_date_year = '';
if ($pre_correction_accepted_date_day < 1) $pre_correction_accepted_date_day = ''; if ($pre_correction_accepted_date_month < 1) $pre_correction_accepted_date_month = ''; if ($pre_correction_accepted_date_year < 1) $pre_correction_accepted_date_year = '';

$this_day = date('j', $this_time); 
$this_mounth = date('n', $this_time); 
$this_year = date('Y', $this_time);

//
//dýþ iþleri dizisi oluþturuyor
//

//sql sorgusu oluþturuluyor
$SORGU_cumle = 'SELECT * FROM pco_users';
//sql sorgusu gönderiliyor
$SORGU_sonuc = mysql_query($SORGU_cumle);
$bulunanadet = mysql_num_rows($SORGU_sonuc);

//sayfa içi oluþturuluyor, döne döne
if ($bulunanadet)
{
	for ( $i = 0; $i < $bulunanadet; $i++)
	{
		//sorgudan alýnýyor
		$user_id = mysql_result($SORGU_sonuc,$i,"id");
		$user_status = mysql_result($SORGU_sonuc,$i,"status");
		$user_email = mysql_result($SORGU_sonuc,$i,"email");
		$user_name = mysql_result($SORGU_sonuc,$i,"name");
		$user_tel = mysql_result($SORGU_sonuc,$i,"tel");
		$user_username = mysql_result($SORGU_sonuc,$i,"username");
		$user_auth_mizanpaj = mysql_result($SORGU_sonuc,$i,"auth_mizanpaj");
		$user_auth_kapak = mysql_result($SORGU_sonuc,$i,"auth_kapak");
		$user_auth_tashih = mysql_result($SORGU_sonuc,$i,"auth_tashih");
		
		//diziye ekleniyor
		$array_disisler_users[$user_id]["user_id"] = $user_id;
		$array_disisler_users[$user_id]["user_status"] = $user_status;
		$array_disisler_users[$user_id]["user_email"] = $user_email;
		$array_disisler_users[$user_id]["user_name"] = $user_name;
		$array_disisler_users[$user_id]["user_tel"] = $user_tel;
		$array_disisler_users[$user_id]["user_username"] = $user_username;
		$array_disisler_users[$user_id]["user_auth_mizanpaj"] = $user_auth_mizanpaj;
		$array_disisler_users[$user_id]["user_auth_kapak"] = $user_auth_kapak;
		$array_disisler_users[$user_id]["user_auth_tashih"] = $user_auth_tashih;
		if ($user_auth_mizanpaj == 1)
		{
			//$array_disisler_auth_mizanpaj[$user_id]["user_id"] = $user_id;
			$array_disisler_auth_mizanpaj[$user_id] = $user_name;
		}
		if ($user_auth_kapak == 1)
		{
			//$array_disisler_auth_mizanpaj[$user_id]["user_id"] = $user_id;
			$array_disisler_auth_kapak[$user_id] = $user_name;
		}
		if ($user_auth_tashih == 1)
		{
			//$array_disisler_auth_mizanpaj[$user_id]["user_id"] = $user_id;
			$array_disisler_auth_tashih[$user_id] = $user_name;
		}		
	}
}

//metin geldiði için temizlenmesi gereken alanlar
$book_name = stripslashes($book_name);
//mizanpaj görevlisi listesi
//kapak görevlisi listesi
//tashih görevlisi listesi

?>

<h1>Proje Düzenle &raquo; <?php echo $book_name?></h1>

<br>
<div>
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>">Baþlangýç</a> &raquo; 
<a class="button1" href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=disisler">Dýþ Ýþler</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=mizanpaj">Mizanpaj Kontrol</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=kapak">Kapak Kontrol</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=baski">Baský Ýþlemleri</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=yedek">Yedeklemeler</a>
</div>
<br>

<?php echo $islem_bilgisi?>

<form name="projeform" action="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=disisler" method="POST">
<input type="hidden" name="menu" value="projeler">
<input type="hidden" name="sub" value="disisler">
<input type="hidden" name="islem" value="guncelle">
<input type="hidden" name="book_id" value="<?php echo $book_id?>">

<table width="100%" border="0">
	<tr>
		<th width="50%">
			MÝZANPAJ
		</th>
		<th>
			<input class="button1" type="submit" name="projeform" onclick="this.className = 'button1 disabled';" name="submit" value="DEÐÝÞÝKLÝKLERÝ KAYDET">
		</th>
	</tr>

	<tr>
		<td valign="top"> 
			<table valign="top" width="100%" cellspacing="5" border="0">
				<tr>
					<td width="150">Mizanpaj Ýþleri</td>
					<td>:</td>
					<td>
						<select style="width: 190px;" name="pre_layout_designer_id">
						<option value="<?php echo $pre_layout_designer_id ?>"> <?php echo $array_disisler_users[$pre_layout_designer_id]["user_name"]?></option>						
						<option value=""></option>
						<?php
						foreach ($array_disisler_auth_mizanpaj as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="150">Ýsim</td>
					<td>:</td>
					<td>
						<?php echo $array_disisler_users[$pre_layout_designer_id]["user_name"]?>
					</td>
				</tr>

				<tr>
					<td>Tel</td>
					<td>:</td>
					<td>
						<?php echo $array_disisler_users[$pre_layout_designer_id]["user_tel"]?>
					</td>
				</tr>

				<tr>
					<td>Eposta</td>
					<td>:</td>
					<td>
						<?php echo $array_disisler_users[$pre_layout_designer_id]["user_email"]?>
					</td>
				</tr>
			</table>
		</td>
		<td valign="top">
			<table width="50%" cellspacing="5" border="0">

				<tr>
					<td>Mizanpaj Proje Durumu</td>
					<td>:</td>
					<td>
						<select style="width: 190px;" name="pre_layout_status">
						<option value="<?php echo $pre_layout_status ?>"> <?php echo $array_disisler_status[$pre_layout_status]?></option>						
						<option value=""></option>
						<?php
						foreach ($array_disisler_status as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Teslim Edilen Tarih</td>
					<td>:</td>
					<td>
						<select style="width: 50px;" name="pre_layout_delivery_date_day">
						<option value="<?php echo $pre_layout_delivery_date_day ?>"> <?php echo $array_gunler[$pre_layout_delivery_date_day]?></option>
						<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
						<?php
						foreach ($array_gunler as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 72px;" name="pre_layout_delivery_date_month">
						<option value="<?php echo $pre_layout_delivery_date_month ?>"> <?php echo $array_aylar[$pre_layout_delivery_date_month]?></option>
						<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
						<?php
						foreach ($array_aylar as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 60px;" name="pre_layout_delivery_date_year">
						<option value="<?php echo $pre_layout_delivery_date_year ?>"> <?php echo $array_yillar_publish_planed[$pre_layout_delivery_date_year]?></option>
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
				
				<tr>
					<td>Teslim Alýnacak Tarih</td>
					<td>:</td>
					<td>
						<select style="width: 50px;" name="pre_layout_acceptance_date_day">
						<option value="<?php echo $pre_layout_acceptance_date_day ?>"> <?php echo $array_gunler[$pre_layout_acceptance_date_day]?></option>
						<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
						<?php
						foreach ($array_gunler as $k => $v)
						{
							echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 72px;" name="pre_layout_acceptance_date_month">
						<option value="<?php echo $pre_layout_acceptance_date_month ?>"> <?php echo $array_aylar[$pre_layout_acceptance_date_month]?></option>
						<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
						<?php
						foreach ($array_aylar as $k => $v)
						{
							echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 60px;" name="pre_layout_acceptance_date_year">
						<option value="<?php echo $pre_layout_acceptance_date_year ?>"> <?php echo $array_yillar_publish_planed[$pre_layout_acceptance_date_year]?></option>
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
				
				<tr>
					<td>Teslim Alýnan Tarih</td>
					<td>:</td>
					<td>
						<select style="width: 50px;" name="pre_layout_accepted_date_day">
						<option value="<?php echo $pre_layout_accepted_date_day ?>"> <?php echo $array_gunler[$pre_layout_accepted_date_day]?></option>
						<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
						<?php
						foreach ($array_gunler as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 72px;" name="pre_layout_accepted_date_month">
						<option value="<?php echo $pre_layout_accepted_date_month ?>"> <?php echo $array_aylar[$pre_layout_accepted_date_month]?></option>
						<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
						<?php
						foreach ($array_aylar as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 60px;" name="pre_layout_accepted_date_year">
						<option value="<?php echo $pre_layout_accepted_date_year ?>"> <?php echo $array_yillar_publish_planed[$pre_layout_accepted_date_year]?></option>
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

<table width="100%" border="0">
	<tr><th colspan="2">KAPAK</th></tr>
	<tr>
		<td width="50%" valign="top"> 
			<table valign="top" width="100%" cellspacing="5" border="0">
				<tr>
					<td width="150">Kapak Ýþleri</td>
					<td>:</td>
					<td>
						<select style="width: 190px;" name="pre_cover_redactor_id">
						<option value="<?php echo $pre_cover_redactor_id ?>"> <?php echo $array_disisler_users[$pre_cover_redactor_id]["user_name"]?></option>						
						<option value=""></option>
						<?php
						foreach ($array_disisler_auth_kapak as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="150">Ýsim</td>
					<td>:</td>
					<td>
						<?php echo $array_disisler_users[$pre_cover_redactor_id]["user_name"]?>
					</td>
				</tr>

				<tr>
					<td>Tel</td>
					<td>:</td>
					<td>
						<?php echo $array_disisler_users[$pre_cover_redactor_id]["user_tel"]?>
					</td>
				</tr>

				<tr>
					<td>Eposta</td>
					<td>:</td>
					<td>
						<?php echo $array_disisler_users[$pre_cover_redactor_id]["user_email"]?>
					</td>
				</tr>
			</table>
		</td>
		<td valign="top">
			<table width="50%" cellspacing="5" border="0">

				<tr>
					<td>Kapak Proje Durumu</td>
					<td>:</td>
					<td>
						<select style="width: 190px;" name="pre_cover_status">
						<option value="<?php echo $pre_cover_status ?>"> <?php echo $array_disisler_status[$pre_cover_status]?></option>						
						<?php
						foreach ($array_disisler_status as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Teslim Edilen Tarih</td>
					<td>:</td>
					<td>
						<select style="width: 50px;" name="pre_cover_delivery_date_day">
						<option value="<?php echo $pre_cover_delivery_date_day ?>"> <?php echo $array_gunler[$pre_cover_delivery_date_day]?></option>
						<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
						<?php
						foreach ($array_gunler as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 72px;" name="pre_cover_delivery_date_month">
						<option value="<?php echo $pre_cover_delivery_date_month ?>"> <?php echo $array_aylar[$pre_cover_delivery_date_month]?></option>
						<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
						<?php
						foreach ($array_aylar as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 60px;" name="pre_cover_delivery_date_year">
						<option value="<?php echo $pre_cover_delivery_date_year ?>"> <?php echo $array_yillar_publish_planed[$pre_cover_delivery_date_year]?></option>
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
				
				<tr>
					<td>Teslim Alýnacak Tarih</td>
					<td>:</td>
					<td>
						<select style="width: 50px;" name="pre_cover_acceptance_date_day">
						<option value="<?php echo $pre_cover_acceptance_date_day ?>"> <?php echo $array_gunler[$pre_cover_acceptance_date_day]?></option>
						<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
						<?php
						foreach ($array_gunler as $k => $v)
						{
							echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 72px;" name="pre_cover_acceptance_date_month">
						<option value="<?php echo $pre_cover_acceptance_date_month ?>"> <?php echo $array_aylar[$pre_cover_acceptance_date_month]?></option>
						<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
						<?php
						foreach ($array_aylar as $k => $v)
						{
							echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 60px;" name="pre_cover_acceptance_date_year">
						<option value="<?php echo $pre_cover_acceptance_date_year ?>"> <?php echo $array_yillar_publish_planed[$pre_cover_acceptance_date_year]?></option>
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
				
				<tr>
					<td>Teslim Alýnan Tarih</td>
					<td>:</td>
					<td>
						<select style="width: 50px;" name="pre_cover_accepted_date_day">
						<option value="<?php echo $pre_cover_accepted_date_day ?>"> <?php echo $array_gunler[$pre_cover_accepted_date_day]?></option>
						<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
						<?php
						foreach ($array_gunler as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 72px;" name="pre_cover_accepted_date_month">
						<option value="<?php echo $pre_cover_accepted_date_month ?>"> <?php echo $array_aylar[$pre_cover_accepted_date_month]?></option>
						<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
						<?php
						foreach ($array_aylar as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 60px;" name="pre_cover_accepted_date_year">
						<option value="<?php echo $pre_cover_accepted_date_year ?>"> <?php echo $array_yillar_publish_planed[$pre_cover_accepted_date_year]?></option>
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


<table width="100%" border="0">
	<tr><th colspan="2">TASHÝH</th></tr>
	<tr>
		<td width="50%" valign="top"> 
			<table valign="top" width="100%" cellspacing="5" border="0">
				<tr>
					<td width="150">Tashih Ýþleri</td>
					<td>:</td>
					<td>
						<select style="width: 190px;" name="pre_correction_redactor_id">
						<option value="<?php echo $pre_correction_redactor_id ?>"> <?php echo $array_disisler_users[$pre_correction_redactor_id]["user_name"]?></option>						
						<option value=""></option>
						<?php
						foreach ($array_disisler_auth_tashih as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="150">Ýsim</td>
					<td>:</td>
					<td>
						<?php echo $array_disisler_users[$pre_correction_redactor_id]["user_name"]?>
					</td>
				</tr>

				<tr>
					<td>Tel</td>
					<td>:</td>
					<td>
						<?php echo $array_disisler_users[$pre_correction_redactor_id]["user_tel"]?>
					</td>
				</tr>

				<tr>
					<td>Eposta</td>
					<td>:</td>
					<td>
						<?php echo $array_disisler_users[$pre_correction_redactor_id]["user_email"]?>
					</td>
				</tr>
			</table>
		</td>
		<td valign="top">
			<table width="50%" cellspacing="5" border="0">
				<tr>
					<td>Tashih Proje Durumu</td>
					<td>:</td>
					<td>
						<select style="width: 190px;" name="pre_correction_status">
						<option value="<?php echo $pre_correction_status ?>"> <?php echo $array_disisler_status[$pre_correction_status]?></option>						
						<?php
						foreach ($array_disisler_status as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Teslim Edilen Tarih</td>
					<td>:</td>
					<td>
						<select style="width: 50px;" name="pre_correction_delivery_date_day">
						<option value="<?php echo $pre_correction_delivery_date_day ?>"> <?php echo $array_gunler[$pre_correction_delivery_date_day]?></option>
						<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
						<?php
						foreach ($array_gunler as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 72px;" name="pre_correction_delivery_date_month">
						<option value="<?php echo $pre_correction_delivery_date_month ?>"> <?php echo $array_aylar[$pre_correction_delivery_date_month]?></option>
						<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
						<?php
						foreach ($array_aylar as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 60px;" name="pre_correction_delivery_date_year">
						<option value="<?php echo $pre_correction_delivery_date_year ?>"> <?php echo $array_yillar_publish_planed[$pre_correction_delivery_date_year]?></option>
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
				
				<tr>
					<td>Teslim Alýnacak Tarih</td>
					<td>:</td>
					<td>
						<select style="width: 50px;" name="pre_correction_acceptance_date_day">
						<option value="<?php echo $pre_correction_acceptance_date_day ?>"> <?php echo $array_gunler[$pre_correction_acceptance_date_day]?></option>
						<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
						<?php
						foreach ($array_gunler as $k => $v)
						{
							echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 72px;" name="pre_correction_acceptance_date_month">
						<option value="<?php echo $pre_correction_acceptance_date_month ?>"> <?php echo $array_aylar[$pre_correction_acceptance_date_month]?></option>
						<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
						<?php
						foreach ($array_aylar as $k => $v)
						{
							echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 60px;" name="pre_correction_acceptance_date_year">
						<option value="<?php echo $pre_correction_acceptance_date_year ?>"> <?php echo $array_yillar_publish_planed[$pre_correction_acceptance_date_year]?></option>
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
				
				<tr>
					<td>Teslim Alýnan Tarih</td>
					<td>:</td>
					<td>
						<select style="width: 50px;" name="pre_correction_accepted_date_day">
						<option value="<?php echo $pre_correction_accepted_date_day ?>"> <?php echo $array_gunler[$pre_correction_accepted_date_day]?></option>
						<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
						<?php
						foreach ($array_gunler as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 72px;" name="pre_correction_accepted_date_month">
						<option value="<?php echo $pre_correction_accepted_date_month ?>"> <?php echo $array_aylar[$pre_correction_accepted_date_month]?></option>
						<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
						<?php
						foreach ($array_aylar as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 60px;" name="pre_correction_accepted_date_year">
						<option value="<?php echo $pre_correction_accepted_date_year ?>"> <?php echo $array_yillar_publish_planed[$pre_correction_accepted_date_year]?></option>
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
<pre>
* Mizanpaj, Kapak ve Tashih için yeni kiþiler girmek için "üye ekle" menüsünden 
yeni kiþiler eklemeniz ve iþlem yetkilerini belirlemeniz gerekmektedir.
</pre>
</div>
