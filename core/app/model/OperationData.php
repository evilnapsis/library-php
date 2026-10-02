<?php
// Model for Book Loans (Borrowing and Return)
class OperationData {
	public static $tablename = "operation";

	public $id;
	public $item_id;
	public $client_id;
	public $start_at;
	public $finish_at;
	public $returned_at;
	public $user_id;
	public $receptor_id;

	// Relationships and calculated properties for PHP 8.2+
	public $item;
	public $client;
	public $user;
	public $receptor;
	public $is_overdue;

	public function __construct(){
		$this->start_at = date('Y-m-d');
		$this->finish_at = date('Y-m-d', strtotime('+7 days'));
		$this->returned_at = null;
		$this->receptor_id = null;
	}

	public function getItem(){
		return $this->item_id ? ItemData::getById($this->item_id) : null;
	}

	public function getClient(){
		return $this->client_id ? ClientData::getById($this->client_id) : null;
	}

	public function getUser(){
		return $this->user_id ? UserData::getById($this->user_id) : null;
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (item_id, client_id, start_at, finish_at, user_id) ";
		$sql .= "values (:item_id, :client_id, :start_at, :finish_at, :user_id)";
		return Executor::doit($sql, [
			':item_id' => $this->item_id,
			':client_id' => $this->client_id,
			':start_at' => $this->start_at,
			':finish_at' => $this->finish_at,
			':user_id' => $this->user_id
		]);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=:id";
		return Executor::doit($sql, [':id' => $id]);
	}

	public function returnBook($receptor_id){
		$sql = "update ".self::$tablename." set returned_at=NOW(), receptor_id=:receptor_id where id=:id";
		return Executor::doit($sql, [
			':receptor_id' => $receptor_id,
			':id' => $this->id
		]);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=:id";
		$query = Executor::doit($sql, [':id' => $id]);
		return Model::one($query[0], new OperationData());
	}

	public static function getActive(){
		$sql = "select * from ".self::$tablename." where returned_at is null order by finish_at asc";
		$query = Executor::doit($sql);
		return Model::many($query[0], new OperationData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0], new OperationData());
	}

	public static function countActive(){
		$sql = "select count(*) as c from ".self::$tablename." where returned_at is null";
		$query = Executor::doit($sql);
		$row = Model::one($query[0], new OperationData());
		return $row ? (int)$row->c : 0;
	}

	public static function getByDateRange($start, $finish){
		$sql = "select * from ".self::$tablename." where (date(start_at)>=:start and date(start_at)<=:finish) order by start_at desc, id desc";
		$query = Executor::doit($sql, [':start' => $start, ':finish' => $finish]);
		return Model::many($query[0], new OperationData());
	}
}
