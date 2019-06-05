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
<div class='product col-lg-3 col-md-4' >
<a  href="index.php?action=productUnique&amp;id=<?php
	echo $data['id'] ?>"><div class="jumbotron product-list-product-jumbotron">
<?php echo '<img src="'.$productImgSrc.'" class="product-list-product-img" />' ?>
<br >
<h5 class="product-list-product-title" style='font-style: none;'><?php echo $data['title'] ?></h5>
<h5 class="product-list-product-price" style='font-style: none;'><?php echo $data['price'] ?> <em class="fa fa-euro"></em></h5>
</a>
</div>
</div>
<?php
		}


?>
</div>

<?php
	if (isset($_GET['page']) && $_GET['page'] < $productListNb && $_GET['page'] > 0)
		{
		$nextPageButtonValue = intval($_GET['page']) + 1;
		$prevPageButtonValue = intval($_GET['page']) - 1;
		}
	  else
		{
		$nextPageButtonValue = $productListNb;
		$prevPageButtonValue = $productListNb;
		}

?><nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="index.php?action=home&amp;page=<?php
	echo $prevPageButtonValue; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
  
<?php
	for ($i = 1; $i < $productListNb + 1; $i++)
		{
?>
    <li class="page-item"><a class="page-link" href="index.php?action=home&amp;page=<?php
		echo $i; ?>"><?php
		echo $i; ?></a></li>

<?php
		} ?>
    <li class="page-item">
      <a class="page-link" href="index.php?action=home&amp;page=<?php
	echo $nextPageButtonValue; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>
</div>
<?php
$content = ob_get_clean();
require('template.php');

?>