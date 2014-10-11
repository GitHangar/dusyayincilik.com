<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"]==1) exit ();

include($siteyolu."/_panel_acp/_temp/_t_adminbaslangic.php"); 

$duzenle		= $_REQUEST['duzenle']; 	settype($content_id,"integer");
$yazi_ekle 		= $_REQUEST['ekle']; 		settype($yazi_ekle,"integer");
if ($duzenle > 0)
{
	include($siteyolu."/_panel_acp/_acp_yazilar_duzenle.php");
}
elseif ($yazi_ekle > 0)
{
	include($siteyolu."/_panel_acp/_acp_yazilar_ekle.php");
}
else
{
	$text_title 				= 'Yazýlar';
	$text_tumliste 				= 'Tüm Yazýlar';
	$text_pageinfo 				= 'Bu paneli kullanarak, sisteme kayýtlý yazýlarý yönetebilirsiniz.';

	$acp_sayfalink 				= $acp_yazilarlink;
	$acp_menuname 				= 'yazilar';
	$tablename 					= 'pco_content';
	$tableid 					= 'content_id';

	$page_count_sql 			= 'SELECT count(content_id) as sayim FROM '.$tablename.' WHERE content_id > 0';
	$page_full_sql 				= 'SELECT * FROM '.$tablename.' WHERE content_id > 0'; 

	$array_sablon["text"][1] 	= 'TARÝH'; 
	$array_sablon["type"][1] 	= 'tarih'; 
	$array_sablon["sql"][1] 	= 'createtar'; 
	
	$array_sablon["text"][2] 	= 'ID'; 
	$array_sablon["type"][2] 	= 'content_id'; 
	$array_sablon["sql"][2] 	= 'content_id'; 

	$array_sablon["text"][3] 	= 'BAÞLIK'; 
	$array_sablon["type"][3] 	= 'content_title'; 
	$array_sablon["sql"][3] 	= 'content_title'; 

	$array_sablon["text"][4] 	= 'YAZAR'; 
	$array_sablon["type"][4] 	= 'content_author'; 
	$array_sablon["sql"][4] 	= 'content_author'; 

	$array_sablon["text"][5] 	= 'RESÝM'; 
	$array_sablon["type"][5] 	= 'content_image'; 
	$array_sablon["sql"][5] 	= 'content_image'; 

	$array_sablon["text"][6] 	= 'KATEGORÝ'; 
	$array_sablon["type"][6] 	= 'content_cat'; 
	$array_sablon["sql"][6] 	= 'content_cat'; 

	$array_sablon["text"][7] 	= 'YAYINCI'; 
	$array_sablon["type"][7] 	= 'content_publisher'; 
	$array_sablon["sql"][7] 	= 'content_publisher'; 

	$array_sablon["text"][8] 	= 'DURUM'; 
	$array_sablon["type"][8] 	= 'content_status'; 
	$array_sablon["sql"][8] 	= 'content_status'; 

	//alt menü dizisi
	$array_menu["text"][1] 		= 'Aktif Yazýlar'; 
	$array_menu["type"][1] 		= 'aktifyazilar'; 
	$array_menu["sql"][1] 		= 'AND content_status = 1'; 

	$array_menu["text"][2] 		= 'Taslak Yazýlar'; 
	$array_menu["type"][2]		= 'taslakyazilar'; 
	$array_menu["sql"][2] 		= 'AND content_status = 2';  

	$array_menu["text"][3] 		= 'Pasif Yazýlar'; 
	$array_menu["type"][3]		= 'pasifyazilar'; 
	$array_menu["sql"][3] 		= 'AND content_status = 0';  

	// echo '<pre>';
	// print_r($array_sablon);
	// echo '</pre>';
	//reset
	$siralama 					= '';
	$sorguilavesi 				= '';

	//form için gereken deðiþkenler alýnýyor
	$listetipi 					= $_REQUEST['lt'];
	$limit 						= $_REQUEST['limit'];
	$siralamatipi 				= $_REQUEST['order'];
	$aramaanahtari 				= $_REQUEST['aramaanahtari'];
	$aramatipi 					= $_REQUEST['aramatipi'];
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

	//güvenlik için dönüþüm
	$aramaanahtari 				= htmlspecialchars($aramaanahtari);
	$aramatipi 					= htmlspecialchars($aramatipi);
	$siralamatipi 				= htmlspecialchars($siralamatipi);

	//formu oluþturmaya baþlýyoruz
	//arama tipleri oluþturuluyor
	if ($aramatipi == $array_sablon["type"][3]) $listetipi = $array_sablon["type"][3];
	if ($aramatipi == $array_sablon["type"][4]) $listetipi = $array_sablon["type"][4];
	if ($aramatipi == $array_sablon["type"][7]) $listetipi = $array_sablon["type"][7];

	//arama tipleri sql sorgularý oluþturuluyor
	if ($listetipi == $array_sablon["type"][3]) $sorguilavesi = 'AND '.$array_sablon["sql"][3].' LIKE "%'.$aramaanahtari.'%"';
	if ($listetipi == $array_sablon["type"][4]) $sorguilavesi = 'AND '.$array_sablon["sql"][4].' LIKE "%'.$aramaanahtari.'%"';
	//alt menüyü oluþturan deðerler için sql sorgulamasý
	if ($listetipi == $array_menu["type"][1]) $sorguilavesi = $array_menu["sql"][1];
	if ($listetipi == $array_menu["type"][2]) $sorguilavesi = $array_menu["sql"][2];
	if ($listetipi == $array_menu["type"][3]) $sorguilavesi = $array_menu["sql"][3];

	//iç sýralamalar oluþturuluyor
	if ($siralamatipi == $array_sablon["type"][1])
	{
		$siralama = $array_sablon["sql"][1].' '.$order_by;	
	}
	else if ($siralamatipi == $array_sablon["type"][2])
	{
		$siralama = $array_sablon["sql"][2].' '.$order_by;
	}
	else if ($siralamatipi == $array_sablon["type"][3])
	{
		$siralama = $array_sablon["sql"][3].' '.$order_by.', '.$array_sablon["sql"][2].' ASC';	
	}
	else if ($siralamatipi == $array_sablon["type"][4])
	{
		$siralama = $array_sablon["sql"][4].' '.$order_by.', '.$array_sablon["sql"][2].' ASC';	
	}
	else if ($siralamatipi == $array_sablon["type"][5])
	{
		$siralama = $array_sablon["sql"][5].' '.$order_by.', '.$array_sablon["sql"][2].' ASC';	
	}
	else if ($siralamatipi == $array_sablon["type"][6])
	{
		$siralama = $array_sablon["sql"][6].' '.$order_by.', '.$array_sablon["sql"][2].' ASC';	
	}
	else if ($siralamatipi == $array_sablon["type"][7])
	{
		$siralama = $array_sablon["sql"][7].' '.$order_by.', '.$array_sablon["sql"][2].' ASC';	
	}
	else if ($siralamatipi == $array_sablon["type"][8])
	{
		$siralama = $array_sablon["sql"][8].' '.$order_by.', '.$array_sablon["sql"][2].' ASC';	
	}
	else
	{
		$siralama = 'createtar DESC';	
	}
	//sýralama tipi oluþturuluyor
	if (!$siralama) $siralama = $array_sablon["sql"][1].' '.$order_by;

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
	$vt->sql($page_count_sql.' '.$sorguilavesi)->sor();
	$sayim = $vt->alTek();
	$sayi = ($sayim /$sayfasonucmiktari);

	//sayfalama özelliði baþlatýlýyor
	if($sayi > 1)
	{
		$sayfalama = '<div class="successbox">Sayfalar: ';
		for ($i = 0; $i < $sayi; $i++)
		{
			$sayfalama.= '<a href="'.$acp_sayfalink.'';
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
		$sayfalama.= ' <a href="'.$acp_sayfalink.'&amp;lt='.$listetipi;
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

	$sayfalink = $acp_sayfalink;
	if ($listetipi)
	{
		$sayfalink.='&amp;lt='.$listetipi;
	}
	if ($aramaanahtari)
	{
		$sayfalink.='&amp;aramaanahtari='.$aramaanahtari;
	}
	
	//sql sorgusu oluþturuluyor
	$vt->sql($page_full_sql.' '.$sorguilavesi.' ORDER BY '.$siralama.' '.$limitsorgusu)->sor();
	$sonuc_liste = $vt->alHepsi();
	$bulunanadet = $vt->numRows();
	//sayfa içi oluþturuluyor, döne döne
	if ($bulunanadet)
	{
		for ( $i = 0; $i < $bulunanadet; $i++)
		{
			$id = $sonuc_liste[$i]->$tableid;
			$sonuc_1 = $sonuc_liste[$i]->$array_sablon["sql"][1];
			$sonuc_2 = $sonuc_liste[$i]->$array_sablon["sql"][2];
			$sonuc_3 = $sonuc_liste[$i]->$array_sablon["sql"][3];
			$sonuc_4 = $sonuc_liste[$i]->$array_sablon["sql"][4];
			$sonuc_5 = $sonuc_liste[$i]->$array_sablon["sql"][5];

			//renklendirme
			if ($i%2) { $trcolor = "col2"; } else { $trcolor = "col1"; }

			//slash iþaretleri temizleniyor
			$sonuc_1 = stripslashes($sonuc_1);
			$sonuc_2 = stripslashes($sonuc_2);
			$sonuc_3 = stripslashes($sonuc_3);
			$sonuc_4 = stripslashes($sonuc_4);

			//düzenlenmesi gereken deðerler
			$sonuc_2 = '<a class="vitrinler" href="'.$acp_sayfalink.'&amp;duzenle='.$id.'"><img src="'.SITELINK.'/_img/icon_edit.gif">Düzenle</a>';

			$content_link = SITELINK.'/' . MAKALEDETAY . '?'.ID.'=' . $id .'-'. pco_format_url($sonuc_3);
			if (SEO_OPEN == 1) $content_link = SITELINK.'/' . pco_format_url($sonuc_3) . '-' . MSEO_ID . $id . SEO;
			$sonuc_3 = '<a class="vitrinler" href="'.$content_link.'">'.pco_upper_first($sonuc_3).'</a>';

			$sayfabilgisi.= '
			<tr class="'.$trcolor.'">
				<td>'.$sonuc_2.'<br></td>
				<td>'.$sonuc_3.'</td>
				<td>'.$sonuc_4.'</td>
				<td>'.$sonuc_5.'</td>
			</tr>';
		}
	}
	else
	{
		$sayfabilgisi = '<div class="errorbox">Hiçbir Sonuç Bulunamadý!</div>';
	}
?>	

<?=$ilavebilgi?>

<a class="button1" href="<?=$acp_yazilarlink?>&amp;ekle=1"><img src="<?=SITELINK?>/_img/_ca/icon_ekle.png">YAZI EKLE</a>
<?=$text_pageinfo?><br>
<br>
<?=$islemsonucu?>

<table class="vitrinler" width="%100" border="0" cellpadding="3" cellspacing="3">
	<tr>
		<td colspan="11"><?=$sayfalama?></td>
	</tr>
	<tr>
		<td colspan="11">
		<div>
			<form action="<?=$acp_sayfalink?>" method="get">
			Aranacak kelime: 
			<input type="hidden" name="menu" value="<?=$acp_menuname?>">
			<input type="text" style="width: 250px;" name="aramaanahtari" value="<?=$aramaanahtari?>"/>
			<select size="1" name="aramatipi" style="width:100px">
			<option <?php if($aramatipi == $array_sablon["type"][3]) echo 'selected="selected"';?> value="<?=$array_sablon["type"][3]?>"><?=$array_sablon["text"][3]?></option>
			<option <?php if($aramatipi == $array_sablon["type"][4]) echo 'selected="selected"';?> value="<?=$array_sablon["type"][4]?>"><?=$array_sablon["text"][4]?></option>
			</select>
			<input class="button1" value=" Araþtýr " type="submit"> 
			(<?=$bulunanadet?> sonuç görüntüleniyor)
			</form>
		</div>
		</td>
	</tr>

	<th width="100">
	<?php if($siralamatipi == $array_sablon["type"][1] && $by == 0) { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][1].'&by=1"">'.$array_sablon["text"][1].' <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == $array_sablon["type"][1] && $by == 1) { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][1].'&by=0">'.$array_sablon["text"][1].' <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][1].'">'.$array_sablon["text"][1].'</a> '; } ?>
	</th>

	<th>
	<?php if($siralamatipi == $array_sablon["type"][3] && $by == 0) { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][3].'&by=1"">'.$array_sablon["text"][3].' <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == $array_sablon["type"][3] && $by == 1) { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][3].'&by=0">'.$array_sablon["text"][3].' <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][3].'">'.$array_sablon["text"][3].'</a> '; } ?>
	</th>

	<th>
	<?php if($siralamatipi == $array_sablon["type"][4] && $by == 0) { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][4].'&by=1"">'.$array_sablon["text"][4].' <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == $array_sablon["type"][4] && $by == 1) { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][4].'&by=0">'.$array_sablon["text"][4].' <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][4].'">'.$array_sablon["text"][4].'</a> '; } ?>
	</th>

	<th>
	<?php if($siralamatipi == $array_sablon["type"][5] && $by == 0) { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][5].'&by=1"">'.$array_sablon["text"][5].' <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == $array_sablon["type"][5] && $by == 1) { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][5].'&by=0">'.$array_sablon["text"][5].' <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][5].'">'.$array_sablon["text"][5].'</a> '; } ?>
	</th>
<!--
	<th width="100">
	<?php if($siralamatipi == $array_sablon["type"][6] && $by == 0) { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][6].'&by=1"">'.$array_sablon["text"][6].' <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == $array_sablon["type"][6] && $by == 1) { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][6].'&by=0">'.$array_sablon["text"][6].' <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][6].'">'.$array_sablon["text"][6].'</a> '; } ?>
	</th>

	<th width="100">
	<?php if($siralamatipi == $array_sablon["type"][7] && $by == 0) { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][7].'&by=1"">'.$array_sablon["text"][7].' <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == $array_sablon["type"][7] && $by == 1) { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][7].'&by=0">'.$array_sablon["text"][7].' <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][7].'">'.$array_sablon["text"][7].'</a> '; } ?>
	</th>

	<th width="60">
	<?php if($siralamatipi == $array_sablon["type"][8] && $by == 0) { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][8].'&by=1"">'.$array_sablon["text"][8].' <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == $array_sablon["type"][8] && $by == 1) { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][8].'&by=0">'.$array_sablon["text"][8].' <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order='.$array_sablon["type"][8].'">'.$array_sablon["text"][8].'</a> '; } ?>
	</th>
-->
<?=$sayfabilgisi?>

<tr>
<td colspan="9"><?=$sayfalama?></td>
</tr>
</table>
<?php
	//(if $content_id > 0) ... else sonu
	}
?>

<?php include($siteyolu."/_panel_acp/_temp/_t_adminbitis.php"); ?>
