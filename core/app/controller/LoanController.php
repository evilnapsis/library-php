<?php
namespace App\Controller;

use App\Service\LoanService;
use App\Service\ClientService;
use ViewEngine;
use Req;

/**
 * Controlador para la gestión de préstamos y devoluciones de libros.
 */
class LoanController {
	private $loanService;
	private $baseFolder;

	public function __construct() {
		$this->loanService = new LoanService();
		$this->baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
	}

	public function index() {
		$loans = $this->loanService->getAllLoans();
		ViewEngine::render('loans/index.html.twig', [
			'loans' => $loans
		]);
	}

	public function new() {
		$clientService = new ClientService();
		$clients = $clientService->getAllClients();
		$items = \ItemData::getAvailable();
		foreach ($items as $it) {
			$it->book = $it->getBook();
		}
		$selected_item_id = $_GET['item_id'] ?? null;
		ViewEngine::render('loans/new.html.twig', [
			'clients' => $clients,
			'items' => $items,
			'selected_item_id' => $selected_item_id
		]);
	}

	public function create() {
		$user_id = $_SESSION['user_id'] ?? 1;
		$this->loanService->createLoan($_POST, $user_id);
		header('Location: ' . $this->baseFolder . '/loans');
		exit;
	}

	public function returnBook($vars) {
		$id = $vars['id'];
		$user_id = $_SESSION['user_id'] ?? 1;
		$this->loanService->returnLoan($id, $user_id);
		header('Location: ' . $this->baseFolder . '/loans');
		exit;
	}

	public function delete($vars) {
		$id = $vars['id'];
		$this->loanService->deleteLoan($id);
		header('Location: ' . $this->baseFolder . '/loans');
		exit;
	}
}
