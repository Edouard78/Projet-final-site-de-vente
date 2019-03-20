<?php
ob_start();
?>
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
<form class="col-lg-6" method="post" action="index.php?action=subscribe">
  <legend>Inscription</legend>
    Votre nom d'utilisateur <input type="text" class="form-control" name="login">
    Choisissez un mot de passe <input type="password" class="form-control" name="password"">
    Retaper votre mot de passe <input type="password" class="form-control" name="password2"">
    Votre email <input type="text" class="form-control" name="email">
    <button type="submit">Soumettre</button>
</form>

<?php
$content = ob_get_clean();
require ('view/template.php');

?>