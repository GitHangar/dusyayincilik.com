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

if (isset($_REQUEST["projeform"]))
{
	//varsayýlanlar
	$changetar = time();

	//metin gelen alanlar
	$cover_pre_testers = addslashes(trim(strip_tags($_REQUEST["cover_pre_testers"])));

	//seçmeli gelen alanlar
	$cover_pre_serias = trim(strip_tags($_REQUEST["cover_pre_serias"]));
	$cover_spine_text_direction = trim(strip_tags($_REQUEST["cover_spine_text_direction"]));
	$bracket_direction = trim(strip_tags($_REQUEST["bracket_direction"]));

	//checkbox alanlarý alýnýyor
	$cover_pre_serias_check = trim(strip_tags($_REQUEST["cover_pre_serias_check"]));
	$cover_pre_color = trim(strip_tags($_REQUEST["cover_pre_color"]));
	$cover_pre_dimensions = trim(strip_tags($_REQUEST["cover_pre_dimensions"]));
	$cover_pre_boss_reported = trim(strip_tags($_REQUEST["cover_pre_boss_reported"]));
	$cover_pre_boss_accepted = trim(strip_tags($_REQUEST["cover_pre_boss_accepted"]));
	$cover_pre_author_reported = trim(strip_tags($_REQUEST["cover_pre_author_reported"]));
	$cover_pre_author_accepted = trim(strip_tags($_REQUEST["cover_pre_author_accepted"]));
	$cover_pre_tested = trim(strip_tags($_REQUEST["cover_pre_tested"]));
	$cover_front_book_name = trim(strip_tags($_REQUEST["cover_front_book_name"]));
	$cover_front_author_name = trim(strip_tags($_REQUEST["cover_front_author_name"]));
	$cover_front_cover_photo = trim(strip_tags($_REQUEST["cover_front_cover_photo"]));
	$cover_front_cover_photo_accept = trim(strip_tags($_REQUEST["cover_front_cover_photo_accept"]));
	$cover_front_logo_dimension = trim(strip_tags($_REQUEST["cover_front_logo_dimension"]));
	$cover_front_logo_location = trim(strip_tags($_REQUEST["cover_front_logo_location"]));
	$cover_front_logo_color = trim(strip_tags($_REQUEST["cover_front_logo_color"]));
	$cover_front_serias_name = trim(strip_tags($_REQUEST["cover_front_serias_name"]));
	$cover_front_press_number = trim(strip_tags($_REQUEST["cover_front_press_number"]));
	$cover_front_other_notes = trim(strip_tags($_REQUEST["cover_front_other_notes"]));
	$cover_spine_book_name = trim(strip_tags($_REQUEST["cover_spine_book_name"]));
	$cover_spine_author_name = trim(strip_tags($_REQUEST["cover_spine_author_name"]));
	$cover_spine_spine_width = trim(strip_tags($_REQUEST["cover_spine_spine_width"]));
	$cover_spine_spine_color = trim(strip_tags($_REQUEST["cover_spine_spine_color"]));
	$cover_spine_spine_number = trim(strip_tags($_REQUEST["cover_spine_spine_number"]));
	$cover_spine_logo_dimension = trim(strip_tags($_REQUEST["cover_spine_logo_dimension"]));
	$cover_spine_logo_location = trim(strip_tags($_REQUEST["cover_spine_logo_location"]));
	$cover_spine_logo_color = trim(strip_tags($_REQUEST["cover_spine_logo_color"]));

	$cover_back_book_name = trim(strip_tags($_REQUEST["cover_back_book_name"]));
	$cover_back_author_name = trim(strip_tags($_REQUEST["cover_back_author_name"]));
	$cover_back_cover_photo = trim(strip_tags($_REQUEST["cover_back_cover_photo"]));
	$cover_back_cover_photo_accept = trim(strip_tags($_REQUEST["cover_back_cover_photo_accept"]));
	$cover_back_logo_dimension = trim(strip_tags($_REQUEST["cover_back_logo_dimension"]));
	$cover_back_logo_location = trim(strip_tags($_REQUEST["cover_back_logo_location"]));
	$cover_back_logo_color = trim(strip_tags($_REQUEST["cover_back_logo_color"]));
	$cover_back_publisher_infos = trim(strip_tags($_REQUEST["cover_back_publisher_infos"]));
	$cover_back_publisher_adress = trim(strip_tags($_REQUEST["cover_back_publisher_adress"]));
	$cover_back_publisher_tel = trim(strip_tags($_REQUEST["cover_back_publisher_tel"]));
	$cover_back_publisher_fax = trim(strip_tags($_REQUEST["cover_back_publisher_fax"]));
	$cover_back_publisher_site = trim(strip_tags($_REQUEST["cover_back_publisher_site"]));
	$cover_back_publisher_email = trim(strip_tags($_REQUEST["cover_back_publisher_email"]));
	$cover_back_publisher_order_info = trim(strip_tags($_REQUEST["cover_back_publisher_order_info"]));
	$cover_back_publisher_online_order = trim(strip_tags($_REQUEST["cover_back_publisher_online_order"]));
	$cover_back_text = trim(strip_tags($_REQUEST["cover_back_text"]));
	$cover_back_text_acccepted = trim(strip_tags($_REQUEST["cover_back_text_acccepted"]));
	$cover_back_text_corrected = trim(strip_tags($_REQUEST["cover_back_text_corrected"]));
	$cover_back_isbn_number = trim(strip_tags($_REQUEST["cover_back_isbn_number"]));
	$cover_back_isbn_code = trim(strip_tags($_REQUEST["cover_back_isbn_code"]));
	$cover_back_isbn_code_tested = trim(strip_tags($_REQUEST["cover_back_isbn_code_tested"]));
	$cover_back_streamer_area = trim(strip_tags($_REQUEST["cover_back_streamer_area"]));

	$bracket_direction = trim(strip_tags($_REQUEST["bracket_direction"]));
	$bracket_concept = trim(strip_tags($_REQUEST["bracket_concept"]));
	$bracket_image = trim(strip_tags($_REQUEST["bracket_image"]));
	$bracket_text = trim(strip_tags($_REQUEST["bracket_text"]));
	$bracket_dimension = trim(strip_tags($_REQUEST["bracket_dimension"]));
	$bracket_book_name = trim(strip_tags($_REQUEST["bracket_book_name"]));
	$bracket_author_name = trim(strip_tags($_REQUEST["bracket_author_name"]));
	$bracket_logo = trim(strip_tags($_REQUEST["bracket_logo"]));
	$bracket_publisher_name = trim(strip_tags($_REQUEST["bracket_publisher_name"]));
	$bracket_order_info = trim(strip_tags($_REQUEST["bracket_order_info"]));
	$bracket_online_order = trim(strip_tags($_REQUEST["bracket_online_order"]));

	//checkbox alanlarý dönüþtürülüyor
	if ($cover_pre_serias_check == 'on') $cover_pre_serias_check = 1; else $cover_pre_serias_check = 0;
	if ($cover_pre_color == 'on') $cover_pre_color = 1; else $cover_pre_color = 0;
	if ($cover_pre_dimensions == 'on') $cover_pre_dimensions = 1; else $cover_pre_dimensions = 0;
	if ($cover_pre_boss_reported == 'on') $cover_pre_boss_reported = 1; else $cover_pre_boss_reported = 0;
	if ($cover_pre_boss_accepted == 'on') $cover_pre_boss_accepted = 1; else $cover_pre_boss_accepted = 0;
	if ($cover_pre_author_reported == 'on') $cover_pre_author_reported = 1; else $cover_pre_author_reported = 0;
	if ($cover_pre_author_accepted == 'on') $cover_pre_author_accepted = 1; else $cover_pre_author_accepted = 0;
	if ($cover_pre_tested == 'on') $cover_pre_tested = 1; else $cover_pre_tested = 0;
	if ($cover_front_book_name == 'on') $cover_front_book_name = 1; else $cover_front_book_name = 0;
	if ($cover_front_author_name == 'on') $cover_front_author_name = 1; else $cover_front_author_name = 0;
	if ($cover_front_cover_photo == 'on') $cover_front_cover_photo = 1; else $cover_front_cover_photo = 0;
	if ($cover_front_cover_photo_accept == 'on') $cover_front_cover_photo_accept = 1; else $cover_front_cover_photo_accept = 0;
	if ($cover_front_logo_dimension == 'on') $cover_front_logo_dimension = 1; else $cover_front_logo_dimension = 0;
	if ($cover_front_logo_location == 'on') $cover_front_logo_location = 1; else $cover_front_logo_location = 0;
	if ($cover_front_logo_color == 'on') $cover_front_logo_color = 1; else $cover_front_logo_color = 0;
	if ($cover_front_serias_name == 'on') $cover_front_serias_name = 1; else $cover_front_serias_name = 0;
	if ($cover_front_press_number == 'on') $cover_front_press_number = 1; else $cover_front_press_number = 0;
	if ($cover_front_other_notes == 'on') $cover_front_other_notes = 1; else $cover_front_other_notes = 0;
	if ($cover_spine_book_name == 'on') $cover_spine_book_name = 1; else $cover_spine_book_name = 0;
	if ($cover_spine_author_name == 'on') $cover_spine_author_name = 1; else $cover_spine_author_name = 0;
	if ($cover_spine_spine_width == 'on') $cover_spine_spine_width = 1; else $cover_spine_spine_width = 0;
	if ($cover_spine_spine_color == 'on') $cover_spine_spine_color = 1; else $cover_spine_spine_color = 0;
	if ($cover_spine_spine_number == 'on') $cover_spine_spine_number = 1; else $cover_spine_spine_number = 0;
	if ($cover_spine_logo_dimension == 'on') $cover_spine_logo_dimension = 1; else $cover_spine_logo_dimension = 0;
	if ($cover_spine_logo_location == 'on') $cover_spine_logo_location = 1; else $cover_spine_logo_location = 0;
	if ($cover_spine_logo_color == 'on') $cover_spine_logo_color = 1; else $cover_spine_logo_color = 0;
	
	if ($cover_back_book_name == 'on') $cover_back_book_name = 1; else $cover_back_book_name = 0;
	if ($cover_back_author_name == 'on') $cover_back_author_name = 1; else $cover_back_author_name = 0;
	if ($cover_back_cover_photo == 'on') $cover_back_cover_photo = 1; else $cover_back_cover_photo = 0;
	if ($cover_back_cover_photo_accept == 'on') $cover_back_cover_photo_accept = 1; else $cover_back_cover_photo_accept = 0;
	if ($cover_back_logo_dimension == 'on') $cover_back_logo_dimension = 1; else $cover_back_logo_dimension = 0;
	if ($cover_back_logo_location == 'on') $cover_back_logo_location = 1; else $cover_back_logo_location = 0;
	if ($cover_back_logo_color == 'on') $cover_back_logo_color = 1; else $cover_back_logo_color = 0;
	if ($cover_back_publisher_infos == 'on') $cover_back_publisher_infos = 1; else $cover_back_publisher_infos = 0;
	if ($cover_back_publisher_adress == 'on') $cover_back_publisher_adress = 1; else $cover_back_publisher_adress = 0;
	if ($cover_back_publisher_tel == 'on') $cover_back_publisher_tel = 1; else $cover_back_publisher_tel = 0;
	if ($cover_back_publisher_fax == 'on') $cover_back_publisher_fax = 1; else $cover_back_publisher_fax = 0;
	if ($cover_back_publisher_site == 'on') $cover_back_publisher_site = 1; else $cover_back_publisher_site = 0;
	if ($cover_back_publisher_email == 'on') $cover_back_publisher_email = 1; else $cover_back_publisher_email = 0;
	if ($cover_back_publisher_order_info == 'on') $cover_back_publisher_order_info = 1; else $cover_back_publisher_order_info = 0;
	if ($cover_back_publisher_online_order == 'on') $cover_back_publisher_online_order = 1; else $cover_back_publisher_online_order = 0;
	if ($cover_back_text == 'on') $cover_back_text = 1; else $cover_back_text = 0;
	if ($cover_back_text_acccepted == 'on') $cover_back_text_acccepted = 1; else $cover_back_text_acccepted = 0;
	if ($cover_back_text_corrected == 'on') $cover_back_text_corrected = 1; else $cover_back_text_corrected = 0;
	if ($cover_back_isbn_number == 'on') $cover_back_isbn_number = 1; else $cover_back_isbn_number = 0;
	if ($cover_back_isbn_code == 'on') $cover_back_isbn_code = 1; else $cover_back_isbn_code = 0;
	if ($cover_back_isbn_code_tested == 'on') $cover_back_isbn_code_tested = 1; else $cover_back_isbn_code_tested = 0;
	if ($cover_back_streamer_area == 'on') $cover_back_streamer_area = 1; else $cover_back_streamer_area = 0;
	
	if ($bracket_concept == 'on') $bracket_concept = 1; else $bracket_concept = 0;
	if ($bracket_image == 'on') $bracket_image = 1; else $bracket_image = 0;
	if ($bracket_text == 'on') $bracket_text = 1; else $bracket_text = 0;
	if ($bracket_dimension == 'on') $bracket_dimension = 1; else $bracket_dimension = 0;
	if ($bracket_book_name == 'on') $bracket_book_name = 1; else $bracket_book_name = 0;
	if ($bracket_author_name == 'on') $bracket_author_name = 1; else $bracket_author_name = 0;
	if ($bracket_logo == 'on') $bracket_logo = 1; else $bracket_logo = 0;
	if ($bracket_publisher_name == 'on') $bracket_publisher_name = 1; else $bracket_publisher_name = 0;
	if ($bracket_order_info == 'on') $bracket_order_info = 1; else $bracket_order_info = 0;
	if ($bracket_online_order == 'on') $bracket_online_order = 1; else $bracket_online_order = 0;	
	
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
				cover_pre_serias = '".$cover_pre_serias."',
				cover_pre_serias_check = '".$cover_pre_serias_check."',
				cover_pre_dimensions = '".$cover_pre_dimensions."',
				cover_pre_color = '".$cover_pre_color."',
				cover_pre_boss_reported = '".$cover_pre_boss_reported."',
				cover_pre_boss_accepted = '".$cover_pre_boss_accepted."',
				cover_pre_author_reported = '".$cover_pre_author_reported."',
				cover_pre_author_accepted = '".$cover_pre_author_accepted."',
				cover_pre_tested = '".$cover_pre_tested."',
				cover_pre_testers = '".$cover_pre_testers."',
				cover_front_book_name = '".$cover_front_book_name."',
				cover_front_author_name = '".$cover_front_author_name."',
				cover_front_cover_photo = '".$cover_front_cover_photo."',
				cover_front_cover_photo_accept = '".$cover_front_cover_photo_accept."',
				cover_front_logo_dimension = '".$cover_front_logo_dimension."',
				cover_front_logo_location = '".$cover_front_logo_location."',
				cover_front_logo_color = '".$cover_front_logo_color."',
				cover_front_serias_name = '".$cover_front_serias_name."',
				cover_front_press_number = '".$cover_front_press_number."',
				cover_front_other_notes = '".$cover_front_other_notes."',
				cover_spine_book_name = '".$cover_spine_book_name."',
				cover_spine_author_name = '".$cover_spine_author_name."',
				cover_spine_spine_width = '".$cover_spine_spine_width."',
				cover_spine_spine_color = '".$cover_spine_spine_color."',
				cover_spine_spine_number = '".$cover_spine_spine_number."',
				cover_spine_logo_dimension = '".$cover_spine_logo_dimension."',
				cover_spine_logo_location = '".$cover_spine_logo_location."',
				cover_spine_logo_color = '".$cover_spine_logo_color."',
				cover_back_book_name = '".$cover_back_book_name."',
				cover_back_author_name = '".$cover_back_author_name."',
				cover_back_cover_photo = '".$cover_back_cover_photo."',
				cover_back_cover_photo_accept = '".$cover_back_cover_photo_accept."',
				cover_back_logo_dimension = '".$cover_back_logo_dimension."',
				cover_back_logo_location = '".$cover_back_logo_location."',
				cover_back_logo_color = '".$cover_back_logo_color."',
				cover_back_publisher_infos = '".$cover_back_publisher_infos."',
				cover_back_publisher_adress = '".$cover_back_publisher_adress."',
				cover_back_publisher_tel = '".$cover_back_publisher_tel."',
				cover_back_publisher_fax = '".$cover_back_publisher_fax."',
				cover_back_publisher_site = '".$cover_back_publisher_site."',
				cover_back_publisher_email = '".$cover_back_publisher_email."',
				cover_back_publisher_order_info = '".$cover_back_publisher_order_info."',
				cover_back_publisher_online_order = '".$cover_back_publisher_online_order."',
				cover_back_text = '".$cover_back_text."',
				cover_back_text_acccepted = '".$cover_back_text_acccepted."',
				cover_back_text_corrected = '".$cover_back_text_corrected."',
				cover_back_isbn_number = '".$cover_back_isbn_number."',
				cover_back_isbn_code = '".$cover_back_isbn_code."',
				cover_back_isbn_code_tested = '".$cover_back_isbn_code_tested."',
				cover_back_streamer_area = '".$cover_back_streamer_area."',
				bracket_direction = '".$bracket_direction."',
				bracket_concept = '".$bracket_concept."',
				bracket_image = '".$bracket_image."',
				bracket_text = '".$bracket_text."',
				bracket_dimension = '".$bracket_dimension."',
				bracket_book_name = '".$bracket_book_name."',
				bracket_author_name = '".$bracket_author_name."',
				bracket_logo = '".$bracket_logo."',
				bracket_publisher_name = '".$bracket_publisher_name."',
				bracket_order_info = '".$bracket_order_info."',
				bracket_online_order = '".$bracket_online_order."',
				changetar = '".$changetar."'
			WHERE book_id = '".$book_id."'
			;";
			//addslashes($SORGU_urun);
			//echo '<pre>'.$SORGU_urun.'</pre>';
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
		book_name,
		cover_pre_serias,
		cover_pre_serias_check,
		cover_pre_color,
		cover_pre_dimensions,
		cover_pre_boss_reported,
		cover_pre_boss_accepted,
		cover_pre_author_reported,
		cover_pre_author_accepted,
		cover_pre_tested,
		cover_pre_testers,
		cover_front_book_name,
		cover_front_author_name,
		cover_front_cover_photo,
		cover_front_cover_photo_accept,
		cover_front_logo_dimension,
		cover_front_logo_location,
		cover_front_logo_color,
		cover_front_serias_name,
		cover_front_press_number,
		cover_front_other_notes,
		cover_spine_book_name,
		cover_spine_author_name,
		cover_spine_spine_width,
		cover_spine_spine_color,
		cover_spine_spine_number,
		cover_spine_logo_dimension,
		cover_spine_logo_location,
		cover_spine_logo_color,
		cover_back_book_name,
		cover_back_author_name,
		cover_back_cover_photo,
		cover_back_cover_photo_accept,
		cover_back_logo_dimension,
		cover_back_logo_location,
		cover_back_logo_color,
		cover_back_publisher_infos,
		cover_back_publisher_adress,
		cover_back_publisher_tel,
		cover_back_publisher_fax,
		cover_back_publisher_site,
		cover_back_publisher_email,
		cover_back_publisher_order_info,
		cover_back_publisher_online_order,
		cover_back_text,
		cover_back_text_acccepted,
		cover_back_text_corrected,
		cover_back_isbn_number,
		cover_back_isbn_code,
		cover_back_isbn_code_tested,
		cover_back_streamer_area,
		bracket_direction,
		bracket_concept,
		bracket_image,
		bracket_text,
		bracket_dimension,
		bracket_book_name,
		bracket_author_name,
		bracket_logo,
		bracket_publisher_name,
		bracket_order_info,
		bracket_online_order
	FROM pco_book 
	WHERE book_id = "'.$book_id.'";';
	// echo '<pre>'.$SORGU_cumle.'</pre>';
$SORGU_sonuc = mysql_query($SORGU_cumle);
$bulunanadet = mysql_num_rows($SORGU_sonuc);

//mizanpaj deðerleri oluþturuluyor
//$book_id = mysql_result($SORGU_sonuc,0,"book_id");
$book_name = mysql_result($SORGU_sonuc,0,"book_name");
$cover_pre_serias = mysql_result($SORGU_sonuc,0,"cover_pre_serias");
$cover_pre_serias_check = mysql_result($SORGU_sonuc,0,"cover_pre_serias_check");
$cover_pre_color = mysql_result($SORGU_sonuc,0,"cover_pre_color");
$cover_pre_dimensions = mysql_result($SORGU_sonuc,0,"cover_pre_dimensions");
$cover_pre_boss_reported = mysql_result($SORGU_sonuc,0,"cover_pre_boss_reported");
$cover_pre_boss_accepted = mysql_result($SORGU_sonuc,0,"cover_pre_boss_accepted");
$cover_pre_author_reported = mysql_result($SORGU_sonuc,0,"cover_pre_author_reported");
$cover_pre_author_accepted = mysql_result($SORGU_sonuc,0,"cover_pre_author_accepted");
$cover_pre_tested = mysql_result($SORGU_sonuc,0,"cover_pre_tested");
$cover_pre_testers = mysql_result($SORGU_sonuc,0,"cover_pre_testers");
$cover_front_book_name = mysql_result($SORGU_sonuc,0,"cover_front_book_name");
$cover_front_author_name = mysql_result($SORGU_sonuc,0,"cover_front_author_name");
$cover_front_cover_photo = mysql_result($SORGU_sonuc,0,"cover_front_cover_photo");
$cover_front_cover_photo_accept = mysql_result($SORGU_sonuc,0,"cover_front_cover_photo_accept");
$cover_front_logo_dimension = mysql_result($SORGU_sonuc,0,"cover_front_logo_dimension");
$cover_front_logo_location = mysql_result($SORGU_sonuc,0,"cover_front_logo_location");
$cover_front_logo_color = mysql_result($SORGU_sonuc,0,"cover_front_logo_color");
$cover_front_serias_name = mysql_result($SORGU_sonuc,0,"cover_front_serias_name");
$cover_front_press_number = mysql_result($SORGU_sonuc,0,"cover_front_press_number");
$cover_front_other_notes = mysql_result($SORGU_sonuc,0,"cover_front_other_notes");
$cover_spine_book_name = mysql_result($SORGU_sonuc,0,"cover_spine_book_name");
$cover_spine_author_name = mysql_result($SORGU_sonuc,0,"cover_spine_author_name");
$cover_spine_spine_width = mysql_result($SORGU_sonuc,0,"cover_spine_spine_width");
$cover_spine_spine_color = mysql_result($SORGU_sonuc,0,"cover_spine_spine_color");
$cover_spine_spine_number = mysql_result($SORGU_sonuc,0,"cover_spine_spine_number");
$cover_spine_logo_dimension = mysql_result($SORGU_sonuc,0,"cover_spine_logo_dimension");
$cover_spine_logo_location = mysql_result($SORGU_sonuc,0,"cover_spine_logo_location");
$cover_spine_logo_color = mysql_result($SORGU_sonuc,0,"cover_spine_logo_color");

$cover_back_book_name = mysql_result($SORGU_sonuc,0,"cover_back_book_name");
$cover_back_author_name = mysql_result($SORGU_sonuc,0,"cover_back_author_name");
$cover_back_cover_photo = mysql_result($SORGU_sonuc,0,"cover_back_cover_photo");
$cover_back_cover_photo_accept = mysql_result($SORGU_sonuc,0,"cover_back_cover_photo_accept");
$cover_back_logo_dimension = mysql_result($SORGU_sonuc,0,"cover_back_logo_dimension");
$cover_back_logo_location = mysql_result($SORGU_sonuc,0,"cover_back_logo_location");
$cover_back_logo_color = mysql_result($SORGU_sonuc,0,"cover_back_logo_color");
$cover_back_publisher_infos = mysql_result($SORGU_sonuc,0,"cover_back_publisher_infos");
$cover_back_publisher_adress = mysql_result($SORGU_sonuc,0,"cover_back_publisher_adress");
$cover_back_publisher_tel = mysql_result($SORGU_sonuc,0,"cover_back_publisher_tel");
$cover_back_publisher_fax = mysql_result($SORGU_sonuc,0,"cover_back_publisher_fax");
$cover_back_publisher_site = mysql_result($SORGU_sonuc,0,"cover_back_publisher_site");
$cover_back_publisher_email = mysql_result($SORGU_sonuc,0,"cover_back_publisher_email");
$cover_back_publisher_order_info = mysql_result($SORGU_sonuc,0,"cover_back_publisher_order_info");
$cover_back_publisher_online_order = mysql_result($SORGU_sonuc,0,"cover_back_publisher_online_order");
$cover_back_text = mysql_result($SORGU_sonuc,0,"cover_back_text");
$cover_back_text_acccepted = mysql_result($SORGU_sonuc,0,"cover_back_text_acccepted");
$cover_back_text_corrected = mysql_result($SORGU_sonuc,0,"cover_back_text_corrected");
$cover_back_isbn_number = mysql_result($SORGU_sonuc,0,"cover_back_isbn_number");
$cover_back_isbn_code = mysql_result($SORGU_sonuc,0,"cover_back_isbn_code");
$cover_back_isbn_code_tested = mysql_result($SORGU_sonuc,0,"cover_back_isbn_code_tested");
$cover_back_streamer_area = mysql_result($SORGU_sonuc,0,"cover_back_streamer_area");

$bracket_direction = mysql_result($SORGU_sonuc,0,"bracket_direction");
$bracket_concept = mysql_result($SORGU_sonuc,0,"bracket_concept");
$bracket_image = mysql_result($SORGU_sonuc,0,"bracket_image");
$bracket_text = mysql_result($SORGU_sonuc,0,"bracket_text");
$bracket_dimension = mysql_result($SORGU_sonuc,0,"bracket_dimension");
$bracket_book_name = mysql_result($SORGU_sonuc,0,"bracket_book_name");
$bracket_author_name = mysql_result($SORGU_sonuc,0,"bracket_author_name");
$bracket_logo = mysql_result($SORGU_sonuc,0,"bracket_logo");
$bracket_publisher_name = mysql_result($SORGU_sonuc,0,"bracket_publisher_name");
$bracket_order_info = mysql_result($SORGU_sonuc,0,"bracket_order_info");
$bracket_online_order = mysql_result($SORGU_sonuc,0,"bracket_online_order");

//metin gelen alanlar
$cover_pre_testers = stripslashes($cover_pre_testers);

//checkbox alanlarý dönüþtürülüyor
if ($cover_pre_serias == 1) $cover_pre_serias = 'checked="checked"'; 
if ($cover_pre_serias_check == 1) $cover_pre_serias_check = 'checked="checked"'; 
if ($cover_pre_dimensions == 1) $cover_pre_dimensions = 'checked="checked"'; 
if ($cover_pre_color == 1) $cover_pre_color = 'checked="checked"'; 
if ($cover_pre_boss_reported == 1) $cover_pre_boss_reported = 'checked="checked"'; 
if ($cover_pre_boss_accepted == 1) $cover_pre_boss_accepted = 'checked="checked"'; 
if ($cover_pre_author_reported == 1) $cover_pre_author_reported = 'checked="checked"'; 
if ($cover_pre_author_accepted == 1) $cover_pre_author_accepted = 'checked="checked"'; 
if ($cover_pre_tested == 1) $cover_pre_tested = 'checked="checked"';
if ($cover_front_book_name == 1) $cover_front_book_name = 'checked="checked"';
if ($cover_front_author_name == 1) $cover_front_author_name = 'checked="checked"';
if ($cover_front_cover_photo == 1) $cover_front_cover_photo = 'checked="checked"';
if ($cover_front_cover_photo_accept == 1) $cover_front_cover_photo_accept = 'checked="checked"';
if ($cover_front_logo_dimension == 1) $cover_front_logo_dimension = 'checked="checked"';
if ($cover_front_logo_location == 1) $cover_front_logo_location = 'checked="checked"';
if ($cover_front_logo_color == 1) $cover_front_logo_color = 'checked="checked"';
if ($cover_front_serias_name == 1) $cover_front_serias_name = 'checked="checked"';
if ($cover_front_press_number == 1) $cover_front_press_number = 'checked="checked"';
if ($cover_front_other_notes == 1) $cover_front_other_notes = 'checked="checked"';
if ($cover_spine_book_name == 1) $cover_spine_book_name = 'checked="checked"';
if ($cover_spine_author_name == 1) $cover_spine_author_name = 'checked="checked"';
if ($cover_spine_spine_width == 1) $cover_spine_spine_width = 'checked="checked"';
if ($cover_spine_spine_color == 1) $cover_spine_spine_color = 'checked="checked"';
if ($cover_spine_spine_number == 1) $cover_spine_spine_number = 'checked="checked"';
if ($cover_spine_logo_dimension == 1) $cover_spine_logo_dimension = 'checked="checked"';
if ($cover_spine_logo_location == 1) $cover_spine_logo_location = 'checked="checked"';
if ($cover_spine_logo_color == 1) $cover_spine_logo_color = 'checked="checked"';
if ($cover_back_book_name == 1) $cover_back_book_name = 'checked="checked"';
if ($cover_back_author_name == 1) $cover_back_author_name = 'checked="checked"';
if ($cover_back_cover_photo == 1) $cover_back_cover_photo = 'checked="checked"';
if ($cover_back_cover_photo_accept == 1) $cover_back_cover_photo_accept = 'checked="checked"';
if ($cover_back_logo_dimension == 1) $cover_back_logo_dimension = 'checked="checked"';
if ($cover_back_logo_location == 1) $cover_back_logo_location = 'checked="checked"';
if ($cover_back_logo_color == 1) $cover_back_logo_color = 'checked="checked"';
if ($cover_back_publisher_infos == 1) $cover_back_publisher_infos = 'checked="checked"';
if ($cover_back_publisher_adress == 1) $cover_back_publisher_adress = 'checked="checked"';
if ($cover_back_publisher_tel == 1) $cover_back_publisher_tel = 'checked="checked"';
if ($cover_back_publisher_fax == 1) $cover_back_publisher_fax = 'checked="checked"';
if ($cover_back_publisher_site == 1) $cover_back_publisher_site = 'checked="checked"';
if ($cover_back_publisher_email == 1) $cover_back_publisher_email = 'checked="checked"';
if ($cover_back_publisher_order_info == 1) $cover_back_publisher_order_info = 'checked="checked"';
if ($cover_back_publisher_online_order == 1) $cover_back_publisher_online_order = 'checked="checked"';
if ($cover_back_text == 1) $cover_back_text = 'checked="checked"';
if ($cover_back_text_acccepted == 1) $cover_back_text_acccepted = 'checked="checked"';
if ($cover_back_text_corrected == 1) $cover_back_text_corrected = 'checked="checked"';
if ($cover_back_isbn_number == 1) $cover_back_isbn_number = 'checked="checked"';
if ($cover_back_isbn_code == 1) $cover_back_isbn_code = 'checked="checked"';
if ($cover_back_isbn_code_tested == 1) $cover_back_isbn_code_tested = 'checked="checked"';
if ($cover_back_streamer_area == 1) $cover_back_streamer_area = 'checked="checked"';

if ($bracket_concept == 1) $bracket_concept = 'checked="checked"';
if ($bracket_image == 1) $bracket_image = 'checked="checked"';
if ($bracket_text == 1) $bracket_text = 'checked="checked"';
if ($bracket_dimension == 1) $bracket_dimension = 'checked="checked"';
if ($bracket_book_name == 1) $bracket_book_name = 'checked="checked"';
if ($bracket_author_name == 1) $bracket_author_name = 'checked="checked"';
if ($bracket_logo == 1) $bracket_logo = 'checked="checked"';
if ($bracket_publisher_name == 1) $bracket_publisher_name = 'checked="checked"';
if ($bracket_order_info == 1) $bracket_order_info = 'checked="checked"';
if ($bracket_online_order == 1) $bracket_online_order = 'checked="checked"';

//metin geldiði için temizlenmesi gereken alanlar
$book_name = stripslashes($book_name);

?>

<h1>Proje Düzenle &raquo; <?php echo $book_name?></h1>

<br>
<div>
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>">Baþlangýç</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=disisler">Dýþ Ýþler</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=mizanpaj">Mizanpaj Kontrol</a> &raquo; 
<a class="button1" href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=kapak">Kapak Kontrol</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=baski">Baský Ýþlemleri</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=yedek">Yedeklemeler</a>
</div>
<br>

<?php echo $islem_bilgisi?>

<form name="projeform" action="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=kapak" method="POST">
<input type="hidden" name="menu" value="projeler">
<input type="hidden" name="sub" value="kapak">
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
						GENEL ÝÞLEMLER
					</th>
				</tr>
				<tr>
					<td width="230">Kapak serisi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;
						<select style="width: 150px;" name="cover_pre_serias">
						<option value="<?php echo $cover_pre_serias ?>"> <?php echo $array_mizanpaj_kapaktipleri[$cover_pre_serias]?></option>
						<?php
						foreach ($array_mizanpaj_kapaktipleri as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Seri uyumluluðu kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_pre_serias_check" <?php echo $cover_pre_serias_check?>>
					</td>
				</tr>
				<tr>
					<td>Kapak ebadý kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_pre_dimensions" <?php echo $cover_pre_dimensions?>>
					</td>
				</tr>
				<tr>
					<td>Renkler kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_pre_color" <?php echo $cover_pre_color?>>
					</td>
				</tr>
				<tr class="col1">
					<th colspan="3">
						ÖN ÝÞLEMLER / KAPAK ÇALIÞMALARI
					</th>
				</tr>
				<tr>
					<td>Yöneticilere ve gerekli kiþilere iletildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_pre_boss_reported" <?php echo $cover_pre_boss_reported?>>
					</td>
				</tr>
				<tr>
					<td>Yöneticiler ve gerekli kiþilerce beðenildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_pre_boss_accepted" <?php echo $cover_pre_boss_accepted?>>
					</td>
				</tr>
				<tr>
					<td>Yazarýna iletildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_pre_author_reported" <?php echo $cover_pre_author_reported?>>
					</td>
				</tr>
				<tr>
					<td>Yazarý tarafýndan beðenildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_pre_author_accepted" <?php echo $cover_pre_author_accepted?>>
					</td>
				</tr>
				<tr>
					<td>Müþteri gözüyle test edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_pre_tested" <?php echo $cover_pre_tested?>>
					</td>
				</tr>
				<tr>
					<td>Müþteri gözüyle test edenler</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input style="width: 150px;" type="text" name="cover_pre_testers" value="<?php echo $cover_pre_testers?>">
					</td>
				</tr>
				<tr class="col1">
					<th colspan="3">
						ÖN KAPAK 
					</th>
				</tr>
				<tr>
					<td>Kitap adý kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_front_book_name" <?php echo $cover_front_book_name?>>
					</td>
				</tr>
				<tr>
					<td>Yazar adý kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_front_author_name" <?php echo $cover_front_author_name?>>
					</td>
				</tr>
				<tr>
					<td>Kapak resmi kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_front_cover_photo" <?php echo $cover_front_cover_photo?>>
					</td>
				</tr>
				<tr>
					<td>Kapak resmi uyumu kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_front_cover_photo_accept" <?php echo $cover_front_cover_photo_accept?>>
					</td>
				</tr>
				<tr>
					<td>Logonun ebatý kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_front_logo_dimension" <?php echo $cover_front_logo_dimension?>>
					</td>
				</tr>
				<tr>
					<td>Logonun yeri kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_front_logo_location" <?php echo $cover_front_logo_location?>>
					</td>
				</tr>
				<tr>
					<td>Logonun renk uyumu kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_front_logo_color" <?php echo $cover_front_logo_color?>>
					</td>
				</tr>
				<tr>
					<td>Seri adý kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_front_serias_name" <?php echo $cover_front_serias_name?>>
					</td>
				</tr>
				<tr>
					<td>Baský sayýsý kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_front_press_number" <?php echo $cover_front_press_number?>>
					</td>
				</tr>
				<tr>
					<td>Diðer notlar kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_front_other_notes" <?php echo $cover_front_other_notes?>>
					</td>
				</tr>
				<tr class="col1">
					<th colspan="3">
						SIRT KAPAK
					</th>
				</tr>
				<tr>
					<td>Yazýnýn yönü</td>
					<td>
					:&nbsp;&nbsp;&nbsp;
						<select style="width: 150px;" name="cover_spine_text_direction">
						<option value="<?php echo $cover_spine_text_direction ?>"> <?php echo $array_kapak_text_direction[$cover_spine_text_direction]?></option>
						<?php
						foreach ($array_kapak_text_direction as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Kitap adý kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_spine_book_name" <?php echo $cover_spine_book_name?>>
					</td>
				</tr>
				<tr>
					<td>Yazar adý kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_spine_author_name" <?php echo $cover_spine_author_name?>>
					</td>
				</tr>
				<tr>
					<td>Sýrt geniþliði kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_spine_spine_width" <?php echo $cover_spine_spine_width?>>
					</td>
				</tr>
				<tr>
					<td>Sýrt rengi kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_spine_spine_color" <?php echo $cover_spine_spine_color?>>
					</td>
				</tr>
				<tr>
					<td>Sýrt no / yayýn no kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_spine_spine_number" <?php echo $cover_spine_spine_number?>>
					</td>
				</tr>
				<tr>
					<td>Logonun ebatý kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_spine_logo_dimension" <?php echo $cover_spine_logo_dimension?>>
					</td>
				</tr>
				<tr>
					<td>Logonun yeri kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_spine_logo_location" <?php echo $cover_spine_logo_location?>>
					</td>
				</tr>
				<tr>
					<td>Logonun renk uyumu kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_spine_logo_color" <?php echo $cover_spine_logo_color?>>
					</td>
				</tr>
				</table>
		</td>
		<td valign="top">
			<table width="50%" cellspacing="5" border="0">
				<tr class="col1">
					<th colspan="3">
						ARKA KAPAK
					</th>
				</tr>
				<tr>
					<td width="230">Kitap adý kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_book_name" <?php echo $cover_back_book_name?>>
					</td>
				</tr>
				<tr>
					<td>Yazar adý kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_author_name" <?php echo $cover_back_author_name?>>
					</td>
				</tr>
				<tr>
					<td>Kapak resmi kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_cover_photo" <?php echo $cover_back_cover_photo?>>
					</td>
				</tr>
				<tr>
					<td>Kapak resmi uyumu kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_cover_photo_accept" <?php echo $cover_back_cover_photo_accept?>>
					</td>
				</tr>
				<tr>
					<td>Kogonun ebatý kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_logo_dimension" <?php echo $cover_back_logo_dimension?>>
					</td>
				</tr>
				<tr>
					<td>Logonun yeri kontrol edild</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_logo_location" <?php echo $cover_back_logo_location?>>
					</td>
				</tr>
				<tr>
					<td>Logonun renk uyumu kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_logo_color" <?php echo $cover_back_logo_color?>>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<br><hr>
					</td>
				</tr>
				<tr>
					<td>Yayýncý bilgileri kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_publisher_infos" <?php echo $cover_back_publisher_infos?>>
					</td>
				</tr>
				<tr>
					<td>Yayýncý adresi güncel</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_publisher_adress" <?php echo $cover_back_publisher_adress?>>
					</td>
				</tr>
				<tr>
					<td>Yayýncý telefon numarasý güncel</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_publisher_tel" <?php echo $cover_back_publisher_tel?>>
					</td>
				</tr>
				<tr>
					<td>Yayýncý fax numarasý güncel</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_publisher_fax" <?php echo $cover_back_publisher_fax?>>
					</td>
				</tr>
				<tr>
					<td>Yayýncý site adresi güncel</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_publisher_site" <?php echo $cover_back_publisher_site?>>
					</td>
				</tr>
				<tr>
					<td>Yayýncý eposta adresi güncel </td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_publisher_email" <?php echo $cover_back_publisher_email?>>
					</td>
				</tr>
				<tr>
					<td>Sipariþ için gerekli bilgiler güncel </td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_publisher_order_info" <?php echo $cover_back_publisher_order_info?>>
					</td>
				</tr>
				<tr>
					<td>Kitabýn online sipariþ adresi güncel </td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_publisher_online_order" <?php echo $cover_back_publisher_online_order?>>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<br><hr>
					</td>
				</tr>
				<tr>
					<td>Arka kapak yazýsý kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_text" <?php echo $cover_back_text?>>
					</td>
				</tr>
				<tr>
					<td>Arka kapak yazýsý kitabý temsil ediyor</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_text_acccepted" <?php echo $cover_back_text_acccepted?>>
					</td>
				</tr>
				<tr>
					<td>Arka kapak yazýsý tashih edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_text_corrected" <?php echo $cover_back_text_corrected?>>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<br><hr>
					</td>
				</tr>
				<tr>
					<td>Kitabýn ISBN numarasý kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_isbn_number" <?php echo $cover_back_isbn_number?>>
					</td>
				</tr>
				<tr>
					<td>Kitabýn ISBN kodu bu ürüne ait</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_isbn_code" <?php echo $cover_back_isbn_code?>>
					</td>
				</tr>
				<tr>
					<td>Kitabýn ISBN kodu cihazla test edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_isbn_code_tested" <?php echo $cover_back_isbn_code_tested?>>
					</td>
				</tr>
				<tr>
					<td>Kapakta bandrol alaný var </td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cover_back_streamer_area" <?php echo $cover_back_streamer_area?>>
					</td>
				</tr>
				<tr class="col1">
					<th colspan="3">
						AYRAÇ KONTROL
					</th>
				</tr>
				<tr>
					<td>Tasarým yönü</td>
					<td>
					:&nbsp;&nbsp;&nbsp;
						<select style="width: 150px;" name="bracket_direction">
						<option value="<?php echo $bracket_direction ?>"> <?php echo $array_kapak_ayrac_direction[$bracket_direction]?></option>
						<?php
						foreach ($array_kapak_ayrac_direction as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Tasarým kitapla uyumlu</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="bracket_concept" <?php echo $bracket_concept?>>
					</td>
				</tr>
				<tr>
					<td>Görsel doðru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="bracket_image" <?php echo $bracket_image?>>
					</td>
				</tr>
				<tr>
					<td>Metinler doðru </td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="bracket_text" <?php echo $bracket_text?>>
					</td>
				</tr>
				<tr>
					<td>Ebat doðru </td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="bracket_dimension" <?php echo $bracket_dimension?>>
					</td>
				</tr>
				<tr>
					<td>Kitap adý doðru </td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="bracket_book_name" <?php echo $bracket_book_name?>>
					</td>
				</tr>
				<tr>
					<td>Yazar adý doðru </td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="bracket_author_name" <?php echo $bracket_author_name?>>
					</td>
				</tr>
				<tr>
					<td>Yayýnevi logosu doðru </td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="bracket_logo" <?php echo $bracket_logo?>>
					</td>
				</tr>
				<tr>
					<td>Yayýnevi adý doðru </td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="bracket_publisher_name" <?php echo $bracket_publisher_name?>>
					</td>
				</tr>
				<tr>
					<td>Online sipariþ doðru </td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="bracket_order_info" <?php echo $bracket_order_info?>>
					</td>
				</tr>
				<tr>
					<td>Tel sipariþ doðru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="bracket_online_order" <?php echo $bracket_online_order?>>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
</div>