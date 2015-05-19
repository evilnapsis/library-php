<!doctype html>
<html lang="en" ng-app="Dashboard">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>.: Biblioteca :.</title>

  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/dashboard/dashboard.css">
  <link rel="stylesheet" type="text/css" href="css/themes/black.css">
  <!--
  <link rel="stylesheet" type="text/css" href="css/themes/green.css">
  <link rel="stylesheet" type="text/css" href="css/themes/red.css">
  -->

  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/angular.min.js"></script>
  <script type="text/javascript" src="js/angular-cookies.js"></script>
  <script type="text/javascript" src="js/ng-bootstrap-tpls.min.js"></script>
  <script type="text/javascript" src="js/angular/bootstrap.js"></script>

</head>
<body ng-controller="MasterCtrl">
<?php if(isset($_SESSION["admin_id"])):?>
  <div id="page-wrapper" ng-class="{'active': toggle}" ng-cloak>

    <!-- Sidebar -->
    <div id="sidebar-wrapper">

      <ul class="sidebar">
        <li class="sidebar-main">
          <a href="#" ng-click="toggleSidebar()">
            Biblioteca
            <span class="menu-icon fa fa-align-justify"></span>
          </a>
        </li>
        <li class="sidebar-list">
          <a href="./">Inicio <span class="menu-icon fa fa-home"></span></a>
        </li>
        <li class="sidebar-list">
          <a href="./index.php?view=prestamos">Prestamos <span class="menu-icon fa fa-clock-o"></span></a>
        </li>
        <li class="sidebar-list">
          <a href="./index.php?view=libros">Libros <span class="menu-icon fa fa-book"></span></a>
        </li>
        <li class="sidebar-title separator"><span>Personas</span></li>
        <li class="sidebar-list">
          <a href="./index.php?view=usuarios">Usuarios <span class="menu-icon fa fa-user"></span></a>
        </li>
        <li class="sidebar-list">
          <a href="./index.php?view=admins">Administradores <span class="menu-icon fa fa-wrench"></span></a>
        </li>
        <li class="sidebar-title separator"><span>Varios</span></li>
        <li class="sidebar-list">
          <a href="./index.php?view=autores">Autores <span class="menu-icon fa fa-male"></span></a>
        </li>
        <li class="sidebar-list">
          <a href="./index.php?view=editoriales">Editoriales <span class="menu-icon fa fa-building-o"></span></a>
        </li>

        <li class="sidebar-list">
          <a href="./index.php?view=categorias">Categorias <span class="menu-icon fa fa-th-list"></span></a>
        </li>
      </ul>
<!--
      <div class="sidebar-footer">
        <div class="col-xs-4">
          <a href="https://github.com/Ehesp/Responsive-Dashboard" target="_blank">
            Github
          </a>
        </div>
        <div class="col-xs-4">
          <a href="#" target="_blank">
            About
          </a>
        </div>
        <div class="col-xs-4">
          <a href="#">
            Support
          </a>
        </div>
      </div>
      -->
    </div>

    <!-- End Sidebar -->

    <div id="content-wrapper">
    <?php View::load("index");?>
    </div><!-- End Content Wrapper -->
  </div><!-- End Page Wrapper -->
<?php else:?>
<br><br><br><br><br><br>
<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
<div class="panel panel-default">
<div class="panel-heading">
Ingresar
</div>
<div class="panel-body">

<form role="form" method="post" action="./login.php">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre de usuario</label>
    <input type="text" name="email"  class="form-control" placeholder="Usuario">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-default">Iniciar sesi&oacute;n</button>
</form>
</div>
</div>
</div>
</div>
</div>

<?php endif; ?>
  <script src="js/datatables/jquery.dataTables.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="js/datatables/dataTables.bootstrap.js"></script>
  <script>
  $(".datatable").dataTable();
  </script>
</body>
</html>