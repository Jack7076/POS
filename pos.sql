-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2019 at 06:52 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `ID` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`ID`, `name`, `level`) VALUES
(1, 'Admin', 100),
(2, 'User', 20),
(3, 'All', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(7) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(7) NOT NULL,
  `pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `name`, `price`, `pic`) VALUES
(4, 'Iraq Lobster', 855, 'products/lobster.jpg'),
(5, 'Vecal', 25, 'products/vhale.jpg'),
(6, 'Goat', 799, 'products/giraffe.jpg\r\n'),
(8, 'Premium Free Range Egg', 900000, 'products/FreerangeEgg.jpg'),
(9, 'Budget Taco', 75, 'products/taco.jpg'),
(10, 'Doonkay', 987, 'products/donkey.jpg'),
(11, 'Shronk', 788, 'products/shronk.jpg'),
(12, 'Shrokitie', 1, 'products/shrokie.jpg'),
(13, 'Lord Faquard', 5, 'products/farquard.jpg'),
(14, 'Crazy Dave and His pet Taco', 10000, 'products/crazyDave.png'),
(15, 'Sonic', 1, 'products/sanic.jpg'),
(16, 'Kermit', 855, 'products/kermit.jpg'),
(17, 'Sassy', 10000, 'products/sossy.jpg'),
(18, 'Peppa Pog', 699, 'products/pp.jpg'),
(19, 'Y did U. Y', 900, 'products/regret.gif'),
(20, 'Jinzo', 5000, 'products/jinzo.jpg'),
(21, 'Mike Nolan', 855, 'products/mike.jpg'),
(22, 'No Pic #1', 990, ''),
(23, 'Florida Man', 588, 'products/hatman.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `ID` int(12) NOT NULL,
  `products` text NOT NULL,
  `saledate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `soldby` varchar(255) NOT NULL,
  `customer` varchar(255) NOT NULL DEFAULT 'nocustomer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`ID`, `products`, `saledate`, `soldby`, `customer`) VALUES
(1, '{\"0\":{\"quant\":\"1\",\"name\":\"Budget Taco\",\"price\":\"$0.75\"},\"1\":{\"quant\":\"1\",\"name\":\"Premium Free Range Egg\",\"price\":\"$9000.00\"}}', '2019-05-24 01:10:56', '1', 'unset'),
(2, '{\"0\":{\"quant\":\"1\",\"name\":\"Shronk\",\"price\":\"$7.88\"}}', '2019-05-24 01:13:06', '1', 'unset'),
(3, '{\"0\":{\"quant\":\"1\",\"name\":\"Peppa Pog\",\"price\":\"$6.99\"},\"1\":{\"quant\":\"1\",\"name\":\"Y did U. Y\",\"price\":\"$9.00\"}}', '2019-05-24 01:13:41', '1', 'unset'),
(4, '{\"0\":{\"quant\":\"1\",\"name\":\"Peppa Pog\",\"price\":\"$6.99\"}}', '2019-05-24 01:15:33', '3', 'unset'),
(6, '{\"0\":{\"quant\":\"1\",\"name\":\"Premium Free Range Egg\",\"price\":\"$9000.00\"}}', '2019-05-24 02:21:15', '3', 'unset'),
(7, '{\"0\":{\"quant\":\"1\",\"name\":\"Mike Nolan\",\"price\":\"$8.55\"}}', '2019-05-24 02:23:04', '1', 'unset'),
(8, '{\"0\":{\"quant\":\"11\",\"name\":\"Goat\",\"price\":\"$7.99\"}}', '2019-05-24 02:23:58', '1', 'unset'),
(9, '{\"0\":{\"quant\":\"1\",\"name\":\"Y did U. Y\",\"price\":\"$9.00\"},\"1\":{\"quant\":\"7\",\"name\":\"Jinzo\",\"price\":\"$50.00\"},\"2\":{\"quant\":\"1\",\"name\":\"Premium Free Range Egg\",\"price\":\"$9000.00\"},\"3\":{\"quant\":\"3\",\"name\":\"Doonkay\",\"price\":\"$9.87\"}}', '2019-05-24 02:24:49', '1', 'unset');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(7) NOT NULL,
  `fname` varchar(255) NOT NULL DEFAULT 'John',
  `lname` varchar(255) NOT NULL DEFAULT 'Snow',
  `email` varchar(255) NOT NULL,
  `pin` varchar(255) NOT NULL DEFAULT 'No Pin Set',
  `access` varchar(255) NOT NULL DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `fname`, `lname`, `email`, `pin`, `access`) VALUES
(1, 'Jack', 'Jameson', 'jack@prozel.net', 'pzlhash7842620d0df0878481f4e35721170ce6f6a2efb0250499e2c39f7b48880d6feb3c8d3481254dbd1c2adaf97d51458821abeadd91c30d992829e5fda91f624e83', 'All'),
(3, 'John', 'Snow', 'snow.john@whom.games', 'pzlhashf6b34dcd9da16218c2befa7b610ffa83ca0c10d4e09110c3601ac8b75b74bb2a161757695eff371cdcb2c744f4d907e8c4e733695ad11e9d8ac873637e7bea37', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
