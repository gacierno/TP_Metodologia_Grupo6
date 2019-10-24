create database if not exists moviepass;

use moviepass;

create table Cinemas(
	id_cinema int not null,
	cinema_name varchar(30) not null,
	cinema_address varchar(30) not null,
	cinema_capacity int,
	constraint pk_cinema primary key (id_cinema)
);

create table Genres(
	id_genre int not null,
	genre_name varchar(15) not null,
	constraint pk_genre primary key (id_genre)
);

create table Movies(
	id_movie int not null,
	movie_image varchar(100) not null,
	movie_lang varchar(15) not null,
	movie_title varchar(30) not null,
	movie_runtime int not null,
	constraint pk_movie primary key (id_movie)
);

create table Genres_on_Movies(
	id_movie int not null,
	id_genre int not null,
	constraint pk_genre_movie primary key (id_movie, id_genre),
	constraint fk_genre_movie_genre foreign key (id_genre) references Genres(id_genre) on delete cascade,
	constraint fk_genre_movie_movie foreign key (id_movie) references Movies(id_movie) on delete cascade
);

create table Shows(
	id_show int auto_increment not null,
	show_date date not null,
	show_time time not null,
	id_movie int not null,
	id_cinema int not null,
	constraint pk_show primary key (id_show),
	constraint fk_show_movie foreign key (id_movie) references Movies(id_movie) on update cascade,
	constraint fk_show_cinema foreign key (id_cinema) references Cinemas(id_cinema) on update cascade
);

create table Rols(
	id_rol int auto_increment not null,
	rol_name varchar(20) not null,
	rol_description varchar(50) not null,
	constraint pk_rol primary key (id_rol)
);

create table Profiles(
	id_profile int auto_increment not null,
	profile_apellido varchar(20) not null,
	profile_nombre varchar(20) not null,
	profile_dni varchar(12) not null,
	constraint pk_profile primary key (id_profile)
);

create table Users(
	id_user int auto_increment not null,
	user_email varchar(30) not null,
	user_password varchar(20) not null,
	id_rol int not null,
	id_profile int not null,
	constraint pk_user primary key (id_user),
	constraint unq_user_email unique (user_email),
	constraint fk_user_rol foreign key (id_rol) references Rols(id_rol) on update cascade,
	constraint fk_user_profile foreign key (id_profile) references Profiles(id_profile) on update cascade
);

create table Counts(
	id_count int auto_increment,
	count_name varchar(40),
	constraint pk_count primary key (id_count) 
);

create table Payments(
	id_payment int auto_increment,
	auth_code int,
	payment_date date,
	payment_amount float,
	id_count int,
	constraint pk_payment primary key (id_payment),
	constraint fk_payment_count foreign key (id_count) references Counts(id_count) on update cascade
);

create table Purchases(
	id_purchase int auto_increment,
	purchase_discount int default 0,
	purchase_date date,
	id_payment int,
	id_user int,
	constraint pk_purchase primary key (id_purchase),
	constraint fk_purchase_payment foreign key (id_payment) references Payments(id_payment) on update cascade,
	constraint fk_purchase_user foreign key (id_user) references Users(id_user) on update cascade
);

create table Tickets(
	id_ticket int auto_increment,
	qr_code varchar(255),
	id_purchase int,
	id_show int,
	constraint pk_ticket primary key (id_ticket),
	constraint fk_ticket_purchase foreign key (id_purchase) references Purchases(id_purchase) on update cascade,
	constraint fk_ticket_show foreign key (id_show) references Shows(id_show) on update cascade
);




