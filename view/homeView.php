<?php
ob_start();
?>
<div class="card product-list">
<div class="row">
<?php
while ($data = $product->fetch())
	{ 
    $productId = $data['id'];
    $productImgSrc = './uploads/products/'.$productId ; ?>

<a href="index.php?action=productUnique&amp;id=<?php
	echo $data['id'] ?>"><div class="jumbotron product-list-product-jumbotron">
<?php echo '<img src="'.$productImgSrc.'" class="product-list-product-img" />' ?>
<br >
<h5 class="product-list-product-title"><?php echo $data['title'] ?></h5>
<h5 class="product-list-product-price"><?php echo $data['price'] ?></h5>
</div></a>
<?php
		}


?>
</div>
</div>
<?php
$content = ob_get_clean();
require('template.php');

?>