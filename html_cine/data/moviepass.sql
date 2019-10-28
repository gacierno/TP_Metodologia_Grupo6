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

create table Rols(
	rol_id int auto_increment not null,
	rol_name varchar(20) not null,
	rol_description varchar(50) not null,
	constraint pk_rol primary key (rol_id)
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
	rol_id int not null,
	profile_id int not null,
	constraint pk_user primary key (user_id),
	constraint unq_user_email unique (user_email),
	constraint fk_user_rol foreign key (rol_id) references Rols(rol_id) on update cascade,
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




