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
	user_available boolean default 1,
	constraint pk_user primary key (user_id),
	constraint unq_user_email unique (user_email),
	constraint fk_user_role foreign key (role_id) references Roles(role_id) on update cascade,
	constraint fk_user_profile foreign key (profile_id) references Profiles(profile_id) on update cascade
);

create table Payments(
	payment_id int auto_increment,
	payment_auth_code int,
	payment_date date,
	payment_amount float,
	constraint pk_payment primary key (payment_id)
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
