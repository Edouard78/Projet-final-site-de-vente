<?php
ob_start();

$data = $item->fetch();

    $itemId = $_GET['id'];
    $itemImgSrc = './uploads/items/'.$itemId ; ?>


<div class="jumbotron jumbotronItemUnique">
<div class="row">
<div class="itemImgUnique col">
<a class="nav-link" data-toggle="modal" data-backdrop="true" href="#itemImgUniqueZoom">

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
    <img class="d-block w-100" src="<?php echo $itemImgSrc; ?>" alt="First slide">

    </div>
    <div class="carousel-item">
    <img class="d-block w-100" src="<?php echo $itemImgSrc; ?>" alt="Second slide" >
    </div>
    <div class="carousel-item">
      
    <img class="d-block w-100" src="<?php echo $itemImgSrc; ?>" alt="Second slide" >
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>




</a>
</div>
<div class="itemInfoUnique col">
<h5><?php echo $data['title'] ?></h5>
<h5><?php echo $data['brand'] ?></h5>
<p><?php echo $data['content'] ?></p>
<p><?php echo $data['price'] ?></p>

<form action="index.php?action=addItemCheckout&amp;id=<?php echo $data['id']?>&amp;price=<?php echo $data['price'] ?>" method="post">
<div class="form-group row">
    <div class="col-3">
                  <label for="sm">Quantité :</label>
                  <input type="number" class="form-control input-sm" name ="quantity" id="sm" placeholder="Sélectionnez la quantité" value="1" min="1">
                </div>
</div>
                <button type="submit" class="btn btn-dark">Ajouter au panier</button>
</form>

</div>
</div>




</div>



<?php
$content = ob_get_clean();
require('template.php');

?>