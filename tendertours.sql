-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Sze 17. 13:51
-- Kiszolgáló verziója: 10.4.22-MariaDB
-- PHP verzió: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `tendertours`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `attractions`
--

CREATE TABLE `attractions` (
  `attraction_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `lattitude` varchar(16) NOT NULL,
  `longitude` varchar(16) NOT NULL,
  `num_of_visitors` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `popular` double NOT NULL,
  `description` varchar(255) NOT NULL,
  `address` varchar(64) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `attractions`
--

INSERT INTO `attractions` (`attraction_id`, `name`, `lattitude`, `longitude`, `num_of_visitors`, `org_id`, `city_id`, `popular`, `description`, `address`, `category_id`, `image`) VALUES
(44, 'Parliament', '47.507121', '19.0430941', 22, 38, 23, 5, 'The Parliament is one of Budapest\'s best-known public buildings, the seat of the Hungarian Parliament and some of its institutions (such as the Parliament Library). It is located in the V. district of Budapest, on the left bank of the Danube, at Kossuth L', 'Kossuth Lajos Tér 1-3', 6, 'pest.jpg'),
(45, 'Saint Stephan Basilica', '47.5033372', '19.0492903', 1, 38, 23, 3, 'The co-cathedral of St. Stephen\'s Basilica (German: St.-Stephans-Basilika, also known as Lipótváros parish church) is a Neo-Renaissance style basilica minor cathedral in Budapest\'s 5th district, Lipótváros. This is one of the most significant church build', 'Szent István Tér 1.', 2, 'basilica.jpg'),
(46, 'Fisherman\'s Bastion', '47.5016102', '19.0361878', 1, 38, 23, 0, 'The Fisherman\'s Bastion is one of Budapest\'s best-known monuments, located in the Buda Castle, in the 1st district of Budapest. It is one of the most important tourist attractions due to the unique panorama of Budapest that can be seen from the neo-Roman ', 'Szentháromság tér', 5, 'bastya.jpg'),
(47, 'Kossuth Square', '47.5062806', '19.0474172', 1, 38, 23, 0, 'Kossuth Lajos Square', 'Kossuth Lajos Tér', 4, 'kossuth.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `categories`
--

INSERT INTO `categories` (`category_id`, `category`) VALUES
(1, 'Museum'),
(2, 'Curch'),
(3, 'Park'),
(4, 'Square'),
(5, 'Statue'),
(6, 'City hall'),
(7, 'Market'),
(8, 'Bus station'),
(9, 'Train station');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `organization_name` varchar(32) NOT NULL,
  `city_name` varchar(32) NOT NULL,
  `longitude` float NOT NULL,
  `lattitude` float NOT NULL,
  `checked` int(11) DEFAULT NULL,
  `image` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `cities`
--

INSERT INTO `cities` (`city_id`, `organization_name`, `city_name`, `longitude`, `lattitude`, `checked`, `image`) VALUES
(23, '', 'Budapest', 18.9655, 47.4811, NULL, 'Budapest_8657_4646_pest.jpg'),
(24, '', 'Wien', 16.2153, 48.2206, NULL, 'Wien_7999_1528_wien.jpg'),
(25, '', 'Novi Sad', 19.767, 45.2714, NULL, 'Novi Sad_7314_3479_novi sad.jpg'),
(26, '', 'Subotica', 19.5093, 46.0935, NULL, 'Subotica_5953_5064_szabadka.jpg'),
(27, '', 'Szeged', 19.9757, 46.2327, NULL, 'Szeged_5409_9518_szeged.jpg'),
(28, '', 'Praga', 14.3008, 50.0596, NULL, 'Praga_2881_2130_praga.jpg'),
(29, '', 'Bratislava', 16.9511, 48.1357, NULL, 'Bratislava_2276_5124_bratislava.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `evaluation` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attraction_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `comments`
--

INSERT INTO `comments` (`comment_id`, `comment`, `evaluation`, `user_id`, `attraction_id`, `date`) VALUES
(29, 'Beautiful :)', 5, 11, 44, '2023-09-16 09:12:14'),
(30, 'It\'s beautiful and worth seeing.', 3, 11, 45, '2023-09-16 09:16:05');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attraction_id` int(11) NOT NULL,
  `complaint` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `complaints`
--

INSERT INTO `complaints` (`complaint_id`, `user_id`, `attraction_id`, `complaint`, `date`, `status`) VALUES
(22, 41, 44, 'Opening hours were not posted', '2023-09-15', 1),
(23, 41, 44, 'It was dirty.', '2023-09-15', 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(16) NOT NULL,
  `discount` varchar(11) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `coupon_expire` date NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `user_id`, `code`, `discount`, `phone`, `coupon_expire`, `active`) VALUES
(3, 11, '010142', '25', '+381611105375', '0000-00-00', 1),
(6, 2, '625156', '50', '+381606561706', '2023-10-15', 1),
(7, 2, '577048', '50', '+381606561706', '2023-10-15', 1),
(8, 43, '438518', '50', '+381606561706', '2023-10-15', 1),
(9, 41, '928188', '50', '0606561706', '2023-10-16', 1),
(10, 41, '412888', '50', '0606561706', '2023-10-16', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `favourites`
--

CREATE TABLE `favourites` (
  `favorite_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attraction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `favourites`
--

INSERT INTO `favourites` (`favorite_id`, `user_id`, `attraction_id`) VALUES
(17, 11, 44);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `organizations`
--

CREATE TABLE `organizations` (
  `org_id` int(11) NOT NULL,
  `org_name` varchar(64) NOT NULL,
  `city_id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `phone` varchar(64) NOT NULL,
  `address` varchar(128) NOT NULL,
  `description` varchar(255) NOT NULL,
  `active` int(11) DEFAULT NULL,
  `permission` int(11) NOT NULL DEFAULT 3,
  `status` int(11) NOT NULL,
  `reg_expire` datetime NOT NULL,
  `new_password` varchar(128) NOT NULL,
  `new_password_expire` datetime NOT NULL,
  `code` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `organizations`
--

INSERT INTO `organizations` (`org_id`, `org_name`, `city_id`, `username`, `email`, `password`, `phone`, `address`, `description`, `active`, `permission`, `status`, `reg_expire`, `new_password`, `new_password_expire`, `code`) VALUES
(38, 'BudaPest', 23, 'budapest', 'budapest@info.com', '$2y$10$kibaG1JPUlJxTB9bQIbz6.DSNPhv3mYBYqCQn2rluKSOoJE6vlQBy', '0606561706', 'Fő utca 4.', 'This tourist organization deals with Budapest attractions.', 1, 3, 1, '2023-09-16 00:00:00', '', '0000-00-00 00:00:00', 2147483647),
(40, 'PragaOrganization', 28, 'praga', 'praga@info-org.com', '$2y$10$qnswHjRKffD51Oofg20dZ.vcLwqctCAhI3g9w1iY6FyetsS4HazpW', '0606561706', 'Karlovska 123.', 'This tourist organization deals with Praga attractions.', 1, 3, 1, '2023-09-16 00:00:00', '', '0000-00-00 00:00:00', 2147483647),
(41, 'SuboticaInfo', 26, 'subotica', 'subotica-info@info.rs', '$2y$10$gjrznGrcA4AzkUNvdWpBDOHVn5b2Mplm8YbiOdv11d8NKoJz8GmM6', '0606561706', 'Tito Marsal 15.', 'This tourist organization deals with Subotica attractions.', 1, 3, 1, '2023-09-16 00:00:00', '', '0000-00-00 00:00:00', 2147483647),
(43, 'Wiener', 24, 'wien', 'wien-info@info.at', '$2y$10$Na651YyHfc9J23Q.qpKVouhTF52nuWvop.pQwfmwmFUSplblOMDpu', '0606561706', 'Bau Starsse 147.', 'This tourist organization deals with \n Wien attractions.', 1, 3, 1, '2023-09-16 00:00:00', '', '0000-00-00 00:00:00', 2147483647);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tours`
--

CREATE TABLE `tours` (
  `tour_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `tours`
--

INSERT INTO `tours` (`tour_id`, `date`, `user_id`, `city_id`) VALUES
(44, '2023-09-28 20:01:00', 11, 23),
(45, '2023-09-27 17:02:00', 11, 23);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tour_attraction`
--

CREATE TABLE `tour_attraction` (
  `tour_attraction` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `attraction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `tour_attraction`
--

INSERT INTO `tour_attraction` (`tour_attraction`, `tour_id`, `attraction_id`) VALUES
(63, 44, 45),
(64, 44, 47),
(65, 45, 44),
(66, 45, 46);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `new_password` varchar(64) DEFAULT NULL,
  `address` varchar(64) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `permission` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `code` varchar(40) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `working_at` varchar(64) DEFAULT NULL,
  `reg_expire` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `email`, `password`, `new_password`, `address`, `phone`, `permission`, `active`, `code`, `status`, `working_at`, `reg_expire`) VALUES
(2, 'Rózsa Attila', 'atesz', 'rattila994@gmail.com', '$2y$10$GR2MLW3yQTN3ZbZT1rhQBuK3Ij/lzAM5wgX5r92iZdFPvY16MpEjS', '', 'Partizanska 8.', '', 2, 1, '', 0, '0', '0000-00-00 00:00:00'),
(7, 'Admin', 'admin', 'tincsy1501@gmail.com', '$2y$10$8cZlp.TFqlAIxMOWn3ccuuC7gFxLlDZznIzSQ8vP/Bo.fMHS3PfUS', '', 'Partizanska 8.', '', 1, 1, '2911948304506651884843540273251696365345', 0, '0', '2023-02-20 00:00:00'),
(11, 'feri', 'feri', 'tincsy2001@gmail.com', '$2y$10$8cZlp.TFqlAIxMOWn3ccuuC7gFxLlDZznIzSQ8vP/Bo.fMHS3PfUS', '', 'Bolmanska 12.', '', 2, 1, '58301881926421600947', 0, '0', '2023-05-09 00:00:00'),
(41, 'Krisztina Kocsis', 'kriszta', 'kriszta2001@gmail.com', '$2y$10$vuzqBLL98FUcygEX5OCcruZHlfZNHxZBnX3jyy3smr/oiR8wNlSmu', NULL, 'Gavrila Principa 10', '06606561706', 4, 1, NULL, NULL, '44', '2023-09-16 00:00:00'),
(43, 'John Doe', 'john', 'tincsy01@gmail.com', '$2y$10$2y7AyGqf1VdWbwtRQA8YQewFWXOv3aFtsniFt1YrAawLug1KspaPq', NULL, 'Bolmanska 12', '0606561706', 2, 1, '', NULL, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `visitors`
--

CREATE TABLE `visitors` (
  `visitor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attraction_id` int(11) NOT NULL,
  `num_of_visitors` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `visitors`
--

INSERT INTO `visitors` (`visitor_id`, `user_id`, `attraction_id`, `num_of_visitors`, `date`, `description`) VALUES
(23, 41, 44, 6, '2023-09-15', ''),
(24, 41, 44, 15, '2023-08-23', '');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `attractions`
--
ALTER TABLE `attractions`
  ADD PRIMARY KEY (`attraction_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `org_id` (`org_id`),
  ADD KEY `category_id` (`category_id`);

--
-- A tábla indexei `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- A tábla indexei `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- A tábla indexei `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `attraction_id` (`attraction_id`);

--
-- A tábla indexei `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `attraction_id` (`attraction_id`);

--
-- A tábla indexei `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`org_id`),
  ADD KEY `city_id` (`city_id`);

--
-- A tábla indexei `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`tour_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `tour_attraction`
--
ALTER TABLE `tour_attraction`
  ADD PRIMARY KEY (`tour_attraction`),
  ADD KEY `attraction_id` (`attraction_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- A tábla indexei `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`visitor_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `attraction_id` (`attraction_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `attractions`
--
ALTER TABLE `attractions`
  MODIFY `attraction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT a táblához `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT a táblához `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT a táblához `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT a táblához `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `favourites`
--
ALTER TABLE `favourites`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT a táblához `organizations`
--
ALTER TABLE `organizations`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT a táblához `tours`
--
ALTER TABLE `tours`
  MODIFY `tour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT a táblához `tour_attraction`
--
ALTER TABLE `tour_attraction`
  MODIFY `tour_attraction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT a táblához `visitors`
--
ALTER TABLE `visitors`
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `attractions`
--
ALTER TABLE `attractions`
  ADD CONSTRAINT `attractions_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attractions_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `organizations` (`org_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attractions_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`attraction_id`) REFERENCES `attractions` (`attraction_id`);

--
-- Megkötések a táblához `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `coupons_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favourites_ibfk_2` FOREIGN KEY (`attraction_id`) REFERENCES `attractions` (`attraction_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `organizations`
--
ALTER TABLE `organizations`
  ADD CONSTRAINT `organizations_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `tours_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tours_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tours_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `tour_attraction`
--
ALTER TABLE `tour_attraction`
  ADD CONSTRAINT `tour_attraction_ibfk_1` FOREIGN KEY (`attraction_id`) REFERENCES `attractions` (`attraction_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tour_attraction_ibfk_2` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `visitors`
--
ALTER TABLE `visitors`
  ADD CONSTRAINT `visitors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visitors_ibfk_2` FOREIGN KEY (`attraction_id`) REFERENCES `attractions` (`attraction_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
