<?php

$a = new SQLMan();
$a->tablename = "autor";
$autores = $a->select();


$e = new SQLMan();
$e->tablename = "editorial";
$editoriales = $e->select();

$c = new SQLMan();
$c->tablename = "categoria";
$categorias = $c->select();


?>
      <div class="page-content">

        <!-- Header Bar -->
<?php Action::load("header");?>
        <!-- End Header Bar -->


          <div class="row">
            <div class="col-lg-12">
            <h2>Nuevo libro</h2>
<?php if(count($autores)==0):?>
  <p class="alert alert-danger">No hay autores</p>
<?php endif; ?>


<?php if(count($editoriales)==0):?>
  <p class="alert alert-danger">No hay editoriales</p>
<?php endif; ?>

<?php if(count($categorias)==0):?>
  <p class="alert alert-danger">No hay categorias</p>
<?php endif; ?>

              <div class="widget">
                <div class="widget-title">
                  <i class="fa fa-male"></i> Libros
                </div>
                <div class="widget-body">
<form class="form-horizontal" role="form" method="post" action="./index.php?action=addlibro">
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Isbn</label>
    <div class="col-lg-10">
      <input type="text" name="isbn"   class="form-control" id="inputEmail1" placeholder="Isbn">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Titulo</label>
    <div class="col-lg-10">
      <input type="text" name="titulo"  required class="form-control" id="inputEmail1" placeholder="Titulo">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Subtitulo</label>
    <div class="col-lg-10">
      <input type="text" name="subtitulo" class="form-control" id="inputEmail1"  placeholder="Subtitulo">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">a&ntilde;o/Num. Pag</label>
    <div class="col-lg-5">
      <input type="text" name="anio" class="form-control" id="inputEmail1" required placeholder="A&ntilde;o">
    </div>
    <div class="col-lg-5">
      <input type="text" name="num_pag" class="form-control" id="inputEmail1" required placeholder="Numero de paginas">
    </div>
  </div>

    <?php if(count($autores)>0):?>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Autor</label>
    <div class="col-lg-10">
      <select name="autor_id" class="form-control" required>
      <option value="">-- SELECCIONE --</option>
        <?php foreach($autores as $autor):?>
          <option value="<?php echo $autor->fields["id"]; ?>"><?php echo $autor->fields["nombre"]." ".$autor->fields["apellido"];?> </option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
    <?php endif; ?>
    <?php if(count($editoriales)>0):?>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Editorial</label>
    <div class="col-lg-10">
      <select name="editorial_id" class="form-control" required>
      <option value="">-- SELECCIONE --</option>
        <?php foreach($editoriales as $editorial):?>
          <option value="<?php echo $editorial->fields["id"]; ?>"><?php echo $editorial->fields["nombre"];?> </option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
    <?php endif; ?>
    <?php if(count($categorias)>0):?>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Categoria</label>
    <div class="col-lg-10">
      <select name="categoria_id" class="form-control" required>
      <option value="">-- SELECCIONE --</option>
        <?php foreach($categorias as $categoria):?>
          <option value="<?php echo $categoria->fields["id"]; ?>"><?php echo $categoria->fields["nombre"];?> </option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
    <?php endif; ?>



  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-default">Agregar Libro</button>
    </div>
  </div>
</form>
                </div>
              </div>
            </div>

          </div>

        <!-- End Main Content -->

      </div><!-- End Page Content -->