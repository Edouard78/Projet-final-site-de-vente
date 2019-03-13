<?php ob_start();

?>

<form action="index.php?action=addItem" method="post" enctype="multipart/form-data">
<legend>Ajouter un article</legend>
<div class="form-group">
    <label for="itemImg">Télécharger une image:</label>
<input type="file" name="itemImg" />
</div>
						<div class="form-group">
							<label for="title">Titre</label>
							<input type="text" class="form-control" name ="title" id="title" placeholder="Titre">
						</div>
						<div class="form-group">
							<label for="brand">Marque</label>
							<input type="text" class="form-control" name ="brand" id="brand" placeholder="Marque">
						</div>
						<div class="form-group">
							<label for="description">Description</label>
							<textarea class="tinymce" name="description" id="description" placeholder="description" rows="8"></textarea> 
						</div>
						<button type="submit" class="btn btn-default">Ajouter</button>
					</form>

<?php $content = ob_get_clean();

require 'adminTemplate.php';
?>