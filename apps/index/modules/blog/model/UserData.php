<?php
class UserData extends SQLMan{
	public static $tablename = "user";


	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		return Selector::process($sql, new UserData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		return Selector::process($sql, new UserData());
	}


}

?>