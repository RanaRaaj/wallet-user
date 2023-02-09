-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2023 at 04:22 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wallet_panel`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_send_money`
--

CREATE TABLE `user_send_money` (
  `id` int(11) NOT NULL,
  `sender_name` varchar(22) NOT NULL,
  `sender_id` varchar(22) NOT NULL,
  `receiver_name` varchar(22) NOT NULL,
  `receiver_id` varchar(22) NOT NULL,
  `amount` int(51) NOT NULL,
  `content` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `sender_seen` int(21) NOT NULL DEFAULT 0,
  `receiver_seen` int(21) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sender_bank_name` varchar(51) DEFAULT NULL,
  `receiver_bank_name` varchar(51) DEFAULT NULL,
  `sender_bank_number` varchar(51) DEFAULT NULL,
  `receiver_bank_number` varchar(51) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_send_money`
--

INSERT INTO `user_send_money` (`id`, `sender_name`, `sender_id`, `receiver_name`, `receiver_id`, `amount`, `content`, `status`, `sender_seen`, `receiver_seen`, `created_at`, `updated_at`, `sender_bank_name`, `receiver_bank_name`, `sender_bank_number`, `receiver_bank_number`) VALUES
(1, 'user1@gmail.com', '2', 'user2@gmail.com', '3', 50, NULL, 0, 0, 0, '2023-02-07 01:40:21', '2023-02-07 01:40:21', NULL, NULL, NULL, NULL),
(2, 'user1@gmail.com', '2', 'user2@gmail.com', '3', 2000, NULL, 0, 0, 0, '2023-02-07 02:08:24', '2023-02-07 02:08:24', NULL, NULL, NULL, NULL),
(3, 'user1@gmail.com', '2', 'user2@gmail.com', '3', 2500, 'thisbf sdkfj bjkdfds bfsf dsufi sjkfu sd,kfsdbf sdlo ffsd fd', 0, 0, 0, '2023-02-09 11:07:16', '2023-02-09 11:07:16', 'ACB', 'ACB', '00100329802193', '112312113113111');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_send_money`
--
ALTER TABLE `user_send_money`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_send_money`
--
ALTER TABLE `user_send_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
