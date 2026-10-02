<?php
// Model for Book Category
class CategoryData {
	public static $tablename = "category";

	public $id;
	public $name;

	public function __construct(){
		$this->name = "";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (name) values (:name)";
		return Executor::doit($sql, [':name' => $this->name]);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=:id";
		return Executor::doit($sql, [':id' => $id]);
	}

	public function update(){
		$sql = "update ".self::$tablename." set name=:name where id=:id";
		return Executor::doit($sql, [
			':name' => $this->name,
			':id' => $this->id
		]);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=:id";
		$query = Executor::doit($sql, [':id' => $id]);
		return Model::one($query[0], new CategoryData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by name asc";
		$query = Executor::doit($sql);
		return Model::many($query[0], new CategoryData());
	}
}
