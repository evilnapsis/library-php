<?php

$autores= EditorialData::getAll();
// print_r($autores);
?>
      <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
                  <a href="./index.php?view=nuevaeditorial" class="btn btn-default pull-right">Nueva Editorial</a>
            <h1>Editoriales</h1>
<?php if(count($autores)==0):?>
  <p class="alert alert-danger">No hay editoriales</p>
<?php endif; ?>
              <div class="widget">
                <div class="widget-title">
                  <i class="fa fa-male"></i> Editoriales
                </div>
                <div class="widget-body no-padding">

                  <div class="table-responsive">
<?php if(count($autores)>0):?>
                    <table class="table">
                      <tbody>
                      <?php foreach($autores as $autor):?>
                        <tr>
                        <td><?php echo $autor->nombre; ?></td>
                        <td>
                        <a href="./index.php?view=editeditorial&id=<?php echo $autor->id; ?>" class="btn btn-warning btn-xs">Editar</a>
                        <a href="./index.php?action=deleditorial&id=<?php echo $autor->id; ?>" class="btn btn-danger btn-xs">Eliminar</a>
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