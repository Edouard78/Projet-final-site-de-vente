<?php ob_start(); 

?>
<h3>Clients</h3>
<br>
<table class="table table-bordered table-striped table-condensed">
	<thead>
		<tr>
			<th>Id</th>
			<th>Client</th>
			<th>Email</th>
			<th>Inscription</th>
			<th>Supprimer</th>
		</tr>
	</thead>
  
		<tbody>

				<?php while ($data = $users->fetch()) { ?>
			<tr>
				
				
				<td><?php echo $data['id']; ?></td>
				<td><?php echo $data['login']; ?></td>
				<td><?= $data['email'] ?></td>
                <td><?= $data['subscribeDate'] ?></td>
		
                <td> <a href="index.php?action=deleteUser&amp;id=<?= $data['id'] ?>" class="btn btn-dark">
					 Supprimer
				</a>
				<td>  
                
				</tr>
 <?php } ?>
			</tbody>

	</table>


	<?php $content = ob_get_clean(); ?>

	<?php



	require 'view/admin/adminTemplate.php';
	?>
