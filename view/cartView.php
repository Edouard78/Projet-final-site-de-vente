<?php ob_start();

if (isset($_SESSION['cart'])) {
  

?>

<div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
<h3>Mon Panier</h3>
	<thead>
		<tr>
			<th>Produit</th>
			<th>Image</th>
			<th>Quantité</th>
			<th>Prix</th>
            <th>Mettre à jour</th>
			<th>Supprimer</th>
		</tr>
	</thead>
		<tbody>
      	<tr>
      	<?php foreach ($_SESSION['cart']->products() as $id => $product) { 
      		$productImgSrc = './uploads/products/' . $product->id(); ?> 
				<td><?=$product->title() ?></td>
				<td><img class="cart-product-img" src="<?php echo $productImgSrc; ?>" /></td>
				<td><form action="index.php?action=updateProductCart&amp;productCartId=<?php echo $id ?> " method="post">
				<div class="col-3">
				<input type="number" class="form-control  " name ="quantity" iplaceholder="Sélectionnez la quantité" value="<?=$product->quantity() ?>" min ="1" >
				</div>
				</td>
                <td><?=$product->price() ?> <em class="fa fa-euro"></em></td>
                <td>
						<button type="submit" class="btn btn-default">Mettre à jour</button>
                        </form></td>
						<td>
						<a type="button" href="index.php?action=deleteProductCart&amp;id=<?php echo $id; ?>" class="btn btn-dark">Supprimer</a>
                        </form></td>
                </tr>
                <?php
  }
?>
			</tbody>
	</table>
</div>

<div class="afterCartBLock float-right">
<h3  id="cartTotalPrice">Prix Total : <strong><?php echo $_SESSION['cart']->totalPrice() ?> <em class="fa fa-euro"></em></strong></h3>
	
<a id ="submitCart float-right" type="button" href="index.php?action=submitCart" class="btn btn-primary">Valider mon Panier</a>
</div>

<?php
} else {
	?>
	<h3>Aucun articles présents dans le panier</h3>
<?php
}
?>
	<?php $content = ob_get_clean();

require ('template.php');

?>