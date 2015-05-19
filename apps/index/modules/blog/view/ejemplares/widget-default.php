<?php

$a = new SQLMan();
$a->tablename = "libro";
//$a->in_test=true;
$libro= $a->select("one","",$where="id=".$_GET["id"]);
$libro = $libro[0];


$a = new SQLMan();
$a->tablename = "ejemplar";
$autores= $a->select("many","","libro_id=".$libro->fields["id"]);
// print_r($autores);
?>
      <div class="page-content">

        <!-- Header Bar -->
<?php Action::load("header");?>
        <!-- End Header Bar -->

          <div class="row">
            <div class="col-lg-12">
                  <a href="./index.php?view=nuevoejemplar&id=<?php echo $libro->fields["id"];?>" class="btn btn-default pull-right">Nuevo jemplar</a>
            <h1><?php echo $libro->fields["titulo"]; ?> <small>Ejemplares</small></h1>
<?php if(count($autores)>0):?>

              <div class="widget">
                <div class="widget-title">
                  <i class="fa fa-book"></i> Ejemplares
                </div>
                <div class="widget-body no-padding">

                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                      <?php foreach($autores as $autor):?>
                        <tr>
                        <td><?php echo $autor->fields["codigo"]; ?></td>
                        <td>
                          <?php if($autor->fields["status"]==0){
                            echo "<span class='label label-success'>Disponible<span>";
                            }else if($autor->fields["status"]==1){
                            echo "<span class='label label-warning'>Ocupado<span>";
                              
                            }

                             ?>
                        </td>
                        <td>
                          <?php if($autor->fields["status"]==0):?>
                          <a href="./index.php?view=prestarlibro&id=<?php echo $autor->fields["id"]; ?>" class="btn btn-primary btn-xs">Prestar</a>
                        <?php endif; ?>
                        <!--
                        <a href="./index.php?view=editlibro&id=<?php echo $autor->fields["id"]; ?>" class="btn btn-warning btn-xs">Editar</a>
                        <a href="./index.php?action=dellibro&id=<?php echo $autor->fields["id"]; ?>" class="btn btn-danger btn-xs">Eliminar</a>
                        -->

                        </td>
                        </tr>
                      <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
<?php else:?>
  <br>
  <p class="alert alert-warning">No hay ejemplares. Agregue uno</p>
<?php endif; ?>
            </div>

          </div>

        <!-- End Main Content -->

      </div><!-- End Page Content -->