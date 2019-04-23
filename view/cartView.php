<?php ob_start();
?>

		<div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
<h3>Mon Panier</h3>
	<thead>
		<tr>
			<th>Id</th>
			<th>Image</th>
			<th>Quantité</th>
			<th>Prix</th>
            <th>Mettre à jour</th>
			<th>Supprimer</th>
		</tr>
	</thead>
		<tbody>

            <?php

if (isset($_SESSION['cart'])) {
  foreach ($_SESSION['cart']->products() as $id => $product) {

    $productImgSrc = './uploads/products/' . $product->id(); ?>
            
      	<tr>
				<td><?=$product->id() ?></td>
				<td><img class="imgCartProduct" src="<?php echo $productImgSrc; ?>" /></td>
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
	<?php
}

?>
<a id ="submitCart float-right" type="button" href="index.php?action=proceedCart" class="btn btn-primary">Passer au paiement</a>
</div>

	<?php $content = ob_get_clean();

require ('template.php');

?>