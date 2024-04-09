-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2024 at 04:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grip_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `sno` int(11) NOT NULL,
  `sender` varchar(25) NOT NULL,
  `receiver` varchar(25) NOT NULL,
  `balance` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`sno`, `sender`, `receiver`, `balance`, `datetime`, `amount`) VALUES
(1, 'Jigar', 'Paras', 0, '2024-03-11 14:20:29', 3000),
(2, 'Jigar', 'Rohan', 0, '2024-03-12 11:32:15', 10000),
(3, 'dharmik', 'Jigar', 0, '2024-03-14 10:52:15', 200);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `credit_score` int(11) NOT NULL,
  `loan_type` varchar(20) NOT NULL,
  `balance` int(11) NOT NULL,
  `password` varchar(200) NOT NULL,
  `accountnumber` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `age`, `email`, `mobile`, `credit_score`, `loan_type`, `balance`, `password`, `accountnumber`) VALUES
(1, 'Paras', 25, 'parasshah@gmail.com', '123-456-7890', 750, 'personal', 59000, 'Paras123', '29361260'),
(2, 'Jigar', 24, 'jigaranam@gmail.com', '987-654-3210', 720, 'car', 24415, 'Jigar123', '40188422'),
(3, 'Deesha', 23, 'deeshabhanushali@gmail.com', '456-789-0123', 700, 'business', 42300, 'Deesha123', '12858333'),
(4, 'Rohan', 35, 'rohanchonkar@gmail.com', '', 0, '', 57380, 'Rohan123', '43726405'),
(5, 'Nimit', 20, 'nimitshah@gmail.com', '', 0, '', 39000, 'Nimit123', '80057030'),
(6, 'Aditi', 25, 'aditikarkare@gmail.com', '', 0, '', 44400, 'Aditi123', '69105942'),
(7, 'Kush', 24, 'kushanam@gmail.com', '', 0, '', 41310, 'Kush123', '05358623'),
(8, 'Harsh', 26, 'harshsanghvi@gmail.com', '', 0, '', 50110, 'Harsh123', '19475291'),
(9, 'Ashwin', 40, 'ashwinanam@gmail.com', '', 0, '', 47285, 'Ashwin123', '81300591'),
(10, 'Het', 50, 'hetrathod@gmail.com', '', 0, '', 44450, 'Het123', '48077089'),
(11, 'Prerna', 25, 'prerna@gmail.com', '1111111111', 500, '', 0, 'Prerna123', ''),
(12, 'dharmik', 24, 'dharmik@gmail.com', '1111111111', 500, '', 49800, 'Dharmik@1', '10717525');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
