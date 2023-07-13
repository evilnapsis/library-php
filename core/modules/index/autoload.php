<?php
// autoload.php
// 10 octubre del 2014
// esta funcion elimina el hecho de estar agregando los modelos manualmente


function my_autoload($modelname){
	if(Model::exists($modelname)){
		include Model::getFullPath($modelname);
	} 

	if(Form::exists($modelname)){
		include Form::getFullPath($modelname);
	}
}

spl_autoload_register("my_autoload");

?>