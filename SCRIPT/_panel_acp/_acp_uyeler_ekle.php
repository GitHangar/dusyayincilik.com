<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"] == 1) exit ();

if (isset($_REQUEST["uyeform"]))
{
	//metin gelmesi gereken alanlar
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

	if ($user_pass_active <> 1) $user_pass = '';

	if ($islem_bilgisi == '')
	{
		//önce üye ekliyoruz
		$SORGU_urunekle = "
			INSERT INTO pco_users (
				status,
				email,
				name,
				pass,
				tel,
				username,
				auth_mizanpaj,
				auth_kapak,
				auth_tashih,
				auth_kagit
			)
			VALUES (
				'".$user_status."',
				'".$user_email."',
				'".$user_name."',
				'".$user_pass."',
				'".$user_tel."',
				'".$user_username."',
				'".$user_auth_mizanpaj."',
				'".$user_auth_kapak."',
				'".$user_auth_tashih."',
				'".$user_auth_kagit."'
			);";
			//addslashes($SORGU_urunekle);
		//echo '<pre>'.$SORGU_urunekle.'</pre>';
		$SORGU_sonuc = mysql_query($SORGU_urunekle);
		$etkilenen = mysql_affected_rows();
		$islem_bilgisi = '<div class="successbox">'.$user_name.' isimli üye sisteme eklenmiþtir.</div>';
	}
}
?>

<form name="urunform" action="<?php echo $acp_uyelerlink?>&uyeekle=1" method="POST">
<input type="hidden" name="menu" value="uyeler">
<input type="hidden" name="islem" value="uyeekle">

<h1>Üye Ekle</h1>

<?php echo $islem_bilgisi ?>

<table width="100%" border="0">
	<tr>
		<th height="25" width="50%">

		</th>
		<th>
			<input class="button1" id="uyeform" name="uyeform" value="ÜYE EKLE" type="submit">
		</th>
	</tr>

	<tr>
		<td valign="top"> 
			<table valign="top" width="100%" cellspacing="5" border="0">
				<tr class="col1">
					<th colspan="6">
						TEMEL BÝLGÝLER
					</th>
				</tr>

				<tr>
					<td width="120">Üyelik Seviyesi</td><td> : </td><td>
					<div>
						<select style="width: 150px;" id="user_status" name="user_status">
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
				<tr><td>Üye Adý </td><td> : </td><td><input type="text" name="user_name" style="width: 300px" maxlength="70" value=""> <font color="#FF0000">*</font></td></tr>
				<tr><td>Üye Eposta </td><td> : </td><td><input type="text" name="user_email" style="width: 300px" maxlength="70" value=""></td></tr>
				<tr><td>Üye Tel </td><td> : </td><td><input type="text" name="user_tel" style="width: 300px" maxlength="70" value=""></td></tr>
				<tr><td>Kullanýcý Adý </td><td> : </td><td><input type="text" name="user_username" style="width: 300px" maxlength="70" value=""></td></tr>
				<tr class="col1">
					<th colspan="6">
						PAROLA BÝLGÝLERÝ
					</th>
				</tr>
				<tr><td>Üye Parola </td><td> : </td><td><input type="password" id="user_pass" name="user_pass" style="width: 145px" maxlength="70" value="">&nbsp;<input type="checkbox" name="user_pass_active"> Parola Belirle
				</td></tr>
				<tr class="col1">
				<td colspan="3">
				Üye parolasýnýn eklenebilmesi için "Parola Belirle" alanýnýn seçilmiþ olmasý zorunludur.
				</td></tr>				
			</table>
		</td>
		<td valign="top">
			<table width="50%" cellspacing="5" border="0">
				<tr class="col1">
					<th colspan="3">
						YAYIN HAZIRLIK
					</th>
				</tr>
				<tr>
					<td width="250" height="30">Mizanpaj Ýþleri</td>
					<td>:&nbsp;&nbsp;<input type="checkbox" name="user_auth_mizanpaj">					
					</td>
				</tr>
				<tr>
					<td width="250" height="30">Kapak Ýþleri</td>
					<td>:&nbsp;&nbsp;<input type="checkbox" name="user_auth_kapak">					
					</td>
				</tr>
				<tr>
					<td width="250" height="30">Tashih Ýþleri</td>
					<td>:&nbsp;&nbsp;<input type="checkbox" name="user_auth_tashih">					
					</td>
				</tr>
				<tr class="col1">
					<th colspan="3">
						BASKI
					</th>
				</tr>
				<tr>
					<td width="250" height="30">Kaðýt Temini</td>
					<td>:&nbsp;&nbsp;<input type="checkbox" name="user_auth_kagit">					
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
<pre>
* Parola bilgileri ve eposta bilgileri belirlenmemiþ üyelerin (ACP) yönetim panelini veya (UCP) üye panelini görebilmeleri mümkün deðildir.
* Kýrmýzý iþaretli alanlarýn doldurulmasý zorunludur.
* Üye bilgileri üye düzenleme paneli kullanýlarak deðiþtirilebilir.
</pre>