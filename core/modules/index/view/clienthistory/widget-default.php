<?php
$client = ClientData::getById($_GET["id"]);
?>
<div class="row">
	<div class="col-md-12">
		<h1><i class='fa fa-clock-o'></i> <?php echo $client->name." ".$client->lastname; ?> </h1>
<br>
<form class="form-horizontal" role="form">
<input type="hidden" name="view" value="itemhistory">
<input type="hidden" name="id" value="<?php echo $client->id; ?>">
  <div class="form-group">
    <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon">INICIO</span>
		  <input type="date" name="start_at" required value="<?php if(isset($_GET["start_at"]) && $_GET["start_at"]!=""){ echo $_GET["start_at"]; } ?>" class="form-control" placeholder="Palabra clave">
		</div>
    </div>
    <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon">FIN</span>
		  <input type="date" name="finish_at" required value="<?php if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?>" class="form-control" placeholder="Palabra clave">
		</div>
    </div>
    <div class="col-lg-6">
    <button class="btn btn-primary btn-block">Procesar</button>
    </div>

  </div>
</form>
<?php
$products = array();
if(isset($_GET["start_at"]) && $_GET["start_at"]!="" && isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){
if($_GET["start_at"]<$_GET["finish_at"]){
$products = OperationData::getAllByClientIdAndRange($client->id,$_GET["start_at"],$_GET["finish_at"]);
}
}else{
$products = OperationData::getAllByClientId($client->id);

}
if(count($products)>0){
?>
<br>
<table class="table table-bordered table-hover	">
	<thead>
		<th>Ejemplar</th>
		<th>Libro</th>
		<th>Cliente</th>
		<th>Inicio</th>
		<th>Fin</th>
		<th>Regreso</th>
	</thead>
	<?php foreach($products as $sell):
$item = $sell->getItem();
$book = $item->getBook();
	?>
	<tr>
		<td style="width:30px;">
		<?php echo $item->code; ?>
		</td>
		<td>
		<?php echo $book->title; ?>
		</td>
		<td>
		<?php echo $client->name." ".$client->lastname; ?>
		</td>
		<td><?php echo $sell->start_at; ?></td>
		<td><?php echo $sell->finish_at; ?></td>
		<td><?php echo $sell->returned_at; ?></td>
	</tr>
<?php endforeach; ?>
</table>

<div class="clearfix"></div>

	<?php
}else{
	?>
	<p class="alert alert-danger">No hay prestamos.</p>
	<?php
}

?>
<br><br><br><br><br><br><br><br><br><br>
	</div>
</div>