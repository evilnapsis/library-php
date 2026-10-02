<?php
use App\Controller\HomeController;
use App\Controller\AuthController;
use App\Controller\ProfileController;
use App\Controller\BookController;
use App\Controller\LoanController;
use App\Controller\ClientController;
use App\Controller\CatalogController;
use App\Controller\ReportController;
use App\Controller\UserController;

/**
 * Definición centralizada de rutas para Library 2.
 */
return function(FastRoute\RouteCollector $r) {
	// Raíz y Dashboard
	$r->addRoute('GET', '/', [HomeController::class, 'index']);
	$r->addRoute('GET', '/home', [HomeController::class, 'index']);

	// Autenticación
	$r->addRoute('GET', '/login', [AuthController::class, 'showLogin']);
	$r->addRoute('POST', '/login', [AuthController::class, 'processLogin']);
	$r->addRoute('GET', '/logout', [AuthController::class, 'logout']);

	// Perfil de Usuario
	$r->addRoute('GET', '/profile', [ProfileController::class, 'index']);
	$r->addRoute('POST', '/profile/change-password', [ProfileController::class, 'changePassword']);

	// Catálogo de Libros
	$r->addRoute('GET', '/books', [BookController::class, 'index']);
	$r->addRoute('GET', '/books/new', [BookController::class, 'new']);
	$r->addRoute('POST', '/books/create', [BookController::class, 'create']);
	$r->addRoute('GET', '/books/edit/{id:\d+}', [BookController::class, 'edit']);
	$r->addRoute('POST', '/books/update/{id:\d+}', [BookController::class, 'update']);
	$r->addRoute('GET', '/books/delete/{id:\d+}', [BookController::class, 'delete']);

	// Ejemplares de Libros (Items)
	$r->addRoute('GET', '/books/{id:\d+}/items', [BookController::class, 'items']);
	$r->addRoute('POST', '/books/{id:\d+}/items/create', [BookController::class, 'createItem']);
	$r->addRoute('GET', '/books/items/delete/{id:\d+}', [BookController::class, 'deleteItem']);
	$r->addRoute('POST', '/books/items/status/{id:\d+}', [BookController::class, 'setStatusItem']);

	// Préstamos y Devoluciones
	$r->addRoute('GET', '/loans', [LoanController::class, 'index']);
	$r->addRoute('GET', '/loans/new', [LoanController::class, 'new']);
	$r->addRoute('POST', '/loans/create', [LoanController::class, 'create']);
	$r->addRoute('GET', '/loans/return/{id:\d+}', [LoanController::class, 'returnBook']);
	$r->addRoute('GET', '/loans/delete/{id:\d+}', [LoanController::class, 'delete']);

	// Lectores / Socios
	$r->addRoute('GET', '/clients', [ClientController::class, 'index']);
	$r->addRoute('GET', '/clients/new', [ClientController::class, 'new']);
	$r->addRoute('POST', '/clients/create', [ClientController::class, 'create']);
	$r->addRoute('GET', '/clients/edit/{id:\d+}', [ClientController::class, 'edit']);
	$r->addRoute('POST', '/clients/update/{id:\d+}', [ClientController::class, 'update']);
	$r->addRoute('GET', '/clients/delete/{id:\d+}', [ClientController::class, 'delete']);

	// Autores, Editoriales, Categorías
	$r->addRoute('GET', '/authors', [CatalogController::class, 'authors']);
	$r->addRoute('POST', '/authors/create', [CatalogController::class, 'createAuthor']);
	$r->addRoute('GET', '/authors/delete/{id:\d+}', [CatalogController::class, 'deleteAuthor']);

	$r->addRoute('GET', '/editorials', [CatalogController::class, 'editorials']);
	$r->addRoute('POST', '/editorials/create', [CatalogController::class, 'createEditorial']);
	$r->addRoute('GET', '/editorials/delete/{id:\d+}', [CatalogController::class, 'deleteEditorial']);

	$r->addRoute('GET', '/categories', [CatalogController::class, 'categories']);
	$r->addRoute('POST', '/categories/create', [CatalogController::class, 'createCategory']);
	$r->addRoute('GET', '/categories/delete/{id:\d+}', [CatalogController::class, 'deleteCategory']);

	// Reportes
	$r->addRoute('GET', '/reports', [ReportController::class, 'index']);
	$r->addRoute('GET', '/reports/csv', [ReportController::class, 'exportCsv']);

	// Gestión de Usuarios
	$r->addRoute('GET', '/users', [UserController::class, 'index']);
	$r->addRoute('GET', '/users/new', [UserController::class, 'new']);
	$r->addRoute('POST', '/users/create', [UserController::class, 'create']);
	$r->addRoute('GET', '/users/edit/{id:\d+}', [UserController::class, 'edit']);
	$r->addRoute('POST', '/users/update/{id:\d+}', [UserController::class, 'update']);
	$r->addRoute('GET', '/users/delete/{id:\d+}', [UserController::class, 'delete']);
};
