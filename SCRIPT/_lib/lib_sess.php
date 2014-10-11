<?php
# oturum dosyasý
session_start();

//genel oturumu baþlatýyoruz
if ( !isset($_SESSION[SES]) )
{
	$_SESSION[SES]["ip"] = $_SERVER["REMOTE_ADDR"]; // Baðlanýrken kullanýlan IP
	$_SESSION[SES]["tarayici"] = $_SERVER["HTTP_USER_AGENT"]; // Baðlantý hangi tarayýcý ile yapýlmýþ?
	$_SESSION[SES]["ilkerisim"] = time(); // Ýlk baðlantýnýn IP si
	$_SESSION[SES]["sonerisim"] = time(); // En son yapýlan eriþim zamaný
	$_SESSION[SES]["giris"] = 0;
	$_SESSION[SES]["giristar"] = 0;
	$_SESSION[SES]["sessionstarttime"] = $simdikizaman;
}
else
{
	$_SESSION[SES]["sonerisim"] = time(); // En son yapýlan eriþim zamaný
}
?>