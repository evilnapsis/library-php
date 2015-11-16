/**
* @author evilnapsis
* @brief Modelo de base de datos
* @date 2015-10-24
**/
create database library2;
use library2; 

create table user (
	id int not null auto_increment primary key,
	name varchar(50) not null,
	lastname varchar(50) not null,
	username varchar(50) not null,
	email varchar(255) not null,
	password varchar(60) not null,
	is_active boolean not null default 1,
	is_admin boolean not null default 0,
	created_at datetime not null
);

insert into user (name,username,password,is_active,is_admin,created_at) value ("Administrador","admin",sha1(md5("admin")),1,1,NOW());

create table client (
	id int not null auto_increment primary key,
	name varchar(50) not null,
	lastname varchar(50) not null,
	email varchar(255) not null,
	address varchar(60) not null,
	phone varchar(60) not null,
	is_active boolean not null default 1,
	created_at datetime not null
);

create table author (
	id int not null auto_increment primary key,
	name varchar(200) not null,
	lastname varchar(1000) not null
);

create table editorial (
	id int not null auto_increment primary key,
	name varchar(200) not null);

create table category (
	id int not null auto_increment primary key,
	name varchar(200) not null
);

create table status (
	id int not null auto_increment primary key,
	name varchar(200) not null
);

insert into status (name) values ("Disponible"),("Ocupado"),("Inactivo");

create table book (
	id int not null auto_increment primary key,
	isbn varchar(100),
	title varchar(200) not null,
	subtitle varchar(1000) not null,
	description varchar(1000) not null,
	file varchar(255),
	image varchar(255),
	year int,
	n_pag int,
	author_id int,
	editorial_id int,
	category_id int,
	foreign key (author_id) references author(id),
	foreign key (editorial_id) references editorial(id),
	foreign key (category_id) references category(id)
);

create table item(
	id int not null auto_increment primary key,
	code varchar(100),
	status_id int not null,
	foreign key (status_id) references status(id),
	book_id int not null,
	foreign key (book_id) references book(id)
);

create table operation(
	id int not null auto_increment primary key,
	item_id int not null,
	client_id int not null,
	start_at date not null,
	finish_at date not null,
	returned_at date,
	user_id int not null,
	receptor_id int ,
	foreign key (client_id) references client(id),
	foreign key (user_id) references user(id),
	foreign key (receptor_id) references user(id),
	foreign key (item_id) references item(id)
);
