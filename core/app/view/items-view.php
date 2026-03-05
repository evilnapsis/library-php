<?php 
// si el usuario no esta logeado
if(!isset($_SESSION["user_id"])){ Core::redir("./");}
$user= UserData::getById($_SESSION["user_id"]);
// si el id  del usuario no existe.
if($user==null){ Core::redir("./");}

$book = BookData::getById($_GET["id"]);

?>
<?php if(isset($_GET["opt"]) && $_GET['opt']=="all"):
$contacts = ItemData::getAllByBookId($book->id);
  ?>











            <div class="row">
            <div class="col-md-12">
              <div class="card mb-4">
                <div class="card-header"> Ejemplares: <?php echo $book->title;?></div>
                <div class="card-body">
<a href="./?view=items&opt=new&id=<?php echo $book->id; ?>" class="btn btn-secondary">Nuevo Ejemplar</a>
                  <!-- /.row--><br><br>
                  <div class="table-responsive">

<?php if(count($contacts)>0):?>
                    <table class="table border mb-0">
                      <thead class="table-light fw-semibold">
                        <tr class="align-middle">

                          <th>Codigo</th>
                          <th>Estado</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

    <?php foreach($contacts as $con):?>
      <tr>
        <td><?php echo $con->code; ?></td>
        <td><?php echo $con->getStatus()->name; ?></td>
        <td>
          <a href="./?view=itemhistory&opt=all&id=<?php echo $con->id;?>" class="btn btn-info btn-sm">Historial</a>
          <a href="./?view=items&opt=edit&id=<?php echo $book->id; ?>&item_id=<?php echo $con->id; ?>" class="btn btn-warning btn-sm"><i class="bi-pencil"></i></a>
          <a href="./?action=items&opt=del&id=<?php echo $book->id; ?>&item_id=<?php echo $con->id; ?>" class="btn btn-danger btn-sm"><i class="bi-trash"></i></a>
        </td>
      </tr>
    <?php endforeach; ?>
                      </tbody>
                    </table>
<?php else:?>
  <p class="alert alert-warning">No hay Ejemplares</p>
<?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col-->
          </div>













<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="new"):?>
<div class="">
<div class="row">
<div class="col-md-12">

              <div class="card mb-4">
                <div class="card-header">Nuevo Ejemplar: <?php echo $book->title;?></div>
                <div class="card-body">

                <div class="row">
                  <div class="col-md-6">
<form method="post" action="./?action=items&opt=add&id=<?php echo $book->id; ?>">
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Codigo</label>
    <input type="text" required name="code" class="form-control" id="exampleInputEmail1" placeholder="Codigo">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Estado</label>
<select name="status_id" class="form-control">
  <?php foreach(StatusData::getAll() as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
  </div>

  <div class="d-grid gap-2">
  <input type="hidden" name="book_id" value="<?php echo $book->id; ?>">
  <button type="submit" class="btn btn-primary ">Guardar</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="edit"):
$item = ItemData::getById($_GET["item_id"]);
  ?>
  <div class="">
<div class="row">
<div class="col-md-12">

              <div class="card mb-4">
                <div class="card-header">Editar Ejemplar: <?php echo $book->title;?></div>
                <div class="card-body">
<div class="row">
  <div class="col-md-6">
<form method="post" action="./?action=items&opt=update&id=<?php echo $book->id; ?>">
  <input type="hidden" name="item_id" value="<?php echo $item->id; ?>">
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Codigo</label>
    <input type="text" required name="code" value="<?php echo $item->code; ?>" class="form-control" id="exampleInputEmail1" placeholder="Codigo">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Estado</label>
<select name="status_id" class="form-control">
  <?php foreach(StatusData::getAll() as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($item->status_id==$p->id){ echo "selected"; }?>><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
  </div>

  <div class="d-grid gap-2">
  <button type="submit" class="btn btn-success ">Actualizar</button>
</div>
</form>

</div>
</div>

</div>
</div>

</div>
</div>
</div>
<?php endif; ?>
