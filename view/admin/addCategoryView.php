<?php ob_start();
?>
<h3>Ajouter une Categorie</h3>
<br>
<?php 


if (isset($_GET['error']))
{
	if ($_GET['error'] == 1)
	{
?>
<div class="alert alert-danger">
    <strong>Un ou plusieurs champs sont incorrect</strong>
</div>
<br>
<?php
	}
}
?>
<form action="index.php?action=addCategory" method="post" enctype="multipart/form-data">

						<div class="form-group">
							<label for="title">Titre</label>
							<input type="text" class="form-control" name ="title" id="title" placeholder="Titre">
						</div>
						<div class="form-group">
							<label for="description">Description :</label>
							<input type="text" class="form-control" name ="description" id="description" placeholder="Description">
						</div>
						
						<button type="submit" class="btn btn-primary">Ajouter</button>
					</form>

<?php $content = ob_get_clean();

require 'view/admin/adminTemplate.php';
?>