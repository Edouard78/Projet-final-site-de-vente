<?php
ob_start();
?>
<h3>Informations</h3>
<?php
if (isset($_GET['success']))
{
	if ($_GET['success'] == 1)
	{
?>

    <div class="alert alert-success">
    <strong>Votre commande est été passée avec succès, nous vous remerçions.<strong>
</div>

<?php
}
}

?>
<a class='pull-right' href='index.php?action=home'>Retour à la page d'acceuil</a>
<?php
$content = ob_get_clean();
require ('view/template.php');

?>