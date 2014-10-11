<?php
	if (!defined('yakusha')) die('...');

	$vt->sql('SELECT * FROM pco_content ORDER BY createtar DESC')->sor();
	$sonuc = $vt->alHepsi();
	$bulunanadet = $vt->numRows();
	//sayfa içi oluþturuluyor, döne döne
	if ($bulunanadet)
	{
		for ( $i = 0; $i < $bulunanadet; $i++)
		{
			//metin gelmesi gereken alanlar
			$content_id 		= $sonuc[$i]->content_id;
			$content_title 		= $sonuc[$i]->content_title;
			$content_author 	= $sonuc[$i]->content_author;
			$content_image 		= $sonuc[$i]->content_image;
			$content_short 		= $sonuc[$i]->content_short;
			$content_desc 		= $sonuc[$i]->content_desc;

			//metin geldigi için temizlenmesi gereken alanlar
			$content_title 		= stripslashes($content_title);
			$content_author 	= stripslashes($content_author);
			$content_image 		= stripslashes($content_image);
			$content_short 		= stripslashes($content_short);
			$content_desc 		= stripslashes($content_desc);

			//yeni satýrlamalar
			$content_short 		= pco_imla_denetle($content_short);
			$content_desc 		= pco_imla_denetle($content_desc);

			//
			$content_link = SITELINK.'/' . MAKALEDETAY . '?'.ID.'=' . $content_id .'-'. pco_format_url($content_title);
			if (SEO_OPEN == 1) $content_link = SITELINK.'/' . pco_format_url($content_title) . '-' . MSEO_ID . $content_id . SEO;

			if ($content_image)
			{
				$content_image = '<td width="150" valign="top"><img width="120" src="/_img_book/'.$content_image.'"></td>';
			}
			else
			{
				$content_image = '<td width="150" valign="top"></td>';
			}
			$sayfabilgisi.= '
			<tr><td colspan="2"><h2>'.$content_title.'</h2></td></tr>			
			<tr><td colspan="2">&nbsp;</td></tr>			
			<tr>
				'.$content_image.'
				<td valign="top">
				Yazan: '.$content_author.'<br><br>'.$content_short.'<br><br><br><a href="'.$content_link.'">Devamýný Oku &raquo;</a> 
				</td>
			</tr>
			<tr><td colspan="2"><hr></td></tr>';
		}
	}
?>

<div id="page-bgcontent">
<div id="content">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php echo $sayfabilgisi ?>
</table>

</div>
</div>	

