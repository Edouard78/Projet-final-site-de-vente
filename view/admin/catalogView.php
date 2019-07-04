
<?php ob_start(); ?>
<h3>Produits</h3>
<br>
	<a href="index.php?action=addProductPage" class="btn btn-primary">
		Ajouter un produit
		</a>
		<br>
		
<table class="table table-bordered table-striped table-condensed">
	<thead>
		<tr>
			<th>Id</th>
			<th>Produit</th>
			<th>Marque</th>

			<th>Description</th>

			<th>Quantité</th>

			<th>Date</th>

			<th>Supprimer</th>
	
		</tr>
	</thead>
	<?php
	while ($data = $products->fetch())
	{
		?>
		<tbody>

			<tr>
				<td><?= $data['id'] ?></td>
				<td><?= htmlspecialchars($data['title']) ?></td>

				<td><?= htmlspecialchars($data['brand']) ?></td>

				<td><?= htmlspecialchars($data['content']) ?></td>

				<td><?= htmlspecialchars($data['quantity']) ?><?php if($data['quantity'] == 0 ) { ?> <span class="glyphicon glyphicon-warning-sign"></span> <?php } ?></td>
				<td><?= $data['addingDateFr'] ?> </em></td>
				<td><a href="index.php?action=deleteProduct&amp;id=<?= $data['id'] ?>" class="btn btn-dark" role="button">
						Supprimer 
					</a></td>
				</tr>

			</tbody>
			<?php
		}
		$products->closeCursor();
		?>

	</table>

<h3>Categories</h3>
<br>
	<a href="index.php?action=addCategoryPage" class="btn btn-primary">
		Ajouter une categorie
		</a>
		<br>
		
<table class="table table-bordered table-striped table-condensed">
	<thead>
		<tr>
			<th>Id</th>
			<th>Titre</th>
			<th>Description</th>
			<th>Date</th>
			<th>Supprimer</th>
	
		</tr>
	</thead>
	<?php
	while ($data = $categories->fetch())
	{
		?>
		<tbody>

			<tr>
				<td><?= $data['id'] ?></td>
				<td><?= htmlspecialchars($data['title']) ?></td>
				<td><?= htmlspecialchars($data['description']) ?></td>
				<td><?= $data['date'] ?> </em></td>
				<td><a href="index.php?action=deleteCategory&amp;id=<?= $data['id'] ?>" class="btn btn-dark" role="button">
						Supprimer 
					</a></td>
				</tr>

			</tbody>
			<?php
		}
		$categories->closeCursor();
		?>

	</table>
</div>


	<?php $content = ob_get_clean(); ?>

	<?php



	require 'view/admin/adminTemplate.php';
	?>