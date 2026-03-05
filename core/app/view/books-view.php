<?php 
// si el usuario no esta logeado
if(!isset($_SESSION["user_id"])){ Core::redir("./");}
$user= UserData::getById($_SESSION["user_id"]);
// si el id  del usuario no existe.
if($user==null){ Core::redir("./");}
?>
<?php if(isset($_GET["opt"]) && $_GET['opt']=="all"):
$contacts = BookData::getAll();
  ?>











            <div class="row">
            <div class="col-md-12">
              <div class="card mb-4">
                <div class="card-header">Libros</div>
                <div class="card-body">
<a href="./?view=books&opt=new" class="btn btn-secondary">Nuevo Libro</a>
                  <!-- /.row--><br><br>
                  <div class="table-responsive">

<?php if(count($contacts)>0):?>
                    <table class="table border mb-0">
                      <thead class="table-light fw-semibold">
                        <tr class="align-middle">

                          <th>ISBN</th>
                          <th>Titulo</th>
                          <th>Subtitulo</th>
                          <th>Ejemplares</th>
                          <th>Disponibles</th>
                          <th>Categoria</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

    <?php foreach($contacts as $con):
      $category  = $con->getCategory();
      ?>
      <tr>
        <td><?php echo $con->isbn; ?></td>
        <td><?php echo $con->title; ?></td>
        <td><?php echo $con->subtitle; ?></td>
        <td><?php echo ItemData::countByBookId($con->id)->c; ?></td>
        <td><?php echo ItemData::countAvaiableByBookId($con->id)->c; ?></td>
        <td><?php if($category!=null){ echo $category->name; }  ?></td>
        <td>
          <a href="./?view=items&opt=all&id=<?php echo $con->id;?>" class="btn btn-info btn-sm">Ejemplares</a>
          <a href="./?view=books&opt=edit&id=<?php echo $con->id; ?>" class="btn btn-warning btn-sm"><i class="bi-pencil"></i></a>
          <a href="./?action=books&opt=del&id=<?php echo $con->id; ?>" class="btn btn-danger btn-sm"><i class="bi-trash"></i></a>
        </td>
      </tr>
    <?php endforeach; ?>
                      </tbody>
                    </table>
<?php else:?>
  <p class="alert alert-warning">No hay Libros</p>
<?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col-->
          </div>













<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="new"):
$categories = CategoryData::getAll();
$authors = AuthorData::getAll();
$editorials = EditorialData::getAll();
?>
<div class="">
<div class="row">
<div class="col-md-12">

              <div class="card mb-4">
                <div class="card-header">Libros</div>
                <div class="card-body">
<h2>Nuevo Libro</h2>

                <div class="row">
                  <div class="col-md-12">
<form method="post" action="./?action=books&opt=add">
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">ISBN</label>
    <input type="text" name="isbn" class="form-control" id="exampleInputEmail1" placeholder="ISBN">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Titulo</label>
    <input type="text" required name="title" class="form-control" id="exampleInputEmail1" placeholder="Titulo">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Subtitulo</label>
    <input type="text" name="subtitle" class="form-control" id="exampleInputEmail1" placeholder="Subtitulo">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Descripcion</label>
    <textarea class="form-control" name="description" placeholder="Descripcion"></textarea>
  </div>
  <div class="row">
  <div class="col-md-6">
    <div class="form-group mb-3">
      <label for="exampleInputEmail1">Num. Paginas</label>
        <input type="text" name="n_pag" class="form-control" id="exampleInputEmail1" placeholder="Num. Paginas">
      </div>
  </div>
  <div class="col-md-6">
    <div class="form-group mb-3">
      <label for="exampleInputEmail1">A&ntilde;o</label>
        <input type="text" name="year" class="form-control" id="exampleInputEmail1" placeholder="A&ntilde;o">
      </div>
  </div>
  </div>

  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Categoria</label>
<select name="category_id" class="form-control">
<option value="">-- SELECCIONE --</option>
  <?php foreach($categories as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Editorial</label>
<select name="editorial_id" class="form-control">
<option value="">-- SELECCIONE --</option>
  <?php foreach($editorials as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Autor</label>
<select name="author_id" class="form-control">
<option value="">-- SELECCIONE --</option>
  <?php foreach($authors as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
  </div>

  <div class="d-grid gap-2">
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
$book = BookData::getById($_GET["id"]);
$categories = CategoryData::getAll();
$authors = AuthorData::getAll();
$editorials = EditorialData::getAll();
  ?>
  <div class="">
<div class="row">
<div class="col-md-12">

              <div class="card mb-4">
                <div class="card-header">Libros</div>
                <div class="card-body">
<h2>Editar Libro</h2>
<div class="row">
  <div class="col-md-12">
<form method="post" action="./?action=books&opt=update">
  <input type="hidden" name="id" value="<?php echo $book->id; ?>">
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">ISBN</label>
    <input type="text" name="isbn" class="form-control" value="<?php echo $book->isbn; ?>" id="exampleInputEmail1" placeholder="ISBN">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Titulo</label>
    <input type="text" required name="title" class="form-control" value="<?php echo $book->title; ?>" id="exampleInputEmail1" placeholder="Titulo">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Subtitulo</label>
    <input type="text" name="subtitle" class="form-control" value="<?php echo $book->subtitle; ?>" id="exampleInputEmail1" placeholder="Subtitulo">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Descripcion</label>
    <textarea class="form-control" name="description" placeholder="Descripcion"><?php echo $book->description; ?></textarea>
  </div>

  <div class="row">
  <div class="col-md-6">
    <div class="form-group mb-3">
      <label for="exampleInputEmail1">Num. Paginas</label>
        <input type="text" name="n_pag" class="form-control" value="<?php echo $book->n_pag; ?>" id="exampleInputEmail1" placeholder="Num. Paginas">
      </div>
  </div>
  <div class="col-md-6">
    <div class="form-group mb-3">
      <label for="exampleInputEmail1">A&ntilde;o</label>
        <input type="text" name="year" class="form-control" value="<?php echo $book->year; ?>" id="exampleInputEmail1" placeholder="A&ntilde;o">
      </div>
  </div>
  </div>


  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Categoria</label>
<select name="category_id" class="form-control">
<option value="">-- SELECCIONE --</option>
  <?php foreach($categories as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($book->category_id!=null && $book->category_id==$p->id){ echo "selected"; }?>><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Editorial</label>
<select name="editorial_id" class="form-control">
<option value="">-- SELECCIONE --</option>
  <?php foreach($editorials as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($book->editorial_id!=null && $book->editorial_id==$p->id){ echo "selected"; }?>><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Autor</label>
<select name="author_id" class="form-control">
<option value="">-- SELECCIONE --</option>
  <?php foreach($authors as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($book->author_id!=null && $book->author_id==$p->id){ echo "selected"; }?>><?php echo $p->name." ".$p->lastname; ?></option>
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
