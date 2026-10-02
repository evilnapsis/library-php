<?php
namespace App\Controller;

use App\Service\UserService;
use ViewEngine;
use Req;

/**
 * Controlador del perfil del usuario autenticado y actualización de contraseña.
 */
class ProfileController {
	private $userService;
	private $baseFolder;

	public function __construct() {
		$this->userService = new UserService();
		$this->baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
	}

	/**
	 * Muestra la información de perfil.
	 */
	public function index() {
		$userId = $_SESSION['user_id'] ?? null;
		$user = $userId ? $this->userService->getUserById($userId) : null;
		ViewEngine::render('profile/index.html.twig', ['user' => $user]);
	}

	/**
	 * Procesa el cambio de contraseña del usuario activo.
	 */
	public function changePassword() {
		$userId = $_SESSION['user_id'] ?? null;
		$user = $userId ? $this->userService->getUserById($userId) : null;
		if (!$user) {
			header('Location: ' . $this->baseFolder . '/login');
			exit;
		}

		$currentPassword = Req::post('password', '');
		$newPassword = Req::post('newpassword', '');
		$confirmPassword = Req::post('confirmnewpassword', '');

		if ($user->password !== sha1(md5($currentPassword))) {
			$_SESSION['error'] = 'La contraseña actual no es correcta.';
			header('Location: ' . $this->baseFolder . '/profile');
			exit;
		}

		if (empty($newPassword) || $newPassword !== $confirmPassword) {
			$_SESSION['error'] = 'Las nuevas contraseñas no coinciden o están vacías.';
			header('Location: ' . $this->baseFolder . '/profile');
			exit;
		}

		$user->password = sha1(md5($newPassword));
		$user->update_passwd();

		$_SESSION['success'] = 'Contraseña actualizada con éxito.';
		header('Location: ' . $this->baseFolder . '/profile');
		exit;
	}
}
