<?php if (!defined('yakusha')) die('...'); ?>

<div id="page-bgcontent">
<div id="content">


<?php
$cat = $_REQUEST["cat"]; settype($cat,"integer");
$seri = $_REQUEST["seri"]; settype($seri,"integer");
$aramatipi = $_REQUEST["aramatipi"]; 
$aramaanahtari = $_REQUEST["aramaanahtari"]; 
$aramaanahtari = f_secure_search($aramaanahtari);
$get_aramaanahtari = $_REQUEST["aramaanahtari"];
if ($cat > 0 || $seri > 0 || $aramatipi == 'urunadi' || $aramatipi == 'yazaradi')
{
	include($siteyolu."/_lib_page/_f_anasayfa.php");
}
else
{
	$iccat = 1;
	include($siteyolu."/_lib_page/_f_anasayfa.php");

	// $iccat = 2;
	// include($siteyolu."/_lib_page/_f_anasayfa.php");

	// $iccat = 3;
	// include($siteyolu."/_lib_page/_f_anasayfa.php");
}
?>

</div>