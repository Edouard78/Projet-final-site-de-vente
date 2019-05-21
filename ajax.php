<?php
require_once('index.php');

if (isset($_POST['id']) AND isset($_POST['title']) AND isset($_POST['price']) AND isset($_POST['quantity']) ) {
	

	$data = array("id"=>(int)$_POST['id'], "title" => (string)$_POST['title'], "quantity" => $_POST['quantity'], "price" =>$_POST['price'] );
            addProductToCart($data);

            echo 'success';
} else {
	echo 'error';
}