<?php
# oturum dosyas�
session_start();

//genel oturumu ba�lat�yoruz
if ( !isset($_SESSION[SES]) )
{
	$_SESSION[SES]["ip"] = $_SERVER["REMOTE_ADDR"]; // Ba�lan�rken kullan�lan IP
	$_SESSION[SES]["tarayici"] = $_SERVER["HTTP_USER_AGENT"]; // Ba�lant� hangi taray�c� ile yap�lm��?
	$_SESSION[SES]["ilkerisim"] = time(); // �lk ba�lant�n�n IP si
	$_SESSION[SES]["sonerisim"] = time(); // En son yap�lan eri�im zaman�
	$_SESSION[SES]["giris"] = 0;
	$_SESSION[SES]["giristar"] = 0;
	$_SESSION[SES]["sessionstarttime"] = $simdikizaman;
}
else
{
	$_SESSION[SES]["sonerisim"] = time(); // En son yap�lan eri�im zaman�
}
?>