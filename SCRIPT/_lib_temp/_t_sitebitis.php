<?php
if (!defined('yakusha')) die('...');
?>

<?php 
$endtime = microtime(true); 
$bitistime = substr(($endtime - $starttime),0,6); 

//$kullanim = memory_get_usage();
$kullanim = memory_get_peak_usage(true);
$kullanim = round($kullanim / 1024 / 1024, 2);
?>
<div style="clear: both;">&nbsp;</div>
</div>
<div id="footer">
<p>
<?php echo $MAGAZA["site_adres"]?>
<br>Tel : <?php echo $MAGAZA["site_telefon"]?> | E-Posta : <a href="mailto:<?php echo $MAGAZA["site_eposta"]?>"><?php echo $MAGAZA["site_eposta"]?></a>
<br>
<br>Tema: <a href="http://nodethirtythree.com">NimbusLike</a> & Sistem: <a href="http://www.libreajans.com">Sabri ÜNAL</a> - SÜS: <?php echo $bitistime?> sayine. USG: <?php echo $kullanim?>  MB.
</p>
</div>
<!-- end #footer -->
</div>
<!-- end #page -->
</div>
</body>
</html>
