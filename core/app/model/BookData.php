<?php
// Model for Books in Library
class BookData {
	public static $tablename = "book";

	public $id;
	public $isbn;
	public $title;
	public $subtitle;
	public $description;
	public $file;
	public $image;
	public $year;
	public $n_pag;
	public $author_id;
	public $editorial_id;
	public $category_id;

	// Relationships and calculated properties for PHP 8.2+
	public $author;
	public $editorial;
	public $category;
	public $items;
	public $total_copies;
	public $available_copies;

	public function __construct(){
		$this->isbn = "";
		$this->title = "";
		$this->subtitle = "";
		$this->description = "";
		$this->year = date('Y');
		$this->n_pag = 0;
		$this->author_id = null;
		$this->editorial_id = null;
		$this->category_id = null;
	}

	public function getAuthor(){
		return $this->author_id ? AuthorData::getById($this->author_id) : null;
	}

	public function getEditorial(){
		return $this->editorial_id ? EditorialData::getById($this->editorial_id) : null;
	}

	public function getCategory(){
		return $this->category_id ? CategoryData::getById($this->category_id) : null;
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (isbn, title, subtitle, description, year, n_pag, author_id, editorial_id, category_id) ";
		$sql .= "values (:isbn, :title, :subtitle, :description, :year, :n_pag, :author_id, :editorial_id, :category_id)";
		return Executor::doit($sql, [
			':isbn' => $this->isbn,
			':title' => $this->title,
			':subtitle' => $this->subtitle,
			':description' => $this->description,
			':year' => $this->year,
			':n_pag' => $this->n_pag,
			':author_id' => $this->author_id,
			':editorial_id' => $this->editorial_id,
			':category_id' => $this->category_id
		]);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=:id";
		return Executor::doit($sql, [':id' => $id]);
	}

	public function update(){
		$sql = "update ".self::$tablename." set isbn=:isbn, title=:title, subtitle=:subtitle, description=:description, year=:year, n_pag=:n_pag, author_id=:author_id, editorial_id=:editorial_id, category_id=:category_id where id=:id";
		return Executor::doit($sql, [
			':isbn' => $this->isbn,
			':title' => $this->title,
			':subtitle' => $this->subtitle,
			':description' => $this->description,
			':year' => $this->year,
			':n_pag' => $this->n_pag,
			':author_id' => $this->author_id,
			':editorial_id' => $this->editorial_id,
			':category_id' => $this->category_id,
			':id' => $this->id
		]);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=:id";
		$query = Executor::doit($sql, [':id' => $id]);
		return Model::one($query[0], new BookData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by title asc";
		$query = Executor::doit($sql);
		return Model::many($query[0], new BookData());
	}

	public static function getLatest($limit = 6){
		$sql = "select * from ".self::$tablename." order by id desc limit " . ((int)$limit);
		$query = Executor::doit($sql);
		return Model::many($query[0], new BookData());
	}
}
