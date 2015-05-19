<?php

$a = new SQLMan();
$a->tablename = "admin";
$autores= $a->select();
// print_r($autores);
?>
      <div class="page-content">

        <!-- Header Bar -->
<?php Action::load("header");?>
        <!-- End Header Bar -->

          <div class="row">
            <div class="col-lg-12">
                  <a href="./index.php?view=nuevoadmin" class="btn btn-default pull-right">Nuevo Administrador</a>
            <h1>Administradores</h1>
              <div class="widget">
                <div class="widget-title">
                  <i class="fa fa-male"></i> Administradores
                </div>
                <div class="widget-body no-padding">

                  <div class="table-responsive">
<?php if(count($autores)>0):?>
                    <table class="table">
                      <tbody>
                      <?php foreach($autores as $autor):?>
                        <tr>
                        <td><?php echo $autor->fields["nombre"]; ?></td>
                        <td><?php echo $autor->fields["apellido"]; ?></td>
                        <td>
                        <a href="./index.php?view=editadmin&id=<?php echo $autor->fields["id"]; ?>" class="btn btn-warning btn-xs">Editar</a>
                        <a href="./index.php?action=deladmin&id=<?php echo $autor->fields["id"]; ?>" class="btn btn-danger btn-xs">Eliminar</a>
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