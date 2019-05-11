<?php
require_once('index.php');

if (isset($_POST['id']) AND isset($_POST['price']) AND isset($_POST['quantity']) ) {
	

	$data = array("id"=>(int)$_POST['id'], "quantity" => $_POST['quantity'], "price" =>$_POST['price'] );
            addProductToCart($data);

            echo 'sucess';
} else {
	echo 'error';
}