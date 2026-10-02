<?php
/**
 * Modelo de usuarios administradores y operadores del sistema.
 */
class UserData {
	public static $tablename = "user";
	public $id;
	public $name;
	public $lastname;
	public $username;
	public $email;
	public $password;
	public $image;
	public $status;
	public $kind;
	public $created_at;

	// Propiedades de compatibilidad en tiempo de ejecución
	public $is_admin = 0;
	public $is_active = 1;

	public function __construct(){
		$this->name = "";
		$this->lastname = "";
		$this->username = "";
		$this->email = "";
		$this->image = "";
		$this->password = "";
		$this->status = 1;
		$this->kind = 1;
		$this->created_at = date("Y-m-d H:i:s");
	}

	private static function db(): \PDO {
		return Database::getPdo();
	}

	/**
	 * Inserta un nuevo usuario en la base de datos.
	 */
	public function add(){
		$stmt = self::db()->prepare(
			"INSERT INTO " . self::$tablename . " (name, lastname, username, email, password, image, status, kind, created_at) " .
			"VALUES (:name, :lastname, :username, :email, :password, :image, :status, :kind, NOW())"
		);
		$stmt->execute([
			'name' => $this->name,
			'lastname' => $this->lastname,
			'username' => $this->username,
			'email' => $this->email,
			'password' => $this->password,
			'image' => $this->image ?: '',
			'status' => $this->status ?: 1,
			'kind' => $this->kind ?: 1,
		]);
		$this->id = self::db()->lastInsertId();
	}

	/**
	 * Elimina un usuario por su ID.
	 */
	public static function delById($id){
		$stmt = self::db()->prepare("DELETE FROM " . self::$tablename . " WHERE id = :id");
		$stmt->execute(['id' => $id]);
	}

	public function del(){
		self::delById($this->id);
	}

	/**
	 * Actualiza los datos de un usuario existente.
	 */
	public function update(){
		$stmt = self::db()->prepare(
			"UPDATE " . self::$tablename . " SET name = :name, lastname = :lastname, username = :username, " .
			"email = :email, status = :status, kind = :kind WHERE id = :id"
		);
		$stmt->execute([
			'name' => $this->name,
			'lastname' => $this->lastname,
			'username' => $this->username,
			'email' => $this->email,
			'status' => $this->status ?: 1,
			'kind' => $this->kind ?: 1,
			'id' => $this->id,
		]);
	}

	/**
	 * Actualiza únicamente la contraseña encriptada del usuario.
	 */
	public function update_passwd(){
		$stmt = self::db()->prepare("UPDATE " . self::$tablename . " SET password = :password WHERE id = :id");
		$stmt->execute(['password' => $this->password, 'id' => $this->id]);
	}

	/**
	 * Obtiene un usuario por ID.
	 */
	public static function getById($id){
		$stmt = self::db()->prepare("SELECT * FROM " . self::$tablename . " WHERE id = :id");
		$stmt->execute(['id' => $id]);
		$stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
		return $stmt->fetch() ?: null;
	}

	/**
	 * Obtiene un usuario por username.
	 */
	public static function getByUsername($username){
		$stmt = self::db()->prepare("SELECT * FROM " . self::$tablename . " WHERE username = :u");
		$stmt->execute(['u' => $username]);
		$stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
		return $stmt->fetch() ?: null;
	}

	/**
	 * Obtiene todos los usuarios.
	 */
	public static function getAll(){
		$stmt = self::db()->query("SELECT * FROM " . self::$tablename . " ORDER BY id ASC");
		return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
	}

	/**
	 * Búsqueda de usuarios por nombre o username.
	 */
	public static function getLike($q){
		$stmt = self::db()->prepare("SELECT * FROM " . self::$tablename . " WHERE name LIKE :q OR username LIKE :q");
		$stmt->execute(['q' => "%$q%"]);
		return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::class);
	}
}
?>
