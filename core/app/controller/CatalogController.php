<?php
namespace App\Controller;

use App\Service\CatalogService;
use ViewEngine;
use Req;

/**
 * Controlador de catálogos auxiliares: Autores, Editoriales y Categorías.
 */
class CatalogController {
	private $catalogService;
	private $baseFolder;

	public function __construct() {
		$this->catalogService = new CatalogService();
		$this->baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
	}

	// Autores
	public function authors() {
		ViewEngine::render('catalogs/authors.html.twig', [
			'authors' => $this->catalogService->getAllAuthors()
		]);
	}

	public function createAuthor() {
		$this->catalogService->createAuthor($_POST);
		header('Location: ' . $this->baseFolder . '/authors');
		exit;
	}

	public function deleteAuthor($vars) {
		$this->catalogService->deleteAuthor($vars['id']);
		header('Location: ' . $this->baseFolder . '/authors');
		exit;
	}

	// Editoriales
	public function editorials() {
		ViewEngine::render('catalogs/editorials.html.twig', [
			'editorials' => $this->catalogService->getAllEditorials()
		]);
	}

	public function createEditorial() {
		$this->catalogService->createEditorial($_POST);
		header('Location: ' . $this->baseFolder . '/editorials');
		exit;
	}

	public function deleteEditorial($vars) {
		$this->catalogService->deleteEditorial($vars['id']);
		header('Location: ' . $this->baseFolder . '/editorials');
		exit;
	}

	// Categorías
	public function categories() {
		ViewEngine::render('catalogs/categories.html.twig', [
			'categories' => $this->catalogService->getAllCategories()
		]);
	}

	public function createCategory() {
		$this->catalogService->createCategory($_POST);
		header('Location: ' . $this->baseFolder . '/categories');
		exit;
	}

	public function deleteCategory($vars) {
		$this->catalogService->deleteCategory($vars['id']);
		header('Location: ' . $this->baseFolder . '/categories');
		exit;
	}
}
