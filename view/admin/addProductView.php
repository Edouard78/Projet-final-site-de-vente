<?php ob_start();

?>

<form action="index.php?action=addProduct" method="post" enctype="multipart/form-data">
<legend>Ajouter un article</legend>
<div class="form-group">
    <label for="productImg">Télécharger une image:</label>
<input type="file" name="productImg" />
</div>
						<div class="form-group">
							<label for="title">Titre</label>
							<input type="text" class="form-control" name ="title" id="title" placeholder="Titre">
						</div>
						<div class="form-group">
    <label for="category">Dans quel Categorie :</label>
    <select class="form-control"  name="category" id="category">
    <?php while ($data = $categories->fetch())
	{ 
    ?>
    <option value="<?php echo $data['id']; ?>" selected><?php echo $data['title']; ?></option>
  </div>
  <?php
  }
  ?>
    </select>
</div>
						<div class="form-group">
							<label for="brand">Marque</label>
							<input type="text" class="form-control" name ="brand" id="brand" placeholder="Marque">
						</div>
						<div class="form-group">
							<label for="price">Marque</label>
							<input type="number" class="form-control" name ="price" id="price" placeholder="prix">
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