<?php
namespace App\Service;

/**
 * Servicio para gestión y administración de usuarios del sistema.
 */
class UserService {
	/**
	 * Retorna la lista de todos los usuarios.
	 */
	public function getAllUsers(): array {
		return \UserData::getAll();
	}

	/**
	 * Obtiene un usuario por ID.
	 */
	public function getUserById($id) {
		return \UserData::getById($id);
	}

	/**
	 * Registra un nuevo usuario en el sistema.
	 */
	public function createUser(array $data): void {
		$user = new \UserData();
		$user->name = trim($data['name'] ?? '');
		$user->lastname = trim($data['lastname'] ?? '');
		$user->username = trim($data['username'] ?? '');
		$user->email = trim($data['email'] ?? '');
		$user->status = isset($data['status']) ? (int)$data['status'] : 1;
		$user->kind = isset($data['kind']) ? (int)$data['kind'] : 1;
		$user->password = sha1(md5($data['password'] ?? ''));
		$user->add();
	}

	/**
	 * Actualiza los datos de un usuario existente.
	 */
	public function updateUser($id, array $data): void {
		$user = \UserData::getById($id);
		if (!$user) return;

		$user->name = trim($data['name'] ?? $user->name);
		$user->lastname = trim($data['lastname'] ?? $user->lastname);
		$user->username = trim($data['username'] ?? $user->username);
		$user->email = trim($data['email'] ?? $user->email);
		$user->status = isset($data['status']) ? (int)$data['status'] : $user->status;
		$user->kind = isset($data['kind']) ? (int)$data['kind'] : $user->kind;
		$user->update();

		if (!empty($data['password'])) {
			$user->password = sha1(md5($data['password']));
			$user->update_passwd();
		}
	}

	/**
	 * Elimina un usuario impidiendo que se elimine a sí mismo.
	 */
	public function deleteUser($id, $currentUserId): bool {
		if ((string)$id === (string)$currentUserId) {
			return false;
		}
		\UserData::delById($id);
		return true;
	}
}
