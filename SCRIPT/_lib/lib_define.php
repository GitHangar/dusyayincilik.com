<?php
$sitelink = 'http://'.$_SERVER['HTTP_HOST']; $sitelink = trim($sitelink);
$sitelink = 'http://'.$_SERVER['HTTP_HOST'].'/dusyayincilik.com'; 

//seo deðerleri tanýmlanýyor
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
//platform baðýmsýz açýklar için session güvencesi...
//bu da hackerlere kapak olsun
// ==> | iþaretinden sonrasý her site için ayrý tanýmlanmalýdýr 
define ('SES',md5(SITELINK.'|dsn'));

//istisnai durumlar için dosya adlarý oluþturuluyor
define ('URUNDETAY','urundetay.php');

//kayýt ve cache yolunu belirtelim
$vt->kayitYolu('./_cache/'); 
$bellekyolu = '_cache';
?>
