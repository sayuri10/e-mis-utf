-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- เนเธฎเธชเธ•เน: localhost
-- เน€เธงเธฅเธฒเนเธเธเธฒเธฃเธชเธฃเนเธฒเธ: 18 เธช.เธ. 2012  17:22เธ.
-- เธฃเธธเนเธเธเธญเธเน€เธเธดเธฃเนเธเน€เธงเธญเธฃเน: 5.1.41
-- เธฃเธธเนเธเธเธญเธ PHP: 5.3.2-1ubuntu4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- เธเธฒเธเธเนเธญเธกเธนเธฅ: `e-missive`
--

-- --------------------------------------------------------

--
-- เนเธเธฃเธเธชเธฃเนเธฒเธเธ•เธฒเธฃเธฒเธ `sbk_admin`
--

CREATE TABLE IF NOT EXISTS `sbk_admin` (
  `admin_id` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `admin_name` varchar(250) NOT NULL,
  `last_login` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- dump เธ•เธฒเธฃเธฒเธ `sbk_admin`
--

INSERT INTO `sbk_admin` (`admin_id`, `username`, `password`, `admin_name`, `last_login`, `status`) VALUES
(1, 'admin', 'admin', 'เธเธนเนเธ”เธนเนเธฅเธฃเธฐเธเธ', '0000-00-00 00:00:00', 1),
(2, 'saraban', 'saraban', 'เธชเธฒเธฃเธเธฃเธฃเธ“เธเธฅเธฒเธ', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- เนเธเธฃเธเธชเธฃเนเธฒเธเธ•เธฒเธฃเธฒเธ `sbk_book`
--

CREATE TABLE IF NOT EXISTS `sbk_book` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `priority` int(2) NOT NULL,
  `doc_num` varchar(30) NOT NULL,
  `book_title` varchar(300) NOT NULL,
  `date_doc` date NOT NULL,
  `book_from` int(4) NOT NULL,
  `from_type` int(2) NOT NULL,
  `to_type` int(2) NOT NULL,
  `detail` varchar(600) NOT NULL,
  `date_post` date NOT NULL,
  `year` varchar(4) NOT NULL,
  `send_num` int(6) NOT NULL,
  `respond` varchar(300) NOT NULL,
  `file1` varchar(300) NOT NULL,
  `file2` varchar(300) NOT NULL,
  `file3` varchar(300) NOT NULL,
  `file4` varchar(300) NOT NULL,
  `file5` varchar(300) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- เนเธเธฃเธเธชเธฃเนเธฒเธเธ•เธฒเธฃเธฒเธ `sbk_group`
--

CREATE TABLE IF NOT EXISTS `sbk_group` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `typeID` int(2) NOT NULL,
  `locationID` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- dump เธ•เธฒเธฃเธฒเธ `sbk_group`
--

INSERT INTO `sbk_group` (`id`, `name`, `typeID`, `locationID`, `status`) VALUES
(1, 'เธญเธณเธเธงเธขเธเธฒเธฃ', 2, 5, 1),
(2, 'เธชเนเธเน€เธชเธฃเธดเธกเธเธฒเธฃเธเธฑเธ”เธเธฒเธฃเธจเธถเธเธฉเธฒ', 2, 5, 1),
(3, 'เธเนเธขเธเธฒเธขเนเธฅเธฐเนเธเธ', 2, 5, 1),
(4, 'เธเธดเน€เธ—เธจเธ•เธดเธ”เธ•เธฒเธกเนเธฅเธฐเธเธฃเธฐเน€เธกเธดเธเธเธฅเธฏ', 2, 5, 1),
(5, 'เธเธฃเธดเธซเธฒเธฃเธเธฒเธเธเธธเธเธเธฅ', 2, 5, 1),
(6, 'เธซเธเนเธงเธขเธ•เธฃเธงเธเธชเธญเธเธ เธฒเธขเนเธ', 2, 5, 1),
(7, 'เธชเนเธเน€เธชเธฃเธดเธกเธชเธ–เธฒเธเธจเธถเธเธฉเธฒเน€เธญเธเธเธ', 2, 5, 1),
(8, 'เธเธฃเธดเธซเธฒเธฃเธเธฒเธฃเน€เธเธดเธเนเธฅเธฐเธชเธดเธเธ—เธฃเธฑเธเธขเน', 2, 5, 1),
(9, 'เธชเธดเธเธซเธเธฒเธ—เธฏ', 1, 1, 1),
(10, 'เนเธ•เธฃเธกเธดเธ•เธฃ', 1, 1, 1),
(11, 'เธ เธนเธเธฒเธฅเธตเธฅเธฒเธงเธ”เธต', 1, 1, 1),
(12, 'เธซเนเธงเธขเนเธเนเธ', 1, 1, 1),
(13, 'เธเธธเธเธขเธงเธก-เนเธกเนเน€เธเธฒ', 1, 2, 1),
(14, 'เน€เธกเธทเธญเธเธเธญเธ-เนเธกเนเธเธดเน', 1, 2, 1),
(15, 'เนเธกเนเธญเธนเธเธญ-เนเธกเนเธขเธงเธกเธเนเธญเธข', 1, 2, 1),
(16, 'เธชเธฒเธขเนเธ•เน', 1, 3, 1),
(17, 'เนเธเนเธเธชเธฒ', 1, 3, 1),
(18, 'เธชเธฒเธขเน€เธซเธเธทเธญเธฏ', 1, 3, 1),
(19, 'เธเธฒเธขเธกเธฑเธเธเธดเธกเธฒ', 1, 3, 1),
(20, 'เธฅเธธเนเธกเธเนเธณเธเธญเธ', 1, 4, 1),
(21, 'เน€เธญเธเธเธ', 1, 1, 1),
(22, 'เธชเธฒเธฃเธเธฃเธฃเธ“เธเธฅเธฒเธ', 2, 1, 1),
(23, 'เธชเธเธเนเธญเธ-เธ–เนเธณเธฅเธญเธ”', 1, 4, 1);

-- --------------------------------------------------------

--
-- เนเธเธฃเธเธชเธฃเนเธฒเธเธ•เธฒเธฃเธฒเธ `sbk_location`
--

CREATE TABLE IF NOT EXISTS `sbk_location` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- dump เธ•เธฒเธฃเธฒเธ `sbk_location`
--

INSERT INTO `sbk_location` (`id`, `name`, `status`) VALUES
(1, 'เธญเธณเน€เธ เธญเน€เธกเธทเธญเธ', 1),
(2, 'เธญเธณเน€เธ เธญเธเธธเธเธขเธงเธก', 1),
(3, 'เธญเธณเน€เธ เธญเธเธฒเธข', 1),
(4, 'เธญเธณเน€เธ เธญเธเธฒเธเธกเธฐเธเนเธฒ', 1),
(5, 'เธชเธณเธเธฑเธเธเธฒเธเน€เธเธ•เธเธทเนเธเธ—เธตเน', 1);

-- --------------------------------------------------------

--
-- เนเธเธฃเธเธชเธฃเนเธฒเธเธ•เธฒเธฃเธฒเธ `sbk_news`
--

CREATE TABLE IF NOT EXISTS `sbk_news` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `detail` varchar(600) NOT NULL,
  `userID` int(4) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- เนเธเธฃเธเธชเธฃเนเธฒเธเธ•เธฒเธฃเธฒเธ `sbk_organize`
--

CREATE TABLE IF NOT EXISTS `sbk_organize` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `num_book` varchar(15) NOT NULL,
  `smis` varchar(8) NOT NULL,
  `groupID` int(4) NOT NULL,
  `thumbol` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telephone` varchar(200) NOT NULL,
  `website` varchar(250) NOT NULL,
  `director` varchar(250) NOT NULL,
  `teldirector` varchar(250) NOT NULL,
  `typeID` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- เนเธเธฃเธเธชเธฃเนเธฒเธเธ•เธฒเธฃเธฒเธ `sbk_priority`
--

CREATE TABLE IF NOT EXISTS `sbk_priority` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name_priority` varchar(40) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- dump เธ•เธฒเธฃเธฒเธ `sbk_priority`
--

INSERT INTO `sbk_priority` (`id`, `name_priority`, `status`) VALUES
(1, 'เธ—เธฑเนเธงเนเธ', 1),
(2, 'เธ”เนเธงเธเธ—เธตเนเธชเธธเธ”', 1),
(3, 'เธ”เนเธงเธเธกเธฒเธ', 1),
(4, 'เธ”เนเธงเธ', 1),
(5, 'เธซเธเธฑเธเธชเธทเธญเน€เธงเธตเธขเธ', 1);

-- --------------------------------------------------------

--
-- เนเธเธฃเธเธชเธฃเนเธฒเธเธ•เธฒเธฃเธฒเธ `sbk_sendbook`
--

CREATE TABLE IF NOT EXISTS `sbk_sendbook` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `bookID` int(10) NOT NULL,
  `book_from` int(4) NOT NULL,
  `book_to` int(4) NOT NULL,
  `receive` int(6) NOT NULL,
  `year` varchar(4) NOT NULL,
  `date_receive` date NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- เนเธเธฃเธเธชเธฃเนเธฒเธเธ•เธฒเธฃเธฒเธ `sbk_showstat`
--

CREATE TABLE IF NOT EXISTS `sbk_showstat` (
  `id` int(5) NOT NULL,
  `smis` varchar(8) NOT NULL,
  `schoolname` varchar(500) NOT NULL,
  `groupname` varchar(500) NOT NULL,
  `aumphur` varchar(500) NOT NULL,
  `numlogin` int(11) NOT NULL DEFAULT '0',
  `numsend` int(11) NOT NULL DEFAULT '0',
  `numreceive` int(11) NOT NULL DEFAULT '0',
  `statdate` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- เนเธเธฃเธเธชเธฃเนเธฒเธเธ•เธฒเธฃเธฒเธ `sbk_tmp_upload`
--

CREATE TABLE IF NOT EXISTS `sbk_tmp_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_upload` varchar(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `qid` varchar(15) NOT NULL,
  `up1` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- เนเธเธฃเธเธชเธฃเนเธฒเธเธ•เธฒเธฃเธฒเธ `sbk_type`
--

CREATE TABLE IF NOT EXISTS `sbk_type` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `level` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- dump เธ•เธฒเธฃเธฒเธ `sbk_type`
--

INSERT INTO `sbk_type` (`id`, `name`, `level`, `status`) VALUES
(1, 'เนเธฃเธเน€เธฃเธตเธขเธ', 1, 1),
(2, 'เน€เธเธ•เธเธทเนเธเธ—เธตเนเธเธฒเธฃเธจเธถเธเธฉเธฒ', 2, 1);

-- --------------------------------------------------------

--
-- เนเธเธฃเธเธชเธฃเนเธฒเธเธ•เธฒเธฃเธฒเธ `sbk_user`
--

CREATE TABLE IF NOT EXISTS `sbk_user` (
  `user_id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `organizeID` int(4) NOT NULL,
  `count_login` int(10) NOT NULL,
  `last_login` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- เนเธเธฃเธเธชเธฃเนเธฒเธเธ•เธฒเธฃเธฒเธ `sbk_userlogs`
--

CREATE TABLE IF NOT EXISTS `sbk_userlogs` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `num_user` varchar(100) NOT NULL,
  `timeStart` datetime NOT NULL,
  `timeStop` varchar(30) NOT NULL DEFAULT '',
  `ip_addr` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

