<?php ob_start();

?>
<h3>Historique de commande</h3>
<br>
<div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
	<thead>
		<tr>
			<th>N° commande</th>
			<th>Date</th>
			<th>Nb produits</th>
			<th>St_Token</th>
			<th>Total</th>
            <th>Facture (PDF)</th>
		</tr>
	</thead>
		<tbody>
			<?php while ($data = $dataOrder->fetch()) { 
				include('model/db.php');
				$orderProductManager = new OrderProductManager($db);
				$nbProducts = $orderProductManager->countOrderProduct($data['id']);

      		?>
      	<tr>
      	
				<td><?php echo $data['id']; ?></td>
				<td><?php echo $data['dateFr']; ?></td>
				<td><?php echo $nbProducts->fetch()[0]; ?></td>
				<td><?php echo $data['token']; ?></td>
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

require ('userTemplate.php');

?>