-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 14 mai 2019 à 22:52
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `shop`
--

-- --------------------------------------------------------

--
-- Structure de la table `bill`
--

DROP TABLE IF EXISTS `bill`;
CREATE TABLE IF NOT EXISTS `bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `addingDate` datetime NOT NULL,
  `updatingDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `title`, `brand`, `content`, `price`, `addingDate`, `updatingDate`) VALUES
(38, 'tgtg', 'gtgtg', '<p>14141414141414</p>', '50', '2019-03-13 17:46:40', '2019-03-13 17:46:40'),
(37, 'vrdvdvrdv', 'vrdvrdvrdv', '<p>rvdvrdvrdvrdvrdvrdvrdvrdvrdvrdvrdvrdvrdvrdvrdvrd</p>', '33', '2019-03-13 17:46:19', '2019-03-13 17:46:19'),
(36, 'btfbft', 'btfbft', '<p>btffbtfbtfbtfbtfbtfbtfbt</p>', '15', '2019-03-13 17:38:05', '2019-03-13 17:38:05'),
(39, 'Colmar Originals / Veste Blouson', 'Colmar', '<p><span style=\"color: #212121; font-family: arial, sans-serif;\"><span style=\"font-size: 16px; white-space: pre-wrap;\">Veste matelass&eacute;e &agrave; capuche.</span></span></p>\r\n<p><span style=\"color: #212121; font-family: arial, sans-serif;\"><span style=\"font-size: 16px; white-space: pre-wrap;\">R&eacute;alis&eacute; en polyester.</span></span></p>\r\n<p><span style=\"color: #212121; font-family: arial, sans-serif;\"><span style=\"font-size: 16px; white-space: pre-wrap;\">Bleu.</span></span></p>', '230', '2019-04-10 23:57:37', '2019-04-10 23:57:37');

-- --------------------------------------------------------

--
-- Structure de la table `shippingadress`
--

DROP TABLE IF EXISTS `shippingadress`;
CREATE TABLE IF NOT EXISTS `shippingadress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `userId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `postalCode` varchar(50) NOT NULL,
  `city` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `shippingadress`
--

INSERT INTO `shippingadress` (`id`, `title`, `userId`, `name`, `adress`, `postalCode`, `city`) VALUES
(1, '', 6, 'Didier Laurent', '1, allÃ©e des Belles Feuilles', '75016', 'Paris'),
(2, 'Mon adresse par dÃ©fault', 11, 'etienn j', '1, allÃ©e du Nocher', '7896', 'trappes'),
(3, 'Mon adresse par dÃ©fault', 12, 'Thomas Durand', '1, allÃ©e du puit', '93456', 'Mesnil');

-- --------------------------------------------------------

--
-- Structure de la table `shoporder`
--

DROP TABLE IF EXISTS `shoporder`;
CREATE TABLE IF NOT EXISTS `shoporder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `userShippingAdressId` int(11) NOT NULL,
  `billingAdressSameAs` tinyint(1) NOT NULL,
  `token` varchar(255) NOT NULL,
  `totalPrice` int(50) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `shoporder`
--

INSERT INTO `shoporder` (`id`, `userId`, `userShippingAdressId`, `billingAdressSameAs`, `token`, `totalPrice`, `date`) VALUES
(14, 12, 3, 1, 'tok_1EZiA7KiarMbTO171MDMeiR5', 15, '2019-05-13');

-- --------------------------------------------------------

--
-- Structure de la table `shoporderproduct`
--

DROP TABLE IF EXISTS `shoporderproduct`;
CREATE TABLE IF NOT EXISTS `shoporderproduct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `quantity` int(100) NOT NULL,
  `price` int(200) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `shoporderproduct`
--

INSERT INTO `shoporderproduct` (`id`, `productId`, `orderId`, `quantity`, `price`, `date`) VALUES
(2, 36, 14, 1, 15, '2019-05-13');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `email`, `admin`) VALUES
(6, 'didier78', '$2y$10$wPlx4QTSp3RDOQWD352JJOlE9mY.K9FHDPdmc9BBwS7hxX6wWdICO', 'didier78@yopmail.fr', 0),
(7, 'thibaut', '$2y$10$qqPDzq2Nwp6BnH2uUpDbLOHrCFXPjCA1Tgra9K7bxeP3wJSfK7bAC', 'thibaut@hotmail.fr', 0),
(5, 'marc', '$2y$10$3WNeGJI9aUFpon2wOa6zk.pdCg7RmGc3EtuTrvBasLmlI1Y86qwLe', 'marc@hotmail.fr', 0),
(10, 'etienne', '$2y$10$vFJV9.lBjtNXy84295z5RuuAOQeQAVEgUB8RVkGX0W6CTseSRHc2O', 'etienne@hotmail.fr', 0),
(11, 'etienne42', '$2y$10$k1bnW0CKQ8i.MW8R0IVT0OQWtpMSMCO.LG1Bc.aSvtsoAuQ21CxcW', 'etienne42@hotmail.fr', 0),
(12, 'thomas', '$2y$10$JwmtKCUamAJFWW.9g78hQuk9HrnSrLG22UuRACpgJneNK.Hjta36G', 'thomas@gmail.com', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
