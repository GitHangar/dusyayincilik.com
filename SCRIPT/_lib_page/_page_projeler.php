<?php if (!defined('yakusha')) die('...'); 	//reset	$siralama = '';	$sorguilavesi = '';	//sql sorgusu olu�turuluyor	$SORGU_cumle = '	SELECT book_id, book_type, book_status, book_name, book_author, book_editor, book_pagecount, book_isbn, book_publisher, book_pubnumber, book_serias, book_serias_id, book_publish_planed_date	FROM pco_book	WHERE book_status = 1	ORDER BY book_name DESC;';	//sql sorgusu g�nderiliyor	//echo $SORGU_cumle;	$SORGU_sonuc = mysql_query($SORGU_cumle);	$bulunanadet = mysql_num_rows($SORGU_sonuc);	//sayfa i�i olu�turuluyor, d�ne d�ne	$sayfabilgisi = '';	if ($bulunanadet)	{		for ($i = 0; $i < $bulunanadet; $i++) 		{			if ($i%2) { $trcolor = "col2"; } else { $trcolor = "col1"; }			$project_book_id = mysql_result($SORGU_sonuc,$i,"book_id");			$project_book_name = mysql_result($SORGU_sonuc,$i,"book_name");			$project_book_author = mysql_result($SORGU_sonuc,$i,"book_author");			$project_book_editor = mysql_result($SORGU_sonuc,$i,"book_editor");			$project_book_pagecount = mysql_result($SORGU_sonuc,$i,"book_pagecount");			$project_book_isbn = mysql_result($SORGU_sonuc,$i,"book_isbn");			$project_book_publisher = mysql_result($SORGU_sonuc,$i,"book_publisher");			$project_book_pubnumber = mysql_result($SORGU_sonuc,$i,"book_pubnumber");			$project_book_serias = mysql_result($SORGU_sonuc,$i,"book_serias");			$project_book_serias_id = mysql_result($SORGU_sonuc,$i,"book_serias_id");			$project_book_publish_planed_date = mysql_result($SORGU_sonuc,$i,"book_publish_planed_date");			$project_book_type = mysql_result($SORGU_sonuc,$i,"book_type");			$project_book_status = mysql_result($SORGU_sonuc,$i,"book_status");			$project_publish_planed_date_day = date('j', $project_book_publish_planed_date);			$project_publish_planed_date_month = date('n', $project_book_publish_planed_date);			$project_publish_planed_date_year = date('Y', $project_book_publish_planed_date);						//ay no, ay ismine d�n��t�r�l�yor			$project_publish_planed_date_month = $array_aylar[$project_publish_planed_date_month];						//slash i�aretleri temizleniyor			$project_book_name = stripslashes($project_book_name);			$project_book_author = stripslashes($project_book_author);						$project_book_editor = stripslashes($project_book_editor);						$sayfabilgisi.= '			<td width="50%">			<table width="100%" class="myproject" border="0">			<tr>				<td width="150">Proje Ad�</td>				<td>:</td>				<td>'.$project_book_name.'</td>			</tr>			<tr>				<td>Yazar</td>				<td>:</td>				<td>'.$project_book_author.'</td>			</tr>			<tr>				<td>Edit�r</td>				<td>:</td>				<td>'.$project_book_editor.'</td>			</tr>			<tr>				<td>Sayfa Say�s�</td>				<td>:</td>				<td>'.$project_book_pagecount.'</td>			</tr>			<tr>				<td>Yay�nevi</td>				<td>:</td>				<td>'.$array_yayinevi[$project_book_publisher].'</td>			</tr>			<tr>				<td>Seri</td>				<td>:</td>				<td>'.$array_seri_adlari[$project_book_serias].'</td>			</tr>			<tr>				<td>ISBN</td>				<td>:</td>				<td>'.$project_book_isbn.'</td>			</tr>			<tr>				<td>Proje Tipi</td>				<td>:</td>				<td>'.$array_book_type[$project_book_type].'</td>			</tr>			<tr>				<td>Yay�nlanacak Tarih</td>				<td>:</td>				<td>'.$project_publish_planed_date_day.' '.$project_publish_planed_date_month.' '.$project_publish_planed_date_year.'</td>			</tr>		</table>		</td>		';		if ($i%2) $sayfabilgisi.= '</tr><tr>';		}	}	else	{		$sayfabilgisi = '<td>Projelerimiz Hen�z Geli�tirilme A�amas�ndad�r.</td>';	}?>		<style>.col1 { background-color: #DCEBFE; }.col2 { background-color: #F9F9F9; }</style><!--<div id="banner"><a href="#"><img src="_img/_nimbuslike/img05.jpg" alt="" /></a></div>--><div id="page-bgcontent">	<div id="full"><div class="right_articles"><a href="<?php echo ANASAYFALINK?>">Ana Sayfa</a> &raquo; Projeler</div><table class="vitrinler" width="100%" border="0" cellpadding="0" cellspacing="0"><tr><?php echo $sayfabilgisi?></tr></table></div>