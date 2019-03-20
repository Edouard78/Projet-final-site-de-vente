
<?php ob_start(); 
?>
<h3>Panier</h3>
		<div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
	<thead>
		<tr>
			<th>Id</th>
			<th>Quantité</th>
			<th>Prix</th>
            <th>Mettre à jour</th>
		</tr>
	</thead>
		<tbody>

		
             
            <?php 
            
            if (isset($_SESSION['itemsCheckout']))
            {
                $arrlength = count($_SESSION['itemsCheckout']);
                for($i = 0; $i < $arrlength; $i++) {
            
  	?>
      	<tr>
				<td><?= $_SESSION['itemsCheckout'][$i]->id() ?></td>
				<td><form action="index.php?action=updateItemCheckout&amp;itemCheckoutId=<?php echo $i ?> " method="post">
				<div class="col-sm-2">
				<input type="number" class="form-control input-sm" name ="quantity" id="sm" placeholder="Sélectionnez la quantité" value="<?= $_SESSION['itemsCheckout'][$i]->quantity() ?>" min="1" >
				</div>
				</td>
                <td><?= $_SESSION['itemsCheckout'][$i]->price() ?> <em class="fa fa-euro"></em></td>
                <td>
						<button type="submit" class="btn btn-default">Mettre à jour</button>
                        </form></td>
                </tr>
                <?php
            }
            }
            ?>
		
			

			</tbody>
            
	</table>
</div>


	<?php $content = ob_get_clean(); ?>

	<?php



	require 'template.php';
	?>
