<?php
namespace App\Controller;

use App\Service\AuthService;
use ViewEngine;
use Req;

/**
 * Controlador de autenticación y sesiones de usuario.
 */
class AuthController {
	private $baseFolder;

	public function __construct() {
		$this->baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
	}

	/**
	 * Muestra la pantalla de login.
	 */
	public function showLogin() {
		if (AuthService::check()) {
			header('Location: ' . $this->baseFolder . '/home');
			exit;
		}
		ViewEngine::render('auth/login.html.twig');
	}

	/**
	 * Procesa las credenciales de acceso.
	 */
	public function processLogin() {
		$username = Req::post('username', '');
		$password = Req::post('password', '');

		$user = AuthService::attempt($username, $password);

		if ($user) {
			$_SESSION['user_id'] = $user->id;
			header('Location: ' . $this->baseFolder . '/home');
			exit;
		}

		ViewEngine::render('auth/login.html.twig', [
			'error' => 'Usuario o contraseña incorrectos.',
			'old_username' => $username
		]);
	}

	/**
	 * Cierra la sesión activa.
	 */
	public function logout() {
		if (isset($_SESSION['user_id'])) {
			unset($_SESSION['user_id']);
		}
		session_destroy();
		header('Location: ' . $this->baseFolder . '/login');
		exit;
	}
}
