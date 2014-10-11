<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"] == 1) exit ();

$duzenle 		= $_REQUEST["duzenle"]; 	settype($duzenle,"integer");
$delete 		= $_REQUEST["delete"]; 		settype($delete,"integer");

$content_id = $duzenle;

if (isset($_REQUEST["form1"]))
{
	//varsayýlan deðerler
	$changetar = time();

	if ($duzenle > 0)
	{
		//metin gelmesi gereken alanlar
		$content_title 		= addslashes(trim($_REQUEST["content_title"]));
		$content_author 	= addslashes(trim($_REQUEST["content_author"]));
		$content_image 		= addslashes(trim($_REQUEST["content_image"]));
		$content_short 		= addslashes(trim($_REQUEST["content_short"]));
		$content_desc 		= addslashes(trim($_REQUEST["content_desc"]));

		//hata kontrolü
		//if ( strlen($content_title) < 2 or !eregi("[[:alpha:]]",$content_title) )
		//$islem_bilgisi = '<br>Yazý Baþlýk alanýný boþ býrýkmayýnýz';

		if ($islem_bilgisi == '')
		{
			$vt->sql('UPDATE pco_content 
			SET 
				content_title = %s, 
				content_author = %s, 
				content_image = %s, 
				content_short = %s, 
				content_desc = %s 
			WHERE content_id = %u');
			$vt->arg(
				$content_title, 
				$content_author, 
				$content_image, 
				$content_short, 
				$content_desc, 
				$content_id
			);
			$vt->sor();
			$islem_bilgisi = '<div class="successbox">'.stripslashes(stripslashes($content_title)).' baþlýklý yazý güncellenmiþtir.</div>';

			//bellek boþaltalým
			pco_temizle_cache();
		}
		else
		{
			$islem_bilgisi = '<div class="errorbox">Ýþlem Hatasý, neden acaba?</div>';
		}
	}
}

//dosya id varsa ve silinmesi isteniyorsa, silinmiþ diye iþaretliyoruz.
if ($content_id > 0 && $delete == 1)
{
	$vt->sql('DELETE FROM pco_content WHERE content_id = %u')->arg($content_id)->sor();
	$islem_bilgisi = '<div class="errorbox">Seçilen yazý silinmiþtir.</div>';
}

$vt->sql('SELECT * FROM pco_content WHERE content_id = %u')->arg($content_id)->sor();
$sonuc = $vt->alHepsi();
$bulunanadet = $vt->numRows();

//seçmeli gelen alanlar

//metin gelmesi gereken alanlar
$content_title 		= $sonuc[0]->content_title;
$content_author 	= $sonuc[0]->content_author;
$content_image 		= $sonuc[0]->content_image;
$content_short 		= $sonuc[0]->content_short;
$content_desc 		= $sonuc[0]->content_desc;

//metin geldiði için temizlenmesi gereken alanlar
$content_title 		= stripslashes($content_title);
$content_author 	= stripslashes($content_author);
$content_image 		= stripslashes($content_image);
$content_short 		= stripslashes($content_short);
$content_desc 		= stripslashes($content_desc);

//düzenlemeler
$content_link = SITELINK.'/' . MAKALEDETAY . '?'.ID.'=' . $content_id .'-'. pco_format_url($content_title) ;			
if (SEO_OPEN == 1) $content_link = SITELINK.'/' . pco_format_url($content_title) . '-' . MSEO_ID . $content_id . SEO;			
?>
<h2><?php echo $content_posticon_path?> Yazý Düzenle &raquo; <a href="<?php echo $content_link?>"><?php echo $content_title?></a></h2>

<script>
function confirmDelete(delUrl)
{
if (confirm("<?php echo $content_title?> isimli yazýyý silinmiþ olarak iþaretlemek istediðinizden emin misiniz?"))
{
document.location = delUrl;
}
}
</script>

<?php echo $islem_bilgisi?>

<div>
<form name="form1" action="<?php echo $acp_yazilarlink?>&duzenle=<?php echo $content_id?>" method="POST">
<input type="hidden" name="menu" value="yazilar">
<input type="hidden" name="duzenle" value="<?php echo $content_id?>">

<table width="100%" cellspacing="5" cellspacing="10" border="0">

<tr>
<th colspan="2" height="25">
<a class="button1" href="javascript:confirmDelete('<?php echo $acp_yazilarlink?>&amp;duzenle=<?php echo $content_id?>&amp;delete=1')">YAZIYI SÝL</a>
</th>
<th align="right">
<input class="button1" id="form1" name="form1" value="ÝÇERÝK GÜNCELLE" type="submit"></th>
</tr>

<tr>
<td width="200">Baþlýk</td>
<td>:</td>
<td>
<div>
<input type="text" name="content_title" style="width: 580px;" value="<?php echo $content_title?>">
</div>
</td>
</tr>

<tr>
<td>Yazar</td>
<td>:</td>
<td>
<div>
<input type="text" name="content_author" style="width: 300px;" value="<?php echo $content_author?>">
Resim: <input type="text" name="content_image" style="width: 220px;" value="<?php echo $content_image?>">
</div>
</td>
</tr>

<tr>
<td>Özet</td>
<td>:</td>
<td>
<div>
	<textarea name="content_short" rows="5" style="width: 580px"><?php echo $content_short?></textarea>
</div>
</td>
</tr>

<tr>
<td>Ýçerik</td>
<td>:</td>
<td>
<div>
	<textarea name="content_desc" rows="20" style="width: 580px"><?php echo $content_desc?></textarea>
</div>
</td>
</tr>

</table>	
</form>
</div>
