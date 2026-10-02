<?php
namespace App\Service;

/**
 * Servicio para catálogo de libros y ejemplares físicos en Library 2.
 */
class BookService {

	public function getAllBooks(): array {
		$books = \BookData::getAll();
		foreach ($books as $b) {
			$b->author = $b->getAuthor();
			$b->editorial = $b->getEditorial();
			$b->category = $b->getCategory();
			$b->total_copies = \ItemData::countByBookId($b->id);
			$b->available_copies = \ItemData::countAvailableByBookId($b->id);
		}
		return $books;
	}

	public function getBookById($id) {
		$b = \BookData::getById($id);
		if ($b) {
			$b->author = $b->getAuthor();
			$b->editorial = $b->getEditorial();
			$b->category = $b->getCategory();
			$b->items = \ItemData::getAllByBookId($b->id);
			foreach ($b->items as $it) {
				$it->status = $it->getStatus();
			}
		}
		return $b;
	}

	public function createBook(array $data) {
		$b = new \BookData();
		$b->isbn = trim($data['isbn'] ?? '');
		$b->title = trim($data['title'] ?? '');
		$b->subtitle = trim($data['subtitle'] ?? '');
		$b->description = trim($data['description'] ?? '');
		$b->year = !empty($data['year']) ? (int)$data['year'] : (int)date('Y');
		$b->n_pag = !empty($data['n_pag']) ? (int)$data['n_pag'] : 0;
		$b->author_id = !empty($data['author_id']) ? (int)$data['author_id'] : null;
		$b->editorial_id = !empty($data['editorial_id']) ? (int)$data['editorial_id'] : null;
		$b->category_id = !empty($data['category_id']) ? (int)$data['category_id'] : null;
		return $b->add();
	}

	public function updateBook($id, array $data) {
		$b = \BookData::getById($id);
		if (!$b) return false;
		$b->isbn = trim($data['isbn'] ?? $b->isbn);
		$b->title = trim($data['title'] ?? $b->title);
		$b->subtitle = trim($data['subtitle'] ?? $b->subtitle);
		$b->description = trim($data['description'] ?? $b->description);
		$b->year = !empty($data['year']) ? (int)$data['year'] : $b->year;
		$b->n_pag = !empty($data['n_pag']) ? (int)$data['n_pag'] : $b->n_pag;
		$b->author_id = !empty($data['author_id']) ? (int)$data['author_id'] : $b->author_id;
		$b->editorial_id = !empty($data['editorial_id']) ? (int)$data['editorial_id'] : $b->editorial_id;
		$b->category_id = !empty($data['category_id']) ? (int)$data['category_id'] : $b->category_id;
		return $b->update();
	}

	public function deleteBook($id) {
		return \BookData::delById($id);
	}

	// Ejemplares Físicos
	public function addItem($book_id, array $data) {
		$it = new \ItemData();
		$it->code = trim($data['code'] ?? '');
		$it->status_id = (int)($data['status_id'] ?? 1);
		$it->book_id = (int)$book_id;
		return $it->add();
	}

	public function deleteItem($item_id) {
		return \ItemData::delById($item_id);
	}

	public function setItemStatus($item_id, $status_id) {
		$it = \ItemData::getById($item_id);
		if ($it) {
			return $it->setStatus($status_id);
		}
		return false;
	}
}
