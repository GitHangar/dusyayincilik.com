<?php

$dbCon = array(
	'host' => 'localhost',
	'name' => 'dusyayincilik.com',
	'user' => 'root',
	'pass' => '123',
	'lang' => 'latin5',
);
 
$vt->hataGoster(false);
$vt->baglan($dbCon) or die ('<center><img src="http://www.dusyayincilik.com/_img/icon_hata.jpg"></center>');


$YAKUSHA["vtsunucu"] = "localhost";
$YAKUSHA["vtisim"] = "dusyayincilik.com";
$YAKUSHA["vtkullanici"] = "root";
$YAKUSHA["vtparola"] = "123";
$YAKUSHA["vtdil"] = "latin5";

$VT_magaza  =  mysql_connect($YAKUSHA["vtsunucu"],$YAKUSHA["vtkullanici"],$YAKUSHA["vtparola"]) 
or die ('<center><img src="http://www.dusyayincilik.com/_img/icon_hata.jpg"></center>');
$VT_sec = mysql_select_db($YAKUSHA["vtisim"],$VT_magaza);
mysql_query("SET NAMES ".$YAKUSHA["vtdil"]);