<?php 
$item = ItemData::getById($_GET["id"]);
$book = BookData::getById($item->book_id); ?>
<div class="row">
	<div class="col-md-12">
	<h1><?php echo $book->title; ?> <small>Editar Ejemplar</small></h1>
	<br>
	<form class="form-horizontal" method="post" id="addcategory" action="./index.php?action=updateitem" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Codigo*</label>
    <div class="col-md-6">
      <input type="text" name="code" required value="<?php echo $item->code; ?>" class="form-control" id="code" placeholder="Codigo">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Status*</label>
    <div class="col-md-6">
<select name="status_id" class="form-control">
  <?php foreach(StatusData::getAll() as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($item->status_id==$p->id){ echo "selected"; }?>><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>





  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="item_id" value="<?php echo $item->id; ?>">
      <button type="submit" class="btn btn-success">Actualizar Ejemplar</button>
    </div>
  </div>
</form>
	</div>
</div>