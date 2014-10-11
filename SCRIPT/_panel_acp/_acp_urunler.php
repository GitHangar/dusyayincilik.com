<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"]==1) exit ();

include($siteyolu."/_panel_acp/_temp/_t_adminbaslangic.php"); 

$urun_stokno = $_REQUEST['un']; settype($urun_stokno,"integer");
$urun_urunekle = $_REQUEST['urunekle']; settype($urun_stokno,"integer");
if ($urun_stokno > 0)
{
	//include($siteyolu."/_panel_acp/_temp/_t_adminmenuleri.php");
	//echo '</div><div id="main">';
	include($siteyolu."/_panel_acp/_acp_urunler_duzenle.php");
}
elseif ($urun_urunekle > 0)
{
	//include($siteyolu."/_panel_acp/_temp/_t_adminmenuleri.php");
	//echo '</div><div id="main">';
	include($siteyolu."/_panel_acp/_acp_urunler_ekle.php");
}
else
{
	//reset
	$siralama = '';
	$sorguilavesi = '';

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

	//formla ilgili �ncelikli i�lemler varsa tamaml�yoruz
	if (isset ($_REQUEST["topluduzenle"]))
	{
		//�nce seri adlar�n� g�ncelliyoruz
		foreach ($urun_serino as $k => $v)
		{
			if (is_numeric($k) && $k > 0)
			{
				$SORGU_urun = '
					UPDATE pco_stok
					SET serino = "'.$v.'"
					WHERE stokno = "'.$k.'"
					;';
				$SORGU_sonuc = mysql_query($SORGU_urun);
				//echo '<br>'.$SORGU_urun;
			}
		}
		
		//sonra sat�� fiyatlar�n� g�ncelliyoruz
		foreach ($urun_satisfiyati as $k => $v)
		{
			if (is_numeric($k) && $k > 0)
			{
				//sat�� fiyat�ndak virg�lleri nokta ile de�i�tiriyoruz ve bo�luklar� al�yoruz
				$v = trim($v);
				$v = str_replace (',', '.', $v);
				$SORGU_urun = '
					UPDATE pco_stok
					SET satisfiyati = "'.$v.'"
					WHERE stokno = "'.$k.'"
					;';
				$SORGU_sonuc = mysql_query($SORGU_urun);
				//echo '<br>'.$SORGU_urun;
			}
		}
		
		//sonra �r�n durumlar�n� g�ncelliyoruz
		foreach ($urun_satisdurumu as $k => $v)
		{
			if (is_numeric($k) && $k > 0)
			{
				//sat�� fiyat�ndak virg�lleri nokta ile de�i�tiriyoruz
				$SORGU_urun = '
					UPDATE pco_stok
					SET satisdurumu = "'.$v.'"
					WHERE stokno = "'.$k.'"
					;';
				$SORGU_sonuc = mysql_query($SORGU_urun);
				//echo '<br>'.$SORGU_urun;
			}
		}
		
		//sonra sat�� fiyatlar�n� g�ncelliyoruz
		foreach ($urun_kidaplink as $k => $v)
		{
			//sat�� fiyat�ndak virg�lleri nokta ile de�i�tiriyoruz ve bo�luklar� al�yoruz
			$SORGU_urun = '
				UPDATE pco_stok
				SET kidaplink = "'.$v.'"
				WHERE stokno = "'.$k.'"
				;';
			$SORGU_sonuc = mysql_query($SORGU_urun);
			//echo '<br>'.$SORGU_urun;
		}	
		$islemsonucu = '<div class="successbox">��lem Ba�ar� �le Tamamland�.</div>';
		pco_temizle_cache();
	}

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
	if ($listetipi == "digeryayinevleri")
	{
		$sorguilavesi = 'AND yayinevino not in (1,2)';
	}

	if ($listetipi == "mustafaislamoglu")
	{
		$sorguilavesi = 'AND yazaradi = "mustafa islamo�lu"';
	}

	
	//i� s�ralamalar olu�turuluyor
	if ($siralamatipi == "tarih")
	{
		$siralama = 'changetar '.$order_by;	
	}
	else if ($siralamatipi == "urunadi")
	{
		$siralama = 'urunadi '.$order_by;	;	
	}
	else if ($siralamatipi == 'yazaradi')
	{
		$siralama = 'yazaradi '.$order_by.', urunadi ASC';	
	}
	else if ($siralamatipi == 'barkod')
	{
		$siralama = 'barkod '.$order_by.', urunadi ASC';
	}
	else if ($siralamatipi == 'yayinevi')
	{
		$siralama = 'yayinevino '.$order_by.', urunadi ASC';
	}
	else if ($siralamatipi == 'seriadi')
	{
		$siralama = 'serino '.$order_by.', urunadi ASC';
	}
	else if ($siralamatipi == 'fiyati')
	{
		$siralama = 'satisfiyati '.$order_by.', urunadi ASC';
	}
	else if ($siralamatipi == 'durumu')
	{
		$siralama = 'satisdurumu '.$order_by.', urunadi ASC';
	}
	else if ($siralamatipi == 'kidaplink')
	{
		$siralama = 'kidaplink '.$order_by;
	}
	else
	{
		$siralama = 'createtar DESC';	
	}
	
	//s�ralama tipi olu�turuluyor
	if (!$siralama) $siralama = 'urunadi '.$order_by;

	//limit sorgusu olu�turuluyor
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
	
	//say�m i�in sorgu g�nderiliyor
	$SORGU_sayi = '
		SELECT count(stokno) as sayim
		FROM pco_stok
		WHERE stokno > 0
		'.$sorguilavesi.'
		ORDER BY '.$siralama.';
	';
	$SORGU_sonuc = mysql_query($SORGU_sayi);
	$sayim = mysql_result($SORGU_sonuc,0,"sayim");
	$sayi = ($sayim /$sayfasonucmiktari);

	//sayfalama �zelli�i ba�lat�l�yor
	if($sayi > 1)
	{
		$sayfalama = '<div class="successbox">Sayfalar: ';
		for ($i = 0; $i < $sayi; $i++)
		{
			$sayfalama.= '<a href="'.$acp_urunlerlink.'';
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
		$sayfalama.= ' <a href="'.$acp_urunlerlink.'&amp;lt='.$listetipi;
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

	$sayfalink = $acp_urunlerlink;
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
		foreach ($array_urun_satisdurumu_adlari as $k => $v)
		{
			$option_satisdurumlari .= '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
		}
		
		foreach ($array_seri_adlari as $k => $v)
		{
			$option_seri_adlari .= '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
		}		

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

			//renklendirme
			if ($i%2) { $trcolor = "col2"; } else { $trcolor = "col1"; }

			//slash i�aretleri temizleniyor
			$urun_urunadi = stripslashes($urun_urunadi);
			$urun_yazaradi = stripslashes($urun_yazaradi);
			
			$file_link = SITELINK.'/' . URUNDETAY . '?pid=' . $urun_stokno .'-'. pco_format_url($urun_urunadi) ;
			if (SEO_OPEN == 1) $file_link = SITELINK.'/' . pco_format_url($urun_urunadi) . '-'.DETAY . $urun_stokno . SEO;
			
			$sayfabilgisi.= '
			<tr class="'.$trcolor.'">
				<td><a class="vitrinler" title="�r�n bilgilerini g�ncelle" href="'.$acp_urunlerlink.'&amp;un='.$urun_stokno.'"><img src="'.SITELINK.'/_img/icon_edit.gif">D�zenle</a></td>
				<td><img width="40" src="http://www.'.SATIS.'/'.pco_format_url($urun_urunadi).'-'.pco_format_url($urun_urunadi).'-r'.$urun_kidaplink.'-sz100.jpg"></td>
				<td><a class="vitrinler" href="'.$file_link.'">'.strtoupper(pco_format_urunbaslik($urun_urunadi)).'</a></td>
				<td>'.strtoupper($urun_yazaradi).'</td>
				<td>'.$urun_barkod.'</td>
				<td>'.$array_yayinevi[$urun_yayinevino].'</td>
				<td>
				<div>
				<select style="width:180px" name="urun_serino['.$urun_stokno.']" style="width:150px">
					<option value="'.$urun_serino.'">'.$array_seri_adlari[$urun_serino].'</option>
					'.$option_seri_adlari.'
				</select>
				</div>
				</td>
				<td><div><input style="width:40px" type="text" name="urun_satisfiyati['.$urun_stokno.']" value="'.$urun_satisfiyati.'"></div></td>
				<td>
				<div>
				'.$array_satisdurumu[$urun_satisdurumu].' &nbsp;
				<select style="width:80px" name="urun_satisdurumu['.$urun_stokno.'] style="width:150px">
					<option value="'.$urun_satisdurumu.'">&raquo; '.$array_urun_satisdurumu_adlari[$urun_satisdurumu].'</option>					
					'.$option_satisdurumlari.'
				</select>
				</div>
				</td>
				<td><div><input style="width:60px" type="text" name="urun_kidaplink['.$urun_stokno.']" value="'.$urun_kidaplink.'"></div></td>
			</tr>';
		}
	}
	else
	{
		$sayfabilgisi = '<div class="errorbox">Hi�bir Sonu� Bulunamad�!</div>';
	}
?>		

<a class="button1" href="<?php echo $acp_urunlerlink?>&urunekle=1"><img src="<?php echo SITELINK?>/_img/_ca/icon_ekle.png">�R�N EKLE</a>

Bu paneli kullanarak, sisteme kay�tl� �r�nlerin bilgilerini g�ncelleyebilir ve silebilirsiniz.<br><br>

<?php echo $islemsonucu?>

<table class="vitrinler" width="%100" border="0" cellpadding="3" cellspacing="3">
	<tr>
		<td colspan="11"><?php echo $sayfalama?></td>
	</tr>
	<tr>
		<td colspan="11">
		<div>
			<form action="<?php echo $acp_urunlerlink?>" method="get">
			Aranacak kelime: 
			<input type="hidden" name="menu" value="urunler">
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
		<td colspan="11">
		<div>
		<a class="button1" href="<?php echo $acp_urunlerlink?>">T�m �r�nler</a> 
		<a class="button1" href="<?php echo $acp_urunlerlink?>&amp;lt=satista">Sat��ta</a> 
		<a class="button1" href="<?php echo $acp_urunlerlink?>&amp;lt=baskisiyok">Bask�s� Yok</a>
		<a class="button1" href="<?php echo $acp_urunlerlink?>&amp;lt=arsiv">Ar�iv</a> | 
		<a class="button1" href="<?php echo $acp_urunlerlink?>&amp;lt=dusyayincilik">D���n Yay�nc�l�k</a> 
		<a class="button1" href="<?php echo $acp_urunlerlink?>&amp;lt=adimkitap">Ad�m Kitap</a>
		<a class="button1" href="<?php echo $acp_urunlerlink?>&amp;lt=digeryayinevleri">Di�er Yay�nevleri</a> |
		<a class="button1" href="<?php echo $acp_urunlerlink?>&amp;lt=mustafaislamoglu">islamo�lu</a> 
		</div>
		</td>
	</tr>
	<tr>
		<th valign="center" height="25" width="70">
		<?php if($siralamatipi == 'tarih' && $by == 0) { echo '<a href="'.$sayfalink.'&order=tarih&by=1"">time <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'tarih' && $by == 1) { echo '<a href="'.$sayfalink.'&order=tarih&by=0">time <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=tarih">time</a> '; } ?>
		</th>
		<th colspan="2">
			<?php if($siralamatipi == 'urunadi' && $by == 0) { echo '<a href="'.$sayfalink.'&order=urunadi&by=1"">�R�N ADI <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'urunadi' && $by == 1) { echo '<a href="'.$sayfalink.'&order=urunadi&by=0">�R�N ADI <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=urunadi">�R�N ADI</a> '; } ?>
		</th>
		<th>
			<?php if($siralamatipi == 'yazaradi' && $by == 0) { echo '<a href="'.$sayfalink.'&order=yazaradi&by=1"">YAZAR ADI <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'yazaradi' && $by == 1) { echo '<a href="'.$sayfalink.'&order=yazaradi&by=0">YAZAR ADI <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=yazaradi">YAZAR ADI</a> '; } ?>
		</th>
		<th>
			<?php if($siralamatipi == 'barkod' && $by == 0) { echo '<a href="'.$sayfalink.'&order=barkod&by=1"">BARKOD <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'barkod' && $by == 1) { echo '<a href="'.$sayfalink.'&order=barkod&by=0">BARKOD <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=barkod">BARKOD</a> '; } ?>
		</th>
		<th>
			<?php if($siralamatipi == 'yayinevi' && $by == 0) { echo '<a href="'.$sayfalink.'&order=yayinevi&by=1"">YAYINEV� <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'yayinevi' && $by == 1) { echo '<a href="'.$sayfalink.'&order=yayinevi&by=0">YAYINEV� <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=yayinevi">YAYINEV�</a> '; } ?>
		</th>
		<th width="180">
			<?php if($siralamatipi == 'seriadi' && $by == 0) { echo '<a href="'.$sayfalink.'&order=seriadi&by=1"">SER� ADI <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'seriadi' && $by == 1) { echo '<a href="'.$sayfalink.'&order=seriadi&by=0">SER� ADI <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=seriadi">SER� ADI</a> '; } ?>
		</th>
		<th width="50">
			<?php if($siralamatipi == 'fiyati' && $by == 0) { echo '<a href="'.$sayfalink.'&order=fiyati&by=1"">F�YATI <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'fiyati' && $by == 1) { echo '<a href="'.$sayfalink.'&order=fiyati&by=0">F�YATI <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=fiyati">F�YATI</a> '; } ?>
		</th>
		<th width="120">
			<?php if($siralamatipi == 'durumu' && $by == 0) { echo '<a href="'.$sayfalink.'&order=durumu&by=1"">DURUMU <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'durumu' && $by == 1) { echo '<a href="'.$sayfalink.'&order=durumu&by=0">DURUMU <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=durumu">DURUMU</a> '; } ?>
		</th>
		<th width="70">
			<?php if($siralamatipi == 'kidaplink' && $by == 0) { echo '<a href="'.$sayfalink.'&order=kidaplink&by=1"">link <img src="'.SITELINK.'/_img/siralama_up.gif"></a>'; } else if($siralamatipi == 'kidaplink' && $by == 1) { echo '<a href="'.$sayfalink.'&order=kidaplink&by=0">link <img src="'.SITELINK.'/_img/siralama_down.gif"></a>'; } else { echo '<a href="'.$sayfalink.'&order=kidaplink">link</a> '; } ?>
		</th>
	</tr>

<form name="topluduzenle" action="<?php echo $acp_urunlerlink?>" method="POST">
<input type="hidden" name="menu" value="urunler">
<input type="hidden" name="topluduzenle" value="1">
<input type="hidden" name="aramaanahtari" value="<?php echo $aramaanahtari ?>">
<input type="hidden" name="aramatipi" value="<?php echo $aramatipi ?>">
<input type="hidden" name="lt" value="<?php echo $listetipi ?>">
<input type="hidden" name="order" value="<?php echo $siralamatipi ?>">
<input type="hidden" name="limit" value="<?php echo $limit ?>">

<?php echo $sayfabilgisi?>
	<tr>
		<td colspan="11"><?php echo $sayfalama?></td>
	</tr>
	<tr>
		<td colspan="11"><div align="right"><input class="button1" type="submit" name="topluduzenle" value="TOPLU D�ZENLE"></div></td>
	</tr>
</table>
</form>
<?php
	//(if $urun_stokno > 0) ... else sonu
	}
?>

<?php include($siteyolu."/_panel_acp/_temp/_t_adminbitis.php"); ?>