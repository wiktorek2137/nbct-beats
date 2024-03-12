-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 07:23 AM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nobocotobeats`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `beaty`
--

CREATE TABLE `beaty` (
  `beat_id` int(11) NOT NULL,
  `beat_cat` int(11) NOT NULL,
  `beat_title` text NOT NULL,
  `beat_autor` text NOT NULL,
  `beat_key` text NOT NULL,
  `beat_bpm` int(4) NOT NULL,
  `beat_date` date NOT NULL,
  `beat_music` text NOT NULL,
  `beat_cover` text NOT NULL,
  `beat_count` int(11) NOT NULL,
  `beat_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beaty`
--

INSERT INTO `beaty` (`beat_id`, `beat_cat`, `beat_title`, `beat_autor`, `beat_key`, `beat_bpm`, `beat_date`, `beat_music`, `beat_cover`, `beat_count`, `beat_price`) VALUES
(1, 1, 'Polo G Type Beat', '1', 'D♯m', 136, '2024-02-22', 'uploads/music/wiktorek.wav', 'uploads/img/cover1.webp', 12, 160),
(2, 2, 'Sad Type Beat', '2', 'Am', 130, '2024-02-13', 'uploads/music/wiktorek2.wav', 'uploads/img/cover2.webp', 4, 400),
(3, 3, 'BANGER TYPE BEAT', '4', 'Cm', 120, '2024-02-23', 'uploads/music/wiktorek3.wav', 'uploads/img/cover3.webp', 0, 80),
(4, 4, 'BUY 1 + 9 FREE - VENI VIDI VICI - MOST', '3', 'Bm', 140, '2024-02-17', 'uploads/music/wiktorek.wav', 'uploads/img/cover4.webp', 77, 43),
(6, 5, 'TWOJAS TARA TO ODPALA', '5', 'Fm', 120, '2024-02-29', 'uploads/music/wiktorek.wav', 'uploads/img/cover5.webp', 66, 788);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` text NOT NULL,
  `cat_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_img`) VALUES
(1, 'HIP-HOP', 'img/playlist/hip-hop.png'),
(2, 'POP', 'img/playlist/pop.png'),
(3, 'HOUSE', 'img/playlist/house.png'),
(4, 'DRILL', 'img/playlist/drill.png'),
(5, 'SOUL', 'img/playlist/soul.png'),
(6, 'BOOM BAP', 'img/playlist/boombap.webp');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `producers`
--

CREATE TABLE `producers` (
  `producer_id` int(11) NOT NULL,
  `producer_name` text NOT NULL,
  `producer_desc` text NOT NULL,
  `producer_cat` text NOT NULL,
  `producer_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producers`
--

INSERT INTO `producers` (`producer_id`, `producer_name`, `producer_desc`, `producer_cat`, `producer_img`) VALUES
(1, 'BRYAN', 'Rapuje, śpiewa, produkuje, realizuje i gra na gitarze. Full opcja. Umie zrobić kwiatek z języka.', 'PRODUCENT', 'img/producers/bryan.png'),
(2, 'WROOBEL', 'Rapuje, śpiewa, produkuje, realizuje', 'PRODUCENT', 'img/producers/wroobel.png'),
(3, 'VERI', 'Rapuje, śpiewa, produkuje', 'PRODUCENT', 'img/producers/veri.png'),
(4, 'SEEK', 'Rapuje, śpiewa, produkuje', 'PRODUCENT', 'img/producers/seek.png'),
(5, 'SZYMON_C', 'Rapuje, śpiewa, produkuje', 'CATEGORY', 'img/producers/szymon.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_type` varchar(11) NOT NULL,
  `prod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_type`, `prod_id`) VALUES
(3, 'wiktor@nobocoto.pl', '$2y$10$hlCisVsdMaHiV4kobRWKzeKUFBbRmzvgkkKSNaTIu/yue0avazul2', 'admin', 1),
(4, 'dominik@nobocoto.pl', '$2y$10$nHlb7X4j1ys5m7SWGTpUrONKXXrpx.5.8YrhR0oeQzjJZnpWHmZwO', 'user', 0),
(5, 'test@nobocoto.pl', '$2y$10$5s.oryOVj2eAot4cAhe8ReFcCnkgTLWRau6G3zIEYCeB7e5usHHAy', 'user', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `vouchers`
--

CREATE TABLE `vouchers` (
  `voucher_id` int(11) NOT NULL,
  `voucher_code` varchar(30) NOT NULL,
  `voucher_value` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`voucher_id`, `voucher_code`, `voucher_value`) VALUES
(1, 'OAZA420', '420'),
(2, 'PPLOS100', '100');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `beaty`
--
ALTER TABLE `beaty`
  ADD PRIMARY KEY (`beat_id`);

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indeksy dla tabeli `producers`
--
ALTER TABLE `producers`
  ADD PRIMARY KEY (`producer_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeksy dla tabeli `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`voucher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beaty`
--
ALTER TABLE `beaty`
  MODIFY `beat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `producers`
--
ALTER TABLE `producers`
  MODIFY `producer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
