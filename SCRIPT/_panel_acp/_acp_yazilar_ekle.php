<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"] == 1) exit ();

if ($_REQUEST["form1"])
{
	//etiket bulundurabilecek metin alanlar
	$content_title 		= addslashes(trim($_REQUEST["content_title"]));
	$content_author 	= addslashes(trim($_REQUEST["content_author"]));
	$content_image 		= addslashes(trim($_REQUEST["content_image"]));
	$content_short 		= addslashes(trim($_REQUEST["content_short"]));
	$content_desc 		= addslashes(trim($_REQUEST["content_desc"]));
	$content_adslink 	= addslashes(trim($_REQUEST["content_link"]));
	$createtar 			= time();

	//d�n��t�rmeler
	if ($islembilgisi == '')
	{
		$vt->sql('INSERT INTO pco_content ( content_title, content_author, content_image, content_short, content_desc, createtar) VALUES ( %s, %s, %s, %s, %s, %s)');
		$vt->arg($content_title, $content_author, $content_image, $content_short, $content_desc, $createtar);
		$vt->sor();
		$islembilgisi.= '<div class="successbox">'.stripslashes(stripslashes($content_title)).' ba�l�kl� yaz� sisteme eklenmi�tir.</div>';

		//bellek bo�altal�m ki yaz� g�r�ns�n
		pco_temizle_cache();
	}
}
?>

<h2>YAZI EKLE</h2>

<?php echo $islembilgisi?>

<div>

<form name="form1" action="<?php echo $acp_yazilarlink?>&ekle=1" method="POST">
<input type="hidden" name="menu" value="yazilar">
<input type="hidden" name="ekle" value="1">
<table width="100%" cellspacing="5" cellspacing="10" border="0">
<tr>
	<th colspan="3" height="25">
		YAZI EKLE
	</th>
</tr>

<tr>
<td width="200">Ba�l�k</td>
<td>:</td>
<td>
<div>
<input type="text" name="content_title" style="width: 580px;">
</div>
</td>
</tr>

<tr>
<td>Yazar</td>
<td>:</td>
<td>
<div>
<input type="text" name="content_author" style="width: 300px;">
Resim: <input type="text" name="content_image" style="width: 220px;">
</div>
</td>
</tr>

<tr>
<td>�zet</td>
<td>:</td>
<td>
<div>
	<textarea name="content_short" rows="5" style="width: 580px"></textarea>
</div>
</td>
</tr>

<tr>
<td>��erik</td>
<td>:</td>
<td>
<div>
	<textarea name="content_desc" rows="20" style="width: 580px"></textarea>
</div>
</td>
</tr>

<tr>
<td colspan="3">
<div align="center">
<input class="button1" id="form1" name="form1" value="��ER�K EKLE" type="submit">
</div>
</td>

</table>	
</form>
</div>
