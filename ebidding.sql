-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 11, 2016 at 01:36 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ebidding`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE IF NOT EXISTS `administrators` (
`id_administrator` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `fullname` varchar(45) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `created_date` date NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id_administrator`, `email`, `fullname`, `username`, `password`, `created_date`, `last_updated`, `last_login`) VALUES
(3, 'ilyashabiburrahman@gmail.com', 'Ilyas Habiburrahman', 'ilyashrn', 'af1264cbdb9d5b3c7b401168118726fd', '2016-05-08', '2016-07-16 09:07:29', '2016-07-16 04:07:29'),
(4, 'ilyas.hbbrrahman@gmail.com', 'Ilyas Habiburrahman', 'userdewa', 'af1264cbdb9d5b3c7b401168118726fd', '2016-05-19', '2016-07-27 02:00:00', '2016-07-26 21:00:00'),
(5, 'arenzirevelino@gmail.com', 'Arenzi Revelino Alwii', 'arenzirevelino', '25d55ad283aa400af464c76d713c07ad', '2016-05-23', '2016-05-23 19:07:34', '2016-05-22 02:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `auctions`
--

CREATE TABLE IF NOT EXISTS `auctions` (
`id_auction` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_auctioneer` int(11) NOT NULL,
  `start_price` double NOT NULL,
  `lower_limit` double NOT NULL,
  `bid_interval` int(11) NOT NULL,
  `is_clossed` tinyint(1) NOT NULL DEFAULT '0',
  `start_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `closed_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_winner` int(11) DEFAULT NULL,
  `views_count` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auctions`
--

INSERT INTO `auctions` (`id_auction`, `id_product`, `id_auctioneer`, `start_price`, `lower_limit`, `bid_interval`, `is_clossed`, `start_timestamp`, `last_updated`, `closed_timestamp`, `id_winner`, `views_count`) VALUES
(6, 6, 2, 3500000, 2800000, 50000, 1, '2016-04-19 04:21:32', '2016-05-21 23:28:12', '0000-00-00 00:00:00', 14, 47),
(7, 9, 2, 1450000, 900000, 20000, 0, '2016-06-19 05:07:12', '2016-06-19 05:07:12', '0000-00-00 00:00:00', NULL, 10),
(8, 10, 2, 1900000, 1400000, 10000, 0, '2016-06-19 05:35:38', '2016-06-18 18:09:12', '0000-00-00 00:00:00', NULL, 7),
(9, 11, 2, 2200000, 1200000, 50000, 0, '2016-06-18 18:11:58', '2016-06-18 18:11:58', '0000-00-00 00:00:00', 17, 23),
(10, 12, 2, 2000000, 1350000, 10000, 0, '2016-06-18 18:13:57', '2016-06-18 18:14:15', '0000-00-00 00:00:00', 21, 14);

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE IF NOT EXISTS `bids` (
`id_bid` int(11) NOT NULL,
  `id_bidder` int(11) NOT NULL,
  `id_auction` int(11) NOT NULL,
  `bid_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bid_value` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id_bid`, `id_bidder`, `id_auction`, `bid_timestamp`, `bid_value`) VALUES
(14, 8, 6, '2016-05-24 16:02:28', 2900000),
(15, 8, 9, '2016-06-21 10:13:45', 2200000),
(16, 8, 9, '2016-06-21 10:14:00', 2100000),
(17, 4, 9, '2016-06-21 10:14:31', 2050000),
(18, 4, 9, '2016-06-21 10:14:39', 1800000),
(19, 8, 9, '2016-06-25 10:03:56', 2200000),
(20, 8, 9, '2016-06-25 10:04:59', 2100000),
(21, 8, 10, '2016-07-28 02:39:24', 1900000);

-- --------------------------------------------------------

--
-- Table structure for table `categories_subcategories`
--

CREATE TABLE IF NOT EXISTS `categories_subcategories` (
  `id_subcategory` int(11) NOT NULL,
  `id_category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories_subcategories`
--

INSERT INTO `categories_subcategories` (`id_subcategory`, `id_category`) VALUES
(8, 1),
(9, 1),
(10, 1),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(17, 2),
(21, 1),
(22, 1),
(23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
`id_member` int(11) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(55) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `join_date` date NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `avatar` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id_member`, `fullname`, `username`, `password`, `email`, `address`, `city`, `province`, `postal_code`, `phone_number`, `join_date`, `last_login`, `last_updated`, `avatar`) VALUES
(2, 'Ilyas Habiburrahman', 'ilyashrn', 'af1264cbdb9d5b3c7b401168118726fd', 'ilyashabiburrahman@gmail.com', 'Jl. Kemang Dahlia Raya E8 Kemang Pratama 2', 'Malang', 'Jawa Timur', '17116', '085719311994', '2016-04-05', '2016-07-28 02:54:50', '2016-07-22 18:24:18', '1a1338ffd399f6d5077d7f5e0bcfee29.png'),
(4, 'Cahya Wahyu Pratama', 'cahya_wahyu', 'af1264cbdb9d5b3c7b401168118726fd', 'cahya_wahyu@gmail.com', '', '', '', '', '', '2016-04-25', '2016-07-28 01:22:01', '0000-00-00 00:00:00', ''),
(5, 'Yusuf Firman Prihatno', 'yusuffirman', 'af1264cbdb9d5b3c7b401168118726fd', 'yusuffirman@gmail.com', 'Jl. Kemang Dahlia Raya E-8', 'Bekasi', 'Jawa Barat', '17116', '0816900588', '2016-05-08', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(6, 'Kurnia Dwi Agustin Rahayu', 'ogheyy', 'af1264cbdb9d5b3c7b401168118726fd', 'kurniadiwar@gmail.com', 'Jl. Soekarno Hatta no. 8', 'Malang', 'Jawa Timur', '65124', '08364523764', '2016-05-08', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(8, 'Jeanni Anggreani', 'jeannikna', 'af1264cbdb9d5b3c7b401168118726fd', 'jeannikna@gmail.com', '', '', '', '', '', '2016-05-24', '2016-07-28 02:40:05', '0000-00-00 00:00:00', ''),
(9, 'Ilma Fatiahramani', 'ilmaF', 'af1264cbdb9d5b3c7b401168118726fd', 'ilmafatiahramani@gmail.com', '', '', '', '', '', '2016-07-22', '2016-07-22 03:07:13', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `members_notifications`
--

CREATE TABLE IF NOT EXISTS `members_notifications` (
`id_notification` int(11) NOT NULL,
  `id_auction` int(11) NOT NULL,
  `notification_type` varchar(20) NOT NULL,
  `id_giver` int(11) NOT NULL,
  `id_receiver` int(11) NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `notification_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members_notifications`
--

INSERT INTO `members_notifications` (`id_notification`, `id_auction`, `notification_type`, `id_giver`, `id_receiver`, `is_read`, `notification_timestamp`) VALUES
(48, 6, 'bid in', 8, 2, 1, '2016-05-24 15:40:42'),
(49, 6, 'bid in', 8, 2, 1, '2016-05-24 16:02:28'),
(50, 6, 'you win', 2, 8, 0, '2016-05-24 16:02:52'),
(51, 6, 'review', 2, 8, 0, '2016-05-24 16:03:04'),
(52, 6, 'review', 8, 2, 1, '2016-05-24 16:03:45'),
(53, 9, 'bid in', 8, 2, 0, '2016-06-21 10:13:46'),
(54, 9, 'bid in', 8, 2, 0, '2016-06-21 10:14:00'),
(55, 9, 'another bid', 4, 8, 0, '2016-06-21 10:14:31'),
(56, 9, 'bid in', 4, 2, 0, '2016-06-21 10:14:31'),
(57, 9, 'another bid', 4, 8, 0, '2016-06-21 10:14:39'),
(58, 9, 'bid in', 4, 2, 0, '2016-06-21 10:14:39'),
(59, 9, 'another bid', 8, 4, 0, '2016-06-25 10:03:56'),
(60, 9, 'bid in', 8, 2, 0, '2016-06-25 10:03:56'),
(61, 9, 'another bid', 8, 4, 0, '2016-06-25 10:04:59'),
(62, 9, 'bid in', 8, 2, 0, '2016-06-25 10:04:59'),
(63, 9, 'winner is set', 2, 4, 0, '2016-06-25 11:38:53'),
(64, 9, 'you win', 2, 8, 0, '2016-06-25 11:38:53'),
(65, 9, 'winner is set', 2, 8, 0, '2016-06-25 11:39:47'),
(66, 9, 'you win', 2, 4, 0, '2016-06-25 11:39:47'),
(67, 9, 'winner is reset', 2, 8, 0, '2016-06-25 11:40:38'),
(68, 9, 'you are canceled', 2, 4, 0, '2016-06-25 11:40:38'),
(69, 9, 'winner is set', 2, 8, 0, '2016-06-25 13:22:31'),
(70, 9, 'you win', 2, 4, 0, '2016-06-25 13:22:31'),
(71, 9, 'review', 2, 4, 0, '2016-06-25 13:22:48'),
(72, 6, 'review', 8, 2, 0, '2016-07-28 01:14:44'),
(73, 9, 'review', 4, 2, 0, '2016-07-28 01:22:47'),
(74, 10, 'bid in', 8, 2, 0, '2016-07-28 02:39:24'),
(75, 10, 'you win', 2, 8, 0, '2016-07-28 02:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `members_reviews`
--

CREATE TABLE IF NOT EXISTS `members_reviews` (
`id_review` int(11) NOT NULL,
  `id_auction` int(11) NOT NULL,
  `id_giver` int(11) NOT NULL,
  `id_receiver` int(11) NOT NULL,
  `review_type` tinyint(1) NOT NULL DEFAULT '0',
  `review_content` text NOT NULL,
  `review_subject` varchar(25) NOT NULL,
  `review_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members_reviews`
--

INSERT INTO `members_reviews` (`id_review`, `id_auction`, `id_giver`, `id_receiver`, `review_type`, `review_content`, `review_subject`, `review_timestamp`) VALUES
(6, 6, 2, 8, 1, 'ajjkfdhsjdshfkjsdfhkjdsfhjkdshfjksdhf', 'Bagus', '2016-05-24 16:03:04'),
(7, 6, 8, 2, 0, 'sdfsdfsdf', 'bagus juga', '2016-05-24 16:03:45'),
(8, 9, 2, 4, 1, 'Makasih ya', 'Bagus', '2016-06-25 13:22:47'),
(9, 6, 8, 2, 1, 'Memuaskan, responnya cepat', 'Cepat tanggap', '2016-07-28 01:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id_product` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `id_category` int(11) NOT NULL,
  `description` text NOT NULL,
  `condition` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `name`, `id_category`, `description`, `condition`) VALUES
(6, 'iPhone 5 16 gb Malang', 10, 'Dijual iPhone 5 16gb warna hitam. Keterangannya :\n- FU, iCloud aman\n- IMEI di dusbuk dan mesin sama\n- Kelengkapan dusbuk, charger kw, dan kitab2\n- Fisik 100% mulus like new lah\n- Minusnya, batere suka drop sendiri, jadi sering mati\n\nBuka harga 2,100k nego. Minat langsung sms aja. COD Malang Kota, sekitar UB, suhat, Blimbing ', 'Bekas'),
(8, 'sdfdsf', 9, 'sdfdsf', 'Bekas'),
(9, 'Asus Zenfone 4S', 21, 'Langsung aja, dijual Asus Zenfone 4S \nKeterangannya : \n - Fisik 90% mulus \n - Kelengkapan fullseet (dusbuk, headset, charger) \n - Fungsi normal 100% \n - Garansi habis, pembelian 2 tahun lalu \n\nNego santai, no afgan. ', 'Bekas'),
(10, 'Samsung J4 Mulus fullset', 22, 'Dijual, samsung J4 dengan kondisi mulus overall. Keterangan lainnya : \n - Fisik 99% mulus, buktikan pas COD\n - Kelengkapan fullset\n - Fungsi normal\n - Garansi masih ada sampai Juli 2017 ', 'Bekas'),
(11, 'LG Nexus 5 Malang', 23, 'Dijual, LG Nexus 5 fullset, body mulus 90%, fungsi normal. COD Malang Kota, kirim-kirim juga boleh. Untuk spesifikasi lihat di google aja :)  ', 'Bekas'),
(12, 'Sony Xperia C3 Sidoarjo', 8, 'Langsung aja, dijual Xperia C3. Dengan keterangan : \n - Fullset; dusbuk, charger, headset, kitab-kitab\n - Normal 100% secara fungsional\n - Fisik mulus 80%\n - Sudah dipasangi anti-gores dan softcase\n\nCOD Sidoarjo Kota dan sekitarnya. Kirim-kirim juga boleh, ongkir ditanggung sendiri:) ', 'Bekas');

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE IF NOT EXISTS `products_categories` (
`id_category` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_categories`
--

INSERT INTO `products_categories` (`id_category`, `category_name`) VALUES
(1, 'smartphone'),
(2, 'Fotografi'),
(4, 'lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `products_picts`
--

CREATE TABLE IF NOT EXISTS `products_picts` (
`id_pict` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `img_file` varchar(55) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_picts`
--

INSERT INTO `products_picts` (`id_pict`, `id_product`, `img_file`) VALUES
(8, 6, '5e1ee10befa67526be3d24bccde39b1c.JPG'),
(9, 6, 'e3420fdaa3096c819cc966651d1c6534.JPG'),
(10, 6, 'c212125519aeeeed9eddc22bc7efdc1b.JPG'),
(11, 6, '0576778b07e5af0f7770f01115efea4f.JPG'),
(12, 6, 'de69f39f63c1eae04222ba3070461609.JPG'),
(13, 6, '009050df75e288439c3c1fae4c2e515a.JPG'),
(14, 9, 'f6ba2345e9cffe5926b52bbd65701f01.jpg'),
(15, 9, '86361bb5b34c0d130747ce15a48bbefa.jpg'),
(16, 10, '3708a01bc14e93e40f67ba70be0b8b6b.jpg'),
(17, 10, '4aedd10815291e2689bc8298427e098d.jpg'),
(18, 11, '890adb017692f755e0c50fdf2efea670.jpg'),
(19, 11, 'e9b0121e8f078bd16d60ce9783f1bbe9.jpg'),
(20, 12, '16f7d8da7b8dbc954f27949f8225d132.jpg'),
(21, 12, '1ed31a1ce232746952acc45e686fa08c.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products_subcategories`
--

CREATE TABLE IF NOT EXISTS `products_subcategories` (
`id_subcategory` int(11) NOT NULL,
  `sub_name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_subcategories`
--

INSERT INTO `products_subcategories` (`id_subcategory`, `sub_name`) VALUES
(8, 'Sony'),
(9, 'Xiaomi'),
(10, 'lainnya'),
(11, 'DSLR Nikon'),
(12, 'Lensa Nikon'),
(13, 'Lensa Canon'),
(14, 'DSLR Canon'),
(17, 'Action cam'),
(20, 'Lenovo'),
(21, 'Asus'),
(22, 'Samsung'),
(23, 'LG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
 ADD PRIMARY KEY (`id_administrator`);

--
-- Indexes for table `auctions`
--
ALTER TABLE `auctions`
 ADD PRIMARY KEY (`id_auction`), ADD KEY `auctions_ibfk_2` (`id_product`), ADD KEY `auctions_ibfk_1` (`id_auctioneer`), ADD KEY `auctions_ibfk_3` (`id_winner`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
 ADD PRIMARY KEY (`id_bid`), ADD KEY `bids_ibfk_2` (`id_bidder`), ADD KEY `bids_ibfk_1` (`id_auction`);

--
-- Indexes for table `categories_subcategories`
--
ALTER TABLE `categories_subcategories`
 ADD KEY `id_category` (`id_category`), ADD KEY `id_subcategory` (`id_subcategory`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
 ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `members_notifications`
--
ALTER TABLE `members_notifications`
 ADD PRIMARY KEY (`id_notification`), ADD KEY `members_notifications_ibfk_1` (`id_auction`), ADD KEY `members_notifications_ibfk_2` (`id_giver`), ADD KEY `members_notifications_ibfk_3` (`id_receiver`);

--
-- Indexes for table `members_reviews`
--
ALTER TABLE `members_reviews`
 ADD PRIMARY KEY (`id_review`), ADD KEY `members_reviews_ibfk_2` (`id_giver`), ADD KEY `members_reviews_ibfk_1` (`id_receiver`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id_product`), ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `products_categories`
--
ALTER TABLE `products_categories`
 ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `products_picts`
--
ALTER TABLE `products_picts`
 ADD PRIMARY KEY (`id_pict`), ADD KEY `products_picts_ibfk_1` (`id_product`);

--
-- Indexes for table `products_subcategories`
--
ALTER TABLE `products_subcategories`
 ADD PRIMARY KEY (`id_subcategory`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
MODIFY `id_administrator` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `auctions`
--
ALTER TABLE `auctions`
MODIFY `id_auction` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
MODIFY `id_bid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `members_notifications`
--
ALTER TABLE `members_notifications`
MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `members_reviews`
--
ALTER TABLE `members_reviews`
MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products_picts`
--
ALTER TABLE `products_picts`
MODIFY `id_pict` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `products_subcategories`
--
ALTER TABLE `products_subcategories`
MODIFY `id_subcategory` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auctions`
--
ALTER TABLE `auctions`
ADD CONSTRAINT `auctions_ibfk_1` FOREIGN KEY (`id_auctioneer`) REFERENCES `members` (`id_member`) ON DELETE CASCADE,
ADD CONSTRAINT `auctions_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE,
ADD CONSTRAINT `auctions_ibfk_3` FOREIGN KEY (`id_winner`) REFERENCES `bids` (`id_bid`) ON DELETE SET NULL;

--
-- Constraints for table `bids`
--
ALTER TABLE `bids`
ADD CONSTRAINT `bids_ibfk_1` FOREIGN KEY (`id_auction`) REFERENCES `auctions` (`id_auction`) ON DELETE CASCADE,
ADD CONSTRAINT `bids_ibfk_2` FOREIGN KEY (`id_bidder`) REFERENCES `members` (`id_member`) ON DELETE CASCADE;

--
-- Constraints for table `categories_subcategories`
--
ALTER TABLE `categories_subcategories`
ADD CONSTRAINT `categories_subcategories_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `products_categories` (`id_category`) ON DELETE CASCADE,
ADD CONSTRAINT `categories_subcategories_ibfk_3` FOREIGN KEY (`id_category`) REFERENCES `products_categories` (`id_category`) ON DELETE CASCADE,
ADD CONSTRAINT `categories_subcategories_ibfk_4` FOREIGN KEY (`id_subcategory`) REFERENCES `products_subcategories` (`id_subcategory`) ON DELETE CASCADE;

--
-- Constraints for table `members_notifications`
--
ALTER TABLE `members_notifications`
ADD CONSTRAINT `members_notifications_ibfk_1` FOREIGN KEY (`id_auction`) REFERENCES `auctions` (`id_auction`) ON DELETE CASCADE,
ADD CONSTRAINT `members_notifications_ibfk_2` FOREIGN KEY (`id_giver`) REFERENCES `members` (`id_member`) ON DELETE CASCADE,
ADD CONSTRAINT `members_notifications_ibfk_3` FOREIGN KEY (`id_receiver`) REFERENCES `members` (`id_member`) ON DELETE CASCADE;

--
-- Constraints for table `members_reviews`
--
ALTER TABLE `members_reviews`
ADD CONSTRAINT `members_reviews_ibfk_1` FOREIGN KEY (`id_receiver`) REFERENCES `members` (`id_member`) ON DELETE CASCADE,
ADD CONSTRAINT `members_reviews_ibfk_2` FOREIGN KEY (`id_giver`) REFERENCES `members` (`id_member`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories_subcategories` (`id_subcategory`) ON DELETE CASCADE;

--
-- Constraints for table `products_picts`
--
ALTER TABLE `products_picts`
ADD CONSTRAINT `products_picts_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
