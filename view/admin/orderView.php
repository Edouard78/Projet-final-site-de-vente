
<?php ob_start(); ?>
<h3>Commandes</h3>
<br>	
<table class="table table-bordered table-striped table-condensed">
	<thead>
		<tr>
			<th>Id</th>
			<th>Id Client</th>
			<th>Total</th>
			<th>Détails</th>
			<th>Date</th>
		</tr>
	</thead>
	<?php
	while ($data = $orders->fetch())
	{
		?>
		<tbody>

			<tr>
				<td><?= $data['id'] ?></td>
				<td><?= htmlspecialchars($data['userId']) ?></td>
				<td><?= htmlspecialchars($data['totalPrice']) ?> <em class="fa fa-euro"></em></td>
				<td> <a href="index.php?action=orderUniqueAdmin&amp;orderId=<?= $data['id'] ?>" class="btn btn-light">
					</span> Voir
				<td><?= htmlspecialchars($data['date']) ?></td>
				</a>
				</tr>

			</tbody>
			<?php
		}
		$orders->closeCursor();
		?>

	</table>
</div>


	<?php $content = ob_get_clean(); ?>

	<?php



	require 'view/admin/adminTemplate.php';
	?>
