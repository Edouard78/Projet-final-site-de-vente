
<?php ob_start(); 
?>
<h3>Panier</h3>
		<div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
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
            
            if (isset($_SESSION['itemsCheckout']) && isset($_SESSION['checkoutTotal']))
            {
                foreach ($_SESSION['itemsCheckout'] as $id=>$item) {

					$itemImgSrc = './uploads/items/'.$item->id() ; ?>
            
      	<tr>
				<td><?= $item->id() ?></td>
				<td><img class="imgCheckoutItem" src="<?php echo $itemImgSrc; ?>" /></td>
				<td><form action="index.php?action=updateItemCheckout&amp;itemCheckoutId=<?php echo $id ?> " method="post">
				<div class="col-3">
				<input type="number" class="form-control  " name ="quantity" iplaceholder="Sélectionnez la quantité" value="<?= $item->quantity() ?>" min ="1" >
				</div>
				</td>
                <td><?= $item->price() ?> <em class="fa fa-euro"></em></td>
                <td>
						<button type="submit" class="btn btn-default">Mettre à jour</button>
                        </form></td>
						<td>
						<a type="button" href="index.php?action=deleteItemCheckout&amp;id=<?php echo $id ;?>" class="btn btn-dark">Supprimer</button>
                        </form></td>
                </tr>
                <?php
			}
           
            ?>
		
			

			</tbody>

		
            
	</table>

	
</div>

<h3  class="float-right">Prix Total : <?php echo $_SESSION['checkoutTotal']->total() ?> <em class="fa fa-euro"></em> </h3>
	<?php  } 

?>
	


	<?php $content = ob_get_clean(); 

	require('template.php');

	?>
