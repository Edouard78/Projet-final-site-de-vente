<?php
ob_start();
?>
<h3>Creer un compte</h3>
<?php

if (isset($_GET['errors']))
{
	$decode = urldecode($_GET['errors']);
	$errors = unserialize($decode);
	if (count($errors) > 2)
	{
?>
<div class="alert alert-danger">
    <strong>Vous avez fais plusieurs erreurs!<strong>
</div>
<?php
	}
	else
	if (count($errors) >= 1 AND count($errors) < 3)
	{
		foreach($errors as $value)
		{
			if ($value == 1)
			{
?>
   <div class="alert alert-warning">
    <strong>Le nom d'utilisateur éxiste déja!<strong>
</div>
<?php
			}

			if ($value == 2)
			{
?>

    <div class="alert alert-warning">
    <strong>Les mots de passes ne sont pas identiques<strong>
</div>
<?php
			}

			if ($value == 3)
			{
?>

    <div class="alert alert-warning">
    <strong>L'email que vous avez entré est déja pris<strong>
</div>
<?php
			}

			if ($value == 4)
			{
?>

    <div class="alert alert-warning">
    <strong>Nom d'utilisateur invalide<strong>
</div>
<?php
			}

			if ($value == 5)
			{
?>

    <div class="alert alert-warning">
    <strong>Mot de passe invalide<strong>
</div>
<?php
			}

			if ($value == 6)
			{
?>

    <div class="alert alert-warning">
    <strong>L'adresse email que vous avez entrée est invalide<strong>
</div>
<?php
			}
		}
	}
}

if (isset($_GET['success']))
{
	if ($_GET['success'] == 1)
	{
?>

    <div class="alert alert-success">
    <strong>Votre inscription a été enregistrée avec succès!<strong>
</div>
<?php
	}
}

?>
<form  method="post" action="index.php?action=subscribe">
  <legend>Informations du compte</legend>
<div class='form-group'>
    <label for="login">Nom d'utilisateur</label> <input type="text" class="form-control" name="login" id="login">
</div>

<div class='form-group'>
    <label for="email">Email</label> <input type="text" class="form-control" name="email" id="email">
</div>

<div class='form-group'>
    <label for="password">Mot de passe</label> <input type="password" class="form-control" name="password" id='password'>
</div>

<div class='form-group'>
    <label for="password2">Retaper votre mot de passe</label> <input type="password" class="form-control" name="password2" id="password2">
</div>
	<legend>Informations Personnelles</legend>	
	
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
    <button class='btn btn-primary'type="submit">Soumettre</button>
</form>

<?php
$content = ob_get_clean();
require ('view/template.php');

?>