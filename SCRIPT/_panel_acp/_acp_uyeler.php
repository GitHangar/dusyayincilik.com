<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"]==1) exit ();

include($siteyolu."/_panel_acp/_temp/_t_adminbaslangic.php"); 

$user_id = $_REQUEST['un']; settype($project_book_id,"integer");
$uye_ekle = $_REQUEST['uyeekle']; settype($uye_ekle,"integer");
if ($user_id > 0)
{
	include($siteyolu."/_panel_acp/_acp_uyeler_duzenle.php");
}
elseif ($uye_ekle > 0)
{
	include($siteyolu."/_panel_acp/_acp_uyeler_ekle.php");
}
else
{
	//sql sorgusu olu�turuluyor
	$SORGU_cumle = 'SELECT id,status,email,name,tel,username FROM pco_users';
	//sql sorgusu g�nderiliyor
	$SORGU_sonuc = mysql_query($SORGU_cumle);
	$bulunanadet = mysql_num_rows($SORGU_sonuc);

	//sayfa i�i olu�turuluyor, d�ne d�ne
	if ($bulunanadet)
	{
		for ( $i = 0; $i < $bulunanadet; $i++)
		{
			$user_id = mysql_result($SORGU_sonuc,$i,"id");
			$user_status = mysql_result($SORGU_sonuc,$i,"status");
			$user_email = mysql_result($SORGU_sonuc,$i,"email");
			$user_name = mysql_result($SORGU_sonuc,$i,"name");
			$user_tel = mysql_result($SORGU_sonuc,$i,"tel");
			$user_username = mysql_result($SORGU_sonuc,$i,"username");

			if ($i%2) { $trcolor = "col2"; } else { $trcolor = "col1"; }

			$sayfabilgisi.= '<tr class="'.$trcolor.'">
				<td><a class="vitrinler" title="�ye bilgilerini d�zenle" href="'.$acp_uyelerlink.'&amp;un='.$user_id.'">
				<img src="'.SITELINK.'/_img/icon_edit.gif">D�zenle</a></td>
				<td>'.$array_user_status[$user_status].'</td>
				<td>'.$user_email.'</td>
				<td>'.$user_name.'</td>
				<td>'.$user_tel.'</td>
				<td>'.$user_username.'</td>
			</tr>';
		}
	}

?>

<a class="button1" href="<?php echo $acp_uyelerlink?>&uyeekle=1"><img src="<?php echo SITELINK?>/_img/_ca/icon_ekle.png">�YE EKLE</a>

Bu paneli kullanarak �yelerinizin bilgilerini g�ncelleyebilir ve silebilirsiniz.<br><br>

<?php echo $islemsonucu?>

<table class="vitrinler" width="%100" border="0" cellpadding="3" cellspacing="3">
<tr>
<th width="70"></th>
<th>durum</th>
<th>eposta</th>
<th>ad, soyad</th>
<th>tel</th>
<th>kullan�c� ad�</th>
</tr>
<?php echo $sayfabilgisi?>
</table>
<?php } ?>		
<?php include($siteyolu."/_panel_acp/_temp/_t_adminbitis.php"); ?>