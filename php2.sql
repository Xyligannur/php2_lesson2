-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июл 05 2015 г., 13:54
-- Версия сервера: 5.6.24
-- Версия PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `php2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lesson2`
--

CREATE TABLE IF NOT EXISTS `lesson2` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `short` text NOT NULL,
  `content` longtext NOT NULL,
  `img` varchar(255) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lesson2`
--

INSERT INTO `lesson2` (`id`, `title`, `short`, `content`, `img`, `time`) VALUES
(1, 'вапролд', 'смитьбю', 'ывапролд', '', '2015-07-05 10:55:06'),
(2, 'йцукенгш', 'ячсмить', 'фывапрол', '', '2015-07-05 11:34:13'),
(3, 'фывапр', 'фывапр', 'ывапр', '', '2015-07-05 11:38:42'),
(4, 'вапрол', 'вапролд', 'вапролд', '', '2015-07-05 11:38:52'),
(5, 'вапрол', 'вапрол', 'вапрол', '', '2015-07-05 11:40:50'),
(6, 'цукенгш', 'ячсми', 'ывапрол', '', '2015-07-05 11:47:56'),
(7, 'фывапролдж', 'вапролд', 'ывапролдж', '', '2015-07-05 11:48:51'),
(8, 'йцукенгшщз', 'ячсмить', 'фывапрол', '', '2015-07-05 11:50:46'),
(9, 'йцукенгшщ', 'ячсмить', 'фывапролд', '', '2015-07-05 11:52:34');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lesson2`
--
ALTER TABLE `lesson2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lesson2`
--
ALTER TABLE `lesson2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
