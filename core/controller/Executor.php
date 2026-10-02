<?php

class Executor {

	public static function doit($sql, $params = []){
		$con = Database::getCon();
		if(!empty($params) && is_array($params)){
			foreach($params as $key => $val){
				if(is_null($val)){
					$rep = "NULL";
				} elseif(is_numeric($val) && !is_string($val)){
					$rep = $val;
				} else {
					$rep = "'" . $con->real_escape_string((string)$val) . "'";
				}
				$k = (strpos($key, ':') === 0) ? $key : ':' . $key;
				$sql = preg_replace('/' . preg_quote($k, '/') . '\b/', $rep, $sql);
			}
		}
		if(Core::$debug_sql){
			print "<pre>".$sql."</pre>";
		}
		$res = $con->query($sql);
		return array($res, $con->insert_id);
	}
}
?>