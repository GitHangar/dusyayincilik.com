<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"]==1) exit ();

$acp_uyelerlink = ADMINLINK."?menu=uyeler";
$acp_urunlerlink = ADMINLINK."?menu=urunler";
$acp_projelerlink = ADMINLINK."?menu=projeler";
$acp_vitrinlerlink = ADMINLINK."?menu=vitrin_yeniler";
$acp_vitrineeklelink = ADMINLINK."?menu=vitrineekle";
$acp_yazilarlink = ADMINLINK."?menu=yazilar";

$acp_vitrin_yenilerlink = ADMINLINK."?menu=vitrin_yeniler";
$acp_vitrin_coksatanlarlink = ADMINLINK."?menu=vitrin_coksatanlar";
$acp_vitrin_tekrarbaskilarlink = ADMINLINK."?menu=vitrin_tekrarbaskilar";

$acp_anamenulink = ADMINLINK."?menu=giris";
?>

