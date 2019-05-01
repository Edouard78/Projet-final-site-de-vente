<?php 

require_once ('/../model/orderProduct.php');
require_once ('/../model/order.php');

require_once('/../vendor/autoload.php');
require ('/../index.php');

\Stripe\Stripe::setApiKey('sk_test_cEfh6qGxA7vr3xIa6a0Psbao00BaNEIKFt');

$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

$firstName= $POST['first-name'];
$lastName= $POST['last-name'];
$email= $POST['email'];
$token= $POST['stripeToken'];

// create Customer for stripe

$customer = \Stripe\Customer::create(array(
    "email" => $email,
    "source" =>$token
));


                 
if (isset($_SESSION['cart']))
{
    $amount = $_SESSION['cart']->totalPrice() * 100;


$charge = \Stripe\Charge::create(array(
    "amount" => (string) $amount,
    "currency" => "eur",
    "description"=> "STYLESHOP",
    "customer" => $customer->id
));



}

print_r($charge);

if ($_GET['action'] == 'submitPayment' AND isset($_SESSION['cart']) AND isset($_SESSION['userShippingAndBillingInfos']) ) {
	$orderProducts = [];
	$cartProducts = $cart->products();

	foreach($cartProducts as $cartProduct)
	{
		$cartProductData = get_object_vars($cartProduct);
		$orderProduct = new OrderProduct($cartProductData);

		array_push($orderProducts, $cartProduct)
	}

	$cartData = get_object_vars($_SESSION['cart']);
	$order = new Order($cartData)
	$order->hydrate($_SESSION['userShippingAndBillingInfos']);
	$order->setProducts($orderProducts);
?>