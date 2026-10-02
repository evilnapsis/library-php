<?php
namespace App\Controller;

use App\Service\BookService;
use App\Service\CatalogService;
use ViewEngine;
use Req;

/**
 * Controlador para administración del catálogo de libros y ejemplares físicos.
 */
class BookController {
	private $bookService;
	private $catalogService;
	private $baseFolder;

	public function __construct() {
		$this->bookService = new BookService();
		$this->catalogService = new CatalogService();
		$this->baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
	}

	public function index() {
		$books = $this->bookService->getAllBooks();
		ViewEngine::render('books/index.html.twig', [
			'books' => $books
		]);
	}

	public function new() {
		ViewEngine::render('books/new.html.twig', [
			'authors' => $this->catalogService->getAllAuthors(),
			'editorials' => $this->catalogService->getAllEditorials(),
			'categories' => $this->catalogService->getAllCategories()
		]);
	}

	public function create() {
		$this->bookService->createBook($_POST);
		header('Location: ' . $this->baseFolder . '/books');
		exit;
	}

	public function edit($vars) {
		$id = $vars['id'];
		$book = $this->bookService->getBookById($id);
		if (!$book) {
			header('Location: ' . $this->baseFolder . '/books');
			exit;
		}
		ViewEngine::render('books/edit.html.twig', [
			'b' => $book,
			'authors' => $this->catalogService->getAllAuthors(),
			'editorials' => $this->catalogService->getAllEditorials(),
			'categories' => $this->catalogService->getAllCategories()
		]);
	}

	public function update($vars) {
		$id = $vars['id'];
		$this->bookService->updateBook($id, $_POST);
		header('Location: ' . $this->baseFolder . '/books');
		exit;
	}

	public function delete($vars) {
		$id = $vars['id'];
		$this->bookService->deleteBook($id);
		header('Location: ' . $this->baseFolder . '/books');
		exit;
	}

	// Ejemplares físicos
	public function items($vars) {
		$id = $vars['id'];
		$book = $this->bookService->getBookById($id);
		if (!$book) {
			header('Location: ' . $this->baseFolder . '/books');
			exit;
		}
		$statuses = $this->catalogService->getStatuses();
		ViewEngine::render('books/items.html.twig', [
			'b' => $book,
			'statuses' => $statuses
		]);
	}

	public function createItem($vars) {
		$id = $vars['id'];
		$this->bookService->addItem($id, $_POST);
		header('Location: ' . $this->baseFolder . '/books/' . $id . '/items');
		exit;
	}

	public function deleteItem($vars) {
		$this->bookService->deleteItem($vars['id']);
		$book_id = $_GET['book_id'] ?? '';
		header('Location: ' . $this->baseFolder . ($book_id ? '/books/' . $book_id . '/items' : '/books'));
		exit;
	}

	public function setStatusItem($vars) {
		$this->bookService->setItemStatus($vars['id'], $_POST['status_id'] ?? 1);
		$book_id = $_POST['book_id'] ?? '';
		header('Location: ' . $this->baseFolder . ($book_id ? '/books/' . $book_id . '/items' : '/books'));
		exit;
	}
}
