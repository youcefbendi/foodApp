-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 23, 2022 at 01:39 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `commande_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prix_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`commande_id`, `user_id`, `prix_total`) VALUES
(16, 2, 1500),
(17, 2, 1400),
(18, 2, 500),
(19, 2, 1600),
(20, 2, 400),
(21, 2, 600),
(22, 2, 1250),
(23, 2, 1400);

-- --------------------------------------------------------

--
-- Table structure for table `commande_details`
--

CREATE TABLE `commande_details` (
  `commande_id` int(11) NOT NULL,
  `nom` char(255) NOT NULL,
  `prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commande_details`
--

INSERT INTO `commande_details` (`commande_id`, `nom`, `prix`) VALUES
(16, 'margherita', 400),
(16, 'thon', 500),
(16, 'végétarienne', 600),
(17, 'margherita', 400),
(17, 'steakhouse', 450),
(17, 'poulet', 550),
(18, 'thon', 500),
(19, 'thon', 500),
(19, 'whopper', 550),
(19, 'poulet', 550),
(20, 'margherita', 400),
(21, 'long chicken', 600),
(22, 'mexicain', 600),
(22, 'merguez', 650),
(23, 'margherita', 400),
(23, 'steakhouse', 450),
(23, 'poulet', 550);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `ctg` varchar(255) NOT NULL,
  `nom` varchar(125) NOT NULL,
  `description` text NOT NULL,
  `prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `ctg`, `nom`, `description`, `prix`) VALUES
(1, 'pizza', 'margherita', 'Sauce tomate,gruyère,mozzarella,origan', 400),
(3, 'pizza', 'thon', 'Sauce tomate,gruyère,mozzarella,thon', 500),
(4, 'pizza', 'végétarienne', 'Sauce tomate,gruyère,mozzarella,oignons,courgette', 600),
(5, 'pizza', 'mexicaine', 'Sauce tomate,gruyère,mozzarella,steach hâché', 600),
(6, 'pizza', '4 fromages', 'Sauce tomate,gruyère,mozzarella, cheddar,chèvre', 650),
(7, 'pizza', 'algérienne', 'Sauce tomate,gruyère,mozzarella,viande haché,sauce algérienne', 650),
(8, 'pizza', 'bbq', 'Sauce tomate,gruyère,mozzarella,poulet fumé,sauce BBQ', 650),
(9, 'burger', 'steakhouse', 'sauce cajun,oignons,bacon,cheddar,poulet pané', 450),
(10, 'burger', 'whopper', 'viande de bœuf,mayonnaise,tomates,cornichons,oignons', 550),
(11, 'burger', 'chicken bbq', 'Un poulet pané et une délicieuse sauce barbecue.', 450),
(12, 'burger', 'long chicken', 'poulet pané,salade croquante,pain extra-long.', 600),
(13, 'burger', 'master bacon ', 'viande de bœuf,sauce aux herbes,bacon fumé,pain brioché.', 650),
(14, 'tacos', 'poulet', 'sauce gruyère,poulet fumé,frittes.', 550),
(15, 'tacos', 'viande', 'sauce gruyère,viande hachée,frittes', 550),
(16, 'tacos', 'mexicain', 'sauce tomate,boeuf haché,poivron vert.\r\n', 600),
(17, 'tacos', 'kebab', 'sauce fromagère,kebab,frittes,picon.', 650),
(18, 'tacos', 'merguez', 'sauce fromagère,merguez,picon,frittes', 650),
(19, 'tacos', 'test', 'test', 560);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `prenom` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mtp` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `nom`, `prenom`, `email`, `mtp`, `isAdmin`) VALUES
(1, 'Bendimered', 'Youcef', 'youssef.bendimered@gmail.com', 'admin', 1),
(2, 'bendi', 'othmane', 'othmane.bendi@gmail.com', 'othmane31', 0),
(3, 'bendi', 'saber', 'saber@gmail.com', 'saber31', 0),
(4, 'othmane', 'othmane', 'test@test.com', 'test.com', 1),
(5, 'testing', 'testing', 'testing@gmail.com', 'testing', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`commande_id`),
  ADD KEY `user_commande` (`user_id`);

--
-- Indexes for table `commande_details`
--
ALTER TABLE `commande_details`
  ADD KEY `commande_id` (`commande_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `commande_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `user_commande` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `commande_details`
--
ALTER TABLE `commande_details`
  ADD CONSTRAINT `commande_details_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`commande_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
