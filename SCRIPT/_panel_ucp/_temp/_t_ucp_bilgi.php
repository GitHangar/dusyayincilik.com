<?php
if (!defined('yakusha')) die('...');
?>
<div id="main">

<h1>Üye Bilgilerim</h1>

<p>Bu formu kullanarak, Üye Bilgilerinizin denetimini gerçekleþtirebilirsiniz.</p>

<?php echo $islem_bilgisi ?>

<form name="bilgiformu" action="<?php echo $ucp_bilgi?>" method="post">
<table bgcolor="#F9F9F9" width="100%">
<tr><td colspan="3"><strong>Adres Bilgisi</strong></td></tr>
<tr><td style="width: 150px">E-Posta </td><td> : </td><td> <?php echo $_SESSION[SES]["eposta"]?></td></tr>
<tr><td>Ad Soyad </td><td> : </td><td><input type="text" name="name" style="width: 300px" maxlength="70" value="<?php echo $user_name?>"></b><font color="#FF0000">*</font></td></tr>
<tr><td>Kullanýcý Adý </td><td> : </td><td><input type="text" name="username" style="width: 300px" maxlength="70" value="<?php echo $user_username?>"></b><font color="#FF0000">*</font></td></tr>
<tr><td>Tel </td><td> : </td><td><input type="text" name="tel" style="width: 300px" maxlength="70" value="<?php echo $user_tel?>"></b><font color="#FF0000">*</font></td></tr>
<tr>
<td colspan="3" align="center">
<input type="hidden" name="menu" value="bilgi">
<input class="button2" value="Temizle" type="reset">
<input name="bilgiformu" class="button2" value="Üye Bilgilerimi Güncelle" type="submit">
</td>
</tr>
</table>
</form>