<?php
namespace App\Service;

use Database;
use PDO;

/**
 * Servicio para métricas y analítica del Dashboard de Library 2.
 */
class HomeService {

	public function getDashboardData(): array {
		$totalBooks = count(\BookData::getAll());
		$totalCopies = \ItemData::countTotal();
		$availableCopies = count(\ItemData::getAvailable());
		$activeLoans = count(\OperationData::getActive());
		$totalClients = count(\ClientData::getAll());

		$loans = \OperationData::getActive();
		$today = date('Y-m-d');
		foreach ($loans as $l) {
			$l->item = $l->getItem();
			if ($l->item) {
				$l->item->book = $l->item->getBook();
			}
			$l->client = $l->getClient();
			$l->is_overdue = ($l->finish_at < $today);
		}

		$popularBooksRaw = $this->getPopularBooks(5);
		$popularBooksLabels = [];
		$popularBooksData = [];
		foreach ($popularBooksRaw as $b) {
			$popularBooksLabels[] = mb_strimwidth($b->title, 0, 25, '...');
			$popularBooksData[] = (int)$b->total_loans;
		}

		$popularCategoriesRaw = $this->getPopularCategories(6);
		$popularCategoriesLabels = [];
		$popularCategoriesData = [];
		foreach ($popularCategoriesRaw as $c) {
			$popularCategoriesLabels[] = $c->name;
			$popularCategoriesData[] = (int)$c->total_loans;
		}

		$loansTimeline = $this->getLoansTimeline(14);
		$latestBooks = $this->getLatestBooks(6);

		return [
			'totalBooks' => $totalBooks,
			'totalCopies' => $totalCopies,
			'availableCopies' => $availableCopies,
			'activeLoans' => $activeLoans,
			'totalClients' => $totalClients,
			'loans' => $loans,
			'popular_books' => $popularBooksRaw,
			'popular_books_labels' => $popularBooksLabels,
			'popular_books_data' => $popularBooksData,
			'popular_categories' => $popularCategoriesRaw,
			'popular_categories_labels' => $popularCategoriesLabels,
			'popular_categories_data' => $popularCategoriesData,
			'loans_timeline_labels' => $loansTimeline['labels'],
			'loans_timeline_data' => $loansTimeline['data'],
			'latest_books' => $latestBooks
		];
	}

	public function getPopularBooks(int $limit = 5): array {
		$pdo = Database::getPdo();
		$sql = "SELECT b.id, b.title, COUNT(o.id) as total_loans
				FROM book b
				JOIN item i ON b.id = i.book_id
				JOIN operation o ON i.id = o.item_id
				GROUP BY b.id, b.title
				ORDER BY total_loans DESC
				LIMIT :limit";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function getPopularCategories(int $limit = 6): array {
		$pdo = Database::getPdo();
		$sql = "SELECT c.id, c.name, COUNT(o.id) as total_loans
				FROM category c
				JOIN book b ON c.id = b.category_id
				JOIN item i ON b.id = i.book_id
				JOIN operation o ON i.id = o.item_id
				GROUP BY c.id, c.name
				ORDER BY total_loans DESC
				LIMIT :limit";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
		$stmt->execute();
		$cats = $stmt->fetchAll(PDO::FETCH_OBJ);

		if (count($cats) < $limit) {
			$sqlFallback = "SELECT c.id, c.name, COUNT(b.id) as total_loans
							FROM category c
							LEFT JOIN book b ON c.id = b.category_id
							GROUP BY c.id, c.name
							ORDER BY total_loans DESC
							LIMIT :limit";
			$stmtFb = $pdo->prepare($sqlFallback);
			$stmtFb->bindValue(':limit', $limit, PDO::PARAM_INT);
			$stmtFb->execute();
			$cats = $stmtFb->fetchAll(PDO::FETCH_OBJ);
		}
		return $cats;
	}

	public function getLoansTimeline(int $days = 14): array {
		$pdo = Database::getPdo();
		$labels = [];
		$dataMap = [];

		for ($i = $days - 1; $i >= 0; $i--) {
			$d = date('Y-m-d', strtotime("-$i days"));
			$label = date('d M', strtotime("-$i days"));
			$labels[] = $label;
			$dataMap[$d] = 0;
		}

		$sql = "SELECT DATE(start_at) as loan_date, COUNT(*) as total
				FROM operation
				WHERE start_at >= DATE_SUB(CURDATE(), INTERVAL :days DAY)
				GROUP BY DATE(start_at)
				ORDER BY loan_date ASC";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':days', $days, PDO::PARAM_INT);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_OBJ);

		foreach ($rows as $r) {
			if (isset($dataMap[$r->loan_date])) {
				$dataMap[$r->loan_date] = (int)$r->total;
			}
		}

		return [
			'labels' => $labels,
			'data' => array_values($dataMap)
		];
	}

	public function getLatestBooks(int $limit = 6): array {
		$books = \BookData::getLatest($limit);
		foreach ($books as $b) {
			$b->author = $b->getAuthor();
			$b->category = $b->getCategory();
			$b->editorial = $b->getEditorial();
			$b->total_copies = \ItemData::countByBookId($b->id);
			$b->available_copies = \ItemData::countAvailableByBookId($b->id);
		}
		return $books;
	}
}
