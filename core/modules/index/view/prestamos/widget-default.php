<?php

$a = new SQLMan();
$a->tablename = "prestamo";
//$a->in_test = true;
$prestamos= $a->select("","",$where=" receptor_id is NULL");
?>
      <div class="page-content">

        <!-- Header Bar -->
<?php Action::load("header");?>
        <!-- End Header Bar -->

          <div class="row">
            <div class="col-lg-12">
            <h1>Prestamos</h1>
<?php if(count($prestamos)>0):?>
              <div class="widget">
                <div class="widget-title">
                  <i class="fa fa-book"></i> Prestamos
                </div>
                <div class="widget-body no-padding">

                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                      <?php foreach($prestamos as $prestamo):
//echo $prestamo->fields["ejemplar_id"];


$u = new SQLMan();
$u->tablename = "usuario";
//$u->in_test=true;
$usuario= $u->select("one","",$where="id=".$prestamo->fields["usuario_id"]);
$usuario = $usuario[0];


$e = new SQLMan();
$e->tablename = "ejemplar";
//$e->in_test=true;
$ejemplar= $e->select("one","",$where="id=".$prestamo->fields["ejemplar_id"]);
$ejemplar = $ejemplar[0];
$l = new SQLMan();
$l->tablename = "libro";
//$l->in_test=true;
$libro= $l->select("one","",$where="id=".$ejemplar->fields["libro_id"]);
//print_r($libro);
$libro = $libro[0];
//print_r($libro);
                      ?>
                        <tr>
                        <td><?php echo $ejemplar->fields["codigo"]; ?></td>
                        <td><?php echo $libro->fields["titulo"]; ?></td>
                        <td><?php echo $usuario->fields["nombre"]; ?> <?php echo $usuario->fields["apellido"]; ?></td>
                        <td><?php echo date("d-M-Y",strtotime($prestamo->fields["created_at"])); ?></td>
                        <td><?php echo date("d-M-Y",strtotime($prestamo->fields["return_at"])); ?></td>
                        <td>
                        <a href="./index.php?action=devolverlibro&prestamo_id=<?php echo $prestamo->fields["id"]; ?>" class="btn btn-default btn-xs">Devolver libro</a>
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
	<p class="alert alert-warning">No hay prestamos.</p>
<?php endif; ?>


            </div>

          </div>

        <!-- End Main Content -->

      </div><!-- End Page Content -->