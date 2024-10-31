-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 31 2024 г., 09:26
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `nevatrip`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `event_date` varchar(10) DEFAULT NULL,
  `ticket_adult_price` int(11) DEFAULT NULL,
  `ticket_adult_quantity` int(11) DEFAULT NULL,
  `ticket_kid_price` int(11) DEFAULT NULL,
  `ticket_kid_quantity` int(11) DEFAULT NULL,
  `barcode` varchar(120) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `equal_price` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `event_id`, `event_date`, `ticket_adult_price`, `ticket_adult_quantity`, `ticket_kid_price`, `ticket_kid_quantity`, `barcode`, `user_id`, `equal_price`, `created`) VALUES
(5, 123, '2024-10-28', 100, 2, 50, 3, '0783649121888182', 15, 350, '2024-10-28 19:33:44'),
(6, 123, '2024-10-28', 100, 2, 50, 3, '0559132537377798', 15, 350, '2024-10-28 19:35:34'),
(7, 15, '2024-11-15', 500, 3, 300, 5, '5996773004745171', 16, 3000, '2024-10-31 09:17:50'),
(8, 16, '2024-11-15', 1000, 3, 300, 5, '6705878864440168', 20, 4500, '2024-10-31 09:19:05'),
(9, 25, '2024-11-29', 800, 2, 300, 2, '8886399768362232', 20, 2200, '2024-10-31 09:20:34');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
