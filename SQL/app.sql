SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `pco_book`;
CREATE TABLE IF NOT EXISTS `pco_book` (
`book_id` int(11) NOT NULL,
  `book_type` int(1) NOT NULL DEFAULT '0',
  `book_status` int(2) NOT NULL DEFAULT '0',
  `book_name` varchar(250) CHARACTER SET latin5 NOT NULL,
  `book_author` varchar(250) CHARACTER SET latin5 NOT NULL,
  `book_editor` varchar(250) CHARACTER SET latin5 NOT NULL,
  `book_translator` varchar(250) CHARACTER SET latin5 NOT NULL,
  `book_pagecount` varchar(5) CHARACTER SET latin5 NOT NULL,
  `book_isbn` varchar(20) CHARACTER SET latin5 NOT NULL,
  `book_publisher` int(3) NOT NULL,
  `book_pubnumber` varchar(5) CHARACTER SET latin5 NOT NULL,
  `book_serias` int(2) NOT NULL DEFAULT '0',
  `book_serias_id` varchar(5) CHARACTER SET latin5 NOT NULL,
  `book_publish_planed_date` varchar(20) CHARACTER SET latin5 NOT NULL,
  `book_published_date` varchar(20) CHARACTER SET latin5 NOT NULL,
  `book_isbn_status` int(2) NOT NULL,
  `book_bandrol_status` int(2) NOT NULL,
  `author_copyright_agreement` int(2) NOT NULL,
  `author_copyright_agreement_date` varchar(20) CHARACTER SET latin5 NOT NULL,
  `author_copyright_agreement_duration` int(3) NOT NULL DEFAULT '0',
  `author_copyright_agreement_save` int(2) NOT NULL,
  `author_constant_delivery_planed_type` int(2) NOT NULL,
  `author_constant_delivery_planed_date` varchar(20) CHARACTER SET latin5 NOT NULL,
  `author_constant_delivery_accept_type` int(2) NOT NULL,
  `author_constant_delivery_accept_date` varchar(20) CHARACTER SET latin5 NOT NULL,
  `author_constant_accepted` int(2) NOT NULL,
  `author_constant_accepted_date` varchar(20) CHARACTER SET latin5 NOT NULL,
  `pre_layout_designer_id` int(15) NOT NULL,
  `pre_layout_status` int(2) NOT NULL,
  `pre_layout_delivery_date` varchar(20) CHARACTER SET latin5 NOT NULL,
  `pre_layout_acceptance_date` varchar(20) CHARACTER SET latin5 NOT NULL,
  `pre_layout_accepted_date` varchar(20) CHARACTER SET latin5 NOT NULL,
  `pre_correction_redactor_id` int(15) NOT NULL,
  `pre_correction_status` int(2) NOT NULL,
  `pre_correction_delivery_date` varchar(20) CHARACTER SET latin5 NOT NULL,
  `pre_correction_acceptance_date` varchar(20) CHARACTER SET latin5 NOT NULL,
  `pre_correction_accepted_date` varchar(20) CHARACTER SET latin5 NOT NULL,
  `pre_cover_redactor_id` int(15) NOT NULL,
  `pre_cover_status` int(2) NOT NULL,
  `pre_cover_delivery_date` varchar(20) CHARACTER SET latin5 NOT NULL,
  `pre_cover_acceptance_date` varchar(20) CHARACTER SET latin5 NOT NULL,
  `pre_cover_accepted_date` varchar(20) CHARACTER SET latin5 NOT NULL,
  `lc_dimension_accept` int(2) NOT NULL,
  `lc_margins_accept` int(2) NOT NULL,
  `lc_paging_style` int(2) NOT NULL,
  `lc_paging_accept` int(2) NOT NULL,
  `lc_paragraph_indent` int(2) NOT NULL,
  `lc_paragraph_indent_accept` int(2) NOT NULL,
  `lc_text_style` int(2) NOT NULL,
  `lc_text_style_accept` int(2) NOT NULL,
  `lc_text_font_select` int(1) NOT NULL DEFAULT '0',
  `lc_text_font_standart` int(2) NOT NULL,
  `lc_text_font_alternative` varchar(250) CHARACTER SET latin5 NOT NULL,
  `lc_text_font_accepted` int(2) NOT NULL,
  `lc_text_size_select` int(1) NOT NULL DEFAULT '0',
  `lc_text_size_standart` int(2) NOT NULL,
  `lc_text_size_alternative` varchar(24) CHARACTER SET latin5 NOT NULL,
  `lc_text_size_accepted` int(2) NOT NULL,
  `lc_text_height_select` int(2) NOT NULL,
  `lc_text_height_standart` int(2) NOT NULL,
  `lc_text_height_alternative` varchar(24) CHARACTER SET latin5 NOT NULL,
  `lc_text_height_accepted` int(2) NOT NULL,
  `lc_page_title_standart` int(2) NOT NULL,
  `lc_page_title_accepted` int(2) NOT NULL,
  `lc_contents_standart` int(2) NOT NULL,
  `lc_contents_accepted` int(2) NOT NULL,
  `credits_outside_press_city` int(2) NOT NULL,
  `credits_outside_press_year` int(2) NOT NULL,
  `credits_publisher_name` int(2) NOT NULL,
  `credits_publishing_id` int(2) NOT NULL,
  `credits_serias_name` int(2) NOT NULL,
  `credits_serias_id` int(2) NOT NULL,
  `credits_author_www` int(2) NOT NULL,
  `credits_copyright` int(2) NOT NULL,
  `credits_layout` int(2) NOT NULL,
  `credits_cover` int(2) NOT NULL,
  `credits_press_and_tome` int(2) NOT NULL,
  `credits_firstpress_id_and_time` int(2) NOT NULL,
  `credits_lastpress_id_and_time` int(2) NOT NULL,
  `credits_isbn_id` int(2) NOT NULL,
  `credits_editor` int(2) NOT NULL,
  `credits_translator` int(2) NOT NULL,
  `credits_prepaers` int(2) NOT NULL,
  `credits_pulbilsher_adress` int(2) NOT NULL,
  `credits_pulbilsher_tel` int(2) NOT NULL,
  `credits_pulbilsher_fax` int(2) NOT NULL,
  `credits_pulbilsher_www` int(2) NOT NULL,
  `credits_pulbilsher_email` int(2) NOT NULL,
  `credits_order_info` int(2) NOT NULL,
  `credits_online_order` int(2) NOT NULL,
  `credits_inside_book_name` int(2) NOT NULL,
  `credits_inside_author` int(2) NOT NULL,
  `credits_inside_publisher_logo` int(2) NOT NULL,
  `credits_inside_publisher_name` int(2) NOT NULL,
  `credits_others_info` int(2) NOT NULL,
  `cr_correction_accept` int(2) NOT NULL,
  `cr_correction_add` int(2) NOT NULL,
  `cr_correction_check` int(2) NOT NULL,
  `cover_pre_serias` int(2) NOT NULL,
  `cover_pre_serias_check` int(2) NOT NULL,
  `cover_pre_color` int(2) NOT NULL,
  `cover_pre_dimensions` int(2) NOT NULL,
  `cover_pre_boss_reported` int(2) NOT NULL,
  `cover_pre_boss_accepted` int(2) NOT NULL,
  `cover_pre_author_reported` int(2) NOT NULL,
  `cover_pre_author_accepted` int(2) NOT NULL,
  `cover_pre_tested` int(2) NOT NULL,
  `cover_pre_testers` varchar(250) CHARACTER SET latin5 NOT NULL,
  `cover_front_book_name` int(2) NOT NULL,
  `cover_front_author_name` int(2) NOT NULL,
  `cover_front_cover_photo` int(2) NOT NULL,
  `cover_front_cover_photo_accept` int(2) NOT NULL,
  `cover_front_logo_dimension` int(2) NOT NULL,
  `cover_front_logo_location` int(2) NOT NULL,
  `cover_front_logo_color` int(2) NOT NULL,
  `cover_front_serias_name` int(2) NOT NULL,
  `cover_front_press_number` int(2) NOT NULL,
  `cover_front_other_notes` int(2) NOT NULL,
  `cover_spine_text_direction` int(2) NOT NULL,
  `cover_spine_book_name` int(2) NOT NULL,
  `cover_spine_author_name` int(2) NOT NULL,
  `cover_spine_spine_width` int(2) NOT NULL,
  `cover_spine_spine_color` int(2) NOT NULL,
  `cover_spine_spine_number` int(2) NOT NULL,
  `cover_spine_logo_dimension` int(2) NOT NULL,
  `cover_spine_logo_location` int(2) NOT NULL,
  `cover_spine_logo_color` int(2) NOT NULL,
  `cover_back_book_name` int(2) NOT NULL,
  `cover_back_author_name` int(2) NOT NULL,
  `cover_back_cover_photo` int(2) NOT NULL,
  `cover_back_cover_photo_accept` int(2) NOT NULL,
  `cover_back_logo_dimension` int(2) NOT NULL,
  `cover_back_logo_location` int(2) NOT NULL,
  `cover_back_logo_color` int(2) NOT NULL,
  `cover_back_publisher_infos` int(2) NOT NULL,
  `cover_back_publisher_adress` int(2) NOT NULL,
  `cover_back_publisher_tel` int(2) NOT NULL,
  `cover_back_publisher_fax` int(2) NOT NULL,
  `cover_back_publisher_site` int(2) NOT NULL,
  `cover_back_publisher_email` int(2) NOT NULL,
  `cover_back_publisher_order_info` int(2) NOT NULL,
  `cover_back_publisher_online_order` int(2) NOT NULL,
  `cover_back_text` int(2) NOT NULL,
  `cover_back_text_acccepted` int(2) NOT NULL,
  `cover_back_text_corrected` int(2) NOT NULL,
  `cover_back_isbn_number` int(2) NOT NULL,
  `cover_back_isbn_code` int(2) NOT NULL,
  `cover_back_isbn_code_tested` int(2) NOT NULL,
  `cover_back_streamer_area` int(2) NOT NULL,
  `bracket_direction` int(2) NOT NULL,
  `bracket_concept` int(2) NOT NULL,
  `bracket_image` int(2) NOT NULL,
  `bracket_text` int(2) NOT NULL,
  `bracket_dimension` int(2) NOT NULL,
  `bracket_book_name` int(2) NOT NULL,
  `bracket_author_name` int(2) NOT NULL,
  `bracket_logo` int(2) NOT NULL,
  `bracket_publisher_name` int(2) NOT NULL,
  `bracket_order_info` int(2) NOT NULL,
  `bracket_online_order` int(2) NOT NULL,
  `cover_concept_cmyk` int(2) NOT NULL,
  `cover_concept_cross` int(2) NOT NULL,
  `cover_concept_collar` int(2) NOT NULL,
  `cover_concept_convert` int(2) NOT NULL,
  `cover_film_cmyk` int(2) NOT NULL,
  `cover_film_cross` int(2) NOT NULL,
  `cover_film_collar` int(2) NOT NULL,
  `cover_film_convert` int(2) NOT NULL,
  `print_pre_cover_film` int(2) NOT NULL,
  `print_pre_book_film` int(2) NOT NULL,
  `print_pre_cover_type` int(2) NOT NULL,
  `print_pre_jacket` int(2) NOT NULL,
  `print_pre_lac` int(2) NOT NULL,
  `print_pre_gofre` int(2) NOT NULL,
  `print_cover_type` int(2) NOT NULL,
  `print_print_count` varchar(250) CHARACTER SET latin5 NOT NULL,
  `print_book_paper` varchar(250) CHARACTER SET latin5 NOT NULL,
  `print_cover_paper` varchar(250) CHARACTER SET latin5 NOT NULL,
  `print_paper_source` int(2) NOT NULL,
  `print_delivery_date` varchar(20) CHARACTER SET latin5 NOT NULL,
  `print_accept_date` varchar(20) CHARACTER SET latin5 NOT NULL,
  `archive_copyright_agreement` int(2) NOT NULL,
  `archive_translate_agreement` int(2) NOT NULL,
  `archive_cover_film` int(2) NOT NULL,
  `archive_book_film` int(2) NOT NULL,
  `archive_layout_cd` int(2) NOT NULL,
  `archive_cover_cd` int(2) NOT NULL,
  `archive_layout_file` int(2) NOT NULL,
  `archive_layout_pdf` int(2) NOT NULL,
  `archive_cover_file` int(2) NOT NULL,
  `archive_backup_layout_file` int(2) NOT NULL,
  `archive_backup_layout_pdf` int(2) NOT NULL,
  `archive_backup_cover_file` int(2) NOT NULL,
  `createtar` int(15) NOT NULL,
  `changetar` int(15) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `pco_book` (`book_id`, `book_type`, `book_status`, `book_name`, `book_author`, `book_editor`, `book_translator`, `book_pagecount`, `book_isbn`, `book_publisher`, `book_pubnumber`, `book_serias`, `book_serias_id`, `book_publish_planed_date`, `book_published_date`, `book_isbn_status`, `book_bandrol_status`, `author_copyright_agreement`, `author_copyright_agreement_date`, `author_copyright_agreement_duration`, `author_copyright_agreement_save`, `author_constant_delivery_planed_type`, `author_constant_delivery_planed_date`, `author_constant_delivery_accept_type`, `author_constant_delivery_accept_date`, `author_constant_accepted`, `author_constant_accepted_date`, `pre_layout_designer_id`, `pre_layout_status`, `pre_layout_delivery_date`, `pre_layout_acceptance_date`, `pre_layout_accepted_date`, `pre_correction_redactor_id`, `pre_correction_status`, `pre_correction_delivery_date`, `pre_correction_acceptance_date`, `pre_correction_accepted_date`, `pre_cover_redactor_id`, `pre_cover_status`, `pre_cover_delivery_date`, `pre_cover_acceptance_date`, `pre_cover_accepted_date`, `lc_dimension_accept`, `lc_margins_accept`, `lc_paging_style`, `lc_paging_accept`, `lc_paragraph_indent`, `lc_paragraph_indent_accept`, `lc_text_style`, `lc_text_style_accept`, `lc_text_font_select`, `lc_text_font_standart`, `lc_text_font_alternative`, `lc_text_font_accepted`, `lc_text_size_select`, `lc_text_size_standart`, `lc_text_size_alternative`, `lc_text_size_accepted`, `lc_text_height_select`, `lc_text_height_standart`, `lc_text_height_alternative`, `lc_text_height_accepted`, `lc_page_title_standart`, `lc_page_title_accepted`, `lc_contents_standart`, `lc_contents_accepted`, `credits_outside_press_city`, `credits_outside_press_year`, `credits_publisher_name`, `credits_publishing_id`, `credits_serias_name`, `credits_serias_id`, `credits_author_www`, `credits_copyright`, `credits_layout`, `credits_cover`, `credits_press_and_tome`, `credits_firstpress_id_and_time`, `credits_lastpress_id_and_time`, `credits_isbn_id`, `credits_editor`, `credits_translator`, `credits_prepaers`, `credits_pulbilsher_adress`, `credits_pulbilsher_tel`, `credits_pulbilsher_fax`, `credits_pulbilsher_www`, `credits_pulbilsher_email`, `credits_order_info`, `credits_online_order`, `credits_inside_book_name`, `credits_inside_author`, `credits_inside_publisher_logo`, `credits_inside_publisher_name`, `credits_others_info`, `cr_correction_accept`, `cr_correction_add`, `cr_correction_check`, `cover_pre_serias`, `cover_pre_serias_check`, `cover_pre_color`, `cover_pre_dimensions`, `cover_pre_boss_reported`, `cover_pre_boss_accepted`, `cover_pre_author_reported`, `cover_pre_author_accepted`, `cover_pre_tested`, `cover_pre_testers`, `cover_front_book_name`, `cover_front_author_name`, `cover_front_cover_photo`, `cover_front_cover_photo_accept`, `cover_front_logo_dimension`, `cover_front_logo_location`, `cover_front_logo_color`, `cover_front_serias_name`, `cover_front_press_number`, `cover_front_other_notes`, `cover_spine_text_direction`, `cover_spine_book_name`, `cover_spine_author_name`, `cover_spine_spine_width`, `cover_spine_spine_color`, `cover_spine_spine_number`, `cover_spine_logo_dimension`, `cover_spine_logo_location`, `cover_spine_logo_color`, `cover_back_book_name`, `cover_back_author_name`, `cover_back_cover_photo`, `cover_back_cover_photo_accept`, `cover_back_logo_dimension`, `cover_back_logo_location`, `cover_back_logo_color`, `cover_back_publisher_infos`, `cover_back_publisher_adress`, `cover_back_publisher_tel`, `cover_back_publisher_fax`, `cover_back_publisher_site`, `cover_back_publisher_email`, `cover_back_publisher_order_info`, `cover_back_publisher_online_order`, `cover_back_text`, `cover_back_text_acccepted`, `cover_back_text_corrected`, `cover_back_isbn_number`, `cover_back_isbn_code`, `cover_back_isbn_code_tested`, `cover_back_streamer_area`, `bracket_direction`, `bracket_concept`, `bracket_image`, `bracket_text`, `bracket_dimension`, `bracket_book_name`, `bracket_author_name`, `bracket_logo`, `bracket_publisher_name`, `bracket_order_info`, `bracket_online_order`, `cover_concept_cmyk`, `cover_concept_cross`, `cover_concept_collar`, `cover_concept_convert`, `cover_film_cmyk`, `cover_film_cross`, `cover_film_collar`, `cover_film_convert`, `print_pre_cover_film`, `print_pre_book_film`, `print_pre_cover_type`, `print_pre_jacket`, `print_pre_lac`, `print_pre_gofre`, `print_cover_type`, `print_print_count`, `print_book_paper`, `print_cover_paper`, `print_paper_source`, `print_delivery_date`, `print_accept_date`, `archive_copyright_agreement`, `archive_translate_agreement`, `archive_cover_film`, `archive_book_film`, `archive_layout_cd`, `archive_cover_cd`, `archive_layout_file`, `archive_layout_pdf`, `archive_cover_file`, `archive_backup_layout_file`, `archive_backup_layout_pdf`, `archive_backup_cover_file`, `createtar`, `changetar`) VALUES
(1, 1, 6, 'YENİ BİR KİTAP', 'YENİ BİR YAZAR', 'YENİ BİR EDİTÖR', '', '', '', 1, '', 7, '', '', '', 0, 0, 0, '', 7, 0, 1, '1263081661', 1, '1263081661', 1, '1263081661', 19, 0, '', '', '', 18, 3, '1266192061', '1266796861', '', 4, 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1266420116);

DROP TABLE IF EXISTS `pco_content`;
CREATE TABLE IF NOT EXISTS `pco_content` (
`content_id` int(10) NOT NULL,
  `content_type` int(11) NOT NULL,
  `content_title` varchar(300) NOT NULL,
  `content_author` varchar(300) NOT NULL,
  `content_image` varchar(300) NOT NULL,
  `content_short` text NOT NULL,
  `content_desc` text NOT NULL,
  `content_link` varchar(500) NOT NULL,
  `content_cat` int(11) NOT NULL,
  `content_publisher` varchar(300) NOT NULL,
  `content_status` int(11) NOT NULL,
  `content_fix` int(11) NOT NULL,
  `content_read` int(9) NOT NULL,
  `createtar` int(11) NOT NULL,
  `changetar` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin5 AUTO_INCREMENT=2 ;

INSERT INTO `pco_content` (`content_id`, `content_type`, `content_title`, `content_author`, `content_image`, `content_short`, `content_desc`, `content_link`, `content_cat`, `content_publisher`, `content_status`, `content_fix`, `content_read`, `createtar`, `changetar`) VALUES
(1, 0, 'YENİ İÇERİK', 'YENİ YAZAR', 'image.jpg', 'content short', 'content desc', '', 3, 'publisher', 1, 0, 0, 0, 0);

DROP TABLE IF EXISTS `pco_stok`;
CREATE TABLE IF NOT EXISTS `pco_stok` (
`stokno` int(11) NOT NULL,
  `urunadi` varchar(100) NOT NULL DEFAULT '',
  `yazaradi` varchar(100) DEFAULT NULL,
  `sayfasayisi` varchar(11) NOT NULL,
  `editoradi` varchar(100) NOT NULL,
  `satisfiyati` double DEFAULT NULL,
  `satiskdv` int(2) NOT NULL DEFAULT '8',
  `satisdurumu` varchar(11) NOT NULL,
  `sirtno` varchar(11) NOT NULL DEFAULT '',
  `yayinevino` varchar(11) NOT NULL,
  `barkod` varchar(20) NOT NULL DEFAULT '',
  `hatalibarkod` varchar(20) NOT NULL DEFAULT '',
  `serino` int(11) NOT NULL DEFAULT '0',
  `seriicno` varchar(11) NOT NULL,
  `kategori1` varchar(11) NOT NULL,
  `kategori2` varchar(11) NOT NULL,
  `kategori3` varchar(11) NOT NULL,
  `tanitimmetni` longtext,
  `icindekiler` longtext,
  `tadimlik` longtext,
  `sonbaskino` varchar(11) NOT NULL,
  `sonbaskitarihi` varchar(11) NOT NULL,
  `ilkbaskitarihi` varchar(11) NOT NULL,
  `kidaplink` int(11) NOT NULL,
  `yayindili` int(11) NOT NULL,
  `createtar` int(25) NOT NULL,
  `changetar` int(25) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin5 AUTO_INCREMENT=2 ;

INSERT INTO `pco_stok` (`stokno`, `urunadi`, `yazaradi`, `sayfasayisi`, `editoradi`, `satisfiyati`, `satiskdv`, `satisdurumu`, `sirtno`, `yayinevino`, `barkod`, `hatalibarkod`, `serino`, `seriicno`, `kategori1`, `kategori2`, `kategori3`, `tanitimmetni`, `icindekiler`, `tadimlik`, `sonbaskino`, `sonbaskitarihi`, `ilkbaskitarihi`, `kidaplink`, `yayindili`, `createtar`, `changetar`) VALUES
(1, 'YENİ ÜRÜN', 'YENİ YAZAR', '123', '', 1, 8, '0', '', '1', '123456789', '', 1, '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0);

DROP TABLE IF EXISTS `pco_users`;
CREATE TABLE IF NOT EXISTS `pco_users` (
`id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `email` varchar(55) NOT NULL,
  `pass` varchar(55) NOT NULL,
  `username` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `tel` varchar(55) NOT NULL,
  `auth_mizanpaj` int(1) NOT NULL DEFAULT '0',
  `auth_kapak` int(1) NOT NULL DEFAULT '0',
  `auth_tashih` int(1) NOT NULL DEFAULT '0',
  `auth_kagit` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=latin5 AUTO_INCREMENT=23 ;

INSERT INTO `pco_users` (`id`, `status`, `email`, `pass`, `username`, `name`, `tel`, `auth_mizanpaj`, `auth_kapak`, `auth_tashih`, `auth_kagit`) VALUES
(1, 10, 'admin@dusyayincilik.com', 'admin', 'admin@dusyayincilik.com', 'admin@dusyayincilik.com', '', 0, 0, 0, 0);

DROP TABLE IF EXISTS `pco_vitrinler`;
CREATE TABLE IF NOT EXISTS `pco_vitrinler` (
`vitrinno` int(11) NOT NULL,
  `stokkod` varchar(11) NOT NULL DEFAULT '',
  `vitrintipi` char(2) NOT NULL DEFAULT '',
  `vitrintar` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin5 AUTO_INCREMENT=1 ;


ALTER TABLE `pco_book`
 ADD UNIQUE KEY `book_ıd` (`book_id`);

ALTER TABLE `pco_content`
 ADD UNIQUE KEY `content_id` (`content_id`);

ALTER TABLE `pco_stok`
 ADD UNIQUE KEY `stokno` (`stokno`);

ALTER TABLE `pco_users`
 ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `pco_vitrinler`
 ADD KEY `vitrinno` (`vitrinno`);


ALTER TABLE `pco_book`
MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `pco_content`
MODIFY `content_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `pco_stok`
MODIFY `stokno` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `pco_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `pco_vitrinler`
MODIFY `vitrinno` int(11) NOT NULL AUTO_INCREMENT;