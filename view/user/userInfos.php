
<?php
ob_start(); ?>

<h3> Mes Infos </h3>
<a href="index.php?action=addPostPage">
		Modifier
		</a>
<br>
<br>
	<?php

while ($data = $userInfos->fetch())
	{
?>
				<p><strong>Login : </strong><?php echo $data['login'] ?></p>
				<p><strong>Email : </strong><?php echo $data['email'] ?></p>
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
