<?php

$a = new SQLMan();
$a->tablename = "libro";
$autores= $a->select();
// print_r($autores);
?>
      <div class="page-content">

        <!-- Header Bar -->
<?php Action::load("header");?>
        <!-- End Header Bar -->

          <div class="row">
            <div class="col-lg-12">
                  <a href="./index.php?view=nuevolibro" class="btn btn-default pull-right">Nuevo Libro</a>
            <h1>Libros</h1>
              <div class="widget">
                <div class="widget-title">
                  <i class="fa fa-book"></i> Libros
                </div>
                <div class="widget-body no-padding">

                  <div class="table-responsive">
<?php if(count($autores)>0):?>
                    <table class="table datatable">
                    <thead>
                      <th>ISBN</th>
                      <th>Titulo</th>
                      </thead>
                    </thead>
                      <tbody>
                      <?php foreach($autores as $autor):?>
                        <tr>
                        <td><?php echo $autor->fields["isbn"]; ?></td>
                        <td><?php echo $autor->fields["titulo"]; ?></td>
                        <td>
                        <a href="./index.php?view=ejemplares&id=<?php echo $autor->fields["id"]; ?>" class="btn btn-default btn-xs">Ejemplares</a>
                        <a href="./index.php?view=nuevoejemplar&id=<?php echo $autor->fields["id"]; ?>" class="btn btn-success btn-xs">Agregar Ejemplar</a>
                        <a href="./index.php?view=editlibro&id=<?php echo $autor->fields["id"]; ?>" class="btn btn-warning btn-xs">Editar</a>
                        <a href="./index.php?action=dellibro&id=<?php echo $autor->fields["id"]; ?>" class="btn btn-danger btn-xs">Eliminar</a>
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