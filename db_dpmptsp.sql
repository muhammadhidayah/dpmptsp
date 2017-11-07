-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: dpmpptsp
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_detail_izin`
--

DROP TABLE IF EXISTS `tbl_detail_izin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_detail_izin` (
  `id_izin` int(11) NOT NULL,
  `id_syarat` int(11) NOT NULL,
  PRIMARY KEY (`id_izin`,`id_syarat`),
  KEY `tbl_detail_izin_ibfk_2` (`id_syarat`),
  CONSTRAINT `tbl_detail_izin_ibfk_1` FOREIGN KEY (`id_izin`) REFERENCES `tbl_izin` (`id_izin`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_detail_izin_ibfk_2` FOREIGN KEY (`id_syarat`) REFERENCES `tbl_master_syarat` (`id_syarat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_detail_izin`
--

LOCK TABLES `tbl_detail_izin` WRITE;
/*!40000 ALTER TABLE `tbl_detail_izin` DISABLE KEYS */;
INSERT INTO `tbl_detail_izin` VALUES (8,1),(8,2),(8,3);
/*!40000 ALTER TABLE `tbl_detail_izin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_detail_perizinan`
--

DROP TABLE IF EXISTS `tbl_detail_perizinan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_detail_perizinan` (
  `id_perizinan` char(14) NOT NULL,
  `id_syarat` int(11) NOT NULL,
  `kelengkapan_syarat` enum('Lengkap','Tidak Lengkap') DEFAULT NULL,
  PRIMARY KEY (`id_perizinan`,`id_syarat`),
  KEY `tbl_detail_perizinan_ibfk_2` (`id_syarat`),
  CONSTRAINT `tbl_detail_perizinan_ibfk_1` FOREIGN KEY (`id_perizinan`) REFERENCES `tbl_perizinan` (`id_perizinan`) ON DELETE CASCADE,
  CONSTRAINT `tbl_detail_perizinan_ibfk_2` FOREIGN KEY (`id_syarat`) REFERENCES `tbl_master_syarat` (`id_syarat`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_detail_perizinan`
--

LOCK TABLES `tbl_detail_perizinan` WRITE;
/*!40000 ALTER TABLE `tbl_detail_perizinan` DISABLE KEYS */;
INSERT INTO `tbl_detail_perizinan` VALUES ('20170201-00001',1,'Lengkap'),('20170201-00001',2,'Lengkap'),('20170201-00001',3,'Lengkap'),('20170912-00001',1,'Lengkap'),('20170912-00001',2,'Lengkap'),('20170912-00001',3,'Lengkap'),('20171011-00001',1,'Lengkap'),('20171011-00001',2,'Lengkap'),('20171011-00001',3,'Lengkap'),('20171117-00001',1,'Lengkap'),('20171117-00001',2,'Lengkap'),('20171117-00001',3,'Lengkap');
/*!40000 ALTER TABLE `tbl_detail_perizinan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_galeri`
--

DROP TABLE IF EXISTS `tbl_galeri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_galeri` (
  `id_galeri` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori_galleri` int(11) NOT NULL,
  `judul_galeri` varchar(255) NOT NULL,
  `keterangan_galeri` text,
  `tgl_post_galeri` date DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_galeri`),
  KEY `tbl_galeri_ibfk_1` (`id_kategori_galleri`),
  CONSTRAINT `tbl_galeri_ibfk_1` FOREIGN KEY (`id_kategori_galleri`) REFERENCES `tbl_kategori_galleri` (`id_kategori_galleri`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_galeri`
--

LOCK TABLES `tbl_galeri` WRITE;
/*!40000 ALTER TABLE `tbl_galeri` DISABLE KEYS */;
INSERT INTO `tbl_galeri` VALUES (6,6,'The Paper Stuff',NULL,'2017-10-19','31.jpg'),(7,6,'tess',NULL,'2017-10-27','3b38a-1.jpg');
/*!40000 ALTER TABLE `tbl_galeri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_informasi`
--

DROP TABLE IF EXISTS `tbl_informasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_informasi` (
  `id_informasi` int(11) NOT NULL AUTO_INCREMENT,
  `judul_informasi` varchar(255) NOT NULL,
  `deskripsi_informasi` text NOT NULL,
  `slug_informasi` varchar(255) NOT NULL,
  `isi_informasi` text NOT NULL,
  `gambar_informasi` varchar(100) DEFAULT NULL,
  `status_informasi` enum('publish','unpublish') DEFAULT NULL,
  `tanggal_post_informasi` date DEFAULT NULL,
  `jenis_informasi` enum('artikel','berita') DEFAULT NULL,
  `nip` char(18) DEFAULT NULL,
  PRIMARY KEY (`id_informasi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_informasi`
--

LOCK TABLES `tbl_informasi` WRITE;
/*!40000 ALTER TABLE `tbl_informasi` DISABLE KEYS */;
INSERT INTO `tbl_informasi` VALUES (2,'Bupati Belitung Raih Penghargaan Bergensi PR INDONESIA Best Communicator 2017','Bupati Belitung Raih Penghargaan Bergensi PR INDONESIA Best Communicator 2017','bupati-belitung-raih-penghargaan-bergensi-pr-indonesia-best-communicator-2017','<p>Yogyakarta - Rasa gembira tampak dari raut wajah Bupati Belitung, H. Sahani Saleh, S.Sos. saat memperoleh penghargaan &ldquo;PR INDONESIA Best Communicators 2017&rdquo;&nbsp; kategori Bupati dari PR INDONESIA, pada puncak acara Jambore Public Relations Indonesia (JAMPIRO) #3 di &nbsp;Hotel Grand Keisha Yogyakarta, Jum&rsquo;at (25/8/2017).</p>\r\n<p>&nbsp;</p>\r\n<p>Penghargaan tersebut diserahkan secara langsung oleh Komisaris Utama PR INDONESIA Achmad Djauhar didampingi oleh&nbsp;<em>Founder&nbsp;</em>dan CEO PR INDONESIA, Asmono Wikan kepada Bupati Belitung dan disaksikan insan Public Relations dari berbagai sektor dan para penerima nominasi dalam berbagai kategori lainnya.</p>\r\n<p>&nbsp;</p>\r\n<p>Ini bukan pertama kalinya PR INDONESIA memberikan penghargaan kepada Kabupaten Belitung. &nbsp;Sebelumnya diawal tahun 2017 &nbsp;penghargaan juga pernah diterima untuk kompetisi&nbsp;<em>Public Relations</em>&nbsp;Indonesia Awards (PRIA) kategori Media Relations dan kategori Kabupaten dengan jumlah ekspos terbanyak di media nasional pada tahun 2016.</p>\r\n<p>&nbsp;</p>\r\n<p>Jika penghargaan &ldquo;PRIA&rdquo; diberikan kepada institusi, maka penghargaan yang diberi nama &ldquo;PR INDONESIA Best Communicators 2017&rdquo; diberikan secara langsung kepada sosok pemimpin yang dinilai berhasil mewujudkan reputasi positif pemerintah daerah di mata&nbsp;<em>stakeholders</em>.</p>\r\n<p>&nbsp;</p>\r\n<p>Untuk mendapatkan sosok pemimpin dimaksud, PR INDONESIA bekerjasama dengan perusahaan media monitoring, Indonesia Indicators mengumpulkan data pemberitaan para pemimpin berdasarkan penelusuran melalui mesin Intelligence Media Management (IMM) berbasis Artificial Intelligence secara&nbsp;<em>real-time</em>&nbsp;selama periode 1 Januari &ndash; 30 Juni 2017.</p>\r\n<p>&nbsp;</p>\r\n<p>Adapun 13 media cetak yang menjadi dasar penilaian &nbsp;adalah Harian Kompas; Rakyat Merdeka; Bisnis Indonesia; Suara Pembaruan; Investor Daily; Indo Pos; Koran Tempo; Jawa Pos; Majalah Tempo; Koran Sindo; Media Indonesia; Republika; dan The Jakarta Post.</p>\r\n<p>&nbsp;</p>\r\n<p>Selain Bupati Belitung, tiga orang menteri kabinet Jokowi-JK turut mendapatkan penghargaan PR INDONESIA Best Coommunicators 2017 kategori Kementerian. Mereka adalah Menteri Keuangan Sri Mulyani Indrawati, Menteri Kelautan dan Perikanan Susi Pudjiastuti, dan Menteri Kesehatan Nila F. Moeloek. (FW/SUP)</p>\r\n<p>&nbsp;</p>\r\n<p>Berikut daftar para pemimpin peraih &ldquo;PR INDONESIA Best Communicators 2017&rdquo;</p>\r\n<p><strong>PEMIMPIN LEMBAGA</strong></p>\r\n<ul>\r\n<li>Agus Martowardojo, Gubernur Bank Indonesia</li>\r\n<li>Agus Susanto, Direktur Utama BPJS Ketenagakerjaan</li>\r\n<li>Fachmi Idris, Direktur Utama BPJS Kesehatan</li>\r\n<li>Gatot Nurmantyo, Panglima TNI</li>\r\n<li>Tito Karnavian, Kepala Kepolisian Republik Indonesia</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>GUBERNUR</strong></p>\r\n<ul>\r\n<li>Ahmad Heryawan, Gubernur Jawa Barat</li>\r\n<li>Alex Noerdin, Gubernur Sumatera Selatan</li>\r\n<li>Syahrul Yasin Limpo, Gubernur Sulawesi Selatan</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>WALIKOTA</strong></p>\r\n<ul>\r\n<li>Arief Rachadiono Wismansyah, Walikota Tangerang</li>\r\n<li>Mahyeldi Ansharullah, Walikota Padang</li>\r\n<li>Ramdhan Pomanto, Walikota Makassar</li>\r\n<li>Ridwan Kamil, Walikota Bandung</li>\r\n<li>Rizal Effendi, Walikota Balikpapan</li>\r\n<li>Tri Rismaharini, Walikota Surabaya</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>BUPATI</strong></p>\r\n<ul>\r\n<li>Abdullah Azwar Anas, Bupati Banyuwangi</li>\r\n<li>Sahani Saleh, Bupati Belitung</li>\r\n<li>Asmin Laura Hafid, Bupati Nunukan</li>\r\n<li>Dedi Mulyadi, Bupati Purwakarta</li>\r\n<li>Hj Badingah, Bupati Gunung Kidul</li>\r\n<li>Nelson Pomalingo, Bupati Gorontalo</li>\r\n<li>Syamsuar, Bupati Siak</li>\r\n<li>Tarmizi Saat, Bupati Bangka</li>\r\n</ul>\r\n<p>Sumber: Bagian Humas dan Protokol Setda Kabupaten Belitung</p>','3b38a-1.jpg','publish','2017-01-26','artikel',''),(3,'Lorem Ipsum','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.','lorem-ipsum','<div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n<p>&nbsp;</p>\r\n<div>\r\n<h2>Where does it come from?</h2>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n</div>\r\n<div>\r\n<h2>Where can I get so</h2>\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n</div>','2.jpg','publish','2017-01-26','berita','196305201986031029'),(4,'Lorem Ipsum','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.','lorem-ipsum','<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</strong></p>\r\n<p><strong>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</strong></p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>','3b38a-11.jpg','unpublish','2017-10-27','berita','196305201986031029');
/*!40000 ALTER TABLE `tbl_informasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_izin`
--

DROP TABLE IF EXISTS `tbl_izin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_izin` (
  `id_izin` int(11) NOT NULL AUTO_INCREMENT,
  `nama_izin` varchar(255) NOT NULL,
  `masa_berlaku_izin` int(11) DEFAULT NULL,
  `keterangan_jenis_izin` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_izin`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_izin`
--

LOCK TABLES `tbl_izin` WRITE;
/*!40000 ALTER TABLE `tbl_izin` DISABLE KEYS */;
INSERT INTO `tbl_izin` VALUES (8,'IZIN PENDIRIAN LEMBAGA PENDIDIKAN FORMAL',NULL,NULL);
/*!40000 ALTER TABLE `tbl_izin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_jabatan`
--

DROP TABLE IF EXISTS `tbl_jabatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_jabatan`
--

LOCK TABLES `tbl_jabatan` WRITE;
/*!40000 ALTER TABLE `tbl_jabatan` DISABLE KEYS */;
INSERT INTO `tbl_jabatan` VALUES (1,'Eselon la Pembina Utama Madya IV/d Pembina Utama IV/e '),(2,'Eselon lb Pembina Utama Muda IV/c Pembina Utama IV/e ');
/*!40000 ALTER TABLE `tbl_jabatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kategori_galleri`
--

DROP TABLE IF EXISTS `tbl_kategori_galleri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kategori_galleri` (
  `id_kategori_galleri` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_galleri` varchar(255) NOT NULL,
  `keterangan_katgalleri` text,
  `slug_katgaleri` varchar(300) NOT NULL,
  `status_katgaleri` enum('publish','unpublish') DEFAULT NULL,
  PRIMARY KEY (`id_kategori_galleri`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kategori_galleri`
--

LOCK TABLES `tbl_kategori_galleri` WRITE;
/*!40000 ALTER TABLE `tbl_kategori_galleri` DISABLE KEYS */;
INSERT INTO `tbl_kategori_galleri` VALUES (6,'The Paper Stuff','Mini - Ghettoblaster / The Paper Stuff','the-paper-stuff','publish');
/*!40000 ALTER TABLE `tbl_kategori_galleri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_konfigurasi`
--

DROP TABLE IF EXISTS `tbl_konfigurasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_konfigurasi` (
  `id_konfigurasi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kantor` varchar(255) DEFAULT NULL,
  `tagline_kantor` varchar(500) DEFAULT NULL,
  `urlweb_kantor` varchar(100) DEFAULT NULL,
  `email_kantor` varchar(255) DEFAULT NULL,
  `telp_kantor` varchar(12) DEFAULT NULL,
  `alamat_kantor` text,
  `keyword_web` varchar(400) DEFAULT NULL,
  `deskripsi_web` varchar(250) DEFAULT NULL,
  `koordinat_kantor` text,
  `metatext_web` text,
  `logo_web` varchar(300) DEFAULT NULL,
  `icon_web` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_konfigurasi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_konfigurasi`
--

LOCK TABLES `tbl_konfigurasi` WRITE;
/*!40000 ALTER TABLE `tbl_konfigurasi` DISABLE KEYS */;
INSERT INTO `tbl_konfigurasi` VALUES (1,'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu','Melayani anda adalah kewajiban kami','http://dpmpptsp.belitungkab.go.id','dpmpptsp@belitungkab.go.id','07194916202','Jl. K. Yos Sudarso, Tj. Pandan, Kabupaten Belitung, Kepulauan Bangka Belitung 33411','','','<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1184.8214629136924!2d107.63285454505922!3d-2.742539414733004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e171667ffecef7f%3A0x853f71989128ee11!2sKantor+DInas+Penanaman+Modal%2C+Pelayanan+Perizinan+Terpadu+Satu+Pintu+dan+Perindustrian!5e0!3m2!1sid!2sid!4v1508998881778\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>','','Lambang_Kabupaten_Belitung.png','Lambang_Kabupaten_Belitung1.png');
/*!40000 ALTER TABLE `tbl_konfigurasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_master_syarat`
--

DROP TABLE IF EXISTS `tbl_master_syarat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_master_syarat` (
  `id_syarat` int(11) NOT NULL AUTO_INCREMENT,
  `nama_syarat` varchar(255) NOT NULL,
  `keterangan_syarat` varchar(500) DEFAULT NULL,
  `tanggal_dibuat_syarat` date DEFAULT NULL,
  PRIMARY KEY (`id_syarat`),
  UNIQUE KEY `nama_syarat` (`nama_syarat`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_master_syarat`
--

LOCK TABLES `tbl_master_syarat` WRITE;
/*!40000 ALTER TABLE `tbl_master_syarat` DISABLE KEYS */;
INSERT INTO `tbl_master_syarat` VALUES (1,'Surat Permohonan','Surat Permohonan','2017-10-22'),(2,'FC Akta Pendirian Perusahaan dan Perubahan','FC Akta Pendirian Perusahaan dan Perubahan','2017-10-22'),(3,'FC Surat Keterangan Mengenai Hak Atas Tanah','Hak Milik, Hak Guna Bangunan, Hak Sewa Atau Hak hak yang diakui oleh hukum pertanahan','2017-10-22');
/*!40000 ALTER TABLE `tbl_master_syarat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pegawai`
--

DROP TABLE IF EXISTS `tbl_pegawai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pegawai` (
  `nip` char(18) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `alamat_pegawai` varchar(255) DEFAULT NULL,
  `tlp_pegawai` varchar(12) DEFAULT NULL,
  `email_pegawai` varchar(100) DEFAULT NULL,
  `foto_pegawai` varchar(100) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  PRIMARY KEY (`nip`),
  KEY `id_jabatan` (`id_jabatan`),
  CONSTRAINT `tbl_pegawai_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `tbl_jabatan` (`id_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pegawai`
--

LOCK TABLES `tbl_pegawai` WRITE;
/*!40000 ALTER TABLE `tbl_pegawai` DISABLE KEYS */;
INSERT INTO `tbl_pegawai` VALUES ('196305201986031029','Tono Syafruddin',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_pegawai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pemohon_izin`
--

DROP TABLE IF EXISTS `tbl_pemohon_izin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pemohon_izin` (
  `nik_pemohon_izin` char(16) NOT NULL,
  `nama_pemohon_izin` varchar(100) NOT NULL,
  `jk_pemohon_izin` enum('L','P') DEFAULT NULL,
  `alamat_pemohon_izin` varchar(255) DEFAULT NULL,
  `tlp_pemohon_izin` varchar(12) DEFAULT NULL,
  `email_pemohon_izin` varchar(255) DEFAULT NULL,
  `ktp_pemohon_izin` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nik_pemohon_izin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pemohon_izin`
--

LOCK TABLES `tbl_pemohon_izin` WRITE;
/*!40000 ALTER TABLE `tbl_pemohon_izin` DISABLE KEYS */;
INSERT INTO `tbl_pemohon_izin` VALUES ('1902013006960010','TONO SYAFRUDDIN','L','Jalan Sijur RT 33 RW 10','081949162028','muhammadhidayah@gmail.com',NULL),('1902013006960014','MUHAMMAD HIDAYAH','L','Jalan Sijuk RT 33 RW 10 No 20 Tanjung Pandan','081949162028','muhammad30hidayah696@gmail.com',NULL);
/*!40000 ALTER TABLE `tbl_pemohon_izin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_perizinan`
--

DROP TABLE IF EXISTS `tbl_perizinan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_perizinan` (
  `id_perizinan` char(14) NOT NULL,
  `nomor_perizinan` varchar(100) DEFAULT NULL,
  `nik_pemohon_izin` char(16) NOT NULL,
  `nip` char(18) NOT NULL,
  `id_izin` int(11) NOT NULL,
  `status_perizinan` enum('Izin Terbit','Menunggu','Dalam Proses') DEFAULT NULL,
  `alamat_perizinan` text,
  `tgl_perizinan` date DEFAULT NULL,
  `berkas_permohonan` varchar(255) DEFAULT NULL,
  `berkas_perizinan` varchar(255) DEFAULT NULL,
  `jenis_perizinan` enum('Baru','Perubahan','Perpanjangan') DEFAULT NULL,
  PRIMARY KEY (`id_perizinan`),
  KEY `id_izin` (`id_izin`),
  KEY `nik_pemohon_izin` (`nik_pemohon_izin`),
  CONSTRAINT `tbl_perizinan_ibfk_1` FOREIGN KEY (`id_izin`) REFERENCES `tbl_izin` (`id_izin`),
  CONSTRAINT `tbl_perizinan_ibfk_2` FOREIGN KEY (`nik_pemohon_izin`) REFERENCES `tbl_pemohon_izin` (`nik_pemohon_izin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_perizinan`
--

LOCK TABLES `tbl_perizinan` WRITE;
/*!40000 ALTER TABLE `tbl_perizinan` DISABLE KEYS */;
INSERT INTO `tbl_perizinan` VALUES ('20170201-00001','ABCDEFGHIJK','1902013006960010','196305201986031029',8,'Izin Terbit','Jalan Mancasan Indah 3 No. 19 Condong Catur','2017-10-26','teestt.rar','teestt.rar','Baru'),('20170912-00001','','1902013006960010','196305201986031029',8,'Dalam Proses','Jalan Sijuk Rt 33 Rw No 20 Air Merbau Tanjungpandan','2017-09-12','autocomplete-master.zip',NULL,'Perubahan'),('20171011-00001','','1902013006960014','196305201986031029',8,'Dalam Proses','Jalan Sijuk Rt 33 Rw No 20 Air Merbau Tanjungpandan','2017-11-04','lightbox2-master.zip',NULL,'Baru'),('20171117-00001','','1902013006960014','196305201986031029',8,'Dalam Proses','Jalan Sijuk Rt 33 Rw No 20 Air Merbau Tanjungpandan','2017-11-03','Autocomplete1.rar',NULL,'Perpanjangan');
/*!40000 ALTER TABLE `tbl_perizinan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nip` char(18) NOT NULL,
  `username_pegawai` varchar(100) NOT NULL,
  `password_pegawai` varchar(255) NOT NULL,
  `jenis_user` enum('Kepala Dinas','Admin','Operator','Editor','Contributor') NOT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `nip` (`nip`),
  CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `tbl_pegawai` (`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (2,'196305201986031029','tonosy','tonosy','Contributor','2017-11-06 08:16:21'),(3,'196305201986031029','tonosy1','tonosy1','Editor','2017-11-06 08:28:43'),(4,'196305201986031029','tonosy2','tonosy2','Operator','2017-11-06 07:37:41'),(5,'196305201986031029','tonosy3','tonosy3','Admin','2017-11-05 22:16:35'),(7,'196305201986031029','tonosy4','tonosy4','Kepala Dinas','2017-11-06 09:22:22'),(8,'196305201986031029','teessss','tessstt','Contributor',NULL);
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-07  4:20:11
