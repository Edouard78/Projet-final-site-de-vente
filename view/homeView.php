<?php
ob_start();
?>
<div class="card cardItem">
<div class="row">
<?php
while ($data = $item->fetch())
	{ 
    $itemId = $data['id'];
    $itemImgSrc = './uploads/items/'.$itemId ; ?>

<div class="jumbotron jumbotronItem">
<?php echo '<img src="'.$itemImgSrc.'" class="itemImgHome" />' ?>
<h5><?php echo $data['title'] ?></h5>
</div>
<?php
		}


?>
</div>
</div>
<?php
$content = ob_get_clean();
require('template.php');

?>