-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql_db
-- Tiempo de generación: 26-11-2019 a las 12:11:33
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
-- Estructura de tabla para la tabla `CinemaRooms`
--

CREATE TABLE `CinemaRooms` (
  `cinemaroom_id` int(11) NOT NULL,
  `cinemaroom_name` varchar(50) NOT NULL,
  `cinemaroom_capacity` int(11) NOT NULL,
  `cinemaroom_ticketValue` float DEFAULT NULL,
  `cinemaroom_available` tinyint(1) DEFAULT '1',
  `cinema_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `CinemaRooms`
--

INSERT INTO `CinemaRooms` (`cinemaroom_id`, `cinemaroom_name`, `cinemaroom_capacity`, `cinemaroom_ticketValue`, `cinemaroom_available`, `cinema_id`) VALUES
(1, 'Sala 1', 100, 100, 1, 1),
(2, 'Sala 2', 200, 200, 1, 1),
(3, 'Sala 1', 100, 100, 1, 2),
(4, 'Sala 2', 200, 200, 1, 2),
(5, 'MAX 1', 1000, 400, 1, 3),
(6, 'MAX 2', 1000, 350, 1, 3),
(7, 'MAX 3', 1000, 500, 1, 3),
(8, 'MAX 4', 500, 600, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cinemas`
--

CREATE TABLE `Cinemas` (
  `cinema_id` int(11) NOT NULL,
  `cinema_name` varchar(50) NOT NULL,
  `cinema_address` varchar(50) NOT NULL,
  `cinema_available` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Cinemas`
--

INSERT INTO `Cinemas` (`cinema_id`, `cinema_name`, `cinema_address`, `cinema_available`) VALUES
(1, 'Paseo', 'Diagonal 1234', 1),
(2, 'Ambassador', 'Peatonal 4321', 1),
(3, 'Atmos MAX Super ', 'Max power 4321', 1);

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
(330457, 12),
(420809, 12),
(458897, 12),
(480105, 12),
(499701, 12),
(508965, 12),
(568012, 12),
(420809, 14),
(501170, 14),
(330457, 16),
(508965, 16),
(568012, 16),
(359724, 18),
(398978, 18),
(474350, 18),
(475557, 18),
(496243, 18),
(501170, 18),
(501907, 18),
(511987, 18),
(513409, 18),
(522162, 18),
(540901, 18),
(559969, 18),
(474350, 27),
(480105, 27),
(501170, 27),
(511987, 27),
(567609, 27),
(290859, 28),
(359724, 28),
(423204, 28),
(453405, 28),
(458897, 28),
(511987, 28),
(522162, 28),
(522938, 28),
(568012, 28),
(330457, 35),
(458897, 35),
(496243, 35),
(499701, 35),
(508965, 35),
(540901, 35),
(567609, 35),
(359724, 36),
(398978, 36),
(522162, 36),
(453405, 53),
(475557, 53),
(480105, 53),
(496243, 53),
(511987, 53),
(513409, 53),
(522938, 53),
(559969, 53),
(567609, 53),
(398978, 80),
(475557, 80),
(540901, 80),
(559969, 80),
(290859, 878),
(640882, 878),
(513409, 9648),
(567609, 9648),
(330457, 10402),
(513409, 10749),
(330457, 10751),
(420809, 10751),
(499701, 10751),
(508965, 10751),
(522162, 10752);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Movies`
--

CREATE TABLE `Movies` (
  `movie_id` int(11) NOT NULL,
  `movie_image` varchar(100) NOT NULL,
  `movie_language` varchar(20) NOT NULL,
  `movie_title` varchar(50) NOT NULL,
  `movie_runtime` int(11) NOT NULL,
  `movie_description` varchar(800) DEFAULT '',
  `movie_available` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Movies`
--

INSERT INTO `Movies` (`movie_id`, `movie_image`, `movie_language`, `movie_title`, `movie_runtime`, `movie_description`, `movie_available`) VALUES
(290859, '/vqzNJRH4YyquRiWxCCOH0aXggHI.jpg', 'English', 'Terminator: Dark Fate', 128, 'More than two decades have passed since Sarah Connor prevented Judgment Day, changed the future, and re-wrote the fate of the human race. Dani Ramos is living a simple life in Mexico City with her brother and father when a highly advanced and deadly new Terminator â€“ a Rev-9 â€“ travels back through time to hunt and kill her. Dani\'s survival depends on her joining forces with two warriors: Grace, an enhanced super-soldier from the future, and a battle-hardened Sarah Connor. As the Rev-9 ruthlessly destroys everything and everyone in its path on the hunt for Dani, the three are led to a T-800 from Sarahâ€™s past that may be their last best hope.', 1),
(330457, '/qdfARIhgpgZOBh3vfNhWS4hmSo3.jpg', 'English', 'Frozen II', 104, 'Elsa, Anna, Kristoff and Olaf are going far in the forest to know the truth about an ancient mystery of their kingdom.', 1),
(359724, '/6ApDtO7xaWAfPqfi2IARXIzj8QS.jpg', 'English', 'Ford v Ferrari', 152, 'American car designer Carroll Shelby and the British-born driver Ken Miles work together to battle corporate interference, the laws of physics, and their own personal demons to build a revolutionary race car for Ford Motor Company and take on the dominating race cars of Enzo Ferrari at the 24 Hours of Le Mans in France in 1966.', 1),
(398978, '/4Fc3UkAyXIKWW8jrCQpvOkTE1gy.jpg', 'English', 'The Irishman', 209, 'World War II veteran and mob hitman Frank \"The Irishman\" Sheeran recalls his possible involvement with the slaying of union leader Jimmy Hoffa.', 1),
(420809, '/tBuabjEqxzoUBHfbyNbd8ulgy5j.jpg', 'English', 'Maleficent: Mistress of Evil', 118, 'Maleficent and her goddaughter Aurora begin to question the complex family ties that bind them as they are pulled in different directions by impending nuptials, unexpected allies, and dark new forces at play.', 1),
(423204, '/fapXd3v9qTcNBTm39ZC4KUVQDNf.jpg', 'English', 'Angel Has Fallen', 121, 'After the events in the previous film, Secret Service agent Mike Banning finds himself framed for an assassination attempt on the President. Pursued by his own agency and the FBI, Banning races to clear his name and uncover the real terrorist threat which has set its sights on Air Force One.', 1),
(453405, '/uTALxjQU8e1lhmNjP9nnJ3t2pRU.jpg', 'English', 'Gemini Man', 117, 'Henry Brogen, an aging assassin tries to get out of the business but finds himself in the ultimate battle: fighting his own clone who is 25 years younger than him and at the peak of his abilities.', 1),
(458897, '/hoIE7Ua7wTVZ0dfdATdf6uLbnnl.jpg', 'English', 'Charlie\'s Angels', 118, 'When a systems engineer blows the whistle on a dangerous technology, Charlie\'s Angels from across the globe are called into action, putting their lives on the line to protect society.', 1),
(474350, '/zfE0R94v1E8cuKAerbskfD3VfUt.jpg', 'English', 'It Chapter Two', 169, '27 years after overcoming the malevolent supernatural entity Pennywise, the former members of the Losers\' Club, who have grown up and moved away from Derry, are brought back together by a devastating phone call.', 1),
(475557, '/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg', 'English', 'Joker', 122, 'During the 1980s, a failed stand-up comedian is driven insane and turns to a life of crime and chaos in Gotham City while becoming an infamous psychopathic crime figure.', 1),
(480105, '/g4z7mDmJmx23vsVg6XNWcnXb6gc.jpg', 'English', '47 Meters Down: Uncaged', 90, 'A group of backpackers diving in a ruined underwater city discover that they have stumbled into the territory of the ocean\'s deadliest shark species.', 1),
(496243, '/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg', 'í•œêµ­ì–´/ì¡°ì„ ë§', 'Parasite', 132, 'All unemployed, Ki-taek\'s family takes peculiar interest in the wealthy and glamorous Parks for their livelihood until they get entangled in an unexpected incident.', 1),
(499701, '/xvYCZ740XvngXK0FNeSNVTJJJ5v.jpg', 'EspaÃ±ol', 'Dora and the Lost City of Gold', 102, 'Dora, a girl who has spent most of her life exploring the jungle with her parents, now must navigate her most dangerous adventure yet: high school. Always the explorer, Dora quickly finds herself leading Boots (her best friend, a monkey), Diego, and a rag tag group of teens on an adventure to save her parents and solve the impossible mystery behind a lost Inca civilization.', 1),
(501170, '/p69QzIBbN06aTYqRRiCOY1emNBh.jpg', 'English', 'Doctor Sleep', 152, 'A traumatized, alcoholic Dan Torrance meets Abra, a kid who also has the ability to \"shine.\" He tries to protect her from the True Knot, a cult whose goal is to feed off of people like them in order to remain immortal.', 1),
(501907, '/tC3oqkvF6E1RzaTBMb7IivcLx96.jpg', 'English', 'A Beautiful Day in the Neighborhood', 107, 'An award-winning cynical journalist, Lloyd Vogel, begrudgingly accepts an assignment to write an Esquire profile piece on the beloved television icon Fred Rogers. After his encounter with Rogers, Vogel\'s perspective on life is transformed.', 1),
(508965, '/q125RHUDgR4gjwh1QkfYuJLYkL.jpg', 'English', 'Klaus', 97, 'When Jesper distinguishes himself as the Postal Academy\'s worst student, he is sent to Smeerensburg, a small village located on a icy island above the Arctic Circle, where grumpy inhabitants barely exchange words, let alone letters. Jesper is about to give up and abandon his duty as a postman when he meets local teacher Alva and Klaus, a mysterious carpenter who lives alone in a cabin full of handmade toys.', 1),
(511987, '/9kOtMOUa5HrOiIG2Z9Anv7M8AbY.jpg', 'English', 'Crawl', 88, 'When a huge hurricane hits her hometown in Florida, Haley ignores evacuation orders to look for her father. After finding him badly wounded, both are trapped by the flood. With virtually no time to escape the storm, they discover that rising water levels are the least of their problems.', 1),
(513409, '/oyKnosHXQ7kkhlGwqsWOvn4RgKR.jpg', 'English', 'Earthquake Bird', 107, 'Tokyo, Japan, 1989. Lucy Fly, a foreigner who works as a translator, begins a passionate relationship with Teiji, a mysterious man obsessed with photography.', 1),
(522162, '/hj8pyoNnynGeJTAbl7jcLZO8Uhx.jpg', 'English', 'Midway', 138, 'The story of the soldiers and aviators who helped turn the tide of the Second World War during the iconic Battle of Midway in June 1942.', 1),
(522938, '/kTQ3J8oTTKofAVLYnds2cHUz9KO.jpg', 'English', 'Rambo: Last Blood', 89, 'When John Rambo\'s niece travels to Mexico to find the father that abandoned her and her mother, she finds herself in the grasps of Calle Mexican sex traffickers. When she doesn\'t return home as expected, John learns she\'s crossed into Mexico and sets out to get her back and make them pay.', 1),
(540901, '/zBhv8rsLOfpFW2M5b6wW78Uoojs.jpg', 'English', 'Hustlers', 107, 'A crew of savvy former strip club employees band together to turn the tables on their Wall Street clients.', 1),
(559969, '/ePXuKdXZuJx8hHMNr2yM4jY2L7Z.jpg', 'English', 'El Camino: A Breaking Bad Movie', 123, 'In the wake of his dramatic escape from captivity, Jesse Pinkman must come to terms with his past in order to forge some kind of future.', 1),
(567609, '/vOl6shtL0wknjaIs6JdKCpcHvg8.jpg', 'English', 'Ready or Not', 95, 'A bride\'s wedding night takes a sinister turn when her eccentric new in-laws force her to take part in a terrifying game.', 1),
(568012, '/4E2lyUGLEr3yH4q6kJxPkQUhX7n.jpg', 'æ—¥æœ¬èªž', 'One Piece: Stampede', 101, 'One Piece: Stampede is a stand-alone film that celebrates the anime\'s 20th Anniversary and takes place outside the canon of the \"One Piece\" TV series. Monkey D. Luffy and his Straw Hat pirate crew are invited to a massive Pirate Festival that brings many of the most iconic characters from throughout the franchise to participate in competition with the Straw Hats to find Roger\'s treasure. It also pits the Straw Hats against a new enemy named Bullet, a former member of Roger\'s crew.', 1),
(640882, '/7EKGHMsm3nv87wvlqD7HBZYgAeP.jpg', 'English', '3022', 90, 'A group of astronauts living in the haunting emptiness of deep space awakens to find earth has suffered an extinction-level event.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Payments`
--

CREATE TABLE `Payments` (
  `payment_id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `payment_auth_code` varchar(100) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_amount` float DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `mp_preference_id` varchar(100) DEFAULT NULL,
  `mp_payment_id` varchar(100) DEFAULT NULL,
  `mp_payment_status` varchar(100) DEFAULT NULL,
  `mp_payment_status_detail` varchar(100) DEFAULT NULL,
  `mp_merchant_order_id` varchar(100) DEFAULT NULL,
  `mp_processing_mode` varchar(100) DEFAULT NULL,
  `mp_merchant_account_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Payments`
--

INSERT INTO `Payments` (`payment_id`, `purchase_id`, `payment_auth_code`, `payment_date`, `payment_amount`, `payment_method`, `mp_preference_id`, `mp_payment_id`, `mp_payment_status`, `mp_payment_status_detail`, `mp_merchant_order_id`, `mp_processing_mode`, `mp_merchant_account_id`) VALUES
(6, 6, '', '2019-11-25', 2000, 'Mercado Pago', '50813606-7443e1e3-4c5a-4be1-b5e8-4f7fd88cdcc9', '22794126', '', '', '1171558567', 'aggregator', ''),
(7, 7, '', '2019-11-25', 3000, 'Mercado Pago', '50813606-8899a082-809b-4968-9f38-210b3cf3c9e8', '22794180', '', '', '1171560163', 'aggregator', ''),
(8, 8, '', '2019-11-25', 10000, 'Mercado Pago', '50813606-4a7f3076-1751-4b65-ae42-80d49e745261', '22797413', '', '', '1171629151', 'aggregator', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Profiles`
--

CREATE TABLE `Profiles` (
  `profile_id` int(11) NOT NULL,
  `profile_apellido` varchar(20) DEFAULT NULL,
  `profile_nombre` varchar(20) DEFAULT NULL,
  `profile_dni` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Profiles`
--

INSERT INTO `Profiles` (`profile_id`, `profile_apellido`, `profile_nombre`, `profile_dni`) VALUES
(1, 'Usuario', 'Admin', '931553193'),
(2, 'Usuario', 'Cliente', '394139341'),
(3, '', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Purchases`
--

CREATE TABLE `Purchases` (
  `purchase_id` int(11) NOT NULL,
  `purchase_date` date DEFAULT NULL,
  `purchase_amount` float DEFAULT NULL,
  `purchase_discount` float DEFAULT '0',
  `purchase_total` float DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Purchases`
--

INSERT INTO `Purchases` (`purchase_id`, `purchase_date`, `purchase_amount`, `purchase_discount`, `purchase_total`, `user_id`) VALUES
(6, '2019-11-25', 2000, 0, 2000, 1),
(7, '2019-11-25', 3000, 1000, 2000, 1),
(8, '2019-11-25', 10000, 0, 10000, 1);

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
(1, 'cliente', 'usuario del sistema'),
(2, 'admin', 'administradores del sistema');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Shows`
--

CREATE TABLE `Shows` (
  `show_id` int(11) NOT NULL,
  `show_date` date NOT NULL,
  `show_time` time NOT NULL,
  `show_end_time` time NOT NULL,
  `show_available` tinyint(1) DEFAULT '1',
  `movie_id` int(11) NOT NULL,
  `cinemaroom_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Shows`
--

INSERT INTO `Shows` (`show_id`, `show_date`, `show_time`, `show_end_time`, `show_available`, `movie_id`, `cinemaroom_id`) VALUES
(1, '2019-12-12', '15:00:00', '17:12:00', 1, 496243, 4),
(2, '2019-12-25', '14:00:00', '16:32:00', 1, 501170, 1),
(3, '2019-12-12', '18:00:00', '19:35:00', 1, 567609, 2),
(4, '2019-12-25', '19:00:00', '22:29:00', 1, 398978, 3),
(5, '2019-12-14', '14:00:00', '15:44:00', 1, 330457, 4),
(6, '2020-02-18', '15:15:15', '18:04:15', 1, 474350, 4),
(7, '2019-12-23', '14:00:00', '15:47:00', 1, 501907, 1),
(8, '2019-11-25', '12:00:00', '14:08:00', 1, 290859, 1),
(9, '2019-11-25', '20:00:00', '22:01:00', 1, 423204, 1),
(10, '2019-11-25', '15:00:00', '17:12:00', 1, 496243, 3),
(11, '2019-11-25', '22:00:00', '23:58:00', 1, 458897, 4),
(12, '2019-12-31', '14:00:00', '16:12:00', 1, 496243, 2),
(13, '2019-12-27', '19:30:00', '20:59:00', 1, 522938, 3),
(14, '2019-12-02', '13:00:00', '14:30:00', 1, 640882, 4),
(15, '2019-12-10', '14:00:00', '15:37:00', 1, 508965, 2),
(16, '2020-01-01', '13:00:00', '14:47:00', 1, 513409, 5),
(17, '2019-12-23', '15:00:00', '16:37:00', 1, 508965, 6),
(18, '2019-12-11', '23:00:00', '01:18:00', 1, 522162, 8),
(19, '2019-12-02', '17:00:00', '18:57:00', 1, 453405, 8),
(20, '2019-12-01', '18:00:00', '20:03:00', 1, 559969, 7),
(21, '2019-12-02', '13:00:00', '15:02:00', 1, 475557, 3),
(22, '2019-12-03', '14:00:00', '16:08:00', 1, 290859, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tickets`
--

CREATE TABLE `Tickets` (
  `ticket_id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `show_id` int(11) DEFAULT NULL,
  `ticket_code` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Tickets`
--

INSERT INTO `Tickets` (`ticket_id`, `purchase_id`, `show_id`, `ticket_code`) VALUES
(9, 6, 5, '5ddbf338e47f2'),
(10, 6, 5, '5ddbf338e480b'),
(11, 6, 5, '5ddbf338e481b'),
(12, 6, 5, '5ddbf338e482c'),
(13, 6, 5, '5ddbf338e4837'),
(14, 6, 5, '5ddbf338e4842'),
(15, 6, 5, '5ddbf338e484f'),
(16, 6, 5, '5ddbf338e4863'),
(17, 6, 5, '5ddbf338e48ad'),
(18, 6, 5, '5ddbf338e48de'),
(19, 7, 6, '5ddbf3ec97521'),
(20, 7, 6, '5ddbf3ec97538'),
(21, 7, 6, '5ddbf3ec97544'),
(22, 7, 6, '5ddbf3ec97551'),
(23, 7, 6, '5ddbf3ec9755b'),
(24, 7, 6, '5ddbf3ec97568'),
(25, 7, 6, '5ddbf3ec97575'),
(26, 7, 6, '5ddbf3ec97584'),
(27, 7, 6, '5ddbf3ec97594'),
(28, 7, 6, '5ddbf3ec975a4'),
(29, 7, 6, '5ddbf3ec975bc'),
(30, 7, 6, '5ddbf3ec975cb'),
(31, 7, 6, '5ddbf3ec975d7'),
(32, 7, 6, '5ddbf3ec975e7'),
(33, 7, 6, '5ddbf3ec975f6'),
(34, 7, 6, '5ddbf3ec97612'),
(35, 7, 6, '5ddbf3ec9761e'),
(36, 7, 6, '5ddbf3ec9762e'),
(37, 7, 6, '5ddbf3ec9763f'),
(38, 7, 6, '5ddbf3ec97651'),
(39, 8, 8, '5ddc0c5d067a3'),
(40, 8, 8, '5ddc0c5d0680c'),
(41, 8, 8, '5ddc0c5d0681a'),
(42, 8, 8, '5ddc0c5d06827'),
(43, 8, 8, '5ddc0c5d06834'),
(44, 8, 8, '5ddc0c5d06841'),
(45, 8, 8, '5ddc0c5d0684e'),
(46, 8, 8, '5ddc0c5d0685b'),
(47, 8, 8, '5ddc0c5d06868'),
(48, 8, 8, '5ddc0c5d06875'),
(49, 8, 8, '5ddc0c5d06882'),
(50, 8, 8, '5ddc0c5d0688f'),
(51, 8, 8, '5ddc0c5d0689c'),
(52, 8, 8, '5ddc0c5d068a9'),
(53, 8, 8, '5ddc0c5d068b5'),
(54, 8, 8, '5ddc0c5d068c2'),
(55, 8, 8, '5ddc0c5d068cf'),
(56, 8, 8, '5ddc0c5d068dc'),
(57, 8, 8, '5ddc0c5d068e9'),
(58, 8, 8, '5ddc0c5d068f6'),
(59, 8, 8, '5ddc0c5d06902'),
(60, 8, 8, '5ddc0c5d0690f'),
(61, 8, 8, '5ddc0c5d0691c'),
(62, 8, 8, '5ddc0c5d06929'),
(63, 8, 8, '5ddc0c5d06936'),
(64, 8, 8, '5ddc0c5d06942'),
(65, 8, 8, '5ddc0c5d0694f'),
(66, 8, 8, '5ddc0c5d0695c'),
(67, 8, 8, '5ddc0c5d06969'),
(68, 8, 8, '5ddc0c5d06976'),
(69, 8, 8, '5ddc0c5d06983'),
(70, 8, 8, '5ddc0c5d06990'),
(71, 8, 8, '5ddc0c5d0699c'),
(72, 8, 8, '5ddc0c5d069aa'),
(73, 8, 8, '5ddc0c5d069b6'),
(74, 8, 8, '5ddc0c5d069c3'),
(75, 8, 8, '5ddc0c5d069d0'),
(76, 8, 8, '5ddc0c5d069dd'),
(77, 8, 8, '5ddc0c5d069ee'),
(78, 8, 8, '5ddc0c5d069fc'),
(79, 8, 8, '5ddc0c5d06a09'),
(80, 8, 8, '5ddc0c5d06a15'),
(81, 8, 8, '5ddc0c5d06a22'),
(82, 8, 8, '5ddc0c5d06a2f'),
(83, 8, 8, '5ddc0c5d06a3c'),
(84, 8, 8, '5ddc0c5d06a49'),
(85, 8, 8, '5ddc0c5d06a56'),
(86, 8, 8, '5ddc0c5d06a63'),
(87, 8, 8, '5ddc0c5d06a70'),
(88, 8, 8, '5ddc0c5d06a7c'),
(89, 8, 8, '5ddc0c5d06a89'),
(90, 8, 8, '5ddc0c5d06a96'),
(91, 8, 8, '5ddc0c5d06aa3'),
(92, 8, 8, '5ddc0c5d06ab0'),
(93, 8, 8, '5ddc0c5d06abd'),
(94, 8, 8, '5ddc0c5d06ac9'),
(95, 8, 8, '5ddc0c5d06ad6'),
(96, 8, 8, '5ddc0c5d06ae3'),
(97, 8, 8, '5ddc0c5d06af0'),
(98, 8, 8, '5ddc0c5d06afd'),
(99, 8, 8, '5ddc0c5d06b0a'),
(100, 8, 8, '5ddc0c5d06b17'),
(101, 8, 8, '5ddc0c5d06b23'),
(102, 8, 8, '5ddc0c5d06b30'),
(103, 8, 8, '5ddc0c5d06b3d'),
(104, 8, 8, '5ddc0c5d06b50'),
(105, 8, 8, '5ddc0c5d06b5d'),
(106, 8, 8, '5ddc0c5d06b6a'),
(107, 8, 8, '5ddc0c5d06b77'),
(108, 8, 8, '5ddc0c5d06b84'),
(109, 8, 8, '5ddc0c5d06b91'),
(110, 8, 8, '5ddc0c5d06b9d'),
(111, 8, 8, '5ddc0c5d06baa'),
(112, 8, 8, '5ddc0c5d06bb7'),
(113, 8, 8, '5ddc0c5d06bc4'),
(114, 8, 8, '5ddc0c5d06bd1'),
(115, 8, 8, '5ddc0c5d06be1'),
(116, 8, 8, '5ddc0c5d06bee'),
(117, 8, 8, '5ddc0c5d06bfe'),
(118, 8, 8, '5ddc0c5d06c0b'),
(119, 8, 8, '5ddc0c5d06c18'),
(120, 8, 8, '5ddc0c5d06c25'),
(121, 8, 8, '5ddc0c5d06c32'),
(122, 8, 8, '5ddc0c5d06c3e'),
(123, 8, 8, '5ddc0c5d06c4b'),
(124, 8, 8, '5ddc0c5d06c58'),
(125, 8, 8, '5ddc0c5d06c65'),
(126, 8, 8, '5ddc0c5d06c71'),
(127, 8, 8, '5ddc0c5d06c7e'),
(128, 8, 8, '5ddc0c5d06c8b'),
(129, 8, 8, '5ddc0c5d06c98'),
(130, 8, 8, '5ddc0c5d06ca5'),
(131, 8, 8, '5ddc0c5d06cb5'),
(132, 8, 8, '5ddc0c5d06cc2'),
(133, 8, 8, '5ddc0c5d06ccf'),
(134, 8, 8, '5ddc0c5d06cdc'),
(135, 8, 8, '5ddc0c5d06ce9'),
(136, 8, 8, '5ddc0c5d06cf5'),
(137, 8, 8, '5ddc0c5d06d02'),
(138, 8, 8, '5ddc0c5d06d0f');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(30) DEFAULT NULL,
  `user_password` varchar(20) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `fb_id` varchar(50) DEFAULT NULL,
  `profile_id` int(11) NOT NULL,
  `user_available` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Users`
--

INSERT INTO `Users` (`user_id`, `user_email`, `user_password`, `role_id`, `fb_id`, `profile_id`, `user_available`) VALUES
(1, 'admin@user.com', '1234', 2, NULL, 1, 1),
(2, 'cliente@user.com', '1234', 1, NULL, 2, 1),
(3, '10162493652100175', '', 1, '10162493652100175', 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `CinemaRooms`
--
ALTER TABLE `CinemaRooms`
  ADD PRIMARY KEY (`cinemaroom_id`),
  ADD KEY `fk_cinemarrom_cinema` (`cinema_id`);

--
-- Indices de la tabla `Cinemas`
--
ALTER TABLE `Cinemas`
  ADD PRIMARY KEY (`cinema_id`);

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
  ADD KEY `fk_payment_purchase` (`purchase_id`);

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
  ADD KEY `fk_show_cinemaroom` (`cinemaroom_id`);

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
-- AUTO_INCREMENT de la tabla `CinemaRooms`
--
ALTER TABLE `CinemaRooms`
  MODIFY `cinemaroom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `Cinemas`
--
ALTER TABLE `Cinemas`
  MODIFY `cinema_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Payments`
--
ALTER TABLE `Payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `Profiles`
--
ALTER TABLE `Profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Purchases`
--
ALTER TABLE `Purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `Roles`
--
ALTER TABLE `Roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Shows`
--
ALTER TABLE `Shows`
  MODIFY `show_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `Tickets`
--
ALTER TABLE `Tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT de la tabla `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `CinemaRooms`
--
ALTER TABLE `CinemaRooms`
  ADD CONSTRAINT `fk_cinemarrom_cinema` FOREIGN KEY (`cinema_id`) REFERENCES `Cinemas` (`cinema_id`);

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
  ADD CONSTRAINT `fk_payment_purchase` FOREIGN KEY (`purchase_id`) REFERENCES `Purchases` (`purchase_id`);

--
-- Filtros para la tabla `Purchases`
--
ALTER TABLE `Purchases`
  ADD CONSTRAINT `fk_purchase_user` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `Shows`
--
ALTER TABLE `Shows`
  ADD CONSTRAINT `fk_show_cinemaroom` FOREIGN KEY (`cinemaroom_id`) REFERENCES `CinemaRooms` (`cinemaroom_id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
