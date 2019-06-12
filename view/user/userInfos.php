
<?php
ob_start(); ?>

<h3>Vos informations personnelles</h3>
<br>
	<?php

while ($data = $userInfos->fetch())
	{
?>				
<form action="index.php?action=saveInfos" method="post" enctype="multipart/form-data">
<div class="form-group">
							<label for="login">Login</label>
						
							<input type="text" class="form-control login" name ="login" id="login" value="<?php echo $data['login'] ?>">
						
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" class="form-control" name ="email" id="email" value="<?php echo $data['email'] ?>" >
						</div>
						<button type="submit" class="btn btn-default">Sauvegarder</button>
					</form>


				<p class='pull-right'>Inscrit depuis le <?php echo $data['subscribeDate'] ?></p>
			
			<?php
	}

$userInfos->closeCursor();

?>


	<?php
$content = ob_get_clean(); ?>

<?php
require 'userTemplate.php';

?>
