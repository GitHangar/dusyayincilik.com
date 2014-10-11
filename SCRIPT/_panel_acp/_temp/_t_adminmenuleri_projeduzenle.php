<?php
if (!defined('yakusha')) die('...');
?>

<ul>
<li class="header"><a href="<?php echo $acp_projelerlink?>">PROJE YÖNETÝMÝ</a></li>
<li <?php if (!$submenu) echo 'id="activemenu"' ?>><span>Baþlangýç</span></li>
<li <?php if ($submenu == 'disisler') echo 'id="activemenu"' ?>><span>Dýþ Ýþler</span></li>
<li <?php if ($submenu == 'mizanpaj') echo 'id="activemenu"' ?>><span>Mizanpaj Kontrol</span></li>
<li <?php if ($submenu == 'kapak') echo 'id="activemenu"' ?>><span>Kapak Kontrol</span></li>
<li <?php if ($submenu == 'baski') echo 'id="activemenu"' ?>><span>Baský Ýþlemleri</span></li>
<li <?php if ($submenu == 'yedek') echo 'id="activemenu"' ?>><span>Yedeklemeler</span></li>
</ul>