<?php
//unset($_SESSION["cart"]);
?>
<div class="row">
	<div class="col-md-12">
	<h1>Prestamo</h1>
	<p><b>Buscar libro por titulo o por codigo/isbn:</b></p>
		<form id="searchp">
		<div class="row">
			<div class="col-md-6">
				<input type="hidden" name="view" value="sell">
				<input type="text" id="product_code" name="product" class="form-control">
			</div>
			<div class="col-md-3">
			<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Buscar</button>
			</div>
		</div>
		</form>
	</div>
<div id="show_search_results"></div>
<script>
//jQuery.noConflict();

$(document).ready(function(){
	$("#searchp").on("submit",function(e){
		e.preventDefault();
		
		$.get("./?action=searchbook",$("#searchp").serialize(),function(data){
			$("#show_search_results").html(data);
		});
		$("#product_code").val("");

	});
	});
</script>


<!--- Carrito de compras :) -->
<?php if(isset($_SESSION["cart"])):
$total = 0;
?>
<div class="container">
<div class="row">
<div class="col-md-12">
<h2>Lista de venta</h2>

<form class="form-horizontal" role="form" method="post" action="./?action=process">
  <div class="form-group">

    <div class="col-lg-3">
    <label class="control-label">Cliente</label>
<select name="client_id" required class="form-control">
<option value="">-- SELECCIONE --</option>
  <?php foreach(ClientData::getAll() as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
    </div>

    <div class="col-lg-3">
    <label class="control-label">Inicio</label>
      <input type="date" name="start_at" required class="form-control" placeholder="Email">
    </div>
    <div class="col-lg-3">
    <label class="control-label">Fin</label>
      <input type="date" name="finish_at" required class="form-control" placeholder="Email">
    </div>
    <div class="col-lg-2">
    <label class="control-label"><br></label>
      <input type="submit" value="Procesar" class="btn btn-primary btn-block" placeholder="Email">
    </div>
    <div class="col-lg-1">
    <label class="control-label"><br></label>
    <a href="./?action=clearcart" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>
    </div>
  </div>

</form>
<table class="table table-bordered table-hover">
<thead>
	<th style="width:40px;">Codigo</th>
	<th style="width:40px;">Ejemplar</th>
	<th>Titulo</th>
	<th></th>
</thead>
<?php foreach($_SESSION["cart"] as $p):
$book = BookData::getById($p["book_id"]);
$item = ItemData::getById($p["item_id"]);

?>
<tr >
	<td><?php echo $book->isbn; ?></td>
	<td ><?php echo $item->code; ?></td>
	<td ><?php echo $book->title; ?></td>
	<td style="width:30px;">
	<a href="index.php?view=clearcart&product_id=<?php echo $book->id; ?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>
	</td>
</tr>

<?php endforeach; ?>
</table>
</div>
</div>
</div>
<br><br><br><br><br>
<?php endif; ?>
