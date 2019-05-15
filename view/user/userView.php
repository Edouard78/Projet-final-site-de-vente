<?php ob_start();

?>

<div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
<h3>Mon Panier</h3>
	<thead>
		<tr>
			<th>N° de commande</th>
			<th>Date</th>
			<th>Ref</th>
			<th>Nb d'articles</th>
			<th>Prix Total</th>
            <th>Facture (PDF)</th>
		</tr>
	</thead>
		<tbody>
			<?php while ($data = $dataOrder->fetch()) { 
      		?>
      	<tr>
      	
				<td><?php echo $data['id']; ?></td>
				<td><?php echo $data['dateFr']; ?></td>
				<td><?php echo $data['token']; ?></td>

                <td><?php echo 'unknown' ?></td>
                <td><?php echo $data['totalPrice']; ?> <em class="fa fa-euro"></em></td>
                <td><a href='index.php?action=downloadBill&amp;orderId=<?php echo $data['id']; ?>'> <i class="fa fa-file-pdf-o" style='font-size:24px; color:red'></i></a></td>
                </tr>
                <?php
  }
?>
			</tbody>
	</table>
</div>

	<?php $content = ob_get_clean();

require ('view/template.php');

?>