<?php
ob_start();
?>

<script src="./public/js/imageZoom.js"></script>

<?php

$data = $product->fetch();

    $productId = $_GET['id'];
    $productImgSrc = './uploads/products/'.$productId ; ?>


<div class="jumbotron jumbotronproductUnique">
<div class="row">
<div class="productImgUnique col">

<div class="img-zoom-container">
  <img id="myimage" src="<?php echo $productImgSrc; ?>" width="300" height="240" alt="Girl">
  <div id="myresult" class="img-zoom-result"></div>
</div>

</div>
<div class="productInfoUnique col">
<h5><?php echo $data['title'] ?></h5>
<h5><?php echo $data['brand'] ?></h5>
<p><?php echo $data['content'] ?></p>
<p><?php echo $data['price'] ?></p>

<form action="index.php?action=addProductToCart&amp;id=<?php echo $data['id']?>&amp;price=<?php echo $data['price'] ?>" method="post">
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


<script>

  document.getElementById('myimage').addEventListener('mouseover', function(){
    document.getElementById('myresult').style.display = 'block';
    imageZoom("myimage", "myresult"); 
  });

  document.getElementById('myimage').addEventListener('mouseleave', function(){
    document.getElementById('myresult').style.display = 'none';
  });
</script>

<?php
$content = ob_get_clean();
require('template.php');

?>