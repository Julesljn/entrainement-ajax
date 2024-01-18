-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 05 jan. 2024 à 12:03
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `trombistock`
--

-- --------------------------------------------------------

--
-- Structure de la table `employee`
--

CREATE TABLE `employee` (
  `employeeId` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  `employeeName` varchar(100) DEFAULT NULL,
  `employeeSurname` varchar(100) DEFAULT NULL,
  `employeeImage` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employee`
--

INSERT INTO `employee` (`employeeId`, `serviceId`, `employeeName`, `employeeSurname`, `employeeImage`) VALUES
(7, 2, 'DARK', '6BILL', 'dark6bill.png'),
(8, 2, 'Amélie', 'POULIN', 'amelie.jpg'),
(10, 1, 'Max', 'LEFORESTIER', '18119507_482675105398032_8450334388083274585_n.jpg'),
(11, 1, 'Anne Lucie', 'NATION', 'annelucienation.jpg'),
(12, 1, 'Jean', 'PEUPLU', 'benoit.jpg'),
(15, 2, 'Mila', 'MACMILA', 'mila.png'),
(16, 3, 'Sean', 'CONNERY', 'sean.png'),
(17, 4, 'Tarta', 'LACREME', 'camille2.jpg'),
(18, 1, 'Tartempion', 'ROCHEFOUCAULT', 'alexandre.jpg'),
(19, 4, 'Tartarin', 'DETARASSE', 'arthur.jpg'),
(20, 3, 'Vladimir', 'DESTROY', 'ben.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `serviceId` int(11) NOT NULL,
  `serviceName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`serviceId`, `serviceName`) VALUES
(1, 'LOGISTIQUE'),
(2, 'DIRECTION'),
(3, 'COMMUNICATION'),
(4, 'INFORMATIQUE');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeId`),
  ADD KEY `FK_EMPLOYEESERVICE` (`serviceId`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`serviceId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `serviceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `FK_EMPLOYEESERVICE` FOREIGN KEY (`serviceId`) REFERENCES `services` (`serviceId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
