<?php
$sitelink = 'http://'.$_SERVER['HTTP_HOST']; $sitelink = trim($sitelink);
$sitelink = 'http://'.$_SERVER['HTTP_HOST'].'/dusyayincilik.com'; 

//seo de�erleri tan�mlan�yor
define ('SEO','.kitap');
define ('DETAY','k');
define ('MSEO_ID','m');

// define ('SEO_OPEN',0);
define ('SEO_OPEN',1);

//ANA SAYFA
define ('SITELINK',$sitelink);
define ('ANASAYFALINK',SITELINK.'/index.php');
define ('HAKKIMIZDALINK',SITELINK.'/hakkimizda.php');
define ('URUNLERLINK',SITELINK.'/urunler.php');
define ('PROJELERLINK',SITELINK.'/projeler.php');
define ('HABERLERLINK',SITELINK.'/haberler.php');

//ACP & UCP
define ('PROFILELINK',SITELINK.'/ucp.php');
define ('GIRISLINK',SITELINK.'/giris.php');
define ('CIKISLINK',SITELINK.'/giris.php?fsignout=1');
define ('ADMINLINK',SITELINK.'/admin.php');

define ('SATIS','kidap.com.tr');

//SECURTY
//platform ba��ms�z a��klar i�in session g�vencesi...
//bu da hackerlere kapak olsun
// ==> | i�aretinden sonras� her site i�in ayr� tan�mlanmal�d�r 
define ('SES',md5(SITELINK.'|dsn'));

//istisnai durumlar i�in dosya adlar� olu�turuluyor
define ('URUNDETAY','urundetay.php');

//kay�t ve cache yolunu belirtelim
$vt->kayitYolu('./_cache/'); 
$bellekyolu = '_cache';
?>
