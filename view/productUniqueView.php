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
  <img id="zoom-image"  src="<?php echo $productImgSrc; ?>" width="300" height="240">
  <div id="zoom-result" class="img-zoom-result"></div>
</div>

</div>
<div class="productInfoUnique col">
<h5><?php echo $data['title'] ?></h5>
<h5><?php echo $data['brand'] ?></h5>
<p>Prix : <?php echo $data['price'] ?> <em class="fa fa-euro"></em></p>

<form id='form'>
<div class="form-group row">
    <div class="col-3">
                  <label for="sm">Quantité :</label>
                  <input type="number" class="form-control input-sm" name ="quantity" id="quantity" placeholder="Sélectionnez la quantité" value="1" min="1">
                </div>
</div>
                <button type="submit" class="btn btn-dark">Ajouter au panier</button>
</form>

<p style='border-top : 1px black solid; margin-top: 30px;'><?php echo $data['content'] ?></p>
</div>
</div>




</div>

<div class="modal fade" id="modal-sucess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Infos Panier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>L'article a bien été ajouté au panier</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Continuer mes achats</button>
        <a href='index.php?action=cartPage' class="btn btn-primary">Accèder à mon panier</a>
      </div>
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

let modalSuccess = $('#modal-sucess');
    $("#form").submit(function(e) {
        e.preventDefault();

        $.post(
            'index.php?action=addProductToCart', 
            {
                id : <?php echo $_GET['id'] ?>, 
                title :  <?php echo json_encode($data['title']) ?>,
                price : <?php echo $data['price'] ?>,
                quantity : $("#quantity").val()
            },

            function(data){
              if (data === 'success') {
                modalSuccess.modal('show');
              }
              else if ( (data === 'error')) {
                console.log('Erreur');
              }

            },
            'text' 
         );

    });

</script>

<?php
$content = ob_get_clean();
require('template.php');

?>