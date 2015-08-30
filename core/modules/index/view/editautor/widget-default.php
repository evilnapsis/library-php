<?php

$autor = AutorData::getById($_GET["id"]);
//print_r($autor);
?>
      <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
            <h2>Actualizar Autor</h2>
              <div class="widget">
                <div class="widget-title">
                  <i class="fa fa-male"></i> Editar Autores
                </div>
                <div class="widget-body">
<form class="form-horizontal" role="form" method="post" action="./index.php?action=updateautor">
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre</label>
    <div class="col-lg-10">
      <input type="text" name="nombre" value="<?php echo $autor->nombre; ?>" required class="form-control" id="inputEmail1" placeholder="Nombre">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido</label>
    <div class="col-lg-10">
      <input type="text" name="apellido" value="<?php echo $autor->apellido; ?>" class="form-control" id="inputEmail1" required placeholder="Apellido">
      <input type="hidden" name="id" value="<?php echo $autor->id; ?>" >
    </div>
  </div>



  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-default">Actualizar Autor</button>
    </div>
  </div>
</form>
                </div>
              </div>
            </div>

          </div>

        <!-- End Main Content -->

      </div><!-- End Page Content -->