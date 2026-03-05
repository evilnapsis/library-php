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
      <div class="card-header">Prestamo</div>
      <div class="card-body">
	<p><b>Buscar libro por titulo o por codigo/isbn:</b></p>
		<form id="searchp">
		<div class="row">
			<div class="col-md-6">
				<input type="text" id="product_code" name="product" class="form-control" placeholder="ISBN o Titulo" autocomplete="off">
			</div>
			<div class="col-md-3">
			<button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Buscar</button>
			</div>
		</div>
		</form>
      </div>
    </div>
	</div>
</div>

<div id="show_search_results"></div>

<script>
$(document).ready(function(){
	$("#searchp").on("submit",function(e){
		e.preventDefault();
		
		$.get("./?action=rent&opt=searchbook",$("#searchp").serialize(),function(data){
			$("#show_search_results").html(data);
		});
		$("#product_code").val("");

	});
});
</script>


<!--- Carrito de compras :) -->
<?php if(isset($_SESSION["cart"]) && count($_SESSION["cart"])>0):
$total = 0;
?>
<div class="row">
<div class="col-md-12">
  <div class="card mb-4">
    <div class="card-header">Lista de prestamo</div>
    <div class="card-body">

<form class="row g-3" method="post" action="./?action=rent&opt=process">
  <div class="col-md-3">
    <label class="form-label">Cliente</label>
    <select name="client_id" required class="form-select">
    <option value="">-- SELECCIONE --</option>
      <?php foreach(ClientData::getAll() as $p):?>
        <option value="<?php echo $p->id; ?>"><?php echo $p->name." ".$p->lastname; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="col-md-3">
    <label class="form-label">Inicio</label>
      <input type="date" name="start_at" required class="form-control" value="<?php echo date("Y-m-d"); ?>">
  </div>
  <div class="col-md-3">
    <label class="form-label">Fin</label>
      <input type="date" name="finish_at" required class="form-control" value="<?php echo date("Y-m-d",strtotime("+7 day")); ?>">
  </div>
  <div class="col-md-2 d-flex align-items-end">
      <input type="submit" value="Procesar" class="btn btn-primary w-100">
  </div>
  <div class="col-md-1 d-flex align-items-end">
    <a href="./?action=rent&opt=clearcart" class="btn btn-danger w-100"><i class="bi bi-trash"></i></a>
  </div>
</form>

<br>
<div class="table-responsive">
<table class="table table-bordered table-hover">
<thead>
	<th>Codigo</th>
	<th>Ejemplar</th>
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
	<td style="width:130px;">
	<a href="./?action=rent&opt=clearcartitem&product_id=<?php echo $book->id; ?>" class="btn btn-sm btn-danger"><i class="bi bi-x-lg"></i> Quitar</a>
	</td>
</tr>

<?php endforeach; ?>
</table>
</div>

    </div>
  </div>
</div>
</div>
<?php endif; ?>
