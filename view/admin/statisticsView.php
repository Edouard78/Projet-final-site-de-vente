<?php ob_start(); ?>
<h3>Aujourd'hui</h3>
<br>

<?php
$date = date('d/m/Y', time()); ?>

		
<table class="table table-bordered table-striped table-condensed">
	<thead>
		<tr>
			<th>Date</th>
			<th>Inscriptions</th>
			<th>Nb Commandes</th>
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
<h3>Cette semaine</h3>
<br>
<canvas id='chart'></canvas>
<script src='public/js/dateFormat.js'></script>
<script>

	let chart = document.getElementById('chart');
	chart.getContext('2d');
	var count = [<?php echo '"'.implode('","', $count).'"' ?>];

	function last7Days () {
    var result = [];
    for (var i=0; i<7; i++) {
        var d = new Date();
        d.setDate(d.getDate() - i);
        result.unshift( dateFormat(d, "dddd d mmmm") );
    }

    return result;
}

	let orderChart = new Chart(chart, {
		type : 'line',
		data: {
			labels: last7Days(),
			datasets: [{
				label:'Commandes',
				data: count,

			backgroundColor : 'DeepSkyBlue'
			}]
		}
	})



</script>


	<?php $content = ob_get_clean(); ?>

	<?php



	require 'view/admin/adminTemplate.php';
	?>

	<?php

