<?php
namespace App\Controller;

use App\Service\ClientService;
use ViewEngine;
use Req;

/**
 * Controlador de socios y lectores de la biblioteca.
 */
class ClientController {
	private $clientService;
	private $baseFolder;

	public function __construct() {
		$this->clientService = new ClientService();
		$this->baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
	}

	public function index() {
		$clients = $this->clientService->getAllClients();
		ViewEngine::render('clients/index.html.twig', [
			'clients' => $clients
		]);
	}

	public function new() {
		ViewEngine::render('clients/new.html.twig');
	}

	public function create() {
		$this->clientService->createClient($_POST);
		header('Location: ' . $this->baseFolder . '/clients');
		exit;
	}

	public function edit($vars) {
		$id = $vars['id'];
		$client = $this->clientService->getClientById($id);
		if (!$client) {
			header('Location: ' . $this->baseFolder . '/clients');
			exit;
		}
		ViewEngine::render('clients/edit.html.twig', [
			'c' => $client
		]);
	}

	public function update($vars) {
		$id = $vars['id'];
		$this->clientService->updateClient($id, $_POST);
		header('Location: ' . $this->baseFolder . '/clients');
		exit;
	}

	public function delete($vars) {
		$id = $vars['id'];
		$this->clientService->deleteClient($id);
		header('Location: ' . $this->baseFolder . '/clients');
		exit;
	}
}
