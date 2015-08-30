<?php

$e = new SQLMan();
$e->tablename = "ejemplar";
//$e->in_test=true;
$ejemplar= $e->select("one","",$where="id=".$_GET["id"]);
$ejemplar = $ejemplar[0];


$a = new SQLMan();
$a->tablename = "libro";
//$a->in_test=true;
$libro= $a->select("one","",$where="id=".$ejemplar->fields["id"]);
$libro = $libro[0];


$u = new SQLMan();
$u->tablename = "usuario";
$usuarios= $u->select();


?>
      <div class="page-content">

        <!-- Header Bar -->
<?php Action::load("header");?>
        <!-- End Header Bar -->


          <div class="row">
            <div class="col-lg-12">
            <h2><?php echo $libro->fields["titulo"]; ?> <small>Prestar Libro</small></h2>
              <div class="widget">
                <div class="widget-title">
                  <i class="fa fa-book"></i> Prestar Libro
                </div>
                <div class="widget-body">
<form class="form-horizontal" role="form" method="post" action="./index.php?action=prestarlibro">
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Usuario</label>
    <div class="col-lg-10">
<select class="form-control" name="usuario_id" required>
<option value="">-- SELECCIONE USUARIO--</option>
  <?php foreach($usuarios as $usuario):?>
    <option value="<?php echo $usuario->fields["id"]; ?>"><?php echo $usuario->fields["nombre"]; ?> <?php echo $usuario->fields["apellido"]; ?></option>
  <?php endforeach;?>
</select>

      <input type="hidden" name="ejemplar_id" value="<?=$ejemplar->fields["id"];?>" >

    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha de devolucion</label>
    <div class="col-lg-10">
      <input type="date" name="return_at"  required class="form-control" id="inputEmail1" placeholder="Codigo">


    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-default">Prestar Libro</button>
    </div>
  </div>
</form>
                </div>
              </div>
            </div>

          </div>

        <!-- End Main Content -->

      </div><!-- End Page Content -->