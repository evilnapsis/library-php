<?php
namespace App\Service;

/**
 * Servicio para gestión de catálogos auxiliares: Autores, Editoriales y Categorías.
 */
class CatalogService {

	// Autores
	public function getAllAuthors(): array {
		return \AuthorData::getAll();
	}

	public function createAuthor(array $data) {
		$a = new \AuthorData();
		$a->name = trim($data['name'] ?? '');
		$a->lastname = trim($data['lastname'] ?? '');
		return $a->add();
	}

	public function deleteAuthor($id) {
		return \AuthorData::delById($id);
	}

	// Editoriales
	public function getAllEditorials(): array {
		return \EditorialData::getAll();
	}

	public function createEditorial(array $data) {
		$e = new \EditorialData();
		$e->name = trim($data['name'] ?? '');
		return $e->add();
	}

	public function deleteEditorial($id) {
		return \EditorialData::delById($id);
	}

	// Categorías
	public function getAllCategories(): array {
		return \CategoryData::getAll();
	}

	public function createCategory(array $data) {
		$c = new \CategoryData();
		$c->name = trim($data['name'] ?? '');
		return $c->add();
	}

	public function deleteCategory($id) {
		return \CategoryData::delById($id);
	}

	public function getStatuses(): array {
		return \StatusData::getAll();
	}
}
