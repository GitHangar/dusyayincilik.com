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
	//varsay�lanlar
	$changetar = time();

	//metin gelen alanlar
	//mizanpaj
	$lc_text_font_alternative = addslashes(trim(strip_tags($_REQUEST["lc_text_font_alternative"])));
	$lc_text_size_alternative = addslashes(trim(strip_tags($_REQUEST["lc_text_size_alternative"])));
	$lc_text_height_alternative = addslashes(trim(strip_tags($_REQUEST["lc_text_height_alternative"])));

	//se�meli gelen alanlar
	//mizanpaj
	$lc_text_style = trim(strip_tags($_REQUEST["lc_text_style"]));
	$lc_paragraph_indent = trim(strip_tags($_REQUEST["lc_paragraph_indent"]));
	$lc_paging_style = trim(strip_tags($_REQUEST["lc_paging_style"]));

	$lc_text_font_select = trim(strip_tags($_REQUEST["lc_text_font_select"]));
	$lc_text_size_select = trim(strip_tags($_REQUEST["lc_text_size_select"]));
	$lc_text_height_select = trim(strip_tags($_REQUEST["lc_text_height_select"]));

	//checkbox alanlar� d�n��t�r�l�yor
	//mizanpaj
	$lc_dimension_accept = trim(strip_tags($_REQUEST["lc_dimension_accept"]));
	$lc_margins_accept = trim(strip_tags($_REQUEST["lc_margins_accept"]));
	$lc_paging_accept = trim(strip_tags($_REQUEST["lc_paging_accept"]));
	$lc_paragraph_indent_accept = trim(strip_tags($_REQUEST["lc_paragraph_indent_accept"]));
	$lc_text_style_accept = trim(strip_tags($_REQUEST["lc_text_style_accept"]));
	$lc_text_font_standart = trim(strip_tags($_REQUEST["lc_text_font_standart"]));
	$lc_text_font_accepted = trim(strip_tags($_REQUEST["lc_text_font_accepted"]));
	$lc_text_size_standart = trim(strip_tags($_REQUEST["lc_text_size_standart"]));
	$lc_text_size_accepted = trim(strip_tags($_REQUEST["lc_text_size_accepted"]));
	$lc_text_height_standart = trim(strip_tags($_REQUEST["lc_text_height_standart"]));
	$lc_text_height_accepted = trim(strip_tags($_REQUEST["lc_text_height_accepted"]));
	$lc_contents_standart = trim(strip_tags($_REQUEST["lc_contents_standart"]));
	$lc_contents_accepted = trim(strip_tags($_REQUEST["lc_contents_accepted"]));
	$lc_page_title_standart = trim(strip_tags($_REQUEST["lc_page_title_standart"]));
	$lc_page_title_accepted = trim(strip_tags($_REQUEST["lc_page_title_accepted"]));

	//checkbox ile gelen alanlar
	//jenerik
	$credits_outside_press_city = trim(strip_tags($_REQUEST["credits_outside_press_city"]));
	$credits_outside_press_year = trim(strip_tags($_REQUEST["credits_outside_press_year"]));

	$credits_publisher_name = trim(strip_tags($_REQUEST["credits_publisher_name"]));
	$credits_publishing_id = trim(strip_tags($_REQUEST["credits_publishing_id"]));
	$credits_serias_name = trim(strip_tags($_REQUEST["credits_serias_name"]));
	$credits_serias_id = trim(strip_tags($_REQUEST["credits_serias_id"]));
	$credits_author_www = trim(strip_tags($_REQUEST["credits_author_www"]));

	$credits_copyright = trim(strip_tags($_REQUEST["credits_copyright"]));

	$credits_layout = trim(strip_tags($_REQUEST["credits_layout"]));
	$credits_cover = trim(strip_tags($_REQUEST["credits_cover"]));
	$credits_press_and_tome = trim(strip_tags($_REQUEST["credits_press_and_tome"]));
	$credits_firstpress_id_and_time = trim(strip_tags($_REQUEST["credits_firstpress_id_and_time"]));
	$credits_lastpress_id_and_time = trim(strip_tags($_REQUEST["credits_lastpress_id_and_time"]));
	$credits_isbn_id = trim(strip_tags($_REQUEST["credits_isbn_id"]));

	$credits_editor = trim(strip_tags($_REQUEST["credits_editor"]));
	$credits_translator = trim(strip_tags($_REQUEST["credits_translator"]));
	$credits_prepaers = trim(strip_tags($_REQUEST["credits_prepaers"]));

	$credits_pulbilsher_adress = trim(strip_tags($_REQUEST["credits_pulbilsher_adress"]));
	$credits_pulbilsher_tel = trim(strip_tags($_REQUEST["credits_pulbilsher_tel"]));
	$credits_pulbilsher_fax = trim(strip_tags($_REQUEST["credits_pulbilsher_fax"]));
	$credits_pulbilsher_www = trim(strip_tags($_REQUEST["credits_pulbilsher_www"]));
	$credits_pulbilsher_email = trim(strip_tags($_REQUEST["credits_pulbilsher_email"]));
	$credits_order_info = trim(strip_tags($_REQUEST["credits_order_info"]));
	$credits_online_order = trim(strip_tags($_REQUEST["credits_online_order"]));

	$credits_inside_book_name = trim(strip_tags($_REQUEST["credits_inside_book_name"]));
	$credits_inside_author = trim(strip_tags($_REQUEST["credits_inside_author"]));
	$credits_inside_publisher_logo = trim(strip_tags($_REQUEST["credits_inside_publisher_logo"]));
	$credits_inside_publisher_name = trim(strip_tags($_REQUEST["credits_inside_publisher_name"]));	
	$credits_others_info = trim(strip_tags($_REQUEST["credits_others_info"]));	
	$cr_correction_accept = trim(strip_tags($_REQUEST["cr_correction_accept"]));
	$cr_correction_add = trim(strip_tags($_REQUEST["cr_correction_add"]));
	$cr_correction_check = trim(strip_tags($_REQUEST["cr_correction_check"]));

	//checkbox alanlar� d�n��t�r�l�yor
	//mizanpaj
	if ($lc_dimension_accept == 'on') $lc_dimension_accept = 1; else $lc_dimension_accept = 0;
	if ($lc_margins_accept == 'on') $lc_margins_accept = 1; else $lc_margins_accept = 0;

	if ($lc_paging_accept == 'on') $lc_paging_accept = 1; else $lc_paging_accept = 0;
	if ($lc_paragraph_indent_accept == 'on') $lc_paragraph_indent_accept = 1; else $lc_paragraph_indent_accept = 0;
	if ($lc_text_style_accept == 'on') $lc_text_style_accept = 1; else $lc_text_style_accept = 0;

	if ($lc_text_font_standart == 'on') $lc_text_font_standart = 1; else $lc_text_font_standart = 0;
	if ($lc_text_font_accepted == 'on') $lc_text_font_accepted = 1; else $lc_text_font_accepted = 0;
	if ($lc_text_size_standart == 'on') $lc_text_size_standart = 1; else $lc_text_size_standart = 0;
	if ($lc_text_size_accepted == 'on') $lc_text_size_accepted = 1; else $lc_text_size_accepted = 0;
	if ($lc_text_height_standart == 'on') $lc_text_height_standart = 1; else $lc_text_height_standart = 0;
	if ($lc_text_height_accepted == 'on') $lc_text_height_accepted = 1; else $lc_text_height_accepted = 0;

	if ($lc_contents_standart == 'on') $lc_contents_standart = 1; else $lc_contents_standart = 0;
	if ($lc_contents_accepted == 'on') $lc_contents_accepted = 1; else $lc_contents_accepted = 0;
	if ($lc_page_title_standart == 'on') $lc_page_title_standart = 1; else $lc_page_title_standart = 0;
	if ($lc_page_title_accepted == 'on') $lc_page_title_accepted = 1; else $lc_page_title_accepted = 0;

	//checkbox alanlar� d�n��t�r�l�yor
	//jenerik
	if ($credits_outside_press_city == 'on') $credits_outside_press_city = 1; else $credits_outside_press_city = 0;
	if ($credits_outside_press_year == 'on') $credits_outside_press_year = 1; else $credits_outside_press_year = 0;

	if ($credits_publisher_name == 'on') $credits_publisher_name = 1; else $credits_publisher_name = 0;
	if ($credits_publishing_id == 'on') $credits_publishing_id = 1; else $credits_publishing_id = 0;
	if ($credits_serias_name == 'on') $credits_serias_name = 1; else $credits_serias_name = 0;
	if ($credits_serias_id == 'on') $credits_serias_id = 1; else $credits_serias_id = 0;
	if ($credits_author_www == 'on') $credits_author_www = 1; else $credits_author_www = 0;
	
	if ($credits_copyright == 'on') $credits_copyright = 1; else $credits_copyright = 0;

	if ($credits_layout == 'on') $credits_layout = 1; else $credits_layout = 0;
	if ($credits_cover == 'on') $credits_cover = 1; else $credits_cover = 0;
	if ($credits_press_and_tome == 'on') $credits_press_and_tome = 1; else $credits_press_and_tome = 0;
	if ($credits_firstpress_id_and_time == 'on') $credits_firstpress_id_and_time = 1; else $credits_firstpress_id_and_time = 0;
	if ($credits_lastpress_id_and_time == 'on') $credits_lastpress_id_and_time = 1; else $credits_lastpress_id_and_time = 0;
	if ($credits_isbn_id == 'on') $credits_isbn_id = 1; else $credits_isbn_id = 0;

	if ($credits_editor == 'on') $credits_editor = 1; else $credits_editor = 0;
	if ($credits_translator == 'on') $credits_translator = 1; else $credits_translator = 0;
	if ($credits_prepaers == 'on') $credits_prepaers = 1; else $credits_prepaers = 0;

	if ($credits_pulbilsher_adress == 'on') $credits_pulbilsher_adress = 1; else $credits_pulbilsher_adress = 0;
	if ($credits_pulbilsher_tel == 'on') $credits_pulbilsher_tel = 1; else $credits_pulbilsher_tel = 0;
	if ($credits_pulbilsher_fax == 'on') $credits_pulbilsher_fax = 1; else $credits_pulbilsher_fax = 0;
	if ($credits_pulbilsher_www == 'on') $credits_pulbilsher_www = 1; else $credits_pulbilsher_www = 0;
	if ($credits_pulbilsher_email == 'on') $credits_pulbilsher_email = 1; else $credits_pulbilsher_email = 0;
	if ($credits_order_info == 'on') $credits_order_info = 1; else $credits_order_info = 0;
	if ($credits_online_order == 'on') $credits_online_order = 1; else $credits_online_order = 0;

	if ($credits_inside_book_name == 'on') $credits_inside_book_name = 1; else $credits_inside_book_name = 0;
	if ($credits_inside_author == 'on') $credits_inside_author = 1; else $credits_inside_author = 0;
	if ($credits_inside_publisher_logo  == 'on') $credits_inside_publisher_logo = 1; else $credits_inside_publisher_logo = 0;
	if ($credits_inside_publisher_name  == 'on') $credits_inside_publisher_name = 1; else $credits_inside_publisher_name = 0;
	if ($credits_others_info  == 'on') $credits_others_info = 1; else $credits_others_info = 0;
	if ($cr_correction_accept == 'on') $cr_correction_accept = 1; else $cr_correction_accept = 0;
	if ($cr_correction_add  == 'on') $cr_correction_add = 1; else $cr_correction_add = 0;
	if ($cr_correction_check  == 'on') $cr_correction_check = 1; else $cr_correction_check = 0;


	//
	//hata kontrol�
	//
	/*
 	if ( strlen($book_name) < 2 or !eregi("[[:alpha:]]",$book_name) )
	$islem_bilgisi = '<br>Proje Ad� alan�n� bo� b�r�kmay�n�z';

	if ( strlen($book_author) < 2 or !eregi("[[:alpha:]]",$book_author) )
	$islem_bilgisi .= '<br>Yazar Ad� alan�n� bo� b�rakmay�n�z';
	 */	
	if ($islem_bilgisi == '')
	{
		$SORGU_urun = "
			UPDATE pco_book 
			SET 
				lc_dimension_accept = '".$lc_dimension_accept."',
				lc_margins_accept = '".$lc_margins_accept."',
				lc_paging_style = '".$lc_paging_style."',
				lc_paging_accept = '".$lc_paging_accept."',
				lc_paragraph_indent = '".$lc_paragraph_indent."',
				lc_paragraph_indent_accept = '".$lc_paragraph_indent_accept."',
				lc_text_style = '".$lc_text_style."',
				lc_text_style_accept = '".$lc_text_style_accept."',
				lc_text_font_select = '".$lc_text_font_select."',
				lc_text_font_standart = '".$lc_text_font_standart."',
				lc_text_font_alternative = '".$lc_text_font_alternative."',
				lc_text_font_accepted = '".$lc_text_font_accepted."',
				lc_text_size_select = '".$lc_text_size_select."',
				lc_text_size_standart = '".$lc_text_size_standart."',
				lc_text_size_alternative = '".$lc_text_size_alternative."',
				lc_text_size_accepted = '".$lc_text_size_accepted."',
				lc_text_height_select = '".$lc_text_height_select."',
				lc_text_height_standart = '".$lc_text_height_standart."',
				lc_text_height_alternative = '".$lc_text_height_alternative."',
				lc_text_height_accepted = '".$lc_text_height_accepted."',
				lc_contents_standart = '".$lc_contents_standart."',
				lc_contents_accepted = '".$lc_contents_accepted."',
				lc_page_title_standart = '".$lc_page_title_standart."',
				lc_page_title_accepted = '".$lc_page_title_accepted."',
				credits_outside_press_city = '".$credits_outside_press_city."',
				credits_outside_press_year = '".$credits_outside_press_year."',
				credits_publisher_name = '".$credits_publisher_name."',
				credits_publishing_id = '".$credits_publishing_id."',
				credits_serias_name = '".$credits_serias_name."',
				credits_serias_id = '".$credits_serias_id."',
				credits_author_www = '".$credits_author_www."',
				credits_copyright = '".$credits_copyright."',
				credits_layout = '".$credits_layout."',
				credits_cover = '".$credits_cover."',
				credits_press_and_tome = '".$credits_press_and_tome."',
				credits_firstpress_id_and_time = '".$credits_firstpress_id_and_time."',
				credits_lastpress_id_and_time = '".$credits_lastpress_id_and_time."',
				credits_isbn_id = '".$credits_isbn_id."',
				credits_editor = '".$credits_editor."',
				credits_translator = '".$credits_translator."',
				credits_prepaers = '".$credits_prepaers."',
				credits_pulbilsher_adress = '".$credits_pulbilsher_adress."',
				credits_pulbilsher_tel = '".$credits_pulbilsher_tel."',
				credits_pulbilsher_fax = '".$credits_pulbilsher_fax."',
				credits_pulbilsher_www = '".$credits_pulbilsher_www."',
				credits_pulbilsher_email = '".$credits_pulbilsher_email."',
				credits_order_info = '".$credits_order_info."',
				credits_online_order = '".$credits_online_order."',
				credits_inside_book_name = '".$credits_inside_book_name."',
				credits_inside_author = '".$credits_inside_author."',
				credits_inside_publisher_logo = '".$credits_inside_publisher_logo."',
				credits_inside_publisher_name = '".$credits_inside_publisher_name."',
				credits_others_info = '".$credits_others_info."',
				cr_correction_accept = '".$cr_correction_accept."',
				cr_correction_add = '".$cr_correction_add."',
				cr_correction_check = '".$cr_correction_check."',
				changetar = '".$changetar."'
			WHERE book_id = '".$book_id."'
			;";
			//addslashes($SORGU_urun);
			// echo '<pre>'.$SORGU_urun.'</pre>';
		$SORGU_sonuc = mysql_query($SORGU_urun);
		$etkilenen = mysql_affected_rows();
		$islem_bilgisi = '<div class="successbox">Proje Bilgileri G�ncellenmi�tir.</div>';
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
		lc_dimension_accept,
		lc_margins_accept,
		lc_paging_style,
		lc_paging_accept,
		lc_paragraph_indent,
		lc_paragraph_indent_accept,
		lc_text_style,
		lc_text_style_accept,
		lc_text_font_select,
		lc_text_font_standart,
		lc_text_font_alternative,
		lc_text_font_accepted,
		lc_text_size_select,
		lc_text_size_standart,
		lc_text_size_alternative,
		lc_text_size_accepted,
		lc_text_height_select,
		lc_text_height_standart,
		lc_text_height_alternative,
		lc_text_height_accepted,
		lc_contents_standart,
		lc_contents_accepted,
		lc_page_title_standart,
		lc_page_title_accepted,
		credits_outside_press_city,
		credits_outside_press_year,
		credits_publisher_name,
		credits_publishing_id,
		credits_serias_name,
		credits_serias_id,
		credits_author_www,
		credits_copyright,
		credits_layout,
		credits_cover,
		credits_press_and_tome,
		credits_firstpress_id_and_time,
		credits_lastpress_id_and_time,
		credits_isbn_id,
		credits_editor,
		credits_translator,
		credits_prepaers,
		credits_pulbilsher_adress,
		credits_pulbilsher_tel,
		credits_pulbilsher_fax,
		credits_pulbilsher_www,
		credits_pulbilsher_email,
		credits_order_info,
		credits_online_order,
		credits_inside_book_name,
		credits_inside_author,
		credits_inside_publisher_logo,
		credits_inside_publisher_name,
		credits_others_info,
		cr_correction_accept,
		cr_correction_add,
		cr_correction_check
	FROM pco_book 
	WHERE book_id = "'.$book_id.'";';
	// echo '<pre>'.$SORGU_cumle.'</pre>';
$SORGU_sonuc = mysql_query($SORGU_cumle);
$bulunanadet = mysql_num_rows($SORGU_sonuc);

//mizanpaj de�erleri olu�turuluyor
//$book_id = mysql_result($SORGU_sonuc,0,"book_id");
$book_name = mysql_result($SORGU_sonuc,0,"book_name");
$lc_dimension_accept = mysql_result($SORGU_sonuc,0,"lc_dimension_accept");
$lc_margins_accept = mysql_result($SORGU_sonuc,0,"lc_margins_accept");
$lc_paging_style = mysql_result($SORGU_sonuc,0,"lc_paging_style");
$lc_paging_accept = mysql_result($SORGU_sonuc,0,"lc_paging_accept");
$lc_paragraph_indent = mysql_result($SORGU_sonuc,0,"lc_paragraph_indent");
$lc_paragraph_indent_accept = mysql_result($SORGU_sonuc,0,"lc_paragraph_indent_accept");
$lc_text_style = mysql_result($SORGU_sonuc,0,"lc_text_style");
$lc_text_style_accept = mysql_result($SORGU_sonuc,0,"lc_text_style_accept");
$lc_text_font_select = mysql_result($SORGU_sonuc,0,"lc_text_font_select");
$lc_text_font_standart = mysql_result($SORGU_sonuc,0,"lc_text_font_standart");
$lc_text_font_alternative = mysql_result($SORGU_sonuc,0,"lc_text_font_alternative");
$lc_text_font_accepted = mysql_result($SORGU_sonuc,0,"lc_text_font_accepted");
$lc_text_size_select = mysql_result($SORGU_sonuc,0,"lc_text_size_select");
$lc_text_size_standart = mysql_result($SORGU_sonuc,0,"lc_text_size_standart");
$lc_text_size_alternative = mysql_result($SORGU_sonuc,0,"lc_text_size_alternative");
$lc_text_size_accepted = mysql_result($SORGU_sonuc,0,"lc_text_size_accepted");
$lc_text_height_select = mysql_result($SORGU_sonuc,0,"lc_text_height_select");
$lc_text_height_standart = mysql_result($SORGU_sonuc,0,"lc_text_height_standart");
$lc_text_height_alternative = mysql_result($SORGU_sonuc,0,"lc_text_height_alternative");
$lc_text_height_accepted = mysql_result($SORGU_sonuc,0,"lc_text_height_accepted");
$lc_contents_standart = mysql_result($SORGU_sonuc,0,"lc_contents_standart");
$lc_contents_accepted = mysql_result($SORGU_sonuc,0,"lc_contents_accepted");
$lc_page_title_standart = mysql_result($SORGU_sonuc,0,"lc_page_title_standart");
$lc_page_title_accepted = mysql_result($SORGU_sonuc,0,"lc_page_title_accepted");

//jenerik de�erleri olu�turuluyor
$credits_outside_press_city = mysql_result($SORGU_sonuc,0,"credits_outside_press_city");
$credits_outside_press_year = mysql_result($SORGU_sonuc,0,"credits_outside_press_year");
$credits_publisher_name = mysql_result($SORGU_sonuc,0,"credits_publisher_name");
$credits_publishing_id = mysql_result($SORGU_sonuc,0,"credits_publishing_id");
$credits_serias_name = mysql_result($SORGU_sonuc,0,"credits_serias_name");
$credits_serias_id = mysql_result($SORGU_sonuc,0,"credits_serias_id");
$credits_author_www = mysql_result($SORGU_sonuc,0,"credits_author_www");
$credits_copyright = mysql_result($SORGU_sonuc,0,"credits_copyright");
$credits_layout = mysql_result($SORGU_sonuc,0,"credits_layout");
$credits_cover = mysql_result($SORGU_sonuc,0,"credits_cover");
$credits_press_and_tome = mysql_result($SORGU_sonuc,0,"credits_press_and_tome");
$credits_firstpress_id_and_time = mysql_result($SORGU_sonuc,0,"credits_firstpress_id_and_time");
$credits_lastpress_id_and_time = mysql_result($SORGU_sonuc,0,"credits_lastpress_id_and_time");
$credits_isbn_id = mysql_result($SORGU_sonuc,0,"credits_isbn_id");
$credits_editor = mysql_result($SORGU_sonuc,0,"credits_editor");
$credits_translator = mysql_result($SORGU_sonuc,0,"credits_translator");
$credits_prepaers = mysql_result($SORGU_sonuc,0,"credits_prepaers");
$credits_pulbilsher_adress = mysql_result($SORGU_sonuc,0,"credits_pulbilsher_adress");
$credits_pulbilsher_tel = mysql_result($SORGU_sonuc,0,"credits_pulbilsher_tel");
$credits_pulbilsher_fax = mysql_result($SORGU_sonuc,0,"credits_pulbilsher_fax");
$credits_pulbilsher_www = mysql_result($SORGU_sonuc,0,"credits_pulbilsher_www");
$credits_pulbilsher_email = mysql_result($SORGU_sonuc,0,"credits_pulbilsher_email");
$credits_order_info = mysql_result($SORGU_sonuc,0,"credits_order_info");
$credits_online_order = mysql_result($SORGU_sonuc,0,"credits_online_order");
$credits_inside_book_name = mysql_result($SORGU_sonuc,0,"credits_inside_book_name");
$credits_inside_author = mysql_result($SORGU_sonuc,0,"credits_inside_author");
$credits_inside_publisher_logo = mysql_result($SORGU_sonuc,0,"credits_inside_publisher_logo");
$credits_inside_publisher_name = mysql_result($SORGU_sonuc,0,"credits_inside_publisher_name");	
$credits_others_info = mysql_result($SORGU_sonuc,0,"credits_others_info");	
$cr_correction_accept = mysql_result($SORGU_sonuc,0,"cr_correction_accept");
$cr_correction_add = mysql_result($SORGU_sonuc,0,"cr_correction_add");
$cr_correction_check = mysql_result($SORGU_sonuc,0,"cr_correction_check");

//metin gelen alanlar
//mizanpaj
$lc_text_font_alternative = stripslashes($lc_text_font_alternative);
$lc_text_size_alternative = stripslashes($lc_text_size_alternative);
$lc_text_height_alternative = stripslashes($lc_text_height_alternative);

//checkbox alanlar� d�n��t�r�l�yor
//mizanpaj
if ($lc_dimension_accept == 1) $lc_dimension_accept = 'checked="checked"'; 
if ($lc_margins_accept == 1) $lc_margins_accept = 'checked="checked"'; 
if ($lc_paging_accept == 1) $lc_paging_accept = 'checked="checked"'; 
if ($lc_paragraph_indent_accept == 1) $lc_paragraph_indent_accept = 'checked="checked"'; 
if ($lc_text_style_accept == 1) $lc_text_style_accept = 'checked="checked"'; 
if ($lc_text_font_standart == 1) $lc_text_font_standart = 'checked="checked"'; 
if ($lc_text_font_accepted == 1) $lc_text_font_accepted = 'checked="checked"'; 
if ($lc_text_size_standart == 1) $lc_text_size_standart = 'checked="checked"'; 
if ($lc_text_size_accepted == 1) $lc_text_size_accepted = 'checked="checked"'; 
if ($lc_text_height_standart == 1) $lc_text_height_standart = 'checked="checked"'; 
if ($lc_text_height_accepted == 1) $lc_text_height_accepted = 'checked="checked"'; 
if ($lc_contents_standart == 1) $lc_contents_standart = 'checked="checked"'; 
if ($lc_contents_accepted == 1) $lc_contents_accepted = 'checked="checked"'; 
if ($lc_page_title_standart == 1) $lc_page_title_standart = 'checked="checked"'; 
if ($lc_page_title_accepted == 1) $lc_page_title_accepted = 'checked="checked"'; 

//jenerik
if ($credits_outside_press_city == 1) $credits_outside_press_city = 'checked="checked"'; 
if ($credits_outside_press_year == 1) $credits_outside_press_year = 'checked="checked"'; 
if ($credits_publisher_name == 1) $credits_publisher_name = 'checked="checked"'; 
if ($credits_publishing_id == 1) $credits_publishing_id = 'checked="checked"'; 
if ($credits_serias_name == 1) $credits_serias_name = 'checked="checked"'; 
if ($credits_serias_id == 1) $credits_serias_id = 'checked="checked"'; 
if ($credits_author_www == 1) $credits_author_www = 'checked="checked"'; 
if ($credits_copyright == 1) $credits_copyright = 'checked="checked"'; 
if ($credits_layout == 1) $credits_layout = 'checked="checked"'; 
if ($credits_cover == 1) $credits_cover = 'checked="checked"'; 
if ($credits_press_and_tome == 1) $credits_press_and_tome = 'checked="checked"'; 
if ($credits_firstpress_id_and_time == 1) $credits_firstpress_id_and_time = 'checked="checked"'; 
if ($credits_lastpress_id_and_time == 1) $credits_lastpress_id_and_time = 'checked="checked"'; 
if ($credits_isbn_id == 1) $credits_isbn_id = 'checked="checked"'; 
if ($credits_editor == 1) $credits_editor = 'checked="checked"';
if ($credits_translator == 1) $credits_translator = 'checked="checked"'; 
if ($credits_prepaers == 1) $credits_prepaers = 'checked="checked"'; 
if ($credits_pulbilsher_adress == 1) $credits_pulbilsher_adress = 'checked="checked"'; 
if ($credits_pulbilsher_tel == 1) $credits_pulbilsher_tel = 'checked="checked"'; 
if ($credits_pulbilsher_fax == 1) $credits_pulbilsher_fax = 'checked="checked"'; 
if ($credits_pulbilsher_www == 1) $credits_pulbilsher_www = 'checked="checked"'; 
if ($credits_pulbilsher_email == 1) $credits_pulbilsher_email = 'checked="checked"'; 
if ($credits_order_info == 1) $credits_order_info = 'checked="checked"'; 
if ($credits_online_order == 1) $credits_online_order = 'checked="checked"'; 
if ($credits_inside_book_name == 1) $credits_inside_book_name = 'checked="checked"'; 
if ($credits_inside_author == 1) $credits_inside_author = 'checked="checked"'; 
if ($credits_inside_publisher_logo  == 1) $credits_inside_publisher_logo = 'checked="checked"'; 
if ($credits_inside_publisher_name  == 1) $credits_inside_publisher_name = 'checked="checked"'; 
if ($credits_others_info  == 1) $credits_others_info = 'checked="checked"'; 
if ($cr_correction_accept == 1) $cr_correction_accept = 'checked="checked"'; 
if ($cr_correction_add  == 1) $cr_correction_add = 'checked="checked"'; 
if ($cr_correction_check  == 1) $cr_correction_check = 'checked="checked"'; 

//metin geldi�i i�in temizlenmesi gereken alanlar
$book_name = stripslashes($book_name);

?>

<h1>Proje D�zenle &raquo; <?php echo $book_name?></h1>

<br>
<div>
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>">Ba�lang��</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=disisler">D�� ��ler</a> &raquo; 
<a class="button1" href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=mizanpaj">Mizanpaj Kontrol</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=kapak">Kapak Kontrol</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=baski">Bask� ��lemleri</a> &raquo; 
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=yedek">Yedeklemeler</a>
</div>
<br>

<?php echo $islem_bilgisi?>

<form name="projeform" action="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=mizanpaj" method="POST">
<input type="hidden" name="menu" value="projeler">
<input type="hidden" name="sub" value="mizanpaj">
<input type="hidden" name="islem" value="guncelle">
<input type="hidden" name="book_id" value="<?php echo $book_id?>">

<table width="100%" border="0">
	<tr>
		<th width="50%">
		</th>
		<th>
			<input class="button1" type="submit" name="projeform" onclick="this.className = 'button1 disabled';" name="submit" value="DE����KL�KLER� KAYDET">
		</th>
	</tr>

	<tr>
		<td valign="top"> 
			<table valign="top" width="100%" cellspacing="5" border="0">
				<tr class="col1">
					<th colspan="3">
						GENEL M�ZANPAJ KONTROL
					</th>
				</tr>
				<tr>
					<td width="250">Kitab�n ebat� kabul edildi</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="lc_dimension_accept" <?php echo $lc_dimension_accept?>>
					</td>
				</tr>
				<tr>
					<td>Kenar bo�luklar� kabul edildi</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="lc_margins_accept" <?php echo $lc_margins_accept?>>
					</td>
				</tr>
				<tr class="col1">
					<th colspan="3">
						ST�L/M�ZANPAJ KONTROL
					</th>
				</tr>
				<tr>
					<td>Yaz� stili </td>
					<td>
					:
					</td>
					<td>
						<select style="width: 130px;" name="lc_text_style">
						<option value="<?php echo $lc_text_style ?>"> <?php echo $array_mizanpaj_yazistili[$lc_text_style]?></option>						
						<?php
						foreach ($array_mizanpaj_yazistili as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>				
					</td>
				</tr>

				<tr>
					<td>Paragraf girintisi</td>
					<td>
					:
					</td>
					<td>
						<select style="width: 130px;" name="lc_paragraph_indent">
						<option value="<?php echo $lc_paragraph_indent ?>"> <?php echo $array_mizanpaj_paragrafgirintisi[$lc_paragraph_indent]?></option>						
						<?php
						foreach ($array_mizanpaj_paragrafgirintisi as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>				
					</td>
				</tr>
				
				<tr>
					<td>Sayfa no stili</td>
					<td>
					:
					</td>
					<td>
						<select style="width: 130px;" name="lc_paging_style">
						<option value="<?php echo $lc_paging_style ?>"> <?php echo $array_mizanpaj_sayfanostili[$lc_paging_style]?></option>						
						<?php
						foreach ($array_mizanpaj_sayfanostili as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>				
					</td>
				</tr>
				

				<tr>
					<td>Yaz� stili kabul edildi</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="lc_text_style_accept" <?php echo $lc_text_style_accept?>>
					</td>
				</tr>

				<tr>
					<td>Parafraf girintisi kabul edildi </td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="lc_paragraph_indent_accept" <?php echo $lc_paragraph_indent_accept?>>
					</td>
				</tr>
				
				<tr>
					<td>Sayfa no stili kabul edildi</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="lc_paging_accept" <?php echo $lc_paging_accept?>>
					</td>
				</tr>
				
				<tr class="col1">
					<th colspan="3">
						FONT KONTROL
					</th>
				</tr>
				<tr>
					<td>Kitab�n seri fontu (olmas� gereken)</td>
					<td>
					:
					</td>
					<td>
						<select style="width: 130px;" name="lc_text_font_select">
						<option value="<?php echo $lc_text_font_select ?>"> <?php echo $array_mizanpaj_font[$lc_text_font_select]?></option>						
						<?php
						foreach ($array_mizanpaj_font as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>				
					</td>
				</tr>
				<tr>
					<td>Kitab�n yaz� fontu seri fontu mudur</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="lc_text_font_standart" <?php echo $lc_text_font_standart?>>
					</td>
				</tr>
				<tr>
					<td>Kitab�n yaz� fontu seri fontu<br>de�ilse hangi font</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input style="width: 130px;" type="text" name="lc_text_font_alternative" value="<?php echo $lc_text_font_alternative?>">
					</td>
				</tr>
				<tr>
					<td>Kitab�n yaz� fontu kabul edildi</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="lc_text_font_accepted" <?php echo $lc_text_font_accepted?>>
					</td>
				</tr>

				<tr class="col1">
					<th colspan="3">
						PUNTO KONTROL
					</th>
				</tr>
				<tr>
					<td>Kitab�n seri puntosu (olmas� gereken)</td>
					<td>
					:
					</td>
					<td>
						<select style="width: 130px;" name="lc_text_size_select">
						<option value="<?php echo $lc_text_size_select ?>"> <?php echo $array_mizanpaj_punto[$lc_text_size_select]?></option>						
						<?php
						foreach ($array_mizanpaj_punto as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>				
					</td>
				</tr>
				<tr>
					<td>Kitab�n punto de�erleri seri punto de�erleri midir</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="lc_text_size_standart" <?php echo $lc_text_size_standart?>>
					</td>
				</tr>
				<tr>
					<td>Kitab�n punto de�erleri seri punto <br>de�erleri de�ilse ka� punto</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input style="width: 130px;" type="text" name="lc_text_size_alternative" value="<?php echo $lc_text_size_alternative?>">
					</td>
				</tr>
				<tr>
					<td>Kitab�n punto de�erleri kabul edildi</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="lc_text_size_accepted" <?php echo $lc_text_size_accepted?>>
					</td>
				</tr>

				<tr class="col1">
					<th colspan="3">
						SATIR ARALI�I KONTROL
					</th>
				</tr>
				<tr>
					<td>Kitab�n seri sat�r aral��� (olmas� gereken)</td>
					<td>
					:
					</td>
					<td>
						<select style="width: 130px;" name="lc_text_height_select">
						<option value="<?php echo $lc_text_height_select ?>"> <?php echo $array_mizanpaj_satiraraligi[$lc_text_height_select]?></option>						
						<?php
						foreach ($array_mizanpaj_satiraraligi as $k => $v)
						{
						echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
						}
						?>
						</select>				
					</td>
				</tr>
				<tr>
					<td>Kitab�n sat�r aral��� de�erleri <br>seri sat�r aral��� de�erleri midir</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="lc_text_height_standart" <?php echo $lc_text_height_standart?>>
					</td>
				</tr>
				<tr>
					<td>Kitab�n sat�r aral��� de�erleri seri sat�r<br>aral��� de�erleri de�ilse ka�</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input style="width: 130px;" type="text" name="lc_text_height_alternative" value="<?php echo $lc_text_height_alternative?>">
					</td>
				</tr>
				<tr>
					<td>Kitab�n sat�r aral��� de�erleri kabul edildi</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="lc_text_height_accepted" <?php echo $lc_text_height_accepted?>>
					</td>
				</tr>

				<tr class="col1">
					<th colspan="3">
						�� M�ZANPAJ KONTROL
					</th>
				</tr>
				<tr>
					<td>��indekiler k�sm� standartlarla uyumlu</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="lc_contents_standart" <?php echo $lc_contents_standart?>>
					</td>
				</tr>
				<tr>
					<td>��indekiler k�sm� kontrol edildi</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="lc_contents_accepted" <?php echo $lc_contents_accepted?>>
					</td>
				</tr>
				<tr>
					<td>Sayfa ba�l�klar� standartlarla uyumlu</td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="lc_page_title_standart" <?php echo $lc_page_title_standart?>>
					</td>
				</tr>
				<tr>
					<td>Sayfa ba�l�klar� kontrol edildi
					<br><small>(kitap ad�, yazar ad�, b�l�m ad�)</small></td>
					<td colspan="2">
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="lc_page_title_accepted" <?php echo $lc_page_title_accepted?>>
					</td>
				</tr>		
			</table>
		</td>
		<td valign="top">
			<table width="50%" cellspacing="5" border="0">
				<tr class="col1">
					<th colspan="3">
						�N JENER�K KONTROL
					</th>
				</tr>
				<tr>
					<td width="250">Bask� �ehri do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_outside_press_city" <?php echo $credits_outside_press_city?>>
					</td>
				</tr>
				<tr>
					<td>Bask� y�l� do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_outside_press_year" <?php echo $credits_outside_press_year?>>
					</td>
				</tr>
				<tr>
				<tr class="col1">
					<th colspan="3">
						JENER�K KONTROL
					</th>
				</tr>
				<tr>
					<td>Yay�nevi ad� do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_publisher_name" <?php echo $credits_publisher_name?>>
					</td>
				</tr>
				<tr>
					<td>Yay�n no do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_publishing_id" <?php echo $credits_publishing_id?>>
					</td>
				</tr>
				<tr>
					<td>Seri ismi do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_serias_name" <?php echo $credits_serias_name?>>
					</td>
				</tr>
				<tr>
					<td>Seri no do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_serias_id" <?php echo $credits_serias_id?>>
					</td>
				</tr>
				<tr>
					<td>Yazar web bilgisi do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_author_www" <?php echo $credits_author_www?>>
					</td>
				</tr>
				<tr><td colspan="2"><br><hr><td></tr>
				<tr>
					<td>Copyright do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_copyright" <?php echo $credits_copyright?>>
					</td>
				</tr>
				<tr><td colspan="2"><br><hr><td></tr>
				<tr>
					<td>�� d�zen do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_layout" <?php echo $credits_layout?>>
					</td>
				</tr>
				<tr>
					<td>Kapak tasarlayan do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_cover" <?php echo $credits_cover?>>
					</td>
				</tr>
				<tr>
					<td>Bask� ve cilt do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_press_and_tome" <?php echo $credits_press_and_tome?>>
					</td>
				</tr>
				<tr>
					<td>�lk bask� no ve tarihi do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_firstpress_id_and_time" <?php echo $credits_firstpress_id_and_time?>>
					</td>
				</tr>
				<tr>
					<td>Son bask� no ve tarihi do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_lastpress_id_and_time" <?php echo $credits_lastpress_id_and_time?>>
					</td>
				</tr>
				<tr>
					<td>ISBN no do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_isbn_id" <?php echo $credits_isbn_id?>>
					</td>
				</tr>
				<tr><td colspan="2"><br><hr><td></tr>
				<tr>
					<td>Edit�r�n ad� do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_editor" <?php echo $credits_editor?>>
					</td>
				</tr>
				<tr>
					<td>M�tercimin ad� do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_translator" <?php echo $credits_translator?>>
					</td>
				</tr>
				<tr>
					<td>Yay�na haz�rlayan bilgileri do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_prepaers" <?php echo $credits_prepaers?>>
					</td>
				</tr>
				<tr><td colspan="2"><br><hr><td></tr>
				<tr>
					<td>Yay�nc� adresi g�ncel</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_pulbilsher_adress" <?php echo $credits_pulbilsher_adress?>>
					</td>
				</tr>
				<tr>
					<td>Yay�nc� telefon numaras� g�ncel</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_pulbilsher_tel" <?php echo $credits_pulbilsher_tel?>>
					</td>
				</tr>
				<tr>
					<td>Yay�nc� fax numaras� g�ncel</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_pulbilsher_fax" <?php echo $credits_pulbilsher_fax?>>
					</td>
				</tr>
				<tr>
					<td>Yay�nc� site adresi g�ncel</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_pulbilsher_www" <?php echo $credits_pulbilsher_www?>>
					</td>
				</tr>
				<tr>
					<td>Yay�nc� eposta adresi g�ncel</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_pulbilsher_email" <?php echo $credits_pulbilsher_email?>>
					</td>
				</tr>
				<tr>
					<td>Sipari� i�in gerekli bilgiler g�ncel</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_order_info" <?php echo $credits_order_info?>>
					</td>
				</tr>
				<tr>
					<td>Kitab�n online sipari� adresi g�ncel</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_online_order" <?php echo $credits_online_order?>>
					</td>
				</tr>
				<tr class="col1">
					<th colspan="3">
						�� KAPAK KONTROL
					</th>
				</tr>
				<tr>
					<td>Kitab�n ad� do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_inside_book_name" <?php echo $credits_inside_book_name?>>
					</td>
				</tr>
				<tr>
					<td>Yazar�n ad� do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_inside_author" <?php echo $credits_inside_author?>>
					</td>
				</tr>
				<tr>
					<td>Yay�nevi logosu do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_inside_publisher_logo" <?php echo $credits_inside_publisher_logo?>>
					</td>
				</tr>
				<tr>
					<td>Yay�nevi ad� do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_inside_publisher_name" <?php echo $credits_inside_publisher_name?>>
					</td>
				</tr>
				<tr><td colspan="2"><br><hr><td></tr>
				<tr>
					<td>�lave notlar do�ru</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="credits_others_info" <?php echo $credits_others_info?>>
					</td>
				</tr>
			<tr class="col1">
					<th colspan="3">
						TASH�H KONTROL
					</th>
				</tr>
				<tr>
					<td width="250">Kitap tashih edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cr_correction_accept" <?php echo $cr_correction_accept?>>
					</td>
				</tr>
				<tr>
					<td>Gelen tashihler girildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cr_correction_add" <?php echo $cr_correction_add?>>
					</td>
				</tr>
				<tr>
					<td>Girilen tashihler kontrol edildi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="cr_correction_check" <?php echo $cr_correction_check?>>
					</td>
				</tr>
				
			</table>
		</td>
	</tr>
</table>
</form>
</div>