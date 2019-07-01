-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 01 juil. 2019 à 08:25
-- Version du serveur :  5.7.26-0ubuntu0.16.04.1
-- Version de PHP :  7.0.33-0ubuntu0.16.04.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gesetudiant`
--

-- --------------------------------------------------------

--
-- Structure de la table `batiment`
--

CREATE TABLE `batiment` (
  `idBat` int(11) NOT NULL,
  `nomBat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `batiment`
--

INSERT INTO `batiment` (`idBat`, `nomBat`) VALUES
(1, 'a2'),
(2, 'a3'),
(3, 'a4'),
(5, 'pavillon A');

-- --------------------------------------------------------

--
-- Structure de la table `boursier`
--

CREATE TABLE `boursier` (
  `idEtudiant` int(11) NOT NULL,
  `idType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `boursier`
--

INSERT INTO `boursier` (`idEtudiant`, `idType`) VALUES
(23, 1),
(27, 1),
(28, 1),
(29, 1),
(38, 1),
(14, 2),
(24, 2),
(35, 2),
(36, 2);

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

CREATE TABLE `chambre` (
  `idChambre` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `nomChambre` varchar(10) NOT NULL,
  `idBat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`idChambre`, `num`, `nomChambre`, `idBat`) VALUES
(1, 1, 'chambre1', 2),
(3, 1, 'a4', 1),
(4, 10, 'a4', 1),
(5, 3, 'a5', 2),
(6, 4, 'PK', 2),
(7, 6, 'test', 2),
(8, 5, 'test', 5);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `idEtudiant` int(11) NOT NULL,
  `matEtudiant` varchar(20) NOT NULL,
  `nomEtudiant` varchar(30) NOT NULL,
  `prenomEtudiant` varchar(50) NOT NULL,
  `mailEtudiant` varchar(50) NOT NULL,
  `telEtudiant` int(11) NOT NULL,
  `naissEtudiant` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`idEtudiant`, `matEtudiant`, `nomEtudiant`, `prenomEtudiant`, `mailEtudiant`, `telEtudiant`, `naissEtudiant`) VALUES
(1, 'a1', 'ndao', 'ibou', 'ibou@ibou', 778083808, '1993-01-10'),
(4, 'a2', 'ndao', 'ibou', 'ibou@ibou', 778083808, '1993-01-10'),
(7, 'an2', 'guisszo', 'ibrahima', 'ibou@ibou', 774545214, '1999-10-10'),
(8, 'an3', 'guisszo', 'ibrahima', 'ibou@ibou', 774545214, '1999-10-10'),
(12, 'a54', 'guisszo', 'ibrahima', 'ibou@ibou', 774545214, '1999-10-10'),
(13, 'a20', 'guisszo', 'ibrahima', 'ibou@ibou', 774545214, '1999-10-10'),
(14, 'b1', 'guisszo', 'ibrahima', 'ibou@ibou', 774545214, '1999-10-10'),
(23, 'NDIB-12', 'Ndao', 'Ibrahima', 'ibou@ibou', 778083808, '1993-01-10'),
(24, 'SAAW-13', 'Sall', 'Awa', 'awa@awa', 777503987, '1994-10-26'),
(25, 'BATA-14', 'Ba', 'Tamara', 'tamara@tamara', 777010164, '1996-12-26'),
(26, 'NDAB-15', 'Ndoye', 'Abdoulaye', 'ablaye@ablaye', 777777777, '1992-10-10'),
(27, 'GUMA-16', 'Gueye', 'Mame Amy', 'amy@amy', 784514580, '1995-06-11'),
(28, 'GUMA-17', 'Gueye', 'Mame Amy', 'amy@amy', 784514580, '1995-06-11'),
(29, 'THTA-18', 'Thioune', 'Tamara', 'tamara@tamara', 777775544, '2019-06-07'),
(35, 'NDMO-24', 'Ndiaye', 'Moussa', 'tamara@tamara', 745475425, '2019-06-11'),
(36, 'SADI-18', 'Sall', 'Diama', 'diama@diama.co', 778887788, '1996-10-28'),
(37, 'SEMO-19', 'Seck', 'mor', 'mor@seck.com', 777542563, '1990-10-22'),
(38, 'SEND-20', 'Seck', 'Ndanane', 'mor01@seck.com', 777542564, '1990-10-22');

-- --------------------------------------------------------

--
-- Structure de la table `loger`
--

CREATE TABLE `loger` (
  `idEtudiant` int(11) NOT NULL,
  `idChambre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `loger`
--

INSERT INTO `loger` (`idEtudiant`, `idChambre`) VALUES
(23, 1),
(35, 4),
(36, 6);

-- --------------------------------------------------------

--
-- Structure de la table `nonBoursier`
--

CREATE TABLE `nonBoursier` (
  `idEtudiant` int(11) NOT NULL,
  `adresseNB` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `nonBoursier`
--

INSERT INTO `nonBoursier` (`idEtudiant`, `adresseNB`) VALUES
(1, 'parcelles'),
(25, 'Guediawaye'),
(26, 'thiaroye'),
(37, 'pikine');

-- --------------------------------------------------------

--
-- Structure de la table `typeBourse`
--

CREATE TABLE `typeBourse` (
  `idType` int(11) NOT NULL,
  `libelle` varchar(20) NOT NULL,
  `montant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typeBourse`
--

INSERT INTO `typeBourse` (`idType`, `libelle`, `montant`) VALUES
(1, 'Entiere', 40000),
(2, 'demi', 20000);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `loginU` varchar(15) NOT NULL,
  `pwdU` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `tel` int(11) NOT NULL,
  `adresse` varchar(30) NOT NULL,
  `profil` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUser`, `loginU`, `pwdU`, `nom`, `tel`, `adresse`, `profil`) VALUES
(1, 'admin', 'admin', 'Admin Principal', 778083808, 'fadia', 'Administrateur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `batiment`
--
ALTER TABLE `batiment`
  ADD PRIMARY KEY (`idBat`),
  ADD UNIQUE KEY `nomBat` (`nomBat`);

--
-- Index pour la table `boursier`
--
ALTER TABLE `boursier`
  ADD PRIMARY KEY (`idEtudiant`),
  ADD KEY `boursier_ibfk_2` (`idType`);

--
-- Index pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD PRIMARY KEY (`idChambre`),
  ADD UNIQUE KEY `batiChambre` (`num`,`idBat`),
  ADD KEY `chambre_ibfk_1` (`idBat`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`idEtudiant`),
  ADD UNIQUE KEY `matricule` (`matEtudiant`);

--
-- Index pour la table `loger`
--
ALTER TABLE `loger`
  ADD PRIMARY KEY (`idEtudiant`),
  ADD KEY `loger_ibfk_2` (`idChambre`);

--
-- Index pour la table `nonBoursier`
--
ALTER TABLE `nonBoursier`
  ADD PRIMARY KEY (`idEtudiant`);

--
-- Index pour la table `typeBourse`
--
ALTER TABLE `typeBourse`
  ADD PRIMARY KEY (`idType`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `loginU` (`loginU`),
  ADD UNIQUE KEY `tel` (`tel`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `batiment`
--
ALTER TABLE `batiment`
  MODIFY `idBat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `chambre`
--
ALTER TABLE `chambre`
  MODIFY `idChambre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `idEtudiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `typeBourse`
--
ALTER TABLE `typeBourse`
  MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `boursier`
--
ALTER TABLE `boursier`
  ADD CONSTRAINT `boursier_ibfk_1` FOREIGN KEY (`idEtudiant`) REFERENCES `etudiant` (`idEtudiant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `boursier_ibfk_2` FOREIGN KEY (`idType`) REFERENCES `typeBourse` (`idType`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD CONSTRAINT `chambre_ibfk_1` FOREIGN KEY (`idBat`) REFERENCES `batiment` (`idBat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `loger`
--
ALTER TABLE `loger`
  ADD CONSTRAINT `loger_ibfk_1` FOREIGN KEY (`idEtudiant`) REFERENCES `boursier` (`idEtudiant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loger_ibfk_2` FOREIGN KEY (`idChambre`) REFERENCES `chambre` (`idChambre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `nonBoursier`
--
ALTER TABLE `nonBoursier`
  ADD CONSTRAINT `nonBoursier_ibfk_1` FOREIGN KEY (`idEtudiant`) REFERENCES `etudiant` (`idEtudiant`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
