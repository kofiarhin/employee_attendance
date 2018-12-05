-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2018 at 01:44 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `cover_image` varchar(256) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `description`, `cover_image`, `created_on`) VALUES
(11, '\'Special Air Mission 41\': Bush\'s final flights on \'Air Force One\'', '<p>By tradition, the plane is only called Air Force One when the president is on board. President Donald Trump will not be traveling on the aircraft, so the plane has been redesignated and renamed to honor Bush this week. </p>\r\n\r\n\r\n<p>By tradition, the plane is only called Air Force One when the president is on board. President Donald Trump will not be traveling on the aircraft, so the plane has been redesignated and renamed to honor Bush this week. </p>\r\n\r\n\r\n<p>By tradition, the plane is only called Air Force One when the president is on board. President Donald Trump will not be traveling on the aircraft, so the plane has been redesignated and renamed to honor Bush this week. </p>\r\n\r\n\r\n<p>By tradition, the plane is only called Air Force One when the president is on board. President Donald Trump will not be traveling on the aircraft, so the plane has been redesignated and renamed to honor Bush this week. </p>\r\n\r\n\r\n', '84ef3e1f3037c7162882eb3a9c5a1c32.jpg', '2018-12-03 03:39:02'),
(9, '  Search CNN... 45 CONGRESS SUPREME COURT 2018 ELECTION RESULTS Trump and Xi celebrate warm talks but remain far away from a final deal on trade', '<p>rinting and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like </p>\r\n\r\n<p>rinting and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like </p>\r\n\r\n\r\n<p>rinting and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like </p>\r\n\r\n\r\n<p>rinting and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like </p>', '9c521e332f96bcc5166dfd18342a9925.jpg', '2018-12-03 03:05:30');

-- --------------------------------------------------------

--
-- Table structure for table `claim_reasons`
--

CREATE TABLE `claim_reasons` (
  `id` int(11) NOT NULL,
  `claim_name` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `position_name` varchar(256) NOT NULL,
  `permissions` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `position_name`, `permissions`) VALUES
(1, 'Administrator', '{"admin": 1}'),
(2, 'General Manager', '{"moderator": 1, "supervisor": 1}'),
(3, 'Assistant Manager', '{"moderator": 1, "supervisor": 1}'),
(4, 'Supervisor', '{"supervisor": 1}'),
(5, 'Senior Staff', '{"standard": 1}'),
(6, 'Junior Staff', '{"standard": 1}');

-- --------------------------------------------------------

--
-- Table structure for table `reimbursement`
--

CREATE TABLE `reimbursement` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(256) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `approved` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reimbursement`
--

INSERT INTO `reimbursement` (`id`, `user_id`, `description`, `amount`, `created_on`, `approved`) VALUES
(7, 21, 'medical', 40000, '2018-12-03 22:31:40', 1),
(6, 20, 'travel', 400, '2018-12-03 22:31:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `timesheet`
--

CREATE TABLE `timesheet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `completed` int(11) NOT NULL DEFAULT '0',
  `approved` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timesheet`
--

INSERT INTO `timesheet` (`id`, `user_id`, `time_in`, `time_out`, `created_on`, `completed`, `approved`) VALUES
(1041, 20, '08:00:00', '17:00:00', '2018-12-03', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `contact` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `password` varchar(256) NOT NULL,
  `salt` varchar(256) NOT NULL,
  `profile_pic` varchar(256) NOT NULL DEFAULT 'default.jpg',
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `contact`, `position_id`, `password`, `salt`, `profile_pic`, `created_on`) VALUES
(14, 'kofi', 'arhin', 'kofiarhin@gmail.com', 508025370, 1, 'd909694ff205ff901a6a89f38dfd54a138651cbf10f9cfb8bf64c8e5f85ab749', 'dfas;kfkdjsadfdafd', 'b891e8131967a4cc1f8c7f97db28b641.jpg', '2018-11-27 00:00:00'),
(22, 'paul', 'boye', 'paulboye@gmail.com', 2147483647, 5, '7a6f472b26ca28c79e06b21ce80ea9ee3a605b81ab39f136f2980c9f1d24b5f3', 'ç‘†n\\Xë\'&…†ÕªÍRbEu+ô»ÚF¥ëY', 'dfd45774c8314f4e5082d4148bbed333.jpg', '2018-11-30 05:26:16'),
(23, 'lebron', 'James', 'lebron@gmail.com', 2147483647, 3, '7d71cafd80e26c8612eca3ff4d3814a69cfb2e34e893c0ec74535c10c74d29fe', '\'Á;±hð½˜Þy»‡„>U7)ôoËyD„>ú­Žî', 'default.jpg', '2018-11-30 05:56:50'),
(21, 'Patrick', 'lah', 'plah@gmail.com', 2147483647, 4, '2450ad34360509f67243c313f408f9b3022287c87e4d8be6dc19ac7741190c88', ',÷ß^7;ZðœÂàÚ“\r/ê’êßû1Ý¶U“', '4077b405dcd99a170c4ddbf326732b12.jpg', '2018-11-30 05:10:09'),
(20, 'cluadia', 'halm', 'kakie@gmail.com', 505771216, 5, '9ebb2f98df1c9b68645e3c0d8dcd2061de087ef95ae8d3c68370a32b92582965', '8z«@&m.b»\r6ºà@pØÝF—¨ÞÊúvÂjêßiµ', 'ee0c7a1af9a0a227d1113834816b3214.jpg', '2018-11-29 03:33:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `claim_reasons`
--
ALTER TABLE `claim_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reimbursement`
--
ALTER TABLE `reimbursement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheet`
--
ALTER TABLE `timesheet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `claim_reasons`
--
ALTER TABLE `claim_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `reimbursement`
--
ALTER TABLE `reimbursement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `timesheet`
--
ALTER TABLE `timesheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1042;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
