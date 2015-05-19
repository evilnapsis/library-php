<?php

/**
* Se utiliza para generar el SQL 
* @date 08/ene/2015
**/


Class SQLMan {
	public $tablename;
	public $fields = array();
	public $sql = "";
	public $in_test = false;


	public function __set($key,$data){
		$this->fields[$key]=$data;
	}

	public function fields_to_array(){
		return $this->fields;
	}

	public function add(){
		$this->sql = "";
		$this->sql .= "insert into ".$this->tablename." ";
			$d1="";
			$d2="";
			$n=0;
		foreach ($this->fields as $key => $value) {
			$d1 .= $key;
			$d2 .= "$value";
			if($n<count($this->fields)-1){
				$d1 .=",";
				$d2 .=",";
			}
				$n++;
		}
		$this->sql .= "($d1) value ($d2)";

		if($this->in_test){
		echo $this->sql;
		}else{
			return Executor::doit($this->sql);
		}
	}

	public function update($data,$where=""){
		$this->sql = "update ".$this->tablename." set";
			$d1="";
			$d2="";
			$n=0;
		foreach ($data as $key => $value) {
				$d1 .= $key."=".$value;
			if($n<count($data)-1){
				//$d1 .= $key."=\"".$value."\"";
				 $d1 .=",";
			}
				$n++;
		}
		$this->sql .= " $d1 ";
		if($where!=""){
			$this->sql .=" where ".$where;
		}

		if($this->in_test){
		echo $this->sql;
		}else{
			return Executor::doit($this->sql);
		}
	}

	public function is_string($v){ return "\"$v\"";}

	// $type default = many, optional = one
	public function select($type="",$fieldx="", $where="",$order="",$limit=""){
		$this->sql = "select ";
		if($fieldx ==""){ $this->sql .= "*" ; }else{ $this->sql .= $fieldx ; }
		$this->sql .= " from ".$this->tablename;
		if($where!="") { $this->sql .= " where ".$where ;}
		if($order!="") { $this->sql .= " order by ".$order ;}
		if($limit!="") { $this->sql .= " limit ".$limit ;}
		if($this->in_test){
			echo $this->sql;
		}else{
			if($type=""){$type="many"; }
			return Selector::process($type,$this->sql,$this);
		}


	}

	public function del( $where=""){
		$this->sql = "delete ";
		$this->sql .= " from ".$this->tablename;
		if($where!="") { $this->sql .= " where ".$where ;}
		if($this->in_test){
			echo $this->sql;
		}else{
			return Executor::doit($this->sql);
		}


	}


}



?>