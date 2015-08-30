<?php

$a = new SQLMan();
$a->tablename = "categoria";
//$a->in_test=true;
$autor= $a->select("one","",$where="id=".$_GET["id"]);
$autor = $autor[0];
?>
      <div class="page-content">

        <!-- Header Bar -->
<?php Action::load("header");?>
        <!-- End Header Bar -->


          <div class="row">
            <div class="col-lg-12">
            <h2>Actualizar Categoria</h2>
              <div class="widget">
                <div class="widget-title">
                  <i class="fa fa-male"></i> Editar Categoria
                </div>
                <div class="widget-body">
<form class="form-horizontal" role="form" method="post" action="./index.php?action=updateeditorial">
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre</label>
    <div class="col-lg-10">
      <input type="text" name="nombre" value="<?php echo $autor->fields["nombre"]; ?>" required class="form-control" id="inputEmail1" placeholder="Nombre">
    </div>
  </div>


  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <input type="hidden" name="id" value="<?php echo $autor->fields["id"]; ?>">
      <button type="submit" class="btn btn-default">Actualizar Categoria</button>
    </div>
  </div>
</form>
                </div>
              </div>
            </div>

          </div>

        <!-- End Main Content -->

      </div><!-- End Page Content -->