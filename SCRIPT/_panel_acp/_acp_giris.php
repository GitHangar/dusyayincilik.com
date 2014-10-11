<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"]==1) exit ();
?>

<?php include($siteyolu."/_panel_acp/_temp/_t_adminbaslangic.php"); ?>
<?php include($siteyolu."/_panel_acp/_temp/_t_adminmenuleri.php"); ?>


</div><div id="main">

<h1><?php echo $MAGAZA["site_isim"]?> Yönetim Paneline Hoþgeldiniz</h1>

<p>Bu sayfadan panonuz için gerekli olan tüm fonksiyonlara hýzlý bir þekilde ulaþabilirsiniz.</p>

<?php echo $mesaj?>

<table>
<tr>
<th width="33%">PROJE YÖNETÝMÝ</th>
<th width="34%">ÜYE YÖNETÝMÝ</th>
<th width="33%">BÝLGÝLER</th>
</tr>
<tr>

<td class="middle">
<a class="main-item" href="<?php echo $acp_projelerlink?>&amp;lt=acik"><img src="<?php echo SITELINK?>/_img/_ca/icon_projeler.png"><br>Proje Listesi</a>
<a class="main-item" href="<?php echo $acp_projelerlink?>&amp;urunekle=1"><img src="<?php echo SITELINK?>/_img/_ca/icon_ekle.png"><br>Proje Ekle</a>
</td>

<td class="middle">
<a class="main-item" href="<?php echo $acp_uyelerlink?>"><img src="<?php echo SITELINK?>/_img/_ca/icon_uyeler.png"><br>Üye Listesi</a>
<a class="main-item" href="<?php echo $acp_uyelerlink?>&amp;uyeekle=1"><img src="<?php echo SITELINK?>/_img/_ca/icon_ekle.png"><br>Üye Ekle</a>
</td>

<td class="middle">
<a class="main-item" href=""><img src="<?php echo SITELINK?>/_img/_ca/icon_istatistik.png"><br>Ýstatistikler</a>
</td>

</tr>
<tr>
<th width="33%">ÜRÜN YÖNETÝMÝ</th>
<th width="34%">VÝTRÝN YÖNETÝMÝ</th>
<th width="33%"></th>
</tr>
<tr>

<td class="middle">
<a class="main-item" href="<?php echo $acp_urunlerlink?>"><img src="<?php echo SITELINK?>/_img/_ca/icon_liste.png"><br>Ürün Listesi</a>
<a class="main-item" href="<?php echo $acp_urunlerlink?>&amp;urunekle=1"><img src="<?php echo SITELINK?>/_img/_ca/icon_ekle.png"><br>Ürün Ekle</a>
</td>

<td class="middle">
<a class="main-item" href="<?php echo $acp_vitrinlerlink?>"><img src="<?php echo SITELINK?>/_img/_ca/icon_vitrin.png"><br>Vitrin Yönetimi</a>
<a class="main-item" href="<?php echo $acp_vitrinlerlink?>"><img src="<?php echo SITELINK?>/_img/_ca/icon_ekle.png"><br>Vitrine Ekle</a>
</td>

</tr>
</table>
</div>

<?php include($siteyolu."/_panel_acp/_temp/_t_adminbitis.php"); ?>