create database if not exists moviepass;

use moviepass;

create table Cinemas(
	cinema_id int auto_increment,
	cinema_name varchar(30) not null,
	cinema_address varchar(30) not null,
	cinema_capacity int,
	cinema_ticketValue int,
	constraint pk_cinema primary key (cinema_id)
);

create table Genres(
	genre_id int not null,
	genre_name varchar(15) not null,
	constraint pk_genre primary key (genre_id)
);

create table Movies(
	movie_id int not null,
	movie_image varchar(100) not null,
	movie_language varchar(15) not null,
	movie_title varchar(30) not null,
	movie_runtime int not null,
	constraint pk_movie primary key (movie_id)
);

create table Genres_on_Movies(
	movie_id int not null,
	genre_id int not null,
	constraint pk_genre_movie primary key (movie_id, genre_id),
	constraint fk_genre_movie_genre foreign key (genre_id) references Genres(genre_id) on delete cascade,
	constraint fk_genre_movie_movie foreign key (movie_id) references Movies(movie_id) on delete cascade
);

create table Shows(
	show_id int auto_increment not null,
	show_date date not null,
	show_time time not null,
	movie_id int not null,
	cinema_id int not null,
	constraint pk_show primary key (show_id),
	constraint fk_show_movie foreign key (movie_id) references Movies(movie_id) on update cascade,
	constraint fk_show_cinema foreign key (cinema_id) references Cinemas(cinema_id) on update cascade on delete cascade
);

create table Roles(
	role_id int auto_increment not null,
	role_name varchar(20) not null,
	role_description varchar(50) not null,
	constraint pk_role primary key (role_id)
);

create table Profiles(
	profile_id int auto_increment not null,
	profile_apellido varchar(20) not null,
	profile_nombre varchar(20) not null,
	profile_dni varchar(12) not null,
	constraint pk_profile primary key (profile_id)
);

create table Users(
	user_id int auto_increment not null,
	user_email varchar(30) not null,
	user_password varchar(20) not null,
	role_id int not null,
	profile_id int not null,
	constraint pk_user primary key (user_id),
	constraint unq_user_email unique (user_email),
	constraint fk_user_role foreign key (role_id) references Roles(role_id) on update cascade,
	constraint fk_user_profile foreign key (profile_id) references Profiles(profile_id) on update cascade
);

create table Counts(
	count_id int auto_increment,
	count_name varchar(40),
	constraint pk_count primary key (count_id) 
);

create table Payments(
	payment_id int auto_increment,
	payment_auth_code int,
	payment_date date,
	payment_amount float,
	count_id int,
	constraint pk_payment primary key (payment_id),
	constraint fk_payment_count foreign key (count_id) references Counts(count_id) on update cascade
);

create table Purchases(
	purchase_id int auto_increment,
	purchase_discount int default 0,
	purchase_date date,
	payment_id int,
	user_id int,
	constraint pk_purchase primary key (purchase_id),
	constraint fk_purchase_payment foreign key (payment_id) references Payments(payment_id) on update cascade,
	constraint fk_purchase_user foreign key (user_id) references Users(user_id) on update cascade
);

create table Tickets(
	ticket_id int auto_increment,
	ticket_qr_code varchar(255),
	purchase_id int,
	show_id int,
	constraint pk_ticket primary key (ticket_id),
	constraint fk_ticket_purchase foreign key (purchase_id) references Purchases(purchase_id) on update cascade,
	constraint fk_ticket_show foreign key (show_id) references Shows(show_id) on update cascade
);



--
-- Volcado de datos para la tabla `Cinemas`
--

INSERT INTO `Cinemas` (`cinema_id`, `cinema_name`, `cinema_address`, `cinema_capacity`, `cinema_ticketValue`) VALUES
(2, 'some name', 'address test', 3, 100);

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

--
-- Volcado de datos para la tabla `Movies`
--

INSERT INTO `Movies` (`movie_id`, `movie_image`, `movie_language`, `movie_title`, `movie_runtime`) VALUES
(0, 'movie_image', 'movie_language', 'movie_title', 60),
(290859, '/vqzNJRH4YyquRiWxCCOH0aXggHI.jpg', 'English', 'Terminator: Dark Fate', 128),
(338967, '/pIcV8XXIIvJCbtPoxF9qHMKdRr2.jpg', 'Italiano', 'Zombieland: Double Tap', 99),
(420809, '/tBuabjEqxzoUBHfbyNbd8ulgy5j.jpg', 'English', 'Maleficent: Mistress of Evil', 118),
(449924, '/mAWBfTDAmfpvQGMVFuzuVl49N1P.jpg', 'English', 'Ip Man 4: The Finale', 0),
(453405, '/uTALxjQU8e1lhmNjP9nnJ3t2pRU.jpg', 'English', 'Gemini Man', 117),
(454640, '/6Vr7GRINeaDLwfyXBpqO1VfmCrL.jpg', 'English', 'The Angry Birds Movie 2', 96),
(459992, '/m2ttWZ8rMRwIMT7zA48Jo6mTkDS.jpg', 'FranÃ§ais', 'Long Shot', 125),
(474350, '/zfE0R94v1E8cuKAerbskfD3VfUt.jpg', 'English', 'It Chapter Two', 169),
(475557, '/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg', 'English', 'Joker', 122),
(481084, '/uaXNjRkDdjfxfVuKHo25wkA6CiA.jpg', 'English', 'The Addams Family', 86),
(496243, '/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg', 'English', 'Parasite', 132),
(515195, '/1rjaRIAqFPQNnMtqSMLtg0VEABi.jpg', 'FranÃ§ais', 'Yesterday', 116),
(540901, '/zBhv8rsLOfpFW2M5b6wW78Uoojs.jpg', 'English', 'Hustlers', 107),
(568012, '/4E2lyUGLEr3yH4q6kJxPkQUhX7n.jpg', 'æ—¥æœ¬èªž', 'One Piece: Stampede', 101),
(578189, '/fjmMu9fpqMMF17mCyLhNfkagKB0.jpg', 'English', 'Black and Blue', 109);



--
-- Volcado de datos para la tabla `Genres_on_Movies`
--

INSERT INTO `Genres_on_Movies` (`movie_id`, `genre_id`) VALUES
(420809, 12),
(454640, 12),
(568012, 12),
(420809, 14),
(481084, 14),
(515195, 14),
(454640, 16),
(481084, 16),
(568012, 16),
(449924, 18),
(475557, 18),
(496243, 18),
(540901, 18),
(578189, 18),
(338967, 27),
(474350, 27),
(481084, 27),
(290859, 28),
(338967, 28),
(449924, 28),
(453405, 28),
(454640, 28),
(568012, 28),
(578189, 28),
(338967, 35),
(454640, 35),
(459992, 35),
(481084, 35),
(496243, 35),
(515195, 35),
(540901, 35),
(449924, 36),
(453405, 53),
(475557, 53),
(496243, 53),
(475557, 80),
(540901, 80),
(578189, 80),
(290859, 878),
(515195, 10402),
(459992, 10749),
(515195, 10749),
(420809, 10751),
(454640, 10751),
(481084, 10751);





--
-- Volcado de datos para la tabla `Shows`
--

INSERT INTO `Shows` (`show_id`, `show_date`, `show_time`, `movie_id`, `cinema_id`) VALUES
(3, '2019-10-20', '18:00:00', 0, 2);


