-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2018 at 04:37 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sg`
--

-- --------------------------------------------------------

--
-- Table structure for table `daemons`
--

CREATE TABLE `daemons` (
  `Start` text NOT NULL,
  `Info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gammu`
--

CREATE TABLE `gammu` (
  `Version` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gammu`
--

INSERT INTO `gammu` (`Version`) VALUES
(13);

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReceivingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text NOT NULL,
  `SenderNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) UNSIGNED NOT NULL,
  `RecipientID` text NOT NULL,
  `Processed` enum('false','true') NOT NULL DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Triggers `inbox`
--
DELIMITER $$
CREATE TRIGGER `inbox_timestamp` BEFORE INSERT ON `inbox` FOR EACH ROW BEGIN
    IF NEW.ReceivingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.ReceivingDateTime = CURRENT_TIMESTAMP();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `inbox_spam`
--

CREATE TABLE `inbox_spam` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReceivingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text NOT NULL,
  `SenderNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) UNSIGNED NOT NULL,
  `RecipientID` text NOT NULL,
  `Processed` enum('false','true') NOT NULL DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inbox_spam`
--

INSERT INTO `inbox_spam` (`UpdatedInDB`, `ReceivingDateTime`, `Text`, `SenderNumber`, `Coding`, `UDH`, `SMSCNumber`, `Class`, `TextDecoded`, `ID`, `RecipientID`, `Processed`) VALUES
('2017-10-11 12:27:46', '2017-10-11 12:27:46', '', '21321322', 'Default_No_Compression', '', '', -1, 'PEMILU#IMN ANJRIT', 273, '', 'false'),
('2017-10-22 20:52:09', '2017-10-22 20:52:09', '', '213213', 'Default_No_Compression', '', '', -1, 'REG SAGA ANJRIT', 274, '', 'false'),
('2018-01-27 12:03:12', '2018-01-27 12:03:12', '', '+6285711521421', 'Default_No_Compression', '', '', -1, 'ANJRIT', 275, '', 'false'),
('2018-01-27 12:13:29', '2018-01-27 12:13:29', '', '+6285711521421', 'Default_No_Compression', '', '', -1, 'ANJRIT', 276, '', 'false'),
('2018-01-27 12:15:34', '2018-01-27 12:15:34', '', '+6285711521421', 'Default_No_Compression', '', '', -1, 'ANJRIT', 277, '', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `outbox`
--

CREATE TABLE `outbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendBefore` time NOT NULL DEFAULT '23:59:59',
  `SendAfter` time NOT NULL DEFAULT '00:00:00',
  `Text` text,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) UNSIGNED NOT NULL,
  `MultiPart` enum('false','true') DEFAULT 'false',
  `RelativeValidity` int(11) DEFAULT '-1',
  `SenderID` varchar(255) DEFAULT NULL,
  `SendingTimeOut` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryReport` enum('default','yes','no') DEFAULT 'default',
  `CreatorID` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Triggers `outbox`
--
DELIMITER $$
CREATE TRIGGER `outbox_timestamp` BEFORE INSERT ON `outbox` FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.SendingDateTime = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingTimeOut = '0000-00-00 00:00:00' THEN
        SET NEW.SendingTimeOut = CURRENT_TIMESTAMP();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `outbox_multipart`
--

CREATE TABLE `outbox_multipart` (
  `Text` text,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text,
  `ID` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `SequencePosition` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbk`
--

CREATE TABLE `pbk` (
  `ID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT '-1',
  `Name` text NOT NULL,
  `Number` text NOT NULL,
  `Foto` varchar(250) NOT NULL,
  `tgl_lahir` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pbk`
--

INSERT INTO `pbk` (`ID`, `GroupID`, `Name`, `Number`, `Foto`, `tgl_lahir`) VALUES
(61, 2, 'SRI WAHYUNI ', '+628381899000', 'assets/img/03_charming.jpg', '1989-01-26'),
(60, 3, 'Koperasi', '+6283818993400', 'assets/img/logo-koperasi_zps581860cf.png', '0000-00-00'),
(62, 3, 'Sudijo', '0898989', 'assets/img/Meme-Mudik-Lebaran-Gambar-DP-BBM-Lucu-Kocak-Keren-Gokil-Abis-7.png', '1989-06-01'),
(75, -1, 'sadsad', '13213213', 'assets/img/', '0000-00-00'),
(67, 2, 'jurnal', '08989898898', '', '0000-00-00'),
(68, -1, 'Kemod', '0898898', 'assets/img/', '0000-00-00'),
(69, -1, 'sdsadsadsdsdsdsdsds', '2313213', 'assets/img/', '0000-00-00'),
(70, -1, 'asdsad', '23213', 'assets/img/', '0000-00-00'),
(76, 2, 'sadsadsad', '213123213123', 'assets/img/', '0000-00-00'),
(77, 3, 'andez', '082213148092', 'assets/img/', '1989-01-27'),
(78, 2, 'TES', '09889898', 'assets/img/', '1989-01-15'),
(79, 2, 'IMAN', '085711521421', 'assets/img/', '1999-01-27'),
(80, 3, 'WARDIMAN', '08986957879', 'assets/img/', '1995-11-21');

-- --------------------------------------------------------

--
-- Table structure for table `pbk_groups`
--

CREATE TABLE `pbk_groups` (
  `NameGroup` text NOT NULL,
  `GroupID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pbk_groups`
--

INSERT INTO `pbk_groups` (`NameGroup`, `GroupID`) VALUES
('Keluarga', 2),
('Teman', 3),
('Group Nakal', 9),
('Client', 8),
('Group 2', 12),
('tessss', 14),
('sadsadsadsad', 15),
('MOBILE LEGEND', 16);

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE `phones` (
  `ID` text NOT NULL,
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeOut` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Send` enum('yes','no') NOT NULL DEFAULT 'no',
  `Receive` enum('yes','no') NOT NULL DEFAULT 'no',
  `IMEI` varchar(35) NOT NULL,
  `Client` text NOT NULL,
  `Battery` int(11) NOT NULL DEFAULT '-1',
  `Signal` int(11) NOT NULL DEFAULT '-1',
  `Sent` int(11) NOT NULL DEFAULT '0',
  `Received` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Triggers `phones`
--
DELIMITER $$
CREATE TRIGGER `phones_timestamp` BEFORE INSERT ON `phones` FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.TimeOut = '0000-00-00 00:00:00' THEN
        SET NEW.TimeOut = CURRENT_TIMESTAMP();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sentitems`
--

CREATE TABLE `sentitems` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryDateTime` timestamp NULL DEFAULT NULL,
  `Text` text NOT NULL,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `SenderID` varchar(255) NOT NULL,
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  `Status` enum('SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending','DeliveryUnknown','Error') NOT NULL DEFAULT 'SendingOK',
  `StatusError` int(11) NOT NULL DEFAULT '-1',
  `TPMR` int(11) NOT NULL DEFAULT '-1',
  `RelativeValidity` int(11) NOT NULL DEFAULT '-1',
  `CreatorID` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Triggers `sentitems`
--
DELIMITER $$
CREATE TRIGGER `sentitems_timestamp` BEFORE INSERT ON `sentitems` FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.SendingDateTime = CURRENT_TIMESTAMP();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_autoreply`
--

CREATE TABLE `tbl_autoreply` (
  `id` int(2) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_autoreply`
--

INSERT INTO `tbl_autoreply` (`id`, `pesan`) VALUES
(3, 'Mohon maaf saya sedang sibuk'),
(4, 'sedang sibuk');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_autorespon`
--

CREATE TABLE `tbl_autorespon` (
  `id` int(11) NOT NULL,
  `keyword1` varchar(25) NOT NULL,
  `keyword2` varchar(25) NOT NULL,
  `result` text NOT NULL,
  `idforward` int(1) NOT NULL,
  `no_forward` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_autorespon`
--

INSERT INTO `tbl_autorespon` (`id`, `keyword1`, `keyword2`, `result`, `idforward`, `no_forward`) VALUES
(9, 'REG', 'SAGA', 'Terima kasih', 1, '83804070476'),
(10, 'ADSAD', 'SADSADSADSAD', 'sadsadsadsad', 1, '13213213'),
(11, 'REG', 'IMAN', 'TERIMA KASIH', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_filter_kata`
--

CREATE TABLE `tbl_filter_kata` (
  `idkata` int(11) NOT NULL,
  `nm_kata` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_filter_kata`
--

INSERT INTO `tbl_filter_kata` (`idkata`, `nm_kata`) VALUES
(1, 'Anjrit'),
(2, 'asdsadsadsd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log_polling`
--

CREATE TABLE `tbl_log_polling` (
  `idlog` int(11) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `kode` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_polling`
--

CREATE TABLE `tbl_polling` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `kode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_polling`
--

INSERT INTO `tbl_polling` (`id`, `name`, `jumlah`, `kode`) VALUES
(1, 'Iman Muhamad Wardiman', 0, 'IMN'),
(2, 'Andez Muhamad Pradesa', 0, 'ANZ'),
(3, 'SRI', 0, 'SRI');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `id` int(3) NOT NULL,
  `DestinationNumber` varchar(160) NOT NULL,
  `TextDecoded` varchar(50) NOT NULL,
  `CreatorID` varchar(5) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama_event` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `idset` int(1) NOT NULL,
  `set_autorespon` int(1) NOT NULL,
  `set_autoreply` int(1) NOT NULL,
  `set_ultah` int(1) NOT NULL,
  `set_pesan_ultah` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`idset`, `set_autorespon`, `set_autoreply`, `set_ultah`, `set_pesan_ultah`) VALUES
(1, 0, 0, 0, 'Selamat Ulang Tahun Ya');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_set_pol`
--

CREATE TABLE `tbl_set_pol` (
  `idset` int(1) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `kode_awal` varchar(25) NOT NULL,
  `pemisah` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_set_pol`
--

INSERT INTO `tbl_set_pol` (`idset`, `judul`, `kode_awal`, `pemisah`) VALUES
(1, 'Pemilihan Ketua Kelas', 'PEMILU', '#');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms_ultah`
--

CREATE TABLE `tbl_sms_ultah` (
  `id` int(11) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `ucapan` text NOT NULL,
  `tahun` year(4) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sms_ultah`
--

INSERT INTO `tbl_sms_ultah` (`id`, `no_hp`, `nama`, `ucapan`, `tahun`, `tanggal`) VALUES
(1, '', '', ', Selamat Ulang Tahun Ya', 2018, '2018-01-26'),
(2, '+628381899000', 'SRI WAHYUNI ', 'SRI WAHYUNI , Selamat Ulang Tahun Ya', 2018, '2018-01-26'),
(3, '082213148092', 'andez', 'andez, Selamat Ulang Tahun Ya', 2018, '2018-01-27'),
(4, '085711521421', 'IMAN', 'IMAN, Selamat Ulang Tahun Ya', 2018, '2018-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `level_user` int(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` int(5) NOT NULL,
  `w_login` datetime NOT NULL,
  `photo` varchar(100) NOT NULL,
  `nohp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `pass`, `level_user`, `email`, `status`, `w_login`, `photo`, `nohp`) VALUES
(2, 'andez', '79803a0eaab30ae84b7b807bb46419f5', 1, 'andeztea@gmail.com', 1, '2018-01-28 10:34:51', 'assets/img/users_lock.png', '+08989899898');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `inbox_spam`
--
ALTER TABLE `inbox_spam`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `outbox`
--
ALTER TABLE `outbox`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `outbox_date` (`SendingDateTime`,`SendingTimeOut`),
  ADD KEY `outbox_sender` (`SenderID`);

--
-- Indexes for table `outbox_multipart`
--
ALTER TABLE `outbox_multipart`
  ADD PRIMARY KEY (`ID`,`SequencePosition`);

--
-- Indexes for table `pbk`
--
ALTER TABLE `pbk`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pbk_groups`
--
ALTER TABLE `pbk_groups`
  ADD PRIMARY KEY (`GroupID`);

--
-- Indexes for table `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`IMEI`);

--
-- Indexes for table `sentitems`
--
ALTER TABLE `sentitems`
  ADD PRIMARY KEY (`ID`,`SequencePosition`),
  ADD KEY `sentitems_date` (`DeliveryDateTime`),
  ADD KEY `sentitems_tpmr` (`TPMR`),
  ADD KEY `sentitems_dest` (`DestinationNumber`),
  ADD KEY `sentitems_sender` (`SenderID`);

--
-- Indexes for table `tbl_autoreply`
--
ALTER TABLE `tbl_autoreply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_autorespon`
--
ALTER TABLE `tbl_autorespon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_filter_kata`
--
ALTER TABLE `tbl_filter_kata`
  ADD PRIMARY KEY (`idkata`);

--
-- Indexes for table `tbl_log_polling`
--
ALTER TABLE `tbl_log_polling`
  ADD PRIMARY KEY (`idlog`);

--
-- Indexes for table `tbl_polling`
--
ALTER TABLE `tbl_polling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`idset`);

--
-- Indexes for table `tbl_set_pol`
--
ALTER TABLE `tbl_set_pol`
  ADD PRIMARY KEY (`idset`);

--
-- Indexes for table `tbl_sms_ultah`
--
ALTER TABLE `tbl_sms_ultah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=341;
--
-- AUTO_INCREMENT for table `inbox_spam`
--
ALTER TABLE `inbox_spam`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;
--
-- AUTO_INCREMENT for table `outbox`
--
ALTER TABLE `outbox`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=427;
--
-- AUTO_INCREMENT for table `pbk`
--
ALTER TABLE `pbk`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `pbk_groups`
--
ALTER TABLE `pbk_groups`
  MODIFY `GroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_autoreply`
--
ALTER TABLE `tbl_autoreply`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_autorespon`
--
ALTER TABLE `tbl_autorespon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_filter_kata`
--
ALTER TABLE `tbl_filter_kata`
  MODIFY `idkata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_log_polling`
--
ALTER TABLE `tbl_log_polling`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_polling`
--
ALTER TABLE `tbl_polling`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `idset` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_set_pol`
--
ALTER TABLE `tbl_set_pol`
  MODIFY `idset` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_sms_ultah`
--
ALTER TABLE `tbl_sms_ultah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
