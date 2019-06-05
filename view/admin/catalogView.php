
<?php ob_start(); ?>
<h3>Produits</h3>
	<a href="index.php?action=addProductPage" class="btn btn-primary">
		Ajouter un produit
		</a>
		<br>
		
<table class="table table-bordered table-striped table-condensed">
	<thead>
		<tr>
			<th>Id</th>
			<th>Titre</th>
			<th>Date d'ajout</th>
	
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
				<td><?= $data['addingDateFr'] ?> </em></td>
				<td><a href="index.php?action=deleteComment&amp;id=<?= $data['id'] ?>" class="btn btn-dark" role="button">
						Supprimer 
					</a></td>
				</tr>

			</tbody>
			<?php
		}
		$products->closeCursor();
		?>

	</table>
</div>

<h3>Categories</h3>
	<a href="index.php?action=addPostPage" class="btn btn-primary">
		Ajouter une categorie
		</a>
		<br>
		
<table class="table table-bordered table-striped table-condensed">
	<thead>
		<tr>
			<th>Id</th>
			<th>Titre</th>
			<th>Date d'ajout</th>
	
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
				<td><?= htmlspecialchars($data['date']) ?> <em class="fa fa-euro"></em></td>
				<td><a href="index.php?action=deleteComment&amp;id=<?= $data['id'] ?>" class="btn btn-dark" role="button">
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