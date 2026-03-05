<?php 
// si el usuario no esta logeado
if(!isset($_SESSION["user_id"])){ Core::redir("./");}
$user= UserData::getById($_SESSION["user_id"]);
// si el id  del usuario no existe.
if($user==null){ Core::redir("./");}
?>
<?php if(isset($_GET["opt"]) && $_GET['opt']=="all"):
$contacts = UserData::getAll();
  ?>











            <div class="row">
            <div class="col-md-12">
              <div class="card mb-4">
                <div class="card-header">Usuarios</div>
                <div class="card-body">
<a href="./?view=users&opt=new" class="btn btn-secondary">Nuevo Usuario</a>
                  <!-- /.row--><br><br>
                  <div class="table-responsive">

<?php if(count($contacts)>0):?>
                    <table class="table border mb-0">
                      <thead class="table-light fw-semibold">
                        <tr class="align-middle">

                          <th>Nombre completo</th>
                          <th>Nombre de usuario</th>
                          <th>Activo</th>
                          <th>Admin</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

    <?php foreach($contacts as $con):?>
      <tr>
        <td><?php echo $con->name." ".$con->lastname; ?></td>
        <td><?php echo $con->username; ?></td>
        <td>
          <?php if($con->is_active):?>
            <i class="bi bi-check"></i>
          <?php endif; ?>
        </td>
        <td>
          <?php if($con->is_admin):?>
            <i class="bi bi-check"></i>
          <?php endif; ?>
        </td>
        <td>
          <a href="./?view=users&opt=edit&id=<?php echo $con->id; ?>" class="btn btn-warning btn-sm"><i class="bi-pencil"></i></a>
        </td>
      </tr>
    <?php endforeach; ?>
                      </tbody>
                    </table>
<?php else:?>
  <p class="alert alert-warning">No hay Usuarios</p>
<?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col-->
          </div>













<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="new"):?>
<div class="">
<div class="row">
<div class="col-md-12">

              <div class="card mb-4">
                <div class="card-header">Usuarios</div>
                <div class="card-body">
<h2>Nuevo Usuario</h2>

                <div class="row">
                  <div class="col-md-6">
<form method="post" action="./?action=users&opt=add">
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" required name="name" class="form-control" id="exampleInputEmail1" placeholder="Nombre">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Apellido</label>
    <input type="text" name="lastname" class="form-control" id="exampleInputEmail1" placeholder="Apellido">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Nombre de usuario</label>
    <input type="text" required name="username" class="form-control" id="exampleInputEmail1" placeholder="Nombre de usuario">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Email</label>
    <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Contrase&ntilde;a</label>
    <input type="password" required name="password" class="form-control" id="exampleInputEmail1" placeholder="Contrase&ntilde;a">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1" class="col-lg-2 control-label">Es administrador</label>
    <div class="col-md-6">
<div class="checkbox">
    <label>
      <input type="checkbox" name="is_admin"> 
    </label>
  </div>
    </div>
  </div>
  <div class="d-grid gap-2">
  <button type="submit" class="btn btn-primary ">Guardar</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="edit"):
$contact = UserData::getById($_GET["id"]);
  ?>
  <div class="">
<div class="row">
<div class="col-md-12">

              <div class="card mb-4">
                <div class="card-header">Usuarios</div>
                <div class="card-body">
<h2>Editar Usuario</h2>
<div class="row">
  <div class="col-md-6">
<form method="post" action="./?action=users&opt=update">
  <input type="hidden" name="_id" value="<?php echo $contact->id; ?>">
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" required name="name" value="<?php echo $contact->name; ?>" class="form-control" id="exampleInputEmail1" placeholder="Nombre">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Apellido</label>
    <input type="text" name="lastname" value="<?php echo $contact->lastname; ?>" class="form-control" id="exampleInputEmail1" placeholder="Apellido">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Nombre de usuario</label>
    <input type="text" required name="username" value="<?php echo $contact->username; ?>" class="form-control" id="exampleInputEmail1" placeholder="Nombre de usuario">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Email</label>
    <input type="text" name="email" value="<?php echo $contact->email; ?>" class="form-control" id="exampleInputEmail1" placeholder="Email">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Contrase&ntilde;a</label>
    <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Contrase&ntilde;a">
    <p class="help-block">La contrase&ntilde;a solo se modificara si escribes algo, en caso contrario no se modifica.</p>
  </div>
  <div class="form-group mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label" >Esta activo</label>
    <div class="col-md-6">
<div class="checkbox">
    <label>
      <input type="checkbox" name="is_active" <?php if($contact->is_active){ echo "checked";}?>> 
    </label>
  </div>
    </div>
  </div>


  <div class="form-group mb-3">
    <label for="inputEmail1" class="col-lg-2 control-label" >Es administrador</label>
    <div class="col-md-6">
<div class="checkbox">
    <label>
      <input type="checkbox" name="is_admin" <?php if($contact->is_admin){ echo "checked";}?>> 
    </label>
  </div>
    </div>
  </div>
  <div class="d-grid gap-2">
  <button type="submit" class="btn btn-success ">Actualizar</button>
</div>
</form>

</div>
</div>

</div>
</div>

</div>
</div>
</div>
<?php endif; ?>