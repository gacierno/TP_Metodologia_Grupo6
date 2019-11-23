create database if not exists moviepass;

use moviepass;

create table Cinemas(
	cinema_id int auto_increment,
	cinema_name varchar(50) not null,
	cinema_address varchar(50) not null,
	cinema_available boolean default 1,
	constraint pk_cinema primary key (cinema_id)
);

create table CinemaRooms(
	cinemaroom_id int auto_increment,
	cinemaroom_name varchar(50) not null,
	cinemaroom_capacity int not null,
	cinemaroom_ticketValue int,
	cinemaroom_available boolean default 1,
	cinema_id int not null,
	constraint pk_cinemaroom primary key (cinemaroom_id),
	constraint fk_cinemarrom_cinema foreign key (cinema_id) references Cinemas(cinema_id)
);

create table Genres(
	genre_id int not null,
	genre_name varchar(15) not null,
	constraint pk_genre primary key (genre_id)
);

create table Movies(
	movie_id int not null,
	movie_image varchar(100) not null,
	movie_language varchar(20) not null,
	movie_title varchar(50) not null,
	movie_runtime int not null,
	movie_description varchar(800) default '',
	movie_available boolean default 1,
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
	show_end_time time not null,
	show_available boolean default 1,
	movie_id int not null,
	cinemaroom_id int not null,
	constraint pk_show primary key (show_id),
	constraint fk_show_movie foreign key (movie_id) references Movies(movie_id) on update cascade,
	constraint fk_show_cinemaroom foreign key (cinemaroom_id) references CinemaRooms(cinemaroom_id) on update cascade on delete cascade
);

create table Roles(
	role_id int auto_increment not null,
	role_name varchar(20) not null,
	role_description varchar(50) not null,
	constraint pk_role primary key (role_id)
);

create table Profiles(
	profile_id int auto_increment not null,
	profile_apellido varchar(20) ,
	profile_nombre varchar(20) ,
	profile_dni varchar(12) ,
	constraint pk_profile primary key (profile_id)
);

create table Users(
	user_id int auto_increment not null,
	user_email varchar(30),
	user_password varchar(20),
	role_id int not null,
	fb_id varchar(50),
	profile_id int not null,
	user_available boolean default 1,
	constraint pk_user primary key (user_id),
	constraint unq_user_email unique (user_email),
	constraint fk_user_role foreign key (role_id) references Roles(role_id) on update cascade,
	constraint fk_user_profile foreign key (profile_id) references Profiles(profile_id) on update cascade
);

create table Purchases(
	purchase_id int auto_increment,
	purchase_date date,
	purchase_amount int,
	purchase_discount int default 0,
	purchase_total int,
	user_id int,
	constraint pk_purchase primary key (purchase_id),
	constraint fk_purchase_user foreign key (user_id) references Users(user_id) on update cascade
);

create table Payments(
	payment_id int auto_increment,
	purchase_id int,
	payment_auth_code varchar(100),
	payment_date date,
	payment_amount float,
	payment_method varchar(100),
	mp_preference_id varchar(100),
	mp_payment_id varchar(100),
	mp_payment_status varchar(100),
	mp_payment_status_detail varchar(100),
	mp_merchant_order_id varchar(100),
	mp_processing_mode varchar(100),
	mp_merchant_account_id varchar(100),
	constraint pk_payment primary key (payment_id),
	constraint fk_payment_purchase foreign key (purchase_id) references Purchases(purchase_id)
);

create table Tickets(
	ticket_id int auto_increment,
	purchase_id int,
	show_id int,
	constraint pk_ticket primary key (ticket_id),
	constraint fk_ticket_purchase foreign key (purchase_id) references Purchases(purchase_id) on update cascade,
	constraint fk_ticket_show foreign key (show_id) references Shows(show_id) on update cascade
);




/*

	CREATE ROLES FOR USERS

*/


insert into Roles (role_name, role_description) values ( 'cliente', 'usuario del sistema'), ('admin', 'administradores del sistema');


/*

	CREATE CINEMAS

*/
INSERT INTO `Cinemas` (`cinema_id`, `cinema_name`, `cinema_address`, `cinema_available`) VALUES
(1, 'Paseo', 'Diagonal 1234', 1),
(2, 'Ambassador', 'Peatonal 4321', 1);

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



/*

	CREATE MOVIES

*/
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
(480105, '/g4z7mDmJmx23vsVg6XNWcnXb6gc.jpg', 'English', '47 Meters Down: Uncaged', 90, 'A group of backpackers diving in a ruined underwater city discover that they have stumbled into the territory of the ocean\'s deadliest shark species.', 1),
(496243, '/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg', 'í•œêµ­ì–´/ì¡°ì„ ë§', 'Parasite', 132, 'All unemployed, Ki-taek\'s family takes peculiar interest in the wealthy and glamorous Parks for their livelihood until they get entangled in an unexpected incident.', 1),
(501170, '/p69QzIBbN06aTYqRRiCOY1emNBh.jpg', 'English', 'Doctor Sleep', 152, 'A traumatized, alcoholic Dan Torrance meets Abra, a kid who also has the ability to \"shine.\" He tries to protect her from the True Knot, a cult whose goal is to feed off of people like them in order to remain immortal.', 1),
(501907, '/tC3oqkvF6E1RzaTBMb7IivcLx96.jpg', 'English', 'A Beautiful Day in the Neighborhood', 107, 'An award-winning cynical journalist, Lloyd Vogel, begrudgingly accepts an assignment to write an Esquire profile piece on the beloved television icon Fred Rogers. After his encounter with Rogers, Vogel\'s perspective on life is transformed.', 1),
(508965, '/q125RHUDgR4gjwh1QkfYuJLYkL.jpg', 'English', 'Klaus', 97, 'When Jesper distinguishes himself as the Postal Academy\'s worst student, he is sent to Smeerensburg, a small village located on a icy island above the Arctic Circle, where grumpy inhabitants barely exchange words, let alone letters. Jesper is about to give up and abandon his duty as a postman when he meets local teacher Alva and Klaus, a mysterious carpenter who lives alone in a cabin full of handmade toys.', 1),
(511987, '/9kOtMOUa5HrOiIG2Z9Anv7M8AbY.jpg', 'English', 'Crawl', 88, 'When a huge hurricane hits her hometown in Florida, Haley ignores evacuation orders to look for her father. After finding him badly wounded, both are trapped by the flood. With virtually no time to escape the storm, they discover that rising water levels are the least of their problems.', 1),
(513409, '/oyKnosHXQ7kkhlGwqsWOvn4RgKR.jpg', 'English', 'Earthquake Bird', 107, 'Tokyo, Japan, 1989. Lucy Fly, a foreigner who works as a translator, begins a passionate relationship with Teiji, a mysterious man obsessed with photography.', 1),
(540901, '/zBhv8rsLOfpFW2M5b6wW78Uoojs.jpg', 'English', 'Hustlers', 107, 'A crew of savvy former strip club employees band together to turn the tables on their Wall Street clients.', 1),
(559969, '/ePXuKdXZuJx8hHMNr2yM4jY2L7Z.jpg', 'English', 'El Camino: A Breaking Bad Movie', 123, 'In the wake of his dramatic escape from captivity, Jesse Pinkman must come to terms with his past in order to forge some kind of future.', 1),
(567609, '/vOl6shtL0wknjaIs6JdKCpcHvg8.jpg', 'English', 'Ready or Not', 95, 'A bride\'s wedding night takes a sinister turn when her eccentric new in-laws force her to take part in a terrifying game.', 1),
(568012, '/4E2lyUGLEr3yH4q6kJxPkQUhX7n.jpg', 'æ—¥æœ¬èªž', 'One Piece: Stampede', 101, 'One Piece: Stampede is a stand-alone film that celebrates the anime\'s 20th Anniversary and takes place outside the canon of the \"One Piece\" TV series. Monkey D. Luffy and his Straw Hat pirate crew are invited to a massive Pirate Festival that brings many of the most iconic characters from throughout the franchise to participate in competition with the Straw Hats to find Roger\'s treasure. It also pits the Straw Hats against a new enemy named Bullet, a former member of Roger\'s crew.', 1);




--
-- Volcado de datos para la tabla `Genres_on_Movies`
--

INSERT INTO `Genres_on_Movies` (`movie_id`, `genre_id`) VALUES
(330457, 12),
(420809, 12),
(458897, 12),
(480105, 12),
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
(496243, 18),
(501170, 18),
(501907, 18),
(511987, 18),
(513409, 18),
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
(568012, 28),
(330457, 35),
(458897, 35),
(496243, 35),
(508965, 35),
(540901, 35),
(567609, 35),
(359724, 36),
(398978, 36),
(453405, 53),
(480105, 53),
(496243, 53),
(511987, 53),
(513409, 53),
(559969, 53),
(567609, 53),
(398978, 80),
(540901, 80),
(559969, 80),
(290859, 878),
(513409, 9648),
(567609, 9648),
(330457, 10402),
(513409, 10749),
(330457, 10751),
(420809, 10751),
(508965, 10751);



--
-- Volcado de datos para la tabla `CinemaRooms`
--

INSERT INTO `CinemaRooms` (`cinemaroom_id`, `cinemaroom_name`, `cinemaroom_capacity`, `cinemaroom_ticketValue`, `cinemaroom_available`, `cinema_id`) VALUES
(1, 'Sala 1', 100, 100, 1, 1),
(2, 'Sala 2', 200, 200, 1, 1),
(3, 'Sala 1', 100, 100, 1, 2),
(4, 'Sala 2', 200, 200, 1, 2);



INSERT INTO `Shows` (`show_id`, `show_date`, `show_time`, `show_end_time`, `show_available`, `movie_id`, `cinemaroom_id`) VALUES
(1, '2019-12-12', '15:00:00', '17:12:00', 1, 496243, 4),
(2, '2019-12-25', '14:00:00', '16:32:00', 1, 501170, 1),
(3, '2019-12-12', '18:00:00', '19:35:00', 1, 567609, 2),
(4, '2019-12-25', '19:00:00', '22:29:00', 1, 398978, 3);
