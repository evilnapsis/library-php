<?php

$autores= AutorData::getAll();

// print_r($autores);
?>
      <div class="page-content">

        <!-- Header Bar -->
        <!-- End Header Bar -->

          <div class="row">
            <div class="col-lg-12">
                  <a href="./index.php?view=nuevoautor" class="btn btn-default pull-right">Nuevo Autor</a>
            <h1>Autores</h1>
<?php if(count($autores)==0):?>
  <p class="alert alert-danger">No hay autoress</p>
<?php endif; ?>
              <div class="widget">
                <div class="widget-title">
                  <i class="fa fa-male"></i> Autores
                </div>
                <div class="widget-body no-padding">

                  <div class="table-responsive">
<?php if(count($autores)>0):?>
                    <table class="table">
                      <tbody>
                      <?php foreach($autores as $autor):?>
                        <tr>
                        <td><?php echo $autor->nombre; ?></td>
                        <td><?php echo $autor->apellido; ?></td>
                        <td>
                        <a href="./index.php?view=editautor&id=<?php echo $autor->id; ?>" class="btn btn-warning btn-xs">Editar</a>
                        <a href="./index.php?action=delautor&id=<?php echo $autor->id; ?>" class="btn btn-danger btn-xs">Eliminar</a>
                        </td>
                        </tr>
                      <?php endforeach; ?>
                      </tbody>
                    </table>
<?php endif; ?>
                  </div>
                </div>
              </div>
            </div>

          </div>

        <!-- End Main Content -->

      </div><!-- End Page Content -->