<?php
namespace App\Service;

/**
 * Servicio para préstamos y devoluciones de libros en Library 2.
 */
class LoanService {

	public function getAllLoans(): array {
		$loans = \OperationData::getAll();
		$today = date('Y-m-d');
		foreach ($loans as $l) {
			$l->item = $l->getItem();
			if ($l->item) {
				$l->item->book = $l->item->getBook();
			}
			$l->client = $l->getClient();
			$l->user = $l->getUser();
			$l->is_overdue = ($l->returned_at === null && $l->finish_at < $today);
		}
		return $loans;
	}

	public function getActiveLoans(): array {
		$loans = \OperationData::getActive();
		$today = date('Y-m-d');
		foreach ($loans as $l) {
			$l->item = $l->getItem();
			if ($l->item) {
				$l->item->book = $l->item->getBook();
			}
			$l->client = $l->getClient();
			$l->user = $l->getUser();
			$l->is_overdue = ($l->finish_at < $today);
		}
		return $loans;
	}

	public function getLoanById($id) {
		$l = \OperationData::getById($id);
		if ($l) {
			$l->item = $l->getItem();
			if ($l->item) {
				$l->item->book = $l->item->getBook();
			}
			$l->client = $l->getClient();
			$l->user = $l->getUser();
		}
		return $l;
	}

	public function createLoan(array $data, $user_id) {
		$item_id = (int)$data['item_id'];
		$item = \ItemData::getById($item_id);
		if (!$item) return false;

		$op = new \OperationData();
		$op->item_id = $item_id;
		$op->client_id = (int)$data['client_id'];
		$op->start_at = !empty($data['start_at']) ? $data['start_at'] : date('Y-m-d');
		$op->finish_at = !empty($data['finish_at']) ? $data['finish_at'] : date('Y-m-d', strtotime('+7 days'));
		$op->user_id = (int)$user_id;

		$res = $op->add();
		if ($res) {
			$item->setStatus(2); // 2 = Ocupado / Prestado
		}
		return $res;
	}

	public function returnLoan($id, $receptor_id) {
		$op = \OperationData::getById($id);
		if (!$op) return false;

		$res = $op->returnBook($receptor_id);
		if ($res) {
			$item = \ItemData::getById($op->item_id);
			if ($item) {
				$item->setStatus(1); // 1 = Disponible
			}
		}
		return $res;
	}

	public function deleteLoan($id) {
		$op = \OperationData::getById($id);
		if ($op && $op->returned_at === null) {
			$item = \ItemData::getById($op->item_id);
			if ($item) {
				$item->setStatus(1);
			}
		}
		return \OperationData::delById($id);
	}
}
