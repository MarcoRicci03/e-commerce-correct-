-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mag 24, 2022 alle 08:16
-- Versione del server: 8.0.26
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_riccimarco`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `1telegram_users`
--

CREATE TABLE IF NOT EXISTS `1telegram_users` (
  `username_id` int NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `id_chat` int NOT NULL,
  PRIMARY KEY (`username_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `1telegram_users`
--

INSERT INTO `1telegram_users` (`username_id`, `lat`, `lng`, `id_chat`) VALUES
(283960706, 45.7395, 9.1291, 283960706);

-- --------------------------------------------------------

--
-- Struttura della tabella `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id_address` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `address` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `postal_code` int NOT NULL,
  PRIMARY KEY (`id_address`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `addresses`
--

INSERT INTO `addresses` (`id_address`, `id_user`, `address`, `city`, `postal_code`) VALUES
(3, 2, 'Via Fiammenghini', 'Cantù', 22063),
(4, 1, 'Via Rizzi', 'Milano', 22045);

-- --------------------------------------------------------

--
-- Struttura della tabella `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id_article` int NOT NULL AUTO_INCREMENT,
  `price` float NOT NULL,
  `amount` int NOT NULL,
  `average_stars` float NOT NULL,
  `id_category` int NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'https://www.ammotor.it/wp-content/uploads/2017/12/default_image_01-1024x1024-570x321.png	',
  PRIMARY KEY (`id_article`),
  KEY `id_category` (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dump dei dati per la tabella `articles`
--

INSERT INTO `articles` (`id_article`, `price`, `amount`, `average_stars`, `id_category`, `name`, `description`, `image`) VALUES
(1, 499, 10, 4.3, 2, 'Playstation 5', 'é una Playstation 5', 'https://www.ammotor.it/wp-content/uploads/2017/12/default_image_01-1024x1024-570x321.png	'),
(2, 1299, 10, 4.7, 7, 'Iphone 13 pro max', 'é un Iphone 13 pro max', 'https://m.media-amazon.com/images/I/61BgOOthLUL._AC_SX679_.jpg'),
(3, 123, 30, 5, 7, 'Air Pods (Seconda generazione)', 'sono delle Air Pods (Seconda generazione)', 'https://m.media-amazon.com/images/I/7120GgUKj3L._AC_SX679_.jpg'),
(4, 20, 100, 4.1, 1, 'Cover Iphone 13 pro max', 'é una Cover Iphone 13 pro max', 'https://m.media-amazon.com/images/I/61ephkFZyAL._AC_SX522_.jpg'),
(10, 10999, 2, 5, 5, 'SAMSUNG Neo QLED 8K QE85QN900B S', 'é un SAMSUNG Neo QLED 8K QE85QN900B S', 'https://m.media-amazon.com/images/I/513EBj0wcjL._AC_UL320_.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `id_cart` int NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id_cart`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dump dei dati per la tabella `carts`
--

INSERT INTO `carts` (`id_cart`, `date`, `closed`, `id_user`) VALUES
(4, '2022-04-19 14:44:39', 0, 2),
(5, '2022-04-19 17:37:23', 0, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `categories`
--

INSERT INTO `categories` (`id_category`, `name`) VALUES
(1, 'Accessori'),
(2, 'Console e Videogiochi'),
(5, 'Tv e Cinema'),
(6, 'Informatica'),
(7, 'Telefonia');

-- --------------------------------------------------------

--
-- Struttura della tabella `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id_comment` int NOT NULL AUTO_INCREMENT,
  `text` text,
  `stars` enum('1','2','3','4','5') NOT NULL,
  `id_user` int NOT NULL,
  `id_article` int NOT NULL,
  PRIMARY KEY (`id_comment`),
  KEY `id_user` (`id_user`),
  KEY `id_article` (`id_article`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `contain`
--

CREATE TABLE IF NOT EXISTS `contain` (
  `id_contain` int NOT NULL AUTO_INCREMENT,
  `amount` int DEFAULT NULL,
  `id_cart` int NOT NULL,
  `id_article` int NOT NULL,
  PRIMARY KEY (`id_contain`),
  KEY `id_article` (`id_article`),
  KEY `id_cart` (`id_cart`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dump dei dati per la tabella `contain`
--

INSERT INTO `contain` (`id_contain`, `amount`, `id_cart`, `id_article`) VALUES
(16, 1, 4, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id_order` int NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `price` float DEFAULT NULL,
  `id_cart` int NOT NULL,
  `id_address` int DEFAULT NULL,
  PRIMARY KEY (`id_order`),
  KEY `id_cart` (`id_cart`),
  KEY `orders_ibfk_2` (`id_address`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `mail` varchar(32) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `pass` char(32) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `surname` varchar(32) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id_user`, `mail`, `username`, `pass`, `name`, `surname`, `admin`) VALUES
(1, 'admin@admin.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', 1),
(2, 'marco@gmail.com', 'marco.03', 'f5888d0bb58d611107e11f7cbc41c97a', 'Marco', 'Ricci', 0);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Limiti per la tabella `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`);

--
-- Limiti per la tabella `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Limiti per la tabella `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id_article`);

--
-- Limiti per la tabella `contain`
--
ALTER TABLE `contain`
  ADD CONSTRAINT `contain_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id_article`),
  ADD CONSTRAINT `contain_ibfk_2` FOREIGN KEY (`id_cart`) REFERENCES `carts` (`id_cart`);

--
-- Limiti per la tabella `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_cart`) REFERENCES `carts` (`id_cart`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id_address`) REFERENCES `addresses` (`id_address`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
