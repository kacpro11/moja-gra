-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 05, 2025 at 06:51 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farma_db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cash` decimal(10,2) NOT NULL,
  `rebirth_tokens` int(11) NOT NULL,
  `clicks` int(11) DEFAULT 0,
  `rebirths` int(11) DEFAULT 0,
  `farmerzy` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `cash`, `rebirth_tokens`, `clicks`, `rebirths`, `farmerzy`) VALUES
(1, 'CEO ', '$2y$10$FSRRsipiTEFx2pir1IYcnOUem679yOUN.xTKNvJVbukGiPVwnGeuW', 0.00, 0, 0, 0, 0),
(2, 'Test123', '$2y$10$nZso3eTtmAjyW1ivw7mp8eGcm4uZ2437CJysd58qT9cOgB5ZWTihC', 0.00, 0, 0, 0, 0),
(3, 'Test1234', '$2y$10$JqM3OIyN74xUY7bGUneqPuu0.4Gc7MZmqHw/voZpddTyJ37z0Pqta', 0.00, 0, 0, 0, 0),
(4, 'test3233', '$2y$10$ISJWT1RYu0ojQ0tKNtauk.orxbV1.lAE1bxm6VvCxKgMXZTdEtwQK', 0.00, 0, 0, 0, 0),
(5, 'test333333', '$2y$10$5XWlijEcxHSNDwNdJgLsZ.ABg6DycjIcSSq9YdTOMBxuGPsDrAjv6', 0.00, 0, 0, 0, 0),
(6, 'test5', '$2y$10$1Yh7eNNCELabEdQ1RCoQYuawr9G2YbsiI95Ts5QrFL4pagvYEvNnC', 0.00, 0, 0, 0, 0),
(7, 'test1233', '$2y$10$WeLJ8kYscGhlthE.7xclEu8cM6OFWKFHudcWCwr.eZiy0nh.tomee', 0.00, 0, 0, 0, 0),
(8, 'test12333', '$2y$10$vYeZi0/yo/DZ7FIZ70ja5uKqaBUds9PPGp57UzCthP3ZS2pBeXS02', 0.00, 0, 0, 0, 0),
(9, '123', '$2y$10$6wOlxyiTs2DgNay6VXCibOU0n50arLMvdyyJvlryM5Ht1R6DMX8nO', 0.00, 0, 117, 7, 14);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
