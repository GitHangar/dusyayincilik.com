<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"] == 1) exit ();

//--------------------------------------------------------
//--- VÝTRÝNE EKLEME ÝÞLEMÝ ------------------------------
//--------------------------------------------------------
if ($_REQUEST['formuisle'])
{
	//vitrin bilgileri
	$vitrin_stokno = trim($_REQUEST["vitrin_stokno"]);
	$vitrin_tipi = $_REQUEST["vitrin_tipi"];
	$vitrin_islem = $_REQUEST["vitrin_islem"];

	$vitrin_tarihi = time();

	if ($vitrin_islem == "sil")
	{
		if ($vitrin_stokno > 0 )
		{
			$SORGU_sil = '
			DELETE FROM pco_vitrinler 
			WHERE stokkod = '.$vitrin_stokno.'
			AND vitrintipi = '.$vitrin_tipi.'
			';
			$SONUC_sil = mysql_query($SORGU_sil);
			$vitrin_slemsonucu = '<div class="successbox">'.$vitrin_stokno.' stok numaralý kitap '.$array_vitrin_tipleri[$vitrin_tipi].' vitrinden silinmiþtir</div>';	
			//bellek boþaltalým ki deðiþiklikler görünsün
			pco_temizle_cache();
		}
		else 
		{
			$vitrin_slemsonucu = '<div class="errorbox">Lütfen stok numarasý belirtiniz.</div>';
		}
	}

	if ($vitrin_islem == "ekle")
	{
		if ($vitrin_stokno > 0 )
		{
			//önce siliyoruz
			$SORGU_sil = '
				DELETE FROM pco_vitrinler 
				WHERE stokkod = '.$vitrin_stokno.'
				AND vitrintipi = '.$vitrin_tipi.'
			';
			$SORGU_sonuc = mysql_query($SORGU_sil);

			//sildik, þimdi yeniden ekliyoruz.
			$SORGU_ekle = '
				INSERT INTO pco_vitrinler (stokkod,vitrintipi,vitrintar)
				VALUES ('.$vitrin_stokno.', '.$vitrin_tipi.', '.$vitrin_tarihi.');
			';
			$SORGU_sonuc = mysql_query($SORGU_ekle);
			$vitrin_slemsonucu = '<div class="successbox">Seçilen kitap '.$array_vitrin_tipleri[$vitrin_tipi].'  vitrinine eklendi </div>';
			//bellek boþaltalým ki deðiþiklikler görünsün
			pco_temizle_cache();
		}
		else 
		{
			$vitrin_slemsonucu = '<div class="errorbox">Lütfen stok numarasý belirtiniz.</div>';
		}
	}
}

//ÜRÜN LÝSTESÝ OLUÞTURUYORUZ
$SORGU_stok = 'SELECT * FROM `pco_stok` WHERE stokno > 0 ORDER BY urunadi;';
$SONUC_stok = mysql_query($SORGU_stok);
$bulunanadet = mysql_num_rows($SONUC_stok);

if ($bulunanadet)
{
	for ( $i = 0; $i < $bulunanadet; $i++)
	{
		//sorgudan alýnýyor
		$pco_stokno = mysql_result($SONUC_stok,$i,"stokno");
		$pco_urunadi = mysql_result($SONUC_stok,$i,"urunadi");
		$pco_yazaradi = mysql_result($SONUC_stok,$i,"yazaradi");

		$pco_urunadi = stripslashes($pco_urunadi);
		$pco_yazaradi = stripslashes($pco_yazaradi);

		// $pco_urunadi = strtolower($pco_urunadi);
		// $pco_yazaradi = strtolower($pco_yazaradi);

		$urunler_options.= '<option value="'.$pco_stokno.'">'.$pco_urunadi.' &raquo; '.$pco_yazaradi.'</option>'. "\r\n";
	}
}

//--------------------------------------------------------
// VÝTRÝN FONKSÝYONUNA BAÞLIYORUZ ------------------------
//--------------------------------------------------------

$kitap = $_REQUEST['kitap'];
$zaman = $_REQUEST['zaman'];

$kitabisil = $_REQUEST['kitabisil'];

if (!$sonucsayisi) $sonucsayisi = 50;

if ( $zaman == "yenile")
{
	//yenile demiþse zaman þimdiki zamandýr
	$zaman = time();
}

if ($kitap > 0 && $zaman > 0)
{

	$SORGU_guncelle = 'UPDATE pco_vitrinler SET vitrintar = '.$zaman.' WHERE stokkod = '.$kitap.' AND vitrintipi = '.$vitrintipi.';';
	$SORGU_sonuc = mysql_query($SORGU_guncelle);
	//$etkilenenkayýtsayisi = mysql_affected_rows();
	$formsonucmesaj = '<div class="successbox">Seçilen ürün güncellenmiþtir...</div>';
	//bellek boþaltalým ki deðiþiklikler görünsün
	pco_temizle_cache();
}

if ($kitap > 0 && $kitabisil == 1)
{

	$SORGU_sil = '
		DELETE FROM pco_vitrinler 
		WHERE stokkod = '.$kitap.'
		AND vitrintipi = '.$vitrintipi.'
	';
	$SORGU_sonuc = mysql_query($SORGU_sil);
	$etkilenenkayýtsayisi = mysql_affected_rows();
	$formsonucmesaj = "<div class='successbox'> Silme Ýþlemi Gerçekleþtirilmiþtir</div>";
	//bellek boþaltalým ki deðiþiklikler görünsün
	pco_temizle_cache();
	
}

$SORGU_urunler = "
	SELECT *
	FROM pco_stok,pco_vitrinler
	WHERE 
	pco_vitrinler.stokkod = pco_stok.stokno
	AND pco_vitrinler.vitrintipi = ".$vitrintipi." 
	ORDER BY pco_vitrinler.vitrintar 
	DESC
	LIMIT 0,".$sonucsayisi.";"
;
// echo '<pre>'.$SORGU_urunler.'</pre>';
$SORGU_sonuc = mysql_query($SORGU_urunler);
$bulunanadet = mysql_num_rows($SORGU_sonuc);

if ($bulunanadet)
{
	$sayfaicbilgisi_fonk .= '<table width="100%" cellspacing="2" cellpadding="2">';
	for ( $i = 0; $i < $bulunanadet; $i++ ) 
	{
		$artý1 = ($i+1); 
		$eksi1 = ($i-1);
		$pco_stokno = mysql_result($SORGU_sonuc,$i,"stokno");
		$pco_urunadi = mysql_result($SORGU_sonuc,$i,"urunadi");
		$pco_yazaradi = mysql_result($SORGU_sonuc,$i,"yazaradi");
		$pco_satisfiyati = mysql_result($SORGU_sonuc,$i,"satisfiyati");
		$pco_yayinevino = mysql_result($SORGU_sonuc,$i,"yayinevino");
		$pco_kidaplink = mysql_result($SORGU_sonuc,$i,"kidaplink");
		$pco_satisdurumu = mysql_result($SORGU_sonuc,$i,"satisdurumu");
		$pco_stoktarih = mysql_result($SORGU_sonuc,$i,"vitrintar");
		$pco_stoktarihi = mysql_result($SORGU_sonuc,$i,"vitrintar");
		$pco_stoktarihiartý1 = mysql_result($SORGU_sonuc,$artý1,"vitrintar");
		$pco_stoktarihieksi1 = mysql_result($SORGU_sonuc,$eksi1,"vitrintar");
		if ($pco_stoktarihieksi1 == '') $pco_stoktarihieksi1 = (time()+1);
		

		$pco_urunadi = stripslashes($pco_urunadi);
		$pco_yazaradi = stripslashes($pco_yazaradi);

		$pco_stoktarih = date('d F Y H:i:s', $pco_stoktarih);
		if ($i%2) { $tr_color = "col2"; } else { $tr_color = "col1"; }

			$file_link = SITELINK.'/' . URUNDETAY . '?pid=' . $pco_stokno .'-'. pco_format_url($pco_urunadi) ;
			if (SEO_OPEN == 1) $file_link = SITELINK.'/' . pco_format_url($pco_urunadi) . '-'.DETAY . $pco_stokno . SEO;

			if ($pco_kidaplink > 0)
			{
				$satislinki = '<a target="_blank" class="vitrinler" href="http://www.'.SATIS.'/'.pco_format_url($pco_urunadi).'-'.pco_format_url($pco_yazaradi).'-k'.$pco_kidaplink.'.kitap">
				'.$array_satisdurumu[$urun_satisdurumu].' &nbsp; '.$array_urun_satisdurumu_adlari[$urun_satisdurumu].'
				</a>';
				$resimlinki = '<img src="http://www.'.SATIS.'/'.pco_format_url($pco_urunadi).'-'.pco_format_url($pco_yazaradi).'-r'.$pco_kidaplink.'-sz100.jpg">';
			}
			else
			{
				$satislinki = $array_satisdurumu[$urun_satisdurumu].' &nbsp; '.$array_urun_satisdurumu_adlari[$urun_satisdurumu];
				$resimlinki = '';
			}

			$sayfaicbilgisi_fonk.= '
		<tr class="'.$tr_color.'" id="vitrineekle'.$pco_stokno.'">
		<td align="center" width="70">
			<a href="'.ADMINLINK.'?menu='.$sayfaid.'&kitap='.$pco_stokno.'&zaman='.($pco_stoktarihieksi1+1).'">
				<img src="'.SITELINK.'/_img/icon_up.gif"></a>&nbsp;&nbsp;
			<a href="'.ADMINLINK.'?menu='.$sayfaid.'&kitap='.$pco_stokno.'&zaman='.($pco_stoktarihiartý1-2).'">
				<img src="'.SITELINK.'/_img/icon_down.gif"></a>&nbsp;&nbsp;
			<a class="vitrinler" href="javascript:vitrineekle('.$pco_stokno.')">
				<img src="'.SITELINK.'/_img/icon_sync.gif"></a>
		</td>
		<td align="center">'.$resimlinki.'</td>
		<td>
			&nbsp;
			<a title="DÝKKAT, KÝTAP SÝLÝNECEKTÝR"  href="javascript:confirmDelete(\''.ADMINLINK.'?menu='.$sayfaid.'&kitap='.$pco_stokno.'&kitabisil=1\')">
			<img src="'.SITELINK.'/_img/icon_delete.gif">
			</a>
			&nbsp;
			<span class="vitrinler">
			<a class="vitrinler"href="'.$file_link.'"><strong>'.strtoupper($pco_urunadi).'</strong> - ' .strtoupper($pco_yazaradi).'</a>
			</span>
		</td>
		<td width="120" class="vitrinler">'.$array_yayinevi[$pco_yayinevino].'</td>
		<td width="150" class="vitrinler">'.$pco_stoktarih.'</td>
		<td width="80" class="vitrinler">'.$array_satisdurumu[$pco_satisdurumu].' '.$array_urun_satisdurumu_adlari[$pco_satisdurumu].'</td>
		</tr>';
		
	}
	$sayfaicbilgisi_fonk .= '</table>';
	mysql_free_result($SORGU_sonuc);
}
?>

<script type="text/javascript" src="<?php echo SITELINK?>/_lib_js/eyceks.js"></script>
<script type="text/javascript">
function vitrineekle(kitapid)
{
	// alýnan verileri yolla, sonucu geri al
	var sc = "kitap="+fc_(kitapid)+"&zaman=yenile&vitrintipi=<?php echo $vitrintipi?>";
	JXG(1,"vitrineekle"+kitapid,"<?php echo SITELINK?>/_ajax.php", sc);
}

function confirmDelete(delUrl) 
{
	if (confirm("Bu kitabý vitrinden silmek istediðinize emin misiniz?")) 
	{
		document.location = delUrl;
	}
}
</script>


<h1>Vitrinler &raquo; <?php echo $sayfaadi?></h1>

<p>Bu paneli kullanarak <strong><?php echo $sayfaadi?></strong> vitrinine eklediðiniz ürünleri güncelleyebilir ve vitrinden silebilirsiniz.</p>

<?php echo $vitrin_slemsonucu?>

<?php echo $formsonucmesaj ?>

<table width="100%" align="center">
<tr>
<td>

	<form action="<?php echo ADMINLINK?>?menu=<?php echo $sayfaid?>" method="POST">
	<select  style="width: 500px;" name="vitrin_stokno">
	<?php echo $urunler_options;?>
	</select>

	<select name="vitrin_islem">
	  <option value="ekle">Vitrine Ekle</option>
	  <option value="sil">Vitrinden Sil</option>
	</select>

	<input type="hidden" name="menu" value="<?php echo $sayfaid;?>">
	<input type="hidden" name="vitrin_tipi" value="<?php echo $vitrintipi?>">
	<input class="button1" id="formuisle" name="formuisle" value="Ýþlemi Gerçekleþtir" type="submit">
	</form>

</td>
</tr>
</table>

<table width="100%" border="0" cellpadding="3" cellspacing="3">
<tr>
<td>
<br>
<a class="button1" href="<?php echo $acp_vitrin_yenilerlink?>">Yeni Çýkanlar</a>
<a class="button1" href="<?php echo $acp_vitrin_coksatanlarlink?>">Çok Satanlar</a>
<a class="button1" href="<?php echo $acp_vitrin_tekrarbaskilarlink?>">Tekrar Baskýlar</a>
<br><br>
<?php echo $sayfaicbilgisi_fonk ?>
</td>
</tr>
</table>