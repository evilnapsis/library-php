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
      <div class="card-header">
        <i class='bi bi-grid-3x3-gap'></i> Prestamos
      </div>
      <div class="card-body">

<form class="row g-3 mb-4" role="form">
  <input type="hidden" name="view" value="rents">
  <input type="hidden" name="opt" value="all">
    <div class="col-md-4">
		<div class="input-group">
		  <span class="input-group-text">INICIO</span>
		  <input type="date" name="start_at" required value="<?php if(isset($_GET["start_at"]) && $_GET["start_at"]!=""){ echo $_GET["start_at"]; } ?>" class="form-control">
		</div>
    </div>
    <div class="col-md-4">
		<div class="input-group">
		  <span class="input-group-text">FIN</span>
		  <input type="date" name="finish_at" required value="<?php if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?>" class="form-control">
		</div>
    </div>
    <div class="col-md-4">
      <button class="btn btn-primary w-100">Procesar</button>
    </div>
</form>

<?php
$products = array();
if(isset($_GET["start_at"]) && $_GET["start_at"]!="" && isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){
  if($_GET["start_at"]<=$_GET["finish_at"]){
    $products = OperationData::getRentsByRange($_GET["start_at"],$_GET["finish_at"]);
  }
}else{
  $products = OperationData::getRents();
}

if(count($products)>0){
?>
<div class="table-responsive">
<table class="table table-bordered table-hover">
	<thead class="table-light fw-semibold">
		<tr>
      <th>Ejemplar</th>
      <th>Libro</th>
      <th>Cliente</th>
      <th>Inicio</th>
      <th>Fin</th>
      <th></th>
    </tr>
	</thead>
	<?php foreach($products as $sell):
    $item = $sell->getItem();
    $book = $item->getBook();
    $client = $sell->getClient();
	?>
	<tr class="align-middle">
		<td><?php echo $item->code; ?></td>
		<td><?php echo $book->title; ?></td>
		<td><?php echo $client->name." ".$client->lastname; ?></td>
		<td><?php echo $sell->start_at; ?></td>
		<td><?php echo $sell->finish_at; ?></td>
		<td style="width:160px;">
  		<?php if($sell->returned_at==""):?>
  		  <a href="./?action=rent&opt=finalize&id=<?php echo $sell->id; ?>" class="btn btn-sm btn-success">Finalizar</a>
  	  <?php else: ?>
        <span class="badge bg-secondary">Devuelto</span>
      <?php endif;?>
  		<a href="./?action=rent&opt=del&id=<?php echo $sell->id; ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
    </td>
	</tr>
<?php endforeach; ?>
</table>
</div>

<?php
}else{
	?>
	<p class="alert alert-warning">No hay prestamos.</p>
	<?php
}
?>

      </div>
    </div>
	</div>
</div>
