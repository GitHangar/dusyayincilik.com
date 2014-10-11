<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"]==1) exit ();

include($siteyolu."/_panel_acp/_temp/_t_adminbaslangic.php"); 

$submenu = $_REQUEST['sub']; //settype($submenu,"integer");
$project_book_id = $_REQUEST['un']; settype($project_book_id,"integer");
$proje_ekle = $_REQUEST['projeekle']; settype($project_book_id,"integer");
if ($project_book_id > 0)
{
	include($siteyolu."/_panel_acp/_temp/_t_adminmenuleri.php");
	include($siteyolu."/_panel_acp/_temp/_t_adminmenuleri_projeduzenle.php");
	echo '</div><div id="main">';
	//submenu deðil ise ana menüyü getiriyoruz
	if (!$submenu)
	{
		include($siteyolu."/_panel_acp/_acp_projeler_duzenle_submenu_ortak.php");
	}
	if ($submenu == 'disisler')
	{
		include($siteyolu."/_panel_acp/_acp_projeler_duzenle_submenu_disisler.php");
	}
	if ($submenu == 'mizanpaj')
	{
		include($siteyolu."/_panel_acp/_acp_projeler_duzenle_submenu_mizanpaj.php");
	}
	if ($submenu == 'kapak')
	{
		include($siteyolu."/_panel_acp/_acp_projeler_duzenle_submenu_kapak.php");
	}
	if ($submenu == 'baski')
	{
		include($siteyolu."/_panel_acp/_acp_projeler_duzenle_submenu_baski.php");
	}
	if ($submenu == 'yedek')
	{
		include($siteyolu."/_panel_acp/_acp_projeler_duzenle_submenu_yedek.php");
	}
}
elseif ($proje_ekle > 0)
{
	include($siteyolu."/_panel_acp/_temp/_t_adminmenuleri.php");
	echo '</div><div id="main">';
	include($siteyolu."/_panel_acp/_acp_projeler_ekle.php");
}
else
{
	//reset
	$siralama = '';
	$sorguilavesi = '';

	//form için gereken deðiþkenler alýnýyor
	$listetipi = $_REQUEST['lt'];
	$limit = $_REQUEST['limit'];
	$aramaanahtari = $_REQUEST['aramaanahtari'];
	$aramatipi = $_REQUEST['aramatipi'];
	$siralamatipi = $_REQUEST['order'];
	$by = $_REQUEST['by'];
	if ($by == 0) 
	{
		$by = 0;
		$order_by = 'ASC';
	}
	else
	{
		$by = 1;
		$order_by = 'DESC';
	}

	//gelen deðerleri düzenliyoruz
	$aramaanahtari = htmlspecialchars($aramaanahtari);
	$aramatipi = htmlspecialchars($aramatipi);
	$siralamatipi = htmlspecialchars($siralamatipi);
	
	//toplu güncelleme için gereken deðerleri alýyoruz
	$this_time = time();
	$this_day = date('j', $this_day); 
	$this_mounth = date('n', $this_time); 
	$this_year = date('Y', $this_time);	
	
	$project_publish_planed_date_day = $_REQUEST["project_publish_planed_date_day"];
	$project_publish_planed_date_month = $_REQUEST["project_publish_planed_date_month"];
	$project_publish_planed_date_year = $_REQUEST["project_publish_planed_date_year"];
	
	$project_book_pagecount = $_REQUEST["project_book_pagecount"];
	$project_book_isbn = $_REQUEST["project_book_isbn"];
	$project_book_publisher = $_REQUEST["project_book_publisher"]; 
	$project_book_pubnumber = $_REQUEST["project_book_pubnumber"]; 
	$project_book_serias = $_REQUEST["project_book_serias"]; 
	$project_book_serias_id = $_REQUEST["project_book_serias_id"]; 
	$project_book_type = $_REQUEST["project_book_type"]; 
	$project_book_status = $_REQUEST["project_book_status"]; 

	#############################################################
	# formla ilgili öncelikli iþlemler varsa tamamlýyoruz
	#############################################################	
	if (isset ($_REQUEST["topluduzenle"]))
	{
		//önce sayfa sayýlarý güncelleniyor
		
/* 		foreach ($project_publish_planed_date_day as $k => $v)
		{
				echo $k;
				echo $v;
				$v = trim ($v);
				$SORGU_urun = '
					UPDATE pco_book
					SET book_pagecount = "'.$v.'"
					WHERE book_id = "'.$k.'"
					;';
				$SORGU_sonuc = mysql_query($SORGU_urun);
				echo '<br>'.$SORGU_urun;
		} */
		
		foreach ($project_book_pagecount as $k => $v)
		{
			$v = trim ($v);
			if (is_numeric($k) && $k > 0 )
			{
				$SORGU_urun = '
					UPDATE pco_book
					SET book_pagecount = "'.$v.'"
					WHERE book_id = "'.$k.'"
					;';
				$SORGU_sonuc = mysql_query($SORGU_urun);
				//echo '<br>'.$SORGU_urun;
			}
		}
		
		//isbn bilgileri güncelleniyor
		foreach ($project_book_isbn as $k => $v)
		{
			$v = trim ($v);
			if (is_numeric($k) && $k > 0 )
			{
				$SORGU_urun = '
					UPDATE pco_book
					SET book_isbn = "'.$v.'"
					WHERE book_id = "'.$k.'"
					;';
				$SORGU_sonuc = mysql_query($SORGU_urun);
				//echo '<br>'.$SORGU_urun;
			}
		}

		//yayýnevi bilgileri güncelleniyor
		foreach ($project_book_publisher as $k => $v)
		{
			if (is_numeric($k) && $k > 0 )
			{
				$SORGU_urun = '
					UPDATE pco_book
					SET book_publisher = "'.$v.'"
					WHERE book_id = "'.$k.'"
					;';
				$SORGU_sonuc = mysql_query($SORGU_urun);
				//echo '<br>'.$SORGU_urun;
			}
		}

		//sýrt no deðerleri güncelleniyor
		foreach ($project_book_pubnumber as $k => $v)
		{
			if (is_numeric($k) && $k > 0 )
			{
				$SORGU_urun = '
					UPDATE pco_book
					SET book_pubnumber = "'.$v.'"
					WHERE book_id = "'.$k.'"
					;';
				$SORGU_sonuc = mysql_query($SORGU_urun);
				//echo '<br>'.$SORGU_urun;
			}
		}

		//seri adý deðerleri güncelleniyor
		foreach ($project_book_serias as $k => $v)
		{
			if (is_numeric($k) && $k > 0 )
			{
				$SORGU_urun = '
					UPDATE pco_book
					SET book_serias = "'.$v.'"
					WHERE book_id = "'.$k.'"
					;';
				$SORGU_sonuc = mysql_query($SORGU_urun);
				//echo '<br>'.$SORGU_urun;
			}
		}

		//seri iç no deðerleri güncelleniyor
		foreach ($project_book_serias_id as $k => $v)
		{
			if (is_numeric($k) && $k > 0)
			{
				$SORGU_urun = '
					UPDATE pco_book
					SET book_serias_id = "'.$v.'"
					WHERE book_id = "'.$k.'"
					;';
				$SORGU_sonuc = mysql_query($SORGU_urun);
				//echo '<br>'.$SORGU_urun;
			}
		}
		
		//yayýn tipi deðerleri güncelleniyor
		foreach ($project_book_type as $k => $v)
		{
			if (is_numeric($k) && $k > 0 )
			{
				$SORGU_urun = '
					UPDATE pco_book
					SET book_type = "'.$v.'"
					WHERE book_id = "'.$k.'"
					;';
				$SORGU_sonuc = mysql_query($SORGU_urun);
				//echo '<br>'.$SORGU_urun;
			}
		}

		//yayýn durumu deðerleri güncelleniyor
		foreach ($project_book_status as $k => $v)
		{
			if (is_numeric($k) && $k > 0 && is_numeric($v))
			{
				$SORGU_urun = '
					UPDATE pco_book
					SET book_status = "'.$v.'"
					WHERE book_id = "'.$k.'"
					;';
				$SORGU_sonuc = mysql_query($SORGU_urun);
				//echo '<br>'.$SORGU_urun;
			}
		}

		//iþlem sonuç mesajý oluþturuluyor
		$islemsonucu = '<div class="successbox">Ýþlem Baþarý Ýle Tamamlandý.</div>';
	}

	//formu oluþturmaya baþlýyoruz
	
	//arama tipleri oluþturuluyor
	if ($aramatipi == "projeadi") 
		$listetipi = "projeadi";
	
	if ($aramatipi == "yazaradi") 
		$listetipi = "yazaradi";
	
	if ($aramatipi == "barkod") 
		$listetipi = "barkod";

	//arama fonmundan gelen deðerler için
	//liste tipleri oluþturuluyor
	if ($listetipi == "projeadi")
	{
		$sorguilavesi = 'AND book_name LIKE "%'.$aramaanahtari.'%"';
	}
	if ($listetipi == "yazaradi")
	{
		$sorguilavesi = 'AND book_author LIKE "%'.$aramaanahtari.'%"';
		$siralama = 'yazaradi ASC, book_name ASC';
	}
	if ($listetipi == "barkod")
	{
		$sorguilavesi = 'AND book_isbn LIKE "%'.$aramaanahtari.'%"';
		$siralama = 'book_isbn ASC, book_name ASC';
	}

	//durumlar için liste tipleri oluþturuluyor
	if ($listetipi == "acik")
	{
		$sorguilavesi = 'AND book_status IN (0,1)';
	}
	if ($listetipi == "durgun")
	{
		$sorguilavesi = 'AND book_status IN (2,3)';
	}
	if ($listetipi == "kapali")
	{
		$sorguilavesi = 'AND book_status IN (4,5,6)';
	}

	if ($listetipi == "dusyayincilik")
	{
		$sorguilavesi = 'AND book_publisher = "1"';
	}
	if ($listetipi == "adimkitap")
	{
		$sorguilavesi = 'AND book_publisher = "2"';
	}
	if ($listetipi == "digeryayinevleri")
	{
		$sorguilavesi = 'AND book_publisher NOT IN (1,2)';
	}

	if ($listetipi == "mustafaislamoglu")
	{
		$sorguilavesi = 'AND book_author = "mustafa islamoðlu"';
	}

	#############################################################
	# iç sýralamalar oluþturuluyor
	#############################################################
	if ($siralamatipi == "tarih")
	{
		$siralama = 'createtar '.$order_by.', changetar '.$order_by;
	}
	else if ($siralamatipi == "book_name")
	{
		$siralama = 'book_name '.$order_by;
	}
	else if ($siralamatipi == 'book_author')
	{
		$siralama = 'book_author '.$order_by.', book_name ASC';	
	}
	else if ($siralamatipi == 'book_pagecount')
	{
		$siralama = 'book_pagecount '.$order_by.', book_name ASC';	
	}
	else if ($siralamatipi == 'book_isbn')
	{
		$siralama = 'book_isbn '.$order_by.', book_name ASC';	
	}
	else if ($siralamatipi == 'book_publisher')
	{
		$siralama = 'book_publisher '.$order_by.', book_name ASC';	
	}
	else if ($siralamatipi == 'book_pubnumber')
	{
		$siralama = 'book_pubnumber '.$order_by.', book_name ASC';	
	}
	else if ($siralamatipi == 'book_serias')
	{
		$siralama = 'book_serias '.$order_by.', book_name ASC';	
	}
	else if ($siralamatipi == 'book_serias_id')
	{
		$siralama = 'book_serias_id '.$order_by.', book_name ASC';	
	}
	else if ($siralamatipi == 'book_publish_planed_date')
	{
		$siralama = 'book_publish_planed_date '.$order_by.', book_name ASC';	
	}
	else if ($siralamatipi == 'book_type')
	{
		$siralama = 'book_type '.$order_by.', book_name ASC';	
	}
	else if ($siralamatipi == 'book_status')
	{
		$siralama = 'book_status '.$order_by.', book_name ASC';	
	}
	else
	{
		$siralama = 'book_name '.$order_by.'';	
	}
	
	//sýralama tipi oluþturuluyor
	if (!$siralama) $siralama = 'book_name '.$order_by.'';

	//limit sorgusu oluþturuluyor
	$sayfasonucmiktari = 20;
	
	if ($limit > 0)
	{ 
		$limitsorgusu = "limit ".($limit*$sayfasonucmiktari ).",".$sayfasonucmiktari;
	} 
	else
	{ 
		$limitsorgusu = "limit 0,".$sayfasonucmiktari ;
	}

	if ($limit == "hepsi") $limitsorgusu = '';
	
	//sayým için sorgu gönderiliyor
	$SORGU_sayi = '
		SELECT count(book_id) as sayim
		FROM pco_book
		WHERE book_id > 0
		'.$sorguilavesi.'
		;';
	$SORGU_sonuc = mysql_query($SORGU_sayi);
	$sayim = mysql_result($SORGU_sonuc,0,"sayim");
	$sayi = ($sayim /$sayfasonucmiktari);

	//sayfalama özelliði baþlatýlýyor
	if($sayi > 1)
	{
		$sayfalama = '<div class="successbox">Sayfalar: ';
		for ($i = 0; $i < $sayi; $i++)
		{
			$sayfalama.= '<a href="'.$acp_projelerlink.'';
			if ($listetipi)
			{
				$sayfalama.='&amp;lt='.$listetipi;
			}
			if ($siralamatipi)
			{
				$sayfalama.='&amp;order='.$siralamatipi;
			}
			if ($by)
			{
				$sayfalama.='&amp;by='.$by;
			}
			if ($aramaanahtari)
			{
				$sayfalama.='&amp;aramaanahtari='.$aramaanahtari;
			}
			$sayfalama.= ($limit == $i && $limit <> "hepsi") ? '&amp;limit='.$i.'"><strong> '.($i+1).' </strong></a> |' : '&amp;limit='.$i.'"> '.($i+1).' </a> |';		
		}
		$sayfalama.= ' <a href="'.$acp_projelerlink.'&amp;lt='.$listetipi;
		if ($siralamatipi)
		{
			$sayfalama.='&amp;order='.$siralamatipi;
		}
		if ($by)
		{
			$sayfalama.='&amp;by='.$by;
		}
		if ($aramaanahtari)
		{
			$sayfalama.='&amp;aramaanahtari='.$aramaanahtari;
		}
		$sayfalama.= '&limit=hepsi">';
		$sayfalama.= ($limit == "hepsi") ? 'Hepsi ' : 'Hepsi';
		$sayfalama.= '</a> | ('.$sayim.' adet)';
		$sayfalama.= "</div>";
	}

	$sayfalink = $acp_projelerlink;
	if ($listetipi)
	{
		$sayfalink.='&amp;lt='.$listetipi;
	}
	if ($aramaanahtari)
	{
		$sayfalink.='&amp;aramaanahtari='.$aramaanahtari;
	}
	
	//sql sorgusu oluþturuluyor
	$SORGU_cumle = '
	SELECT book_id, book_type, book_status, book_name, book_author, book_pagecount, book_isbn, book_publisher, book_pubnumber, book_serias, book_serias_id, book_publish_planed_date
	FROM pco_book
	WHERE book_id > 0
	'.$sorguilavesi.'
	ORDER BY '.$siralama.'
	'.$limitsorgusu.';';

	//sql sorgusu gönderiliyor
	//echo $SORGU_cumle;
	$SORGU_sonuc = mysql_query($SORGU_cumle);
	$bulunanadet = mysql_num_rows($SORGU_sonuc);

	//sayfa içi oluþturuluyor, döne döne
	if ($bulunanadet)
	{
		foreach ($array_yayinevi as $k => $v)
		{
			$option_yayinevi_adlari .= '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
		}		
		foreach ($array_seri_adlari as $k => $v)
		{
			$option_seri_adlari .= '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
		}

		foreach ($array_book_type as $k => $v)
		{
			$option_book_type .= '<option value="'.$k.'"><strong>'.$v.'</strong></option>'. "\r\n";
		}

		foreach ($array_book_status as $k => $v)
		{
			$option_book_status .= '<option value="'.$k.'"><strong>'.$v.'</strong></option>'. "\r\n";
		}

		for ( $i = 0; $i < $bulunanadet; $i++)
		{
			$project_book_id = mysql_result($SORGU_sonuc,$i,"book_id");
			$project_book_name = mysql_result($SORGU_sonuc,$i,"book_name");
			$project_book_author = mysql_result($SORGU_sonuc,$i,"book_author");
			$project_book_pagecount = mysql_result($SORGU_sonuc,$i,"book_pagecount");
			$project_book_isbn = mysql_result($SORGU_sonuc,$i,"book_isbn");
			$project_book_publisher = mysql_result($SORGU_sonuc,$i,"book_publisher");
			$project_book_pubnumber = mysql_result($SORGU_sonuc,$i,"book_pubnumber");
			$project_book_serias = mysql_result($SORGU_sonuc,$i,"book_serias");
			$project_book_serias_id = mysql_result($SORGU_sonuc,$i,"book_serias_id");
			$project_book_publish_planed_date = mysql_result($SORGU_sonuc,$i,"book_publish_planed_date");
			$project_book_type = mysql_result($SORGU_sonuc,$i,"book_type");
			$project_book_status = mysql_result($SORGU_sonuc,$i,"book_status");
			$project_publish_planed_date_day = date('j', $project_book_publish_planed_date);
			$project_publish_planed_date_month = date('n', $project_book_publish_planed_date);
			$project_publish_planed_date_year = date('Y', $project_book_publish_planed_date);
			
			//ay no, ay ismine dönüþtürülüyor
			$project_publish_planed_date_month = $array_aylar[$project_publish_planed_date_month];
			
			//slash iþaretleri temizleniyor
			$project_book_name = stripslashes($project_book_name);
			$project_book_author = stripslashes($project_book_author);

			if ($i%2) { $trcolor = "col2"; } else { $trcolor = "col1"; }

			$sayfabilgisi.= '
			<tr class="'.$trcolor.'">
				<td><a class="vitrinler" title="proje bilgilerini güncelle" href="'.$acp_projelerlink.'&amp;un='.$project_book_id.'"><img src="'.SITELINK.'/_img/icon_edit.gif"> Düzenle</a></td>
				<td>'.strtoupper(pco_format_urunbaslik($project_book_name)).'</td>
				<td>'.strtoupper($project_book_author).'</td>
				<td width="120">
					<div> '.$project_publish_planed_date_day.' '.$project_publish_planed_date_month.' '.$project_publish_planed_date_year.'</div>
				</td>				
				<td><div><input style="width:30px" type="text" name="project_book_pagecount['.$project_book_id.']" value="'.$project_book_pagecount.'"></div></td>
				<td><div>'.$project_book_isbn.'</div></td>
				<td>
					<div>
						<select name="project_book_publisher['.$project_book_id.']">
							<option value="'.$project_book_publisher.'">'.$array_yayinevi[$project_book_publisher].'</option>
							'.$option_yayinevi_adlari.'
						</select>
					</div>
				</td>
				<td><div><input style="width:40px" type="text" name="project_book_pubnumber['.$project_book_id.']" value="'.$project_book_pubnumber.'"></div></td>
				<td>
					<div>
						<select style="width:150px" name="project_book_serias['.$project_book_id.']">
							<option value="'.$project_book_serias.'">'.$array_seri_adlari[$project_book_serias].'</option>
							'.$option_seri_adlari.'
						</select>
					</div>
				</td>
				<td><div><input style="width:30px" type="text" name="project_book_serias_id['.$project_book_id.']" value="'.$project_book_serias_id.'"></div></td>
				<!--
				<td>
					<div>
						<select style="width:70px" name="project_book_type['.$project_book_id.']" style="width:150px">
							<option value="'.$project_book_type.'">'.$array_book_type[$project_book_type].'</option>
							'.$option_book_type.'
						</select>
					</div>
				</td>
				-->
				<td>
					<div>
						<select style="width:100px" name="project_book_status['.$project_book_id.']" style="width:150px">
							<option value="'.$project_book_status.'">'.$array_book_status[$project_book_status].'</option>
							'.$option_book_status.'
						</select>
					</div>
				</td>				
			</tr>';
		}
	}
	else
	{
		$sayfabilgisi = '<div class="errorbox">Hiçbir Sonuç Bulunamadý!</div>';
	}
?>		

<a class="button1" href="<?php echo $acp_projelerlink?>&projeekle=1"><img src="<?php echo SITELINK?>/_img/_ca/icon_ekle.png">PROJE EKLE</a>

Bu paneli kullanarak, sisteme kayýtlý projeleri güncelleyebilir ve silebilirsiniz.<br><br>

<?php echo $islemsonucu?>

<table class="vitrinler" width="%100" border="0" cellpadding="3" cellspacing="3">
	<tr>
		<td colspan="15"><?php echo $sayfalama?></td>
	</tr>
	<tr>
		<td colspan="15">
		<div>
			<form action="<?php echo $acp_projelerlink?>" method="get">
			Aranacak kelime: 
			<input type="hidden" name="menu" value="projeler">
			<input type="text" style="width: 250px;" name="aramaanahtari" value="<?php echo $aramaanahtari?>"/>
			<select size="1" name="aramatipi" style="width:100px">
			<option value="projeadi" selected="selected">proje adý</option>
			<option value="yazaradi">yazar adý</option>
			<option value="barkod">barkod</option>
			</select>
			<input class="button1" value=" Araþtýr " type="submit"> 
			(<?php echo $bulunanadet?> sonuç görüntüleniyor)
			</form>
		</div>
		</td>
	</tr>
	<tr>
		<td colspan="15">
		<div>
		<a class="button1" href="<?php echo $acp_projelerlink?>">Tüm Projeler</a> |
		<a class="button1" href="<?php echo $acp_projelerlink?>&amp;lt=acik">Açýk</a> 
		<a class="button1" href="<?php echo $acp_projelerlink?>&amp;lt=durgun">Beklemede</a>
		<a class="button1" href="<?php echo $acp_projelerlink?>&amp;lt=kapali">Tamamlandý</a> | 
		<a class="button1" href="<?php echo $acp_projelerlink?>&amp;lt=dusyayincilik">Düþün Yayýncýlýk</a> 
		<a class="button1" href="<?php echo $acp_projelerlink?>&amp;lt=adimkitap">Adým Kitap</a>
		<a class="button1" href="<?php echo $acp_projelerlink?>&amp;lt=digeryayinevleri">Diðer Yayýnevleri</a> |
		<a class="button1" href="<?php echo $acp_projelerlink?>&amp;lt=mustafaislamoglu">Mustafa Ýslamoðlu</a>
		</div>
		</td>
	</tr>
	<tr>
		<th height="25">
			<?php if($siralamatipi == 'time' && $by == 0) { echo '<a href="'.$sayfalink.'&order=time&by=1"">time <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'time' && $by == 1) { echo '<a href="'.$sayfalink.'&order=time&by=0">time <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=time">time</a> '; } ?>
		</th>
		<th>
			<?php if($siralamatipi == 'book_name' && $by == 0) { echo '<a href="'.$sayfalink.'&order=book_name&by=1"">PROJE ADI <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'book_name' && $by == 1) { echo '<a href="'.$sayfalink.'&order=book_name&by=0">PROJE ADI <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=book_name">PROJE ADI</a> '; } ?>
		</th>
		<th>
			<?php if($siralamatipi == 'book_author' && $by == 0) { echo '<a href="'.$sayfalink.'&order=book_author&by=1"">YAZAR ADI <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'book_author' && $by == 1) { echo '<a href="'.$sayfalink.'&order=book_author&by=0">YAZAR ADI <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=book_author">YAZAR ADI</a> '; } ?>
		</th>
		<th>
			<?php if($siralamatipi == 'book_publish_planed_date' && $by == 0) { echo '<a href="'.$sayfalink.'&order=book_publish_planed_date&by=1"">YAYINLANACAK TARÝH <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'book_publish_planed_date' && $by == 1) { echo '<a href="'.$sayfalink.'&order=book_publish_planed_date&by=0">YAYINLANACAK TARÝH <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=book_publish_planed_date">YAYINLANACAK TARÝH</a> '; } ?>
		</th>
		<th>
			<?php if($siralamatipi == 'book_pagecount' && $by == 0) { echo '<a href="'.$sayfalink.'&order=book_pagecount&by=1"">SAYFA <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'book_pagecount' && $by == 1) { echo '<a href="'.$sayfalink.'&order=book_pagecount&by=0">SAYFA <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=book_pagecount">SAYFA</a> '; } ?>
		</th>
		<th>
			<?php if($siralamatipi == 'book_isbn' && $by == 0) { echo '<a href="'.$sayfalink.'&order=book_isbn&by=1"">BARKOD <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'book_isbn' && $by == 1) { echo '<a href="'.$sayfalink.'&order=book_isbn&by=0">BARKOD <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=book_isbn">BARKOD</a> '; } ?>
		</th>
		<th>
			<?php if($siralamatipi == 'book_publisher' && $by == 0) { echo '<a href="'.$sayfalink.'&order=book_publisher&by=1"">YAYINEVÝ <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'book_publisher' && $by == 1) { echo '<a href="'.$sayfalink.'&order=book_publisher&by=0">YAYINEVÝ <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=book_publisher">YAYINEVÝ</a> '; } ?>
		</th>
		<th>
			<?php if($siralamatipi == 'book_pubnumber' && $by == 0) { echo '<a href="'.$sayfalink.'&order=book_pubnumber&by=1"">SIRT NO <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'book_pubnumber' && $by == 1) { echo '<a href="'.$sayfalink.'&order=book_pubnumber&by=0">SIRT NO <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=book_pubnumber">SIRT NO</a> '; } ?>
		</th>
		<th>
			<?php if($siralamatipi == 'book_serias' && $by == 0) { echo '<a href="'.$sayfalink.'&order=book_serias&by=1"">SERÝ ADI <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'book_serias' && $by == 1) { echo '<a href="'.$sayfalink.'&order=book_serias&by=0">SERÝ ADI <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=book_serias">SERÝ ADI</a> '; } ?>
		</th>
		<th>
			<?php if($siralamatipi == 'book_serias_id' && $by == 0) { echo '<a href="'.$sayfalink.'&order=book_serias_id&by=1"">SERÝ NO <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'book_serias_id' && $by == 1) { echo '<a href="'.$sayfalink.'&order=book_serias_id&by=0">SERÝ NO <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=book_serias_id">SERÝ NO</a> '; } ?>
		</th>
		<!--
		<th>
			<?php if($siralamatipi == 'book_type' && $by == 0) { echo '<a href="'.$sayfalink.'&order=book_type&by=1"">TÝP <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'book_type' && $by == 1) { echo '<a href="'.$sayfalink.'&order=book_type&by=0">TÝP <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=book_type">TÝP</a> '; } ?>
		</th>
		-->
		<th>
			<?php if($siralamatipi == 'book_status' && $by == 0) { echo '<a href="'.$sayfalink.'&order=book_status&by=1"">DURUM <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'book_status' && $by == 1) { echo '<a href="'.$sayfalink.'&order=book_status&by=0">DURUM <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=book_status">DURUM</a> '; } ?>
		</th>
	</tr>

<form name="topluduzenle" action="<?php echo $acp_projelerlink?>" method="POST">
<input type="hidden" name="menu" value="projeler">
<input type="hidden" name="topluduzenle" value="1">
<input type="hidden" name="aramaanahtari" value="<?php echo $aramaanahtari ?>">
<input type="hidden" name="aramatipi" value="<?php echo $aramatipi ?>">
<input type="hidden" name="lt" value="<?php echo $listetipi ?>">
<input type="hidden" name="order" value="<?php echo $siralamatipi ?>">
<input type="hidden" name="limit" value="<?php echo $limit ?>">

<?php echo $sayfabilgisi?>
	<tr>
		<td colspan="15"><?php echo $sayfalama?></td>
	</tr>
	<tr>
		<td colspan="15"><div align="right"><input class="button1" type="submit" name="topluduzenle" value="TOPLU DÜZENLE"></div></td>
	</tr>
</table>
</form>
<?php
	//(if $project_book_id > 0) ... else sonu
	}
?>

<?php include($siteyolu."/_panel_acp/_temp/_t_adminbitis.php"); ?>