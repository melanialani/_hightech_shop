-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2015 at 06:22 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hightech_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `stok` int(11) NOT NULL DEFAULT '0',
  `harga` int(10) unsigned NOT NULL DEFAULT '0',
  `diskon` int(3) unsigned NOT NULL DEFAULT '0',
  `kategori_id` int(11) NOT NULL,
  `field_detail` text NOT NULL,
  `garansi` varchar(60) NOT NULL,
  `warna` varchar(255) NOT NULL,
  `gambar` text NOT NULL,
  `berat_gram` int(11) unsigned NOT NULL DEFAULT '0',
  `jumlah_lihat` int(10) unsigned NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `brand`, `deskripsi`, `stok`, `harga`, `diskon`, `kategori_id`, `field_detail`, `garansi`, `warna`, `gambar`, `berat_gram`, `jumlah_lihat`, `status`) VALUES
(1, 'LG IPS LED Monitor', 'LG', 'Monitor LED IPS LG 22MP67 menghadirkan desain yang elegan dan artistik. Dengan bezel yang ramping, anda dapat melihat tampilan dengan lebih nyaman tanpa terganggu. Ukuran layar sebesar 22 inch mampu menghasilkan visual beresolusi Full HD 1920 x 1080, dengan warna yang hidup berkat dynamic contrast hingga 5M:1. Teknologi IPS yang digunakan memastikan kedetilan gambar dan warna yang hidup ini dapat dinikmati dari berbagai sudut.', 5, 2470001, 10, 1, 'LED;22";1920 x 1080; 10000000:1; 5 ms; 250 	250 cd/m² ; 16:9; HDMI, D-Sub;178;178;22 W <br> Konsumsi daya dalam siaga : 0.3 W <br> Monitor Off : 0.3 W; 100~250 V; Dengan stand: 500 x 205 x 407mm (WxDxH) <br>  Tanpa stand: 500 x 52 x 306mm (WxDxH)  ', '12 bulan', 'Hitam;Biru', 'images/LG-LED-Monitor-[20M37A]-SKU00514035_0-20150414162701.jpg;images/LG-IPS-LED-Monitor-22MP67--SKU00915708-201583113472.jpg;images/LG-LED-Monitor-[20M37A]-SKU00514035_1-20150414162701.jpg;images/LG-LED-Monitor-[20M37A]-SKU00514035_5-20150414162701.jpg', 2300, 5, 1),
(2, 'SAMSUNG MONITORRRRR', 'SAMSUNG', 'Nice Samsung monitor. blablablabala Bubu bledh beh lek ga falah alah btoick. You know this is fake right?', 7, 3450000, 15, 1, 'LED;22";1920 x 1080; 10000000:1; 5 ms; 250 	250 cd/m² ; 16:9; HDMI, D-Sub;178;178;22 W <br> Konsumsi daya dalam siaga : 0.3 W <br> Monitor Off : 0.3 W; 100~250 V; Dengan stand: 500 x 205 x 407mm (WxDxH) <br>  Tanpa stand: 500 x 52 x 306mm (WxDxH)  ', '12 bulan', 'Hitam;Biru', 'images/24__LED_Monitor_4ce30578e2dc8.jpg;', 3000, 0, 1),
(3, 'LG Curve', 'LG', 'BETTER MONITOR FOR YOUR MONITOR NEEDS. RECOMMENDED BY MR PROFITS!!! AND 9/10 DENTISTS', 14, 5000000, 0, 1, 'LED;22";1920 x 1080; 10000000:1; 5 ms; 250 	250 cd/m² ; 16:9; HDMI, D-Sub;178;178;22 W <br> Konsumsi daya dalam siaga : 0.3 W <br> Monitor Off : 0.3 W; 100~250 V; Dengan stand: 500 x 205 x 407mm (WxDxH) <br>  Tanpa stand: 500 x 52 x 306mm (WxDxH)  ', '12 bulan', 'Hitam;', 'images/lg-curve.jpg;', 4000, 1, 1),
(4, 'Asus Zenfone 5', 'ASUS', 'description here.', 4, 16000000, 50, 2, '1080x1600;Zen;', '12 Bulan', 'Hitman;', 'images/asus-zenfone-5-a502cg-main.jpeg;', 500, 0, 1),
(5, 'Google Nexus 6P', 'HUAWEI', 'description here.', 5, 3000000, 10, 2, '1080x1600;Nexus;', '12 Bulan', 'Silver;', 'images/Google-Nexus-6P.jpg;', 700, 0, 1),
(6, 'LG Smartphone?', 'LG', 'description here.', 4, 800000, 2, 2, '1080x1600;Lel;', '12 Bulan', 'Hitman;', 'images/first-lg-smartphone-offering-full-hd.jpg;', 666, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dorder`
--

CREATE TABLE IF NOT EXISTS `dorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horder_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `qty` int(10) unsigned NOT NULL,
  `harga` int(10) unsigned NOT NULL,
  `subtotal` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dorder`
--

INSERT INTO `dorder` (`id`, `horder_id`, `barang_id`, `keterangan`, `qty`, `harga`, `subtotal`, `status`) VALUES
(1, 3, 1, 'Hitam', 1, 2223001, 2223001, 1),
(2, 4, 1, 'Biru', 1, 2223001, 2223001, 1),
(3, 4, 1, 'Hitam', 1, 2223001, 2223001, 1);

-- --------------------------------------------------------

--
-- Table structure for table `horder`
--

CREATE TABLE IF NOT EXISTS `horder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kota` varchar(60) NOT NULL,
  `nama_penerima` varchar(255) NOT NULL,
  `total` int(10) unsigned NOT NULL,
  `voucher_id` varchar(50) NOT NULL,
  `grand_total` int(10) unsigned NOT NULL,
  `harga_jne` int(10) unsigned NOT NULL,
  `cara_jne` varchar(255) NOT NULL,
  `kode_jne` varchar(50) NOT NULL,
  `tipe_pembayaran` varchar(100) NOT NULL,
  `kode_pembayaran` varchar(50) NOT NULL,
  `tanggal_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `horder`
--

INSERT INTO `horder` (`id`, `user_username`, `alamat`, `kota`, `nama_penerima`, `total`, `voucher_id`, `grand_total`, `harga_jne`, `cara_jne`, `kode_jne`, `tipe_pembayaran`, `kode_pembayaran`, `tanggal_create`, `tanggal_update`, `status`) VALUES
(1, '0', 'Jagir Wonokromo Wetan 31 Surabaya, Jawa Timur', '444', '0', 2223001, '', 2235001, 12000, 'JNE CTC', '', '', '', '2015-12-09 00:21:31', '2015-12-08 17:21:31', 1),
(2, 'meshiang', 'Jagir Wonokromo Wetan 31 Surabaya, Jawa Timur', '444', '0', 2223001, '', 2235001, 12000, 'JNE CTC', '', '', '', '2015-12-09 00:22:43', '2015-12-08 17:22:43', 1),
(3, 'meshiang', 'Jagir Wonokromo Wetan 31 Surabaya, Jawa Timur', '444', '0', 2223001, '', 2235001, 12000, 'JNE CTC', '', '', '', '2015-12-09 00:23:58', '2015-12-08 17:23:58', 1),
(4, 'meshiang', 'Jagir Wonokromo Wetan 31 Surabaya, Jawa Timur', '444', 'Stefanie Tanujaya', 4446002, 'ABC', 4465002, 39000, 'JNE CTCSPS', '', '', '', '2015-12-09 00:30:03', '2015-12-08 17:30:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(60) NOT NULL,
  `field_detail` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `field_detail`, `status`) VALUES
(1, 'Monitor', 'Display Type;Ukuran Layar;Resolusi;Rasio Kontras;Waktu Respon;Brightness;Rasio Aspek;Input Connector;Horizontal View Angle;Vertical View Angle;Konsumsi Daya;Voltase Rata-Rata;Dimensi', 1),
(2, 'Smartphone', 'Ukuran Layar;Jenis', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_order`
--

CREATE TABLE IF NOT EXISTS `log_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horder_id` int(11) NOT NULL,
  `status` varchar(200) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `log_order`
--

INSERT INTO `log_order` (`id`, `horder_id`, `status`, `tanggal`) VALUES
(1, 4, 'Order #4 menunggu konfirmasi pembayaran', '2015-12-08 17:30:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(12) NOT NULL,
  `nama_depan` varchar(100) NOT NULL,
  `nama_belakang` varchar(100) NOT NULL,
  `password` varchar(88) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kota` varchar(60) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kota_id` int(11) NOT NULL,
  `provinsi_id` int(11) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `kode_verifikasi` varchar(32) NOT NULL,
  `role` varchar(12) NOT NULL DEFAULT 'customer',
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `nama_depan`, `nama_belakang`, `password`, `email`, `tanggal_lahir`, `alamat`, `kota`, `provinsi`, `kota_id`, `provinsi_id`, `telepon`, `kode_verifikasi`, `role`, `status`) VALUES
('kenneth', '', '', 'c37u/QMQH+I2fPbkLlfogo3fJsmKDaJsv6zBGoz8k1szThWlVvtzPVFJKoqIajDwoli/D/8W+X+JUjAnheEB/Q==', 'kenneth@gmail.com', '2015-12-07', '', '', '', 0, 0, '', '', 'customer', 1),
('meshiang', 'Stefanie', 'Tanujaya', 'r9ls1KDfQWXzSTANsQuLq1XFZK35zowjGFNLIfHyjYploz2h+wmu+BdvQCTJpYnP3lWblLwtrRVw7psZrYmx7g==', 'meshiang@yahoo.com', '1995-06-21', 'Jagir Wonokromo Wetan 31', 'Surabaya', 'Jawa Timur', 444, 11, '+62 857 3071 6688', '', 'customer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_voucher`
--

CREATE TABLE IF NOT EXISTS `user_voucher` (
  `user_username` varchar(50) NOT NULL,
  `voucher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_voucher`
--

INSERT INTO `user_voucher` (`user_username`, `voucher_id`) VALUES
('meshiang', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE IF NOT EXISTS `vouchers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) NOT NULL,
  `potongan_harga` int(10) unsigned NOT NULL DEFAULT '0',
  `awal` date NOT NULL,
  `akhir` date NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `nama`, `potongan_harga`, `awal`, `akhir`, `status`) VALUES
(1, 'ABC', 20000, '2015-12-01', '2015-12-31', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
