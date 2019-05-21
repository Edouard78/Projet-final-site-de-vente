<?php ob_start(); ?>
<h3>Stats</h3>


<?php
$date = date('d/m/Y', time()); ?>

		
<table class="table table-bordered table-striped table-condensed">
	<thead>
		<tr>
			<th>Date</th>
			<th>Inscriptions</th>
			<th>Commandes</th>
			<th>Revenu du jour</th>
		</tr>
	</thead>

		<tbody>

			<tr>
				<td><?= $date ?></td>
				<td><?= $countUsers[0] ?></td>
				<td><?= $countOrders[0] ?></td>
				<td><?= $dayIncome ?> <em class="fa fa-euro"></em></td>
				

			</tbody>
	

	</table>
</div>


	<?php $content = ob_get_clean(); ?>

	<?php



	require 'view/admin/adminTemplate.php';
	?>

	<?php

