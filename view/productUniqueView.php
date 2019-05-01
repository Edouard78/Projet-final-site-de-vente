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
<div class="product-unique-img-block col">

<div class="img-zoom-container">
  <img id="zoom-image" class='product-unique-img' src="<?php echo $productImgSrc; ?>" width="300" height="240" alt="Girl">
  <div id="zoom-result" class="img-zoom-result"></div>
</div>

</div>
<div class="productInfoUnique col">
<h5><?php echo $data['title'] ?></h5>
<h5><?php echo $data['brand'] ?></h5>
<p><?php echo $data['content'] ?></p>
<p><?php echo $data['price'] ?></p>

<form>
<div class="form-group row">
    <div class="col-3">
                  <label for="sm">Quantité :</label>
                  <input type="number" class="form-control input-sm" name ="quantity" id="sm" placeholder="Sélectionnez la quantité" value="1" min="1">
                </div>
</div>
                <button type="submit" id='submit' class="btn btn-dark">Ajouter au panier</button>
</form>

</div>
</div>




</div>


<script>

  document.getElementById('zoom-image').addEventListener('mouseover', function(){
    document.getElementById('zoom-result').style.display = 'block';
    imageZoom("zoom-image", "zoom-result"); 
  });

  document.getElementById('zoom-image').addEventListener('mouseleave', function(){
    document.getElementById('zoom-result').style.display = 'none';
  });

  $(document).ready(function(){

    $("#form").submit(function(e) {
        e.preventDefault();
        $.post(
            'controller/ajax.php', // Un script PHP que l'on va créer juste après
            {
                id : json_encode(<?php echo $_GET['id']; ?>),  // Nous récupérons la valeur de nos inputs que l'on fait passer à connexion.php
                price : json_encode(<?php echo $data['price']; ?>),
                quantity : $("#quantity").val()
            },

            function(data){ // Cette fonction ne fait rien encore, nous la mettrons à jour plus tard
            
                console.log(data);

            },
            'text' // Nous souhaitons recevoir "Success" ou "Failed", donc on indique text !
         );

    });

});
</script>

<?php
$content = ob_get_clean();
require('template.php');

?>