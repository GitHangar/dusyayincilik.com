<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"] == 1) exit ();

$this_time = time();
$this_day = date('j', $this_time); 
$this_mounth = date('n', $this_time); 
$this_year = date('Y', $this_time);

// echo "<pre>";
// print_r($_REQUEST);
// echo "</pre>";

$book_id = $_REQUEST["un"];

if (isset($_REQUEST["projeform"]))
{
	//varsayýlanlar
	$changetar = time();

	//teslim alýnacak / alýnan tarih
	$print_delivery_date_day = trim(strip_tags($_REQUEST["print_delivery_date_day"]));
	$print_delivery_date_month = trim(strip_tags($_REQUEST["print_delivery_date_month"]));
	$print_delivery_date_year = trim(strip_tags($_REQUEST["print_delivery_date_year"]));
	$print_accept_date_day = trim(strip_tags($_REQUEST["print_accept_date_day"]));
	$print_accept_date_month = trim(strip_tags($_REQUEST["print_accept_date_month"]));
	$print_accept_date_year = trim(strip_tags($_REQUEST["print_accept_date_year"]));
	
	//tarih sýfýrlamalarý
	if ($print_delivery_date_day < 1) $print_delivery_date_day = ''; 
	if ($print_delivery_date_month < 1) $print_delivery_date_month = ''; 
	if ($print_delivery_date_year < 1) $print_delivery_date_year = '';
	if ($print_accept_date_day < 1) $print_accept_date_day = ''; 
	if ($print_accept_date_month < 1) $print_accept_date_month = ''; 
	if ($print_accept_date_year < 1) $print_accept_date_year = '';

	//tarih þekline dönüþtürmeler
	$print_delivery_date = mktime(1, 1, 1, $print_delivery_date_month, $print_delivery_date_day, $print_delivery_date_year);
	$print_accept_date = mktime(1, 1, 1, $print_accept_date_month, $print_accept_date_day, $print_accept_date_year);
	
	//metin gelen alanlar
 	$print_print_count = addslashes(trim(strip_tags($_REQUEST["print_print_count"])));
	$print_book_paper = addslashes(trim(strip_tags($_REQUEST["print_book_paper"])));
	$print_cover_paper = addslashes(trim(strip_tags($_REQUEST["print_cover_paper"]))); 

	//seçmeli gelen alanlar
 	$print_cover_type = trim(strip_tags($_REQUEST["print_cover_type"]));
	$print_paper_source = trim(strip_tags($_REQUEST["print_paper_source"]));

	//checkbox gelen alanlar
 	$cover_concept_cmyk = trim(strip_tags($_REQUEST["cover_concept_cmyk"]));
	$cover_concept_cross = trim(strip_tags($_REQUEST["cover_concept_cross"]));
	$cover_concept_collar = trim(strip_tags($_REQUEST["cover_concept_collar"]));
	$cover_concept_convert = trim(strip_tags($_REQUEST["cover_concept_convert"]));
	$cover_film_cmyk = trim(strip_tags($_REQUEST["cover_film_cmyk"]));
	$cover_film_cross = trim(strip_tags($_REQUEST["cover_film_cross"]));
	$cover_film_collar = trim(strip_tags($_REQUEST["cover_film_collar"]));
	$cover_film_convert = trim(strip_tags($_REQUEST["cover_film_convert"]));
	$print_pre_cover_film = trim(strip_tags($_REQUEST["print_pre_cover_film"]));
	$print_pre_book_film = trim(strip_tags($_REQUEST["print_pre_book_film"]));
	$print_pre_cover_type = trim(strip_tags($_REQUEST["print_pre_cover_type"]));
	$print_pre_jacket = trim(strip_tags($_REQUEST["print_pre_jacket"]));
	$print_pre_lac = trim(strip_tags($_REQUEST["print_pre_lac"]));
	$print_pre_gofre = trim(strip_tags($_REQUEST["print_pre_gofre"]));
	
	//checkbox alanlarý dönüþtürülüyor
	if($cover_concept_cmyk == 'on') $cover_concept_cmyk = 1; else $cover_concept_cmyk = 0;
	if($cover_concept_cross == 'on') $cover_concept_cross = 1; else $cover_concept_cross = 0;
	if($cover_concept_collar == 'on') $cover_concept_collar = 1; else $cover_concept_collar = 0;
	if($cover_concept_convert == 'on') $cover_concept_convert = 1; else $cover_concept_convert = 0;
	if($cover_film_cmyk == 'on') $cover_film_cmyk = 1; else $cover_film_cmyk = 0;
	if($cover_film_cross == 'on') $cover_film_cross = 1; else $cover_film_cross = 0;
	if($cover_film_collar == 'on') $cover_film_collar = 1; else $cover_film_collar = 0;
	if($cover_film_convert == 'on') $cover_film_convert = 1; else $cover_film_convert = 0;
	if($print_pre_cover_film == 'on') $print_pre_cover_film = 1; else $print_pre_cover_film = 0;
	if($print_pre_book_film == 'on') $print_pre_book_film = 1; else $print_pre_book_film = 0;
	if($print_pre_cover_type == 'on') $print_pre_cover_type = 1; else $print_pre_cover_type = 0;
	if($print_pre_jacket == 'on') $print_pre_jacket = 1; else $print_pre_jacket = 0;
	if($print_pre_lac == 'on') $print_pre_lac = 1; else $print_pre_lac = 0;
	if($print_pre_gofre == 'on') $print_pre_gofre = 1; else $print_pre_gofre = 0;

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
		$SORGU_urun = "
			UPDATE pco_book 
			SET 
				cover_concept_cmyk = '".$cover_concept_cmyk."',
				cover_concept_cross = '".$cover_concept_cross."',
				cover_concept_collar = '".$cover_concept_collar."',
				cover_concept_convert = '".$cover_concept_convert."',
				cover_film_cmyk = '".$cover_film_cmyk."',
				cover_film_cross = '".$cover_film_cross."',
				cover_film_collar = '".$cover_film_collar."',
				cover_film_convert = '".$cover_film_convert."',
				print_pre_cover_film = '".$print_pre_cover_film."',
				print_pre_book_film = '".$print_pre_book_film."',
				print_pre_cover_type = '".$print_pre_cover_type."',
				print_pre_jacket = '".$print_pre_jacket."',
				print_pre_lac = '".$print_pre_lac."',
				print_pre_gofre = '".$print_pre_gofre."',
				print_cover_type = '".$print_cover_type."',
				print_print_count = '".$print_print_count."',
				print_book_paper = '".$print_book_paper."',
				print_cover_paper = '".$print_cover_paper."',
				print_paper_source = '".$print_paper_source."',
				print_delivery_date = '".$print_delivery_date."',
				print_accept_date = '".$print_accept_date."',
				changetar = '".$changetar."'
			WHERE book_id = '".$book_id."'
			;";
			//addslashes($SORGU_urun);
			// echo '<pre>'.$SORGU_urun.'</pre>';
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
		cover_concept_cmyk,
		cover_concept_cross,
		cover_concept_collar,
		cover_concept_convert,
		cover_film_cmyk,
		cover_film_cross,
		cover_film_collar,
		cover_film_convert,
		print_pre_cover_film,
		print_pre_book_film,
		print_pre_cover_type,
		print_pre_jacket,
		print_pre_lac,
		print_pre_gofre,
		print_cover_type,
		print_print_count,
		print_book_paper,
		print_cover_paper,
		print_paper_source,
		print_delivery_date,
		print_accept_date
	FROM pco_book 
	WHERE book_id = "'.$book_id.'";';
	// echo '<pre>'.$SORGU_cumle.'</pre>';
$SORGU_sonuc = mysql_query($SORGU_cumle);
$bulunanadet = mysql_num_rows($SORGU_sonuc);

//mizanpaj deðerleri oluþturuluyor
$book_name = mysql_result($SORGU_sonuc,0,"book_name");
$cover_concept_cmyk = mysql_result($SORGU_sonuc,0,"cover_concept_cmyk");
$cover_concept_cross = mysql_result($SORGU_sonuc,0,"cover_concept_cross");
$cover_concept_collar = mysql_result($SORGU_sonuc,0,"cover_concept_collar");
$cover_concept_convert = mysql_result($SORGU_sonuc,0,"cover_concept_convert");
$cover_film_cmyk = mysql_result($SORGU_sonuc,0,"cover_film_cmyk");
$cover_film_cross = mysql_result($SORGU_sonuc,0,"cover_film_cross");
$cover_film_collar = mysql_result($SORGU_sonuc,0,"cover_film_collar");
$cover_film_convert = mysql_result($SORGU_sonuc,0,"cover_film_convert");
$print_pre_cover_film = mysql_result($SORGU_sonuc,0,"print_pre_cover_film");
$print_pre_book_film = mysql_result($SORGU_sonuc,0,"print_pre_book_film");
$print_pre_cover_type = mysql_result($SORGU_sonuc,0,"print_pre_cover_type");
$print_pre_jacket = mysql_result($SORGU_sonuc,0,"print_pre_jacket");
$print_pre_lac = mysql_result($SORGU_sonuc,0,"print_pre_lac");
$print_pre_gofre = mysql_result($SORGU_sonuc,0,"print_pre_gofre");

$print_cover_type = mysql_result($SORGU_sonuc,0,"print_cover_type");
$print_print_count = mysql_result($SORGU_sonuc,0,"print_print_count");
$print_book_paper = mysql_result($SORGU_sonuc,0,"print_book_paper");
$print_cover_paper = mysql_result($SORGU_sonuc,0,"print_cover_paper");
$print_paper_source = mysql_result($SORGU_sonuc,0,"print_paper_source");
$print_delivery_date = mysql_result($SORGU_sonuc,0,"print_delivery_date");
$print_accept_date = mysql_result($SORGU_sonuc,0,"print_accept_date");

//metin gelen alanlar
$print_print_count = stripslashes($print_print_count);
$print_book_paper = stripslashes($print_book_paper);
$print_cover_paper = stripslashes($print_cover_paper);

//checkbox alanlarý dönüþtürülüyor
if ($cover_concept_cmyk == 1) $cover_concept_cmyk = 'checked="checked"'; 
if ($cover_concept_cross == 1) $cover_concept_cross = 'checked="checked"'; 
if ($cover_concept_collar == 1) $cover_concept_collar = 'checked="checked"'; 
if ($cover_concept_convert == 1) $cover_concept_convert = 'checked="checked"'; 
if ($cover_film_cmyk == 1) $cover_film_cmyk = 'checked="checked"'; 
if ($cover_film_cross == 1) $cover_film_cross = 'checked="checked"'; 
if ($cover_film_collar == 1) $cover_film_collar = 'checked="checked"'; 
if ($cover_film_convert == 1) $cover_film_convert = 'checked="checked"'; 
if ($print_pre_cover_film == 1) $print_pre_cover_film = 'checked="checked"'; 
if ($print_pre_book_film == 1) $print_pre_book_film = 'checked="checked"'; 
if ($print_pre_cover_type == 1) $print_pre_cover_type = 'checked="checked"'; 
if ($print_pre_jacket == 1) $print_pre_jacket = 'checked="checked"'; 
if ($print_pre_lac == 1) $print_pre_lac = 'checked="checked"'; 
if ($print_pre_gofre == 1) $print_pre_gofre = 'checked="checked"'; 

//tarih alanlarý oluþturuluyor
$print_delivery_date_day = date('j', $print_delivery_date); 
$print_delivery_date_month = date('n', $print_delivery_date); 
$print_delivery_date_year = date('Y', $print_delivery_date);
$print_accept_date_day = date('j', $print_accept_date); 
$print_accept_date_month = date('n', $print_accept_date); 
$print_accept_date_year = date('Y', $print_accept_date);

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
		$user_name = mysql_result($SORGU_sonuc,$i,"name");
		$user_auth_kagit = mysql_result($SORGU_sonuc,$i,"auth_kagit");
		
		//diziye ekleniyor
		$array_disisler_users[$user_id]["user_id"] = $user_id;
		$array_disisler_users[$user_id]["user_name"] = $user_name;
		$array_disisler_users[$user_id]["user_auth_kagit"] = $user_auth_kagit;

		if ($user_auth_kagit == 1)
		{
			//$array_disisler_auth_mizanpaj[$user_id]["user_id"] = $user_id;
			$array_disisler_auth_kagit[$user_id] = $user_name;
		}		
	}
}

//metin geldiði için temizlenmesi gereken alanlar
$book_name = stripslashes($book_name);

?>

<h1>Proje Düzenle &raquo; <?php echo $book_name?></h1>

<br>
<div>
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>">Baþlangýç</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=disisler">Dýþ Ýþler</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=mizanpaj">Mizanpaj Kontrol</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=kapak">Kapak Kontrol</a> &raquo; 
<a class="button1" href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=baski">Baský Ýþlemleri</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=yedek">Yedeklemeler</a>
</div>
<br>

<?php echo $islem_bilgisi?>

<form name="projeform" action="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=mizanpaj" method="POST">
<input type="hidden" name="menu" value="projeler">
<input type="hidden" name="sub" value="baski">
<input type="hidden" name="islem" value="guncelle">
<input type="hidden" name="book_id" value="<?php echo $book_id?>">

<table width="100%" border="0">
	<tr>
		<th width="50%">
		</th>
		<th>
			<input class="button1" type="submit" name="projeform" onclick="this.className = 'button1 disabled';" name="submit" value="DEÐÝÞÝKLÝKLERÝ KAYDET">
		</th>
	</tr>

	<tr>
		<td valign="top"> 
			<table valign="top" width="100%" cellspacing="5" border="0">
				<tr class="col1">
					<th colspan="3">
						KAPAK FÝLM ÇALIÞMA DOSYASI
					</th>
				</tr>
				<tr>
					<td>CMYK ile uyumlu</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_concept_cmyk" <?php echo $cover_concept_cmyk?>>
					</td>
				</tr>
				<tr>
					<td>Kros deðerleri belirtilmiþ</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_concept_cross" <?php echo $cover_concept_cross?>>
					</td>
				</tr>
				<tr>
					<td>Taþma deðerleri verilmiþ</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_concept_collar" <?php echo $cover_concept_collar?>>
					</td>
				</tr>
				<tr>
					<td>Convert iþlemi gerçekleþtirilmiþ</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_concept_convert" <?php echo $cover_concept_convert?>>
					</td>
				</tr>
				<tr class="col1">
					<th colspan="3">
						KAPAK FÝLMÝ
					</th>
				</tr>				
				<tr>
					<td>CMYK ile uyumlu</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_film_cmyk" <?php echo $cover_film_cmyk?>>
					</td>
				</tr>
				<tr>
					<td>Kros deðerleri belirtilmiþ</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_film_cross" <?php echo $cover_film_cross?>>
					</td>
				</tr>
				<tr>
					<td>Taþma deðerleri verilmiþ</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_film_collar" <?php echo $cover_film_collar?>>
					</td>
				</tr>
				<tr>
					<td>Convert iþlemi gerçekleþtirilmiþ</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_film_convert" <?php echo $cover_film_convert?>>
					</td>
				</tr>
				<tr class="col1">
					<th colspan="3">
						BASKI HAZIRLIK ÝÞLEMLERÝ
					</th>
				</tr>				
				<tr>
					<td>Kapak filme gönderildi</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="print_pre_cover_film" <?php echo $print_pre_cover_film?>>
					</td>
				</tr>
				<tr>
					<td>Kitap filme gönderildi</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="print_pre_book_film" <?php echo $print_pre_book_film?>>
					</td>
				</tr>
				<tr>
					<td>Cilt tipi matbaaya bildirildi</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="print_pre_cover_type" <?php echo $print_pre_cover_type?>>
					</td>
				</tr>
				<tr>
					<td>Þömiz varsa bilgi verildi</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="print_pre_jacket" <?php echo $print_pre_jacket?>>
					</td>
				</tr>
				<tr>
					<td>Lak varsa bilgi verildi</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="print_pre_lac" <?php echo $print_pre_lac?>>
					</td>
				</tr>
				<tr>
					<td>Gofre varsa bilgi verildi</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="print_pre_gofre" <?php echo $print_pre_gofre?>>
					</td>
				</tr>
			</table>
		</td>
		<td valign="top">
			<table width="50%" cellspacing="5" border="0">
				<tr class="col1">
					<th colspan="3">
						BASKI ÝÞLEMLERÝ
					</th>
				</tr>
				<tr>
					<td width="180">kapak tipi</td>
					<td colspan="2">
					:&nbsp;
						<select style="width: 200px;" name="print_cover_type">
						<option value="<?php echo $print_cover_type ?>"> <?php echo $array_baski_kapaktipleri[$print_cover_type]?></option>						
						<?php
						foreach ($array_baski_kapaktipleri as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Basýlacak adet </td>
					<td colspan="2">
					:&nbsp;&nbsp;<input style="width: 195px;" type="text" name="print_print_count" value="<?php echo $print_print_count?>">
					</td>
				</tr>
				<tr>
					<td>Kaðýt bilgileri	</td>
					<td colspan="2">
					:&nbsp;&nbsp;<input style="width: 195px;" type="text" name="print_book_paper" value="<?php echo $print_book_paper?>">
					</td>
				</tr>
				<tr>
					<td>Kapak kaðýdý bilgileri</td>
					<td colspan="2">
					:&nbsp;&nbsp;<input style="width: 195px;" type="text" name="print_cover_paper" value="<?php echo $print_cover_paper?>">
					</td>
				</tr>
				<tr>
					<td>Kaðýt sipariþi kime verildi</td>
					<td colspan="2">
					:&nbsp;
						<select style="width: 200px;" name="print_paper_source">
						<option value="<?php echo $print_paper_source ?>"> <?php echo $array_disisler_users[$print_paper_source]["user_name"]?></option>						
						<option value=""></option>
						<?php
						foreach ($array_disisler_auth_kagit as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Teslim Alýnacak Tarih</td>
					<td>:&nbsp;
						<select style="width: 50px;" name="print_delivery_date_day">
						<option value="<?php echo $print_delivery_date_day ?>"> <?php echo $array_gunler[$print_delivery_date_day]?></option>
						<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
						<?php
						foreach ($array_gunler as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 77px;" name="print_delivery_date_month">
						<option value="<?php echo $print_delivery_date_month ?>"> <?php echo $array_aylar[$print_delivery_date_month]?></option>
						<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
						<?php
						foreach ($array_aylar as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 65px;" name="print_delivery_date_year">
						<option value="<?php echo $print_delivery_date_year ?>"> <?php echo $array_yillar_publish_planed[$print_delivery_date_year]?></option>
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
					<td>:&nbsp;
						<select style="width: 50px;" name="print_accept_date_day">
						<option value="<?php echo $print_accept_date_day ?>"> <?php echo $array_gunler[$print_accept_date_day]?></option>
						<option style="background-color:red;" value="<?php echo $this_day ?>"> <?php echo $array_gunler[$this_day]?></option>
						<?php
						foreach ($array_gunler as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 77px;" name="print_accept_date_month">
						<option value="<?php echo $print_accept_date_month ?>"> <?php echo $array_aylar[$print_accept_date_month]?></option>
						<option style="background-color:red;" value="<?php echo $this_mounth ?>"> <?php echo $array_aylar[$this_mounth]?></option>
						<?php
						foreach ($array_aylar as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
						<select style="width: 65px;" name="print_accept_date_year">
						<option value="<?php echo $print_accept_date_year ?>"> <?php echo $array_yillar_publish_planed[$print_accept_date_year]?></option>
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