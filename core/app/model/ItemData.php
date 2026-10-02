<?php
// Model for Physical Book Copy / Item
class ItemData {
	public static $tablename = "item";

	public $id;
	public $code;
	public $status_id;
	public $book_id;

	// Relationships and calculated properties for PHP 8.2+
	public $book;
	public $status;
	public $c; // helper for count queries

	public function __construct(){
		$this->code = "";
		$this->status_id = 1; // 1 = Disponible
		$this->book_id = null;
	}

	public function getBook(){
		return $this->book_id ? BookData::getById($this->book_id) : null;
	}

	public function getStatus(){
		return $this->status_id ? StatusData::getById($this->status_id) : null;
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (code, status_id, book_id) values (:code, :status_id, :book_id)";
		return Executor::doit($sql, [
			':code' => $this->code,
			':status_id' => $this->status_id,
			':book_id' => $this->book_id
		]);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=:id";
		return Executor::doit($sql, [':id' => $id]);
	}

	public function update(){
		$sql = "update ".self::$tablename." set code=:code, status_id=:status_id, book_id=:book_id where id=:id";
		return Executor::doit($sql, [
			':code' => $this->code,
			':status_id' => $this->status_id,
			':book_id' => $this->book_id,
			':id' => $this->id
		]);
	}

	public function setStatus($status_id){
		$sql = "update ".self::$tablename." set status_id=:status_id where id=:id";
		return Executor::doit($sql, [
			':status_id' => $status_id,
			':id' => $this->id
		]);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=:id";
		$query = Executor::doit($sql, [':id' => $id]);
		return Model::one($query[0], new ItemData());
	}

	public static function getAllByBookId($book_id){
		$sql = "select * from ".self::$tablename." where book_id=:bid order by code asc";
		$query = Executor::doit($sql, [':bid' => $book_id]);
		return Model::many($query[0], new ItemData());
	}

	public static function getAvailable(){
		$sql = "select * from ".self::$tablename." where status_id=1 order by code asc";
		$query = Executor::doit($sql);
		return Model::many($query[0], new ItemData());
	}

	public static function countByBookId($book_id){
		$sql = "select count(*) as c from ".self::$tablename." where book_id=:bid";
		$query = Executor::doit($sql, [':bid' => $book_id]);
		$row = Model::one($query[0], new ItemData());
		return $row ? (int)$row->c : 0;
	}

	public static function countAvailableByBookId($book_id){
		$sql = "select count(*) as c from ".self::$tablename." where book_id=:bid and status_id=1";
		$query = Executor::doit($sql, [':bid' => $book_id]);
		$row = Model::one($query[0], new ItemData());
		return $row ? (int)$row->c : 0;
	}

	public static function countTotal(){
		$sql = "select count(*) as c from ".self::$tablename;
		$query = Executor::doit($sql);
		$row = Model::one($query[0], new ItemData());
		return $row ? (int)$row->c : 0;
	}
}
