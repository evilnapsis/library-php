<?php
namespace App\Service;

/**
 * Servicio para padrón de lectores y socios de la biblioteca.
 */
class ClientService {

	public function getAllClients(): array {
		return \ClientData::getAll();
	}

	public function getClientById($id) {
		return \ClientData::getById($id);
	}

	public function createClient(array $data) {
		$c = new \ClientData();
		$c->name = trim($data['name'] ?? '');
		$c->lastname = trim($data['lastname'] ?? '');
		$c->email = trim($data['email'] ?? '');
		$c->address = trim($data['address'] ?? '');
		$c->phone = trim($data['phone'] ?? '');
		return $c->add();
	}

	public function updateClient($id, array $data) {
		$c = \ClientData::getById($id);
		if (!$c) return false;
		$c->name = trim($data['name'] ?? $c->name);
		$c->lastname = trim($data['lastname'] ?? $c->lastname);
		$c->email = trim($data['email'] ?? $c->email);
		$c->address = trim($data['address'] ?? $c->address);
		$c->phone = trim($data['phone'] ?? $c->phone);
		return $c->update();
	}

	public function deleteClient($id) {
		return \ClientData::delById($id);
	}
}
