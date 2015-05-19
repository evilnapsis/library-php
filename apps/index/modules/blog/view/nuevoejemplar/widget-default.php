<?php
$a = new SQLMan();
$a->tablename = "libro";
//$a->in_test=true;
$libro= $a->select("one","",$where="id=".$_GET["id"]);
$libro = $libro[0];
?>
      <div class="page-content">

        <!-- Header Bar -->
<?php Action::load("header");?>
        <!-- End Header Bar -->


          <div class="row">
            <div class="col-lg-12">
            <h2><?php echo $libro->fields["titulo"]; ?> <small>Nuevo Ejemplar</small></h2>
              <div class="widget">
                <div class="widget-title">
                  <i class="fa fa-male"></i> Libro
                </div>
                <div class="widget-body">
<form class="form-horizontal" role="form" method="post" action="./index.php?action=addejemplar">
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Codigo</label>
    <div class="col-lg-10">
      <input type="text" name="codigo"  required class="form-control" id="inputEmail1" placeholder="Codigo">
      <input type="hidden" name="libro_id" value="<?=$libro->fields["id"];?>" >

    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-default">Agregar Ejemplar</button>
    </div>
  </div>
</form>
                </div>
              </div>
            </div>

          </div>

        <!-- End Main Content -->

      </div><!-- End Page Content -->