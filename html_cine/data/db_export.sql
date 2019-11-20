-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql_db
-- Tiempo de generación: 20-11-2019 a las 21:08:24
-- Versión del servidor: 5.7.27
-- Versión de PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `moviepass`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cinemas`
--

CREATE TABLE `Cinemas` (
  `cinema_id` int(11) NOT NULL,
  `cinema_name` varchar(30) NOT NULL,
  `cinema_address` varchar(30) NOT NULL,
  `cinema_capacity` int(11) DEFAULT NULL,
  `cinema_ticketValue` int(11) DEFAULT NULL,
  `cinema_available` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Cinemas`
--

INSERT INTO `Cinemas` (`cinema_id`, `cinema_name`, `cinema_address`, `cinema_capacity`, `cinema_ticketValue`, `cinema_available`) VALUES
(2, 'Karo!', 'address test', 3, 100, 1),
(3, 'El rulo proyecciones', 'independencia 1234', 10, 150, 1),
(4, 'El america', 'Luro', 1000, 1, 1),
(5, 'Super cinema', 'La calle loca 1234', 1, 1000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Counts`
--

CREATE TABLE `Counts` (
  `count_id` int(11) NOT NULL,
  `count_name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Genres`
--

CREATE TABLE `Genres` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Genres`
--

INSERT INTO `Genres` (`genre_id`, `genre_name`) VALUES
(12, 'Adventure'),
(14, 'Fantasy'),
(16, 'Animation'),
(18, 'Drama'),
(27, 'Horror'),
(28, 'Action'),
(35, 'Comedy'),
(36, 'History'),
(37, 'Western'),
(53, 'Thriller'),
(80, 'Crime'),
(99, 'Documentary'),
(878, 'Science Fiction'),
(9648, 'Mystery'),
(10402, 'Music'),
(10749, 'Romance'),
(10751, 'Family'),
(10752, 'War'),
(10770, 'TV Movie');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Genres_on_Movies`
--

CREATE TABLE `Genres_on_Movies` (
  `movie_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Genres_on_Movies`
--

INSERT INTO `Genres_on_Movies` (`movie_id`, `genre_id`) VALUES
(420809, 12),
(454640, 12),
(480105, 12),
(568012, 12),
(420809, 14),
(481084, 14),
(515195, 14),
(454640, 16),
(481084, 16),
(568012, 16),
(475557, 18),
(480105, 18),
(511987, 18),
(578189, 18),
(338967, 27),
(474350, 27),
(480105, 27),
(501170, 27),
(511987, 27),
(338967, 28),
(453405, 28),
(511987, 28),
(568012, 28),
(578189, 28),
(338967, 35),
(454640, 35),
(481084, 35),
(515195, 35),
(453405, 53),
(475557, 53),
(480105, 53),
(511987, 53),
(475557, 80),
(578189, 80),
(515195, 10402),
(515195, 10749),
(420809, 10751),
(454640, 10751),
(481084, 10751);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Movies`
--

CREATE TABLE `Movies` (
  `movie_id` int(11) NOT NULL,
  `movie_image` varchar(100) NOT NULL,
  `movie_language` varchar(15) NOT NULL,
  `movie_title` varchar(30) NOT NULL,
  `movie_runtime` int(11) NOT NULL,
  `movie_description` varchar(500) DEFAULT NULL,
  `movie_available` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Movies`
--

INSERT INTO `Movies` (`movie_id`, `movie_image`, `movie_language`, `movie_title`, `movie_runtime`, `movie_description`, `movie_available`) VALUES
(338967, '/pIcV8XXIIvJCbtPoxF9qHMKdRr2.jpg', 'English', 'Zombieland: Double Tap', 99, 'The group will face a new zombie threat as a new breed of zombie has developed. This new super-zombie type is faster, bigger, and stronger than the previous strain of zombies and harder to kill. These super-zombies have started grouping up into a horde going from city to city leaving a path of destruction behind them.', 1),
(420809, '/tBuabjEqxzoUBHfbyNbd8ulgy5j.jpg', 'English', 'Maleficent: Mistress of Evil', 118, 'Maleficent and her goddaughter Aurora begin to question the complex family ties that bind them as they are pulled in different directions by impending nuptials, unexpected allies, and dark new forces at play.', 1),
(453405, '/uTALxjQU8e1lhmNjP9nnJ3t2pRU.jpg', 'English', 'Gemini Man', 117, 'Henry Brogen, an aging assassin tries to get out of the business but finds himself in the ultimate battle: fighting his own clone who is 25 years younger than him and at the peak of his abilities.', 1),
(454640, '/ebe8hJRCwdflNQbUjRrfmqtUiNi.jpg', 'English', 'The Angry Birds Movie 2', 96, 'Red, Chuck, Bomb and the rest of their feathered friends are surprised when a green pig suggests that they put aside their differences and unite to fight a common threat. Aggressive birds from an island covered in ice are planning to use an elaborate weapon to destroy the fowl and swine.', 1),
(474350, '/zfE0R94v1E8cuKAerbskfD3VfUt.jpg', 'English', 'It Chapter Two', 169, '27 years after overcoming the malevolent supernatural entity Pennywise, the former members of the Losers\' Club, who have grown up and moved away from Derry, are brought back together by a devastating phone call.', 1),
(475557, '/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg', 'English', 'Joker', 122, 'During the 1980s, a failed stand-up comedian is driven insane and turns to a life of crime and chaos in Gotham City while becoming an infamous psychopathic crime figure.', 1),
(480105, '/g4z7mDmJmx23vsVg6XNWcnXb6gc.jpg', 'English', '47 Meters Down: Uncaged', 89, 'A group of backpackers diving in a ruined underwater city discover that they have stumbled into the territory of the ocean\'s deadliest shark species.', 1),
(481084, '/uaXNjRkDdjfxfVuKHo25wkA6CiA.jpg', 'English', 'The Addams Family', 86, 'The Addams family\'s lives begin to unravel when they face-off against a treacherous, greedy crafty reality-TV host while also preparing for their extended family to arrive for a major celebration.', 1),
(501170, '/p69QzIBbN06aTYqRRiCOY1emNBh.jpg', 'English', 'Doctor Sleep', 152, 'A traumatized, alcoholic Dan Torrance meets Abra, a kid who also has the ability to \"shine.\" He tries to protect her from the True Knot, a cult who\'s goal is to feed off people like them in order to remain immortal.', 1),
(511987, '/9kOtMOUa5HrOiIG2Z9Anv7M8AbY.jpg', 'English', 'Crawl', 88, 'When a huge hurricane hits her hometown in Florida, Haley ignores evacuation orders to look for her father. After finding him badly wounded, both are trapped by the flood. With virtually no time to escape the storm, they discover that rising water levels are the least of their problems.', 1),
(515195, '/1rjaRIAqFPQNnMtqSMLtg0VEABi.jpg', 'FranÃ§ais', 'Yesterday', 116, 'Jack Malik is a struggling singer-songwriter in an English seaside town whose dreams of fame are rapidly fading, despite the fierce devotion and support of his childhood best friend, Ellie. After a freak bus accident during a mysterious global blackout, Jack wakes up to discover that he\'s the only person on Earth who can remember The Beatles.', 1),
(568012, '/4E2lyUGLEr3yH4q6kJxPkQUhX7n.jpg', 'æ—¥æœ¬èªž', 'One Piece: Stampede', 101, 'One Piece: Stampede is a stand-alone film that celebrates the anime\'s 20th Anniversary and takes place outside the canon of the \"One Piece\" TV series. Monkey D. Luffy and his Straw Hat pirate crew are invited to a massive Pirate Festival that brings many of the most iconic characters from throughout the franchise to participate in competition with the Straw Hats to find Roger\'s treasure. It also pits the Straw Hats against a new enemy named Bullet, a former member of Roger\'s crew.', 1),
(578189, '/fjmMu9fpqMMF17mCyLhNfkagKB0.jpg', 'English', 'Black and Blue', 109, 'Exposure follows a rookie Detroit African-American female cop who stumbles upon corrupt officers who are murdering a drug dealer, an incident captured by her body cam. They pursue her through the night in an attempt to destroy the footage, but to make matters worse, they\'ve tipped off a criminal gang that she\'s responsible for the dealer\'s death.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Payments`
--

CREATE TABLE `Payments` (
  `payment_id` int(11) NOT NULL,
  `payment_auth_code` int(11) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_amount` float DEFAULT NULL,
  `count_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Profiles`
--

CREATE TABLE `Profiles` (
  `profile_id` int(11) NOT NULL,
  `profile_apellido` varchar(20) NOT NULL,
  `profile_nombre` varchar(20) NOT NULL,
  `profile_dni` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Profiles`
--

INSERT INTO `Profiles` (`profile_id`, `profile_apellido`, `profile_nombre`, `profile_dni`) VALUES
(14, 'Cliente', 'Gaspar', '1234567'),
(15, 'admin', 'Gaspar', '12345678'),
(16, 'saggddg', 'gadgad', '531351351'),
(17, 'ute', 'papa', '12345678'),
(18, 'Chaman', 'El', '123456789');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Purchases`
--

CREATE TABLE `Purchases` (
  `purchase_id` int(11) NOT NULL,
  `purchase_discount` int(11) DEFAULT '0',
  `purchase_date` date DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Roles`
--

CREATE TABLE `Roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(20) NOT NULL,
  `role_description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Roles`
--

INSERT INTO `Roles` (`role_id`, `role_name`, `role_description`) VALUES
(1, 'admin', ''),
(2, 'cliente', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Shows`
--

CREATE TABLE `Shows` (
  `show_id` int(11) NOT NULL,
  `show_date` date NOT NULL,
  `show_time` time NOT NULL,
  `movie_id` int(11) NOT NULL,
  `cinema_id` int(11) NOT NULL,
  `show_available` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Shows`
--

INSERT INTO `Shows` (`show_id`, `show_date`, `show_time`, `movie_id`, `cinema_id`, `show_available`) VALUES
(1, '2019-11-30', '15:00:00', 511987, 2, 1),
(2, '2019-12-31', '23:00:00', 338967, 3, 1),
(3, '2019-12-14', '13:30:00', 568012, 4, 1),
(4, '2019-11-21', '10:00:00', 453405, 5, 1),
(5, '2019-12-04', '17:00:00', 474350, 2, 1),
(6, '2019-12-17', '18:00:00', 578189, 4, 1),
(7, '2019-12-22', '22:00:00', 338967, 5, 1),
(8, '2019-12-25', '09:00:00', 420809, 3, 1),
(9, '2020-02-12', '14:44:04', 481084, 5, 1),
(10, '2019-12-01', '11:01:00', 338967, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tickets`
--

CREATE TABLE `Tickets` (
  `ticket_id` int(11) NOT NULL,
  `ticket_qr_code` varchar(255) DEFAULT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `show_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `user_available` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Users`
--

INSERT INTO `Users` (`user_id`, `user_email`, `user_password`, `role_id`, `profile_id`, `user_available`) VALUES
(15, 'podmaster@hotmail.com', '1234', 2, 14, 1),
(16, 'gaspar@bytery.com', '1234', 1, 15, 1),
(17, 'papaute@hotmail.com', '1234', 2, 17, 1),
(18, 'elchaman@email.com', '1234', 2, 18, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Cinemas`
--
ALTER TABLE `Cinemas`
  ADD PRIMARY KEY (`cinema_id`);

--
-- Indices de la tabla `Counts`
--
ALTER TABLE `Counts`
  ADD PRIMARY KEY (`count_id`);

--
-- Indices de la tabla `Genres`
--
ALTER TABLE `Genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indices de la tabla `Genres_on_Movies`
--
ALTER TABLE `Genres_on_Movies`
  ADD PRIMARY KEY (`movie_id`,`genre_id`),
  ADD KEY `fk_genre_movie_genre` (`genre_id`);

--
-- Indices de la tabla `Movies`
--
ALTER TABLE `Movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indices de la tabla `Payments`
--
ALTER TABLE `Payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_payment_count` (`count_id`);

--
-- Indices de la tabla `Profiles`
--
ALTER TABLE `Profiles`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indices de la tabla `Purchases`
--
ALTER TABLE `Purchases`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `fk_purchase_payment` (`payment_id`),
  ADD KEY `fk_purchase_user` (`user_id`);

--
-- Indices de la tabla `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indices de la tabla `Shows`
--
ALTER TABLE `Shows`
  ADD PRIMARY KEY (`show_id`),
  ADD KEY `fk_show_movie` (`movie_id`),
  ADD KEY `fk_show_cinema` (`cinema_id`);

--
-- Indices de la tabla `Tickets`
--
ALTER TABLE `Tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `fk_ticket_purchase` (`purchase_id`),
  ADD KEY `fk_ticket_show` (`show_id`);

--
-- Indices de la tabla `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `unq_user_email` (`user_email`),
  ADD KEY `fk_user_role` (`role_id`),
  ADD KEY `fk_user_profile` (`profile_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Cinemas`
--
ALTER TABLE `Cinemas`
  MODIFY `cinema_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Counts`
--
ALTER TABLE `Counts`
  MODIFY `count_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Payments`
--
ALTER TABLE `Payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Profiles`
--
ALTER TABLE `Profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `Purchases`
--
ALTER TABLE `Purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Roles`
--
ALTER TABLE `Roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Shows`
--
ALTER TABLE `Shows`
  MODIFY `show_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `Tickets`
--
ALTER TABLE `Tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Genres_on_Movies`
--
ALTER TABLE `Genres_on_Movies`
  ADD CONSTRAINT `fk_genre_movie_genre` FOREIGN KEY (`genre_id`) REFERENCES `Genres` (`genre_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_genre_movie_movie` FOREIGN KEY (`movie_id`) REFERENCES `Movies` (`movie_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `Payments`
--
ALTER TABLE `Payments`
  ADD CONSTRAINT `fk_payment_count` FOREIGN KEY (`count_id`) REFERENCES `Counts` (`count_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `Purchases`
--
ALTER TABLE `Purchases`
  ADD CONSTRAINT `fk_purchase_payment` FOREIGN KEY (`payment_id`) REFERENCES `Payments` (`payment_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_purchase_user` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `Shows`
--
ALTER TABLE `Shows`
  ADD CONSTRAINT `fk_show_cinema` FOREIGN KEY (`cinema_id`) REFERENCES `Cinemas` (`cinema_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_show_movie` FOREIGN KEY (`movie_id`) REFERENCES `Movies` (`movie_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `Tickets`
--
ALTER TABLE `Tickets`
  ADD CONSTRAINT `fk_ticket_purchase` FOREIGN KEY (`purchase_id`) REFERENCES `Purchases` (`purchase_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ticket_show` FOREIGN KEY (`show_id`) REFERENCES `Shows` (`show_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`profile_id`) REFERENCES `Profiles` (`profile_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`role_id`) REFERENCES `Roles` (`role_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
