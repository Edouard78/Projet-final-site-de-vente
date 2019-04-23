<?php 

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


                 
if (isset($_SESSION['cartTotal']))
{
    $amount = (string) $_SESSION['cartTotal']->total();


$charge = \Stripe\Charge::create(array(
    "amount" => $amount,
    "currency" => "eur",
    "description"=> "STYLESHOP",
    "customer" => $customer->id
));



}

print_r($charge);

?>