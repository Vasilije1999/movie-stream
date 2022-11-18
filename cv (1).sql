-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2022 at 08:09 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cv`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories_m`
--

CREATE TABLE `categories_m` (
  `id` int(11) UNSIGNED NOT NULL,
  `category` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories_m`
--

INSERT INTO `categories_m` (`id`, `category`) VALUES
(1, 'Action & Adventure '),
(2, 'Anime '),
(3, 'Children & Family'),
(4, 'Classic '),
(5, 'Comedies'),
(6, 'Dramas '),
(7, 'Horror'),
(8, 'Music '),
(9, 'Romantic'),
(10, 'Sci-fi & Fantasy '),
(11, 'Thrillers ');

-- --------------------------------------------------------

--
-- Table structure for table `homeslider`
--

CREATE TABLE `homeslider` (
  `id` int(30) NOT NULL,
  `title` varchar(150) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `rating` int(1) NOT NULL,
  `duration` varchar(20) CHARACTER SET utf8 NOT NULL,
  `actors` varchar(265) CHARACTER SET utf8 NOT NULL,
  `category` int(3) NOT NULL,
  `age` int(20) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homeslider`
--

INSERT INTO `homeslider` (`id`, `title`, `description`, `rating`, `duration`, `actors`, `category`, `age`, `deleted`) VALUES
(1, 'asdasdasd', 'asdadasdasd', 1, '21212', 'wqqwqqw', 1, 1, 0),
(2, 'asdasdasdasda', 'sdasdasdasdasdasdasd', 1, '121212', 'sadsdasdasdas', 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `active` int(1) NOT NULL DEFAULT 1,
  `status` enum('Administrator','Editor','User') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `name`, `lastname`, `email`, `password`, `time`, `active`, `status`) VALUES
(1, 'Vasilije', 'Jeremic', 'vasilije.jeremic99@gmail.com', 'jeremic123', '2020-12-15 17:16:12', 1, 'Administrator'),
(2, 'Nikola', 'Cavor', 'nikola.cavor@gmail.com', 'nikola123', '2020-12-15 17:16:12', 1, ''),
(3, 'Ivona', 'Tripkovic', 'ivona.tripkovic@gmail.com', 'ivona123', '2020-12-15 17:31:20', 0, ''),
(4, 'Zeljko', 'Jeremic', 'zeljko.jeremic@gmail.com', 'zeljko123', '2021-07-15 20:10:25', 1, ''),
(5, 'Tamara', 'Jeremic', 'tamara.jeremi@gmail.com', 'tamara123', '2021-07-15 20:17:42', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(30) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT current_timestamp(),
  `category` int(3) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `changed` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `vreme`, `category`, `deleted`, `changed`) VALUES
(4, 'monkey king', 'Five hundred years before the Monkey King wreaks havoc on the heavenly kingdom, Wukong refuses to bow down to his destiny when he sets out to rebel against the gods.\r\nRelease date: July 13, 2017 (China)\r\nDirector: Derek Kwok\r\nLanguage: Mandarin\r\nAdapted from: Journey to the West\r\nNominations: Hong Kong Film Award for Best Visual Effects, MORE\r\nDistributed by: New Classics Media', '2022-11-15 10:21:14', 10, 0, NULL),
(5, 'monkey king', 'Five hundred years before the Monkey King wreaks havoc on the heavenly kingdom, Wukong refuses to bow down to his destiny when he sets out to rebel against the gods.\r\nRelease date: July 13, 2017 (China)\r\nDirector: Derek Kwok\r\nLanguage: Mandarin\r\nAdapted from: Journey to the West\r\nNominations: Hong Kong Film Award for Best Visual Effects, MORE\r\nDistributed by: New Classics Media', '2022-11-15 10:22:13', 10, 0, NULL),
(6, 'monkeyking', 'Five hundred years before the Monkey King wreaks havoc on the heavenly kingdom, Wukong refuses to bow down to his destiny when he sets out to rebel against the gods.\r\nRelease date: July 13, 2017 (China)\r\nDirector: Derek Kwok\r\nLanguage: Mandarin\r\nAdapted from: Journey to the West\r\nNominations: Hong Kong Film Award for Best Visual Effects, MORE\r\nDistributed by: New Classics Media', '2022-11-15 10:24:52', 8, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--

CREATE TABLE `watchlist` (
  `id` int(11) NOT NULL,
  `idMovie` int(20) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories_m`
--
ALTER TABLE `categories_m`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeslider`
--
ALTER TABLE `homeslider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories_m`
--
ALTER TABLE `categories_m`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `homeslider`
--
ALTER TABLE `homeslider`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `watchlist`
--
ALTER TABLE `watchlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
