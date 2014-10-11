<?php
if (!defined('yakusha')) die('...');

$id = $_REQUEST["id"]; settype($id,"integer");

$vt->sql('SELECT count(content_id) FROM pco_content WHERE content_id = %u')->arg($id)->sor($cachetime);
$sonuc = $vt->alTek();

if ($sonuc)
{
	$vt->sql('SELECT * FROM pco_content WHERE content_id = %u')->arg($id)->sor();
	$sonuc = $vt->alHepsi();

	//metin gelmesi gereken alanlar
	$content_title 		= $sonuc[0]->content_title;
	$content_author 	= $sonuc[0]->content_author;
	$content_image 		= $sonuc[0]->content_image;
	$content_short 		= $sonuc[0]->content_short;
	$content_desc 		= $sonuc[0]->content_desc;

	//metin geldigi için temizlenmesi gereken alanlar
	$content_title 		= stripslashes($content_title);
	$content_author 	= stripslashes($content_author);
	$content_image 		= stripslashes($content_image);
	$content_short 		= stripslashes($content_short);
	$content_desc 		= stripslashes($content_desc);

	//yeni satýrlamalar
	$content_short 		= pco_imla_denetle($content_short);
	$content_desc 		= pco_imla_denetle($content_desc);
	$resimlinki 		= '/_img_book/'.$content_image;
}

if ($sonuc){
?>
<style>
.sag-kutu {
float:right;
width:216px;
padding-left:10px;
padding-bottom:10px;
}
</style>

<div id="page-bgcontent">
<div id="content">

<h1><?php echo strtoupper($content_title)?> <?php if ($_SESSION[SES]["ADMIN"]==1) echo ' | <a title="Ürün Bilgilerini Düzenle" href="'.ADMINLINK.'?menu=yazilar&duzenle='.$id.'">Düzenle</a>'; ?></h1>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td valign="top">

<?php if ($content_image) { ?>

<div class="sag-kutu">
<div class="right_articles">
<center>
<img height="200" src="<?php echo $resimlinki?>">
</center>
</div>
</div>

<?php } ?>

<strong>Yazan :</strong> <?php echo $content_author?>

<hr>
<div class="button-primary">
	<?php echo $content_desc?>
</div>

</td>
</tr>
</table>

</div>
</div>

<?php } else { include($siteyolu."/_lib_temp/_hata.php"); } ?>
