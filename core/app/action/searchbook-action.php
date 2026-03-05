<?php if(isset($_GET["product"]) && $_GET["product"]!=""):?>
	<?php
$products = BookData::getLike($_GET["product"]);
if(count($products)>0){
	?>
<div class="card mb-4">
<div class="card-header">Resultados de la Busqueda</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered table-hover">
	<thead class="table-light">
		<th>ISBN</th>
		<th>Titulo</th>
		<th>Ejemplar</th>
	</thead>
	<?php
	 foreach($products as $product):
	?>
		
	<tr class="align-middle">
		<td style="width:120px;"><?php echo $product->isbn; ?></td>
		<td><?php echo $product->title; ?></td>
		<td style="width:350px;"><form method="post" action="./?action=addtocart">
		<input type="hidden" name="book_id" value="<?php echo $product->id; ?>">
<?php $items = ItemData::getAvaiableByBookId($product->id);?>
<div class="input-group">
<select class="form-select" name="item_id" required>
	<option value=""> -- EJEMPLAR --</option>
	<?php foreach($items as $item):?>
	<option value="<?php echo $item->id; ?>"> <?php echo $item->code; ?></option>
	<?php endforeach; ?>
</select>
<button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Agregar</button>
</div>


		</form></td>
	</tr>
	
	<?php endforeach;?>
</table>
</div>
</div>
</div>

	<?php
}else{
	echo "<br><p class='alert alert-danger'>No se encontro el producto</p>";
}
?>
<hr><br>
<?php else:
?>
<?php endif; ?>
