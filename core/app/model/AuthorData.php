<?php
// Model for Book Authors
class AuthorData {
	public static $tablename = "author";

	public $id;
	public $name;
	public $lastname;

	public function __construct(){
		$this->name = "";
		$this->lastname = "";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (name, lastname) values (:name, :lastname)";
		return Executor::doit($sql, [
			':name' => $this->name,
			':lastname' => $this->lastname
		]);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=:id";
		return Executor::doit($sql, [':id' => $id]);
	}

	public function update(){
		$sql = "update ".self::$tablename." set name=:name, lastname=:lastname where id=:id";
		return Executor::doit($sql, [
			':name' => $this->name,
			':lastname' => $this->lastname,
			':id' => $this->id
		]);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=:id";
		$query = Executor::doit($sql, [':id' => $id]);
		return Model::one($query[0], new AuthorData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by name asc, lastname asc";
		$query = Executor::doit($sql);
		return Model::many($query[0], new AuthorData());
	}
}
