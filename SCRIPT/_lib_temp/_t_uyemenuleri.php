<?php
if (!defined('yakusha')) die('...');
if ($_SESSION[SES]["giris"]==0) { ?>

<form method="post" action="<?php echo GIRISLINK?>">

<input name="eposta" id="eposta" style="width: 220px" type="text">
<input name="parola" id="parola" style="width: 160px" type="password">
<input type="submit" name="fmemberin" value="onay">
<?php }
else
{
?>
	<font color="#cc0000" face="trebuchet ms, Arial, Helvetica" size="2"><?php echo $_SESSION[SES]["eposta"];?></font></b>
	<br>
	<?php
	if ($_SESSION[SES]["ADMIN"]==1)
	{
		echo '<br> &bull; <a href="'.ADMINLINK.'">Yönetici Paneli</a>';
	}
	?>
	<br> &bull; <a href="<?php echo PROFILELINK?>">Üye Paneli</a>
	<br> &bull; <a href="<?php echo CIKISLINK?>">Oturumu Kapat</a>
	<?php 
} 
?>
</form>