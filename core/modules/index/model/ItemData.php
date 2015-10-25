<?php
class ItemData {
	public static $tablename = "item";


	public function ItemData(){
		$this->name = "";
		$this->lastname = "";
		$this->email = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}

	public function getBook(){ return BookData::getById($this->book_id); }
	public function getStatus(){ return StatusData::getById($this->status_id); }

	public function add(){
		$sql = "insert into item (code,status_id,book_id) ";
		$sql .= "value (\"$this->code\",\"$this->status_id\",\"$this->book_id\")";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto ItemData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set code=\"$this->code\",status_id=\"$this->status_id\" where id=$this->id";
		Executor::doit($sql);
	}

	public function avaiable(){
		$sql = "update ".self::$tablename." set status_id=1 where id=$this->id";
		Executor::doit($sql);
	}

	public function unavaiable(){
		$sql = "update ".self::$tablename." set status_id=2 where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ItemData());
	}

	public static function countByBookId($id){
		$sql = "select count(*) as c from ".self::$tablename." where book_id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ItemData());
	}

	public static function countAvaiableByBookId($id){
		$sql = "select count(*) as c from ".self::$tablename." where book_id=$id and status_id=1";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ItemData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ItemData());
	}
	
	public static function getAllByBookId($id){
		$sql = "select * from ".self::$tablename." where book_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ItemData());
	}

	public static function getAvaiableByBookId($id){
		$sql = "select * from ".self::$tablename." where book_id=$id and status_id=1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ItemData());
	}

	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ItemData());
	}


}

?>