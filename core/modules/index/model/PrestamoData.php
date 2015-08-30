<?php
class PostCategoryData {
	public static $tablename = "post_category";


	public function PostCategoryData(){
		$this->title = "";
		$this->content = "";
		$this->image = "";
		$this->user_id = "";
		$this->is_public = "0";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (post_id,category_id) ";
		$sql .= "value (\"$this->post_id\",\"$this->category_id\")";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where post_id=$this->post_id and category_id=$this->category_id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto PostCategoryData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set title=\"$this->title\",content=\"$this->content\",is_public=\"$this->is_public\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PostCategoryData());
	}

	public static function getByPC($p,$c){
		$sql = "select * from ".self::$tablename." where post_id=$p and category_id=$c";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PostCategoryData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostCategoryData());
	}

	public static function getAllByPostId($id){
		$sql = "select * from ".self::$tablename." where post_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostCategoryData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where title like '%$q%' or content like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostCategoryData());
	}


}

?>