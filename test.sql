-- phpMyAdmin SQL Dump
-- version 5.2.1deb1ubuntu0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2023 at 11:55 AM
-- Server version: 10.11.2-MariaDB-1
-- PHP Version: 8.1.12-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `designation` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `designation`) VALUES
(1, 'Boissons'),
(2, 'Aliments'),
(3, 'Conserves'),
(5, 'Poissons'),
(7, 'loup');

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_produit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `panier`
--

INSERT INTO `panier` (`id`, `quantite`, `id_user`, `id_produit`) VALUES
(9, 1, 1, 1),
(10, 2, 1, 3),
(11, 3, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id_produit` int(11) NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_up` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `designation` varchar(40) NOT NULL,
  `prix` double NOT NULL,
  `quantite` int(11) NOT NULL,
  `categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id_produit`, `date_in`, `date_up`, `designation`, `prix`, `quantite`, `categorie`) VALUES
(1, '2023-12-09 23:00:00', '2023-11-09 20:13:24', 'Fantaaaa', 10, 6, 1),
(3, '2022-10-09 22:00:00', '2023-11-09 08:11:09', 'Coca', 10, 3, 1),
(9, '2023-11-06 11:00:00', '2023-11-13 11:00:00', 'Sprite', 12, 0, 1),
(10, '2023-11-06 11:21:00', '2023-11-28 11:12:00', 'Test4', 10, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `type`, `email`, `password`) VALUES
(1, 'Med', 'Ism', 0, 'mamiotban@gmail.com', '123'),
(4, 'anthony', 'pasLautre', 1, 'antho@gmail.com', '123'),
(5, 'Yahya', 'batchily', 1, 'yahya@gmail.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Indexes for table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_panier_id_user` (`id_user`),
  ADD KEY `fk_panier_id_produit` (`id_produit`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `clesecondaire` (`categorie`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `fk_panier_id_produit` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id_produit`),
  ADD CONSTRAINT `fk_panier_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
