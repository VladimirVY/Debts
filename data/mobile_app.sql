-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 05 2013 г., 17:55
-- Версия сервера: 5.5.32
-- Версия PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `mobile_app`
--
CREATE DATABASE IF NOT EXISTS `mobile_app` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mobile_app`;

-- --------------------------------------------------------

--
-- Структура таблицы `debts`
--

CREATE TABLE IF NOT EXISTS `debts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creditor_id` int(11) NOT NULL,
  `deptor_id` int(11) NOT NULL,
  `amaount_initial` int(11) NOT NULL,
  `amount_current` int(11) NOT NULL,
  `debt_date` date NOT NULL,
  `status` text NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `vk_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
