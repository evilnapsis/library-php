<?php
$book = BookData::getById($_GET["id"]);
?>
<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
	<a href="index.php?view=newitem&book_id=<?php echo $book->id; ?>" class="btn btn-default"><i class='fa fa-th-list'></i> Nuevo Ejemplar</a>
</div>
		<h1><?php echo $book->title;?> <small>Ejemplares</small></h1>
<br>
		<?php

		$users = ItemData::getAllByBookId($book->id);
		if(count($users)>0){
			// si hay usuarios
			?>

			<table class="table table-bordered table-hover">
			<thead>
			<th>Codigo</th>
			<th>Estado</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				<td><?php echo $user->code; ?></td>
				<td><?php echo $user->getStatus()->name; ?></td>
				<td style="width:200px;">
								<a href="index.php?view=itemhistory&id=<?php echo $user->id;?>" class="btn btn-default btn-xs">Historial</a>
<a href="index.php?view=edititem&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a> <a href="index.php?action=delitem&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a></td>
				</tr>
				<?php

			}
			?>
			</table>
			<?php
		}else{
			echo "<p class='alert alert-danger'>No hay Ejemlpares</p>";
		}


		?>


	</div>
</div>
