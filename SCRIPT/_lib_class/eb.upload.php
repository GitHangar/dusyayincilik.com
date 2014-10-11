<?php
//
// +---------------------------------------------------------------------------+
// | eburhan Upload class v1.6                                                 |
// +---------------------------------------------------------------------------+
// |                                                                           |
// | S�n�f ad�      : eburhan Upload class                                     |
// | Versiyonu      : 1.6                                                      |
// | G�revi         : sunucuya dosya y�klenmesini sa�lar                       |
// | Gereksinimler  : PHP 4.3.0 ve �zeri                                       |
// | Son g�ncelleme : 13 �ubat 2009, 18:18                                     |
// |                                                                           |
// +---------------------------------------------------------------------------+
// |                                                                           |
// | Programc�      : Erhan BURHAN                                             |
// | E-posta        : eburhan {at} gmail {dot} com                             |
// | Web adresi     : http://www.eburhan.com/                          		   |
// |                                                                           |
// +---------------------------------------------------------------------------+
// |                                                                           |
// | Copyright (C) 2008                                                        |
// |                                                                           |
// | This program is free software; you can redistribute it and/or             |
// | modify it under the terms of the GNU General Public License               |
// | as published by the Free Software Foundation; either version 2            |
// | of the License, or (at your option) any later version.                    |
// |                                                                           |
// | This program is distributed in the hope that it will be useful,           |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of            |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
// | GNU General Public License for more details.                              |
// |                                                                           |
// +---------------------------------------------------------------------------+
//

// hatalar� ekranda g�stermeyi kapat
// bu sayede @ kullanmaktan kurtuluyoruz
$oldErr = error_reporting(0);

class UPLOAD{

    var $_dosyalar  = array();
    var $_sayDosya  = 0;
    var $_hataMsg   = array();
    var $_bilgiVer  = array();
    var $_yolDizin  = './upload';
    var $_yazUstune = false;
	var $_imgUzanti = array('png', 'jpg', 'jpeg', 'jpe', 'gif', 'bmp');
    var $_gdEtkin 	= false;


    /**
     * kurucu fonksiyondur. �ntan�ml� i�lemleri yapar
     *
     * @access  public
     * @param	array	y�kleme dizininin yolu
    */
    function UPLOAD($_FILES)
    {
		// GD k�t�phanesi etkin mi? (ge�ersiz resim kontrol� i�in gerekli)
		$this->_gdEtkin = extension_loaded('gd');

        $dosyalar = array();
        $dosyaSay = count($_FILES['name']);

		// y�klenecek dosya say�s�na g�re "dosyalar" dizisini olu�tur
		if( $dosyaSay===1 && !is_array($_FILES['name']) ) {
			$dosyalar['name'][] 	 = $_FILES['name'];
			$dosyalar['type'][]	 	 = $_FILES['type'];
			$dosyalar['tmp_name'][]  = $_FILES['tmp_name'];
			$dosyalar['error'][] 	 = $_FILES['error'];
			$dosyalar['size'][] 	 = $_FILES['size'];
		} else {
			$dosyalar = $_FILES;
		}

        // bo� kay�tlar� aradan ��kart
        for( $i=0; $i<$dosyaSay; ++$i )
        {
            if( !empty($dosyalar['name'][$i]) )
            {
				// ge�erli dosyan�n uzant�s�
                $dosyalar['ext'][$i] = $this->_dosyaUzantisi( $dosyalar['name'][$i] );

                $this->_dosyalar['name'][]      = $dosyalar['name'][$i];
                $this->_dosyalar['ex_name'][]   = $dosyalar['name'][$i];
                $this->_dosyalar['ext'][] 		= $dosyalar['ext'][$i];
                $this->_dosyalar['type'][]      = $dosyalar['type'][$i];
                $this->_dosyalar['tmp_name'][]  = $dosyalar['tmp_name'][$i];
                $this->_dosyalar['error'][]     = $dosyalar['error'][$i];
                $this->_dosyalar['size'][]      = $dosyalar['size'][$i];

                // �n hata kontrol�
                if( $dosyalar['error'][$i] !== 0 ){
                    $this->_hataMsg[] = "<strong>{$dosyalar['name'][$i]}</strong> ".$this->_phpDurumMsj($dosyalar['error'][$i]);
                }

				// MIME kontrol�
                if( $this->_mimeKontrol($dosyalar['ext'][$i], $dosyalar['type'][$i]) === false ){
                    $this->_hataMsg[] = "<strong>{$dosyalar['name'][$i]}</strong> dosyas�n�n MIME tipine izin verilmiyor.";
				}

                /*
					Ge�ersiz Resim Kontrol�
					 1. �nce dosya uzant�s�na bak
					 2. uzant� $_imgUzanti dizisi i�erisinde var m�?
					 3. e�er varsa $_imgKontrol() fonksiyonuna g�nder
                */
                if( in_array($dosyalar['ext'][$i], $this->_imgUzanti) ) {
					if( $this->_imgKontrol($dosyalar['type'][$i], $dosyalar['tmp_name'][$i])===false ) {
                    	$this->_hataMsg[] = "<strong>{$dosyalar['name'][$i]}</strong> dosyas� ge�erli bir resim dosyas� de�il !";
                    }
                }

                $this->_sayDosya++;
            }
        }
    }



    /**
     * dosyalar�n kaydedilece�i dizinin yolu
     *
     * @access  public
	 * @param	string	y�kleme dizininin yolu
    */
    function yolDizin($yol)
    {
        // Dizin var m�?
        if( !is_dir($yol) && !mkdir($yol, 0755) ){
            $this->_hataMsg[] = "<strong>$yol</strong> klas�r� bulunam�yor";
        }

        // Dizin yaz�labilir mi?
        if( !is_writable($yol) && !chmod($yol, 0755) ){
            $this->_hataMsg[] = "<strong>$this->_yolDizin</strong> klas�r� yaz�labilir de�il";
        }

        $this->_yolDizin = $yol;
    }



    /**
     * y�klenmesi gereken minimum dosya say�s�
     *
     * @access  public
	 * @param	integer	tamsay�
    */
    function minDosya($min)
    {
        if( $this->_sayDosya < $min ) {
            $this->_hataMsg[] = "En az <strong>$min</strong> dosya y�klemeniz gerekiyor.";
        }
    }


    /**
     * ayn� anda y�klenebilecek maksimum dosya say�s�
     *
     * @access  public
	 * @param	integer	tamsay�
    */
    function maxDosya($max)
    {
        if( $this->_sayDosya > $max ) {
            $this->_hataMsg[] = "Ayn� anda en fazla <strong>$max</strong> dosya y�kleyebilirsiniz.";
        }
    }


    /**
     * y�klenecek dosyan�n minimum dosya boyutu
     *
     * @access  public
	 * @param	integer	KB cinsinden tamsay�
    */
    function minBoyut($min)
    {
        for( $i=0; $i<$this->_sayDosya; ++$i )
        {
            if( $this->_dosyalar['size'][$i] < $this->_kb2bayt($min) ){
                $this->_hataMsg[] = "<strong>{$this->_dosyalar['ex_name'][$i]}</strong> dosyas�n�n boyutu <strong>$min KB</strong> alt�nda olamaz.";
            }
        }
    }


    /**
     * y�klenecek dosyan�n maksimum dosya boyutu
     *
     * @access  public
	 * @param	integer	KB cinsinden tamsay�
    */
    function maxBoyut($max)
    {
        for( $i=0; $i<$this->_sayDosya; ++$i )
        {
            if( $this->_dosyalar['size'][$i] > $this->_kb2bayt($max) ){
                $this->_hataMsg[] = "<strong>{$this->_dosyalar['ex_name'][$i]}</strong> dosyas�n�n boyutu <strong>$max KB</strong> �st�nde olamaz.";
            }
        }
    }


    /**
     * y�klenmesine izin verilmeyecek dosya t�rleri
     *
     * @access  public
	 * @param	string	'php, exe, bat' �eklindeki uzant�lar
	 * @param	string	uzant�lar� ay�ran �zel bir karakter
    */
    function tipYasak($uzantilar, $ayirici=',')
    {
		// Uzant�lar� parselle ve ARRAY olarak geri d�nd�r
		$uzantilar = $this->_dosyaUzantisiParselle($ayirici, $uzantilar);

		if( !is_array($uzantilar) ) {
			$this->_hataMsg[] = "<strong>tipYasak</strong> ayar� yanl�� belirlenmi�.";
		}

		// uzant� kontrol�
		for( $i=0; $i<$this->_sayDosya; ++$i)
		{
			if( in_array($this->_dosyalar['ext'][$i], $uzantilar) ){
				$this->_hataMsg[] = "<strong>{$this->_dosyalar['ex_name'][$i]}</strong> dosyas� izin verilmeyen bir t�rde.";
			}
		}
    }


    /**
     * y�klenmesine izin verilecek dosya t�rleri
     *
     * @access  public
	 * @param	string	'php, exe, bat' �eklindeki uzant�lar
	 * @param	string	uzant�lar� ay�ran �zel bir karakter
    */
    function tipKabul($uzantilar, $ayirici=',')
    {
		// Uzant�lar� parselle ve ARRAY olarak geri d�nd�r
		$uzantilar = $this->_dosyaUzantisiParselle($ayirici, $uzantilar);

		if( !is_array($uzantilar) ) {
			$this->_hataMsg[] = "<strong>tipKabul</strong> ayar� yanl�� belirlenmi�.";
		}

		// uzant� kontrol�
		for( $i=0; $i<$this->_sayDosya; ++$i)
		{
			if( !in_array($this->_dosyalar['ext'][$i], $uzantilar) ){
				$this->_hataMsg[] = "<strong>{$this->_dosyalar['ex_name'][$i]}</strong> dosyas� izin verilmeyen bir t�rde.";
			}
		}
    }


    /**
     * dosyay� yeniden isimlendir
     *
     * @access  public
	 * @param	string	"yeni_isim" �eklinde gelmeli
    */
    function yeniAd($ad)
    {
        if( is_bool($ad) && $ad === true )
        {
            for( $i=0; $i<$this->_sayDosya; ++$i )
            {
                $this->_dosyalar['name'][$i] = md5(uniqid(mt_rand(), true)).'.'.$this->_dosyalar['ext'][$i];
            }
        }
        elseif( is_bool($ad) && $ad === false )
        {
            for( $i=0; $i<$this->_sayDosya; ++$i )
            {
                // dosya ismindeki istenmeyen karakterleri temizle
                $this->_dosyalar['name'][$i] = $this->_dosyaIsmiTemizle( $this->_dosyalar['name'][$i] );
            }
        }
        else
        {
            for( $i=0; $i<$this->_sayDosya; ++$i )
            {
                $this->_dosyalar['name'][$i] = $ad.'.'.$this->_dosyalar['ext'][$i];
            }
        }
    }


    /**
     * dosya isminin Ba��na bir ifade eklemek i�in
     *
     * @access  public
	 * @param	string	'ek' �eklinde gelmeli
    */
    function basaEk($ek)
    {
        if( is_bool($ek) && $ek === true )
        {
            for( $i=0; $i<$this->_sayDosya; ++$i )
            {
                $oldName  = $this->_dosyalar['name'][$i];
                $newName  = ($i+1).'_'.$oldName;

                $this->_dosyalar['name'][$i] = $newName;
            }
        }

        if( is_string($ek) )
        {
            for( $i=0; $i<$this->_sayDosya; ++$i )
            {
                $oldName  = $this->_dosyalar['name'][$i];
                $newName  = $ek.'_'.$oldName;

                $this->_dosyalar['name'][$i] = $newName;
            }
        }
    }


    /**
     * dosya isminin Sonuna bir ifade eklemek i�in
     *
     * @access  public
	 * @param	string	'ek' �eklinde gelmeli
    */
    function sonaEk($ek)
    {
        if( is_bool($ek) && $ek === true )
        {
            for( $i=0; $i<$this->_sayDosya; ++$i )
            {
                $oldName    = $this->_dosyalar['name'][$i];
                $extension  = '.'.$this->_dosyalar['ext'][$i];

                $noExtension = explode($extension, $oldName);
                $newName     = $noExtension[0].'_'.($i+1).$extension;

                $this->_dosyalar['name'][$i] = $newName;
            }
        }

        if( is_string($ek) )
        {
            for( $i=0; $i<$this->_sayDosya; ++$i )
            {
                $oldName    = $this->_dosyalar['name'][$i];
                $extension  = '.'.$this->_dosyalar['ext'][$i];

                $noExtension = explode($extension, $oldName);
                $newName     = $noExtension[0].'_'.$ek.$extension;

                $this->_dosyalar['name'][$i] = $newName;
            }
        }
    }


    /**
     * upload klas�r�nde ayn� isimde dosyalar varsa,
     * �zerlerine yaz�l�p yaz�lmayaca��n� belirler.
     *
     * @access  public
	 * @param	boolean
    */
    function yazUstune($durum=true)
    {
		if( is_bool($durum) && $durum === false ) {
			$this->_yazUstune = false;
		} else {
			$this->_yazUstune = true;
		}
	}


    /**
     * Y�kleme i�lemini ba�lat�r. Temp klas�r�nde bulunan dosyalar�
     * as�l y�kleme klas�r�ne ta��makla g�revlidir.
     *
     * @access  public
	 * @return	boolean
    */
    function baslat()
    {
		// bu noktaya gelinceye kadar bir hata olu�tuysa y�klemeyi durdur
        if( !empty($this->_hataMsg) ) {
            return false;
        }

        /* hata yoksa dosyalar� yeni yerlerine ta��may� dene */
        for( $i=0; $i<$this->_sayDosya; ++$i)
        {
            $isim	= $this->_dosyaIsmiTemizle( $this->_dosyalar['name'][$i] );
            $adres	= $this->_yolDizin.'/'.$isim;

            // TEMEL dosya bilgilerini kaydet
            $this->_bilgiVer[$i]['yeniAd']	= $isim;
			$this->_bilgiVer[$i]['eskiAd'] 	= $this->_dosyalar['ex_name'][$i];
			$this->_bilgiVer[$i]['icerik']	= $this->_dosyalar['type'][$i];
			$this->_bilgiVer[$i]['boyut']	= $this->_dosyalar['size'][$i];
			$this->_bilgiVer[$i]['adres']	= $adres;

            // y�kleme i�lemini ba�lat
            if( $this->_yazUstune === false && file_exists($adres) ) {
				$this->_bilgiVer[$i]['durum'] = "ERROR";
				$this->_bilgiVer[$i]['mesaj'] = "Dosya y�klenmedi! ��nk� ayn� isimde bir dosya zaten var.";
         	}
            elseif( move_uploaded_file($this->_dosyalar['tmp_name'][$i], $adres) ) {
				$this->_bilgiVer[$i]['durum'] = "OK";
				$this->_bilgiVer[$i]['mesaj'] = "Dosya y�klendi.";
            } else {
				$this->_bilgiVer[$i]['durum'] = "HATA";
                $this->_bilgiVer[$i]['mesaj'] = 'Muhtemelen dosya ta��ma hatas� meydana geldi !';
            }
        }

        return true;
    }


    /**
     * bir resim(!) dosyas�n�n, ger�ekten resim olup olmad���
     * konusunda basit bir kontrol ger�ekle�tirir.
     *
     * @access  private
     * @param	string	dosyan�n mime bilgisi
     * @param	string	dosyan�n temp klas�r�ndeki yolu
	 * @return	boolean
    */
    function _imgKontrol($mime, $dosya)
    {
		if( $this->_gdEtkin && !imagecreatefromstring(file_get_contents($dosya)) ) {
            return false;
		}

        // GD etkin de�ilse getimagesize ile kontrol et
        if( ($mime == 'image/pjpeg' || $mime == 'image/jpeg') && !getimagesize($dosya) ) return false;
        if( ($mime == 'image/png' || $mime == 'image/x-png') && !getimagesize($dosya) ) return false;
        if( $mime == 'image/gif' && !getimagesize($dosya) ) return false;

  		return true;
    }


    /**
     * y�klenmek istenen dosyan�n i�erik t�r�n�n (mime type),
     * ge�erli olup olmad���n� kontrol eder.
     *
     * @access  private
     * @param	string	dosya uzant�s�
     * @param	string	kontrol edilecek mime bilgisi
	 * @return	boolean
    */
	function _mimeKontrol($uzanti, $mime)
	{
		// Mime Type bilgileri CodeIgniter �at�s�ndan al�nm��t�r.
		$uzantilar  = array(
            'hqx'	=>	'application/mac-binhex40',
			'cpt'	=>	'application/mac-compactpro',
			'csv'	=>	array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel'),
			'bin'	=>	'application/macbinary',
			'dms'	=>	'application/octet-stream',
			'lha'	=>	'application/octet-stream',
			'lzh'	=>	'application/octet-stream',
			'exe'	=>	'application/octet-stream',
			'class'	=>	'application/octet-stream',
			'psd'	=>	'application/x-photoshop',
			'so'	=>	'application/octet-stream',
			'sea'	=>	'application/octet-stream',
			'dll'	=>	'application/octet-stream',
			'oda'	=>	'application/oda',
			'pdf'	=>	array('application/pdf', 'application/x-download'),
			'ai'	=>	'application/postscript',
			'eps'	=>	'application/postscript',
			'ps'	=>	'application/postscript',
			'smi'	=>	'application/smil',
			'smil'	=>	'application/smil',
			'mif'	=>	'application/vnd.mif',
			'xls'	=>	array('application/excel', 'application/vnd.ms-excel', 'application/msexcel'),
			'ppt'	=>	array('application/powerpoint', 'application/vnd.ms-powerpoint'),
			'wbxml'	=>	'application/wbxml',
			'wmlc'	=>	'application/wmlc',
			'dcr'	=>	'application/x-director',
			'dir'	=>	'application/x-director',
			'dxr'	=>	'application/x-director',
			'dvi'	=>	'application/x-dvi',
			'gtar'	=>	'application/x-gtar',
			'gz'	=>	'application/x-gzip',
			'php'	=>	'application/x-httpd-php',
			'php4'	=>	'application/x-httpd-php',
			'php3'	=>	'application/x-httpd-php',
			'phtml'	=>	'application/x-httpd-php',
			'phps'	=>	'application/x-httpd-php-source',
			'js'	=>	'application/x-javascript',
			'swf'	=>	'application/x-shockwave-flash',
			'sit'	=>	'application/x-stuffit',
			'tar'	=>	'application/x-tar',
			'tgz'	=>	'application/x-tar',
			'xhtml'	=>	'application/xhtml+xml',
			'xht'	=>	'application/xhtml+xml',
			'zip'	=>  array('application/x-zip', 'application/zip', 'application/x-zip-compressed'),
			'mid'	=>	'audio/midi',
			'midi'	=>	'audio/midi',
			'mpga'	=>	'audio/mpeg',
			'mp2'	=>	'audio/mpeg',
			'mp3'	=>	array('audio/mpeg', 'audio/mpg'),
			'aif'	=>	'audio/x-aiff',
			'aiff'	=>	'audio/x-aiff',
			'aifc'	=>	'audio/x-aiff',
			'ram'	=>	'audio/x-pn-realaudio',
			'rm'	=>	'audio/x-pn-realaudio',
			'rpm'	=>	'audio/x-pn-realaudio-plugin',
			'ra'	=>	'audio/x-realaudio',
			'rv'	=>	'video/vnd.rn-realvideo',
			'wav'	=>	'audio/x-wav',
			'bmp'	=>	'image/bmp',
			'gif'	=>	'image/gif',
			'jpeg'	=>	array('image/jpeg', 'image/pjpeg'),
			'jpg'	=>	array('image/jpeg', 'image/pjpeg'),
			'jpe'	=>	array('image/jpeg', 'image/pjpeg'),
			'png'	=>	array('image/png',  'image/x-png'),
			'tiff'	=>	'image/tiff',
			'tif'	=>	'image/tiff',
			'css'	=>	'text/css',
			'html'	=>	'text/html',
			'htm'	=>	'text/html',
			'shtml'	=>	'text/html',
			'txt'	=>	'text/plain',
			'text'	=>	'text/plain',
			'log'	=>	array('text/plain', 'text/x-log'),
			'rtx'	=>	'text/richtext',
			'rtf'	=>	'text/rtf',
			'xml'	=>	'text/xml',
			'xsl'	=>	'text/xml',
			'mpeg'	=>	'video/mpeg',
			'mpg'	=>	'video/mpeg',
			'mpe'	=>	'video/mpeg',
			'qt'	=>	'video/quicktime',
			'mov'	=>	'video/quicktime',
			'avi'	=>	'video/x-msvideo',
			'movie'	=>	'video/x-sgi-movie',
			'doc'	=>	'application/msword',
			'docx'	=>	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'xlsx'	=>	'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			'word'	=>	array('application/msword', 'application/octet-stream'),
			'xl'	=>	'application/excel',
			'eml'	=>	'message/rfc822'
		);

		if( !isset($uzantilar[$uzanti]) ) return false;

		if( is_array($uzantilar[$uzanti]) ) {
			return in_array($mime, $uzantilar[$uzanti]);
		}
		// is_string
		return ($mime===$uzantilar[$uzanti]);
	}


    /**
     * y�klenmek istenen dosyan�n isminde istenmeyen karakterler varsa temizler
     *
     * @access  private
     * @param	string	't�rk�e.gif' �eklinde olmal�
	 * @return	string
    */
    function _dosyaIsmiTemizle($oldName)
    {
    	// isim ile uzant�y� ay�r
		$oldName	= trim($oldName);
		$extension 	= strrchr($oldName, '.');
		$extRegex	= "/(\\$extension)\$/";
        $onlyName	= preg_split($extRegex, $oldName, -1, PREG_SPLIT_NO_EMPTY);

		// t�rk�e karakterleri de�i�tir
		$degistir  = array(
			'�'=>'i', '�'=>'g', '�'=>'u', '�'=>'s', '�'=>'o', '�'=>'c',
			'�'=>'i', '�'=>'g', '�'=>'U', '�'=>'s', '�'=>'o', '�'=>'c'
		);
		$onlyName[0] = strtr($onlyName[0], $degistir);
		$onlyName[0] = preg_replace('/\W/', '_', $onlyName[0]);

		return ($onlyName[0].$extension);
    }


    /**
     * dosya uzant�s�n� parseller
     *
     * @access  private
     * @param	string	uzant�lar aras�ndaki ay�r�c� sembol
     * @param	string	'exe, gif' �eklinde gelen uzant�lar
	 * @return	array
    */
    function _dosyaUzantisiParselle($ayirici, $uzantilar)
    {
    	$sonuc = explode($ayirici, $uzantilar);
        $sonuc = array_map('trim', $sonuc);
        return $sonuc;
	}


    /**
     * dosya uzant�s�n� bulur
     *
     * @access  private
     * @param	string	'dosya.exe' �eklinde gelir 'exe' olarak ��kar
	 * @return	string
    */
    function _dosyaUzantisi($dosya)
    {
        $ext = strtolower(strrchr($dosya, '.'));
        $ext = substr($ext, 1);
        return $ext;
	}


    /**
     * bu iki fonksiyon BAYT ve KILOBAYT aras� d�n���m� sa�lar
     *
     * @access  private
     * @param	integer	'1234' �eklinde tamsay� olmal�
	 * @return	float
    */
    function _bayt2kb($bayt) { return round(($bayt/1024), 2); }
    function _kb2bayt($bayt) { return round(($bayt*1024), 2); }


    /**
     * ba�ar�yla y�klenen dosyalara ait en son bilgileri verir
     *
     * @access  public
	 * @return	array
    */
    function bilgiVer()
    {
        return $this->_bilgiVer;
    }


    /**
     * olu�an en son hatay� geri d�nd�r
     *
     * @access  public
	 * @return	string
    */
    function sonHata()
    {
        return end($this->_hataMsg);
    }


    /**
     * olu�an ilk hatay� geri d�nd�r
     *
     * @access  public
	 * @return	string
    */
    function ilkHata()
    {
        return $this->_hataMsg[0];
    }


    /**
     * b�t�n hatalar� bir dizi halinde geri d�nd�r
     *
     * @access  public
	 * @return	array
    */
    function tumHata()
    {
        return $this->_hataMsg;
    }


    /**
     * Upload i�lemi sonras�nda PHP'nin d�nd�rd��� durum mesajlar�
     *
     * @access  private
     * @param	integer	hata numaras�
	 * @return	string
    */
	function _phpDurumMsj($no)
	{
		$durum = array();
		$durum[0] = 'dosyas� ba�ar�yla y�klendi';
		$durum[1] = 'dosyas�, php.ini i�erisindeki upload_max_filesize direktifini a��yor';
		$durum[2] = 'dosyas�, HTML formundaki MAX_FILE_SIZE direktifini a��yor';
		$durum[3] = 'dosyas�n�n yaln�zca bir k�sm� y�klendi';
		$durum[4] = 'dosyas� y�klenemedi';
		$durum[5] = 'Ge�i�i klas�r eksik';

		return $durum[$no];
	}

}//s�n�f sonu

// hata raporlamay� eski haline d�nd�r
error_reporting($oldErr);
?>