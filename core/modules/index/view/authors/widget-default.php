<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
	<a href="index.php?view=newauthor" class="btn btn-default"><i class='fa fa-th-list'></i> Nuevo Autor</a>
</div>
		<h1>Autores</h1>
<br>
		<?php

		$users = AuthorData::getAll();
		if(count($users)>0){
			// si hay usuarios
			?>

			<table class="table table-bordered table-hover">
			<thead>
			<th>Nombre</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				<td><?php echo $user->name." ".$user->lastname; ?></td>
				<td style="width:130px;"><a href="index.php?view=editauthor&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a> <a href="index.php?action=delauthor&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a></td>
				</tr>
				<?php

			}
?>
</table>
<?php
		}else{
			echo "<p class='alert alert-danger'>No hay Autores</p>";
		}


		?>


	</div>
</div>