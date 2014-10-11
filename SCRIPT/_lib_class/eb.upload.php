<?php
//
// +---------------------------------------------------------------------------+
// | eburhan Upload class v1.6                                                 |
// +---------------------------------------------------------------------------+
// |                                                                           |
// | Sýnýf adý      : eburhan Upload class                                     |
// | Versiyonu      : 1.6                                                      |
// | Görevi         : sunucuya dosya yüklenmesini saðlar                       |
// | Gereksinimler  : PHP 4.3.0 ve üzeri                                       |
// | Son güncelleme : 13 Þubat 2009, 18:18                                     |
// |                                                                           |
// +---------------------------------------------------------------------------+
// |                                                                           |
// | Programcý      : Erhan BURHAN                                             |
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

// hatalarý ekranda göstermeyi kapat
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
     * kurucu fonksiyondur. öntanýmlý iþlemleri yapar
     *
     * @access  public
     * @param	array	yükleme dizininin yolu
    */
    function UPLOAD($_FILES)
    {
		// GD kütüphanesi etkin mi? (geçersiz resim kontrolü için gerekli)
		$this->_gdEtkin = extension_loaded('gd');

        $dosyalar = array();
        $dosyaSay = count($_FILES['name']);

		// yüklenecek dosya sayýsýna göre "dosyalar" dizisini oluþtur
		if( $dosyaSay===1 && !is_array($_FILES['name']) ) {
			$dosyalar['name'][] 	 = $_FILES['name'];
			$dosyalar['type'][]	 	 = $_FILES['type'];
			$dosyalar['tmp_name'][]  = $_FILES['tmp_name'];
			$dosyalar['error'][] 	 = $_FILES['error'];
			$dosyalar['size'][] 	 = $_FILES['size'];
		} else {
			$dosyalar = $_FILES;
		}

        // boþ kayýtlarý aradan çýkart
        for( $i=0; $i<$dosyaSay; ++$i )
        {
            if( !empty($dosyalar['name'][$i]) )
            {
				// geçerli dosyanýn uzantýsý
                $dosyalar['ext'][$i] = $this->_dosyaUzantisi( $dosyalar['name'][$i] );

                $this->_dosyalar['name'][]      = $dosyalar['name'][$i];
                $this->_dosyalar['ex_name'][]   = $dosyalar['name'][$i];
                $this->_dosyalar['ext'][] 		= $dosyalar['ext'][$i];
                $this->_dosyalar['type'][]      = $dosyalar['type'][$i];
                $this->_dosyalar['tmp_name'][]  = $dosyalar['tmp_name'][$i];
                $this->_dosyalar['error'][]     = $dosyalar['error'][$i];
                $this->_dosyalar['size'][]      = $dosyalar['size'][$i];

                // ön hata kontrolü
                if( $dosyalar['error'][$i] !== 0 ){
                    $this->_hataMsg[] = "<strong>{$dosyalar['name'][$i]}</strong> ".$this->_phpDurumMsj($dosyalar['error'][$i]);
                }

				// MIME kontrolü
                if( $this->_mimeKontrol($dosyalar['ext'][$i], $dosyalar['type'][$i]) === false ){
                    $this->_hataMsg[] = "<strong>{$dosyalar['name'][$i]}</strong> dosyasýnýn MIME tipine izin verilmiyor.";
				}

                /*
					Geçersiz Resim Kontrolü
					 1. önce dosya uzantýsýna bak
					 2. uzantý $_imgUzanti dizisi içerisinde var mý?
					 3. eðer varsa $_imgKontrol() fonksiyonuna gönder
                */
                if( in_array($dosyalar['ext'][$i], $this->_imgUzanti) ) {
					if( $this->_imgKontrol($dosyalar['type'][$i], $dosyalar['tmp_name'][$i])===false ) {
                    	$this->_hataMsg[] = "<strong>{$dosyalar['name'][$i]}</strong> dosyasý geçerli bir resim dosyasý deðil !";
                    }
                }

                $this->_sayDosya++;
            }
        }
    }



    /**
     * dosyalarýn kaydedileceði dizinin yolu
     *
     * @access  public
	 * @param	string	yükleme dizininin yolu
    */
    function yolDizin($yol)
    {
        // Dizin var mý?
        if( !is_dir($yol) && !mkdir($yol, 0755) ){
            $this->_hataMsg[] = "<strong>$yol</strong> klasörü bulunamýyor";
        }

        // Dizin yazýlabilir mi?
        if( !is_writable($yol) && !chmod($yol, 0755) ){
            $this->_hataMsg[] = "<strong>$this->_yolDizin</strong> klasörü yazýlabilir deðil";
        }

        $this->_yolDizin = $yol;
    }



    /**
     * yüklenmesi gereken minimum dosya sayýsý
     *
     * @access  public
	 * @param	integer	tamsayý
    */
    function minDosya($min)
    {
        if( $this->_sayDosya < $min ) {
            $this->_hataMsg[] = "En az <strong>$min</strong> dosya yüklemeniz gerekiyor.";
        }
    }


    /**
     * ayný anda yüklenebilecek maksimum dosya sayýsý
     *
     * @access  public
	 * @param	integer	tamsayý
    */
    function maxDosya($max)
    {
        if( $this->_sayDosya > $max ) {
            $this->_hataMsg[] = "Ayný anda en fazla <strong>$max</strong> dosya yükleyebilirsiniz.";
        }
    }


    /**
     * yüklenecek dosyanýn minimum dosya boyutu
     *
     * @access  public
	 * @param	integer	KB cinsinden tamsayý
    */
    function minBoyut($min)
    {
        for( $i=0; $i<$this->_sayDosya; ++$i )
        {
            if( $this->_dosyalar['size'][$i] < $this->_kb2bayt($min) ){
                $this->_hataMsg[] = "<strong>{$this->_dosyalar['ex_name'][$i]}</strong> dosyasýnýn boyutu <strong>$min KB</strong> altýnda olamaz.";
            }
        }
    }


    /**
     * yüklenecek dosyanýn maksimum dosya boyutu
     *
     * @access  public
	 * @param	integer	KB cinsinden tamsayý
    */
    function maxBoyut($max)
    {
        for( $i=0; $i<$this->_sayDosya; ++$i )
        {
            if( $this->_dosyalar['size'][$i] > $this->_kb2bayt($max) ){
                $this->_hataMsg[] = "<strong>{$this->_dosyalar['ex_name'][$i]}</strong> dosyasýnýn boyutu <strong>$max KB</strong> üstünde olamaz.";
            }
        }
    }


    /**
     * yüklenmesine izin verilmeyecek dosya türleri
     *
     * @access  public
	 * @param	string	'php, exe, bat' þeklindeki uzantýlar
	 * @param	string	uzantýlarý ayýran özel bir karakter
    */
    function tipYasak($uzantilar, $ayirici=',')
    {
		// Uzantýlarý parselle ve ARRAY olarak geri döndür
		$uzantilar = $this->_dosyaUzantisiParselle($ayirici, $uzantilar);

		if( !is_array($uzantilar) ) {
			$this->_hataMsg[] = "<strong>tipYasak</strong> ayarý yanlýþ belirlenmiþ.";
		}

		// uzantý kontrolü
		for( $i=0; $i<$this->_sayDosya; ++$i)
		{
			if( in_array($this->_dosyalar['ext'][$i], $uzantilar) ){
				$this->_hataMsg[] = "<strong>{$this->_dosyalar['ex_name'][$i]}</strong> dosyasý izin verilmeyen bir türde.";
			}
		}
    }


    /**
     * yüklenmesine izin verilecek dosya türleri
     *
     * @access  public
	 * @param	string	'php, exe, bat' þeklindeki uzantýlar
	 * @param	string	uzantýlarý ayýran özel bir karakter
    */
    function tipKabul($uzantilar, $ayirici=',')
    {
		// Uzantýlarý parselle ve ARRAY olarak geri döndür
		$uzantilar = $this->_dosyaUzantisiParselle($ayirici, $uzantilar);

		if( !is_array($uzantilar) ) {
			$this->_hataMsg[] = "<strong>tipKabul</strong> ayarý yanlýþ belirlenmiþ.";
		}

		// uzantý kontrolü
		for( $i=0; $i<$this->_sayDosya; ++$i)
		{
			if( !in_array($this->_dosyalar['ext'][$i], $uzantilar) ){
				$this->_hataMsg[] = "<strong>{$this->_dosyalar['ex_name'][$i]}</strong> dosyasý izin verilmeyen bir türde.";
			}
		}
    }


    /**
     * dosyayý yeniden isimlendir
     *
     * @access  public
	 * @param	string	"yeni_isim" þeklinde gelmeli
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
     * dosya isminin Baþýna bir ifade eklemek için
     *
     * @access  public
	 * @param	string	'ek' þeklinde gelmeli
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
     * dosya isminin Sonuna bir ifade eklemek için
     *
     * @access  public
	 * @param	string	'ek' þeklinde gelmeli
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
     * upload klasöründe ayný isimde dosyalar varsa,
     * üzerlerine yazýlýp yazýlmayacaðýný belirler.
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
     * Yükleme iþlemini baþlatýr. Temp klasöründe bulunan dosyalarý
     * asýl yükleme klasörüne taþýmakla görevlidir.
     *
     * @access  public
	 * @return	boolean
    */
    function baslat()
    {
		// bu noktaya gelinceye kadar bir hata oluþtuysa yüklemeyi durdur
        if( !empty($this->_hataMsg) ) {
            return false;
        }

        /* hata yoksa dosyalarý yeni yerlerine taþýmayý dene */
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

            // yükleme iþlemini baþlat
            if( $this->_yazUstune === false && file_exists($adres) ) {
				$this->_bilgiVer[$i]['durum'] = "ERROR";
				$this->_bilgiVer[$i]['mesaj'] = "Dosya yüklenmedi! Çünkü ayný isimde bir dosya zaten var.";
         	}
            elseif( move_uploaded_file($this->_dosyalar['tmp_name'][$i], $adres) ) {
				$this->_bilgiVer[$i]['durum'] = "OK";
				$this->_bilgiVer[$i]['mesaj'] = "Dosya yüklendi.";
            } else {
				$this->_bilgiVer[$i]['durum'] = "HATA";
                $this->_bilgiVer[$i]['mesaj'] = 'Muhtemelen dosya taþýma hatasý meydana geldi !';
            }
        }

        return true;
    }


    /**
     * bir resim(!) dosyasýnýn, gerçekten resim olup olmadýðý
     * konusunda basit bir kontrol gerçekleþtirir.
     *
     * @access  private
     * @param	string	dosyanýn mime bilgisi
     * @param	string	dosyanýn temp klasöründeki yolu
	 * @return	boolean
    */
    function _imgKontrol($mime, $dosya)
    {
		if( $this->_gdEtkin && !imagecreatefromstring(file_get_contents($dosya)) ) {
            return false;
		}

        // GD etkin deðilse getimagesize ile kontrol et
        if( ($mime == 'image/pjpeg' || $mime == 'image/jpeg') && !getimagesize($dosya) ) return false;
        if( ($mime == 'image/png' || $mime == 'image/x-png') && !getimagesize($dosya) ) return false;
        if( $mime == 'image/gif' && !getimagesize($dosya) ) return false;

  		return true;
    }


    /**
     * yüklenmek istenen dosyanýn içerik türünün (mime type),
     * geçerli olup olmadýðýný kontrol eder.
     *
     * @access  private
     * @param	string	dosya uzantýsý
     * @param	string	kontrol edilecek mime bilgisi
	 * @return	boolean
    */
	function _mimeKontrol($uzanti, $mime)
	{
		// Mime Type bilgileri CodeIgniter çatýsýndan alýnmýþtýr.
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
     * yüklenmek istenen dosyanýn isminde istenmeyen karakterler varsa temizler
     *
     * @access  private
     * @param	string	'türkçe.gif' þeklinde olmalý
	 * @return	string
    */
    function _dosyaIsmiTemizle($oldName)
    {
    	// isim ile uzantýyý ayýr
		$oldName	= trim($oldName);
		$extension 	= strrchr($oldName, '.');
		$extRegex	= "/(\\$extension)\$/";
        $onlyName	= preg_split($extRegex, $oldName, -1, PREG_SPLIT_NO_EMPTY);

		// türkçe karakterleri deðiþtir
		$degistir  = array(
			'ý'=>'i', 'ð'=>'g', 'ü'=>'u', 'þ'=>'s', 'ö'=>'o', 'ç'=>'c',
			'Ý'=>'i', 'Ð'=>'g', 'Ü'=>'U', 'Þ'=>'s', 'Ö'=>'o', 'Ç'=>'c'
		);
		$onlyName[0] = strtr($onlyName[0], $degistir);
		$onlyName[0] = preg_replace('/\W/', '_', $onlyName[0]);

		return ($onlyName[0].$extension);
    }


    /**
     * dosya uzantýsýný parseller
     *
     * @access  private
     * @param	string	uzantýlar arasýndaki ayýrýcý sembol
     * @param	string	'exe, gif' þeklinde gelen uzantýlar
	 * @return	array
    */
    function _dosyaUzantisiParselle($ayirici, $uzantilar)
    {
    	$sonuc = explode($ayirici, $uzantilar);
        $sonuc = array_map('trim', $sonuc);
        return $sonuc;
	}


    /**
     * dosya uzantýsýný bulur
     *
     * @access  private
     * @param	string	'dosya.exe' þeklinde gelir 'exe' olarak çýkar
	 * @return	string
    */
    function _dosyaUzantisi($dosya)
    {
        $ext = strtolower(strrchr($dosya, '.'));
        $ext = substr($ext, 1);
        return $ext;
	}


    /**
     * bu iki fonksiyon BAYT ve KILOBAYT arasý dönüþümü saðlar
     *
     * @access  private
     * @param	integer	'1234' þeklinde tamsayý olmalý
	 * @return	float
    */
    function _bayt2kb($bayt) { return round(($bayt/1024), 2); }
    function _kb2bayt($bayt) { return round(($bayt*1024), 2); }


    /**
     * baþarýyla yüklenen dosyalara ait en son bilgileri verir
     *
     * @access  public
	 * @return	array
    */
    function bilgiVer()
    {
        return $this->_bilgiVer;
    }


    /**
     * oluþan en son hatayý geri döndür
     *
     * @access  public
	 * @return	string
    */
    function sonHata()
    {
        return end($this->_hataMsg);
    }


    /**
     * oluþan ilk hatayý geri döndür
     *
     * @access  public
	 * @return	string
    */
    function ilkHata()
    {
        return $this->_hataMsg[0];
    }


    /**
     * bütün hatalarý bir dizi halinde geri döndür
     *
     * @access  public
	 * @return	array
    */
    function tumHata()
    {
        return $this->_hataMsg;
    }


    /**
     * Upload iþlemi sonrasýnda PHP'nin döndürdüðü durum mesajlarý
     *
     * @access  private
     * @param	integer	hata numarasý
	 * @return	string
    */
	function _phpDurumMsj($no)
	{
		$durum = array();
		$durum[0] = 'dosyasý baþarýyla yüklendi';
		$durum[1] = 'dosyasý, php.ini içerisindeki upload_max_filesize direktifini aþýyor';
		$durum[2] = 'dosyasý, HTML formundaki MAX_FILE_SIZE direktifini aþýyor';
		$durum[3] = 'dosyasýnýn yalnýzca bir kýsmý yüklendi';
		$durum[4] = 'dosyasý yüklenemedi';
		$durum[5] = 'Geçiçi klasör eksik';

		return $durum[$no];
	}

}//sýnýf sonu

// hata raporlamayý eski haline döndür
error_reporting($oldErr);
?>