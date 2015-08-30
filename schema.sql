create database library;
use library; 

create table admin (
	id int not null auto_increment primary key,
	nombre varchar(50) not null,
	apellido varchar(50) not null,
	email varchar(255) not null,
	password varchar(60) not null,
	is_active boolean not null default 1,
	is_admin boolean not null default 0,
	created_at datetime not null
);

insert into admin (email,password,is_admin) value ("admin","admin",1);

create table usuario (
	id int not null auto_increment primary key,
	nombre varchar(50) not null,
	apellido varchar(50) not null,
	email varchar(255) not null,
	direccion varchar(60) not null,
	telefono varchar(60) not null,
	is_active boolean not null default 1,
	created_at datetime not null
);



create table autor (
	id int not null auto_increment primary key,
	nombre varchar(200) not null,
	apellido varchar(1000) not null
);

create table editorial (
	id int not null auto_increment primary key,
	nombre varchar(200) not null);

create table categoria (
	id int not null auto_increment primary key,
	nombre varchar(200) not null
);


create table libro (
	id int not null auto_increment primary key,
	isbn varchar(100),
	titulo varchar(200) not null,
	subtitulo varchar(1000) not null,
	imagen varchar(255),
	anio int,
	num_pag int,
	autor_id int not null,
	editorial_id int not null,
	categoria_id int not null,
	foreign key (autor_id) references autor(id),
	foreign key (editorial_id) references editorial(id),
	foreign key (categoria_id) references categoria(id)
);


create table ejemplar(
	id int not null auto_increment primary key,
	codigo varchar(100) unique,
	libro_id int not null,
	status int not null default 0,
	foreign key (libro_id) references libro(id)
);

create table prestamo(
	id int not null auto_increment primary key,
	ejemplar_id int not null,
	usuario_id int not null,
	created_at date not null,
	return_at date not null,
	returned_at date,
	prestador_id int not null,
	receptor_id int ,
	foreign key (usuario_id) references usuario(id),
	foreign key (prestador_id) references admin(id),
	foreign key (receptor_id) references admin(id),
	foreign key (ejemplar_id) references ejemplar(id)
);



