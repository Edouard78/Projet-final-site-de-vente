<?php ob_start();

?>
<h3>Ajouter une adresse de livraison</h3>
<br>

<?php 


if (isset($_GET['error']))
{
	if ($_GET['error'] == 1)
	{
?>
<div class="alert alert-danger">
    <strong>Un ou plusieurs champs n'ont pas été remplie<strong>
</div>
<br>
<?php
	}
}
?>
<form action="index.php?action=addShippingAdress" method="post" enctype="multipart/form-data">
	<div class='form-group'>
	<label for="title"><strong>Titre de votre Adresse</strong></label> <input type="text" class="form-control" name="title"id="title">
</div>
<div class='form-group'>
	<label for="name">Nom et prénom</label> <input type="text" class="form-control" name="name"id="name">
</div>
	<div class='form-group'>
    <label for="adress">Adresse (rue, numéro, bâtiment)</label> <input type="text" class="form-control" name="adress" id="adress">
</div>
    <div class='form-group'>
    <label for="postalCode">Code postal</label> <input type="number" class="form-control" name="postalCode" id="postalCode">
</div>
    <div class='form-group'>
    <label for="city">Ville</label> <input type="text" class="form-control" name="city" id="city">
</div>
						<button type="submit" class="btn btn-primary">Ajouter</button>
					</form>

<?php $content = ob_get_clean();

require 'view/user/userTemplate.php';
?>