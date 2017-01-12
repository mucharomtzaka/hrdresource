#
# TABLE STRUCTURE FOR: dynamic_menu
#

DROP TABLE IF EXISTS `dynamic_menu`;

CREATE TABLE `dynamic_menu` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `menu_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `level` tinyint(1) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('1', '0', 'Master Pengguna', '', '0', '1', '0', 'fa fa-user-plus', NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('2', '1', 'Pengguna', 'user/index', '0', '1', '1', 'fa fa-user', 'Daftar Pengguna');
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('3', '1', 'Group Pengguna', 'user/create_group', '0', '1', NULL, 'fa fa-users', 'User Groups');
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('4', '0', 'Master Data Tabel', '', '0', '1', NULL, 'fa fa-database', NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('8', '4', 'Absensi', 'absensi', '0', '1', NULL, 'fa fa-check', NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('9', '4', 'Gaji', 'payroll', '0', '1', NULL, 'fa fa-payment', NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('10', '4', 'Pegawai', '', '0', '1', NULL, 'fa fa-users', NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('18', '0', 'Laporan & Utilitas', '', '0', '1', NULL, 'fa fa-book', 'Report');
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('19', '0', 'Plugin', '#', '0', '1', '0', 'fa fa-external-link', '');
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('20', '4', 'Pelamar', '', '0', '1', '0', 'fa fa-user', '');
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('21', '10', 'Data Pribadi', 'pegawai/data_pribadi_peg', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('22', '10', 'Data Pendidikan', 'pegawai/data_pendidikan_peg', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('23', '10', 'Data Pengalaman', 'pegawai/data_pengalaman_peg', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('24', '10', 'Data Keahlian', 'pegawai/data_keahlian_peg', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('25', '10', 'Data Keluarga', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('26', '10', 'Data Pelatihan', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('27', '10', 'Data Seminar', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('28', '10', 'Data Kesehatan', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('29', '10', 'Data Proyek_peg', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('30', '10', 'Data Peringatan', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('31', '10', 'Data Penghargaan', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('32', '10', 'Data Surat Keputusan', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('33', '10', 'Appraisal', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('34', '10', 'Data Pegawai Keluar', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('35', '20', 'Data Pribadi_pelamar', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('36', '20', 'Data Pendidikan_pelamar', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('37', '20', 'Data Keahlian_pelamar', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('38', '20', 'Data Hasil Test', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('39', '20', 'Data Offering Letter', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('40', '9', 'Komponen Gaji <br> Pegawai', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('41', '9', 'Jamsostek', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('42', '9', 'Askes', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('43', '9', 'Pinjaman', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('44', '9', 'Pph pasal 21', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('45', '4', 'Non Gaji', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('46', '45', 'Medical Reimburs', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('47', '45', 'Perjalanan Dinas', '', '0', '1', '0', '', '');
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('48', '45', 'SPK Pegawai', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('49', '8', 'Setting Kalender', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('50', '8', 'Absen Barcode <br> Scanning', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('51', '8', ' Data Absensi', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('52', '8', 'Data Lembur', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('53', '8', 'Data Cuti', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('54', '8', 'Shift', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('55', '18', 'Laporan Pelamar', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('56', '18', 'Laporan Pegawai', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('57', '18', 'Laporan Gaji, PPh,<br> Jamsostek, dan Askes', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('58', '18', ' Laporan Medical <br>Reimburs', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('59', '18', 'Laporan Perjalanan <br> Dinas', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('64', '0', 'Master Referense', '', '0', '1', NULL, 'fa fa-list', NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('65', '64', 'Pendidikan', 'studies', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('66', '64', 'Jabatan', 'Jabatan', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('68', '0', 'Master Berita', '', '0', '1', NULL, 'fa fa-comments', NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('69', '68', 'Blog', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('70', '68', 'Artikel', '', '0', '1', NULL, NULL, NULL);
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('71', '68', 'Pengumuman', 'plugin/news', '0', '1', '1', 'fa  fa-news', 'news');
INSERT INTO `dynamic_menu` (`id`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES ('75', '19', 'test', 'test', '0', '1', NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: groups
#

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `groups` (`id`, `name`, `description`) VALUES ('1', 'admin', 'Administrator');
INSERT INTO `groups` (`id`, `name`, `description`) VALUES ('2', 'members', 'General User');
INSERT INTO `groups` (`id`, `name`, `description`) VALUES ('3', 'IT-Support', 'IT-Support');


#
# TABLE STRUCTURE FOR: jabatan
#

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_jabatan` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `jabatan` (`id`, `name_jabatan`) VALUES ('1', 'Pegawai');
INSERT INTO `jabatan` (`id`, `name_jabatan`) VALUES ('2', 'Manajer');
INSERT INTO `jabatan` (`id`, `name_jabatan`) VALUES ('3', 'Asisten');
INSERT INTO `jabatan` (`id`, `name_jabatan`) VALUES ('4', 'Sekretaris');
INSERT INTO `jabatan` (`id`, `name_jabatan`) VALUES ('5', 'Direktur Perusahaan');
INSERT INTO `jabatan` (`id`, `name_jabatan`) VALUES ('6', 'Trainner');
INSERT INTO `jabatan` (`id`, `name_jabatan`) VALUES ('7', 'IT-support');
INSERT INTO `jabatan` (`id`, `name_jabatan`) VALUES ('8', 'Partner');


#
# TABLE STRUCTURE FOR: login_attempts
#

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(16) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: migrations
#

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `migrations` (`version`) VALUES ('20170107134255');


#
# TABLE STRUCTURE FOR: news
#

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: pegawai
#

DROP TABLE IF EXISTS `pegawai`;

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NIK` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tempat` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat_ktp` varchar(100) NOT NULL,
  `alamat_sekarang` varchar(100) NOT NULL,
  `nomer_kontak_hp` varchar(12) NOT NULL,
  `nomer_kontak_tp` varchar(12) NOT NULL,
  `photos` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `pegawai` (`id`, `NIK`, `nama_lengkap`, `tempat`, `tgl_lahir`, `alamat_ktp`, `alamat_sekarang`, `nomer_kontak_hp`, `nomer_kontak_tp`, `photos`) VALUES ('2', '132220006789', 'YUhuhu', 'Sukorejo', '2016-12-09', '   hujj                                                                                             ', '                                                 op                                                 ', '1233333', '', 'IMG_0153.JPG');
INSERT INTO `pegawai` (`id`, `NIK`, `nama_lengkap`, `tempat`, `tgl_lahir`, `alamat_ktp`, `alamat_sekarang`, `nomer_kontak_hp`, `nomer_kontak_tp`, `photos`) VALUES ('3', '1233467890', 'ssssss', 'ddfff', '2016-12-03', '         hj                                                                                         ', '            h                                                                                       ', '678999000', '', 'my fhoto.jpg');


#
# TABLE STRUCTURE FOR: pelatihan
#

DROP TABLE IF EXISTS `pelatihan`;

CREATE TABLE `pelatihan` (
  `id_pelatihan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(11) NOT NULL,
  `id_master_pelatihan` int(11) NOT NULL,
  `uraian` text NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `tanggal_sertifikat` varchar(50) NOT NULL,
  `jam_pelatihan` varchar(50) NOT NULL,
  `negara` varchar(100) NOT NULL,
  PRIMARY KEY (`id_pelatihan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: pendidikan
#

DROP TABLE IF EXISTS `pendidikan`;

CREATE TABLE `pendidikan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_pendidikan` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `pendidikan` (`id`, `name_pendidikan`) VALUES ('1', 'TK');
INSERT INTO `pendidikan` (`id`, `name_pendidikan`) VALUES ('2', 'SD/MI');
INSERT INTO `pendidikan` (`id`, `name_pendidikan`) VALUES ('3', 'MA/SMA/SMK');
INSERT INTO `pendidikan` (`id`, `name_pendidikan`) VALUES ('4', 'Sarjana');
INSERT INTO `pendidikan` (`id`, `name_pendidikan`) VALUES ('5', 'Master');
INSERT INTO `pendidikan` (`id`, `name_pendidikan`) VALUES ('8', 'Insiyur');


#
# TABLE STRUCTURE FOR: plugin_module
#

DROP TABLE IF EXISTS `plugin_module`;

CREATE TABLE `plugin_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_modules` varchar(100) NOT NULL,
  `status_modules` int(1) NOT NULL,
  `plug_id_dynamic_menu` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `plugin_module` (`id`, `name_modules`, `status_modules`, `plug_id_dynamic_menu`) VALUES ('4', 'test', '0', '19');


#
# TABLE STRUCTURE FOR: role_premission
#

DROP TABLE IF EXISTS `role_premission`;

CREATE TABLE `role_premission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groups_id` int(11) NOT NULL,
  `plugin_id` int(11) NOT NULL,
  `view` int(11) NOT NULL,
  `edit` int(11) NOT NULL,
  `remove` int(11) NOT NULL,
  `download` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: settings
#

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `header_title` varchar(80) DEFAULT NULL,
  `footer_title` varchar(100) DEFAULT NULL,
  `meta_title` varchar(200) DEFAULT NULL,
  `themes` varchar(95) DEFAULT NULL,
  `image_favicon` varchar(95) DEFAULT NULL,
  `backgrounds` varchar(100) DEFAULT NULL,
  `name_company` varchar(100) DEFAULT NULL,
  `address_company` varchar(100) DEFAULT NULL,
  `contact_company` varchar(100) DEFAULT NULL,
  `name_company_profil_des` text,
  `site_offline` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `settings` (`id`, `header_title`, `footer_title`, `meta_title`, `themes`, `image_favicon`, `backgrounds`, `name_company`, `address_company`, `contact_company`, `name_company_profil_des`, `site_offline`) VALUES ('1', '', 'HRD', 'hed', 'skin-black', 'myfhoto.jpg', NULL, '', '', '', '', '0');


#
# TABLE STRUCTURE FOR: settings_email
#

DROP TABLE IF EXISTS `settings_email`;

CREATE TABLE `settings_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol` varchar(80) NOT NULL,
  `smtp_host` varchar(80) NOT NULL,
  `smtp_user` varchar(100) NOT NULL,
  `smtp_pass` varchar(100) NOT NULL,
  `smtp_port` varchar(12) NOT NULL,
  `newline_smtp` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `settings_email` (`id`, `protocol`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `newline_smtp`) VALUES ('2', 'smtp', 'ssl://smtp.gmail.com', 'mucharomtzaka@gmail.com', 'kotajogja', '465', '\"\\r\\n\"');


#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('1', '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, '1268889823', '1483409489', '1', 'Admin', 'istrator', 'ADMIN', '0');
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('2', '::1', 'mucharomtzaka@gmail.com', '$2y$08$DJF1fhCX4vUczMh6lBGRreKafCvXuyfJqpp4YRgQxsw.Liq8fSOlC', '2e6OHS8MmqO/.6Der1FTce', 'mucharomtzaka@gmail.com', NULL, NULL, NULL, NULL, '1481714192', '1483939319', '1', 'Mucharom', 'tzaka', 'd', '12345678');
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('3', '::1', 'ch@yahoo.co.id', '$2y$08$A2GlDaax7NjhHjWjYUIRze8AR9PUVQ2U6ZJByCdFJvy1KJs32OenC', 'rBEDCPxD8cRiVKWpXsCGlO', 'ch@yahoo.co.id', NULL, 'GI2FDA6xgHXtXLieCpDSjue6531d249bbf4de285', '1483068231', NULL, '1483064427', '1483787026', '1', 'wed', 'gh', 'ch', '11111');
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('6', '::1', 'mucharomtzaka@yahoo.co.id', '$2y$08$VU8HfHBPVgJk6.YUuTciv.AmLn9TEVJuEZdvSex4qs9wZD.rLepvC', 'UbYOlRIPO0J2jTnmD6.jBe', 'mucharomtzaka@yahoo.co.id', '0b701ba2f04bf001b3bceec69e1d290be81eb0bd', NULL, NULL, NULL, '1483806656', NULL, '0', 'm', 'm', 'm', '456678888889099');


#
# TABLE STRUCTURE FOR: users_groups
#

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('5', '1', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('6', '1', '3');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('17', '2', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('18', '2', '3');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('19', '3', '2');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('20', '4', '2');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('21', '5', '2');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('22', '6', '2');


