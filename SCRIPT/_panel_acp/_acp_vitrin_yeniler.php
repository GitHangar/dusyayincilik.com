<?php
if (!defined('yakusha')) die('...');
if (!$_SESSION[SES]["ADMIN"] == 1) exit ();

include($siteyolu."/_panel_acp/_temp/_t_adminbaslangic.php"); 
 
$sayfaid = "vitrin_yeniler";
$sayfaadi = "Yeni ��kanlar";
$vitrintipi = 1;
$sonucsayisi = 20;

include($siteyolu."/_panel_acp/_acp_vitrin_vitrinfonksiyonu.php");
include($siteyolu."/_panel_acp/_temp/_t_adminbitis.php"); 
?>