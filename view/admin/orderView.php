
<?php ob_start(); ?>

<h3>Commandes</h3>
<br>	
<table class="table table-bordered table-striped table-condensed">
	<thead>
		<tr>
			<th>Id</th>
			<th>Id Client</th>
			<th>Total</th>
			<th>Facture (infos)</th>
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
				<td><a href='index.php?action=downloadBillAdmin&amp;orderId=<?php echo $data['id']; ?>'> <i class="fa fa-file-pdf-o" style='font-size:24px; color:red'></i></a></td>
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



<div class="modal fade" id="modalSucess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="edit-content">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Continuer mes achats</button>
        <a href='index.php?action=cartPage' class="btn btn-primary">Accèder à mon panier</a>
      </div>
    </div>
  </div>
</div>




	<?php $content = ob_get_clean(); ?>

	<?php



	require 'view/admin/adminTemplate.php';
	?>
