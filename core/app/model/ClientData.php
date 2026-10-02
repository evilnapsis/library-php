<?php
// Model for Library Members / Clients
class ClientData {
	public static $tablename = "client";

	public $id;
	public $name;
	public $lastname;
	public $email;
	public $address;
	public $phone;
	public $is_active;
	public $created_at;

	public function __construct(){
		$this->name = "";
		$this->lastname = "";
		$this->email = "";
		$this->address = "";
		$this->phone = "";
		$this->is_active = 1;
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (name, lastname, email, address, phone, is_active, created_at) ";
		$sql .= "values (:name, :lastname, :email, :address, :phone, :is_active, NOW())";
		return Executor::doit($sql, [
			':name' => $this->name,
			':lastname' => $this->lastname,
			':email' => $this->email,
			':address' => $this->address,
			':phone' => $this->phone,
			':is_active' => $this->is_active
		]);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=:id";
		return Executor::doit($sql, [':id' => $id]);
	}

	public function update(){
		$sql = "update ".self::$tablename." set name=:name, lastname=:lastname, email=:email, address=:address, phone=:phone, is_active=:is_active where id=:id";
		return Executor::doit($sql, [
			':name' => $this->name,
			':lastname' => $this->lastname,
			':email' => $this->email,
			':address' => $this->address,
			':phone' => $this->phone,
			':is_active' => $this->is_active,
			':id' => $this->id
		]);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=:id";
		$query = Executor::doit($sql, [':id' => $id]);
		return Model::one($query[0], new ClientData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by name asc, lastname asc";
		$query = Executor::doit($sql);
		return Model::many($query[0], new ClientData());
	}
}
