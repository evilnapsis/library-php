<?php
// si el usuario no esta logeado
if(!isset($_SESSION["user_id"])){ Core::redir("./");}
$user= UserData::getById($_SESSION["user_id"]);
// si el id  del usuario no existe.
if($user==null){ Core::redir("./");}
?>
<div class="row">
	<div class="col-md-12">
    <div class="card mb-4">
      <div class="card-header">Reportes de Prestamos</div>
      <div class="card-body">

<form class="row g-3 mb-4" role="form">
  <input type="hidden" name="view" value="reports">
  <input type="hidden" name="opt" value="all">
    <div class="col-md-4">
		<div class="input-group">
		  <span class="input-group-text">INICIO</span>
		  <input type="date" name="start_at" value="<?php if(isset($_GET["start_at"]) && $_GET["start_at"]!=""){ echo $_GET["start_at"]; } ?>" class="form-control">
		</div>
    </div>
    <div class="col-md-4">
		<div class="input-group">
		  <span class="input-group-text">FIN</span>
		  <input type="date" name="finish_at" value="<?php if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?>" class="form-control">
		</div>
    </div>
    <div class="col-md-4">
      <button class="btn btn-primary w-100">Procesar</button>
    </div>
</form>

<?php
if(isset($_GET["start_at"]) && $_GET["start_at"]!="" && isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){
	$users = OperationData::getByRange($_GET["start_at"],$_GET["finish_at"]);
		if(count($users)>0){
			$_SESSION["report_data"] = $users;
			?>
      <div class="table-responsive">
			<table class="table table-bordered table-hover">
			<thead class="table-light">
        <tr>
          <th>Ejemplar</th>
          <th>Titulo</th>
          <th>Cliente</th>
          <th>Fecha Devolucion</th>
        </tr>
			</thead>
			<?php
			foreach($users as $user){
				$item  = $user->getItem();
				$client  = $user->getClient();
				$book = $item->getBook();
				?>
				<tr class="align-middle">
				<td><?php echo $item->code; ?></td>
				<td><?php echo $book->title; ?></td>
				<td><?php echo $client->name." ".$client->lastname; ?></td>
				<td><?php echo $user->returned_at; ?></td>
				</tr>
				<?php
			}
			?>
			</table>
      </div>
			<?php
		}else{
			echo "<p class='alert alert-warning'>No hay datos en el rango seleccionado.</p>";
		}
}else{
  echo "<p class='alert alert-info'>Seleccione un rango de fechas para generar el reporte.</p>";
}
?>

      </div>
    </div>
	</div>
</div>
