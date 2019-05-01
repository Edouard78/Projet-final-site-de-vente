<?php

require ('controller/controller.php');

if (isset($_POST['id']) && isset($_POST['price']) && isset($_POST['quantity']) ) {
	$data = array("id"=>$_POST['id'], "quantity" => $_POST['quantity'], "price" =>$_POST['price'] );
            addProductToCart($data);
            echo 'sucess';
} else {
	echo 'error';
}