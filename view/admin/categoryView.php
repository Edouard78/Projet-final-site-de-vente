
<?php ob_start(); ?>
<h3>Categories</h3>
		
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
