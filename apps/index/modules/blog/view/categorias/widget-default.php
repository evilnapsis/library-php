<?php

$a = new SQLMan();
//$a->in_test = true;
$a->tablename = "categoria";
$autores= $a->select();
// print_r($autores);
?>
      <div class="page-content">

        <!-- Header Bar -->
<?php Action::load("header");?>
        <!-- End Header Bar -->

          <div class="row">
            <div class="col-lg-12">
                  <a href="./index.php?view=nuevacategoria" class="btn btn-default pull-right">Nueva Categoria</a>
            <h1>Categorias</h1>
<?php if(count($autores)==0):?>
  <p class="alert alert-danger">No hay categorias</p>
<?php endif; ?>
              <div class="widget">
                <div class="widget-title">
                  <i class="fa fa-th-list"></i> Categorias
                </div>
                <div class="widget-body no-padding">

                  <div class="table-responsive">
<?php if(count($autores)>0):?>
                    <table class="table">
                      <tbody>
                      <?php foreach($autores as $autor):?>
                        <tr>
                        <td><?php echo $autor->fields["nombre"]; ?></td>
                        <td>
                        <a href="./index.php?view=editcategoria&id=<?php echo $autor->fields["id"]; ?>" class="btn btn-warning btn-xs">Editar</a>
                        <a href="./index.php?action=delcategoria&id=<?php echo $autor->fields["id"]; ?>" class="btn btn-danger btn-xs">Eliminar</a>
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