<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="searchbook"){
  if(isset($_GET["product"]) && $_GET["product"]!=""):
    $products = BookData::getLike($_GET["product"]);
    if(count($products)>0):
    ?>
    <div class="card mb-4">
      <div class="card-header">Resultados de la Busqueda</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead class="table-light">
              <tr>
                <th>ISBN</th>
                <th>Titulo</th>
                <th>Accion</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($products as $product): ?>
            <tr class="align-middle">
              <td style="width:120px;"><?php echo $product->isbn; ?></td>
              <td><?php echo $product->title; ?></td>
              <td style="width:350px;">
                <form method="post" action="./?action=rent&opt=addtocart">
                  <input type="hidden" name="book_id" value="<?php echo $product->id; ?>">
                  <?php $items = ItemData::getAvaiableByBookId($product->id);?>
                  <div class="input-group">
                    <select class="form-select" name="item_id" required>
                      <option value=""> -- EJEMPLAR --</option>
                      <?php foreach($items as $item):?>
                        <option value="<?php echo $item->id; ?>"> <?php echo $item->code; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Agregar</button>
                  </div>
                </form>
              </td>
            </tr>
            <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php else: ?>
      <div class="alert alert-danger mx-3">No se encontro el libro.</div>
    <?php endif; ?>
  <?php endif; 
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="addtocart"){
  if(!isset($_SESSION["cart"])){
    $product = array("book_id"=>$_POST["book_id"],"item_id"=>$_POST["item_id"]);
    $_SESSION["cart"] = array($product);
  } else {
    $found = false;
    $cart = $_SESSION["cart"];
    foreach($cart as $c){
      if($c["item_id"]==$_POST["item_id"]){
        $found=true;
        break;
      }
    }
    if($found==false){
      $product = array("book_id"=>$_POST["book_id"],"item_id"=>$_POST["item_id"]);
      $cart[] = $product;
      $_SESSION["cart"] = $cart;
    }else{
      Core::alert("El ejemplar ya esta agregado en la lista!");
    }
  }
  Core::redir("./?view=rent");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="clearcart"){
  unset($_SESSION["cart"]);
  Core::redir("./?view=rent");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="clearcartitem"){
  $cart = $_SESSION["cart"];
  $newcart = array();
  foreach($cart as $c){
    if($c["book_id"]!=$_GET["product_id"]){
      $newcart[] = $c;
    }
  }
  $_SESSION["cart"] = $newcart;
  Core::redir("./?view=rent");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="process"){
  $go = true;
  if(strtotime($_POST["start_at"]) > strtotime($_POST["finish_at"])){
    $go=false;
  }
  if($go && isset($_SESSION["cart"])){
    $cart = $_SESSION["cart"];
    if(count($cart)>0){
      foreach($cart as $c){
        $op = new OperationData();
        $op->item_id = $c["item_id"] ;
        $op->client_id = $_POST["client_id"];
        $op->start_at = $_POST["start_at"];
        $op->finish_at = $_POST["finish_at"];
        $op->user_id = $_SESSION["user_id"];
        $op->add();

        $item = ItemData::getById($c["item_id"]);
        $item->unavaiable();
      }
      unset($_SESSION["cart"]);
    }
    Core::alert("Prestamo procesado exitosamente!");
    Core::redir("./?view=rents&opt=all");
  } else {
    Core::alert("Rango de fecha invalido!");
    Core::redir("./?view=rent");
  }
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="finalize"){
  if(isset($_SESSION["user_id"])){
    $operation = OperationData::getById($_GET["id"]);
    $item = ItemData::getById($operation->item_id);
    $item->avaiable();
    $operation->finalize();
    Core::alert("Prestamo finalizado!");
    Core::redir("./?view=rents&opt=all");
  }
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
  if(isset($_SESSION["user_id"])){
    $operation = OperationData::getById($_GET["id"]);
    $item = ItemData::getById($operation->item_id);
    $item->avaiable();
    $operation->del();
    Core::alert("Prestamo eliminado!");
    Core::redir("./?view=rents&opt=all");
  }
}
?>
