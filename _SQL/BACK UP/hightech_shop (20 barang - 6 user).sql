-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2016 at 08:23 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

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
`id` int(11) NOT NULL,
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
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `brand`, `deskripsi`, `stok`, `harga`, `diskon`, `kategori_id`, `field_detail`, `garansi`, `warna`, `gambar`, `berat_gram`, `jumlah_lihat`, `status`) VALUES
(20, 'Asus X455LA-WX401D', 'Asus', 'Asus X455LA-WX401D hadir dengan design premium dan modern', 18, 5500000, 0, 1, 'AS100ELAA1T7F2ANID-3332032;SONIC MASTER;up to 3 hours;Intel;1.70;14.0;Intel HD grapichs;500.0;Asus X455LA-WX401D;DOS;24.28 x 34.8 x 2.56;2GB;Yes;yes', '2 Tahun', 'hitam', 'images/asus1.PNG', 2, 12, 1),
(21, 'Asus X200MA-KX575B', 'Asus', 'Asus X200MA-KX575B menyertakan berbagai teknologi yang hanya terdapat pada produknya\r\n seperti SonicMaster, Instan On, juga Ice Cool', 10, 4500000, 0, 1, 'AS100ELCJKDTANID-3095000;SONIC MASTER;up to 3 hours;Intel Celeron N2840;1.70;11.6;VGA Intel HD Graphics;500;Asus X200MA-KX575B;DOS;30.2 x 20.0 x 2.56;2GB;Yes;yes', '1 Tahun', 'biru;pink;putih', 'images/asusBiru.PNG;images/asuspink.PNG;images/asusputih.PNG', 2, 12, 1),
(22, 'Asus X453MA-WX216D', 'Asus', 'Asus X453MA-WX216D menyertakan berbagai teknologi yang hanya terdapat pada produknya\r\n seperti SonicMaster, Instan On, juga Ice Cool', 10, 6500000, 0, 1, 'AS100ELAJL9SANID-491342\r\n;SONIC MASTER;up to 3 hours;Intel Celeron N2840;1.70;11.6;VGA Intel HD Graphics;500;Asus Asus X453MA-WX216D;DOS;30.2 x 20.0 x 2.56;2GB;Yes;yes', '1 Tahun', 'hitam;putih', 'images/asus3hitam.PNG;images/asus3putih.PNG', 2, 12, 1),
(23, 'Fujitsu AH544V-64', 'Fujitsu', 'Fujitsu AH544V-64 hadir dengan kecepatan yang mumpuni dan design yang elegan, layar yang lebar', 10, 7500000, 0, 1, 'FU349ELAIXARANID-452926\r\n;SONIC MASTER;up to 3 hours;Intel Celeron N2840;3.20;15.6;NVIDIA GeForce GT720M 2GB;750;Asus Asus X453MA-WX216D;DOS;37.8 x 25.2 x 3.1;4GB;Yes;yes', '1 Tahun', 'putih', 'images/fjPutih.PNG', 3, 12, 1),
(24, 'HP Pavilion X2', 'HP', 'HP Pavilion X2 hadir dengan  Micro USB 2.0, 1 x Micro HDMI, 1 x Micro SD Card Reader, 1 x Audio Combo, dan resolusi layar yang tajam', 10, 7500000, 0, 1, 'HP467ELBYOVGANID-2479607\r\n;SONIC MASTER;up to 3 hours;Intel Atom Bay Trail XZ3736F;3.20;14;NVIDIA GeForce GT720M 2GB;750;HP Pavilion X2;DOS;37.8 x 25.2 x 3.1;4GB;Yes;yes', '1 Tahun', 'merah;putih', 'images/hp-merah.PNG;images/hp-putih.PNG', 3, 12, 1),
(25, 'HP 14-R201TX', 'HP', 'HP 14-R201TX hadir dengan  USB 3.0 - 2 USB 2.0 - 1 HDMI - 1 VGA - 1 RJ-45 - 1 headphone/microphone combo', 10, 8000000, 0, 1, 'HP467ELBYOVGANID-2479607\r\n;SONIC MASTER;up to 3 hours;Intel Core i5-5200U;3.20;14;NVIDIA GeForce GT720M 2GB;500;HP 14-R201TX;DOS;34.5 x 24.4 x 25.3;4GB;Yes;yes', '1 Tahun', 'merah', 'images/hpmerah.PNG', 3, 12, 1),
(26, 'HP Envy M6-n113dx', 'HP', 'HP Envy M6-n113dx hadir dengan  USB 3.0 - 2 USB 2.0 - 1 HDMI - 1 VGA - 1 RJ-45 - 1 headphone/microphone combo', 10, 8500000, 0, 1, 'HP467ELAUPGOANID-829262\r\n;SONIC MASTER;up to 3 hours;AMD Kaveri QuadCore FX-7500;3.20;15.6;NVIDIA GeForce GT720M 2GB;750;HP Envy M6-n113dx;Windows 8.1;34.5 x 24.4 x 25.3;8 GB;Yes;yes', '1 Tahun', 'silver', 'images/hpsilver.PNG', 3, 12, 1),
(27, 'Lenovo - IdeaPad G40-45', 'Lenovo', 'Lenovo - IdeaPad G40-45 hadir dengan  baterai yang tahan lama, dan kecepatan yang unggul', 10, 8500000, 0, 1, 'LE629ELAA2VUL9ANID-5372512\r\n;SONIC MASTER;3-4 Jam;AMD Quad Core A8 6410M;3.20;15.6;AMD R5 2 GB;500;Lenovo - IdeaPad G40-45;DOS;24 X 2 X 34;8 GB;Yes;yes', '1 Tahun', 'hitam', 'images/lenovo1.PNG', 3, 12, 1),
(28, 'Acer Z1402-C1RU', 'Acer', 'Acer kembali mempersembahkan, laptop dengan spesifikasi yang tidak kalah handal dari pendahulunya. Seri Acer Z1402-C1RU hadir dengan desain yang kompak dan dikemas dengan layar berukuran 14". Dilengkapi OS Windows 10 terbaru serta prosesor Intel Celeron 2957U, laptop yang satu ini siap menjadi andalan komputasi Anda baik di sekolah maupun kantor.\r\n', 10, 3470000, 0, 1, 'AC016ELAA1SAIGANID-3277440;SONIC MASTER;3-4 Jam;Intel Celeron 2957U;3.20;15.6;AMD R5 2 GB;500;Acer Z1402-C1RU;Windows 10;34.2 x 24 x 2.9;8 GB;Yes;yes', '1 Tahun', 'hitam', 'images/lp9.PNG', 2, 12, 1),
(29, 'Acer One 10', 'Acer', 'Acer menghadirkan seri netbook dengan kinerja optimal namun dengan harga yang terjangkau, Acer One 10- 2GB RAM - Quad Core Z3735F - 10.1". Hadir dengan desain yang portabel dan juga ringan, Anda pun tidak akan mudah lelah selama membawanya bepergian. Acer One 10 merupakan pilihan yang cocok dipakai berselancar di web, e-mail, chat, mendengarkan musik dan pekerjaan komputasi lainnya secara instan.\r\n', 10, 3470000, 0, 1, 'AC016ELAA1SAIFANID-3277439;SONIC MASTER;3-4 Jam; Intel Quad Core Z3735F;3.20;15.6;AMD R5 2 GB;500;Acer Z1402-C1RU;Windows 8.1;34.2 x 24 x 2.9;8 GB;Yes;yes', '1 Tahun', 'Silver', 'images/lp10.PNG', 2, 12, 1),
(30, 'Lenovo PC All In One C20-05', 'Lenovo', 'Di desain untuk bekerja sempurna dengan Microsoft Windows 8.1, Lenovo C20 dibekali prosesor AMD berperforma tinggi. Fitur Energy Management nya mampu memperpanjang daya baterai C20 melalui penggunaan teknologi hemat energi terkini.\r\n', 18, 4899000, 0, 2, 'LE629ELAUI5AANID-817790;AMD;1.50;19.5;2;500;2.0;IdeaCenter All In One C20;DOS;60 x 60 x 50 Cm;2 GB', '1 Tahun', 'hitam', 'images/Capture.PNG', 4, 12, 1),
(31, 'HP 251-014L Desktop PC', 'HP', 'Dengan pilihan upgrade yang mudah, HP Pavilion 251 adalah desktop PC serbaguna yang dapat memberikan banyak manfaat untuk kegiatan Anda sehari-hari. Dengan desain modern membuat desktop ini cocok ditempatkan di mana pun, membuat suasana ruangan Anda terasa lebih mengesankan. Dengan performa dan grafis yang handal serta kapasitas storage yang cukup sebagai tempat penyimpanan, kini Anda telah menemukan desktop PC yang ideal untuk kegiatan komputasi, hiburan dan gaming Anda.\r\n', 18, 6200000, 0, 2, 'HP467ELBCZN8ANID-1272562;Intel Core i3-4170;3.70;15.6;2;500;2.0;251-014L;DOS;38.98 x 36.77 x 17.55 Cm;2 GB', '1 Tahun', 'hitam', 'images/pc2.PNG', 18, 12, 1),
(32, 'HP PC 22-3015L All In One', 'HP', 'HP Pavilion 22 All-in-One Desktop, membuat hidup Anda lebih sederhana yang dapat memanjakan Anda setiap kali menggunakannya. All-in-One desktop ini diDesain sepraktis mungkin, dengan Processor Intel®Core™i3 berkecepatan 3.2GHz, didukung dengan 2GB RAM DDR3 dan Kapasitas Penyimpanan yang besar 500GB HDD serta Tampilan Layar yang lebar 22" Tochscreen enable IPS yang dapat memudahkan Anda dalam menjalankan aktivitas maupun pekerjaan kantor. Menyimpan semua file penting Anda, musik, foto, video, dan lainnya tanpa kompromi berkat kapasitas penyimpanan yang luas. Dengan HP TrueVision HD webcam yang terbaik. Bahkan dalam cahaya rendah sekalipun. \r\n', 14, 7750000, 0, 2, 'HP467ELBIJJUANID-1576841;Intel Core i3;3.20;22.0;2;500;2.0;PC 22-3015L All In One;Linux;57.1 x 43.5 x 9.9 cm;2 GB', '1 Tahun', 'hitam', 'images/pc3.PNG', 15, 12, 1),
(33, 'Apple iMac 8GB 27" MF886 Retina 5K Display', 'Apple', 'Apple menghadirkan iMac 27" with Retina 5K Display, iMac terbaru ini mendukung resolusi luar biasa \r\nbesar yaitu 5K (5120 x 2880) dengan total 14.7 juta pixels ! Teknologi layar yang digunakan \r\npada iMac Retina adalah bahan Oxide TFT (Thin Film Transistor) \r\nuntuk mentransfer energi pada setiap piksel di layarnya\r\n', 30, 36999999, 0, 2, 'AP082ELASY7WANID-724044;Intel;3.50;27.0;2;1000;2.0;iMac 27 inch MF886 Retina 5K Display;Yosemite;65 x 51.6 x 20.3 cm;8 GB', '1 Tahun', 'Silver', 'images/mac1.PNG', 18, 12, 1),
(34, 'HP Pc AIO 20-r025d', 'HP', 'Bawalah dunia layar kecil Anda ke layar lebar. Ajak semua orang dirumah Anda menikmati konten Google Play favorit mereka di layar besar 19.45 inch. \r\nMulai sekarang setiap ruangan bisa dijadikan tempat hiburan bagi Anda dengan\r\nmenggunakan PC All In One\r\n', 30, 9399000, 0, 2, 'HP467ELAA30OLPANID-5665961;Intel® Core™ i5-4460T;2.70;20.0;2;1000;2.0;Pc AIO 20-r025d;Windows 8.1;50.02 x 35.92 x 6.5 cm;4 GB', '1 Tahun', 'Silver', 'images/hppc1.PNG', 30, 12, 1),
(35, 'HP PC All In One 20-R023L', 'HP', 'Komputer HP dengan layar seluas 20 inci ini mampu menawarkan tampilan yang sangat baik pada resolusi 1600 x 900 pixel, tampilan objeknya pun terlihat cukup tajam serta dengan warna yang akurat. Dan pada bagian atas monitor pun telah di sediakan webcam lengkap dengan microphone nya yang dapat anda manfaatkan untuk melakukan panggilan video. Dan dari segi penggunaan, k\r\nomputer HP Pavilion 20 - r023l ini membutuhkan daya yang tergolong rendah yaitu hanya 90 watt.\r\n', 15, 8000000, 0, 2, 'HP467ELAA2Y9Y2ANID-5527670;Intel Core i5-4460T;2.70;20.0;2;1000;2.0;Hp 20-r023L;DOS;7.65 x 49.6 x 34.0 cm;4 GB', '1 Tahun', 'Hitam', 'images/hppc.PNG', 15, 12, 1),
(36, 'HP Pavilion All In One 20-R022L', 'HP', 'HP 20-R022L hadir untuk memenuhi kebutuhan personal komputer yang akan membantu Anda dalam kegiatan komputasi sehari-hari baik di rumah maupun di kantor. Dikemas dengan sangat praktis. Cocok untuk diletakkan di setiap ruangan Anda dan mudah untuk dipindahkan.Dibekali prosesor Intel® Core™ i3-4170T, 3.2GHz dengan memori RAM 2 GB DDR3 serta dibekali layar lebar 19.5" , memberikan Anda kemudahan dalam melakukan pekerjaan komputasi sehari-hari. \r\nUntuk media penyimpanan data tersedia 500GB HDD yang cukup menyimpan berbagai data penting Anda.\r\n', 15, 7235600, 0, 2, 'HP467ELAA2ONR1ANID-4948791;Intel Core i3;3.20;19.5;2;500;2.0;All In One 20-R022L (I3-4170);DOS;7.2x49.5x33.9 cm;2 GB', '1 Tahun', 'Putih', 'images/hppc7.PNG', 8, 12, 1),
(37, 'Lenovo C360 - 57 321560', 'Lenovo', 'Lenovo C360 menggunakan proc core Intel Dual Core G2030 dan memiliki kapasitas memory 2GB DDR3. Lenovo C360 juga memiliki design yang sangat tipis dan elegant. Lenovo C360 dilengkapi dengan graphic intel shared yang memungkinkan kita dalam bermain grafis maupun game yang berat.\r\nLenovo C360 sudah dilengkapi hardisk 500GB untuk menampung banyak data didalamnya. Lenovo C360 juga sudah dilengkapi dengan DVD RW,LAN,Wifi,6 in 1 card reader.\r\n', 15, 7850000, 0, 2, 'LE629ELBORACANID-1920329;Intel Dual Core G2030;2.60;19.5;2;500;2.0;Lenovo C360 - 57 321560;Windows 8;48.5 x 5 x 39.8 cm;2 GB', '1 Tahun', 'Hitam', 'images/pc8.PNG', 6, 12, 1),
(38, 'Lenovo C560-8320', 'Lenovo', 'Jika anda mencari desktop premium, maka bisa jadi Lenovo IdeaCentre C560-8320 lah jawabannya. Sebuah perangkat komputer desktop dengan layar yang lebar dan jernih 23 inch LED didukung dengan NVIDIA GeForce 800M dengan 2 GB video memory, salah satu kartu grafis tercanggih di kelasnya yang membuat tampilan warna semakin tajam dan detail. Anda akan merasakan sebuah pengalaman memiliki komputer desktop ini yang bisa diandalkan untuk keperluan multimedia ataupun memainkan games-games yang membutuhkan daya besar.\r\n', 15, 14450000, 0, 2, 'LE629ELBP404ANID-1940977;INTEL Core i7-4785T;2.20;23.0;2;500;2.0;Lenovo C560-8320;Windows 8.1;22.2 x 2.09 x 17.48 cm;4 GB', '1 Tahun', 'Hitam', 'images/pc9.PNG', 11, 12, 1),
(39, 'Lenovo B5030-CMID', 'Lenovo', 'Lenovo IdeaCentre B50-30-DID mengusung desain all in one PC dimana CPU dan layar sudah menjadi satu sehingga berdampak pada ukurannya yang semakin minimalis. Dengan desin yang terbilang cukup ramping tersebut tentu akan semakin memudahkan anda dalam meletakkandimeja kerja anda tanpa perlu memakan banyak ruang di dalamnya. Dalam hal performa, prosesor yangdigunakannya juga terbilang cukup handal yakni Intel Core i5-4460 dengan cache 6M yang mampu berlari hingga kecepatan 2,7 GHz. \r\n', 15, 14000000, 0, 2, 'LE629ELAA1Y5SBANID-3609557;INTEL Core i7-4790;2.20;23.0;2;500;2.0;Lenovo B5030;Windows 8.1;32x10x25 cm;4 GB', '1 Tahun', 'Hitam', 'images/pc10.PNG', 18, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dorder`
--

CREATE TABLE IF NOT EXISTS `dorder` (
`id` int(11) NOT NULL,
  `horder_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `qty` int(10) unsigned NOT NULL,
  `harga` int(10) unsigned NOT NULL,
  `subtotal` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `horder`
--

CREATE TABLE IF NOT EXISTS `horder` (
`id` int(11) NOT NULL,
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
  `status` int(10) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
`id` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `field_detail` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `field_detail`, `status`) VALUES
(1, 'laptop', 'SKU;Fitur Audio;Lama Pemakaian Baterai;Tipe Processor;Kecepatan CPU;Ukuran layar;Chipset Grafis;Ukuran hard disk;\r\nModel;Sistem Operasi;Ukuran (L x W x H cm);Memori Sistem(RAM);Touchpad;Konektifitas Nirkabel', 1),
(2, 'pc', 'SKU;Processor;Kecepatan CPU;Ukuran layar;Memori Grafis;Ukuran hard disk(GB);Megapiksel;Model;Sistem Operasi;Ukuran (L x W x H cm);RAM\r\n', 0);

-- --------------------------------------------------------

--
-- Table structure for table `log_order`
--

CREATE TABLE IF NOT EXISTS `log_order` (
`id` int(11) NOT NULL,
  `horder_id` int(11) NOT NULL,
  `status` varchar(200) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `todayorder`
--

CREATE TABLE IF NOT EXISTS `todayorder` (
`id` int(11) NOT NULL,
  `horder_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

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
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `nama_depan`, `nama_belakang`, `password`, `email`, `tanggal_lahir`, `alamat`, `kota`, `provinsi`, `kota_id`, `provinsi_id`, `telepon`, `kode_verifikasi`, `role`, `status`) VALUES
('kenneth', '', '', 'c37u/QMQH+I2fPbkLlfogo3fJsmKDaJsv6zBGoz8k1szThWlVvtzPVFJKoqIajDwoli/D/8W+X+JUjAnheEB/Q==', 'kenneth@gmail.com', '2015-12-07', '', '', '', 0, 0, '', '', 'customer', 1),
('melanialani', 'melania', 'laniwati', 'mel', 'melanialani@gmail.com', '1995-02-07', '', '', '', 0, 0, '', '', 'admin', 1),
('meloniaseven', 'melonia', 'seven', '123456', 'meloniaseven@gmail.com', '1995-02-07', 'Perumahan Delta Sari Baru cluster Delta Asri no.24, Waru', 'Sidoarjo', 'Jawa Timur', 0, 0, '081235797777', '', 'admin', 1),
('meshiang', 'Stefanie', 'Tanujaya', 'r9ls1KDfQWXzSTANsQuLq1XFZK35zowjGFNLIfHyjYploz2h+wmu+BdvQCTJpYnP3lWblLwtrRVw7psZrYmx7g==', 'meshiang@yahoo.com', '1995-06-21', 'Jagir Wonokromo Wetan 31', 'Surabaya', 'Jawa Timur', 444, 11, '+62 857 3071 6688', '', 'customer', 1),
('nancy', 'nancy', 'yonata', 'nancy', '', '0000-00-00', '', '', '', 0, 0, '', '', 'admin', 1),
('riandika', '', '', 'FrZ1fFTeQEG3v0lSBwuhTYQkHF8DIEpaw+sxEb/lgyadhPKCo5D7Rs33CHO+aGHUb/HbyYoTNzd3bqLqV0ThTA==', 'riandika@gmail.com', '2015-12-11', '', '', '', 0, 0, '', '', 'customer', 1);

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
`id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `potongan_harga` int(10) unsigned NOT NULL DEFAULT '0',
  `awal` date NOT NULL,
  `akhir` date NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `nama`, `potongan_harga`, `awal`, `akhir`, `status`) VALUES
(1, 'ABC', 20000, '2015-12-01', '2015-12-31', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dorder`
--
ALTER TABLE `dorder`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `horder`
--
ALTER TABLE `horder`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_order`
--
ALTER TABLE `log_order`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todayorder`
--
ALTER TABLE `todayorder`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`username`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `dorder`
--
ALTER TABLE `dorder`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `horder`
--
ALTER TABLE `horder`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `log_order`
--
ALTER TABLE `log_order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `todayorder`
--
ALTER TABLE `todayorder`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
