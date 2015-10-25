<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>.: Library v2.0 :.</title>

    <!-- Bootstrap core CSS -->
    <link href="res/bootstrap3/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="res/select2/select2.css" rel="stylesheet">
    <link href="res/select2/select2-bootstrap.css" rel="stylesheet">

    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <script src="js/jquery-1.10.2.js"></script>
<?php if(isset($_GET["view"]) && $_GET["view"]=="home"):?>
<link href='res/fullcalendar.min.css' rel='stylesheet' />
<link href='res/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='res/js/moment.min.js'></script>
<script src='res/fullcalendar.min.js'></script>
<?php endif; ?>
<script src='res/select2/select2.min.js'></script>

  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./">Library <sup><small><span class="label label-info">v2.0</span></small></sup> </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
<?php 
$u=null;
if(Session::getUID()!=""):
  $u = UserData::getById(Session::getUID());
?>
         <ul class="nav navbar-nav">
          </ul> 
          <ul class="nav navbar-nav side-nav">
          <li><a href="index.php?view=home"><i class="fa fa-home"></i> Inicio</a></li>
          <li><a href="index.php?view=rent"><i class="fa fa-cube"></i> Prestamo</a></li>
          <li><a href="index.php?view=rents"><i class="fa fa-th-large"></i> Prestamos</a></li>
          <li><a href="index.php?view=books"><i class="fa fa-book"></i> Libros</a></li>
          <li><a href="index.php?view=clients"><i class="fa fa-male"></i> Clientes</a></li>
          <li><a href="index.php?view=categories"><i class="fa fa-th-list"></i> Categorias</a></li>
          <li><a href="index.php?view=editorials"><i class="fa fa-th-list"></i> Editoriales</a></li>
          <li><a href="index.php?view=authors"><i class="fa fa-th-list"></i> Autores</a></li>
          <?php if($u->is_admin):?>
          <li><a href="index.php?view=reports"><i class="fa fa-area-chart"></i> Reportes</a></li>
          <li><a href="index.php?view=users"><i class="fa fa-users"></i> Usuarios </a></li>
        <?php endif;?>
          </ul>




<?php endif;?>



<?php if(Session::getUID()!=""):?>
<?php 
$u=null;
if(Session::getUID()!=""){
  $u = UserData::getById(Session::getUID());
  $user = $u->name." ".$u->lastname;

  }?>
          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <b><u>EVILNΛPSIS</u></b> <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a target="_blank" href="http://evilnapsis.com/">Sitio Web</a></li>
          <li><a target="_blank" href="http://evilnapsis.com/2015/05/16/sistema-bibliotecario-library/">Acerca de <b>Library</b></a></li>
          <li><a target="_blank" href="http://evilnapsis.com/store/">Tienda de aplicaciones</a></li>
        </ul>
        </li>

            <li class="dropdown user-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <?php echo $user; ?> <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="index.php?view=configuration">Configuracion</a></li>
          <li><a href="logout.php">Salir</a></li>
        </ul>
        </li>
        </ul>
<?php else:?>
<?php endif; ?>




        </div><!-- /.navbar-collapse -->
      </nav>


      <div id="page-wrapper">

<?php 
  // puedo cargar otras funciones iniciales
  // dentro de la funcion donde cargo la vista actual
  // como por ejemplo cargar el corte actual
  View::load("login");

?>



      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->

<script src="res/bootstrap3/js/bootstrap.min.js"></script>
<script>
</script>
  </body>
</html>
