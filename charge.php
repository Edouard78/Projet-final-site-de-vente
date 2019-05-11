<?php 

require_once ('model/billingAdress.php');

require_once('vendor/autoload.php');
require ('index.php');

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

	$stripeAmount = $_SESSION['cart']->totalPrice() * 100;


	$charge = \Stripe\Charge::create(array(
    "amount" => (string) $stripeAmount,
    "currency" => "eur",
    "description"=> "STYLESHOP",
    "customer" => $customer->id

));

if ($_GET['action'] == 'submitPayment' && isset($_SESSION['cart']) && isset($_SESSION['userShippingAndBillingInfos']) ) {
	echo 'Bonjour';
	var_dump($_SESSION['userShippingAndBillingInfos']);
	$orderData = array('userId' => $_SESSION['userId'],
					  	'userShippingAdressId' => $_SESSION['userShippingAndBillingInfos']['userShippingAdressId'],
					  	'billingAdressSameAs' => $_SESSION['userShippingAndBillingInfos']['billingAdressSameAs'],
	   					'totalPrice' => $_SESSION['cart']->totalPrice()
				);
	var_dump($orderData);

	$order = new Order($orderData);
	$orderProducts = [];
	foreach ($_SESSION['cart']->products() as $product) {
		$data = array('id' => $product->id(), 'quantity' => $product->quantity(), 'price' => $product->price() );
		$orderProduct = new OrderProduct($data);
		array_push($orderProducts, $orderProduct);
	}

	$order->setProducts($orderProducts);
	var_dump($order->billingAdressSameAs());
	
	if ($order->billingAdressSameAs() == false) {
		$billingAdress = new BillingAdress($_SESSION['userShippingAndBillingInfos']['billingAdress']);
		saveOrder($order, $orderProducts,$token, $billingAdress);
	}
	else {
		var_dump($order);
		var_dump($orderProducts);
		var_dump($token);
		saveOrder($order, $orderProducts, $token);
	}




var_dump($order);
}


