<?php
ob_start();
?>

<?php

if (isset($_GET['errors']))
	{
	if ($_GET['errors'] = 1)
		{
?>
        <div class="alert alert-danger">
    <strong>Le nom d'utilisateur ou le mot de passe est incorrect<strong>
</div>
<?php
		}
	}

?>
 <form action="index.php?action=connexion" method="post">
                <div class="form-group">
                  <label for="login">Nom d'utilisateur</label>
                  <input type="text" class="form-control" name ="login" id="login" placeholder="Tapez votre nom d'utilisateur">
                </div>
                <div class="form-group">
                  <label for="password">Mot de passe</label>
                  <input type="password" class="form-control" name ="password" id="password" placeholder="Tapez votre mot de passe">
                </div>
                <button type="submit" class="btn btn-default">Se connecter</button>
                <a href="index.php?action=subscribePage" class="pull-right">S'inscrire</a>
              </form>
<?php
$content = ob_get_clean();
require ('view/template.php');

?>

