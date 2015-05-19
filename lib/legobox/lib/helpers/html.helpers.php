<?php

/**
* @name HTML helpers
* @brief algunas funciones auxiliares para automatizar la generacion de codigo HTML
* @author evilnapsis
* @date 09 ENE 2015
**/

function input_tag($name="",$value="",$class=""){
	$tag = "<input type=\"text\" ";
	if($name!=""){ $tag .= " name=\"".$name."\" id=\"".$name."\""; }
	if($value!=""){ $tag .= " value=\"".$value."\" "; }
	if($class!=""){ $tag .= " class=\"".$class."\" "; }else { $tag .=" class=\"form-control\" "; }
	$tag .= ">";
	return $tag;
}


function password_tag($name="",$value="",$class=""){
	$tag = "<input type=\"password\" ";
	if($name!=""){ $tag .= " name=\"".$name."\" id=\"".$name."\""; }
	if($value!=""){ $tag .= " value=\"".$value."\" "; }
	if($class!=""){ $tag .= " class=\"".$class."\" "; }else { $tag .=" class=\"form-control\" "; }
	$tag .= ">";
	return $tag;
}

function submit_tag($name="",$value="",$class=""){
	$tag = "<input type=\"submit\" ";
	if($name!=""){ $tag .= " name=\"".$name."\" id=\"".$name."\""; }
	if($value!=""){ $tag .= " value=\"".$value."\" "; }
	if($class!=""){ $tag .= " class=\"".$class."\" "; }else { $tag .=" class=\"form-control\" "; }
	$tag .= ">";
	return $tag;
}

function button_tag($name="",$value="",$class=""){
	$tag = "<input type=\"button\" ";
	if($name!=""){ $tag .= " name=\"".$name."\" id=\"".$name."\""; }
	if($value!=""){ $tag .= " value=\"".$value."\" "; }
	if($class!=""){ $tag .= " class=\"".$class."\" "; }else { $tag .=" class=\"form-control\" "; }
	$tag .= ">";
	return $tag;
}


function hidden_tag($name="",$value="",$class=""){
	$tag = "<input type=\"hidden\" ";
	if($name!=""){ $tag .= " name=\"".$name."\" id=\"".$name."\""; }
	if($value!=""){ $tag .= " value=\"".$value."\" "; }
	$tag .= ">";
	return $tag;
}


function textarea_tag($name="",$value="",$class=""){
	$tag = "<textarea type=\"text\" ";
	if($name!=""){ $tag .= " name=\"".$name."\" id=\"".$name."\""; }
	if($class!=""){ $tag .= " class=\"".$class."\" "; }else { $tag .=" class=\"form-control\" "; }
	$tag .= ">";
	if($value!=""){ $tag .= $value; }
	$tag .= "</textarea>";
	return $tag;
}

function radio_tag($name="",$checked="",$class=""){
	$tag = "<input type=\"radio\" ";
	if($name!=""){ $tag .= " name=\"".$name."\" id=\"".$name."\""; }
	if($checked!=""){ $tag .= " checked=\"".$checked."\" "; }
	$tag .= ">";
	return $tag;
}

function checkbox_tag($name="",$checked="",$class=""){
	$tag = "<input type=\"checkbox\" ";
	if($name!=""){ $tag .= " name=\"".$name."\" id=\"".$name."\""; }
	if($checked!=""){ $tag .= " checked=\"".$checked."\" "; }
	$tag .= ">";
	return $tag;
}

function select_tag($name="",$values=array(),$name_selected="",$class=""){
	$tag = "<select ";
	if($name!=""){ $tag .= " name=\"".$name."\" id=\"".$name."\""; }
	if($class!=""){ $tag .= " class=\"".$class."\" "; }else { $tag .=" class=\"form-control\" "; }
	$tag .= ">";
	foreach ($values as $key => $value) {
		$selected = "";
		if($name_selected!="" && ($name_selected==$key)){$selected="selected"; }
		$tag .="<option name=\"".$key."\" $selected>".$value."</option>";
	}
	$tag .= "</select>";
	return $tag;
}

function file_tag($name="",$class=""){
	$tag = "<input type=\"file\" ";
	if($name!=""){ $tag .= " name=\"".$name."\" id=\"".$name."\""; }
	$tag .= ">";
	return $tag;
}


?>