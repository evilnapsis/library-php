<?php
namespace App\Service;

/**
 * Servicio para autenticación y control de sesión de usuarios.
 */
class AuthService {
	/**
	 * Verifica si hay una sesión activa.
	 */
	public static function check(): bool {
		return isset($_SESSION['user_id']);
	}

	/**
	 * Retorna el usuario autenticado actualmente.
	 */
	public static function user() {
		if (!self::check()) {
			return null;
		}
		return \UserData::getById($_SESSION['user_id']);
	}

	/**
	 * Intenta autenticar con credenciales. Retorna UserData si es válido o null.
	 */
	public static function attempt(string $username, string $password) {
		$hash = sha1(md5($password));
		$user = \UserData::getByUsername($username);
		if (!$user) {
			// Intentar por email
			foreach (\UserData::getAll() as $u) {
				if ($u->email === $username || $u->username === $username) {
					$user = $u;
					break;
				}
			}
		}

		if ($user && $user->password === $hash) {
			$isActive = isset($user->status) ? ($user->status == 1) : (isset($user->is_active) ? $user->is_active == 1 : true);
			if ($isActive) {
				return $user;
			}
		}
		return null;
	}
}
