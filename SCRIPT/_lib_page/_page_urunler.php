<?php if (!defined('yakusha')) die('...'); ?>
<?php

	//reset
	$siralama = '';
	$sorguilavesi = '';
	$sayfalink = URUNLERLINK.'?';

	//form i�in gereken de�i�kenler al�n�yor
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
	//gelen de�erleri d�zenliyoruz
	$aramaanahtari = htmlspecialchars($aramaanahtari);
	$aramatipi = htmlspecialchars($aramatipi);
	$siralamatipi = htmlspecialchars($siralamatipi);
	
	//toplu g�ncelleme i�in gereken de�erleri al�yoruz
	$urun_serino = $_REQUEST["urun_serino"];
	$urun_satisdurumu = $_REQUEST["urun_satisdurumu"];
	$urun_satisfiyati = $_REQUEST["urun_satisfiyati"]; 
	$urun_kidaplink = $_REQUEST["urun_kidaplink"]; 

	//formu olu�turmaya ba�l�yoruz
	
	//arama tipleri olu�turuluyor
	if ($aramatipi == "urunadi") 
		$listetipi = "urunadi";
	
	if ($aramatipi == "yazaradi") 
		$listetipi = "yazaradi";
	
	if ($aramatipi == "barkod") 
		$listetipi = "barkod";

	//liste tipleri olu�turuluyor
	if ($listetipi == "urunadi")
	{
		$sorguilavesi = 'AND urunadi LIKE "%'.$aramaanahtari.'%"';
	}
	if ($listetipi == "yazaradi")
	{
		$sorguilavesi = 'AND yazaradi LIKE "%'.$aramaanahtari.'%"';
		$siralama = 'yazaradi ASC, urunadi ASC';
	}
	if ($listetipi == "barkod")
	{
		$sorguilavesi = 'AND barkod LIKE "%'.$aramaanahtari.'%"';
		$siralama = 'barkod ASC';
	}
	if ($listetipi == "satista")
	{
		$sorguilavesi = 'AND satisdurumu = "0"';
	}
	if ($listetipi == "baskisiyok")
	{
		$sorguilavesi = 'AND satisdurumu = "1"';
	}
	if ($listetipi == "arsiv")
	{
		$sorguilavesi = 'AND satisdurumu not in (0,1)';
	}

	if ($listetipi == "dusyayincilik")
	{
		$sorguilavesi = 'AND yayinevino = "1"';
	}
	if ($listetipi == "adimkitap")
	{
		$sorguilavesi = 'AND yayinevino = "2"';
	}

	if ($listetipi == "mustafaislamoglu")
	{
		$sorguilavesi = 'AND yazaradi = "mustafa islamo�lu"';
	}
	
	//i� s�ralamalar olu�turuluyor
	if ($siralamatipi == "urunadi")
	{
		$siralama = 'urunadi '.$order_by;	;	
	}
	else if ($siralamatipi == 'yazaradi')
	{
		$siralama = 'yazaradi '.$order_by.', urunadi ASC';	
	}
	else if ($siralamatipi == 'yayinevi')
	{
		$siralama = 'yayinevino '.$order_by.', urunadi ASC';
	}
	else if ($siralamatipi == 'fiyati')
	{
		$siralama = 'satisfiyati '.$order_by.', urunadi ASC';
	}
	else if ($siralamatipi == 'durumu')
	{
		$siralama = 'satisdurumu '.$order_by.', urunadi ASC';
	}
	else
	{
		$siralama = 'createtar DESC';	
	}
	
	//s�ralama tipi olu�turuluyor
	if (!$siralama) $siralama = 'urunadi '.$order_by;

	//limit sorgusu olu�turuluyor
	$sayfasonucmiktari = 10;
	
	if ($limit > 0)
	{ 
		$limitsorgusu = "limit ".($limit*$sayfasonucmiktari ).",".$sayfasonucmiktari;
	} 
	else
	{ 
		$limitsorgusu = "limit 0,".$sayfasonucmiktari ;
	}

	if ($limit == "hepsi") $limitsorgusu = '';
	
	//say�m i�in sorgu g�nderiliyor
	$SORGU_sayi = '
		SELECT count(stokno) as sayim
		FROM pco_stok
		WHERE stokno > 0
		'.$sorguilavesi.'
		ORDER BY '.$siralama.';
	';
	$SORGU_sonuc = mysql_query($SORGU_sayi);
	$sayim = mysql_result($SORGU_sonuc,$i,"sayim");
	$sayi = ($sayim /$sayfasonucmiktari);

	//sayfalama �zelli�i ba�lat�l�yor
	if($sayi > 1)
	{
		$sayfalama = '<div class="pagination">Sayfalar: ';
		for ($i = 0; $i < $sayi; $i++)
		{
			$sayfalama.= '<a href="'.$sayfalink;
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
			$sayfalama.= ($limit == $i && $limit <> "hepsi") ? '&amp;limit='.$i.'"><font size="2"><strong> '.($i+1).' </strong></font></a> ' : '&amp;limit='.$i.'"> '.($i+1).' </a> ';		
		}
		$sayfalama.= ' <a href="'.$sayfalink.'&amp;lt='.$listetipi;
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
		$sayfalama.= ($limit == "hepsi") ? '<font size="2"><strong>Hepsi</strong></font>' : 'Hepsi';
		$sayfalama.= '</a> | ('.$sayim.' adet)';
		$sayfalama.= "</div>";
	}

	if ($listetipi)
	{
		$sayfalink.='&amp;lt='.$listetipi;
	}
	if ($aramaanahtari)
	{
		$sayfalink.='&amp;aramaanahtari='.$aramaanahtari;
	}
	
	//sql sorgusu olu�turuluyor
	$SORGU_cumle = '
	SELECT stokno,urunadi,yazaradi,satisfiyati,satisdurumu,sirtno,yayinevino,serino,barkod,kidaplink
	FROM pco_stok
	WHERE stokno > 0
	'.$sorguilavesi.'
	ORDER BY '.$siralama.'
	'.$limitsorgusu.';';

	//sql sorgusu g�nderiliyor
	// echo '<pre>'.$SORGU_cumle.'<pre>';
	$SORGU_sonuc = mysql_query($SORGU_cumle);
	$bulunanadet = mysql_num_rows($SORGU_sonuc);

	//sayfa i�i olu�turuluyor, d�ne d�ne
	if ($bulunanadet)
	{
		for ( $i = 0; $i < $bulunanadet; $i++)
		{
			$urun_stokno = mysql_result($SORGU_sonuc,$i,"stokno");
			$urun_urunadi = mysql_result($SORGU_sonuc,$i,"urunadi");
			$urun_yazaradi = mysql_result($SORGU_sonuc,$i,"yazaradi");
			$urun_satisfiyati = mysql_result($SORGU_sonuc,$i,"satisfiyati");
			$urun_satisdurumu = mysql_result($SORGU_sonuc,$i,"satisdurumu");
			$urun_yayinevino = mysql_result($SORGU_sonuc,$i,"yayinevino");
			$urun_serino = mysql_result($SORGU_sonuc,$i,"serino");
			$urun_barkod = mysql_result($SORGU_sonuc,$i,"barkod");
			$urun_kidaplink = mysql_result($SORGU_sonuc,$i,"kidaplink");

			if ($urun_satisfiyati == 0) $urun_satisfiyati = '';
			$urun_satisfiyati = number_format($urun_satisfiyati,2, '.', '');	
			if ($i%2) { $trcolor = "col2"; } else { $trcolor = "col1"; }

			//slash i�aretleri temizleniyor
			$urun_urunadi = stripslashes($urun_urunadi);
			$urun_yazaradi = stripslashes($urun_yazaradi);
			$file_link = SITELINK.'/' . URUNDETAY . '?pid=' . $urun_stokno .'-'. pco_format_url($urun_urunadi) ;
			if (SEO_OPEN == 1) $file_link = SITELINK.'/' . pco_format_url($urun_urunadi) . '-'.DETAY . $urun_stokno . SEO;

			if ($urun_kidaplink > 0)
			{
				$satislinki = '<a target="_blank" class="vitrinler" href="http://www.'.SATIS.'/'.pco_format_url($urun_urunadi).'-'.pco_format_url($urun_yazaradi).'-k'.$urun_kidaplink.'.kitap">
				'.$array_satisdurumu[$urun_satisdurumu].' &nbsp; '.$array_urun_satisdurumu_adlari[$urun_satisdurumu].'
				</a>';

				$resimlinki = '_img_book/'.$urun_barkod.'.jpg';
				if (!file_exists($resimlinki))
				{
					$dosyaadi = 'http://www.'.SATIS.'/_cresim/_isbn_200_'.$urun_barkod.'.jpg';
					$dosyayolu = './../../'.SATIS.'/public_html/_cresim/_isbn_200_'.$urun_barkod.'.jpg';
					if (file_exists($dosyayolu))
					{ 
						$resimlinki = $dosyaadi;
					}
					else 
					{ 
						$resimlinki = 'http://www.'.SATIS.'/'.pco_format_url($stokcins).'-'.pco_format_url($yazar).'-isbn'.$urun_barkod.'-sz200.jpg';
					}
				}

				$resimlinki = '<img width="40" src="'.$resimlinki.'">';
			}
			else
			{
				$satislinki = $array_satisdurumu[$urun_satisdurumu].' &nbsp; '.$array_urun_satisdurumu_adlari[$urun_satisdurumu];
				$resimlinki = '';
			}

			$sayfabilgisi.= '
			<tr class="'.$trcolor.'">
				<td width="40" align="center" valign="center">'.$resimlinki.'</td>
				<td><a class="vitrinler" href="'.$file_link.'">'.strtoupper(pco_format_urunbaslik($urun_urunadi)).'</a></td>
				<td>'.strtoupper($urun_yazaradi).'</td>
				<td>'.$urun_barkod.'</td>
				<td>'.$array_yayinevi[$urun_yayinevino].'</td>
				<td>'.$urun_satisfiyati.'</td>
				<td>
				'.$satislinki.'
				</td>
			</tr>';
		}
	}
?>		

<style>
.vitrinler,a.vitrinler,a.vitrinler:link,a.vitrinler:visited,a.vitrinler:hover  { font-family:Verdana; font-size:10px; text-decoration:none; color:#000000; }
a.vitrinler:hover  { font-family:Verdana; font-size:10px; text-decoration:none; color:#000000; }
.col1 { background-color: #DCEBFE; }
.col2 { background-color: #F9F9F9; }
th { padding: 3px 4px; color: #FFFFFF; background: #70AED3 url("./_img/_cs/gradient2b.gif") bottom left repeat-x; border-top: 1px solid #6DACD2; border-bottom: 1px solid #327AA5; text-align: left; text-decoration:none; font-size: 0.9em; text-transform: uppercase; }
a.button1, input.button1, input.button3, a.button2, input.button2 { width: auto !important; padding: 1px 3px 0 3px; font-family: "Lucida Grande", Verdana, Helvetica, Arial, sans-serif; color: #000; font-size: 0.85em; background: #EFEFEF url("./_img/_cs/bg_button.gif") repeat-x top; cursor: pointer; }
a.button1, input.button1 { font-weight: bold; border: 1px solid #666666; }
a.button2, input.button2 { border: 1px solid #666666; }
a.button1, a.button1:link, a.button1:visited, a.button1:active, a.button2, a.button2:link, a.button2:visited, a.button2:active { text-decoration: none; color: #000000; padding: 4px 8px; }
a.button1:hover, input.button1:hover, a.button2:hover, input.button2:hover { border: 1px solid #BC2A4D; background: #EFEFEF url("./_img/_cs/bg_button.gif") repeat bottom; color: #BC2A4D; }
input.disabled { font-weight: normal; color: #666666; }
.pagination { padding: 4px; }
.pagination a, .pagination a:visited { padding: 5px 10px 5px 10px; border: 1px solid #9aafe5; text-decoration: none; color: #2e6ab1; }
.pagination a:hover, .pagination a:active { padding: 5px 10px 5px 10px; border: 1px solid #2b66a5; color: #000; background-color: #FFFF80; }
</style>

<!--
<div id="banner"><a href="#"><img src="_img/_nimbuslike/img05.jpg" alt="" /></a></div>
-->

<div id="page-bgcontent">	

<div id="full">
<div class="right_articles">
<a href="<?php echo ANASAYFALINK?>">Ana Sayfa</a> &raquo; �r�nler
</div>

<table class="vitrinler" width="100%" border="0" cellpadding="3" cellspacing="3">
	<tr>
		<td colspan="6">
		<div>
			<form action="<?php echo URUNLERLINK?>" method="get">
			Aranacak kelime: 
			<input type="text" style="width: 250px;" name="aramaanahtari" value="<?php echo $aramaanahtari?>"/>
			<select size="1" name="aramatipi" style="width:100px">
			<option value="urunadi" selected="selected">�r�n ad�</option>
			<option value="yazaradi">yazar ad�</option>
			<option value="barkod">barkod</option>
			</select>
			<input class="button1" value=" Ara�t�r " type="submit"> 
			(<?php echo $bulunanadet?> sonu� g�r�nt�leniyor)
			</form>
		</div>
		</td>
	</tr>
	<tr>
		<td colspan="6">
		<div>
		<a class="button1" href="<?php echo URUNLERLINK?>">T�m �r�nler</a> 
		<a class="button1" href="<?php echo URUNLERLINK?>?lt=satista">Sat��ta</a> 
		<a class="button1" href="<?php echo URUNLERLINK?>?lt=baskisiyok">Bask�s� Yok</a>
		<a class="button1" href="<?php echo URUNLERLINK?>?lt=arsiv">Ar�iv</a> | 
		<a class="button1" href="<?php echo URUNLERLINK?>?lt=dusyayincilik">D���n Yay�nc�l�k</a> 
		<a class="button1" href="<?php echo URUNLERLINK?>?lt=adimkitap">Ad�m Kitap</a>
		</div>
		</td>
	</tr>
	<tr>
		<th colspan="2">
			<?php if($siralamatipi == 'urunadi' && $by == 0) { echo '<a href="'.$sayfalink.'&order=urunadi&by=1"">�R�N ADI <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'urunadi' && $by == 1) { echo '<a href="'.$sayfalink.'&order=urunadi&by=0">�R�N ADI <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=urunadi">�R�N ADI</a> '; } ?>
		</th>
		<th width="140">
			<?php if($siralamatipi == 'yazaradi' && $by == 0) { echo '<a href="'.$sayfalink.'&order=yazaradi&by=1"">YAZAR ADI <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'yazaradi' && $by == 1) { echo '<a href="'.$sayfalink.'&order=yazaradi&by=0">YAZAR ADI <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=yazaradi">YAZAR ADI</a> '; } ?>
		</th>
		<th width="80">
			<?php if($siralamatipi == 'barkod' && $by == 0) { echo '<a href="'.$sayfalink.'&order=barkod&by=1"">BARKOD <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'barkod' && $by == 1) { echo '<a href="'.$sayfalink.'&order=barkod&by=0">BARKOD <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=barkod">BARKOD</a> '; } ?>
		</th>
		<th width="100">
			<?php if($siralamatipi == 'yayinevi' && $by == 0) { echo '<a href="'.$sayfalink.'&order=yayinevi&by=1"">YAYINEV� <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'yayinevi' && $by == 1) { echo '<a href="'.$sayfalink.'&order=yayinevi&by=0">YAYINEV� <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=yayinevi">YAYINEV�</a> '; } ?>
		</th>
		<th width="60">
			<?php if($siralamatipi == 'fiyati' && $by == 0) { echo '<a href="'.$sayfalink.'&order=fiyati&by=1"">F�YATI <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'fiyati' && $by == 1) { echo '<a href="'.$sayfalink.'&order=fiyati&by=0">F�YATI <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=fiyati">F�YATI</a> '; } ?>
		</th>
		<th width="80">
			<?php if($siralamatipi == 'durumu' && $by == 0) { echo '<a href="'.$sayfalink.'&order=durumu&by=1"">DURUMU <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'durumu' && $by == 1) { echo '<a href="'.$sayfalink.'&order=durumu&by=0">DURUMU <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=durumu">DURUMU</a> '; } ?>
		</th>
	</tr>

	<?php echo $sayfabilgisi?>
	<tr>
		<td colspan="6"><?php echo $sayfalama?></td>
	</tr>
</table>

</div>
