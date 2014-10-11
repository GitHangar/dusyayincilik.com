<?php
if (!defined('yakusha')) die('...');
?>
<!-- end #content -->
<div id="sidebar">

<h2>Serilerimiz</h2>
<ul>
<?php
asort($array_seri_adlari);
foreach ($array_seri_adlari as $k => $v)
{
if ($k > 0) echo '<li>&raquo; <a href="'.ANASAYFALINK.'?seri='.$k.'">'.$v.'</a></li>';
}	
?>
</ul>
</li>
<li>
<?php
include($siteyolu."/_lib_temp/_t_uyemenuleri.php");
?>
</li>
</ul>
</div>

<!-- end #sidebar -->