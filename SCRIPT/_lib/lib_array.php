<?php

$array_yillar = array(
	'0' => '',
	'1980' => '1980',
	'1981' => '1981',
	'1982' => '1982',
	'1983' => '1983',
	'1984' => '1984',
	'1985' => '1985',
	'1986' => '1986',
	'1987' => '1987',
	'1988' => '1988',
	'1989' => '1989',
	'1990' => '1990',
	'1991' => '1991',
	'1992' => '1992',
	'1993' => '1993',
	'1994' => '1994',
	'1995' => '1995',
	'1996' => '1996',
	'1997' => '1997',
	'1998' => '1998',
	'2009' => '2009',
	'2000' => '2000',
	'2001' => '2001',
	'2002' => '2002',
	'2003' => '2003',
	'2004' => '2004',
	'2005' => '2005',
	'2006' => '2006',
	'2007' => '2007',
	'2008' => '2008',
	'2009' => '2009',
	'2010' => '2010',
	'2011' => '2011',
	'2012' => '2012',
	'2013' => '2013',
	'2014' => '2014',
	'2015' => '2015',
	'2016' => '2016',
	'2017' => '2017',
	'2018' => '2018',
	'2019' => '2019'
);

$array_aylar = array(
	'0' => '',
	'1' => 'Ocak',
	'2' => '�ubat',
	'3' => 'Mart',
	'4' => 'Nisan',
	'5' => 'May�s',
	'6' => 'Haziran',
	'7' => 'Temmuz',
	'8' => 'A�ustos',
	'9' => 'Eyl�l',
	'10' => 'Ekim',
	'11' => 'Kas�m',
	'12' => 'Aral�k'
);

$array_kdv = array(
	'0' => '0',
	'1' => '1',
	'8' => '8',
	'18' => '18');

$array_yayinevi = array(
	'0' => 'Yay�nevi Tan�ms�z',
	'1' => 'D�� Yay�nc�l�k',
);


$count_yayinevi = count($array_yayinevi);

$array_satisdurumu = array(
	'0' => '<img title="sat��ta" src="'.SITELINK.'/_img/icon_check.gif">',
	'1' => '<img title="t�kendi" src="'.SITELINK.'/_img/icon_tukendi.gif">',
	'2' => '<img title="ar�iv" src="'.SITELINK.'/_img/icon_ikaz.gif">',
	'3' => '<img title="silinmi�" src="'.SITELINK.'/_img/icon_ikaz.gif">',
	'10' => '<img title="proje" src="'.SITELINK.'/_img/icon_bilgi.png">'
);

$array_urun_satisdurumu_adlari = array(
	'0' => 'Sat��ta',
	'1' => 'T�kendi',
	'2' => 'Ar�iv',
	'3' => 'Silinmi�',
	'10' => 'Proje'
);

$count_urun_satisdurumu_adlari = count($array_urun_satisdurumu_adlari);

$array_seri_adlari = array(
	'0' => 'Seri Tan�mlanmam��',
	'1' => 'D�� Kitapl���',
);
$count_seri_adlari = count($array_seri_adlari);

$array_kategori_adlari = array(
	'0' => 'Kategori Tan�mlanmam��',
	'1' => 'Edebiyat',
	'2' => '�iir'
);

$array_yayindili_adlari = array(
	'0' => 'T�rk�e',
	'1' => '�ngilizce',
);

#####################################################
# PROJELER SAYFASI ���N D�Z�LER
#####################################################
$array_yillar_publish_planed = array(
	'0' => '',
	'2010' => '2010',
	'2011' => '2011',
	'2012' => '2012',
	'2013' => '2013',
	'2014' => '2014',
	'2015' => '2015',
	'2016' => '2016',
	'2017' => '2017',
	'2018' => '2018',
	'2019' => '2019'
);

$array_book_type = array(
	'1' => 'Yeni Kitap',
	'2' => 'Yeni Bask�',
	'3' => 'Edit�rl�k',
	'0' => 'Belirtilmedi'
);

$array_book_status = array(
	'0' => 'a��k',
	'1' => 'ba�land�',
	'2' => 'beklemede',
	'3' => 'durduruldu',
	'4' => 'd���k oldu',
	'5' => 'iptal edildi',
	'6' => 'tamamland�'
);

$array_culture_status = array(
	'0' => 'Bekliyor',
	'1' => 'Ba�vuruldu',
	'2' => 'Al�nd�'
);

$array_delivery_type = array(
	'0' => 'Belirsiz',
	'1' => 'Word',
	'2' => 'Ka��t',
	'3' => 'Di�er'
);

$array_gunler = array(
	'0' => '',
	'1' => '1',
	'2' => '2',
	'3' => '3',
	'4' => '4',
	'5' => '5',
	'6' => '6',
	'7' => '7',
	'8' => '8',
	'9' => '9',
	'10' => '10',
	'11' => '11',
	'12' => '12',
	'13' => '13',
	'14' => '14',
	'15' => '15',
	'16' => '16',
	'17' => '17',
	'18' => '18',
	'19' => '19',
	'20' => '20',
	'21' => '21',
	'22' => '22',
	'23' => '23',
	'24' => '24',
	'25' => '25',
	'26' => '26',
	'27' => '27',
	'28' => '28',
	'29' => '29',
	'30' => '30',
	'31' => '31'
);

$array_copyright_duration = array(
	'0' => 'belirtilmedi',
	'1' => '1 Y�l',
	'2' => '2 Y�l',
	'3' => '3 Y�l',
	'4' => '4 Y�l',
	'5' => '5 Y�l',
	'6' => 'kar��l�kl�',
	'7' => 's�resiz'
);


$array_user_status = array(
	'0' => '�ye',
	'1' => 'Yetkili',
	'10' => 'Admin'
);

$array_disisler_status = array(
	'0' => 'bekliyor',
	'1' => 'ki�i se�ildi',
	'2' => 'proje g�nderilecek',
	'3' => 'proje g�nderildi',
	'4' => 'proje teslim al�nd�'
);

//mizanpaj kontrol dizileri

$array_mizanpaj_font = array(
	'0' => 'belirtilmedi',
	'1' => 'Standart',
);

$array_mizanpaj_punto = array(
	'0' => 'belirtilmedi',
	'1' => 'Standart',
);

$array_mizanpaj_satiraraligi = array(
	'0' => 'belirtilmedi',
	'1' => 'Standart',
);

$array_mizanpaj_sayfanostili = array(
	'0' => 'belirtilmedi',
	'1' => '�st, Sol',
	'2' => '�st, Orta',
	'3' => '�st, Sa�',
	'4' => 'Alt, Sol',
	'5' => 'Alt, Orta',
	'6' => 'Alt, Sa�',
	'7' => 'Yan, Ortal�'
);

$array_mizanpaj_paragrafgirintisi = array(
	'0' => 'belirtilmedi',
	'1' => 'Var',
	'2' => 'Yok',
	'3' => 'Yetersiz',
	'4' => 'Gereksiz'
);

$array_mizanpaj_paragrafgirintisi_status = array(
	'0' => 'belirtilmedi',
	'1' => 'Kabul Edildi',
	'2' => 'Kabul Edilmedi',
	'3' => 'Yetersiz',
	'4' => 'Gereksiz'
);

$array_mizanpaj_yazistili = array(
	'0' => 'belirtilmedi',
	'1' => 'Normal',
	'2' => 'Ortal�',
	'3' => 'Resimli',
	'4' => 'Meal',
	'5' => '�zel'
);

$array_mizanpaj_kapaktipleri = array(
	'0' => 'belirtilmedi',
	'1' => 'D�� Kitapl���',
);

$array_kapak_text_direction = array(
	'0' => 'belirtilmedi',
	'1' => 'Yukar�dan A�a��ya',
	'2' => 'A�a��dan Yukar�ya',
	'3' => 'Yatay'
);

$array_kapak_ayrac_direction = array(
	'0' => 'belirtilmedi',
	'1' => 'Yukar�dan A�a��ya',
	'2' => 'Yatay'
);

$array_baski_kapaktipleri = array(
	'0' => 'belirtilmedi',
	'1' => 'Sert Kapak',
	'2' => 'Amerikan Cilt'
);

//vitrine eklerken kullan�yoruz
$array_vitrin_tipleri = array(
	'1' => 'Yeni ��kanlar',
	'2' => '�ok Satanlar',
	'3' => 'Tekrar Bask�lar'
);