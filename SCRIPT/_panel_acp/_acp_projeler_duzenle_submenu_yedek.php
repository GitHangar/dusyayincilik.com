<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"] == 1) exit ();

$this_time = time();
// echo "<pre>";
// print_r($_REQUEST);
// echo "</pre>";

$book_id = $_REQUEST["un"];

if (isset($_REQUEST["projeform"]))
{
	//varsayýlanlar
	$changetar = time();

	//checkbox ile gelen alanlar
	$archive_copyright_agreement = trim(strip_tags($_REQUEST["archive_copyright_agreement"]));
	$archive_translate_agreement = trim(strip_tags($_REQUEST["archive_translate_agreement"]));

	$archive_layout_cd = trim(strip_tags($_REQUEST["archive_layout_cd"]));
	$archive_cover_cd = trim(strip_tags($_REQUEST["archive_cover_cd"]));

	$archive_cover_film = trim(strip_tags($_REQUEST["archive_cover_film"]));
	$archive_book_film = trim(strip_tags($_REQUEST["archive_book_film"]));

	$archive_layout_file = trim(strip_tags($_REQUEST["archive_layout_file"]));
	$archive_layout_pdf = trim(strip_tags($_REQUEST["archive_layout_pdf"]));
	$archive_cover_file = trim(strip_tags($_REQUEST["archive_cover_file"]));

	$archive_backup_layout_file = trim(strip_tags($_REQUEST["archive_backup_layout_file"]));
	$archive_backup_layout_pdf = trim(strip_tags($_REQUEST["archive_backup_layout_pdf"]));
	$archive_backup_cover_file = trim(strip_tags($_REQUEST["archive_backup_cover_file"]));
	//checkbox alanlarý dönüþtürülüyor
	//mizanpaj
	if ($archive_copyright_agreement == 'on') $archive_copyright_agreement = 1; else $archive_copyright_agreement = 0;
	if ($archive_translate_agreement == 'on') $archive_translate_agreement = 1; else $archive_translate_agreement = 0;

	if ($archive_layout_cd == 'on') $archive_layout_cd = 1; else $archive_layout_cd = 0;
	if ($archive_cover_cd == 'on') $archive_cover_cd = 1; else $archive_cover_cd = 0;

	if ($archive_cover_film == 'on') $archive_cover_film = 1; else $archive_cover_film = 0;
	if ($archive_book_film == 'on') $archive_book_film = 1; else $archive_book_film = 0;

	if ($archive_layout_file == 'on') $archive_layout_file = 1; else $archive_layout_file = 0;
	if ($archive_layout_pdf == 'on') $archive_layout_pdf = 1; else $archive_layout_pdf = 0;
	if ($archive_cover_file == 'on') $archive_cover_file = 1; else $archive_cover_file = 0;

	if ($archive_backup_layout_file == 'on') $archive_backup_layout_file = 1; else $archive_backup_layout_file = 0;
	if ($archive_backup_layout_pdf == 'on') $archive_backup_layout_pdf = 1; else $archive_backup_layout_pdf = 0;
	if ($archive_backup_cover_file == 'on') $archive_backup_cover_file = 1; else $archive_backup_cover_file = 0;
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
				archive_copyright_agreement = '".$archive_copyright_agreement."',
				archive_translate_agreement = '".$archive_translate_agreement."',
				archive_layout_cd = '".$archive_layout_cd."',
				archive_cover_cd = '".$archive_cover_cd."',
				archive_cover_film = '".$archive_cover_film."',
				archive_book_film = '".$archive_book_film."',
				archive_layout_file = '".$archive_layout_file."',
				archive_layout_pdf = '".$archive_layout_pdf."',
				archive_cover_file = '".$archive_cover_file."',
				archive_backup_layout_file = '".$archive_backup_layout_file."',
				archive_backup_layout_pdf = '".$archive_backup_layout_pdf."',
				archive_backup_cover_file = '".$archive_backup_cover_file."',
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
		archive_copyright_agreement,
		archive_translate_agreement,
		archive_layout_cd,
		archive_cover_cd,
		archive_cover_film,
		archive_book_film,
		archive_layout_file,
		archive_layout_pdf,
		archive_cover_file,
		archive_backup_layout_file,
		archive_backup_layout_pdf,
		archive_backup_cover_file
		FROM pco_book 
	WHERE book_id = "'.$book_id.'";';
	// echo '<pre>'.$SORGU_cumle.'</pre>';
$SORGU_sonuc = mysql_query($SORGU_cumle);
$bulunanadet = mysql_num_rows($SORGU_sonuc);

//deðerler oluþturuluyor
$book_name = mysql_result($SORGU_sonuc,0,"book_name");
$archive_copyright_agreement = mysql_result($SORGU_sonuc,0,"archive_copyright_agreement");
$archive_translate_agreement = mysql_result($SORGU_sonuc,0,"archive_translate_agreement");
$archive_layout_cd = mysql_result($SORGU_sonuc,0,"archive_layout_cd");
$archive_cover_cd = mysql_result($SORGU_sonuc,0,"archive_cover_cd");
$archive_cover_film = mysql_result($SORGU_sonuc,0,"archive_cover_film");
$archive_book_film = mysql_result($SORGU_sonuc,0,"archive_book_film");
$archive_layout_file = mysql_result($SORGU_sonuc,0,"archive_layout_file");
$archive_layout_pdf = mysql_result($SORGU_sonuc,0,"archive_layout_pdf");
$archive_cover_file = mysql_result($SORGU_sonuc,0,"archive_cover_file");
$archive_backup_layout_file = mysql_result($SORGU_sonuc,0,"archive_backup_layout_file");
$archive_backup_layout_pdf = mysql_result($SORGU_sonuc,0,"archive_backup_layout_pdf");
$archive_backup_cover_file = mysql_result($SORGU_sonuc,0,"archive_backup_cover_file");

//checkbox alanlarý dönüþtürülüyor
if ($archive_copyright_agreement == 1) $archive_copyright_agreement = 'checked="checked"'; 
if ($archive_translate_agreement == 1) $archive_translate_agreement = 'checked="checked"'; 
if ($archive_layout_cd == 1) $archive_layout_cd = 'checked="checked"'; 
if ($archive_cover_cd == 1) $archive_cover_cd = 'checked="checked"'; 
if ($archive_cover_film == 1) $archive_cover_film = 'checked="checked"'; 
if ($archive_book_film == 1) $archive_book_film = 'checked="checked"'; 
if ($archive_layout_file == 1) $archive_layout_file = 'checked="checked"'; 
if ($archive_layout_pdf == 1) $archive_layout_pdf = 'checked="checked"'; 
if ($archive_cover_file == 1) $archive_cover_file = 'checked="checked"'; 
if ($archive_backup_layout_file == 1) $archive_backup_layout_file = 'checked="checked"'; 
if ($archive_backup_layout_pdf == 1) $archive_backup_layout_pdf = 'checked="checked"'; 
if ($archive_backup_cover_file == 1) $archive_backup_cover_file = 'checked="checked"'; 

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
				<a href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=baski">Baský Ýþlemleri</a> &raquo; 
<a class="button1" href="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=yedek">Yedeklemeler</a>
</div>
<br>

<?php echo $islem_bilgisi?>

<form name="projeform" action="<?php echo $acp_projelerlink?>&amp;un=<?php echo $book_id?>&amp;sub=yedek" method="POST">
<input type="hidden" name="menu" value="projeler">
<input type="hidden" name="sub" value="yedek">
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
			<table width="50%" cellspacing="5" border="0">
				<tr class="col1">
					<th colspan="3">
						EDÝTÖR YEDEKLEMELERÝ
					</th>
				</tr>
				<tr>
					<td width="250">Telif sözleþmesi arþivlendi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="archive_copyright_agreement" <?php echo $archive_copyright_agreement?>>
					</td>
				</tr>
				<tr>
					<td>Tercüme sözleþmesi arþivlendi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="archive_translate_agreement" <?php echo $archive_translate_agreement?>>
					</td>
				</tr>
				<tr>
					<td colspan="2"><br><hr></td>
				</tr>
				<tr>
					<td>Ýç düzen çalýþmalarý<br>cd formatýnda arþivlendi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="archive_layout_cd" <?php echo $archive_layout_cd?>>
					</td>
				</tr>
				<tr>
					<td>Kapak ve ayraç çalýþmalarý<br>cd formatýnda arþivlendi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="archive_cover_cd" <?php echo $archive_cover_cd?>>
					</td>
				</tr>
			</table>
		</td>
		<td valign="top">
			<table width="50%" cellspacing="5" border="0">
				<tr class="col1">
					<th colspan="3">
						AJANS YEDEKLEMELERÝ
					</th>
				</tr>
				<tr>
					<td width="250">Kapak filmi arþivlendi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="archive_cover_film" <?php echo $archive_cover_film?>>
					</td>
				</tr>
				<tr>
					<td>Ýç filim arþivlendi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="archive_book_film" <?php echo $archive_book_film?>>
					</td>
				</tr>				
				<tr>
					<td colspan="2"><br><hr></td>
				</tr>
				<tr>
					<td>Ýç düzen dökümaný<br>çalýþtýðý formatta arþivlendi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="archive_layout_file" <?php echo $archive_layout_file?>>
					</td>
				</tr>
				<tr>
					<td>Ýç düzen dökümaný<br>PDF formatýnda arþivlendi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="archive_layout_pdf" <?php echo $archive_layout_pdf?>>
					</td>
				</tr>
				<tr>
					<td>Kapak ve ayraç dökümaný<br>PSD ve JPG formatýnda arþivlendi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="archive_cover_file" <?php echo $archive_cover_file?>>
					</td>
				</tr>
				<tr>
					<td colspan="2"><br><hr></td>
				</tr>
				<tr>
					<td>Ýç düzen dökümaný<br>çalýþtýðý formatta yedeklendi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="archive_backup_layout_file" <?php echo $archive_backup_layout_file?>>
					</td>
				</tr>
				<tr>
					<td>Ýç düzen dökümaný<br>PDF formatýnda yedeklendi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="archive_backup_layout_pdf" <?php echo $archive_backup_layout_pdf?>>
					</td>
				</tr>
				<tr>
					<td>Kapak ve ayraç dökümaný<br>PSD ve JPG formatýnda yedeklendi</td>
					<td>
					:&nbsp;&nbsp;&nbsp;<input type="checkbox" name="archive_backup_cover_file" <?php echo $archive_backup_cover_file?>>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
</div>