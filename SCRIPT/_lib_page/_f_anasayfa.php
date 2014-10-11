<?php if (!defined('yakusha')) die('...'); 

	//reset
	$siralama = '';
	$sorguilavesi = '';

	//sql sorgusu oluþturuluyor
	
	if ($iccat > 0)
	{
		$SORGU_cumle = '
		SELECT 
		*
		FROM pco_stok,pco_vitrinler
		WHERE  
		pco_vitrinler.stokkod = pco_stok.stokno
		AND pco_vitrinler.vitrintipi = '.$iccat.'
		AND satisdurumu IN (0,1,2) 
		AND yayinevino = 1
		ORDER BY vitrintar DESC
		LIMIT 0,30
		;';
	}
	
	if ($cat > 0)
	{
		$SORGU_cumle = '
		SELECT 
		*
		FROM pco_stok,pco_vitrinler
		WHERE  
		pco_vitrinler.stokkod = pco_stok.stokno
		AND pco_vitrinler.vitrintipi = '.$cat.'
		AND satisdurumu IN (0,1,2) 
		AND yayinevino = 1
		ORDER BY vitrintar DESC
		LIMIT 0,30
		;';
	}
	
	if ($seri > 0)
	{
		$SORGU_cumle = '
		SELECT 
		*
		FROM pco_stok
		WHERE  
		pco_stok.stokno > 0
		AND pco_stok.serino = '.$seri.'
		AND satisdurumu IN (0,1,2) 
		AND yayinevino = 1
		ORDER BY urunadi ASC
		;';
	}

	if ($aramatipi == 'urunadi' && $aramaanahtari <> '')
	{
		$SORGU_cumle = '
		SELECT 
		*
		FROM pco_stok
		WHERE  
		stokno > 0
		AND urunadi LIKE "%'.$aramaanahtari.'%"
		AND satisdurumu IN (0,1,2) 
		AND yayinevino = 1
		ORDER BY urunadi ASC
		;';
		//echo '<pre>'.$SORGU_cumle.'</pre>';
	}
	
	if ($aramatipi == 'yazaradi' && $aramaanahtari <> '')
	{
		$SORGU_cumle = '
		SELECT 
		*
		FROM pco_stok
		WHERE  
		stokno > 0
		AND yazaradi LIKE "%'.$aramaanahtari.'%"
		AND satisdurumu IN (0,1,2) 
		AND yayinevino = 1
		ORDER BY urunadi ASC
		;';
		//echo '<pre>'.$SORGU_cumle.'</pre>';
	}
	//sql sorgusu gönderiliyor
	//echo $SORGU_cumle;
	$SORGU_sonuc = mysql_query($SORGU_cumle);
	$bulunanadet = mysql_num_rows($SORGU_sonuc);

	//sayfa içi oluþturuluyor, döne döne
	$sayfabilgisi = '';
	if ($bulunanadet)
	{
		for ($i = 0; $i < $bulunanadet; $i++) 
		{
			if ($i%2) { $trcolor = "col2"; } else { $trcolor = "col1"; }

			$stokno = mysql_result($SORGU_sonuc,$i,"stokno");
			$urunadi = mysql_result($SORGU_sonuc,$i,"urunadi");
			$yazaradi = mysql_result($SORGU_sonuc,$i,"yazaradi");
			$editoradi = mysql_result($SORGU_sonuc,$i,"editoradi");
			$sayfasayisi = mysql_result($SORGU_sonuc,$i,"sayfasayisi");
			$satisfiyati = mysql_result($SORGU_sonuc,$i,"satisfiyati");
			$satiskdv = mysql_result($SORGU_sonuc,$i,"satiskdv");
			$satisdurumu = mysql_result($SORGU_sonuc,$i,"satisdurumu");
			$barkod = mysql_result($SORGU_sonuc,$i,"barkod");
			$kidaplink = mysql_result($SORGU_sonuc,$i,"kidaplink");
			$yayindili = mysql_result($SORGU_sonuc,$i,"yayindili");
			$yayinevino = mysql_result($SORGU_sonuc,$i,"yayinevino");

			//slash iþaretleri temizleniyor
			$urunadi = stripslashes($urunadi);
			$yazaradi = stripslashes($yazaradi);			
			$urunadi_temiz = $urunadi;

			if ($satisfiyati == 0) $satisfiyati = '';
			$satisfiyati = number_format($satisfiyati,2, '.', '');	

			$editoradi = stripslashes($editoradi);
			$urunadi = pco_format_urunbaslik($urunadi);

			$file_link = SITELINK.'/' . URUNDETAY . '?pid=' . $stokno .'-'. pco_format_url($urunadi_temiz) ;
			if (SEO_OPEN == 1) $file_link = SITELINK.'/' . pco_format_url($urunadi_temiz) . '-'.DETAY . $stokno . SEO;

			if ($kidaplink > 0)
			{
				$satislinki = '<a target="_blank" class="vitrinler" href="http://www.'.SATIS.'/'.pco_format_url($urunadi).'-'.pco_format_url($yazaradi).'-k'.$kidaplink.'.kitap"><img title="" src="'.SITELINK.'/_img/_icon_sepet.gif"></a>';
				$resimlinki = '_img_book/'.$barkod.'.jpg';
				if (!file_exists($resimlinki))
				{
					$dosyaadi = 'http://www.'.SATIS.'/_cresim/_isbn_200_'.$barkod.'.jpg';
					$dosyayolu = './../../'.SATIS.'/public_html/_cresim/_isbn_200_'.$barkod.'.jpg';
					if (file_exists($dosyayolu))
					{ 
						$resimlinki = $dosyaadi;
					}
					else 
					{ 
						$resimlinki = 'http://www.'.SATIS.'/'.pco_format_url($stokcins).'-'.pco_format_url($yazar).'-isbn'.$barkod.'-sz200.jpg';
					}
				}
			}
			else
			{
				$satislinki = '';
				$resimlinki = '';
			}
			
			$sayfabilgisi.= '
			<td width="50%" valign="top">
					<table class="myproject" align="left" border="0" cellpadding="0" cellspacing="0" width="100%" valign="top">
						<tr height="60px">
							<td colspan="2">
							<h2 class="title">'.strtoupper($urunadi).'</h2>
							</td>
						</tr>
						<tr>
							<td valign="top">
							<a title="'.$urunadi_temiz.'" href="'.$file_link.'"><img height="210" title="'.$urunadi_temiz.' - '.$yazaradi.'" src="'.$resimlinki.'"></a>
							</td>
							<td width="100%" style="padding: 10px;" valign="top">
								<p class="byline">'.strtoupper($yazaradi).'</p>
								<table class="vitrinler" border="0" width="100%">
								<tr><td><font color="#666666">Fiyatý </td><td>&nbsp;:&nbsp;</td><td>&nbsp;<font color="#0000cc"><font size="4">'.$satisfiyati.'</font> TL</font></td></tr>
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr><td>Barkod</td><td>&nbsp;:&nbsp;</td><td>&nbsp;'.$barkod.'</td></tr>
								<tr><td>Sayfa</td><td>&nbsp;:&nbsp;</td><td>&nbsp;'.$sayfasayisi.'</td></tr>
								</table>
								<br>
								<table>
									<tr>
										<td><a title="'.$urunadi_temiz.'" href="'.$file_link.'"><img src="'.SITELINK.'/_img/_icon_detay.gif"></a></td>
										</tr>
										<tr>
										<td>'.$satislinki.'</td>
									</tr>
								</table
							</td>
						</tr>
					</table>
			</td>
		';
		if ($i%2) $sayfabilgisi.= '</tr><tr>';
		}

	}
	else
	{
		$sayfabilgisi = '<td>Hiçbir sonuç bulunamadý.</td>';
	}
?>		


<div class="right_articles">
<?php if ($iccat) { ?>
	<a href="<?php echo ANASAYFALINK?>">Ana Sayfa</a> &raquo; <a href="<?php echo ANASAYFALINK.'?cat='.$iccat;?>"> <?php echo $array_vitrin_tipleri[$iccat]?> </a>
<?php } ?>

<?php if ($cat) { ?>
	<a href="<?php echo ANASAYFALINK?>">Ana Sayfa</a> &raquo; <a href="<?php echo ANASAYFALINK.'?cat='.$iccat;?>"> <?php echo $array_vitrin_tipleri[$cat]?> | <?php echo $bulunanadet?> sonuç bulundu</a>
<?php } ?>

<?php if ($seri) { ?>
	<a href="<?php echo ANASAYFALINK?>">Ana Sayfa</a> &raquo; <a href="<?php echo ANASAYFALINK.'?seri='.$seri;?>"> <?php echo $array_seri_adlari[$seri]?> | <?php echo $bulunanadet?> sonuç bulundu</a>
<?php } ?>

<?php if ($aramatipi == 'urunadi' && $aramaanahtari <> '') { ?>
	<a href="<?php echo ANASAYFALINK?>">Ana Sayfa</a> &raquo; Ürün Ara &raquo; <?php echo $get_aramaanahtari?> | <?php echo $bulunanadet?> sonuç bulundu</a>
<?php } ?>

<?php if ($aramatipi == 'yazaradi' && $aramaanahtari <> '') { ?>
	<a href="<?php echo ANASAYFALINK?>">Ana Sayfa</a> &raquo; Yazar Ara &raquo; <?php echo $get_aramaanahtari?> | <?php echo $bulunanadet?> sonuç bulundu</a>
<?php } ?>

</div>

<div class="post">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<?php echo $sayfabilgisi?>
</tr>
</table>
</div>
