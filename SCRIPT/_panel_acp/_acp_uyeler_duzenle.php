<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"] == 1) exit ();

$user_id = $_REQUEST["un"];
$delete = $_REQUEST["delete"];

if (isset($_REQUEST["uyeform"]))
{
	//metin gelmesi gereken alanlar
	$user_id = addslashes(trim(strip_tags($_REQUEST["user_id"])));
	$user_email = addslashes(trim(strip_tags($_REQUEST["user_email"])));
	$user_name = addslashes(trim(strip_tags($_REQUEST["user_name"])));
	$user_username = addslashes(trim(strip_tags($_REQUEST["user_username"])));
	$user_tel = addslashes(trim(strip_tags($_REQUEST["user_tel"])));
	//checkbox ile gelen alanlar
	$user_pass_active = trim(strip_tags($_REQUEST["user_pass_active"]));

	$user_auth_mizanpaj = trim(strip_tags($_REQUEST["user_auth_mizanpaj"]));
	$user_auth_kapak = trim(strip_tags($_REQUEST["user_auth_kapak"]));
	$user_auth_tashih = trim(strip_tags($_REQUEST["user_auth_tashih"]));
	$user_auth_kagit = trim(strip_tags($_REQUEST["user_auth_kagit"]));
	//seçmeli gelen alanlar	
	$user_status = trim(strip_tags($_REQUEST["user_status"]));
	//özel alanlar
	$user_pass = trim(strip_tags($_REQUEST["user_pass"]));

	//checkbox alanlarý dönüþtürülüyor
	if ($user_pass_active  == 'on') $user_pass_active = 1; else $user_pass_active = 0;

	if ($user_auth_mizanpaj == 'on') $user_auth_mizanpaj = 1; else $user_auth_mizanpaj = 0;
	if ($user_auth_kapak  == 'on') $user_auth_kapak = 1; else $user_auth_kapak = 0;
	if ($user_auth_tashih  == 'on') $user_auth_tashih = 1; else $user_auth_tashih = 0;
	if ($user_auth_kagit  == 'on') $user_auth_kagit = 1; else $user_auth_kagit = 0;
	
	//HATA KONTROLÜ
	if ( strlen($user_name) < 2 or !eregi("[[:alpha:]]",$user_name) )
	$islem_bilgisi = '<div class="errorbox">Üye Adý alanýný boþ býrýkmayýnýz.</div>';

	if ($islem_bilgisi == '')
	{
		if ($user_pass_active == 1)
		{
			$SORGU_parola = "UPDATE pco_users SET pass = '".$user_pass."' WHERE id = '".$user_id."';";
			//echo $SORGU_parola;
			$SORGU_sonuc = mysql_query($SORGU_parola);
			$islem_bilgisi.= '<div class="successbox">Parola bilgileri güncellenmiþtir.</div>';
		}

		$SORGU_uye = 
		"UPDATE pco_users 
			SET 
			status = '".$user_status."',
			email = '".$user_email."',
			name = '".$user_name."',
			tel = '".$user_tel."',
			username = '".$user_username."',
			auth_mizanpaj = '".$user_auth_mizanpaj."',
			auth_kapak = '".$user_auth_kapak."',
			auth_tashih = '".$user_auth_tashih."',
			auth_kagit = '".$user_auth_kagit."'
		WHERE id = '".$user_id."';";
		//echo $SORGU_uye;
		$SORGU_sonuc = mysql_query($SORGU_uye);
		$islem_bilgisi.= '<div class="successbox">Üye bilgileri güncellenmiþtir.</div>';
	}
}

if ($user_id > 0 && $delete == 1)
{
	//$SORGU_cumle = 'DELETE FROM pco_users WHERE id = "'.$user_id.'";';
	$SORGU_cumle = 'UPDATE pco_users SET status = 0 WHERE id = "'.$user_id.'";';
	$SORGU_sonuc = mysql_query($SORGU_cumle);
	$islem_bilgisi = '<div class="errorbox">Üye yönetim yetkileri elinden alýnmýþtýr</div>';
}

	$SORGU_cumle = 'SELECT id,status,email,name,tel,username,auth_mizanpaj,auth_kapak,auth_tashih,auth_kagit FROM pco_users WHERE id = "'.$user_id.'"';
	$SORGU_sonuc = mysql_query($SORGU_cumle);

	$user_id = mysql_result($SORGU_sonuc,0,"id");
	$user_status = mysql_result($SORGU_sonuc,0,"status");
	$user_email = mysql_result($SORGU_sonuc,0,"email");
	$user_name = mysql_result($SORGU_sonuc,0,"name");
	$user_tel = mysql_result($SORGU_sonuc,0,"tel");
	$user_username = mysql_result($SORGU_sonuc,0,"username");
	$user_auth_mizanpaj = mysql_result($SORGU_sonuc,0,"auth_mizanpaj");
	$user_auth_kapak = mysql_result($SORGU_sonuc,0,"auth_kapak");
	$user_auth_tashih = mysql_result($SORGU_sonuc,0,"auth_tashih");
	$user_auth_kagit = mysql_result($SORGU_sonuc,0,"auth_kagit");
	
	//deðerler ayarlanýyor
	if ($user_auth_mizanpaj == 1) $user_auth_mizanpaj = 'checked="checked"';
	if ($user_auth_kapak == 1) $user_auth_kapak = 'checked="checked"';
	if ($user_auth_tashih == 1) $user_auth_tashih = 'checked="checked"';		
	if ($user_auth_kagit == 1) $user_auth_kagit = 'checked="checked"';		
?>

<script>
function confirmDelete(delUrl)
{
	if (confirm("Üyenin yönetim yetkilerini almak istediðinizden emin misiniz?"))
	{
		document.location = delUrl;
	}
}
</script>

<form name="uyeform" action="<?php echo $acp_uyelerlink?>&amp;un=<?php echo $user_id?>" method="POST">
<input type="hidden" name="menu" value="uyeler">
<input type="hidden" name="islem" value="guncelle">
<input type="hidden" name="user_id" value="<?php echo $user_id?>">

<h1>Üye Düzenle &raquo; <?php echo $user_name?></h1>

<?php echo $islem_bilgisi ?>


<table width="100%" border="0">
	<tr>
		<th height="30" width="50%">
			<a class="button1" href="javascript:confirmDelete('<?php echo $acp_uyelerlink?>&amp;un=<?php echo $user_id?>&amp;delete=1')">ÜYE SÝL</a>
		</th>
		<th>
			<input class="button1" id="uyeform" name="uyeform" value="ÜYE BÝLGÝLERÝNÝ DÜZENLE" type="submit">
		</th>
	</tr>

	<tr>
		<td valign="top"> 
			<table valign="top" width="100%" cellspacing="3" border="0">
				<tr class="col1">
					<th colspan="3">
						TEMEL BÝLGÝLER
					</th>
				</tr>

				<tr>
					<td height="30">Üyelik Seviyesi</td><td> : </td><td>
					<div>
						<select style="width: 150px;" id="user_status" name="user_status">
							<option value="<?php echo $user_status?>"> <?php echo $array_user_status[$user_status]?></option>
							<?php
							foreach ($array_user_status as $k => $v)
							{
							echo '<option value="'.$k.'">'.$v.'</option>'. "\r\n";
							}
							?>
						</select>
					</div>
					</td>
				</tr>
				<tr><td height="30">Üye Adý </td><td> : </td><td><input type="text" name="user_name" style="width: 300px" maxlength="70" value="<?php echo $user_name?>"><font color="#FF0000">*</font></td></tr>
				<tr><td height="30">Üye Eposta </td><td> : </td><td><input type="text" name="user_email" style="width: 300px" maxlength="70" value="<?php echo $user_email?>"></td></tr>
				<tr><td height="30">Üye Tel </td><td> : </td><td><input type="text" name="user_tel" style="width: 300px" maxlength="70" value="<?php echo $user_tel?>"></td></tr>
				<tr><td height="30">Kullanýcý Adý </td><td> : </td><td><input type="text" name="user_username" style="width: 300px" maxlength="70" value="<?php echo $user_username?>"></td></tr>
				<tr class="col1">
					<th colspan="3">
						PAROLA BÝLGÝLERÝ
					</th>
				</tr>
				<tr><td height="30">Yeni Parola </td><td> : </td><td><input type="password" id="user_pass" name="user_pass" style="width: 145px" maxlength="70" value="">&nbsp;<input type="checkbox" name="user_pass_active"> Parola Deðiþtir</td></tr>
				<tr class="col1">
				<td colspan="3">
				Üye parolasýnýn deðiþtirilebilmesi için "Parola Deðiþtir" alanýnýn seçilmiþ olmasý zorunludur.
				</td></tr>					
			</table>
		</td>
		<td valign="top">
			<table width="50%" cellspacing="3" border="0">
				<tr class="col1">
					<th colspan="3">
						YAYIN HAZIRLIK
					</th>
				</tr>
				<tr>
					<td width="250" height="30">Mizanpaj Ýþleri</td>
					<td>:&nbsp;&nbsp;<input type="checkbox" <?php echo $user_auth_mizanpaj?> name="user_auth_mizanpaj">					
					</td>
				</tr>
				<tr>
					<td width="250" height="30">Kapak Ýþleri</td>
					<td>:&nbsp;&nbsp;<input type="checkbox" <?php echo $user_auth_kapak?> name="user_auth_kapak">					
					</td>
				</tr>
				<tr>
					<td width="250" height="30">Tashih Ýþleri</td>
					<td>:&nbsp;&nbsp;<input type="checkbox" <?php echo $user_auth_tashih?> name="user_auth_tashih">					
					</td>
				</tr>
				<tr class="col1">
					<th colspan="3">
						BASKI
					</th>
				</tr>
				<tr>
					<td width="250" height="30">Kaðýt Temini</td>
					<td>:&nbsp;&nbsp;<input type="checkbox" <?php echo $user_auth_kagit?> name="user_auth_kagit">					
					</td>
				</tr>				
			</table>
		</td>
	</tr>
</table>
</form>
<pre>
* Kýrmýzý iþaretli alanlarýn doldurulmasý zorunludur.
</pre>