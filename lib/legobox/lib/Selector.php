<?php


// 08 de Enero del 2015
// Selector.php
// @brief agrego la clase Selector para facilitar la ejecucion de los selects

class Selector {


	public static function process($type,$sql,$aclass){
		$cnt = 0;
		$array = array();
		$con = Database::getCon();
		$query = $con->query($sql);
		while($r = $query->fetch_array()){
			$array[$cnt] = new $aclass;
			$cnt2=1;
			foreach ($r as $key => $v) {
				if($cnt2>0 && $cnt2%2==0){ 
					$array[$cnt]->$key = $v;
				}
				$cnt2++;
			}
			$cnt++;
		}
		$results = null;

		if($type=="one"){
			$results = $array[0];
		}else {
			$results = $array;
		}
		return $results;
	}



}



?>