/**
* @author evilnapsis
* @brief Modelo de base de datos
* @date 2015-10-24
* @update 2026-03-05
* @version 3.0
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

-- ========================================================
-- DATOS DE DEMOSTRACIÓN (DEMO DATA)
-- ========================================================

-- Categorías
INSERT INTO category (id, name) VALUES
(1, 'Ciencia Ficción y Fantasía'),
(2, 'Novela y Ficción Literaria'),
(3, 'Tecnología y Programación'),
(4, 'Historia y Biografías'),
(5, 'Filosofía y Ensayo'),
(6, 'Desarrollo Personal y Productividad'),
(7, 'Psicología y Neurociencia'),
(8, 'Economía y Negocios'),
(9, 'Misterio y Suspenso'),
(10, 'Ciencia y Naturaleza'),
(11, 'Poesía y Teatro'),
(12, 'Arte y Diseño')
ON DUPLICATE KEY UPDATE id=id;

-- Autores
INSERT INTO author (id, name, lastname) VALUES
(1, 'Gabriel', 'García Márquez'),
(2, 'George', 'Orwell'),
(3, 'Isaac', 'Asimov'),
(4, 'Robert C.', 'Martin (Uncle Bob)'),
(5, 'Haruki', 'Murakami'),
(6, 'Yuval Noah', 'Harari'),
(7, 'Stephen', 'King'),
(8, 'Antoine', 'de Saint-Exupéry'),
(9, 'Arthur Conan', 'Doyle'),
(10, 'Franz', 'Kafka'),
(11, 'Walter', 'Isaacson'),
(12, 'Jane', 'Austen'),
(13, 'Mario', 'Vargas Llosa'),
(14, 'James', 'Clear'),
(15, 'Carl', 'Sagan')
ON DUPLICATE KEY UPDATE id=id;

-- Editoriales
INSERT INTO editorial (id, name) VALUES
(1, 'Penguin Random House'),
(2, 'Editorial Planeta'),
(3, 'O\'Reilly Media'),
(4, 'Alianza Editorial'),
(5, 'Fondo de Cultura Económica'),
(6, 'Anagrama'),
(7, 'Alfaguara'),
(8, 'HarperCollins'),
(9, 'Debate'),
(10, 'Paidós')
ON DUPLICATE KEY UPDATE id=id;

-- Lectores / Clientes
INSERT INTO client (id, name, lastname, email, address, phone, is_active, created_at) VALUES
(1, 'Carlos', 'Mendoza', 'carlos.mendoza@email.com', 'Av. Insurgentes 450, CDMX', '555-102-3041', 1, NOW()),
(2, 'Mariana', 'Ruiz', 'mariana.ruiz@email.com', 'Calle Juárez 128, Guadalajara', '555-204-5062', 1, NOW()),
(3, 'Alejandro', 'Gómez', 'alejandro.gomez@email.com', 'Blvd. Reforma 890, Monterrey', '555-306-7083', 1, NOW()),
(4, 'Valeria', 'Torres', 'valeria.torres@email.com', 'Av. Hidalgo 312, Puebla', '555-408-9104', 1, NOW()),
(5, 'Diego', 'Fernández', 'diego.fernandez@email.com', 'Calle Morelos 67, Querétaro', '555-510-1125', 1, NOW()),
(6, 'Sofía', 'Morales', 'sofia.morales@email.com', 'Av. Chapultepec 540, CDMX', '555-612-3146', 1, NOW()),
(7, 'Fernando', 'Castillo', 'fernando.castillo@email.com', 'Calle 60 No. 201, Mérida', '555-714-5167', 1, NOW()),
(8, 'Camila', 'Herrera', 'camila.herrera@email.com', 'Av. Revolución 345, Tijuana', '555-816-7188', 1, NOW()),
(9, 'Javier', 'Navarro', 'javier.navarro@email.com', 'Calle Zaragoza 45, León', '555-918-9209', 1, NOW()),
(10, 'Lucía', 'Paredes', 'lucia.paredes@email.com', 'Av. Carranza 112, Toluca', '555-120-1230', 1, NOW()),
(11, 'Roberto', 'Vega', 'roberto.vega@email.com', 'Calle 5 de Mayo 88, Veracruz', '555-222-3251', 1, NOW()),
(12, 'Daniela', 'Rojas', 'daniela.rojas@email.com', 'Av. Universidad 780, Morelia', '555-324-5272', 1, NOW()),
(13, 'Andrés', 'Silva', 'andres.silva@email.com', 'Calle Aldama 234, Chihuahua', '555-426-7293', 1, NOW()),
(14, 'Natalia', 'Ortiz', 'natalia.ortiz@email.com', 'Av. Juárez 90, Saltillo', '555-528-9314', 1, NOW()),
(15, 'Mateo', 'Delgado', 'mateo.delgado@email.com', 'Calle Mina 15, Oaxaca', '555-630-1335', 1, NOW())
ON DUPLICATE KEY UPDATE id=id;

-- Libros
INSERT INTO book (id, isbn, title, subtitle, description, year, n_pag, author_id, editorial_id, category_id) VALUES
(1, '978-0307474728', 'Cien años de soledad', 'Realismo mágico en Macondo', 'La saga épica de la familia Buendía a lo largo de siete generaciones.', 1967, 471, 1, 7, 2),
(2, '978-0451524935', '1984', 'El Gran Hermano te vigila', 'Novela distópica clásica sobre la vigilancia masiva y el totalitarismo.', 1949, 328, 2, 4, 1),
(3, '978-0553293357', 'Fundación', 'Trilogía de las Fundaciones', 'El inicio del plan de Hari Seldon para preservar el saber galáctico.', 1951, 255, 3, 4, 1),
(4, '978-0132350884', 'Clean Code', 'Manual de desarrollo ágil de software', 'Principios, patrones y prácticas para escribir código mantenible y elegante.', 2008, 464, 4, 3, 3),
(5, '978-0307948984', 'Tokio Blues', 'Norwegian Wood', 'Una novela introspectiva sobre el dolor, la pérdida y el amor juvenil.', 1987, 384, 5, 6, 2),
(6, '978-0062316097', 'Sapiens: De animales a dioses', 'Breve historia de la humanidad', 'Un recorrido fascinante sobre cómo nuestra especie dominó el planeta.', 2014, 496, 6, 9, 4),
(7, '978-0307743657', 'El Resplandor', 'Terror psicológico en el Hotel Overlook', 'El aislamiento de Jack Torrance y la manifestación del poder psíquico de Danny.', 1977, 688, 7, 2, 9),
(8, '978-0156012195', 'El Principito', 'Fábula poética ilustrada', 'Reflexión universal sobre la amistad, el sentido de la vida y el amor.', 1943, 96, 8, 4, 5),
(9, '978-0141040370', 'Estudio en Escarlata', 'La primera aventura de Sherlock Holmes', 'El encuentro legendario de Sherlock Holmes y el Dr. John Watson.', 1887, 180, 9, 1, 9),
(10, '978-0143105244', 'La Metamorfosis', 'La transformación de Gregorio Samsa', 'Alegoría impactante sobre la alienación social y el peso de las obligaciones.', 1915, 128, 10, 4, 5),
(11, '978-1451648539', 'Steve Jobs', 'La biografía exclusiva', 'La vida apasionada, creativa y compleja del fundador de Apple.', 2011, 656, 11, 9, 4),
(12, '978-0141439518', 'Orgullo y Prejuicio', 'Clásico de la literatura universal', 'El ingenioso romance entre Elizabeth Bennet y el altivo señor Darcy.', 1813, 416, 12, 1, 2),
(13, '978-8420471839', 'La fiesta del Chivo', 'Dictadura y memoria en el Caribe', 'Retrato descarnado de los últimos momentos del dictador Rafael Leónidas Trujillo.', 2000, 520, 13, 7, 2),
(14, '978-0735211292', 'Hábitos Atómicos', 'Pequeños cambios, grandes resultados', 'Estrategia práctica y comprobada para construir buenos hábitos cada día.', 2018, 320, 14, 10, 6),
(15, '978-0345539434', 'Cosmos', 'Las fronteras del universo', 'Viaje científico y poético por la astronomía, la historia y el cosmos.', 1980, 396, 15, 2, 10),
(16, '978-0451526342', 'Rebelión en la granja', 'Fábula satírica sobre el poder', 'Metáfora alegórica sobre la corrupción de los ideales revolucionarios.', 1945, 144, 2, 4, 2),
(17, '978-0553294385', 'Yo, Robot', 'Las tres leyes de la robótica', 'Cuentos fundacionales sobre inteligencia artificial, ética y máquinas.', 1950, 256, 3, 4, 1),
(18, '978-0134494166', 'Clean Architecture', 'Guía del artesano de software', 'Estructura universal para sistemas de software desacoplados y testeables.', 2017, 432, 4, 3, 3)
ON DUPLICATE KEY UPDATE id=id;

-- Ejemplares físicos
INSERT INTO item (id, code, status_id, book_id) VALUES
(1, 'LIB-001-A', 2, 1),
(2, 'LIB-001-B', 1, 1),
(3, 'LIB-002-A', 2, 2),
(4, 'LIB-002-B', 1, 2),
(5, 'LIB-003-A', 1, 3),
(6, 'LIB-004-A', 2, 4),
(7, 'LIB-004-B', 1, 4),
(8, 'LIB-005-A', 1, 5),
(9, 'LIB-006-A', 2, 6),
(10, 'LIB-006-B', 1, 6),
(11, 'LIB-007-A', 1, 7),
(12, 'LIB-008-A', 1, 8),
(13, 'LIB-008-B', 1, 8),
(14, 'LIB-009-A', 2, 9),
(15, 'LIB-010-A', 1, 10),
(16, 'LIB-011-A', 1, 11),
(17, 'LIB-012-A', 1, 12),
(18, 'LIB-013-A', 1, 13),
(19, 'LIB-014-A', 2, 14),
(20, 'LIB-014-B', 1, 14),
(21, 'LIB-015-A', 1, 15),
(22, 'LIB-016-A', 2, 16),
(23, 'LIB-017-A', 1, 17),
(24, 'LIB-018-A', 2, 18),
(25, 'LIB-018-B', 1, 18)
ON DUPLICATE KEY UPDATE id=id;

-- Préstamos y Devoluciones (Operaciones)
INSERT INTO operation (id, item_id, client_id, start_at, finish_at, returned_at, user_id, receptor_id) VALUES
(1, 1, 1, DATE_SUB(CURDATE(), INTERVAL 30 DAY), DATE_SUB(CURDATE(), INTERVAL 23 DAY), DATE_SUB(CURDATE(), INTERVAL 24 DAY), 1, 1),
(2, 3, 2, DATE_SUB(CURDATE(), INTERVAL 28 DAY), DATE_SUB(CURDATE(), INTERVAL 21 DAY), DATE_SUB(CURDATE(), INTERVAL 20 DAY), 1, 1),
(3, 6, 3, DATE_SUB(CURDATE(), INTERVAL 25 DAY), DATE_SUB(CURDATE(), INTERVAL 18 DAY), DATE_SUB(CURDATE(), INTERVAL 19 DAY), 1, 1),
(4, 9, 4, DATE_SUB(CURDATE(), INTERVAL 20 DAY), DATE_SUB(CURDATE(), INTERVAL 13 DAY), DATE_SUB(CURDATE(), INTERVAL 14 DAY), 1, 1),
(5, 14, 5, DATE_SUB(CURDATE(), INTERVAL 18 DAY), DATE_SUB(CURDATE(), INTERVAL 11 DAY), DATE_SUB(CURDATE(), INTERVAL 12 DAY), 1, 1),
(6, 19, 6, DATE_SUB(CURDATE(), INTERVAL 15 DAY), DATE_SUB(CURDATE(), INTERVAL 8 DAY), DATE_SUB(CURDATE(), INTERVAL 7 DAY), 1, 1),
(7, 22, 7, DATE_SUB(CURDATE(), INTERVAL 12 DAY), DATE_SUB(CURDATE(), INTERVAL 5 DAY), DATE_SUB(CURDATE(), INTERVAL 6 DAY), 1, 1),
(8, 24, 8, DATE_SUB(CURDATE(), INTERVAL 10 DAY), DATE_SUB(CURDATE(), INTERVAL 3 DAY), DATE_SUB(CURDATE(), INTERVAL 4 DAY), 1, 1),
(9, 1, 9, DATE_SUB(CURDATE(), INTERVAL 3 DAY), DATE_ADD(CURDATE(), INTERVAL 4 DAY), NULL, 1, NULL),
(10, 3, 10, DATE_SUB(CURDATE(), INTERVAL 2 DAY), DATE_ADD(CURDATE(), INTERVAL 5 DAY), NULL, 1, NULL),
(11, 6, 11, DATE_SUB(CURDATE(), INTERVAL 1 DAY), DATE_ADD(CURDATE(), INTERVAL 6 DAY), NULL, 1, NULL),
(12, 9, 12, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 7 DAY), NULL, 1, NULL),
(13, 19, 13, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 7 DAY), NULL, 1, NULL),
(14, 14, 14, DATE_SUB(CURDATE(), INTERVAL 14 DAY), DATE_SUB(CURDATE(), INTERVAL 7 DAY), NULL, 1, NULL),
(15, 22, 15, DATE_SUB(CURDATE(), INTERVAL 10 DAY), DATE_SUB(CURDATE(), INTERVAL 3 DAY), NULL, 1, NULL)
ON DUPLICATE KEY UPDATE id=id;

/**
* Gracias por Usar Library 2
* Powered by Evilnapsis
* https://evilnapsis.com
*/