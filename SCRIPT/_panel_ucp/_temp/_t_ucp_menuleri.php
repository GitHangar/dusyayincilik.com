<?php
if (!defined('yakusha')) die('...');
?>

<div id="menu">
<p><strong><?php echo $_SESSION[SES]["eposta"];?></strong> 
<br>[ <a href="<?php echo CIKISLINK?>">Oturum Kapat</a> ]
<?php 
if ($_SESSION[SES]["ADMIN"]==1)
{
	echo '<br>[ <a href="'.ADMINLINK.'">Yetkili Paneli</a> ]';
}
?>

<ul>
<li class="header">Hýzlý Menü</li>
<li <?php if($id == 'bilgi') echo 'id="activemenu"'; ?>><a href="<?php echo $ucp_bilgi?>"><span>Üye Bilgilerim</span></a></li>
<li <?php if($id == 'parola') echo 'id="activemenu"'; ?>><a href="<?php echo $ucp_parola?>"><span>Parola Bilgilerim</span></a></li>
</ul>
</div>