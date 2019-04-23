<?php
ob_start();
?>
<div class="card cardProduct">
<div class="row">
<?php
while ($data = $product->fetch())
	{ 
    $productId = $data['id'];
    $productImgSrc = './uploads/products/'.$productId ; ?>

<a href="index.php?action=productUnique&amp;id=<?php
	echo $data['id'] ?>"><div class="jumbotron jumbotronProduct">
<?php echo '<img src="'.$productImgSrc.'" class="productImgHome" />' ?>
<br >
<h5 class="product-title-list"><?php echo $data['title'] ?></h5>
<h5 class="product-price-list"><?php echo $data['price'] ?></h5>
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