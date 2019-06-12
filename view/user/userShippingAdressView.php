
<?php ob_start(); ?>
<h3>Vos adresses de livraison</h3>
<br>
<a href="index.php?action=addShippingAdressPage" class="btn btn-primary">
		Ajouter une adresse de Livraison
		</a>
<br>
		<div class="table-responsive">		
<table class="table table-bordered table-striped table-condensed">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Voir</th>
			<th>Supprimer</th>

		</tr>
	</thead>
	<?php
	while ($data = $userShippingAdress->fetch())
	{
		?>
		<tbody>

		<tr>
				<td><?= $data['title'] ?></td>
				<td><a href="#" class="btn btn-light">
						Voir 
					</a></td>

					<td><a href="index.php?action=deleteShippingAdress&amp;id=<?= $data['id'] ?>" class="btn btn-dark">
						 Supprimer
					</a></td>
				</tr>

			</tbody>
			<?php
		}
		$userShippingAdress->closeCursor();
		?>

	</table>
</div>


	<?php $content = ob_get_clean(); ?>

	<?php



	require 'userTemplate.php';
	?>
