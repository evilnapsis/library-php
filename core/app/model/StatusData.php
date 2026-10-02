<?php
// Model for Book Item Status (Disponible, Ocupado/Prestado, Inactivo)
class StatusData {
	public static $tablename = "status";

	public $id;
	public $name;

	public function __construct(){
		$this->name = "";
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=:id";
		$query = Executor::doit($sql, [':id' => $id]);
		return Model::one($query[0], new StatusData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by id asc";
		$query = Executor::doit($sql);
		return Model::many($query[0], new StatusData());
	}
}
