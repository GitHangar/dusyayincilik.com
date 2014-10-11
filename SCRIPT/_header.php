<?php
if (!defined('yakusha')) die('...');

//sayfa saatini baþlatýyoruz
$starttime = microtime(true);

#hata bastýrma þekli
// error_reporting(E_ALL);
error_reporting(E_ERROR);

//zaman dilimi de türkiye olsun
setlocale(LC_ALL,'tr_TR');
date_default_timezone_set('Europe/Istanbul');

//site yolu tanýmlamalarý
$siteyolu = realpath('./');

//artýk eburhan db classýný kullanmaya baþlýyoruz
require($siteyolu.'/_lib_class/eb.vt.php');

//nesne oluþturalým
$vt = new VT;

# define edilen deðerler
include($siteyolu.'/_lib/lib_con.php');
include($siteyolu.'/_lib/lib_define.php');
include($siteyolu.'/_lib/lib_desc.php');
include($siteyolu.'/_lib/lib_sess.php');
include($siteyolu.'/_lib/lib_func.php');
include($siteyolu.'/_lib/lib_cache.php');
include($siteyolu.'/_lib/lib_array.php');
?>
