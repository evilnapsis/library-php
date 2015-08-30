<?php

$a = new SQLMan();
$a->tablename = "usuario";
$autores= $a->select();
// print_r($autores);
?>
      <div class="page-content">

        <!-- Header Bar -->
<?php Action::load("header");?>
        <!-- End Header Bar -->

          <div class="row">
            <div class="col-lg-12">
                  <a href="./index.php?view=nuevousuario" class="btn btn-default pull-right">Nuevo Usuario</a>
            <h1>Usuarios</h1>
              <div class="widget">
                <div class="widget-title">
                  <i class="fa fa-male"></i> Usuarios
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
                        <a href="./index.php?view=editusuario&id=<?php echo $autor->fields["id"]; ?>" class="btn btn-warning btn-xs">Editar</a>
                        <a href="./index.php?action=delusuario&id=<?php echo $autor->fields["id"]; ?>" class="btn btn-danger btn-xs">Eliminar</a>
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