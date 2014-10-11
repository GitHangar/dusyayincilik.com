<?php
if (!defined('yakusha')) die('...');

//sayfa saatini ba�lat�yoruz
$starttime = microtime(true);

#hata bast�rma �ekli
// error_reporting(E_ALL);
error_reporting(E_ERROR);

//zaman dilimi de t�rkiye olsun
setlocale(LC_ALL,'tr_TR');
date_default_timezone_set('Europe/Istanbul');

//site yolu tan�mlamalar�
$siteyolu = realpath('./');

//art�k eburhan db class�n� kullanmaya ba�l�yoruz
require($siteyolu.'/_lib_class/eb.vt.php');

//nesne olu�tural�m
$vt = new VT;

# define edilen de�erler
include($siteyolu.'/_lib/lib_con.php');
include($siteyolu.'/_lib/lib_define.php');
include($siteyolu.'/_lib/lib_desc.php');
include($siteyolu.'/_lib/lib_sess.php');
include($siteyolu.'/_lib/lib_func.php');
include($siteyolu.'/_lib/lib_cache.php');
include($siteyolu.'/_lib/lib_array.php');
?>
